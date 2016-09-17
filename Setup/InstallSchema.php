<?php
/**
 * Copyright (c) 2016 Fontera Digital Works. All rights reserved.
 */

namespace FDW\SnapScan\Setup;

use FDW\SnapScan\Api\Data\PaymentInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class InstallSchema
 * @package FDW\SnapScan\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        /**
         * Create table snapscan_payment
         */
        $table = $installer
            ->getConnection()
            ->newTable($installer->getTable('snapscan_payment'))
            ->addColumn(
                PaymentInterface::ID,
                Table::TYPE_INTEGER,
                null,
                ['nullable' => false, 'primary' => true],
                'Payment Id'
            )->addColumn(
                PaymentInterface::STATUS,
                Table::TYPE_TEXT,
                16,
                ['nullable' => false],
                'Status'
            )->addColumn(
                PaymentInterface::TOTAL_AMOUNT,
                Table::TYPE_DECIMAL,
                '12,4',
                ['nullable' => false, 'default' => '0.0000'],
                'Total Amount'
            )->addColumn(
                PaymentInterface::TIP_AMOUNT,
                Table::TYPE_DECIMAL,
                '12,4',
                ['nullable' => false, 'default' => '0.0000'],
                'Tip Amount'
            )->addColumn(
                PaymentInterface::FEE_AMOUNT,
                Table::TYPE_DECIMAL,
                '12,4',
                ['nullable' => false, 'default' => '0.0000'],
                'Fee Amount'
            )->addColumn(
                PaymentInterface::SETTLE_AMOUNT,
                Table::TYPE_DECIMAL,
                '12,4',
                ['nullable' => false, 'default' => '0.0000'],
                'Settle Amount'
            )->addColumn(
                PaymentInterface::REQUIRED_AMOUNT,
                Table::TYPE_DECIMAL,
                '12,4',
                ['nullable' => false, 'default' => '0.0000'],
                'Required Amount'
            )->addColumn(
                PaymentInterface::DATE,
                Table::TYPE_DATETIME,
                '12,4',
                ['nullable' => false, 'default' => '0.0000'],
                'Date'
            )->addColumn(
                PaymentInterface::SNAP_CODE,
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Snap Code'
            )->addColumn(
                PaymentInterface::SNAP_CODE_REFERENCE,
                Table::TYPE_TEXT,
                255,
                [],
                'Snap Code Reference'
            )->addColumn(
                PaymentInterface::USER_REFERENCE,
                Table::TYPE_TEXT,
                255,
                [],
                'User Reference'
            )->addColumn(
                PaymentInterface::STATEMENT_REFERENCE,
                Table::TYPE_TEXT,
                255,
                [],
                'Statement Reference'
            )->addColumn(
                PaymentInterface::AUTH_CODE,
                Table::TYPE_TEXT,
                255,
                [],
                'Auth Code'
            )->addColumn(
                PaymentInterface::DELIVERY_ADDRESS,
                Table::TYPE_TEXT,
                255,
                [],
                'Delivery Address'
            )->addColumn(
                PaymentInterface::EXTRA,
                Table::TYPE_TEXT,
                255,
                [],
                'Extra'
            )->setComment(
                'Snapscan Payment'
            );
        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}