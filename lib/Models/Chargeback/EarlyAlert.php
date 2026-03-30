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

/**
 * Class EarlyAlert
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class EarlyAlert extends Model
{
    /**
     * The amount of the transaction and the currency it is within.
     *
     * @var string
     */
    public string $alertProviderReferenceId;

    /**
     * The amount of the transaction and the currency it is within.
     *
     * @var Amount
     */
    public $amount;

    /**
     * Card Bank Identification Number
     *
     * @var int
     */
    public int $cardBin;

    /**
     * Name of the merchant associated with this early alert
     *
     * @var string
     */
    public string $merchantName;

    /**
     * The unique identifier for the order.
     * This must be the same order ID originally provided in the Checkout/Sale event.
     *
     * @var string
     */
    public string $orderId;

    /**
     * Provider’s name for the early alert.
     *
     * @var string
     */
    public string $alertName;

    /**
     * The date on which the early alert was reported by the provider. Formatted as yyyy-MM-dd'T'HH:mm:ssZ per ISO 8601
     *
     * @var ?string
     */
    public ?string $alertProviderReportedDate;

    /**
     * Whether the transaction was initially identified by the card holder or the card issuer.
     *
     * @var string
     */
    public string $alertInitiatedBy;

    /**
     * Email address for the cardholder
     *
     * @var string
     */
    public string $cardholderEmail;

    /**
     * Name associated with the cardholder
     *
     * @var string
     */
    public string $cardholderName;

    /**
     * The merchant account identifier used in the transaction the alert is for.
     *
     * @var string
     */
    public string $merchantId;

    /**
     * A Merchant Category Code (MCC) is a four-digit number listed in ISO 18245 for retail financial services.
     * An MCC is used to classify every business that accepts card payments by the goods or services it provides.
     * The MCC is provided by payment processors on authorizations.
     *
     * @var string
     */
    public string $mcc;

    /**
     * Card scheme linked to payment card
     *
     * @var string
     */
    public string $cardScheme;

    /**
     * The name of the card issuer
     *
     * @var string
     */
    public string $issuer;

    /**
     * Unique value assigned by the card scheme (VISA/Mastercard, etc.)
     * to each transaction on the Authorization and maintained throughout the life cycle of the transaction.
     *
     * @var string
     */
    public string $transactionId;

    /**
     * Acquirer Reference Number assigned to the transaction
     *
     * @var string
     */
    public string $arn;

    /**
     * The card scheme-specific chargeback reason code which indicates the cardholder’s reason
     * for disputing the transaction.
     *
     * @var string
     */
    public string $alertReasonCode;

    /**
     * Description of the alert reason
     *
     * @var string
     */
    public string $alertReasonDescription;

    /**
     * The outcome for the alert.
     *
     * @var string
     */
    public string $alertOutcome;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'alertProviderReferenceId',
        'amount',
        'cardBin',
        'merchantName',
        'orderId',
        'alertName',
        'alertProviderReportedDate',
        'alertInitiatedBy',
        'cardholderEmail',
        'cardholderName',
        'merchantId',
        'mcc',
        'cardScheme',
        'issuer',
        'transactionId',
        'arn',
        'alertReasonCode',
        'alertReasonDescription',
        'alertOutcome'
    ];

    protected $arrayOfObjectFields = [
        'amount'
    ];

    protected $stringFields = [
        'alertProviderReferenceId',
        'merchantName',
        'orderId',
        'alertName',
        'alertProviderReportedDate',
        'alertInitiatedBy',
        'cardholderEmail',
        'cardholderName',
        'merchantId',
        'mcc',
        'cardScheme',
        'issuer',
        'transactionId',
        'arn',
        'alertReasonCode',
        'alertReasonDescription',
        'alertOutcome'
    ];

    /**
     * EarlyAlert constructor.
     *
     * @param array $earlyAlert
     */
    public function __construct(array $earlyAlert = [])
    {
        // Check if something was passed to the class
        if (is_array($earlyAlert) && !empty($earlyAlert)) {
            foreach ($this->fields as $field) {
                // init the class name
                $class = '\Signifyd\Models\\' . ucfirst($field);

                // make sure no wild data is sent
                if (array_key_exists($field, $earlyAlert) === false) {
                    continue;
                }

                if (is_array($earlyAlert[$field]) && !empty($earlyAlert[$field])) {
                    if (in_array($field, $this->arrayOfObjectFields)) {
                        // init the class name
                        $singular = mb_substr($field,0,-1);
                        $className = ucfirst($singular);
                        $class = '\Signifyd\Models\\' . $className;

                        foreach ($earlyAlert[$field] as $item) {
                            if ($item instanceof $class) {
                                $object = $item;
                            } else {
                                $object = new $class($item);
                            }

                            $this->{'add' . $className}($object);
                        }
                    } else {
                        $this->{'set' . ucfirst($field)}($earlyAlert[$field]);
                    }
                } elseif ($earlyAlert[$field] instanceof $class) {
                    $this->{'set' . ucfirst($field)}($earlyAlert[$field]);
                } elseif (in_array($field, $this->stringFields)) {
                    $this->{'set' . ucfirst($field)}($earlyAlert[$field]);
                }
            }
        }
    }

    /**
     * Validate early alert
     *
     * @return array|bool
     */
    public function validate(): bool|array
    {
        $valid = [];

        return (!isset($valid[0]))? true : $valid;
    }

    /**
     * Retrieve alert provider referenceId
     *
     * @return string
     */
    public function getAlertProviderReferenceId(): string
    {
        return $this->alertProviderReferenceId;
    }

    /**
     * Set alert provider referenceId
     *
     * @param string $alertProviderReferenceId
     * @return void
     */
    public function setAlertProviderReferenceId(string $alertProviderReferenceId): void
    {
        $this->alertProviderReferenceId = $alertProviderReferenceId;
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
     * Set Amount
     *
     * @param string $amount
     * @return void
     */
    public function setAmount(string $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * Retrieve card bin
     *
     * @return int
     */
    public function getCardBin(): int
    {
        return $this->cardBin;
    }

    /**
     * Set card bin
     *
     * @param int $cardBin
     * @return void
     */
    public function setCardBin(int $cardBin): void
    {
        $this->cardBin = $cardBin;
    }

    /**
     * Retrieve merchant name
     *
     * @param string $merchantName
     * @return string
     */
    public function getMerchantName(string $merchantName): string
    {
        return $this->merchantName;
    }

    /**
     * Set merchant name
     *
     * @param string $merchantName
     * @return void
     */
    public function setMerchantName(string $merchantName): void
    {
        $this->merchantName = $merchantName;
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
     * Retrieve alert name
     *
     * @return string
     */
    public function getAlertName(): string
    {
        return $this->alertName;
    }

    /**
     * Set alert name
     *
     * @param string $alertName
     * @return void
     */
    public function setAlertName(string $alertName): void
    {
        $this->alertName = $alertName;
    }

    /**
     * Retrieve alert provider reported date
     *
     * @return string
     */
    public function getAlertProviderReportedDate(): string
    {
        return $this->alertProviderReportedDate;
    }

    /**
     * Set alert provider reported date
     *
     * @param string $alertProviderReportedDate
     * @return void
     */
    public function setAlertProviderReportedDate(string $alertProviderReportedDate): void
    {
        $this->alertProviderReportedDate = $alertProviderReportedDate;
    }

    /**
     * Retrieve alert initiated by
     *
     * @return string
     */
    public function getAlertInitiatedBy(): string
    {
        return $this->alertInitiatedBy;
    }

    /**
     * Set alert initiated by
     *
     * @param string $alertInitiatedBy
     * @return void
     */
    public function setAlertInitiatedBy(string $alertInitiatedBy): void
    {
        $this->alertInitiatedBy = $alertInitiatedBy;
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
     * @return string
     */
    public function getCardholderName(): string
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
     * Retrieve merchant id
     *
     * @return string
     */
    public function getMerchantId(): string
    {
        return $this->merchantId;
    }

    /**
     * Set merchant id
     *
     * @param string $merchantId
     * @return void
     */
    public function setMerchantId(string $merchantId): void
    {
        $this->merchantId = $merchantId;
    }

    /**
     * Retrieve mcc
     *
     * @return string
     */
    public function getMcc(): string
    {
        return $this->mcc;
    }

    /**
     * Set mcc
     *
     * @param string $mcc
     * @return void
     */
    public function setMcc(string $mcc): void
    {
        $this->mcc = $mcc;
    }

    /**
     * Retrieve card scheme
     *
     * @return string
     */
    public function getCardScheme(): string
    {
        return $this->cardScheme;
    }

    /**
     * Set card scheme
     *
     * @param string $cardScheme
     * @return void
     */
    public function setCardScheme(string $cardScheme): void
    {
        $this->cardScheme = $cardScheme;
    }

    /**
     * Retrieve issuer
     *
     * @return string
     */
    public function getIssuer(): string
    {
        return $this->issuer;
    }

    /**
     * Set issuer
     *
     * @param string $issuer
     * @return void
     */
    public function setIssuer(string $issuer): void
    {
        $this->issuer = $issuer;
    }

    /**
     * Retrieve transaction id
     *
     * @return string
     */
    public function getTransactionId(): string
    {
        return $this->transactionId;
    }

    /**
     * Set transaction id
     *
     * @param string $transactionId
     * @return void
     */
    public function setTransactionId(string $transactionId): void
    {
        $this->transactionId = $transactionId;
    }

    /**
     * Retrieve arn
     *
     * @return string
     */
    public function getArn(): string
    {
        return $this->arn;
    }

    /**
     * Set arn
     *
     * @param string $arn
     * @return void
     */
    public function setArn(string $arn): void
    {
        $this->arn = $arn;
    }

    /**
     * Retrieve alert reason code
     *
     * @return string
     */
    public function getAlertReasonCode(): string
    {
        return $this->alertReasonCode;
    }

    /**
     * Set alert reason code
     *
     * @param string $alertReasonCode
     * @return void
     */
    public function setAlertReasonCode(string $alertReasonCode): void
    {
        $this->alertReasonCode = $alertReasonCode;
    }

    /**
     * Retrieve alert reason description
     *
     * @return string
     */
    public function getAlertReasonDescription(): string
    {
        return $this->alertReasonDescription;
    }

    /**
     * Set alert reason description
     *
     * @param string $alertReasonDescription
     * @return void
     */
    public function setAlertReasonDescription(string $alertReasonDescription): void
    {
        $this->alertReasonDescription = $alertReasonDescription;
    }

    /**
     * Retrieve alertOutcome
     *
     * @return string
     */
    public function getAlertOutcome(): string
    {
        return $this->alertOutcome;
    }

    /**
     * Set alert outcome
     *
     * @param string $alertOutcome
     * @return void
     */
    public function setAlertOutcome(string $alertOutcome): void
    {
        $this->alertOutcome = $alertOutcome;
    }
}
