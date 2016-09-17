<?php
/**
 * Copyright (c) 2016 Fontera Digital Works. All rights reserved.
 */

namespace FDW\SnapScan\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface PaymentSearchResultInterface
 * @package FDW\SnapScan\Api\Data
 * @api
 */
interface PaymentSearchResultInterface extends SearchResultsInterface
{
    /**
     * Get payments list.
     *
     * @return PaymentInterface[]
     */
    public function getItems();

    /**
     * Set payments list.
     *
     * @param PaymentInterface[] $items
     * @return $this
     */
    public function setItems(array $items = null);
}