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
use Signifyd\Models\Refund;
use Signifyd\Models\Replacement;

/**
 * Class Update
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class Update extends Model
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
     * Updated status of the post-sale action. If no Status is provided, the default will be OPEN
     *
     * @var ?string
     */
    public ?string $status;

    /**
     * Timestamp of when the update occurred. If not provided, the current timestamp will be used.
     *
     * @var ?string
     */
    public ?string $updatedAt;

    /**
     * Object detailing the expected refund amount and currency.
     *
     * @var Refund
     */
    public Refund $refund;

    /**
     * Object containing details about any replacement that was issued for the post-sale action.
     * Include only if a replacement has been issued.
     *
     * @var Replacement
     */
    public Replacement $replacement;

    /**
     * Optional labels or context for analytics and tracking.
     *
     * @var string[]
     */
    public array $tags;

    /**
     * The tracking number(s) for the returned item(s).
     *
     * @var string[]
     */
    public array $returnTrackingNumbers;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'orderId',
        'postSaleActionId',
        'status',
        'updatedAt',
        'refund',
        'replacement',
        'tags',
        'returnTrackingNumbers'
    ];

    protected $arrayOfObjectFields = [
        'refund',
        'replacement'
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
     * Retrieve status
     *
     * @return bool
     */
    public function getStatus(): bool
    {
        return $this->status;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return void
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * Retrieve updated at
     *
     * @param string $updatedAt
     * @return string
     */
    public function getUpdatedAt(string $updatedAt): string
    {
        return $this->updatedAt;
    }

    /**
     * Set updated at
     *
     * @param string $updatedAt
     * @return void
     */
    public function setUpdatedAt(string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
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
     * Retrieve replacement
     *
     * @return Replacement
     */
    public function getReplacement(): Replacement
    {
        return $this->replacement;
    }

    /**
     * Set replacement
     *
     * @param Replacement $replacement
     * @return void
     */
    public function setReplacement(Replacement $replacement): void
    {
        $this->replacement = $replacement;
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

    /**
     * Retrieve tracking numbers
     *
     * @return string[]
     */
    public function getReturnTrackingNumbers(): array
    {
        return $this->returnTrackingNumbers;
    }

    /**
     * Set tracking numbers
     *
     * @param string[] $returnTrackingNumbers
     * @return void
     */
    public function setReturnTrackingNumbers(array $returnTrackingNumbers): void
    {
        $this->returnTrackingNumbers = $returnTrackingNumbers;
    }
}
