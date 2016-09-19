<?php
/**
 * Copyright (c) 2016 Fontera Digital Works. All rights reserved.
 */

namespace FDW\SnapScan\Controller\Gateway;

use FDW\SnapScan\Api\Data\PaymentInterface;
use FDW\SnapScan\Api\Data\PaymentInterfaceFactory;
use FDW\SnapScan\Api\PaymentRepositoryInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Phrase;
use Magento\Framework\Webapi\Exception;
use Magento\Store\Model\ScopeInterface;
use Psr\Log\LoggerInterface;

/**
 * Class WebHook
 * @package FDW\SnapScan\Controller\Gateway
 */
class WebHook extends Action
{
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;
    /**
     * @var DataObjectHelper
     */
    private $dataObjectHelper;
    /**
     * @var PaymentRepositoryInterfaceFactory
     */
    private $paymentRepositoryFactory;
    /**
     * @var PaymentInterfaceFactory
     */
    private $paymentFactory;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Ping constructor.
     * @param Context $context
     * @param ScopeConfigInterface $scopeConfig
     * @param PaymentRepositoryInterfaceFactory $paymentRepositoryFactory
     * @param PaymentInterfaceFactory $paymentFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param LoggerInterface $logger
     */
    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig,
        PaymentRepositoryInterfaceFactory $paymentRepositoryFactory,
        PaymentInterfaceFactory $paymentFactory,
        DataObjectHelper $dataObjectHelper,
        LoggerInterface $logger
    ) {
        parent::__construct($context);
        $this->scopeConfig = $scopeConfig;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->paymentRepositoryFactory = $paymentRepositoryFactory;
        $this->paymentFactory = $paymentFactory;
        $this->logger = $logger;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     * @throws InputException
     */
    public function execute()
    {
        $payloadData = $this->getRequest()->getParam('payload');
        $token = $this->getRequest()->getParam('token');

        $this->logger->debug(json_encode([$payloadData, $token], 128));

        // Get admin value
        $configToken = $this
            ->scopeConfig
            ->getValue('payment/snapscan/callback_token', ScopeInterface::SCOPE_STORE);

        $error = [];

        if ($token !== $configToken) {
            $error[] = new Phrase('callback tokens does not match');
        }

        if (!$payloadData) {
            $error[] = new Phrase('payload not present');
        }

        $payload = json_decode($payloadData, true);

        foreach ($payload as $key => $value) {

            // set snapscan id
            if ($key === 'id') {
                $payload['snapscanId'] = $value;
            }

            // we wont be using the array types but lets keep it
            if (gettype($value) === 'array') {
                $payload[$key] = serialize($value);
            }

            // convert date to correct format
            if ($key === 'date') {
                $payload[$key] = date("Y-m-d H:m:s", strtotime($value));
            }

            // convert values from cents to rand
            if (gettype($value) === 'integer' && ($key !== 'id' || $key !== 'snapscanId')) {
                $payload[$key] = $value / 100;
            }
        }

        unset($payload['id']);

        /** @var \FDW\SnapScan\Api\PaymentRepositoryInterface $paymentRepository */
        $paymentRepository = $this->paymentRepositoryFactory->create();

        /** @var \FDW\SnapScan\Api\Data\PaymentInterface $paymentObject */
        $paymentObject = $this->paymentFactory->create();

        $this->dataObjectHelper->populateWithArray(
            $paymentObject,
            $payload,
            PaymentInterface::class
        );

        // If not exist add
        if (!$paymentRepository->getByMerchantReference($paymentObject->getMerchantReference())) {
            $paymentRepository->save($paymentObject);
        }

        /** @var \Magento\Framework\Controller\Result\Json $response */
        $response = $this->resultFactory->create(ResultFactory::TYPE_JSON);

        // Errors detected
        if (!empty($error)) {
            $response->setData(['message' => implode(", ", $error)]);
            $response->setHttpResponseCode(Exception::HTTP_BAD_REQUEST);
        }

        // No errors
        if (empty($error)) {
            $response->setData(['message' => 'completed', 'payload' => $payload]);
        }

        return $response;
    }
}
