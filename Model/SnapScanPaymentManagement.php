<?php
/**
 * Copyright © 2016 Fontera Digital Works. All rights reserved.
 * See LICENSE.md for license details.
 */

namespace FDW\SnapScan\Model;

use FDW\SnapScan\Api\SnapScanPaymentManagementInterface;
use Psr\Log\LoggerInterface;

/**
 * Class SnapScanPaymentManagement
 * @package FDW\SnapScan\Model
 */
class SnapScanPaymentManagement implements SnapScanPaymentManagementInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * SnapScanPaymentManagement constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function savePaymentInformation($tokenId, $payload)
    {
        $this->logger->critical($tokenId);
    }
}