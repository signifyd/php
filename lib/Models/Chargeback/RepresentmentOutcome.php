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
use Signifyd\Models\Chargeback\ChargebackCreateRequest;
use Signifyd\Models\Chargeback\Fulfillments;

/**
 * Class RepresentmentOutcome
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class RepresentmentOutcome extends Model
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
     * The Representment Outcome indicates the final result of the representment case.
     *
     * @var string
     */
    public string $representmentOutcome;
    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'orderId',
        'chargebackId',
        'partnerChargebackId',
        '$representmentOutcome'
    ];

    protected $arrayOfObjectFields = [];

    protected $stringFields = [
        'orderId',
        'chargebackId',
        'partnerChargebackId',
        '$representmentOutcome'
    ];

    /**
     * RepresentmentOutcome constructor.
     *
     * @param array $representmentOutcome
     */
    public function __construct(array $representmentOutcome = [])
    {
        // Check if something was passed to the class
        if (is_array($representmentOutcome) && !empty($representmentOutcome)) {
            foreach ($this->fields as $field) {
                // init the class name
                $class = '\Signifyd\Models\\' . ucfirst($field);

                // make sure no wild data is sent
                if (array_key_exists($field, $representmentOutcome) === false) {
                    continue;
                }

                if (is_array($representmentOutcome[$field]) && !empty($representmentOutcome[$field])) {
                    if (in_array($field, $this->arrayOfObjectFields)) {
                        // init the class name
                        $singular = mb_substr($field,0,-1);
                        $className = ucfirst($singular);
                        $class = '\Signifyd\Models\\' . $className;

                        foreach ($representmentOutcome[$field] as $item) {
                            if ($item instanceof $class) {
                                $object = $item;
                            } else {
                                $object = new $class($item);
                            }

                            $this->{'add' . $className}($object);
                        }
                    } else {
                        $this->{'set' . ucfirst($field)}($representmentOutcome[$field]);
                    }
                } elseif ($representmentOutcome[$field] instanceof $class) {
                    $this->{'set' . ucfirst($field)}($representmentOutcome[$field]);
                } elseif (in_array($field, $this->stringFields)) {
                    $this->{'set' . ucfirst($field)}($representmentOutcome[$field]);
                }
            }
        }
    }

    /**
     * Validate representment outcome
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
     * Retrieve representment outcome
     *
     * @param string $representmentOutcome
     * @return string
     */
    public function getRepresentmentOutcome(string $representmentOutcome): string
    {
        return $this->representmentOutcome;
    }

    /**
     * Set representment outcome
     *
     * @param string $representmentOutcome
     * @return void
     */
    public function setRepresentmentOutcome(string $representmentOutcome): void
    {
        $this->representmentOutcome = $representmentOutcome;
    }
}
