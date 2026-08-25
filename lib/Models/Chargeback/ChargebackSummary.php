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
 * Class ChargebackSummary
 *
 * Summary of the Chargeback, returned as part of the Create Chargeback response.
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class ChargebackSummary extends Model
{
    /**
     * Signifyd's unique identifier of the chargeback.
     *
     * @var int
     */
    public int $signifydChargebackId;

    /**
     * Unique Chargeback id as given by payment processor or merchant, echoed back from the request.
     *
     * @var string
     */
    public string $chargebackId;

    /**
     * The Chargeback Stage refers to the stage within the chargeback dispute lifecycle that the chargeback
     * is in with respect to the payment processor/gateway.
     * One of: RETRIEVAL, CHARGEBACK, PREARBITRATION, ARBITRATION, RECALLED.
     *
     * @var string
     */
    public string $stage;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'signifydChargebackId',
        'chargebackId',
        'stage'
    ];

    protected $arrayOfObjectFields = [];

    protected $stringFields = [
        'chargebackId',
        'stage'
    ];

    /**
     * ChargebackSummary constructor.
     *
     * @param array $chargebackSummary
     */
    public function __construct(array $chargebackSummary = [])
    {
        if (is_array($chargebackSummary) && !empty($chargebackSummary)) {
            foreach ($this->stringFields as $field) {
                if (array_key_exists($field, $chargebackSummary) && !is_array($chargebackSummary[$field])) {
                    $this->{'set' . ucfirst($field)}($chargebackSummary[$field]);
                }
            }

            if (array_key_exists('signifydChargebackId', $chargebackSummary)) {
                $this->setSignifydChargebackId((int) $chargebackSummary['signifydChargebackId']);
            }
        }
    }

    /**
     * Validate chargeback summary
     *
     * @return array|bool
     */
    public function validate(): bool|array
    {
        $valid = [];

        return (!isset($valid[0]))? true : $valid;
    }

    /**
     * Retrieve signifyd chargeback id
     *
     * @return int
     */
    public function getSignifydChargebackId(): int
    {
        return $this->signifydChargebackId;
    }

    /**
     * Set signifyd chargeback id
     *
     * @param int $signifydChargebackId
     * @return void
     */
    public function setSignifydChargebackId(int $signifydChargebackId): void
    {
        $this->signifydChargebackId = $signifydChargebackId;
    }

    /**
     * Retrieve chargeback id
     *
     * @return string
     */
    public function getChargebackId(): string
    {
        return $this->chargebackId;
    }

    /**
     * Set chargeback id
     *
     * @param string $chargebackId
     * @return void
     */
    public function setChargebackId(string $chargebackId): void
    {
        $this->chargebackId = $chargebackId;
    }

    /**
     * Retrieve stage
     *
     * @return string
     */
    public function getStage(): string
    {
        return $this->stage;
    }

    /**
     * Set stage
     *
     * @param string $stage
     * @return void
     */
    public function setStage(string $stage): void
    {
        $this->stage = $stage;
    }
}
