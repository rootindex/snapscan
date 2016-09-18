<?php
/**
 * Copyright (c) 2016 Fontera Digital Works. All rights reserved.
 */

namespace FDW\SnapScan\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Framework\Model\ResourceModel\Db\VersionControl\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\VersionControl\RelationComposite;
use Magento\Framework\Model\ResourceModel\Db\VersionControl\Snapshot;

/**
 * Class Payment
 * @package FDW\SnapScan\Model\ResourceModel
 */
class Payment extends AbstractDb
{
    /**
     * Payment constructor.
     * @param Context $context
     * @param Snapshot $snapshot
     * @param RelationComposite $relation
     * @param null $conn
     */
    public function __construct(Context $context, Snapshot $snapshot, RelationComposite $relation, $conn = null) {
        parent::__construct($context, $snapshot, $relation, $conn);
    }

    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('snapscan_payment', 'entity_id');
    }
}