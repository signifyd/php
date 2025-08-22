<?php

namespace Signifyd\Models;

use Signifyd\Core\Model;

/**
 * Class ReturnedItem
 */
class ReturnedItem
    extends Product
{
    /**
     * The reason that the buyer is making this attempt return for the item.
     *
     * @var string
     */
    public $reason;
    /**
     * Further information on the reason that the buyer is making this return for the item.
     *
     * @var string
     */
    public $subReason;

    protected $fields = [
        'reason',
        'subReason',
        'itemId',
        'itemName',
        'itemUrl',
        'itemImage',
        'itemQuantity',
        'itemPrice',
        'itemWeight',
        'itemIsDigital',
        'itemCategory',
        'itemSubCategory',
        'shipmentId',
        'subscription',
    ];

    /**
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * @param $reason
     * @return void
     */
    public function setReason($reason)
    {
        $this->reason = $reason;
    }

    /**
     * @return string
     */
    public function getSubReason()
    {
        return $this->subReason;
    }

    /**
     * @param $subReason
     * @return void
     */
    public function setSubReason($subReason)
    {
        $this->subReason = $subReason;
    }
}