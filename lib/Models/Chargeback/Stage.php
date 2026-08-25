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
use Signifyd\Models\Amount;
use Signifyd\Models\AssumedOwnership;
use Signifyd\Models\Reason;

/**
 * Class Stage
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class Stage extends Model
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
     * The Chargeback Stage refers to the stage within the chargeback dispute lifecycle that the chargeback
     * is in with respect to the payment processor/gateway.
     *
     * @var string
     */
    public string $chargebackStage;

    /**
     * The amount of the transaction and the currency it is within.
     *
     * @var Amount
     */
    public $changeAmount;

    /**
     * A Payment Processor's view of the reason for the chargeback.
     *
     * @var Reason
     */
    public Reason $changeReason;

    /**
     * The Representment Outcome indicates the final result of the representment case.
     *
     * @var string
     */
    public string $changeRepresentmentOutcome;

    /**
     * Formatted as yyyy-MM-dd'T'HH:mm:ssZ per ISO 8601.
     *
     * @var string
     */
    public string $issuerReportedDate;

    /**
     * Formatted as yyyy-MM-dd'T'HH:mm:ssZ per ISO 8601.
     *
     * @var string
     */
    public string $dueDate;

    /**
     * Assumed ownership is an optional field passed to Signifyd to provide details about the assumed owning party
     * of the representation rights upon creation of the chargeback case.
     * This field will be ignored unless the caller is a Signifyd partner.
     *
     * @var AssumedOwnership
     */
    public AssumedOwnership $assumedOwnership;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'orderId',
        'chargebackId',
        'partnerChargebackId',
        'chargebackStage',
        'changeAmount',
        'changeReason',
        'changeRepresentmentOutcome',
        'issuerReportedDate',
        'dueDate',
        'assumedOwnership'
    ];

    protected $arrayOfObjectFields = [
        'changeAmount',
        'changeReason',
        'assumedOwnership'
    ];

    protected $stringFields = [
        'orderId',
        'chargebackId',
        'partnerChargebackId',
        'chargebackStage',
        'changeRepresentmentOutcome',
        'issuerReportedDate',
        'dueDate'
    ];

    /**
     * Stage constructor.
     *
     * @param array $stage
     */
    public function __construct(array $stage = [])
    {
        // Check if something was passed to the class
        if (is_array($stage) && !empty($stage)) {
            foreach ($this->fields as $field) {
                // init the class name
                $class = '\Signifyd\Models\\' . ucfirst($field);

                // make sure no wild data is sent
                if (array_key_exists($field, $stage) === false) {
                    continue;
                }

                if (is_array($stage[$field]) && !empty($stage[$field])) {
                    if (in_array($field, $this->arrayOfObjectFields)) {
                        // init the class name
                        $singular = mb_substr($field,0,-1);
                        $className = ucfirst($singular);
                        $class = '\Signifyd\Models\\' . $className;

                        foreach ($stage[$field] as $item) {
                            if ($item instanceof $class) {
                                $object = $item;
                            } else {
                                $object = new $class($item);
                            }

                            $this->{'add' . $className}($object);
                        }
                    } else {
                        $this->{'set' . ucfirst($field)}($stage[$field]);
                    }
                } elseif ($stage[$field] instanceof $class) {
                    $this->{'set' . ucfirst($field)}($stage[$field]);
                } elseif (in_array($field, $this->stringFields)) {
                    $this->{'set' . ucfirst($field)}($stage[$field]);
                }
            }
        }
    }

    /**
     * Validate stage
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
     * Set chargeback id
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
     * Retrieve chargeback stage
     *
     * @return string
     */
    public function getChargebackStage(): string
    {
        return $this->chargebackStage;
    }

    /**
     * Set chargeback stage
     *
     * @param string $chargebackStage
     * @return void
     */
    public function setChargebackStage(string $chargebackStage): void
    {
        $this->chargebackStage = $chargebackStage;
    }

    /**
     * Retrieve change amount
     *
     * @return Amount
     */
    public function getChangeAmount(): Amount
    {
        return $this->changeAmount;
    }

    /**
     * Set change amount
     *
     * @param Amount $changeAmount
     * @return void
     */
    public function setChangeAmount(Amount $changeAmount): void
    {
        $this->changeAmount = $changeAmount;
    }

    /**
     * Retrieve change reason
     *
     * @return Reason
     */
    public function getChangeReason(): Reason
    {
        return $this->changeReason;
    }

    /**
     * Set change reason
     *
     * @param Reason $changeReason
     * @return void
     */
    public function setChangeReason(Reason $changeReason): void
    {
        $this->changeReason = $changeReason;
    }

    /**
     * Retrieve change representment outcome
     *
     * @return string
     */
    public function getChangeRepresentmentOutcome(): string
    {
        return $this->changeRepresentmentOutcome;
    }

    /**
     * Set change representment outcome
     *
     * @param string $changeRepresentmentOutcome
     * @return void
     */
    public function setChangeRepresentmentOutcome(string $changeRepresentmentOutcome): void
    {
        $this->changeRepresentmentOutcome = $changeRepresentmentOutcome;
    }

    /**
     * Retrieve issuer reported date
     *
     * @return string
     */
    public function getIssuerReportedDate(): string
    {
        return $this->issuerReportedDate;
    }

    /**
     * Set issuer reported date
     *
     * @param string $issuerReportedDate
     * @return void
     */
    public function setIssuerReportedDate(string $issuerReportedDate): void
    {
        $this->issuerReportedDate = $issuerReportedDate;
    }

    /**
     * Retrieve due date
     *
     * @return string
     */
    public function getDueDate(): string
    {
        return $this->dueDate;
    }

    /**
     * Set dueDate
     *
     * @param string $dueDate
     * @return void
     */
    public function setDueDate(string $dueDate): void
    {
        $this->dueDate = $dueDate;
    }

    /**
     * Retrieve assumed ownership
     *
     * @return AssumedOwnership
     */
    public function getAssumedOwnership(): AssumedOwnership
    {
        return $this->assumedOwnership;
    }

    /**
     * Set assumed ownership
     *
     * @param AssumedOwnership $assumedOwnership
     * @return void
     */
    public function setAssumedOwnership(AssumedOwnership $assumedOwnership): void
    {
        $this->assumedOwnership = $assumedOwnership;
    }
}
