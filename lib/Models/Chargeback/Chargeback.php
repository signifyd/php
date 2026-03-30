<?php
/**
 * PHP version 8.2
 *
 * @category  Signifyd_Fraud_Protection
 * @package   Signifyd\Core
 * @author    Signifyd <info@signifyd.com>
 * @copyright 2026 SIGNIFYD Inc. All rights reserved.
 * @license   See LICENSE.txt for license details.
 * @link      https://www.signifyd.com/
 */
namespace Signifyd\Models\Chargeback;

use Signifyd\Core\Model;

/**
 * Class Chargeback
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class Chargeback extends Model
{
    /**
     * The unique identifier for the order.
     * This must be the same order ID originally provided in the Checkout/Sale event.
     *
     * @var string
     */
    public string $orderId;

    /**
     * Unique Chargeback id as given by payment processor or merchant. Maximum length of 256 characters.
     *
     * @var string
     */
    public string $chargebackId;

    /**
     * Optional field containing a unique Id generated within a partner's system to represent a chargeback case.
     *
     * @var ?string
     */
    public ?string $partnerChargebackId;

    /**
     * Partner system's unique identifier for the merchant. Optional.
     *
     * @var ?string
     */
    public ?string $partnerMerchantId;

    /**
     * ChargebackCreateRequest object.
     *
     * @var ChargebackCreateRequest
     */
    public ChargebackCreateRequest $chargebackCreateRequest;

    /**
     * This object is not required if the Fulfillments API endpoint has been used.
     *
     * @var Fulfillments
     */
    public Fulfillments $fulfillments;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'orderId',
        'chargebackId',
        'partnerChargebackId',
        'partnerMerchantId',
        'chargebackCreateRequest',
        'fulfillments'
    ];

    protected $arrayOfObjectFields = [
        'chargebackCreateRequest',
        'fulfillments'
    ];

    protected $stringFields = [
        'orderId',
        'chargebackId',
        'partnerChargebackId',
        'partnerMerchantId'
    ];

    /**
     * Chargeback constructor.
     *
     * @param array $chargeback
     */
    public function __construct(array $chargeback = [])
    {
        // Check if something was passed to the class
        if (is_array($chargeback) && !empty($chargeback)) {
            foreach ($this->fields as $field) {
                // init the class name
                $class = '\Signifyd\Models\\' . ucfirst($field);

                // make sure no wild data is sent
                if (array_key_exists($field, $chargeback) === false) {
                    continue;
                }

                if (is_array($chargeback[$field]) && !empty($chargeback[$field])) {
                    if (in_array($field, $this->arrayOfObjectFields)) {
                        // init the class name
                        $singular = mb_substr($field,0,-1);
                        $className = ucfirst($singular);
                        $class = '\Signifyd\Models\\' . $className;

                        foreach ($chargeback[$field] as $item) {
                            if ($item instanceof $class) {
                                $object = $item;
                            } else {
                                $object = new $class($item);
                            }

                            $this->{'add' . $className}($object);
                        }
                    } else {
                        $this->{'set' . ucfirst($field)}($chargeback[$field]);
                    }
                } elseif ($chargeback[$field] instanceof $class) {
                    $this->{'set' . ucfirst($field)}($chargeback[$field]);
                } elseif (in_array($field, $this->stringFields)) {
                    $this->{'set' . ucfirst($field)}($chargeback[$field]);
                }
            }
        }
    }

    /**
     * Validate chargeback
     *
     * @return array|bool
     */
    public function validate(): bool|array
    {
        $valid = [];

        return (!isset($valid[0]))? true : $valid;
    }

    /**
     * Retrieve order id
     *
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->orderId;
    }

    /**
     * Set order id
     *
     * @param string $orderId
     * @return void
     */
    public function setOrderId(string $orderId): void
    {
        $this->orderId = $orderId;
    }

    /**
     * Retrieve chargeback id
     *
     * @return string
     */
    public function getChargebackId(): string
    {
        return $this->chargebackId;
    }

    /**
     * Set charge back id
     *
     * @param string $chargebackId
     * @return void
     */
    public function setChargebackId(string $chargebackId): void
    {
        $this->chargebackId = $chargebackId;
    }

    /**
     * Retrieve partner chargeback id
     *
     * @return string
     */
    public function getPartnerChargebackId(): string
    {
        return $this->partnerChargebackId;
    }

    /**
     * Set partner chargeback id
     *
     * @param string $partnerChargebackId
     * @return void
     */
    public function setPartnerChargebackId(string $partnerChargebackId): void
    {
        $this->partnerChargebackId = $partnerChargebackId;
    }

    /**
     * Retrieve partner merchant id
     *
     * @param string $partnerMerchantId
     * @return string
     */
    public function getPartnerMerchantId(string $partnerMerchantId): string
    {
        return $this->partnerMerchantId;
    }

    /**
     * Set partner merchant id
     *
     * @param string $partnerMerchantId
     * @return void
     */
    public function setPartnerMerchantId(string $partnerMerchantId): void
    {
        $this->partnerMerchantId = $partnerMerchantId;
    }

    /**
     * Retrieve chargeback create request
     *
     * @return ChargebackCreateRequest
     */
    public function getChargebackCreateRequest(): ChargebackCreateRequest
    {
        return $this->chargebackCreateRequest;
    }

    /**
     * Set chargeback create request
     *
     * @param ChargebackCreateRequest $chargebackCreateRequest
     * @return void
     */
    public function setChargebackCreateRequest(ChargebackCreateRequest $chargebackCreateRequest): void
    {
        $this->chargebackCreateRequest = $chargebackCreateRequest;
    }

    /**
     * Retrieve fulfillments
     *
     * @return Fulfillments
     */
    public function getFulfillments(): Fulfillments
    {
        return $this->fulfillments;
    }

    /**
     * Set fulfillments
     *
     * @param Fulfillments $fulfillments
     * @return void
     */
    public function setFulfillments(Fulfillments $fulfillments): void
    {
        $this->fulfillments = $fulfillments;
    }
}
