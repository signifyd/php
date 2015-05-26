<?php
namespace core;

class SignifydAPI
{
    const URI_BASE = "https://api.signifyd.com/v2/";
    private $settings;

    private function logError($message)
    {
        if($this->settings->logErrors)
        {
            call_user_func($this->settings->loggerError, $message);
        }
    }

    private function logWarning($message)
    {
        if($this->settings->logWarnings)
        {
            call_user_func($this->settings->loggerWarning, $message);
        }
    }

    private function logInfo($message)
    {
        if($this->settings->logInfo)
        {
            call_user_func($this->settings->loggerInfo, $message);
        }
    }

    public function __construct(SignifydSettings $settings)
    {
        if(is_null($settings->apiKey))
        {
            throw new Exception("API key is required.");
        }
        $this->settings = $settings;
    }

    public function createCase($case)
    {
        $curl = $this->_setupPostJsonRequest(SignifydAPI::URI_BASE."cases", $case);
        $response = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);

        if($info['http_code'] != 201)
        {
            // TODO We may want to throw an exception here
            $this->logError("Returned http error: ".$info['http_code']);
            return false;
        }
        return json_decode($response)->investigationId;
    }

    public function getCase($caseId, $entry = null)
    {
        $url = SignifydAPI::URI_BASE."cases/$caseId";
        if($entry != null)
        {
            $url .= "/$entry";
        }
        $curl = $this->_setupGetRequest($url);
        $response = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);
        if($info['http_code'] != 200)
        {
            $this->logError("Returned http error: ".$info['http_code']);
            return false;
        }
        return json_decode($response);
    }

    private function _setupRequestCommon($url)
    {
        $curl = curl_init($url);

        if (stripos($url, 'https://') === 0)
        {
            curl_setopt($curl, CURLOPT_PORT, 443);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, $this->settings->timeout);

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

        $headers = array();
        $headers[] = "Accept: application/json";
        $headers[] = "Content-Type: $contentType";
        $headers[] = "Content-length: ".strlen($postBody);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postBody);

        return $curl;
    }

    private function _setupPostJsonRequest($url, $data)
    {
        $postBody = $data->toJson();
        return $this->_setupPostRequest($url, $postBody, "application/json");
    }
}