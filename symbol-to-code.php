<?php
/*
Plugin Name: Symbol to Code
Description: Allows you to specify custom currency code to woocommerce symbol.
Version: 1.0
Author: Mike M.
*/

// Add custom currency symbol filter
add_filter('woocommerce_currency_symbol', 'custom_currency_symbol', 10, 2);

function custom_currency_symbol($currency_symbol, $currency) {
    // Define custom currency symbols here
    $custom_symbols = array(
        'USD' => 'USD', // Example: US Dollar
        'AED' => 'AED', // Example: United Arab Emirates Dirham
        // Add more currencies as needed
    );

    // Check if custom symbol exists for the given currency code
    if (isset($custom_symbols[$currency])) {
        return $custom_symbols[$currency];
    }

    // If no custom symbol defined, return the default symbol
    return $currency_symbol;
}
