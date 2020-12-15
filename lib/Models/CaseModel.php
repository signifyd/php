<?php
/**
 * CaseModel for the Signifyd SDK
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
use Signifyd\Models\Purchase;
use Signifyd\Models\Recipient;
use Signifyd\Models\Transaction;
use Signifyd\Models\UserAccount;
use Signifyd\Models\Seller;

/**
 * Class CaseModel
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class CaseModel extends Model
{
    /**
     * Data related to purchase event represented in
     * this Case Creation request.
     *
     * @var Purchase
     */
    public $purchase;

    /**
     * Data related to person or organization receiving
     * the items purchased.
     *
     * @var array $recipients Array of Recipient objects
     */
    public $recipients;

    /**
     * A list of payment instruments and associated payment
     * details used to pay for the order.
     *
     * @var array $transactions Array of Transaction objects
     */
    public $transactions;

    /**
     * If you allow customers to create an account before
     * placing an orders these data values are details from
     * that account.
     *
     * @var \Signifyd\Models\UserAccount
     */
    public $userAccount;

    /**
     * All data related to the seller of the product.
     *
     * @var \Signifyd\Models\Seller
     */
    public $seller;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'purchase',
        'recipients',
        'transactions',
        'userAccount',
        'seller'
    ];

    protected $objectFields = [
        'recipients',
        'transactions'
    ];

    /**
     * CaseModel constructor.
     *
     * @param array $case The case data
     */
    public function __construct($case = [])
    {
        // Check if something was passed to the class
        if (is_array($case) && !empty($case)) {
            foreach ($this->fields as $field) {
                // init the class name
                $class = '\Signifyd\Models\\' . ucfirst($field);

                // make sure no wild data is sent
                if (array_key_exists($field, $case) === false) {
                    continue;
                }

                if (in_array($field, $this->objectFields)) {
                    continue;
                }

                if (is_array($case[$field]) && !empty($case[$field])) {
                    // instantiate the class
                    $object = new $class($case[$field]);
                    $this->{'set' . $field}($object);
                } elseif ($case[$field] instanceof $class) {
                    $this->{'set' . $field}($case[$field]);
                }
            }

            if (isset($case['transactions']) && is_array($case['transactions'])) {
                foreach ($case['transactions'] as $item) {
                    $transaction = new Transaction($item);
                    $this->addTransaction($transaction);
                }
            }

            if (isset($case['recipients']) && is_array($case['recipients'])) {
                foreach ($case['recipients'] as $sItem) {
                    $recipient = new Recipient($sItem);
                    $this->addRecipient($recipient);
                }
            }
        }
    }

    /**
     * Validate the case data
     *
     * @return array|bool
     */
    public function validate()
    {
        $valid = [];
        foreach ($this->fields as $field) {
            $obj = $this->{'get' . ucfirst($field)}();
            if (null === $obj) {
                continue;
            }

            if (is_array($obj)) {
                foreach ($obj as $data) {
                    $dataValid = $data->validate();
                    if (true !== $dataValid) {
                        $valid[] = $dataValid;
                    }
                }
            } else {
                $objValid = $obj->validate();
                if (true !== $objValid) {
                    $valid[] = $objValid;
                }
            }
        }

        return (!isset($valid[0]))? true : $valid;
    }

    /**
     * Get the purchase
     *
     * @return Purchase
     */
    public function getPurchase()
    {
        return $this->purchase;
    }

    /**
     * Set the purchase data
     *
     * @param Purchase $purchase The purchase data
     *
     * @return void
     */
    public function setPurchase($purchase)
    {
        $this->purchase = $purchase;
    }

    /**
     * Get the recipients
     *
     * @return array
     */
    public function getRecipients()
    {
        return $this->recipients;
    }

    /**
     * Set the recipients
     *
     * @param array $recipients Array of Recipient
     *
     * @return void
     */
    public function setRecipients($recipients)
    {
        $this->recipients = $recipients;
    }

    /**
     * Get the transactions
     *
     * @return array
     */
    public function getTransactions()
    {
        return $this->transactions;
    }

    /**
     * set the transactions
     *
     * @param array $transactions Array of Transactions
     *
     * @return void
     */
    public function setTransactions($transactions)
    {
        $this->transactions = $transactions;
    }

    /**
     * Get the user account
     *
     * @return UserAccount
     */
    public function getUserAccount()
    {
        return $this->userAccount;
    }

    /**
     * Set the user account
     *
     * @param UserAccount $userAccount User Account data
     *
     * @return void
     */
    public function setUserAccount($userAccount)
    {
        $this->userAccount = $userAccount;
    }

    /**
     * Get the seller
     *
     * @return Seller
     */
    public function getSeller()
    {
        return $this->seller;
    }

    /**
     * Set the seller
     *
     * @param Seller $seller Seller data
     *
     * @return void
     */
    public function setSeller($seller)
    {
        $this->seller = $seller;
    }

    /**
     * Add transaction item to the transactions array
     *
     * @param Transaction $transaction
     *
     * @return void
     */
    public function addTransaction($transaction)
    {
        $this->transactions[] = $transaction;
    }

    /**
     * Add recipient item to the recipients array
     *
     * @param Recipient $recipient
     *
     * @return void
     */
    public function addRecipient($recipient)
    {
        $this->recipients[] = $recipient;
    }
}
