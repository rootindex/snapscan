/*
 * Copyright © 2016 Fontera Digital Works. All rights reserved.
 * See LICENSE.md for license details.
 */

/*browser:true*/
/*global define*/
define(['uiComponent', 'Magento_Checkout/js/model/payment/renderer-list'],
    function (Component, rendererList) {
        'use strict';
        rendererList.push(
            {
                type: 'snapscan',
                component: 'FDW_SnapScan/js/view/payment/method-renderer/snap-scan-method'
            }
        );
        return Component.extend({});
    }
);