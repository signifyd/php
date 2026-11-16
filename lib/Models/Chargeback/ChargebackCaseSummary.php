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
 * Class ChargebackCaseSummary
 *
 * A summary of the current state of the main Chargeback Case artifacts, returned as part of the
 * Create Chargeback response: the Chargeback, Claim and (when created) Representment summaries.
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class ChargebackCaseSummary extends Model
{
    /**
     * Summary of the Chargeback.
     *
     * @var ChargebackSummary
     */
    public ChargebackSummary $chargebackSummary;

    /**
     * Summary of the current status of the Claim. Will also include Disposition details, if they exist.
     *
     * @var ClaimSummary
     */
    public ClaimSummary $claimSummary;

    /**
     * Summary of the current status of the Representment. Only returned if an unassigned
     * representment was created.
     *
     * @var ?RepresentmentSummary
     */
    public ?RepresentmentSummary $representmentSummary = null;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'chargebackSummary',
        'claimSummary',
        'representmentSummary'
    ];

    protected $arrayOfObjectFields = [];

    protected $stringFields = [];

    /**
     * Explicit mapping of object fields to their correct classes.
     * Used instead of automatic class-name derivation from field names.
     *
     * @var array
     */
    protected $objectFields = [
        'chargebackSummary'     => ChargebackSummary::class,
        'claimSummary'          => ClaimSummary::class,
        'representmentSummary'  => RepresentmentSummary::class,
    ];

    /**
     * ChargebackCaseSummary constructor.
     *
     * @param array $chargebackCaseSummary
     */
    public function __construct(array $chargebackCaseSummary = [])
    {
        if (is_array($chargebackCaseSummary) && !empty($chargebackCaseSummary)) {
            foreach ($this->objectFields as $field => $class) {
                if (!array_key_exists($field, $chargebackCaseSummary)) {
                    continue;
                }

                $value = $chargebackCaseSummary[$field];
                if ($value instanceof $class) {
                    $this->{'set' . ucfirst($field)}($value);
                } elseif (is_array($value) && !empty($value)) {
                    $this->{'set' . ucfirst($field)}(new $class($value));
                }
            }
        }
    }

    /**
     * Validate chargeback case summary
     *
     * @return array|bool
     */
    public function validate(): bool|array
    {
        $valid = [];

        return (!isset($valid[0]))? true : $valid;
    }

    /**
     * Retrieve chargeback summary
     *
     * @return ChargebackSummary
     */
    public function getChargebackSummary(): ChargebackSummary
    {
        return $this->chargebackSummary;
    }

    /**
     * Set chargeback summary
     *
     * @param ChargebackSummary $chargebackSummary
     * @return void
     */
    public function setChargebackSummary(ChargebackSummary $chargebackSummary): void
    {
        $this->chargebackSummary = $chargebackSummary;
    }

    /**
     * Retrieve claim summary
     *
     * @return ClaimSummary
     */
    public function getClaimSummary(): ClaimSummary
    {
        return $this->claimSummary;
    }

    /**
     * Set claim summary
     *
     * @param ClaimSummary $claimSummary
     * @return void
     */
    public function setClaimSummary(ClaimSummary $claimSummary): void
    {
        $this->claimSummary = $claimSummary;
    }

    /**
     * Retrieve representment summary
     *
     * @return ?RepresentmentSummary
     */
    public function getRepresentmentSummary(): ?RepresentmentSummary
    {
        return $this->representmentSummary ?? null;
    }

    /**
     * Set representment summary
     *
     * @param RepresentmentSummary $representmentSummary
     * @return void
     */
    public function setRepresentmentSummary(RepresentmentSummary $representmentSummary): void
    {
        $this->representmentSummary = $representmentSummary;
    }
}
