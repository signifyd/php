<?php
/**
 * PaymentUpdate model for the Signifyd SDK
 *
 * PHP version 5.6
 *
 * @category  Signifyd_Fraud_Protection
 * @package   Signifyd\Core
 * @author    Signifyd <info@signifyd.com>
 * @copyright 2018 SIGNIFYD Inc. All rights reserved.
 * @license   See LICENSE.txt for license details.
 * @link      https://www.signifyd.com/
 */
namespace Signifyd\Models;

use Signifyd\Core\Model;

/**
 * Class PaymentUpdate
 * Record class for updates to payment info
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class PaymentUpdate extends Model
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

    protected $fields = [
        'paymentGateway',
        'transactionId',
        'avsResponseCode',
        'cvvResponseCode'
    ];

    protected $fieldsValidation = [
        'paymentGateway' => [],
        'transactionId' => [],
        'avsResponseCode' => [],
        'cvvResponseCode' => []
    ];

    public function __construct()
    {

    }

    public function validate()
    {

    }
}
