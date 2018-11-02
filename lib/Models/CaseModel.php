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

use Signifyd\Core\SignifydModel;

/**
 * Class CaseModel
 * Top level object model for a new case entry
 */
class CaseModel extends SignifydModel
{
    /**
     * @var \Signifyd\Models\Purchase
     */
    public $purchase;
    /**
     * @var \Signifyd\Models\Recipient
     */
    public $recipient;
    /**
     * @var \Signifyd\Models\Card
     */
    public $card;
    /**
     * @var \Signifyd\Models\UserAccount
     */
    public $userAccount;
    /**
     * @var \Signifyd\Models\Seller
     */
    public $seller;

    public function __construct($case = [])
    {

    }

    public function validate()
    {

    }
}
