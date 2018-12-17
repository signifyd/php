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
use Signifyd\Models\Card;
use Signifyd\Models\Purchase;
use Signifyd\Models\Recipient;
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
     * @var Recipient
     */
    public $recipient;

    /**
     * Data related to the card that was used for the
     * purchase and its cardholder.
     *
     * @var Card
     */
    public $card;

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
        'recipient',
        'card',
        'userAccount',
        'seller'
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
                if (is_array($case[$field]) && !empty($case[$field])) {
                    // instantiate the class
                    $object = new $class($case[$field]);
                    $this->{'set' . $field}($object);
                } elseif ($case[$field] instanceof $class) {
                    $this->{'set' . $field}($case[$field]);
                }
            }
        }
    }

    /**
     * Validate the case data
     *
     * @return bool
     */
    public function validate()
    {
        $valid = [];
        foreach ($this->fields as $field) {
            $obj = $this->{'get' . ucfirst($field)}();
            $objValid = $obj->validate();
            if (false === $objValid) {
                $valid[] = false;
            }
        }

        return (!isset($valid[0]))? true : false;
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
     * Get the recipient
     *
     * @return Recipient
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * Set the recipient
     *
     * @param Recipient $recipient Recipient data
     *
     * @return void
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;
    }

    /**
     * Get the card data
     *
     * @return Card
     */
    public function getCard()
    {
        return $this->card;
    }

    /**
     * Set the card data
     *
     * @param Card $card Card data
     *
     * @return void
     */
    public function setCard($card)
    {
        $this->card = $card;
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
}
