<?php
/**
 * Copyright © 2016 CoisIO. All rights reserved.
 * See LICENSE.md for license details.
 */

namespace CoisIO\SnapScan\Observer;

use Magento\Framework\DataObject;
use Magento\Framework\Event\Observer;
use Magento\Framework\Exception\LocalizedException;
use Magento\Payment\Observer\AbstractDataAssignObserver;
use Magento\Quote\Api\Data\PaymentInterface;
use Magento\Payment\Model\InfoInterface;

/**
 * Class DataAssignObserver
 * @package CoisIO\SnapScan\Observer
 */
class DataAssignObserver extends AbstractDataAssignObserver
{
    /**
     * Hook into event.
     *
     * @param Observer $observer
     * @throws LocalizedException
     */
    public function execute(Observer $observer)
    {
        $data = $this->readDataArgument($observer);

        $additionalData = $data->getData(PaymentInterface::KEY_ADDITIONAL_DATA);

        if (!is_array($additionalData)) {
            return;
        }

        $additionalData = new DataObject($additionalData);
        $paymentMethod = $this->readMethodArgument($observer);

        $payment = $observer->getPaymentModel();

        // legacy support.
        if (!$payment instanceof InfoInterface) {
            $payment = $paymentMethod->getInfoInstance();
        }

        if (!$payment instanceof InfoInterface) {
            throw new LocalizedException(__('Payment model not provided.'));
        }
        $payment->setAdditionalInformation('quoteId', $additionalData->getData('quoteId'));
    }
}
