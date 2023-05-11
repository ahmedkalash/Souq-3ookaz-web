<?php

namespace App\View;

class ViewPath
{
    const HOME_PAGE = 'customer-end.home.home';
    const MASTER = 'customer-end.layouts.master';
    const VIEW_PRODUCT = 'customer-end.product.view-product';
    const BROWSE_PRODUCTS = 'customer-end.product.browse-products';
    const LOGIN = 'customer-end.auth.login';
    const REGISTER = 'customer-end.auth.sign-up';
    const CART = 'customer-end.cart.cart';
    const PAGE_NOT_FOUND = 'errors.404';
    const CHECK_OUT = 'customer-end.order.checkout';
    const ORDER_SUCCESS = 'customer-end.order.order-success';

    //includes
    const BREADCRUMB = 'customer-end.includes.breadcrumb-section';
    const BROWSE_PRODUCTS_SECTION = 'customer-end.includes.browse-products-section';
    const PRODUCT_AVERAGE_RATING = 'customer-end.includes.product-average-rating';
}
