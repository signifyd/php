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
 * Class ClaimSummary
 *
 * Summary of the current status of the Claim, returned as part of the Create Chargeback response.
 * Will also include Disposition details, if they exist.
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class ClaimSummary extends Model
{
    /**
     * Signifyd's unique identifier of this Claim.
     *
     * @var int
     */
    public int $signifydClaimId;

    /**
     * Whether a merchant's chargeback qualifies for reimbursement from Signifyd.
     * One of: APPROVED, DECLINED. Only present once the claim has been dispositioned.
     *
     * @var ?string
     */
    public ?string $disposition = null;

    /**
     * Additional context for the disposition result (e.g. INELIGIBLE_CHARGEBACK, PRODUCT_REROUTED,
     * PRODUCT_RETURNED, ORDER_NOT_GUARANTEED, MISSING_INFORMATION, PAST_ELIGIBLE_SUBMISSION_DATE,
     * NOT_A_CHARGEBACK, UNABLE_TO_VERIFY_PROOF_OF_SHIPMENT, HISTORICAL_INGESTION, AUTO_DISPOSITION,
     * DEPRECATED_REASON, INELIGIBLE_PRE_AUTH_GATEWAY_STATUS_CODE).
     *
     * @var ?string
     */
    public ?string $dispositionReason = null;

    /**
     * The status within the Signifyd claim lifecycle that the claim is in.
     * One of: PENDING, NEED_MORE_INFO, CANCELLED, CLOSED.
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
        'signifydClaimId',
        'disposition',
        'dispositionReason',
        'status'
    ];

    protected $arrayOfObjectFields = [];

    protected $stringFields = [
        'disposition',
        'dispositionReason',
        'status'
    ];

    /**
     * ClaimSummary constructor.
     *
     * @param array $claimSummary
     */
    public function __construct(array $claimSummary = [])
    {
        if (is_array($claimSummary) && !empty($claimSummary)) {
            foreach ($this->stringFields as $field) {
                if (array_key_exists($field, $claimSummary) && !is_array($claimSummary[$field])) {
                    $this->{'set' . ucfirst($field)}($claimSummary[$field]);
                }
            }

            if (array_key_exists('signifydClaimId', $claimSummary)) {
                $this->setSignifydClaimId((int) $claimSummary['signifydClaimId']);
            }
        }
    }

    /**
     * Validate claim summary
     *
     * @return array|bool
     */
    public function validate(): bool|array
    {
        $valid = [];

        return (!isset($valid[0]))? true : $valid;
    }

    /**
     * Retrieve signifyd claim id
     *
     * @return int
     */
    public function getSignifydClaimId(): int
    {
        return $this->signifydClaimId;
    }

    /**
     * Set signifyd claim id
     *
     * @param int $signifydClaimId
     * @return void
     */
    public function setSignifydClaimId(int $signifydClaimId): void
    {
        $this->signifydClaimId = $signifydClaimId;
    }

    /**
     * Retrieve disposition
     *
     * @return ?string
     */
    public function getDisposition(): ?string
    {
        return $this->disposition;
    }

    /**
     * Set disposition
     *
     * @param ?string $disposition
     * @return void
     */
    public function setDisposition(?string $disposition): void
    {
        $this->disposition = $disposition;
    }

    /**
     * Retrieve disposition reason
     *
     * @return ?string
     */
    public function getDispositionReason(): ?string
    {
        return $this->dispositionReason;
    }

    /**
     * Set disposition reason
     *
     * @param ?string $dispositionReason
     * @return void
     */
    public function setDispositionReason(?string $dispositionReason): void
    {
        $this->dispositionReason = $dispositionReason;
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
