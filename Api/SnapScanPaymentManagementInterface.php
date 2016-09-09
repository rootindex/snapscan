<?php
/**
 * Copyright © 2016 Fontera Digital Works. All rights reserved.
 * See LICENSE.md for license details.
 */

namespace FDW\SnapScan\Api;

/**
 * Interface SnapScanPaymentManagementInterface
 * @package FDW\SnapScan\Api
 */
interface SnapScanPaymentManagementInterface
{
    public function savePaymentInformation(
        $tokenId,
        $payload
        //\Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
    );
}