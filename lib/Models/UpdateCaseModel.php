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

use Laminas\Filter\Boolean;
use Signifyd\Core\Model;
use Signifyd\Models\Purchase;
use Signifyd\Models\Recipient;

/**
 * Class CaseModel
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class UpdateCaseModel extends Model
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
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'purchase',
        'recipient'
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
     * @param $recipient Recipient
     *
     * @return void
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;
    }
}
