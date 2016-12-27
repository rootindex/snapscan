<?php
/**
 * Copyright (c) 2016 CoisIO. All rights reserved.
 */

namespace CoisIO\SnapScan\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface PaymentSearchResultInterface
 * @package CoisIO\SnapScan\Api\Data
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