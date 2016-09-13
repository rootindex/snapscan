<?php
/**
 * Copyright (c) 2016 Fontera Digital Works. All rights reserved.
 */

namespace FDW\SnapScan\Controller\Gateway;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;

/**
 * Class Ping
 * @package FDW\SnapScan\Controller\Gateway
 */
class Ping extends Action
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
     * Dispatch request
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        //$response = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        //$response->setData(['paymentMethodNonce' => 'tested']);
        return []; //$response;
    }
}