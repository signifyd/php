<?php

namespace Signifyd\Models\Payment;

use Signifyd\Models\Payment\Response\DefaultResponse;

class Authorizenet extends AbstractGateway
{
    protected $response = [];

    /**
     * @var string[]
     */
    protected $urls = [
        'production' => 'https://api.authorize.net/xml/v1/request.api',
        'sandbox' => 'https://apitest.authorize.net/xml/v1/request.api'
    ];
    
    /**
     * @param $transactionId
     * @return DefaultResponse|Response\ResponseInterface
     */
    public function fetchData($transactionId, $orderId)
    {
        if (isset($this->response[$orderId]) === false) {
            $request = [
                "getTransactionDetailsRequest" => [
                    "merchantAuthentication" => [
                        "name" => $this->params['name'],
                        "transactionKey" => $this->params['transactionKey']
                    ],
                    "transId" => $transactionId
                ]
            ];

            $request = json_encode($request);
            $requestHash = crc32($request);

            if (isset($this->responses[$requestHash])) {
                return $this->responses[$requestHash];
            }

            $options = [
                CURLOPT_URL => $this->params['url'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POSTFIELDS => $request,
                CURLOPT_SSL_VERIFYPEER => false
            ];

            $curl = curl_init();
            curl_setopt_array($curl, $options);
            $response = curl_exec($curl);

            $info = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $response), true);
            $this->response[$orderId] = new \Signifyd\Models\Payment\Response\Authorizenet();

            if (isset($info['transaction']) &&
                isset($info['transaction']['billTo']) &&
                isset($info['transaction']['billTo']['firstName']) &&
                isset($info['transaction']['billTo']['lastName'])
            ) {
                $holderName = $info['transaction']['billTo']['firstName'] . " " . $info['transaction']['billTo']['lastName'];
                $this->response[$orderId]->setCardholder($holderName);
            }

            if (isset($info['transaction']) &&
                isset($info['transaction']['payment']) &&
                isset($info['transaction']['payment']['creditCard']) &&
                isset($info['transaction']['payment']['creditCard']['cardNumber'])
            ) {
                $last4 = substr($info['transaction']['payment']['creditCard']['cardNumber'], -4);
                $this->response[$orderId]->setLast4($last4);
            }

            if (isset($info['transaction']) &&
                isset($info['transaction']['AVSResponse'])
            ) {
                $avs = $info['transaction']['AVSResponse'];
                $this->response[$orderId]->setAvs($avs);
            }

            if (isset($info['transaction']) &&
                isset($info['transaction']['cardCodeResponse'])
            ) {
                $cvv = $info['transaction']['cardCodeResponse'];
                $this->response[$orderId]->setCvv($cvv);
            }
        }

        return $this->response[$orderId];
    }
}
