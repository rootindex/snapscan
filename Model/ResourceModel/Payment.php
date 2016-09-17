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
     * @param RelationComposite $relationComposite
     * @param null $connectionName
     */
    public function __construct(
        Context $context,
        Snapshot $snapshot,
        RelationComposite $relationComposite,
        $connectionName = null
    ) {
        parent::__construct($context, $snapshot, $relationComposite, $connectionName);
    }

    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('snapscan_payment', 'id');
    }
}