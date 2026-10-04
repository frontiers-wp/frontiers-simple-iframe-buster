<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * This file is executed automatically when the user clicks the "Delete" link
 * in the WordPress Plugins dashboard. It removes all traces of the plugin data.
 *
 * @package    Frontiers_Simple_Iframe_Buster
 * @author     Edwin Bekedam
 * @license    GPLv2
 * @link       https://github.com/frontiers-wp/frontiers-simple-iframe-buster
 */

// If uninstall not called from WordPress, exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    die;
}

/**
 * Perform necessary cleanup actions.
 * 
 * Since Frontiers Simple Iframe Buster runs programmatically through runtime filters
 * and does not write persistency values to wp_options or custom db tables, we only 
 * need to flush structural object caching parameters if any were set by third parties.
 */
if ( function_exists( 'wp_cache_flush' ) ) {
    wp_cache_flush();
}
