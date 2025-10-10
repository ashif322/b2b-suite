<?php

return [
    [
        'key'   => 'account.requisitions',
        'name'  => 'b2b_suite::app.shop.acl.requisitions',
        'route' => 'shop.customers.account.requisitions.index',
        'icon'  => 'icon-heart-fill',
        'sort'  => 8,
    ], [
        'key'   => 'account.quotes',
        'name'  => 'b2b_suite::app.shop.acl.quotes',
        'route' => 'shop.customers.account.quotes.index',
        'icon'  => 'icon-listing',
        'sort'  => 9,
    ], [
        'key'   => 'account.purchase_orders',
        'name'  => 'b2b_suite::app.shop.acl.purchase-orders',
        'route' => 'shop.customers.account.purchase_orders.index',
        'icon'  => 'icon-dollar-sign',
        'sort'  => 10,
    ], [
        'key'   => 'account.quick_orders',
        'name'  => 'b2b_suite::app.shop.acl.quick-orders',
        'route' => 'shop.customers.account.quick_orders.index',
        'icon'  => 'icon-product',
        'sort'  => 11,
    ], [
        'key'   => 'account.users',
        'name'  => 'b2b_suite::app.shop.acl.users',
        'route' => 'shop.customers.account.users.index',
        'icon'  => 'icon-users',
        'sort'  => 12,
    ], [
        'key'   => 'account.roles',
        'name'  => 'b2b_suite::app.shop.acl.roles',
        'route' => 'shop.customers.account.roles.index',
        'icon'  => 'icon-uncheck',
        'sort'  => 13,
    ],
];
