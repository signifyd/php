<?php

namespace Signifyd\Models\Payment\Response;

use Signifyd\Models\Payment\Response\DefaultResponse;

class Authorizenet extends DefaultResponse
{
    /**
     * @param string $cvvStatus
     * @return Authorizenet
     */
    public function setCvv($cvvStatus)
    {
        if ($cvvStatus == 'B') {
            $cvvStatus = 'U';
        }
        
        return parent::setCvv($cvvStatus);
    }

}