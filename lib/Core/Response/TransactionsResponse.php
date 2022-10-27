<?php

namespace Signifyd\Core\Response;

use Signifyd\Core\Exceptions\LoggerException;
use Signifyd\Core\Model;
use Signifyd\Core\Response;
use Signifyd\Models\Transaction;

class TransactionsResponse extends Response
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

    /**
     * @param $logger
     * @throws LoggerException
     */
    public function __construct($logger)
    {
        if (!is_object($logger) || get_class($logger) !== 'Signifyd\Core\Logging') {
            throw new LoggerException('Invalid logger parameter');
        }

        $this->logger = $logger;
    }

    /**
     * @param $response
     * @return bool
     */
    public function setObject($response)
    {
        $responseArr = json_decode($response, true);
        if (is_array($responseArr) && !empty($responseArr)) {
            if (isset($responseArr['checkoutToken'])) {
                $this->{'setCheckoutToken'}($responseArr['checkoutToken']);
            }

            if (isset($responseArr['transactions']) && is_array($responseArr['transactions'])) {
                foreach ($responseArr['transactions'] as $item) {
                    $transaction = new Transaction($item);
                    $this->addTransaction($transaction);
                }
            }
        }

        return true;
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