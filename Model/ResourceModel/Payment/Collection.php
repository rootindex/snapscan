<?php
/**
 * Copyright (c) 2016 Fontera Digital Works. All rights reserved.
 */

namespace FDW\SnapScan\Model\ResourceModel\Payment;

use FDW\SnapScan\Model\Payment;
use FDW\SnapScan\Model\ResourceModel\Payment as PaymentResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package FDW\SnapScan\Model\ResourceModel\Payment
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