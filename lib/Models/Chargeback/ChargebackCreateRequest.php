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
 * Class ChargebackCreateRequest
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class ChargebackCreateRequest extends Model
{
    /**
     * The amount of the transaction and the currency it is within.
     *
     * @var Amount
     */
    public Amount $amount;

    /**
     * A Payment Processor's view of the reason for the chargeback.
     *
     * @var Reason
     */
    public Reason $reason;

    /**
     * Card holder's email.
     *
     * @var ?string
     */
    public ?string $cardholderEmail;

    /**
     * Card holder's name.
     *
     * @var ?string
     */
    public ?string $cardholderName;

    /**
     * The amount of Chargeback Fees intended to cover the costs and efforts involved in returning
     * funds from the merchant to the rightful cardholder.
     *
     * @var ChargebackFees
     */
    public ChargebackFees $chargebackFees;

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
     * Payment processor (e.g. WORLDPAY, ADYEN, PAYPAL etc.).
     *
     * @var string
     */
    public string $paymentProcessor;

    /**
     * Payment network (e.g. Visa, Mastercard, etc.).
     *
     * @var string
     */
    public string $paymentNetwork;

    /**
     * The Chargeback Stage refers to the stage within the chargeback dispute lifecycle that the chargeback is in with
     * respect to the payment processor/gateway.
     *
     * @var string
     */
    public string $chargebackStage;

    /**
     * Assumed ownership is an optional field passed to Signifyd to provide details about the assumed owning party
     * of the representation rights upon creation of the chargeback case.
     * This field will be ignored unless the caller is a Signifyd partner.
     *
     * @var AssumedOwnership
     */
    public AssumedOwnership $assumedOwnership;

    /**
     * This object is not required if the Fulfillments API endpoint has been used.
     *
     * @var Fullfilments
     */
    public Fullfilments $fullfilments;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'amount',
        'reason',
        'cardholderEmail',
        'cardholderName',
        'chargebackFees',
        'issuerReportedDate',
        'dueDate',
        'paymentProcessor',
        'paymentNetwork',
        'chargebackStage',
        'assumedOwnership',
        'fullfilments'
    ];

    protected $arrayOfObjectFields = [
        'amount',
        'reason',
        'assumedOwnership',
        'fullfilments'
    ];

    protected $stringFields = [
        'cardholderEmail',
        'cardholderName',
        'issuerReportedDate',
        'dueDate',
        'paymentProcessor',
        'paymentNetwork',
        'chargebackStage'
    ];

    /**
     * ChargebackCreateRequest constructor.
     *
     * @param array $chargebackCreateRequest
     */
    public function __construct(array $chargebackCreateRequest = [])
    {
        // Check if something was passed to the class
        if (is_array($chargebackCreateRequest) && !empty($chargebackCreateRequest)) {
            foreach ($this->fields as $field) {
                // init the class name
                $class = '\Signifyd\Models\\' . ucfirst($field);

                // make sure no wild data is sent
                if (array_key_exists($field, $chargebackCreateRequest) === false) {
                    continue;
                }

                if (is_array($chargebackCreateRequest[$field]) && !empty($chargebackCreateRequest[$field])) {
                    if (in_array($field, $this->arrayOfObjectFields)) {
                        // init the class name
                        $singular = mb_substr($field,0,-1);
                        $className = ucfirst($singular);
                        $class = '\Signifyd\Models\\' . $className;

                        foreach ($chargebackCreateRequest[$field] as $item) {
                            if ($item instanceof $class) {
                                $object = $item;
                            } else {
                                $object = new $class($item);
                            }

                            $this->{'add' . $className}($object);
                        }
                    } else {
                        $this->{'set' . ucfirst($field)}($chargebackCreateRequest[$field]);
                    }
                } elseif ($chargebackCreateRequest[$field] instanceof $class) {
                    $this->{'set' . ucfirst($field)}($chargebackCreateRequest[$field]);
                } elseif (in_array($field, $this->stringFields)) {
                    $this->{'set' . ucfirst($field)}($chargebackCreateRequest[$field]);
                }
            }
        }
    }

    /**
     * Validate the post sale
     *
     * @return array|bool
     */
    public function validate(): bool|array
    {
        $valid = [];

        return (!isset($valid[0]))? true : $valid;
    }

    /**
     * Retrieve amount
     *
     * @return Amount
     */
    public function getAmount(): Amount
    {
        return $this->amount;
    }

    /**
     * Set amount
     *
     * @param Amount $amount
     * @return void
     */
    public function setAmount(Amount $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * Retrieve reason
     *
     * @return Reason
     */
    public function getReason(): Reason
    {
        return $this->reason;
    }

    /**
     * Set reason
     *
     * @param Reason $reason
     * @return void
     */
    public function setReason(Reason $reason): void
    {
        $this->reason = $reason;
    }

    /**
     * Retrieve cardholder email
     *
     * @return string
     */
    public function getCardholderEmail(): string
    {
        return $this->cardholderEmail;
    }

    /**
     * Set cardholder email
     *
     * @param string $cardholderEmail
     * @return void
     */
    public function setCardholderEmail(string $cardholderEmail): void
    {
        $this->cardholderEmail = $cardholderEmail;
    }

    /**
     * Retrieve cardholder name
     *
     * @param string $cardholderName
     * @return string
     */
    public function getCardholderName(string $cardholderName): string
    {
        return $this->cardholderName;
    }

    /**
     * Set cardholder name
     *
     * @param string $cardholderName
     * @return void
     */
    public function setCardholderName(string $cardholderName): void
    {
        $this->cardholderName = $cardholderName;
    }

    /**
     * Retrieve chargeback fees
     *
     * @return ChargebackFees
     */
    public function getChargebackFees(): ChargebackFees
    {
        return $this->chargebackFees;
    }

    /**
     * Set chargeback fees
     *
     * @param ChargebackFees $chargebackFees
     * @return void
     */
    public function setChargebackFees(ChargebackFees $chargebackFees): void
    {
        $this->chargebackFees = $chargebackFees;
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
     * Set due date
     *
     * @param string $dueDate
     * @return void
     */
    public function setDueDate(string $dueDate): void
    {
        $this->dueDate = $dueDate;
    }

    /**
     * Retrieve payment processor
     *
     * @return string
     */
    public function getPaymentProcessor(): string
    {
        return $this->paymentProcessor;
    }

    /**
     * Set payment processor
     *
     * @param string $paymentProcessor
     * @return void
     */
    public function setPaymentProcessor(string $paymentProcessor): void
    {
        $this->paymentProcessor = $paymentProcessor;
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
