<?php
/**
 * The webhooksBulkResponse response object of the Signifyd SDK
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

/**
 * Class WebhooksBulkResponse
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class WebhooksV2BulkResponse extends WebhooksBulkResponse
{
    /**
     * Set the response objects
     *
     * @param string $response The response string
     *
     * @return void
     *
     * @throws LoggerException
     */
    public function setObject($response)
    {
        $webhooks = json_decode($response, true);
        foreach ($webhooks as $webhook) {
            $webhookJson = json_encode($webhook);
            $webhookObj = new WebhooksV2Response($this->logger);
            $webhookObj->setObject($webhookJson);
            $this->objects[] = $webhookObj;
        }
    }
}
