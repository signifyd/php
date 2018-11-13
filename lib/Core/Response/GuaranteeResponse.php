<?php
/**
 * The guarantee response object of the Signifyd SDK
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
 * Class GuaranteeResponse
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class GuaranteeResponse extends Response
{
    /**
     * Guarantee decision result
     *
     * @var string
     */
    public $disposition;

    /**
     * Analyst who made the decision.
     *
     * @var string
     */
    public $reviewedBy;

    /**
     * Time of decision. See the Dates section for date formats.
     *
     * @var string
     */
    public $reviewedAt;

    /**
     * User who requested the guarantee.
     *
     * @var string
     */
    public $submittedBy;

    /**
     * Time when guarantee is requested. See the Dates section for date formats.
     *
     * @var string
     */
    public $submittedAt;

    /**
     * Count if there was any re-review
     *
     * @var int
     */
    public $rereviewCount;

    /**
     * The unique identifier assigned for this guarantee.
     *
     * @var int
     */
    public $guaranteeId;

    /**
     * The unique identifier assigned to the case when it is created.
     *
     * @var int
     */
    public $caseId;

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

    /**
     * @return mixed
     */
    public function getCaseId()
    {
        return $this->caseId;
    }

    /**
     * @param mixed $caseId
     */
    public function setCaseId($caseId)
    {
        $this->caseId = $caseId;
    }

    /**
     * @return mixed
     */
    public function getDisposition()
    {
        return $this->disposition;
    }

    /**
     * @param mixed $disposition
     */
    public function setDisposition($disposition)
    {
        $this->disposition = $disposition;
    }

    /**
     * @return mixed
     */
    public function getReviewedBy()
    {
        return $this->reviewedBy;
    }

    /**
     * @param mixed $reviewedBy
     */
    public function setReviewedBy($reviewedBy)
    {
        $this->reviewedBy = $reviewedBy;
    }

    /**
     * @return mixed
     */
    public function getReviewedAt()
    {
        return $this->reviewedAt;
    }

    /**
     * @param mixed $reviewedAt
     */
    public function setReviewedAt($reviewedAt)
    {
        $this->reviewedAt = $reviewedAt;
    }

    /**
     * @return mixed
     */
    public function getSubmittedBy()
    {
        return $this->submittedBy;
    }

    /**
     * @param mixed $submittedBy
     */
    public function setSubmittedBy($submittedBy)
    {
        $this->submittedBy = $submittedBy;
    }

    /**
     * @return mixed
     */
    public function getSubmittedAt()
    {
        return $this->submittedAt;
    }

    /**
     * @param mixed $submittedAt
     */
    public function setSubmittedAt($submittedAt)
    {
        $this->submittedAt = $submittedAt;
    }

    /**
     * @return mixed
     */
    public function getRereviewCount()
    {
        return $this->rereviewCount;
    }

    /**
     * @param mixed $rereviewCount
     */
    public function setRereviewCount($rereviewCount)
    {
        $this->rereviewCount = $rereviewCount;
    }

    /**
     * @return mixed
     */
    public function getGuaranteeId()
    {
        return $this->guaranteeId;
    }

    /**
     * @param mixed $guaranteeId
     */
    public function setGuaranteeId($guaranteeId)
    {
        $this->guaranteeId = $guaranteeId;
    }

}