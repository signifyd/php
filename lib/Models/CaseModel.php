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
     * The purchase data that will be sent to Signifyd
     *
     * @var \Signifyd\Models\Purchase
     */
    public $purchase;

    /**
     * The recipient data that will be sent to Signifyd
     *
     * @var \Signifyd\Models\Recipient
     */
    public $recipient;

    /**
     * The card data that will be sent to Signifyd
     *
     * @var \Signifyd\Models\Card
     */
    public $card;

    /**
     * The user account data that will be sent to Signifyd
     *
     * @var \Signifyd\Models\UserAccount
     */
    public $userAccount;

    /**
     * The seller data that will be sent to Signifyd
     *
     * @var \Signifyd\Models\Seller
     */
    public $seller;

    /**
     * CaseModel constructor.
     *
     * @param array $case The case data
     */
    public function __construct($case = [])
    {

    }

    /**
     * Validate the case data
     *
     * @return bool
     */
    public function validate()
    {
        return true;
    }
}
