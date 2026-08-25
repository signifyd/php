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
namespace Signifyd\Models\Chargeback;

use Signifyd\Core\Model;

/**
 * Class RepresentmentSummary
 *
 * Summary of the current status of the Representment, returned as part of the Create Chargeback
 * response. Only present if an unassigned representment was created for the chargeback.
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class RepresentmentSummary extends Model
{
    /**
     * Signifyd's unique identifier of this Representment. Should match the parent Chargeback Id.
     *
     * @var int|float
     */
    public int|float $signifydRepresentmentId;

    /**
     * The final result of the representment case.
     * One of: NONE, LOST, WON.
     *
     * @var string
     */
    public string $outcome;

    /**
     * The status within the Signifyd claim lifecycle that the representment is in.
     * One of: IN_PROGRESS, DISPUTED, ABANDONED, CLOSED.
     *
     * @var string
     */
    public string $status;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'signifydRepresentmentId',
        'outcome',
        'status'
    ];

    protected $arrayOfObjectFields = [];

    protected $stringFields = [
        'outcome',
        'status'
    ];

    /**
     * RepresentmentSummary constructor.
     *
     * @param array $representmentSummary
     */
    public function __construct(array $representmentSummary = [])
    {
        if (is_array($representmentSummary) && !empty($representmentSummary)) {
            foreach ($this->stringFields as $field) {
                if (array_key_exists($field, $representmentSummary) && !is_array($representmentSummary[$field])) {
                    $this->{'set' . ucfirst($field)}($representmentSummary[$field]);
                }
            }

            if (array_key_exists('signifydRepresentmentId', $representmentSummary)) {
                $this->setSignifydRepresentmentId($representmentSummary['signifydRepresentmentId']);
            }
        }
    }

    /**
     * Validate representment summary
     *
     * @return array|bool
     */
    public function validate(): bool|array
    {
        $valid = [];

        return (!isset($valid[0]))? true : $valid;
    }

    /**
     * Retrieve signifyd representment id
     *
     * @return int|float
     */
    public function getSignifydRepresentmentId(): int|float
    {
        return $this->signifydRepresentmentId;
    }

    /**
     * Set signifyd representment id
     *
     * @param int|float $signifydRepresentmentId
     * @return void
     */
    public function setSignifydRepresentmentId(int|float $signifydRepresentmentId): void
    {
        $this->signifydRepresentmentId = $signifydRepresentmentId;
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
     * Retrieve status
     *
     * @return string
     */
    public function getStatus(): string
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
}
