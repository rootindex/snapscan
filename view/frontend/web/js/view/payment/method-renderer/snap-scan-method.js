/*
 * Copyright © 2016 Fontera Digital Works. All rights reserved.
 * See LICENSE.md for license details.
 */

/*browser:true*/
/*global define*/
define(['Magento_Checkout/js/view/payment/default'],
    function (Component) {
        'use strict';
        return Component.extend({
            defaults: {
                template: 'FDW_SnapScan/payment/snap-scan'
            },
            /**
             * Get method code.
             *
             * @returns {string}
             */
            getCode: function () {
                return 'snapscan';
            },

            /**
             * Is active check.
             *
             * @returns {boolean}
             */
            isActive: function () {
                return true;
            },

            /**
             * Get qr code url
             *
             * @return {string}
             */
            getQRCodeUrl: function () {
                return this.getSnapChatApiUrl() + '/qr/' + this.getSnapCode()
                    + '.svg?id=10000001&amount=100&snap_code_size=' + this.getSnapCodeSize();
            },

            /**
             * Get snap chat api url.
             *
             * @return {string}
             */
            getSnapChatApiUrl: function () {
                return window.checkoutConfig.payment[this.getCode()].apiUrl;
            },

            /**
             *  Get snap code.
             *
             * @return {string}
             */
            getSnapCode: function () {
                return window.checkoutConfig.payment[this.getCode()].snapCode;
            },
            /**
             * Get snap code size
             * @return {integer}
             */
            getSnapCodeSize: function () {
                return window.checkoutConfig.payment[this.getCode()].snapCodeSize
            }
        });
    });