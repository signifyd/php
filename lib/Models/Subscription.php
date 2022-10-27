<?php
/**
 * UserAccount model for the Signifyd SDK
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
use Signifyd\Models\Fingerprint;

/**
 * Class Subscription
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class Subscription extends Model
{
    /**
     * A unique identifier for the subscription itself.
     * There can be many products associated with a single subscriptionId.
     *
     * @var string
     */
    public $subscriptionId;

    /**
     * The expected delivery date, following this one, formatted as yyyy-MM-dd.
     *
     * @var string
     */
    public $nextDeliveryDate;

    /**
     * Frequency of the given subscription.
     *
     * @var array of string
     */
    public $periodUnit = [];

    /**
     * Total subscription term expressed as a number of periodUnits.
     * If the subscription does not have a defined end, then do not include this field.
     *
     * @var float
     */
    public $totalPeriods;

    /**
     * What the product's price would be if it was purchased as a one-time purchase,
     * rather than as a subscription.
     *
     * @var float
     */
    public $regularItemPrice;

    /**
     * The current subscription period that the recurring order belongs to (1st month, 3rd quarter, etc.).
     *
     * @var float
     */
    public $currentPeriod;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'subscriptionId',
        'nextDeliveryDate',
        'periodUnit',
        'totalPeriods',
        'regularItemPrice',
        'currentPeriod'
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'subscriptionId' => [],
        'nextDeliveryDate' => [],
        'periodUnit' => [],
        'totalPeriods' => [],
        'regularItemPrice' => [],
        'currentPeriod' => []
    ];

    /**
     * UserAccount constructor.
     *
     * @param array $data The user account data
     */
    public function __construct($data = [])
    {
        if (!empty($data) && is_array($data)) {
            foreach ($data as $field => $value) {
                if (!in_array($field, $this->fields)) {
                    continue;
                }

                $this->{'set' . ucfirst($field)}($value);
            }
        }
    }

    /**
     * Validate the user account
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
     * @return string
     */
    public function getSubscriptionId()
    {
        return $this->subscriptionId;
    }

    /**
     * @param $subscriptionId
     * @return void
     */
    public function setSubscriptionId($subscriptionId)
    {
        $this->subscriptionId = $subscriptionId;
    }

    /**
     * @return string
     */
    public function getNextDeliveryDate()
    {
        return $this->nextDeliveryDate;
    }

    /**
     * @param $nextDeliveryDate
     * @return void
     */
    public function setNextDeliveryDate($nextDeliveryDate)
    {
        $this->nextDeliveryDate = $nextDeliveryDate;
    }

    /**
     * @param $periodUnit
     * @return void
     */
    public function addPeriodUnit($periodUnit)
    {
        $this->periodUnit[] = $periodUnit;
    }

    /**
     * @return float
     */
    public function getTotalPeriods()
    {
        return $this->totalPeriods;
    }

    /**
     * @param $totalPeriods
     * @return void
     */
    public function setTotalPeriods($totalPeriods)
    {
        $this->totalPeriods = $totalPeriods;
    }

    /**
     * @return float
     */
    public function getRegularItemPrice()
    {
        return $this->regularItemPrice;
    }

    /**
     * @param $regularItemPrice
     * @return void
     */
    public function setRegularItemPrice($regularItemPrice)
    {
        $this->regularItemPrice = $regularItemPrice;
    }

    /**
     * @return float
     */
    public function getCurrentPeriod()
    {
        return $this->currentPeriod;
    }

    /**
     * @param $currentPeriod
     * @return void
     */
    public function setCurrentPeriod($currentPeriod)
    {
        $this->currentPeriod = $currentPeriod;
    }
}