<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace FDW\SnapScan\Gateway\Response;

use Magento\Payment\Gateway\Data\PaymentDataObjectInterface;
use Magento\Payment\Gateway\Response\HandlerInterface;

/**
 * Class TxnIdHandler
 * @package FDW\SnapScan\Gateway\Response
 */
class TxnIdHandler implements HandlerInterface
{
    const TXN_ID = 'id';

    /**
     * Handles transaction id
     *
     * @param array $handlingSubject
     * @param array $response
     * @return void
     */
    public function handle(array $handlingSubject, array $response)
    {
        if (!isset($handlingSubject['payment'])
            || !$handlingSubject['payment'] instanceof PaymentDataObjectInterface
        ) {
            throw new \InvalidArgumentException('Payment data object should be provided');
        }

        /** @var PaymentDataObjectInterface $paymentDO */
        $paymentDO = $handlingSubject['payment'];
        /** @var $payment \Magento\Sales\Model\Order\Payment */
        $payment = $paymentDO->getPayment();
        $payment->setTransactionId('SnapScan-Id: ' . $response[0][self::TXN_ID]);
        // get totals paid
        $amountPaid = 0;

        // record if the user overpaid
        foreach ($response as $snapScanTransaction) {
            $amountPaid += $snapScanTransaction['totalAmount'];
        }

        $payment->setAmountPaid($amountPaid);
        $payment->setIsTransactionClosed(true);
    }
}
