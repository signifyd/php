<?php

namespace Signifyd\Models\Payment;

abstract class AbstractGateway implements GatewayInterface
{
    /**
     * Default parameter for integration
     * 
     * @var string[]
     */
    protected $params = [
        'environment' => 'production'
    ];

    /**
     * Associative array for environment => API URL
     * 
     * @var string[]
     */
    protected $urls = [
        'production' => '',
        'sandbox' => ''
    ];

    /**
     * Array to store responses per API call to avoid calls to API to fetch same information
     * 
     * @var array 
     */
    protected $responses = [];

    /**
     * AbstractGateway constructor.
     * @param array $params
     */
    public function __construct(array $params)
    {
        $this->params = array_merge($this->params, $params);

        if (empty($this->params['url'])) {
            $this->params['url'] = $this->urls[$this->params['environment']];
        }
    }
}