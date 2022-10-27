<?php

namespace Signifyd\Models\Payment;

use Signifyd\Models\Payment\Response\BraintreeResponse;

class Braintree extends \Signifyd\Models\Payment\AbstractGateway
{
    protected $response = '';

    /**
     * @var string[]
     */
    protected $urls = [
        'production' => 'https://payments.braintree-api.com/graphql',
        'sandbox' => 'https://payments.sandbox.braintree-api.com/graphql'
    ];

    /**
     * @param $transactionId
     * @param $orderId
     * @return BraintreeResponse|Response\ResponseInterface
     */
    public function fetchData($transactionId, $orderId)
    {
        if (empty($this->response)) {
            $requestArr = [
                'query' => 'query Search($input: PaymentSearchInput!) {
                    search {
                        payments(input: $input) {
                            edges {
                                node {
                                    paymentMethodSnapshot {
                                        __typename
                                        ... on CreditCardDetails {
                                            last4
                                            bin
                                            expirationMonth
                                            expirationYear
                                            cardholderName
                                        }
                                    },
                                    statusHistory {
                                        ... on AuthorizedEvent {
                                            processorResponse {
                                                cvvResponse
                                                avsPostalCodeResponse
                                                avsStreetAddressResponse
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }',
                'variables' => [
                    'input' => [
                        'orderId' => ['is' => $orderId]
                    ]
                ]
            ];

            $request = json_encode($requestArr);

            if ($this->params['environment'] == 'sandbox' &&
                isset($this->params['publicKeySandbox']) &&
                isset($this->params['privateKeySandbox'])
            ) {
                $publicKey = $this->params['publicKeySandbox'];
                $privateKey = $this->params['privateKeySandbox'];
            } else {
                $publicKey = $this->params['publicKey'];
                $privateKey = $this->params['privateKey'];
            }

            $authorizationToEncode = $publicKey . ":" . $privateKey;
            $authorization = base64_encode($authorizationToEncode);

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $this->params['url']);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Authorization: Basic ' . $authorization,
                'Braintree-Version: 2019-01-01'
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $serverOutput = curl_exec($ch);
            curl_close($ch);

            $info = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $serverOutput), true);
            $this->response = new BraintreeResponse();

            if (isset($info['data']) &&
                isset($info['data']['search']) &&
                isset($info['data']['search']['payments']) &&
                isset($info['data']['search']['payments']['edges']) &&
                isset($info['data']['search']['payments']['edges'][0]) &&
                isset($info['data']['search']['payments']['edges'][0]['node']) &&
                isset($info['data']['search']['payments']['edges'][0]['node']['paymentMethodSnapshot']) &&
                isset($info['data']['search']['payments']['edges'][0]['node']['paymentMethodSnapshot']['last4'])
            ) {
                $last4 = $info['data']['search']['payments']['edges'][0]['node']['paymentMethodSnapshot']['last4'];
                $this->response->setLast4($last4);
            }

            if (isset($info['data']) &&
                isset($info['data']['search']) &&
                isset($info['data']['search']['payments']) &&
                isset($info['data']['search']['payments']['edges']) &&
                isset($info['data']['search']['payments']['edges'][0]) &&
                isset($info['data']['search']['payments']['edges'][0]['node']) &&
                isset($info['data']['search']['payments']['edges'][0]['node']['paymentMethodSnapshot']) &&
                isset($info['data']['search']['payments']['edges'][0]['node']['paymentMethodSnapshot']['bin'])

            ) {
                $bin = $info['data']['search']['payments']['edges'][0]['node']['paymentMethodSnapshot']['bin'];
                $this->response->setBin($bin);
            }

            if (isset($info['data']) &&
                isset($info['data']['search']) &&
                isset($info['data']['search']['payments']) &&
                isset($info['data']['search']['payments']['edges']) &&
                isset($info['data']['search']['payments']['edges'][0]) &&
                isset($info['data']['search']['payments']['edges'][0]['node']) &&
                isset($info['data']['search']['payments']['edges'][0]['node']['paymentMethodSnapshot']) &&
                isset($info['data']['search']['payments']['edges'][0]['node']['paymentMethodSnapshot']['expirationMonth'])

            ) {
                $expirationMonth = $info['data']['search']['payments']['edges'][0]['node']['paymentMethodSnapshot']['expirationMonth'];
                $this->response->setExpiryMonth($expirationMonth);
            }

            if (isset($info['data']) &&
                isset($info['data']['search']) &&
                isset($info['data']['search']['payments']) &&
                isset($info['data']['search']['payments']['edges']) &&
                isset($info['data']['search']['payments']['edges'][0]) &&
                isset($info['data']['search']['payments']['edges'][0]['node']) &&
                isset($info['data']['search']['payments']['edges'][0]['node']['paymentMethodSnapshot']) &&
                isset($info['data']['search']['payments']['edges'][0]['node']['paymentMethodSnapshot']['expirationYear'])

            ) {
                $expirationYear = $info['data']['search']['payments']['edges'][0]['node']['paymentMethodSnapshot']['expirationYear'];
                $this->response->setExpiryYear($expirationYear);
            }

            if (isset($info['data']) &&
                isset($info['data']['search']) &&
                isset($info['data']['search']['payments']) &&
                isset($info['data']['search']['payments']['edges']) &&
                isset($info['data']['search']['payments']['edges'][0]) &&
                isset($info['data']['search']['payments']['edges'][0]['node']) &&
                isset($info['data']['search']['payments']['edges'][0]['node']['paymentMethodSnapshot']) &&
                isset($info['data']['search']['payments']['edges'][0]['node']['paymentMethodSnapshot']['cardholderName'])
            ) {
                $cardholderName = $info['data']['search']['payments']['edges'][0]['node']['paymentMethodSnapshot']['cardholderName'];
                $this->response->setCardholder($cardholderName);
            }

            if (isset($info['data']) &&
                isset($info['data']['search']) &&
                isset($info['data']['search']['payments']) &&
                isset($info['data']['search']['payments']['edges']) &&
                isset($info['data']['search']['payments']['edges'][0]) &&
                isset($info['data']['search']['payments']['edges'][0]['node']) &&
                isset($info['data']['search']['payments']['edges'][0]['node']['statusHistory']) &&
                isset($info['data']['search']['payments']['edges'][0]['node']['statusHistory'][0]) &&
                isset($info['data']['search']['payments']['edges'][0]['node']['statusHistory'][0]['processorResponse']) &&
                isset($info['data']['search']['payments']['edges'][0]['node']['statusHistory'][0]['processorResponse']['cvvResponse'])
            ) {
                $cvvResponse = $info['data']['search']['payments']['edges'][0]['node']['statusHistory'][0]['processorResponse']['cvvResponse'];
                $this->response->setCvv($cvvResponse);
            }

            if (isset($info['data']) &&
                isset($info['data']['search']) &&
                isset($info['data']['search']['payments']) &&
                isset($info['data']['search']['payments']['edges']) &&
                isset($info['data']['search']['payments']['edges'][0]) &&
                isset($info['data']['search']['payments']['edges'][0]['node']) &&
                isset($info['data']['search']['payments']['edges'][0]['node']['statusHistory']) &&
                isset($info['data']['search']['payments']['edges'][0]['node']['statusHistory'][0]) &&
                isset($info['data']['search']['payments']['edges'][0]['node']['statusHistory'][0]['processorResponse']) &&
                isset($info['data']['search']['payments']['edges'][0]['node']['statusHistory'][0]['processorResponse']['avsPostalCodeResponse']) &&
                isset($info['data']['search']['payments']['edges'][0]['node']['statusHistory'][0]['processorResponse']['avsStreetAddressResponse'])
            ) {
                $avsPostalCodeResponse = $info['data']['search']['payments']['edges'][0]['node']['statusHistory'][0]['processorResponse']['avsPostalCodeResponse'];
                $avsStreetAddressResponse = $info['data']['search']['payments']['edges'][0]['node']['statusHistory'][0]['processorResponse']['avsStreetAddressResponse'];

                $this->response->setAvsResponse($avsPostalCodeResponse, $avsStreetAddressResponse);
            }
        }

        return $this->response;
    }
}
