<?php
/**
 * Copyright (c) 2016 CoisIO. All rights reserved.
 */

namespace CoisIO\SnapScan\Model\ResourceModel\Payment;

use CoisIO\SnapScan\Model\Payment;
use CoisIO\SnapScan\Model\ResourceModel\Payment as PaymentResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package CoisIO\SnapScan\Model\ResourceModel\Payment
 */
class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';

    /**
     * Define resource model
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init(Payment::class, PaymentResource::class);
    }
}