<?php
/**
 * Copyright © 2016 CoisIO. All rights reserved.
 * See LICENSE.md for license details.
 */

namespace CoisIO\SnapScan\Model\Ui;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Payment\Gateway\Config\Config;

/**
 * Class SnapScanConfigProvider
 * @package CoisIO\SnapScan\Model\Ui
 */
class SnapScanConfigProvider implements ConfigProviderInterface
{
    const CODE = 'snapscan';

    /**
     * @var Config
     */
    private $config;

    /**
     * SnapScanConfigProvider constructor.
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * Retrieve assoc array of checkout configuration
     *
     * @return array
     */
    public function getConfig()
    {
        return [
            'payment' => [
                self::CODE => [
                    'isActive' => $this->config->getValue('active'),
                    'snapCode' => $this->config->getValue('merchant_id'),
                    'snapCodeSize' => $this->config->getValue('snap_code_size'),
                    'apiUrl' => $this->config->getValue('api_url')
                ]
            ]
        ];
    }
}
