<?php
/**
 * The case response object of the Signifyd SDK
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

use Signifyd\Core\Exceptions\LoggerException;
use Signifyd\Core\Logging;
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
     * The outcome of the order
     *
     * @var string
     */
    public $orderOutcome;

    /**
     * The currency of the order
     *
     * @var string
     */
    public $currency;

    /**
     * The adjusted score
     *
     * @var int
     */
    public $adjustedScore;

    /**
     * Is a test investigation
     *
     * @var bool
     */
    public $testInvestigation;

    /**
     * The logger object
     *
     * @var \Signifyd\Core\Logging
     */
    public $logger;

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

    /**
     * The suggested action that should be taken for the order.
     *
     * @var string
     */
    public $checkpointAction;

    /**
     * the name of the customer policy that is triggered.
     * It is omitted when no customer policy is triggered.
     *
     * @var string
     */
    public $checkpointActionReason;

    public $test;

    public $guaranteeIneligibleReason;

    public $guaranteed;

    public $recommendedAction;

    public $message = [];

    public $isTest;

    public $customerCaseId;

    /**
     * CaseResponse constructor.
     *
     * @param Logging $logger The logger
     *
     * @throws LoggerException
     */
    public function __construct($logger)
    {
        if (!is_object($logger) || get_class($logger) !== 'Signifyd\Core\Logging') {
            throw new LoggerException('Invalid logger parameter');
        }

        $this->logger = $logger;
    }

    /**
     * Set the object
     *
     * @param string $response The received response
     *
     * @return bool|CaseResponse
     */
    public function setObject($response)
    {
        $responseArr = json_decode($response, true);
        if (JSON_ERROR_NONE !== json_last_error()) {
            $this->setIsError(true);
            $this->setErrorMessage(json_last_error_msg());
            return $this;
        }

        foreach ($responseArr as $itemKey => $item) {
            if ($itemKey == 'decisions' && is_array($item)) {
                foreach ($item as $decisions => $decisionFiel) {
                    if ($decisions == 'paymentFraud' && is_array($decisionFiel)) {
                        foreach ($decisionFiel as $paymentFraud => $item) {
                            $method = 'set' . ucfirst($paymentFraud);
                            $this->setMethod($method, $item);
                        }
                    }
                }
            }

            $method = 'set' . ucfirst($itemKey);

            $this->setMethod($method, $item);
        }

        return true;
    }

    public function setMethod($method, $item)
    {
        if (method_exists($this, $method)) {
            $this->{$method}($item);
        } else {
            $this->logger->error('Method does not exist: ' . $method);
        }
    }

    /**
     * Get the eligible for guarantee
     *
     * @return bool
     */
    public function getGuaranteeEligible()
    {
        return $this->guaranteeEligible;
    }

    /**
     * Set guarantee eligible
     *
     * @param bool $guaranteeEligible Is guarantee available
     *
     * @return void
     */
    public function setGuaranteeEligible($guaranteeEligible)
    {
        $this->guaranteeEligible = $guaranteeEligible;
    }

    /**
     * Get the guarantee disposition
     *
     * @return string
     */
    public function getGuaranteeDisposition()
    {
        return $this->guaranteeDisposition;
    }

    /**
     * Set the guarantee disposition
     *
     * @param string $guaranteeDisposition The disposition
     *
     * @return void
     */
    public function setGuaranteeDisposition($guaranteeDisposition)
    {
        $this->guaranteeDisposition = $guaranteeDisposition;
    }

    /**
     * Get the The suggested action
     * that should be taken for the order.
     *
     * @return string
     */
    public function getCheckpointAction()
    {
        return $this->checkpointAction;
    }

    /**
     * Set the The suggested action
     * that should be taken for the order.
     *
     * @param string $checkpointAction
     *
     * @return void
     */
    public function setCheckpointAction($checkpointAction)
    {
        $this->checkpointAction = $checkpointAction;
    }

    /**
     * Get the name of the customer policy that is triggered.
     *
     * @return string
     */
    public function getCheckpointActionReason()
    {
        return $this->checkpointActionReason;
    }

    /**
     * Set the name of the customer policy that is triggered.
     *
     * @param string $checkpointActionReason
     *
     * @return void
     */
    public function setCheckpointActionReason($checkpointActionReason)
    {
        $this->checkpointActionReason = $checkpointActionReason;
    }

    /**
     * Get the guarantee status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the guarantee status
     *
     * @param string $status Guarantee status
     *
     * @return void
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Get the case id
     *
     * @return int
     */
    public function getCaseId()
    {
        return $this->caseId;
    }

    /**
     * Set the case id
     *
     * @param int $caseId The id of the case
     *
     * @return void
     */
    public function setCaseId($caseId)
    {
        $this->caseId = $caseId;
    }

    /**
     * Get the uuid
     *
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Set the uuid
     *
     * @param string $uuid The uuid
     *
     * @return void
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * Get the headline
     *
     * @return string
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * Set the Headline
     *
     * @param string $headline The headline
     *
     * @return void
     */
    public function setHeadline($headline)
    {
        $this->headline = $headline;
    }

    /**
     * Get the order id
     *
     * @return string
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * Set the order id
     *
     * @param string $orderId The id of the order
     *
     * @return void
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * Get order create date
     *
     * @return string
     */
    public function getOrderDate()
    {
        return $this->orderDate;
    }

    /**
     * Set the order create date
     *
     * @param string $orderDate Order date
     *
     * @return void
     */
    public function setOrderDate($orderDate)
    {
        $this->orderDate = $orderDate;
    }

    /**
     * Get the order amount
     *
     * @return float
     */
    public function getOrderAmount()
    {
        return $this->orderAmount;
    }

    /**
     * Set the order amount
     *
     * @param float $orderAmount The amount of the order
     *
     * @return void
     */
    public function setOrderAmount($orderAmount)
    {
        $this->orderAmount = $orderAmount;
    }

    /**
     * Get the associated team
     *
     * @return string
     */
    public function getAssociatedTeam()
    {
        return $this->associatedTeam;
    }

    /**
     * Set the associated team
     *
     * @param string $associatedTeam The team
     *
     * @return void
     */
    public function setAssociatedTeam($associatedTeam)
    {
        $this->associatedTeam = $associatedTeam;
    }

    /**
     * Get the review disposition
     *
     * @return string
     */
    public function getReviewDisposition()
    {
        return $this->reviewDisposition;
    }

    /**
     * Set the review disposition
     *
     * @param string $reviewDisposition The disposition
     *
     * @return void
     */
    public function setReviewDisposition($reviewDisposition)
    {
        $this->reviewDisposition = $reviewDisposition;
    }

    /**
     * Get created at for the signifyd case
     *
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set the case created at
     *
     * @param string $createdAt The case created at
     *
     * @return void
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get the case updated at
     *
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set the case updated at
     *
     * @param string $updatedAt The case updated date
     *
     * @return void
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Set the investigation id to the case id
     *
     * @param int $investigationId The case id
     *
     * @return void
     */
    public function setInvestigationId($investigationId)
    {
        $this->setCaseId($investigationId);
    }

    /**
     * Get the case score
     *
     * @return int
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set the case score
     *
     * @param int $score The score
     *
     * @return void
     */
    public function setScore($score)
    {
        $this->score = $score;
    }

    /**
     * Get the order outcome
     *
     * @return mixed
     */
    public function getOrderOutcome()
    {
        return $this->orderOutcome;
    }

    /**
     * Set the order outcome
     *
     * @param mixed $orderOutcome The outcome
     *
     * @return void
     */
    public function setOrderOutcome($orderOutcome)
    {
        $this->orderOutcome = $orderOutcome;
    }

    /**
     * Get the adjusted score
     *
     * @return mixed
     */
    public function getAdjustedScore()
    {
        return $this->adjustedScore;
    }

    /**
     * Set the adjusted code
     *
     * @param mixed $adjustedScore The adjusted score
     *
     * @return void
     */
    public function setAdjustedScore($adjustedScore)
    {
        $this->adjustedScore = $adjustedScore;
    }

    /**
     * Get test investigation
     *
     * @return mixed
     */
    public function getTestInvestigation()
    {
        return $this->testInvestigation;
    }

    /**
     * Set the test investigation flag
     *
     * @param mixed $testInvestigation The test investigation flag
     *
     * @return void
     */
    public function setTestInvestigation($testInvestigation)
    {
        $this->testInvestigation = $testInvestigation;
    }

    /**
     * Get the currency
     *
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set the currency
     *
     * @param mixed $currency The currency iso code
     *
     * @return void
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    public function getTest()
    {
        return $this->test;
    }

    public function setTest($test)
    {
        $this->test = $test;
    }

    public function getIsTest()
    {
        return $this->getTestInvestigation();
    }

    public function setIsTest($test)
    {
        $this->setTestInvestigation($test);
    }

    public function getCustomerCaseId()
    {
        return $this->customerCaseId;
    }

    public function setCustomerCaseId($customerCaseId)
    {
        $this->customerCaseId = $customerCaseId;
    }

    public function getRecommendedAction()
    {
        return $this->recommendedAction;
    }

    public function setRecommendedAction($recommendedAction)
    {
        $this->recommendedAction = $recommendedAction;
    }

    public function getGuaranteed()
    {
        return $this->guaranteed;
    }

    public function setGuaranteed($guaranteed)
    {
        $this->guaranteed = $guaranteed;
    }

    public function getGuaranteeIneligibleReason()
    {
        return $this->guaranteeIneligibleReason;
    }

    public function setGuaranteeIneligibleReason($guaranteeIneligibleReason)
    {
        $this->guaranteeIneligibleReason = $guaranteeIneligibleReason;
    }
}
