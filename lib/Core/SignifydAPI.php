<?php

/**
 * Copyright © 2015 SIGNIFYD Inc. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Signifyd\Core;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class SignifydAPI
{
    /**
     * @var SignifydSettings
     */
    private $settings;

    public $logger;

    protected $lastErrorMessage;

    private function logError($message)
    {
        if($this->settings->logErrors && $this->settings->loggerError){
            $this->logger->error($message);
        }
    }

    private function logWarning($message)
    {
        if($this->settings->logWarnings && $this->settings->loggerWarning){
            $this->logger->warning($message);
        }
    }

    private function logInfo($message)
    {
        if($this->settings->logInfo && $this->settings->loggerInfo){
            $this->logger->info($message);
        }
    }

    /**
     * SignifydAPI constructor.
     * @param SignifydSettings $settings
     * @throws \Exception
     */
    public function __construct(SignifydSettings $settings)
    {
        if (is_null($settings->apiKey)) {
            throw new \Exception("API key is required.");
        }
        $this->settings = $settings;
        $this->logger = new Logger('Signifyd PHP Library');
        $this->logger->pushHandler(new StreamHandler($this->settings->logFileLocation . '/' . $this->settings->logFileName));
    }

    private function makeUrl($endpoint)
    {
        if (substr($this->settings->apiAddress, -1) != '/') {
            return $this->settings->apiAddress . '/' . $endpoint;
        }
        return $this->settings->apiAddress . $endpoint;
    }

    public function traceOut($str)
    {
        echo $str;
    }

    protected function checkResultError($result, $response, $error)
    {
        if ($result >= 200 && $result < 300) {
            return false;
        }

        if($error){
            $this->lastErrorMessage = "Curl error: " . $error;
            $this->logError("Curl error: " . $error);
            return true;
        }

        $output = "Returned http error: " . $result;
        $output .= (!empty($response))? " Returned http content: " . $response : '';
        $this->lastErrorMessage = $output;
        $this->logError($output);
        return true;
    }

    public function createCase($case)
    {
        $curl = $this->_setupPostJsonRequest($this->makeUrl("cases"), $case);
        $response = $this->curlCall($curl);

        return ($response === false)? false : json_decode($response)->investigationId;
    }

    public function getCase($caseId, $entry = null)
    {
        $url = $this->makeUrl("cases/$caseId");
        if ($entry != null) {
            $url .= "/$entry";
        }
        $curl = $this->_setupGetRequest($url);
        $response = $this->curlCall($curl);

        return ($response === false)? false : json_decode($response);
    }

    public function closeCase($caseId)
    {
        $url = $this->makeUrl("cases/$caseId");
        $blob = array('status' => 'DISMISSED');
        $curl = $this->_setupPutJsonRequest($url, $blob);
        $response = $this->curlCall($curl);

        return ($response === false)? false : json_decode($response);
    }

    public function createGuarantee($guarantee)
    {
        $curl = $this->_setupPostJsonRequest($this->makeUrl("guarantees"), $guarantee);
        $response = $this->curlCall($curl);

        return ($response === false)? false : json_decode($response)->disposition;
    }

    public function cancelGuarantee($caseId)
    {
        $url = $this->makeUrl("cases/$caseId/guarantee");
        $blob = ['guaranteeDisposition' => 'CANCELED'];
        $curl = $this->_setupPutJsonRequest($url, $blob);
        $response = $this->curlCall($curl);

        return ($response === false)? false : json_decode($response)->disposition;
    }

    public function updatePayment($caseId, $paymentUpdate)
    {
        $url = $this->makeUrl("cases/$caseId");
        $blob = array("purchase" => $paymentUpdate);
        $curl = $this->_setupPutJsonRequest($url, $blob);
        $response = $this->curlCall($curl);

        return ($response === false)? false : true;
    }

    public function updateInvestigationLabel($caseId, $investigationUpdate)
    {
        $url = $this->makeUrl("cases/$caseId");
        $blob = array("reviewDisposition" => $investigationUpdate);
        $curl = $this->_setupPutJsonRequest($url, $blob);
        $response = $this->curlCall($curl);

        return ($response === false)? false : true;
    }

    public function createFulfillment($caseId, \Signifyd\Models\Fulfillment $fulfillment)
    {
        $fulfillments = ['fulfillments' => [$fulfillment]];
        $postBody = json_encode($fulfillments);
        $curl = $this->_setupPostRequest($this->makeUrl("fulfillments/{$caseId}"), $postBody, "application/json");
        $response = $this->curlCall($curl);

        return ($response === false)? false : json_decode($response)->fulfillments[0]->id;
    }

    public function validWebhookRequest($request, $hash, $topic)
    {
        $check = base64_encode(hash_hmac('sha256', $request, $this->settings->apiKey, true));
        $this->logInfo("Api request hash: " . $hash);
        $this->logInfo("Api request hash check: " . $check);

        if ($check == $hash) {
            return true;
        } else {
            if ($topic == "cases/test") {
            // In the case that this is a webhook test, the encoding ABCDE is allowed
            $check = base64_encode(hash_hmac('sha256', $request, 'ABCDE', true));
            if ($check == $hash) {
                return true;
            }
        }
        }

        return false;
    }

    private function _setupRequestCommon($url)
    {
        $curl = curl_init($url);

        if (stripos($url, 'https://') === 0) {
            curl_setopt($curl, CURLOPT_PORT, 443);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, $this->settings->timeout);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $this->settings->timeout);

        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, $this->settings->apiKey);

        return $curl;
    }

    private function _setupGetRequest($url)
    {
        $curl = $this->_setupRequestCommon($url);

        $headers = array();
        $headers[] = "Accept: application/json";
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        return $curl;
    }

    private function _setupPostRequest($url, $postBody, $contentType)
    {
        $curl = $this->_setupRequestCommon($url);
        $this->logInfo("Request post body: " . $postBody);

        $headers = array();
        $headers[] = "Accept: application/json";
        $headers[] = "Content-Type: $contentType";
        $headers[] = "Content-length: " . strlen($postBody);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postBody);

        return $curl;
    }

    private function _setupPutRequest($url, $postBody, $contentType)
    {
        $curl = $this->_setupRequestCommon($url);
        $this->logInfo("Request put body: " . $postBody);

        $headers = array();
        $headers[] = "Accept: application/json";
        $headers[] = "Content-Type: $contentType";
        $headers[] = "Content-length: " . strlen($postBody);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postBody);

        return $curl;
    }

    private function _setupPostJsonRequest($url, SignifydModel $data)
    {
        $postBody = $data->toJson();
        return $this->_setupPostRequest($url, $postBody, "application/json");
    }

    private function _setupPutJsonRequest($url, $data)
    {
        $postBody = json_encode($data);
        return $this->_setupPutRequest($url, $postBody, "application/json");
    }

    private function curlCall($curl)
    {
        $response = curl_exec($curl);
        $info = curl_getinfo($curl);
        $this->logInfo("Raw request: " . json_encode($info));
        $this->logInfo("Raw response: " . $response);
        $error = curl_error($curl);
        curl_close($curl);

        if ($this->checkResultError($info['http_code'], $response, $error)) {
            return false;
        }

        return $response;
    }
    
    public function getLastErrorMessage()
    {
        return $this->lastErrorMessage;
    }

}
