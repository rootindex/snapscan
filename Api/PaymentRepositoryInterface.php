<?php
/**
 * Copyright (c) 2016 Fontera Digital Works. All rights reserved.
 */

namespace FDW\SnapScan\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Interface PaymentRepositoryInterface.
 * @package FDW\SnapScan\Api
 * @api
 */
interface PaymentRepositoryInterface
{
    /**
     * Save payment.
     *
     * @param Data\PaymentInterface $payment
     * @return Data\PaymentInterface
     * @throws LocalizedException
     */
    public function save(Data\PaymentInterface $payment);

    /**
     * Get payment by id.
     *
     * @param int $paymentId
     * @return Data\PaymentInterface
     * @throws LocalizedException
     */
    public function getById($paymentId);

    /**
     * Get payment by merchant reference.
     *
     * @param string $merchantReference
     * @return Data\PaymentInterface
     * @throws LocalizedException
     */
    public function getByMerchantReference($merchantReference);

    /**
     * Get payment list matching search criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return Data\PaymentSearchResultInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}