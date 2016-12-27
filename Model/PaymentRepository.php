<?php
/**
 * Copyright (c) 2016 CoisIO. All rights reserved.
 */

namespace CoisIO\SnapScan\Model;

use CoisIO\SnapScan\Api\Data;
use CoisIO\SnapScan\Api\PaymentRepositoryInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;

/**
 * Class PaymentRepository
 * @package CoisIO\SnapScan\Model
 */
class PaymentRepository implements PaymentRepositoryInterface
{
    /**
     * @var ResourceModel\Payment
     */
    private $resource;
    /**
     * @var PaymentFactory
     */
    private $paymentFactory;
    /**
     * @var Data\PaymentSearchResultInterfaceFactory
     */
    private $searchResultsFactory;
    /**
     * @var ResourceModel\Payment\CollectionFactory
     */
    private $paymentCollectionFactory;
    /**
     * @var Data\PaymentInterfaceFactory
     */
    private $dataPaymentFactory;
    /**
     * @var DataObjectHelper
     */
    private $dataObjectHelper;
    /**
     * @var DataObjectProcessor
     */
    private $dataObjectProcessor;

    /**
     * PaymentRepository constructor.
     * @param ResourceModel\Payment $resource
     * @param PaymentFactory $paymentFactory
     * @param Data\PaymentInterfaceFactory $dataPaymentFactory
     * @param Data\PaymentSearchResultInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param ResourceModel\Payment\CollectionFactory $paymentCollectionFactory
     */
    public function __construct(
        ResourceModel\Payment $resource,
        PaymentFactory $paymentFactory,
        Data\PaymentInterfaceFactory $dataPaymentFactory,
        Data\PaymentSearchResultInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        ResourceModel\Payment\CollectionFactory $paymentCollectionFactory
    ) {

        $this->resource = $resource;
        $this->paymentFactory = $paymentFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->paymentCollectionFactory = $paymentCollectionFactory;
        $this->dataPaymentFactory = $dataPaymentFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataObjectProcessor = $dataObjectProcessor;
    }

    /**
     * Save payment.
     *
     * @param Data\PaymentInterface $payment
     * @return Data\PaymentInterface
     * @throws LocalizedException
     */
    public function save(Data\PaymentInterface $payment)
    {
        try {
            $this->resource->save($payment);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $payment;
    }

    /**
     * Get payment by id.
     *
     * @param int $paymentId
     * @return Data\PaymentInterface
     * @throws LocalizedException
     */
    public function getById($paymentId)
    {
        /** @var Payment $payment */
        $payment = $this->paymentFactory->create();
        $this->resource->load($payment, $paymentId);

        if (!$payment->getId()) {
            throw new NoSuchEntityException(__('Payment with id "%1" does not exist.', $paymentId));
        }
        return $payment;
    }

    /**
     * Get payment by merchant reference.
     *
     * @param string $merchantReference
     * @return Data\PaymentInterface|boolean
     */
    public function getByMerchantReference($merchantReference)
    {
        /** @var Payment $payment */
        $payment = $this->paymentFactory->create();
        $this->resource->load($payment, $merchantReference, Data\PaymentInterface::MERCHANT_REFERENCE);

        if (!$payment->getId()) {
            return false;
        }

        return true;
    }

    /**
     * Get payment list matching search criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return Data\PaymentSearchResultInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var Data\PaymentSearchResultInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);

        /** @var ResourceModel\Payment\Collection $collection */
        $collection = $this->paymentCollectionFactory->create();

        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }

        $searchResults->setTotalCount($collection->getSize());
        $sortOrders = $searchCriteria->getSortOrders();

        if ($sortOrders) {
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }

        $collection->setCurPage($searchCriteria->getCurrentPage());
        $collection->setPageSize($searchCriteria->getPageSize());

        $payments = [];
        /** @var Payment $paymentModel */
        foreach ($collection as $paymentModel) {
            /** @var Data\PaymentInterface $paymentData */
            $paymentData = $this->dataPaymentFactory->create();
            $this->dataObjectHelper->populateWithArray(
                $paymentData,
                $paymentModel->getData(),
                Data\PaymentInterface::class
            );
            $payments[] = $this->dataObjectProcessor->buildOutputDataArray($paymentData, Data\PaymentInterface::class);
        }
        $searchResults->setItems($payments);
        return $searchResults;
    }
}