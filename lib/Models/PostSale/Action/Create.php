<?php
/**
 * CaseModel for the Signifyd SDK
 *
 * PHP version 8.2
 *
 * @category  Signifyd_Fraud_Protection
 * @package   Signifyd\Core
 * @author    Signifyd <info@signifyd.com>
 * @copyright 2026 SIGNIFYD Inc. All rights reserved.
 * @license   See LICENSE.txt for license details.
 * @link      https://www.signifyd.com/
 */
namespace Signifyd\Models\PostSale\Action;

use Signifyd\Core\Model;
use Signifyd\Models\Device;
use Signifyd\Models\Initiator;
use Signifyd\Models\Item;
use Signifyd\Models\Refund;

/**
 * Class Create
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class Create extends Model
{
    /**
     * Unique identifier for an Order.
     *
     * @var string
     */
    public string $orderId;

    /**
     * Unique identifier for this return, refund, or appeasement request.
     *
     * @var string
     */
    public string $postSaleActionId;

    /**
     * Set to true to skip evaluation and record for analytics only. Use false to request a decision.
     * If no value sent, set to false by default.
     *
     * @var ?bool
     */
    public ?bool $infoOnly;

    /**
     * Timestamp of when the request was initiated. Defaults to current time if not provided.
     *
     * @var ?string
     */
    public ?string $requestedAt;

    /**
     * Data about the device that was used by the user to complete the actions.
     *
     * @var Device
     */
    public $device;

    /**
     * Array of items included in the post-sale action. Each item represents a return, exchange,
     * or appeasement initiated by the buyer or agent.
     *
     * @var Item[]
     */
    public array $items = [];

    /**
     * Object detailing the expected refund amount and currency.
     *
     * @var Refund
     */
    public Refund $refund;

    /**
     * Unique identifier for who initiated the post-sale action.
     * This will be used if an internal employee initiated the post-sale action.
     *
     * @var Initiator
     */
    public Initiator $initiator;

    /**
     * A list of attributes or short descriptors associated with the order.
     *
     * @var string[]
     */
    public array $tags;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'orderId',
        'postSaleActionId',
        'infoOnly',
        'requestedAt',
        'device',
        'items',
        'requestedRefund',
        'initiator',
        'tags'
    ];

    protected $arrayOfObjectFields = [
        'items'
    ];

    protected $stringFields = [
        'orderId',
        'postSaleActionId'
    ];

    /**
     * Create constructor.
     *
     * @param array $postSale
     */
    public function __construct(array $postSale = [])
    {
        // Check if something was passed to the class
        if (is_array($postSale) && !empty($postSale)) {
            foreach ($this->fields as $field) {
                // init the class name
                $class = '\Signifyd\Models\\' . ucfirst($field);

                // make sure no wild data is sent
                if (array_key_exists($field, $postSale) === false) {
                    continue;
                }

                if (is_array($postSale[$field]) && !empty($postSale[$field])) {
                    if (in_array($field, $this->arrayOfObjectFields)) {
                        // init the class name
                        $singular = mb_substr($field,0,-1);
                        $className = ucfirst($singular);
                        $class = '\Signifyd\Models\\' . $className;

                        foreach ($postSale[$field] as $item) {
                            if ($item instanceof $class) {
                                $object = $item;
                            } else {
                                $object = new $class($item);
                            }

                            $this->{'add' . $className}($object);
                        }
                    } else {
                        $this->{'set' . ucfirst($field)}($postSale[$field]);
                    }
                } elseif ($postSale[$field] instanceof $class) {
                    $this->{'set' . ucfirst($field)}($postSale[$field]);
                } elseif (in_array($field, $this->stringFields)) {
                    $this->{'set' . ucfirst($field)}($postSale[$field]);
                }
            }
        }
    }

    /**
     * Validate the post sale
     *
     * @return array|bool
     */
    public function validate(): bool|array
    {
        $valid = [];

        return (!isset($valid[0]))? true : $valid;
    }

    /**
     * Retrieve order id
     *
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->orderId;
    }

    /**
     * Set order id
     *
     * @param string $orderId
     * @return void
     */
    public function setOrderId(string $orderId): void
    {
        $this->orderId = $orderId;
    }

    /**
     * Retrieve post sale action id
     *
     * @return string
     */
    public function getPostSaleActionId(): string
    {
        return $this->postSaleActionId;
    }

    /**
     * Set post sale action id
     *
     * @param string $postSaleActionId
     * @return void
     */
    public function setPostSaleActionId(string $postSaleActionId): void
    {
        $this->postSaleActionId = $postSaleActionId;
    }

    /**
     * Retrieve info only
     *
     * @return bool
     */
    public function getInfoOnly(): bool
    {
        return $this->infoOnly;
    }

    /**
     * Set info only
     *
     * @param bool $infoOnly
     * @return void
     */
    public function setInfoOnly(bool $infoOnly): void
    {
        $this->infoOnly = $infoOnly;
    }

    /**
     * Retrieve requested at
     *
     * @param string $requestedAt
     * @return string
     */
    public function getRequestedAt(string $requestedAt): string
    {
        return $this->requestedAt;
    }

    /**
     * Set requested at
     *
     * @param string $requestedAt
     * @return void
     */
    public function setRequestedAt(string $requestedAt): void
    {
        $this->requestedAt = $requestedAt;
    }

    /**
     * Retrieve device object
     *
     * @return Device
     */
    public function getDevice(): Device
    {
        return $this->device;
    }

    /**
     * Set device
     *
     * @param Device $device
     * @return void
     */
    public function setDevice(Device $device): void
    {
        $this->device = $device;
    }

    /**
     * Retrieve Item objects
     *
     * @return Item[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * Set items
     *
     * @param Item[] $items
     * @return void
     */
    public function setItems(array $items): void
    {
        $this->items = $items;
    }

    /**
     * Retrieve refund
     *
     * @return Refund
     */
    public function getRefund(): Refund
    {
        return $this->refund;
    }

    /**
     * Set refund
     *
     * @param Refund $refund
     * @return void
     */
    public function setRefund(Refund $refund): void
    {
        $this->refund = $refund;
    }

    /**
     * Retrieve initiator
     *
     * @return Initiator
     */
    public function getInitiator(): Initiator
    {
        return $this->initiator;
    }

    /**
     * Set initiator
     *
     * @param Initiator $initiator
     * @return void
     */
    public function setInitiator(Initiator $initiator): void
    {
        $this->initiator = $initiator;
    }

    /**
     * Retrieve tags
     *
     * @return string[]
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * Set tags
     *
     * @param string[] $tags
     * @return void
     */
    public function setTags(array $tags): void
    {
        $this->tags = $tags;
    }
}
