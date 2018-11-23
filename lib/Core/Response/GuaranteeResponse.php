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
     * Is the response in error
     *
     * @return bool
     */
    public function isError()
    {
        return $this->isError;
    }

    /**
     * Set the error for the response object
     *
     * @param bool $isError The error state
     *
     * @return void
     */
    public function setIsError($isError)
    {
        $this->isError = $isError;
    }

    /**
     * Get the error message
     *
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * Set the error message
     *
     * @param string $errorMessage The error message
     *
     * @return void
     */
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }

    /**
     * Get the case id
     *
     * @return mixed
     */
    public function getCaseId()
    {
        return $this->caseId;
    }

    /**
     * Set the case id
     *
     * @param mixed $caseId The id of the case
     *
     * @return void
     */
    public function setCaseId($caseId)
    {
        $this->caseId = $caseId;
    }

    /**
     * Get the disposition
     *
     * @return mixed
     */
    public function getDisposition()
    {
        return $this->disposition;
    }

    /**
     * Set the disposition
     *
     * @param mixed $disposition The disposition
     *
     * @return void
     */
    public function setDisposition($disposition)
    {
        $this->disposition = $disposition;
    }

    /**
     * Get the reviewed by
     *
     * @return mixed
     */
    public function getReviewedBy()
    {
        return $this->reviewedBy;
    }

    /**
     * Set the reviewed by
     *
     * @param mixed $reviewedBy The reviewer
     *
     * @return void
     */
    public function setReviewedBy($reviewedBy)
    {
        $this->reviewedBy = $reviewedBy;
    }

    /**
     * Get reviewed at
     *
     * @return mixed
     */
    public function getReviewedAt()
    {
        return $this->reviewedAt;
    }

    /**
     * Set the reviewed at
     *
     * @param mixed $reviewedAt Reviewed date
     *
     * @return void
     */
    public function setReviewedAt($reviewedAt)
    {
        $this->reviewedAt = $reviewedAt;
    }

    /**
     * Get the submitted by
     *
     * @return mixed
     */
    public function getSubmittedBy()
    {
        return $this->submittedBy;
    }

    /**
     * Set the submitted by
     *
     * @param mixed $submittedBy Submitted by
     *
     * @return void
     */
    public function setSubmittedBy($submittedBy)
    {
        $this->submittedBy = $submittedBy;
    }

    /**
     * Get submitted at
     *
     * @return mixed
     */
    public function getSubmittedAt()
    {
        return $this->submittedAt;
    }

    /**
     * Set submitted at
     *
     * @param mixed $submittedAt Submission date
     *
     * @return void
     */
    public function setSubmittedAt($submittedAt)
    {
        $this->submittedAt = $submittedAt;
    }

    /**
     * Get the re-review count
     *
     * @return mixed
     */
    public function getRereviewCount()
    {
        return $this->rereviewCount;
    }

    /**
     * Set the re-review count
     *
     * @param mixed $rereviewCount The count
     *
     * @return void
     */
    public function setRereviewCount($rereviewCount)
    {
        $this->rereviewCount = $rereviewCount;
    }

    /**
     * Get guarantee id
     *
     * @return mixed
     */
    public function getGuaranteeId()
    {
        return $this->guaranteeId;
    }

    /**
     * Set the guarantee id
     *
     * @param mixed $guaranteeId The id of the guarantee
     *
     * @return void
     */
    public function setGuaranteeId($guaranteeId)
    {
        $this->guaranteeId = $guaranteeId;
    }

}