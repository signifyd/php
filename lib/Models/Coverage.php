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

/**
 * Class Coverage
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class Coverage extends Model
{
    /**
     * The amount of coverage Signifyd will provide for a fraud chargeback or dispute.
     *
     * @var Chargebacks
     */
    public $fraudChargebacks;

    /**
     * The amount of coverage Signifyd will provide for a claim of Item Not Received.
     *
     * @var Chargebacks
     */
    public $inrChargebacks;

    /**
     * The amount of coverage Signifyd will provide for all types of chargebacks or disputes.
     *
     * @var Chargebacks
     */
    public $allChargebacks;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'fraudChargebacks',
        'inrChargebacks',
        'allChargebacks',
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'fraudChargebacks' => [],
        'inrChargebacks' => [],
        'allChargebacks' => [],
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

                if (isset($value)) {
                    if ($value instanceof Chargebacks) {
                        $this->{'set' . ucfirst($field)}($value);
                    } else {
                        $charge = new Chargebacks($value);
                        $this->{'set' . ucfirst($field)}($charge);
                    }
                }
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

    public function getFraudChargebacks()
    {
        return $this->fraudChargebacks;
    }

    public function setFraudChargebacks($fraudChargebacks)
    {
        $this->fraudChargebacks = $fraudChargebacks;
    }

    public function getInrChargebacks()
    {
        return $this->inrChargebacks;
    }

    public function setInrChargebacks($inrChargebacks)
    {
        $this->inrChargebacks = $inrChargebacks;
    }

    public function getAllChargebacks()
    {
        return $this->allChargebacks;
    }

    public function setAllChargebacks($allChargebacks)
    {
        $this->allChargebacks = $allChargebacks;
    }
}