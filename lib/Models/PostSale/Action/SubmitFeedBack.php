<?php
/**
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
use Signifyd\Models\Item;

/**
 * Class SubmitFeedBack
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class SubmitFeedBack extends Model
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
     * Array of items included in the post-sale action. Each item represents a return, exchange,
     * or appeasement initiated by the buyer or agent.
     *
     * @var Item[]
     */
    public array $items = [];

    /**
     * Final classification of the return after inspection or analysis.
     *
     * @var string
     */
    public string $outcome;

    /**
     * Additional detail that helps explain why a return was classified as Fraud or Abuse.
     *
     * @var string
     */
    public string $outcomeReason;

    /**
     * Timestamp indicating when the outcome was determined.
     *
     * @var string
     */
    public string $feedbackAt;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'orderId',
        'postSaleActionId',
        'items',
        'outcome',
        'outcomeReason',
        'feedbackAt'
    ];

    protected $arrayOfObjectFields = [
        'items'
    ];

    protected $stringFields = [
        'orderId',
        'postSaleActionId',
        'outcome',
        'outcomeReason',
        'feedbackAt'
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
     * Retrieve outcome
     *
     * @return string
     */
    public function getOutcome(): string
    {
        return $this->outcome;
    }

    /**
     * Set outcome
     *
     * @param string $outcome
     * @return void
     */
    public function setOutcome(string $outcome): void
    {
        $this->outcome = $outcome;
    }

    /**
     * Retrieve outcome reason
     *
     * @return string
     */
    public function getOutcomeReason(): string
    {
        return $this->outcomeReason;
    }

    /**
     * Set outcome reason
     *
     * @param string $outcomeReason
     * @return void
     */
    public function setOutcomeReason(string $outcomeReason): void
    {
        $this->outcomeReason = $outcomeReason;
    }

    /**
     * Retrieve feedback at
     *
     * @return string
     */
    public function getFeedbackAt(): string
    {
        return $this->feedbackAt;
    }

    /**
     * Set feedback at
     *
     * @param string $feedbackAt
     * @return void
     */
    public function setFeedbackAt(string $feedbackAt): void
    {
        $this->feedbackAt = $feedbackAt;
    }
}
