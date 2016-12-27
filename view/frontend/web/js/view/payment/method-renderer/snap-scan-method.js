/*
 * Copyright © 2016 CoisIO. All rights reserved.
 * See LICENSE.md for license details.
 */

/*browser: true*/
/*global define,window,console*/
define(
    [
        'jquery',
        'Magento_Checkout/js/view/payment/default',
        'Magento_Checkout/js/model/quote'
    ],
    function ($, Component, quote) {
        'use strict';
        return Component.extend({
            snapScanPaymentTimerContinue: true,
            defaults: {
                template: 'CoisIO_SnapScan/payment/snap-scan'
            },
            /**
             * Initialize.
             * @private
             */
            initialize: function () {
                var self = this;
                this._super();
                // @TODO add in this logic to a smooth customer experience
                // this.snapScanPaymentTimer();
                this.snapScanPaymentTimerContinue = false;
            },
            /**
             * Get payment method data
             */
            getData: function () {
                return {
                    'method': this.item.method,
                    'po_number': null,
                    'additional_data': {
                        quoteId: quote.getQuoteId()
                    }
                };
            },
            /**
             * Get method code.
             *
             * @returns {String}
             */
            getCode: function () {
                return 'snapscan';
            },
            /**
             * Is active check.
             *
             * @returns {Boolean}
             */
            isActive: function () {
                return true;
            },
            /**
             * Validate that we have an auth code
             * @return {Boolean}
             */
            validate: function () {
                return this.getSnapScanForm().validation() && this.getSnapScanForm().validation('isValid');
            },
            /**
             * Payment timer.
             */
            snapScanPaymentTimer: function () {
                setTimeout($.proxy(function () {
                    // complete code here
                    console.log("CoisIO_SnapScan/payment/snap-scan running:" + Math.random());
                    if (this.snapScanPaymentTimerContinue) {
                        this.snapScanPaymentTimer();
                    }
                }, this), 60000);
            },
            /**
             * Get qr code url
             *
             * @return {String}
             */
            getQRCodeUrl: function () {
                var total = 0;
                // attempt to read normal grant total
                if (this.getTotalsValue('quote_currency_code') === 'ZAR') {
                    // convert to cents
                    total = this.getTotalsValue('grand_total') * 100;
                }
                // fall back to base
                if (this.getTotalsValue('base_currency_code') === 'ZAR') {
                    // convert to cents
                    total = this.getTotalsValue('base_grand_total') * 100;
                }

                // just in case we did not have ZAR as an available currency
                if (total === 0) {
                    return 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';
                }
                //var baseTotals = quote.totals.base_grand_total * 100;
                return this.getSnapChatApiUrl() + '/qr/' + this.getSnapCode() + '.svg?id=' + quote.getQuoteId()
                    + '&amount=' + total + '&snap_code_size=' + this.getSnapCodeSize() + '&strict=true';
            },
            /**
             * Get the snap scan form.
             *
             * @return {*|jQuery|HTMLElement}
             */
            getSnapScanForm: function () {
                return $('#' + this.getCode() + '-form');
            },
            /**
             * Get total value
             * @param key
             * @return {*}
             */
            getTotalsValue: function (key) {
                var totals = quote.totals();
                return totals[key];
            },
            /**
             * Get snap chat api url.
             *
             * @return {String}
             */
            getSnapChatApiUrl: function () {
                return this.getConfigValue('apiUrl');
            },
            /**
             *  Get snap code.
             *
             * @return {String}
             */
            getSnapCode: function () {
                return this.getConfigValue('snapCode');
            },
            /**
             * Get snap code size
             * @return {String}
             */
            getSnapCodeSize: function () {
                return this.getConfigValue('snapCodeSize');
            },
            /**
             * Get payment method config value.
             *
             * @param {String} key
             * @return {String}
             */
            getConfigValue: function (key) {
                return window.checkoutConfig.payment[this.getCode()][key];
            }
        });
    });