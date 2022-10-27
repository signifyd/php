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
 * Class Device
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class Driver extends Model
{
    /**
     * The driver rating as gathered by the Last Mile Delivery company.
     *
     * @var float
     */
    public $rating;

    /**
     * The full name of the driver fulfilling the items as seen by the Last Mile Delivery company.
     *
     * @var string
     */
    public $fullName;

    /**
     * The identifier for the driver fulfilling the items unique to the Last Mile Delivery company.
     *
     * @var string
     */
    public $id;

    /**
     * The driver vehicle type as shared by the Last Mile Delivery company used to fulfill the items.
     *
     * @var string
     */
    public $vehicleType;

    /**
     * The driver vehicle color as shared by the Last Mile Delivery company used to fulfill the items.
     *
     * @var string
     */
    public $vehicleColor;

    /**
     * The driver vehicle license plate number as shared by the Last Mile Delivery company used to fulfill the items.
     *
     * @var string
     */
    public $vehicleLicensePlateNumber;

    /**
     * The device data of the driver as seen by the Last Mile Delivery company used to accept the fulfillment request.
     *
     * @var Device
     */
    public $device;

    /**
     * yyyy-MM-dd'T'HH:mm:ssZ The date and time when the items are
     * expected to be fulfilled by the Last Mile Delivery company.
     *
     * @var string
     */
    public $expectedDeliveryTime;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'rating',
        'fullName',
        'id',
        'vehicleType',
        'vehicleColor',
        'vehicleLicensePlateNumber',
        'device',
        'expectedDeliveryTime',
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'rating' => [],
        'fullName' => [],
        'id' => [],
        'vehicleType' => [],
        'vehicleColor' => [],
        'vehicleLicensePlateNumber' => [],
        'device' => [],
        'expectedDeliveryTime' => [],
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
     * @return float
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param $rating
     * @return void
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param $fullName
     * @return void
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getVehicleType()
    {
        return $this->vehicleType;
    }

    /**
     * @param $vehicleType
     * @return void
     */
    public function setVehicleType($vehicleType)
    {
        $this->vehicleType = $vehicleType;
    }

    /**
     * @return string
     */
    public function getVehicleColor()
    {
        return $this->vehicleColor;
    }

    /**
     * @param $vehicleColor
     * @return void
     */
    public function setVehicleColor($vehicleColor)
    {
        $this->vehicleColor = $vehicleColor;
    }

    /**
     * @return string
     */
    public function getVehicleLicensePlateNumber()
    {
        return $this->vehicleLicensePlateNumber;
    }

    /**
     * @param $vehicleLicensePlateNumber
     * @return void
     */
    public function setVehicleLicensePlateNumber($vehicleLicensePlateNumber)
    {
        $this->vehicleLicensePlateNumber = $vehicleLicensePlateNumber;
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
     * @return string
     */
    public function getExpectedDeliveryTime()
    {
        return $this->expectedDeliveryTime;
    }

    /**
     * @param $expectedDeliveryTime
     * @return void
     */
    public function setExpectedDeliveryTime($expectedDeliveryTime)
    {
        $this->expectedDeliveryTime = $expectedDeliveryTime;
    }
}