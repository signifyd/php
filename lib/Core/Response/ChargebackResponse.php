<?php
/**
 * ChargebackResponse for the Signifyd SDK
 *
 * PHP version 8.2
 *
 * @category  Signifyd_Fraud_Protection
 * @package   Signifyd\Core
 * @author    Signifyd <info@signifyd.com>
 * @copyright 2026 SIGNIFYD Inc. All rights reserved.
 * @license   See LICENSE.txt for license details.
 * @link      https://www.signifyd.com/
 */
namespace Signifyd\Core\Response;

use Signifyd\Core\Logging;
use Signifyd\Core\Response;
use Signifyd\Models\Chargeback\ChargebackCaseSummary;

/**
 * Class ChargebackResponse
 *
 * Handles both the success (201) and failure (400/401/404/409/500) responses of the
 * Create Chargeback endpoint, following the same single-class-per-endpoint pattern used
 * by the rest of the SDK's Response classes (see SaleResponse).
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class ChargebackResponse extends Response
{
    /**
     * The unique identifier for the investigation, within Signifyd, that the chargeback is linked to.
     *
     * @var int
     */
    public $signifydId;

    /**
     * Unique Order identifier as given by merchant, echoed back from the request.
     *
     * @var string
     */
    public $orderId;

    /**
     * A summary of the current state of the main Chargeback Case artifacts: Chargeback, Claim
     * and (when created) Representment summaries.
     *
     * @var ChargebackCaseSummary
     */
    public $chargebackCaseSummary;

    /**
     * If there is an error and you would like to contact Signifyd, please include this id in
     * your support request.
     *
     * @var string
     */
    public $traceId;

    /**
     * Field-level validation errors returned by the API on a 400/409 response, keyed by the
     * JSON path of the invalid field, each holding an array of messages describing what is
     * wrong with that field.
     *
     * @var array
     */
    public $errors = [];

    /**
     * @var Logging
     */
    public $logger;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'signifydId',
        'orderId',
        'chargebackCaseSummary',
        'messages',
        'traceId',
        'errors',
    ];

    /**
     * ChargebackResponse constructor.
     *
     * @param Logging $logger
     */
    public function __construct(Logging $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Validate the chargeback response
     *
     * @return bool
     */
    public function validate()
    {
        return true;
    }

    /**
     * Populate this response from the raw JSON body returned by the Signifyd API.
     *
     * Handles both shapes documented for this endpoint: the success (201) body
     * (signifydId, orderId, chargebackCaseSummary) and the failure body
     * (messages, traceId, errors).
     *
     * @param string $response
     * @return bool|$this
     */
    public function setObject($response)
    {
        $responseArr = json_decode($response, true);
        if (JSON_ERROR_NONE !== json_last_error()) {
            $this->setIsError(true);
            $this->setErrorMessage(json_last_error_msg());
            $this->addMessage(json_last_error_msg());
            return $this;
        }

        if (!is_array($responseArr)) {
            return $this;
        }

        foreach ($responseArr as $field => $value) {
            if (!in_array($field, $this->fields)) {
                continue;
            }

            if ($field === 'chargebackCaseSummary') {
                if ($value instanceof ChargebackCaseSummary) {
                    $this->setChargebackCaseSummary($value);
                } elseif (is_array($value)) {
                    $this->setChargebackCaseSummary(new ChargebackCaseSummary($value));
                }
                continue;
            }

            if ($field === 'messages' && is_array($value)) {
                foreach ($value as $item) {
                    $this->addMessage($item);
                }
                continue;
            }

            if ($field === 'errors' && is_array($value)) {
                $this->setErrors($value);
                if (!empty($value)) {
                    $this->setIsError(true);
                }
                continue;
            }

            $this->{'set' . ucfirst($field)}($value);
        }

        return true;
    }

    /**
     * Retrieve signifyd id
     *
     * @return int
     */
    public function getSignifydId()
    {
        return $this->signifydId;
    }

    /**
     * Set signifyd id
     *
     * @param int $signifydId
     * @return void
     */
    public function setSignifydId($signifydId)
    {
        $this->signifydId = $signifydId;
    }

    /**
     * Retrieve order id
     *
     * @return string
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * Set order id
     *
     * @param string $orderId
     * @return void
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * Retrieve chargeback case summary
     *
     * @return ChargebackCaseSummary
     */
    public function getChargebackCaseSummary()
    {
        return $this->chargebackCaseSummary;
    }

    /**
     * Set chargeback case summary
     *
     * @param ChargebackCaseSummary $chargebackCaseSummary
     * @return void
     */
    public function setChargebackCaseSummary($chargebackCaseSummary)
    {
        $this->chargebackCaseSummary = $chargebackCaseSummary;
    }

    /**
     * Retrieve trace id
     *
     * @return string
     */
    public function getTraceId()
    {
        return $this->traceId;
    }

    /**
     * Set trace id
     *
     * @param string $traceId
     * @return void
     */
    public function setTraceId($traceId)
    {
        $this->traceId = $traceId;
    }

    /**
     * Retrieve errors
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Set errors
     *
     * @param array $errors
     * @return void
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
    }
}
