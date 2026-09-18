<?php
/**
 * @wordpress-plugin
 * Plugin Name:       Frontiers Simple Iframe Buster
 * Plugin URI:        https://wordpress.org/plugins/frontiers-simple-iframe-buster
 * Description:       Enqueues a sitewide javascript to inhibit iframes and sends security headers. Fully compatible with PHP 8.5
 * Version:           2.0.0
 * Requires at least: 5.9
 * Requires PHP:      8.1
 * Author:            Edwin Bekedam
 * Author URI:        https://github.com/frontiers-wp/
 * Text Domain:       frontiers-simple-iframe-buster
 * Domain Path:       /languages
 * License:           GPLv2
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * You should have received a copy of the GNU General Public License
 * along with Simply Hide Author. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

// If this file is called directly, abort.
if (! defined('WPINC')) {
    die;
}

final class Frontiers_Simple_Iframe_Buster {
    const VERSION     = '2.0.0';
    const IN_FOOTER   = true;
    const SCRIPT_FILE = 'js/frontiers-iframe-buster.js';
    const SCRIPT_SLUG = 'frontiers-iframe-buster-script';

    // FIX: Class name here must EXACTLY match the class name defined on line 23
    private static ?Frontiers_Simple_Iframe_Buster $instance = null;
    
    // FIX: Initialized to empty string to prevent PHP 8.1+ Uninitialized property errors
    private static string $plugin_url = '';

    /**
     * Protected constructor to prevent multi-instantiation.
     */
    protected function __construct() {
        self::$plugin_url = plugin_dir_url( __FILE__ );
        
        add_action( 'wp_head', array( $this, 'frontiers_inline_hide_body_css' ), 1 );
        add_action( 'wp_enqueue_scripts', array( $this, 'frontiers_enq_buster_script' ) );
        add_action( 'plugins_loaded', array( $this, 'frontiers_exclude_white_autoptimize' ) );
    }

    /**
     * Singleton instance provider.
     */
    public static function get_instance(): Frontiers_Simple_Iframe_Buster {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Helper to verify if the current frame is an allowed admin frame.
     */
    private function is_whitelisted_frame(): bool {
        // Exclude the WordPress Customizer
        if ( is_customize_preview() ) {
            return true;
        }

        // Exclude admin areas
        if ( is_admin() ) {
            return true;
        }
        
        // FIX: Using filter_input removes the direct $_GET access warnings
        $elementor_preview = filter_input( INPUT_GET, 'elementor-preview', FILTER_DEFAULT );
        $divi_preview      = filter_input( INPUT_GET, 'et_fb', FILTER_DEFAULT );

        // Exclude popular page builders (Elementor / Divi previews)
        if ( null !== $elementor_preview || null !== $divi_preview ) {
            return true;
        }
        return false;
    }

    /**
     * Automatically injects exclusions into Autoptimize configuration filters.
     */
    public function frontiers_exclude_white_autoptimize(): void 
    {
        // Pure safety check: If Autoptimize is deactivated or missing, stop running completely.
        if ( ! defined( 'AUTOPTIMIZE_PLUGIN_DIR' ) && ! class_exists( 'autoptimizeCache' ) ) {
            return;
        }

        // Force Autoptimize to ignore our Frame Buster JavaScript
        add_filter( 'autoptimize_filter_js_exclude', function( $exclude_list ) {
            if ( is_string( $exclude_list ) && ! str_contains( $exclude_list, 'frontiers-simple-iframe-buster' ) ) {
                $exclude_list .= ', frontiers-iframe-buster.js';
            }
            return $exclude_list;
        });

        // Force Autoptimize to ignore our inline hiding CSS
        add_filter( 'autoptimize_filter_css_exclude', function( $exclude_list ) {
            if ( is_string( $exclude_list ) && ! str_contains( $exclude_list, 'frontiers-simple-iframe-buster' ) ) {
                $exclude_list .= ', frontiers-iframe-buster-inline-css';
            }
            return $exclude_list;
        });
    }

    /**
     * Injects the inline CSS configuration ONLY if it's a frontend visitor.
     */
    public function frontiers_inline_hide_body_css(): void {
        if ( $this->is_whitelisted_frame() ) {
            return;
        }
        echo '<style id="frontiers-iframe-buster-inline-css">body { display: none !important; }</style>';
    }

    /**
     * Register and enqueue the script in a single hook callback.
     */
    public function frontiers_enq_buster_script(): void {
        wp_enqueue_script(
            self::SCRIPT_SLUG,
            self::$plugin_url . self::SCRIPT_FILE,
            array(),
            self::VERSION,
            self::IN_FOOTER
        );
    }
    
    /**
     * Cloning and serialization are forbidden for singletons.
     */
    public function __clone() {
        _doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin’ uh?', 'frontiers-simple-iframe-buster' ), esc_html( self::VERSION ) );
    }

    public function __wakeup() {
        _doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin’ uh?', 'frontiers-simple-iframe-buster' ), esc_html( self::VERSION ) );
    }
}

// Instantiate the plugin safely
Frontiers_Simple_Iframe_Buster::get_instance();
