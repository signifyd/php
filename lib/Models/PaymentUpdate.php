<?php

namespace Signifyd\Models;

use Signifyd\Core\SignifydModel;

/**
 * Class PaymentUpdate
 * Record class for updates to payment info
 */
class PaymentUpdate extends SignifydModel
{
    /**
     * @var string
     */
    public $paymentGateway;
    /**
     * @var string
     */
    public $transactionId;
    /**
     * @var string
     */
    public $avsResponseCode;
    /**
     * @var string
     */
    public $cvvResponseCode;

    public function __construct()
    {
        $validator = array();
        $validator["paymentGateway"] = array ("type" => "string", "value" => null);
        $validator["transactionId"] = array("type" => "string", "value" => null);
        $validator["avsResponseCode"] = array("type" => "string", "value" => null);
        $validator["cvvResponseCode"] = array ("type" => "string", "value" => null);

        $this->validationInfo = $validator;
    }
}
