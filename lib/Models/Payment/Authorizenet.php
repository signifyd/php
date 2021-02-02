<?php

namespace Signifyd\Models\Payment;

use Signifyd\Models\Payment\Response\DefaultResponse;

class Authorizenet extends AbstractGateway
{
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

        $info = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $response), true );
        $holderName = $info['transaction']['billTo']['firstName'] . " " . $info['transaction']['billTo']['lastName'];
        $last4 = substr($info['transaction']['payment']['creditCard']['cardNumber'], -4);

        $response = new \Signifyd\Models\Payment\Response\Authorizenet();
        $response->setCardholder($holderName);
        $response->setLast4($last4);
        $response->setAvs($info['transaction']['AVSResponse']);
        $response->setCvv($info['transaction']['cardCodeResponse']);

        return $response;
    }
}
