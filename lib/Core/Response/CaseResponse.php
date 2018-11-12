<?php
/**
 * The main response object of the Signifyd SDK
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
namespace Signifyd\Core\Response;

use Signifyd\Core\Response;

/**
 * Class Response
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class CaseResponse extends Response
{
    /**
     * Boolean value indicating if a guarantee can be requested
     * for this Case. If a guarantee has already been requested
     * for this case, then this value will be 'false'.
     *
     * @var bool
     */
    public $guaranteeEligible;

    /**
     * If a case has been submitted for guarantee, this field
     * will be present and indicate the decision state of the
     * guarantee.
     *
     * @var string
     */
    public $guaranteeDisposition;

    /**
     * The current status of the case. All cases are set to
     * OPEN by default and only set DISMISSED if a user clicks
     * the "Dismissed" button in the Signifyd console.
     *
     * @var string
     */
    public $status;

    /**
     * The unique identifier assigned to the case when it is
     * created.
     *
     * @var int
     */
    public $caseId;

    /**
     * A value from 0-1000 indicating the likelihood that
     * the order/transaction is fraud. 0 indicates the
     * highest risk, 1000 indicates the lowest risk.
     *
     * @var int
     */
    public $score;

    /**
     * A universally unique id assigned to the case.
     *
     * @var string
     */
    public $uuid;

    /**
     * The headline (aka name) assigned to the case.
     *
     * @var string
     */
    public $headline;

    /**
     * The unique identifier for the order that was provided
     * when the case was created.
     *
     * @var string
     */
    public $orderId;

    /**
     * The date and time when the order was placed.
     *
     * @var string
     */
    public $orderDate;

    /**
     * The total price of the order, including shipping price
     * and taxes.
     *
     * @var float
     */
    public $orderAmount;

    /**
     * The id for the team with which this case is associated.
     *
     * @var string
     */
    public $associatedTeam;

    /**
     * The review disposition signifies the agent's opinion
     * after reviewing the case, the value will be FRAUDULENT
     * or GOOD based on the agent's review. If there is no
     * review by the agent the value will be UNSET or NULL.
     *
     * @var string
     */
    public $reviewDisposition;

    /**
     * The date and time when the case was created.
     *
     * @var string
     */
    public $createdAt;

    /**
     * The date and time when the case was last updated.
     *
     * @var string
     */
    public $updatedAt;

    /**
     * If the response was in error
     *
     * @var bool
     */
    public $isError = false;

    /**
     * The error message
     *
     * @var string
     */
    public $errorMessage;

    public function __construct()
    {
    }

    /**
     * @param string $response
     */
    public function setObject($response)
    {
        $responseArr = json_decode($response, true);
        if (JSON_ERROR_NONE !== json_last_error()) {
            $this->setIsError(true);
            $this->setErrorMessage(json_last_error_msg());
            return $this;
        }

        var_dump($responseArr);

        foreach ($responseArr as $item) {

        }

        return true;
    }

    /**
     * @param $httpCode
     * @param $error
     */
    public function setError($httpCode, $error)
    {

    }

    /**
     * @return bool
     */
    public function isGuaranteeEligible()
    {
        return $this->guaranteeEligible;
    }

    /**
     * @param bool $guaranteeEligible
     */
    public function setGuaranteeEligible($guaranteeEligible)
    {
        $this->guaranteeEligible = $guaranteeEligible;
    }

    /**
     * @return string
     */
    public function getGuaranteeDisposition()
    {
        return $this->guaranteeDisposition;
    }

    /**
     * @param string $guaranteeDisposition
     */
    public function setGuaranteeDisposition($guaranteeDisposition)
    {
        $this->guaranteeDisposition = $guaranteeDisposition;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getCaseId()
    {
        return $this->caseId;
    }

    /**
     * @param int $caseId
     */
    public function setCaseId($caseId)
    {
        $this->caseId = $caseId;
    }

    /**
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * @return string
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * @param string $headline
     */
    public function setHeadline($headline)
    {
        $this->headline = $headline;
    }

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param string $orderId
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * @return string
     */
    public function getOrderDate()
    {
        return $this->orderDate;
    }

    /**
     * @param string $orderDate
     */
    public function setOrderDate($orderDate)
    {
        $this->orderDate = $orderDate;
    }

    /**
     * @return float
     */
    public function getOrderAmount()
    {
        return $this->orderAmount;
    }

    /**
     * @param float $orderAmount
     */
    public function setOrderAmount($orderAmount)
    {
        $this->orderAmount = $orderAmount;
    }

    /**
     * @return string
     */
    public function getAssociatedTeam()
    {
        return $this->associatedTeam;
    }

    /**
     * @param string $associatedTeam
     */
    public function setAssociatedTeam($associatedTeam)
    {
        $this->associatedTeam = $associatedTeam;
    }

    /**
     * @return string
     */
    public function getReviewDisposition()
    {
        return $this->reviewDisposition;
    }

    /**
     * @param string $reviewDisposition
     */
    public function setReviewDisposition($reviewDisposition)
    {
        $this->reviewDisposition = $reviewDisposition;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param string $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return bool
     */
    public function isError()
    {
        return $this->isError;
    }

    /**
     * @param bool $isError
     */
    public function setIsError($isError)
    {
        $this->isError = $isError;
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @param string $errorMessage
     */
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }

}