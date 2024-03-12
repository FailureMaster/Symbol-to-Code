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
    // Get the custom symbol for the currency
    $custom_symbol = get_option('_custom_currency_symbol_' . $currency);
    if ($custom_symbol !== false && $custom_symbol !== '') {
        return $custom_symbol;
    }
    return $currency_symbol;
}

// Add custom menu item under WooCommerce menu
add_action('admin_menu', 'custom_currency_symbol_menu');

function custom_currency_symbol_menu() {
    add_submenu_page(
        'woocommerce',
        'Custom Currency Symbol',
        'Custom Currency Symbol',
        'manage_options',
        'custom-currency-symbol',
        'custom_currency_symbol_page'
    );
}

// Callback function for the custom menu page
function custom_currency_symbol_page() {
    // Check if form is submitted
    if (isset($_POST['submit'])) {
        // Sanitize and save the entered symbol
        $symbol = sanitize_text_field($_POST['custom_symbol']);
        $currency = get_option('woocommerce_currency');
        update_option('_custom_currency_symbol_' . $currency, $symbol);
        echo '<div class="updated"><p>Currency symbol updated successfully!</p></div>';
    }

    // Get the current currency set in WooCommerce settings
    $current_currency = get_option('woocommerce_currency');
    $current_symbol = get_option('_custom_currency_symbol_' . $current_currency);

    ?>
    <div class="wrap">
        <h2>Custom Currency Symbol</h2>
        <p>This plugin allows you to specify custom currency symbols.</p>
        <p>You can modify the currency symbol for <strong><?php echo $current_currency; ?></strong> below:</p>
        <form method="post">
            <label for="custom_symbol">Set the symbol to:</label>
            <input type="text" name="custom_symbol" id="custom_symbol" value="<?php echo $current_symbol; ?>" />
            <input type="submit" name="submit" class="button-primary" value="Save" />
        </form>
    </div>
    <?php
}