<?php

namespace Signifyd\Models;

use Signifyd\Core\Model;

/**
 * Class RecordReturn
 */
class RecordReturn extends Model
{
    /**
     * Unique identifier for the order.
     * This is required to link this Reroute to the original Order created by a Checkout or Sale Event.
     *
     * @var string
     */
    public $orderId;

    /**
     * Unique identifier for the Attempt Return.
     *
     * @var string
     */
    public $returnId;

    /**
     * Data about the device that was used by the user to complete the actions.
     *
     * @var Device
     */
    public $device;

    /**
     * A list of products that are going to be returned by the buyer.
     *
     * @var array of ReturnedItem
     */
    public $returnedItems = [];

    /**
     * @var ReplacementItems
     */
    public $replacementItems;

    /**
     * Details about the reimbursement that will be issued to the buyer if the attempt return is approved.
     *
     * @var Refund
     */
    public $refund;

    /**
     * Unique identifier for who initiated the return.
     * This will be used if an internal employee initiated the return.
     *
     * @var Initiator
     */
    public $initiator;

    /**
     * Seller tags
     *
     * @var array of string
     */
    public $trackingNumbers;

    /**
     * Transaction id for the refund issued for a refund claim.
     *
     * @var string
     */
    public $refundTransactionId;

    /**
     * Id for the store credit issued for a refund claim.
     *
     * @var string
     */
    public $storeCreditId;

    /**
     * Unique identifier for the replacement order
     * issued either as a response to a refund claim or as an exchange for a return.
     *
     * @var string
     */
    public $replacementOrderId;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'orderId',
        'returnId',
        'device',
        'returnedItems',
        'replacementItems',
        'refund',
        'initiator',
        'trackingNumbers',
        'refundTransactionId',
        'storeCreditId',
        'replacementOrderId'
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'orderId' => [],
        'returnId' => [],
        'device' => [],
        'returnedItems' => [],
        'replacementItems' => [],
        'refund' => [],
        'initiator' => [],
        'trackingNumbers' => [],
        'refundTransactionId' => [],
        'storeCreditId' => [],
        'replacementOrderId' => []
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

                if ($field == 'refund') {
                    if (isset($data['refund'])) {
                        if ($data['refund'] instanceof Refund) {
                            $this->setRefund($data['refund']);
                        } else {
                            $refund = new Refund($data['refund']);
                            $this->setRefund($refund);
                        }
                    }
                    continue;
                }

                if ($field == 'initiator') {
                    if (isset($data['initiator'])) {
                        if ($data['initiator'] instanceof Initiator) {
                            $this->setInitiator($data['initiator']);
                        } else {
                            $initiator = new Initiator($data['initiator']);
                            $this->setInitiator($initiator);
                        }
                    }
                    continue;
                }

                if ($field == 'returnedItems') {
                    foreach ($value as $item) {
                        if ($item instanceof ReturnedItem) {
                            $object = $item;
                        } else {
                            $object = new ReturnedItem($item);
                        }

                        $this->addReturnedItems($object);
                    }
                    continue;
                }

                if ($field == 'replacementItems') {
                    if (isset($data['replacementItems'])) {
                        if ($data['replacementItems'] instanceof ReplacementItems) {
                            $this->setReplacementItems($data['replacementItems']);
                        } else {
                            $replacementItems = new ReplacementItems($data['replacementItems']);
                            $this->setReplacementItems($replacementItems);
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
     * @return array
     */
    public function getTrackingNumbers()
    {
        return $this->trackingNumbers;
    }

    /**
     * @param $trackingNumbers
     * @return void
     */
    public function setTrackingNumbers($trackingNumbers)
    {
        $this->trackingNumbers = $trackingNumbers;
    }

    /**
     * @return string
     */
    public function getRefundTransactionId()
    {
        return $this->refundTransactionId;
    }

    /**
     * @param $refundTransactionId
     * @return void
     */
    public function setRefundTransactionId($refundTransactionId)
    {
        $this->refundTransactionId = $refundTransactionId;
    }

    /**
     * @return string
     */
    public function getStoreCreditId()
    {
        return $this->storeCreditId;
    }

    /**
     * @param $storeCreditId
     * @return void
     */
    public function setStoreCreditId($storeCreditId)
    {
        $this->storeCreditId = $storeCreditId;
    }

    /**
     * @return string
     */
    public function getReplacementOrderId()
    {
        return $this->replacementOrderId;
    }

    /**
     * @param $replacementOrderId
     * @return void
     */
    public function setReplacementOrderId($replacementOrderId)
    {
        $this->replacementOrderId = $replacementOrderId;
    }

    /**
     * @return string
     */
    public function getReturnId()
    {
        return $this->returnId;
    }

    /**
     * @param $returnId
     * @return void
     */
    public function setReturnId($returnId)
    {
        $this->returnId = $returnId;
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
     * @return Refund
     */
    public function getRefund()
    {
        return $this->refund;
    }

    /**
     * @param $refund
     * @return void
     */
    public function setRefund($refund)
    {
        $this->refund = $refund;
    }

    /**
     * @return Initiator
     */
    public function getInitiator()
    {
        return $this->initiator;
    }

    /**
     * @param $initiator
     * @return void
     */
    public function setInitiator($initiator)
    {
        $this->initiator = $initiator;
    }

    /**
     * @return ReplacementItems
     */
    public function getReplacementItems()
    {
        return $this->replacementItems;
    }

    /**
     * @param $replacementItems
     * @return void
     */
    public function setReplacementItems($replacementItems)
    {
        $this->replacementItems = $replacementItems;
    }

    /**
     * @return array
     */
    public function getReturnedItems()
    {
        return $this->returnedItems;
    }

    /**
     * @param $ReturnedItems
     * @return void
     */
    public function setReturnedItems($returnedItems)
    {
        $this->returnedItems = $returnedItems;
    }

    /**
     * @param $returnedItems
     * @return void
     */
    public function addReturnedItems($returnedItem)
    {
        $this->returnedItems[] = $returnedItem;
    }
}