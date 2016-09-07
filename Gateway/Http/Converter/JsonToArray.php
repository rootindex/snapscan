<?php
/**
 * Copyright © 2016 Fontera Digital Works. All rights reserved.
 * See LICENSE.md for license details.
 */

namespace FDW\SnapScan\Gateway\Http\Converter;

use Magento\Payment\Gateway\Http\ConverterException;
use Magento\Payment\Gateway\Http\ConverterInterface;

/**
 * Class JsonToArray
 * @package FDW\SnapScan\Gateway\Http\Converter
 */
class JsonToArray implements ConverterInterface
{
    /**
     * Converts gateway response to ENV structure
     *
     * @param mixed $response
     * @return array
     * @throws ConverterException
     */
    public function convert($response)
    {
        if (!is_string($response)) {
            throw new ConverterException(__('Wrong response type'));
        }
        return json_decode($response, true);
    }
}
