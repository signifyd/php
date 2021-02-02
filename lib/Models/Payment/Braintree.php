<?php

namespace Signifyd\Models\Payment;

use Signifyd\Models\Payment\Response\BraintreeResponse;

class Braintree extends \Signifyd\Models\Payment\AbstractGateway
{
    public function fetchData($transactionId, $orderId)
    {
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
        $environment = $this->params['environment'];

        if ($environment == 'sandbox' && isset($this->params['publicKeySandbox']) && isset($this->params['privateKeySandbox'])) {
            $publicKey = $this->params['publicKeySandbox'];
            $privateKey = $this->params['privateKeySandbox'];
        } else {
            $publicKey = $this->params['publicKey'];
            $privateKey = $this->params['privateKey'];
        }

        $authorizationToEncode = $publicKey . ":" . $privateKey;
        $authorization = base64_encode($authorizationToEncode);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,"https://payments.sandbox.braintree-api.com/graphql");
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
        curl_close ($ch);

        $info = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $serverOutput), true );

        $last4 = $info['data']['search']['payments']['edges'][0]['node']['paymentMethodSnapshot']['last4'];
        $bin = $info['data']['search']['payments']['edges'][0]['node']['paymentMethodSnapshot']['bin'];
        $expirationMonth = $info['data']['search']['payments']['edges'][0]['node']['paymentMethodSnapshot']['expirationMonth'];
        $expirationYear = $info['data']['search']['payments']['edges'][0]['node']['paymentMethodSnapshot']['expirationYear'];
        $cardholderName = $info['data']['search']['payments']['edges'][0]['node']['paymentMethodSnapshot']['cardholderName'];
        $cvvResponse = $info['data']['search']['payments']['edges'][0]['node']['statusHistory'][0]['processorResponse']['cvvResponse'];
        $avsPostalCodeResponse = $info['data']['search']['payments']['edges'][0]['node']['statusHistory'][0]['processorResponse']['avsPostalCodeResponse'];
        $avsStreetAddressResponse = $info['data']['search']['payments']['edges'][0]['node']['statusHistory'][0]['processorResponse']['avsStreetAddressResponse'];

        $response = new BraintreeResponse();

        $response->setLast4($last4);
        $response->setBin($bin);
        $response->setExpiryMonth($expirationMonth);
        $response->setExpiryYear($expirationYear);
        $response->setCardholder($cardholderName);
        $response->setCvv($cvvResponse);
        $response->setAvsResponse($avsPostalCodeResponse, $avsStreetAddressResponse);

        return $response;
    }
}
