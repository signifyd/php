<?php

namespace Signifyd\Models\Payment\Response;

use Signifyd\Models\Payment\Response\DefaultResponse;

class BraintreeResponse extends DefaultResponse
{
    /**
     * List of mapping CVV codes
     *
     * @var array
     */
    private static $cvvBraintreeMap = [
        'M' => 'M',
        'N' => 'N',
        'U' => 'P',
        'I' => 'P',
        'S' => 'S',
        'A' => null,
        'B' => 'P'
    ];

    /**
     * List of mapping AVS codes
     *
     * Keys are concatenation of ZIP (avsPostalCodeResponseCode) and Street (avsStreetAddressResponseCode) codes
     *
     * @var array
     */
    private static $avsBraintreeMap = [
        'MM' => 'Y',
        'MN' => 'Z',
        'MU' => 'Z',
        'MI' => 'Z',
        'NM' => 'A',
        'NN' => 'N',
        'NU' => 'N',
        'NI' => 'N',
        'UU' => 'U',
        'II' => 'U',
        'AA' => 'U'
    ];

    /**
     * @param string $cvvStatus
     * @return BraintreeResponse|void
     */
    public function setCvv($cvvStatus)
    {
        switch($cvvStatus) {
            case 'MATCHES':
                $cvvStatus = 'M';
                break;
            case 'NOT_APPLICABLE':
                $cvvStatus = 'A';
                break;
            case 'NOT_PROVIDED';
                $cvvStatus = 'I';
                break;
            case 'NOT_VERIFIED';
                $cvvStatus = 'U';
                break;
            case 'SYSTEM_ERROR';
                $cvvStatus = null;
                break;
            case 'ISSUER_DOES_NOT_PARTICIPATE';
                $cvvStatus = 'S';
                break;
            case 'DOES_NOT_MATCH';
                $cvvStatus = 'N';
                break;
        }

        if (isset(self::$cvvBraintreeMap[$cvvStatus])
        ) {
            $cvvStatus = self::$cvvBraintreeMap[$cvvStatus];
        }

        return parent::setCvv($cvvStatus);
    }

    public function setAvsResponse($avsPostalCodeResponse, $avsStreetAddressResponse)
    {
        $avsStatus = null;

        switch($avsPostalCodeResponse) {
            case 'MATCHES':
                $avsPostalCodeResponse = 'M';
                break;
            case 'NOT_APPLICABLE':
                $avsPostalCodeResponse = 'A';
                break;
            case 'NOT_PROVIDED';
                $avsPostalCodeResponse = 'I';
                break;
            case 'NOT_VERIFIED';
                $avsPostalCodeResponse = 'U';
                break;
            case 'SYSTEM_ERROR';
                $avsPostalCodeResponse = 'E';
                break;
            case 'ISSUER_DOES_NOT_PARTICIPATE';
                $avsPostalCodeResponse = null;
                break;
            case 'DOES_NOT_MATCH';
                $avsPostalCodeResponse = 'N';
                break;
        }

        switch($avsStreetAddressResponse) {
            case 'MATCHES':
                $avsStreetAddressResponse = 'M';
                break;
            case 'NOT_APPLICABLE':
                $avsStreetAddressResponse = 'A';
                break;
            case 'NOT_PROVIDED';
                $avsStreetAddressResponse = 'I';
                break;
            case 'NOT_VERIFIED';
                $avsStreetAddressResponse = 'U';
                break;
            case 'SYSTEM_ERROR';
                $avsStreetAddressResponse = 'E';
                break;
            case 'ISSUER_DOES_NOT_PARTICIPATE';
                $avsStreetAddressResponse = null;
                break;
            case 'DOES_NOT_MATCH';
                $avsStreetAddressResponse = 'N';
                break;
        }

        $key = $avsPostalCodeResponse . $avsStreetAddressResponse;

        if (isset(self::$avsBraintreeMap[$key])) {
            $avsStatus = self::$avsBraintreeMap[$key];
        }

        return parent::setAvs($avsStatus);
    }
}