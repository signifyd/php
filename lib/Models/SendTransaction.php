<?php

namespace Signifyd\Models;

use Signifyd\Core\Model;
use Signifyd\Models\Transaction;

class SendTransaction extends Model
{
    /**
     * A unique id for a particular checkout.
     *
     * @var string
     */
    public $checkoutToken;

    /**
     * A list of payment instruments and associated payment
     * details used to pay for the order.
     *
     * @var array $transactions Array of Transaction objects
     */
    public $transactions;

    public function __construct($sendTransaction = [])
    {
        // Check if something was passed to the class
        if (is_array($sendTransaction) && !empty($sendTransaction)) {
            if (isset($sendTransaction['checkoutToken'])) {
                $this->{'setCheckoutToken'}($sendTransaction['checkoutToken']);
            }

            if (isset($sendTransaction['transactions']) && is_array($sendTransaction['transactions'])) {
                foreach ($sendTransaction['transactions'] as $item) {
                    $transaction = new Transaction($item);
                    $this->addTransaction($transaction);
                }
            }
        }
    }

    /**
     * Validate the policy
     *
     * @return bool
     */
    public function validate()
    {
        $valid = [];

        //TODO add code to validate the user account
        return (!isset($valid[0]))? true : false;
    }

    /**
     * Get a unique id for a particular checkout.
     *
     * @return string
     */
    public function getCheckoutToken()
    {
        return $this->checkoutToken;
    }

    /**
     * Set a unique id for a particular checkout.
     *
     * @param string $checkoutToken
     *
     * @return void
     */
    public function setCheckoutToken($checkoutToken)
    {
        $this->checkoutToken = $checkoutToken;
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
}