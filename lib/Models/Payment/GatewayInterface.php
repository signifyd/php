<?php

namespace Signifyd\Models\Payment;

use Signifyd\Models\Payment\Response\ResponseInterface;

interface GatewayInterface
{
    /**
     * GatewayInterface constructor.
     * @param array $params
     */
    public function __construct(array $params);

    /**
     * Given a transaction ID this method should return a ResponseInterface object
     * 
     * @param $transactionId
     * @return ResponseInterface
     */
    public function fetchData($transactionId);
}