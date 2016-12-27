<?php
/**
 * Copyright (c) 2016 CoisIO. All rights reserved.
 */

namespace CoisIO\SnapScan\Model;

use CoisIO\SnapScan\Api\Data\PaymentInterface;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;

/**
 * Class Payment
 * @package CoisIO\SnapScan\Model
 */
class Payment extends AbstractModel implements PaymentInterface
{
    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'snapscan_payment';

    /**
     * Parameter name in event.
     *
     * In observe method you can use $observer->getEvent()->getSnapscanPayment()
     *
     * @var string
     */
    protected $_eventObject = 'snapscan_payment';

    /**
     * Payment constructor.
     *
     * @param Context $context
     * @param Registry $registry
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        array $data = []
    )
    {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel\Payment::class);
    }

    /**
     * @return int
     */
    public function getSnapscanId()
    {
        return $this->getData(PaymentInterface::SNAPSCAN_ID);
    }

    /**
     * @param int $snapScanId
     * @return PaymentInterface
     */
    public function setSnapscanId($snapScanId)
    {
        return $this->setData(PaymentInterface::SNAPSCAN_ID, $snapScanId);
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->getData(PaymentInterface::STATUS);
    }

    /**
     * @param string $status
     * @return PaymentInterface
     */
    public function setStatus($status)
    {
        return $this->setData(PaymentInterface::STATUS, $status);
    }

    /**
     * @return int
     */
    public function getTotalAmount()
    {
        return $this->getData(PaymentInterface::TOTAL_AMOUNT);
    }

    /**
     * @param int $totalAmount
     * @return PaymentInterface
     */
    public function setTotalAmount($totalAmount)
    {
        return $this->setData(PaymentInterface::TOTAL_AMOUNT, $totalAmount);
    }

    /**
     * @return int
     */
    public function getTipAmount()
    {
        return $this->getData(PaymentInterface::TIP_AMOUNT);
    }

    /**
     * @param int $tipAmount
     * @return PaymentInterface
     */
    public function setTipAmount($tipAmount)
    {
        return $this->setData(PaymentInterface::TIP_AMOUNT, $tipAmount);
    }

    /**
     * @return int
     */
    public function getFeeAmount()
    {
        return $this->getData(PaymentInterface::FEE_AMOUNT);
    }

    /**
     * @param int $feeAmount
     * @return PaymentInterface
     */
    public function setFeeAmount($feeAmount)
    {
        return $this->setData(PaymentInterface::FEE_AMOUNT, $feeAmount);
    }

    /**
     * @return int
     */
    public function getSettleAmount()
    {
        return $this->getData(PaymentInterface::SETTLE_AMOUNT);
    }

    /**
     * @param int $settleAmount
     * @return PaymentInterface
     */
    public function setSettleAmount($settleAmount)
    {
        return $this->setData(PaymentInterface::SETTLE_AMOUNT, $settleAmount);
    }

    /**
     * @return int
     */
    public function getRequiredAmount()
    {
        return $this->getData(PaymentInterface::REQUIRED_AMOUNT);
    }

    /**
     * @param int $requiredAmount
     * @return PaymentInterface
     */
    public function setRequiredAmount($requiredAmount)
    {
        return $this->setData(PaymentInterface::REQUIRED_AMOUNT, $requiredAmount);
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->getData(PaymentInterface::DATE);
    }

    /**
     * @param string $date
     * @return PaymentInterface
     */
    public function setDate($date)
    {
        return $this->setData(PaymentInterface::DATE, $date);
    }

    /**
     * @return string
     */
    public function getSnapCode()
    {
        return $this->getData(PaymentInterface::SNAP_CODE);
    }

    /**
     * @param string $snapCode
     * @return PaymentInterface
     */
    public function setSnapCode($snapCode)
    {
        return $this->setData(PaymentInterface::SNAP_CODE, $snapCode);
    }

    /**
     * @return string
     */
    public function getSnapCodeReference()
    {
        return $this->getData(PaymentInterface::SNAP_CODE_REFERENCE);
    }

    /**
     * @param string $snapCodeReference
     * @return PaymentInterface
     */
    public function setSnapCodeReference($snapCodeReference)
    {
        return $this->setData(PaymentInterface::SNAP_CODE_REFERENCE, $snapCodeReference);
    }

    /**
     * @return string
     */
    public function getUserReference()
    {
        return $this->getData(PaymentInterface::USER_REFERENCE);
    }

    /**
     * @param string $userReference
     * @return PaymentInterface
     */
    public function setUserReference($userReference)
    {
        return $this->setData(PaymentInterface::USER_REFERENCE, $userReference);
    }

    /**
     * @return string
     */
    public function getMerchantReference()
    {
        return $this->getData(PaymentInterface::MERCHANT_REFERENCE);
    }

    /**
     * @param string $merchantReference
     * @return PaymentInterface
     */
    public function setMerchantReference($merchantReference)
    {
        return $this->setData(PaymentInterface::MERCHANT_REFERENCE, $merchantReference);
    }

    /**
     * @return string
     */
    public function getStatementReference()
    {
        return $this->getData(PaymentInterface::STATEMENT_REFERENCE);
    }

    /**
     * @param string $statementReference
     * @return PaymentInterface
     */
    public function setStatementReference($statementReference)
    {
        return $this->setData(PaymentInterface::STATEMENT_REFERENCE, $statementReference);
    }

    /**
     * @return string
     */
    public function getAuthCode()
    {
        return $this->getData(PaymentInterface::AUTH_CODE);
    }

    /**
     * @param string $authCode
     * @return PaymentInterface
     */
    public function setAuthCode($authCode)
    {
        return $this->setData(PaymentInterface::AUTH_CODE, $authCode);
    }

    /**
     * @return string
     */
    public function getDeliveryAddress()
    {
        return $this->getData(PaymentInterface::DELIVERY_ADDRESS);
    }

    /**
     * @param string $deliveryAddress
     * @return PaymentInterface
     */
    public function setDeliveryAddress($deliveryAddress)
    {
        return $this->setData(PaymentInterface::DELIVERY_ADDRESS, $deliveryAddress);
    }

    /**
     * @return string
     */
    public function getExtra()
    {
        return $this->getData(PaymentInterface::EXTRA);
    }

    /**
     * @param string $extra
     * @return PaymentInterface
     */
    public function setExtra($extra)
    {
        return $this->setData(PaymentInterface::EXTRA, $extra);
    }
}