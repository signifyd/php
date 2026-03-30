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
namespace Signifyd\Models;

use Signifyd\Core\Model;

class Replacement extends Model
{
    /**
     * Describes when the replacement was issued in the return lifecycle.
     *
     * @var string
     */
    public string $handling;

    /**
     * Object containing replacement products and shipment metadata.
     *
     * @var ReplacementItems
     */
    public ReplacementItems $replacementItems;

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
        'handling',
        'replacementItems',
        'tags',
        'returnTrackingNumbers'
    ];

    /**
     * Replacement constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if (!empty($data) && is_array($data)) {
            foreach ($data as $field => $value) {
                if (!in_array($field, $this->fields)) {
                    continue;
                }
            }
        }
    }

    /**
     * Validate replacement
     *
     * @return bool
     */
    public function validate(): bool
    {
        $valid = [];

        //TODO add code to validate the user account
        return (!isset($valid[0]))? true : false;
    }

    /**
     * Retrieve handling
     *
     * @return string
     */
    public function getHandling(): string
    {
        return $this->handling;
    }

    /**
     * Set handling
     *
     * @param string $handling
     * @return void
     */
    public function setHandling(string $handling): void
    {
        $this->handling = $handling;
    }

    /**
     * Retrieve replacement items
     *
     * @return ReplacementItems
     */
    public function getReplacementItems(): ReplacementItems
    {
        return $this->replacementItems;
    }

    /**
     * Set replacement items
     *
     * @param ReplacementItems $replacementItems
     * @return void
     */
    public function setReplacementItems(ReplacementItems $replacementItems): void
    {
        $this->replacementItems = $replacementItems;
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