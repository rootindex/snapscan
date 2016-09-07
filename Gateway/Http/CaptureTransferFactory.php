<?php
/**
 * Copyright © 2016 Fontera Digital Works. All rights reserved.
 * See LICENSE.md for license details.
 */
namespace FDW\SnapScan\Gateway\Http;

use Magento\Payment\Gateway\ConfigInterface;
use Magento\Payment\Gateway\Http\TransferBuilder;
use Magento\Payment\Gateway\Http\TransferFactoryInterface;
use Magento\Payment\Gateway\Http\TransferInterface;

/**
 * Class CaptureTransferFactory
 * @package FDW\SnapScan\Gateway\Http
 */
class CaptureTransferFactory implements TransferFactoryInterface
{
    /**
     * @var TransferBuilder
     */
    private $transferBuilder;
    /**
     * @var ConfigInterface
     */
    private $config;

    /**
     * @param TransferBuilder $transferBuilder
     * @param ConfigInterface $config
     */
    public function __construct(
        TransferBuilder $transferBuilder,
        ConfigInterface $config
    ) {
        $this->transferBuilder = $transferBuilder;
        $this->config = $config;
    }

    /**
     * Builds gateway transfer object
     *
     * @param array $request
     * @return TransferInterface
     */
    public function create(array $request)
    {
        return $this->transferBuilder
            ->setBody($request)
            ->setAuthUsername($this->config->getValue('api_key'))
            ->setUri(rtrim($this->config->getValue('api_url'), '/') . '/merchant/api/v1/payments/')
            ->setMethod('GET')
            ->build();
    }
}
