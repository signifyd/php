<?php

namespace Signifyd\Core\Response;

class ReturnResponse extends SaleResponse
{
    /**
     * Unique identifier for the Attempt Return.
     *
     * @var string
     */
    public $returnId;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'signifydId',
        'orderId',
        'decision',
        'coverage',
        'messages',
        'traceId',
        'returnId',
    ];

    /**
     * @return string
     */
    public function getReturnId()
    {
        return $this->returnId;
    }

    /**
     * @param $returnId
     * @return void
     */
    public function setReturnId($returnId)
    {
        $this->returnId = $returnId;
    }
}
