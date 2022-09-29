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
 * Class Reroute
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class Reroute extends Model
{
    /**
     * Unique identifier for the order.
     * This is required to link this Reroute to the original Order created by a Checkout or Sale Event.
     *
     * @var string
     */
    public $orderId;

    /**
     * Data about the device that was used by the user to complete the actions.
     *
     * @var Device
     */
    public $device;

    /**
     * Details about the delivery destinations and the products for each one.
     *
     * @var array of Shipments
     */
    public $shipments = [];

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'orderId',
        'device',
        'shipments',
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'orderId' => [],
        'device' => [],
        'shipments' => [],
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

                if ($field == 'device') {
                    if (isset($data['device'])) {
                        if ($data['device'] instanceof Device) {
                            $this->setDevice($data['device']);
                        } else {
                            $device = new Device($data['device']);
                            $this->setDevice($device);
                        }
                    }
                    continue;
                }

                if ($field == 'shipments') {
                    foreach ($value as $item) {
                        if ($item instanceof Shipment) {
                            $object = $item;
                        } else {
                            $object = new Shipment($item);
                        }

                        $this->addShipment($object);
                    }
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
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param $orderId
     * @return void
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * @return Device
     */
    public function getDevice()
    {
        return $this->device;
    }

    /**
     * @param $device
     * @return void
     */
    public function setDevice($device)
    {
        $this->device = $device;
    }

    /**
     * @return array
     */
    public function getShipments()
    {
        return $this->shipments;
    }

    /**
     * @param $shipments
     * @return void
     */
    public function setShipments($shipments)
    {
        $this->shipments = $shipments;
    }

    /**
     * @param $shipment
     * @return void
     */
    public function addShipment($shipment)
    {
        $this->shipments[] = $shipment;
    }
}