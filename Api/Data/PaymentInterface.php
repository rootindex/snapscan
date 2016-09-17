<?php
/**
 * Copyright (c) 2016 Fontera Digital Works. All rights reserved.
 */

namespace FDW\SnapScan\Api\Data;

/**
 * Interface PaymentInterface
 * @package FDW\SnapScan\Api\Data
 * @api
 */
interface PaymentInterface
{
    /**#@+
     * Constants
     */
    const ID = 'id';
    const STATUS = 'status';
    const TOTAL_AMOUNT = 'total_amount';
    const TIP_AMOUNT = 'tip_amount';
    const FEE_AMOUNT = 'fee_amount';
    const SETTLE_AMOUNT = 'settle_amount';
    const REQUIRED_AMOUNT = 'required_amount';
    const DATE = 'date';
    const SNAP_CODE = 'snap_code';
    const SNAP_CODE_REFERENCE = 'snap_code_reference';
    const USER_REFERENCE = 'user_reference';
    const MERCHANT_REFERENCE = 'merchant_reference';
    const STATEMENT_REFERENCE = 'statement_reference';
    const AUTH_CODE = 'auth_code';
    const DELIVERY_ADDRESS = 'delivery_address';
    const EXTRA = 'extra';
    /**#@-*/

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     * @return PaymentInterface
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getStatus();

    /**
     * @param string $status
     * @return PaymentInterface
     */
    public function setStatus($status);

    /**
     * @return int
     */
    public function getTotalAmount();

    /**
     * @param int $totalAmount
     * @return PaymentInterface
     */
    public function setTotalAmount($totalAmount);

    /**
     * @return int
     */
    public function getTipAmount();

    /**
     * @param int $tipAmount
     * @return PaymentInterface
     */
    public function setTipAmount($tipAmount);

    /**
     * @return int
     */
    public function getFeeAmount();

    /**
     * @param int $feeAmount
     * @return PaymentInterface
     */
    public function setFeeAmount($feeAmount);

    /**
     * @return int
     */
    public function getSettleAmount();

    /**
     * @param int $settleAmount
     * @return PaymentInterface
     */
    public function setSettleAmount($settleAmount);

    /**
     * @return int
     */
    public function getRequiredAmount();

    /**
     * @param int $requiredAmount
     * @return PaymentInterface
     */
    public function setRequiredAmount($requiredAmount);

    /**
     * @return string
     */
    public function getDate();

    /**
     * @param string $date
     * @return PaymentInterface
     */
    public function setDate($date);

    /**
     * @return string
     */
    public function getSnapCode();

    /**
     * @param string $snapCode
     * @return PaymentInterface
     */
    public function setSnapCode($snapCode);

    /**
     * @return string
     */
    public function getSnapCodeReference();

    /**
     * @param string $snapCodeReference
     * @return PaymentInterface
     */
    public function setSnapCodeReference($snapCodeReference);

    /**
     * @return string
     */
    public function getUserReference();

    /**
     * @param string $userReference
     * @return PaymentInterface
     */
    public function setUserReference($userReference);

    /**
     * @return string
     */
    public function getMerchantReference();

    /**
     * @param string $merchantReference
     * @return PaymentInterface
     */
    public function setMerchantReference($merchantReference);

    /**
     * @return string
     */
    public function getStatementReference();

    /**
     * @param string $statementReference
     * @return PaymentInterface
     */
    public function setStatementReference($statementReference);

    /**
     * @return string
     */
    public function getAuthCode();

    /**
     * @param string $authCode
     * @return PaymentInterface
     */
    public function setAuthCode($authCode);

    /**
     * @return array
     */
    public function getDeliveryAddress();

    /**
     * @param array $deliveryAddress
     * @return PaymentInterface
     */
    public function setDeliveryAddress($deliveryAddress);

    /**
     * @return array
     */
    public function getExtra();

    /**
     * @param array $extra
     * @return PaymentInterface
     */
    public function setExtra($extra);
}