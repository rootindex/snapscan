<?php
/**
 * Copyright (c) 2016 Fontera Digital Works. All rights reserved.
 */

namespace FDW\SnapScan\Controller\Gateway;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Phrase;

/**
 * Class WebHook
 * @package FDW\SnapScan\Controller\Gateway
 */
class WebHook extends Action
{
    /**
     * Ping constructor.
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     * @throws InputException
     */
    public function execute()
    {
        $payloadData = $this->getRequest()->getParam('payload');
        $token = $this->getRequest()->getParam('token');

        // TODO make sure we validate against token.

        if (!$payloadData) {
            throw new InputException(new Phrase('Payload is not present.'));
        }

        $payload = json_decode($payloadData, true);

        // TODO: Update SnapScan table

        /** @var \Magento\Framework\Controller\Result\Json $response */
        $response = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $response->setData(['message' => 'Received payload', 'payload' => $payload, 'token' => $token]);

        return $response;
    }
}
