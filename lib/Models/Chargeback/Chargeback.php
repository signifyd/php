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
    public ?string $partnerChargebackId = null;

    /**
     * Partner system's unique identifier for the merchant. Optional.
     *
     * @var ?string
     */
    public ?string $partnerMerchantId = null;

    /**
     * ChargebackCreateRequest object. Serialized as "chargeback" in the request body,
     * per the Create Chargeback API contract (POST /v3/orders/events/chargebacks).
     *
     * @var ChargebackCreateRequest
     */
    public ChargebackCreateRequest $chargeback;

    /**
     * This array is not required if the Fulfillments API endpoint has been used.
     *
     * @var Fulfillment[]
     */
    public array $fulfillments = [];

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
        'chargeback',
        'fulfillments'
    ];

    protected $arrayOfObjectFields = [
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
        if (is_array($chargeback) && !empty($chargeback)) {
            foreach ($this->stringFields as $field) {
                if (array_key_exists($field, $chargeback) && !is_array($chargeback[$field])) {
                    $this->{'set' . ucfirst($field)}($chargeback[$field]);
                }
            }

            if (!empty($chargeback['chargeback'])) {
                $value = $chargeback['chargeback'];
                if ($value instanceof ChargebackCreateRequest) {
                    $this->setChargeback($value);
                } elseif (is_array($value)) {
                    $this->setChargeback(new ChargebackCreateRequest($value));
                }
            }

            if (!empty($chargeback['fulfillments']) && is_array($chargeback['fulfillments'])) {
                foreach ($chargeback['fulfillments'] as $fulfillment) {
                    if ($fulfillment instanceof Fulfillment) {
                        $this->addFulfillment($fulfillment);
                    } elseif (is_array($fulfillment)) {
                        $this->addFulfillment(new Fulfillment($fulfillment));
                    }
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
    public function getPartnerChargebackId(): ?string
    {
        return $this->partnerChargebackId;
    }

    /**
     * Set partner chargeback id
     *
     * @param string $partnerChargebackId
     * @return void
     */
    public function setPartnerChargebackId(?string $partnerChargebackId): void
    {
        $this->partnerChargebackId = $partnerChargebackId;
    }

    /**
     * Retrieve partner merchant id
     *
     * @return string
     */
    public function getPartnerMerchantId(): ?string
    {
        return $this->partnerMerchantId;
    }

    /**
     * Set partner merchant id
     *
     * @param string $partnerMerchantId
     * @return void
     */
    public function setPartnerMerchantId(?string $partnerMerchantId): void
    {
        $this->partnerMerchantId = $partnerMerchantId;
    }

    /**
     * Retrieve chargeback create request
     *
     * @return ChargebackCreateRequest
     */
    public function getChargeback(): ChargebackCreateRequest
    {
        return $this->chargeback;
    }

    /**
     * Set chargeback create request
     *
     * @param ChargebackCreateRequest $chargeback
     * @return void
     */
    public function setChargeback(ChargebackCreateRequest $chargeback): void
    {
        $this->chargeback = $chargeback;
    }

    /**
     * Retrieve fulfillments
     *
     * @return Fulfillment[]
     */
    public function getFulfillments(): array
    {
        return $this->fulfillments;
    }

    /**
     * Set fulfillments
     *
     * @param Fulfillment[] $fulfillments
     * @return void
     */
    public function setFulfillments(array $fulfillments): void
    {
        $this->fulfillments = $fulfillments;
    }

    /**
     * Add a fulfillment
     *
     * @param Fulfillment $fulfillment
     * @return void
     */
    public function addFulfillment(Fulfillment $fulfillment): void
    {
        $this->fulfillments[] = $fulfillment;
    }
}
