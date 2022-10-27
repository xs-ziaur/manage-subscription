<?php 

/**
 * Plugin Name: Manage Subscription
 * Description: Manager Subscription is a WooCommerce Subscription System.
 * Version: 1.0
 * Author: Xpeed Studio
 * Author URI: http://xpeedstudio.com
 *
 * WC requires at least: 3.0
 * WC tested up to: 6.7.0
 *
 * Copyright: © 2022 XpeedStudio.
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: managesubscription
 * Domain Path: /languages
 */

 if (! defined('ABSPATH' ) ) {
    exit;
 }

 final class ManageSubscription {
    /**
     * Manager Subscription version
     *
     * @var string
     */
    public $version = '1.0.0';

    /**
     * Get query instance
     *
     * @var ManageSubs_Query object
     */
    public $query;

    /**
     * single instance of the class
     *
     * @var object
     */
    protected static $instance = null;

    public function __construct() {
        require_once $this->plugin_url() . '/vendor/autoload.php';

        $this->initPluginDependencies();
        
        if (true !== $this->wcPluginCheck()) {
            return;
        }
        $this->defineConstants();

        return;
    }

    /**
     * Plugin Dependencies Check
     *
     * @return void
     */
    private function initPluginDependencies()
    {
        include_once ABSPATH . 'wp-admin/includes/plugin.php';
        add_action('init', array($this, 'preventHeaderSentProblem'), 1);
        add_action('admin_notices', array($this, 'woocommerceDependencyNotices'));
    }

    	/**
	 * Output a admin notice when plugin dependencies not met.
	 */
	public function woocommerceDependencyNotices() {
		$return = $this->wcPluginCheck( true );

		if ( true !== $return && current_user_can( 'activate_plugins' ) ) {
			$dependency_notice = $return;
			printf( '<div class="error"><p>%s</p></div>', wp_kses_post( $dependency_notice ) );
		}
	}

    	/**
	 * Check whether the plugin dependencies met.
	 * 
	 * @return bool|string True on Success
	 */
	private function wcPluginCheck( $return_dep_notice = false ) {
		$return = false;

		if ( is_multisite() && is_plugin_active_for_network( 'woocommerce/woocommerce.php' ) && is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
			$is_wc_active = true;
		} else if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
			$is_wc_active = true;
		} else {
			$is_wc_active = false;
		}

		// WC check.
		if ( ! $is_wc_active ) {
			if ( $return_dep_notice ) {
				$return = 'Manage Subscription plugin requires WooCommerce Plugin should be Active !!!';
			}

			return $return;
		}

		return true;
	}

    /**
	 * remove header problem while plugin activates
	 */
	public function preventHeaderSentProblem() {
		ob_start();
	}

    /**
     * Version
     *
     * @return string
     */
    public function version() {
        return $this->version;
    }

    /**
     * getting plugin directory
     *
     * @return string
     */
    public function plugin_url(){
		return trailingslashit(plugin_dir_path( __FILE__ ));
	}

    function defineConstants()
    {
        define('MANAGE_SUBSCRIPTION_VERSION', $this->version);
        define('MANAGE_SUBSCRIPTION_CRON_INTERVAL', 300); //in seconds
        define('MANAGE_SUBSCRIPTION_PLUGIN_FILE', __FILE__);
        // define('MANAGE_SUBSCRIPTION_TEMPLATE_PATH', MANAGE_SUBSCRIPTION_PLUGIN_DIR . 'templates/');
        define('MANAGE_SUBSCRIPTION_PLUGIN_BASENAME', plugin_basename(MANAGE_SUBSCRIPTION_PLUGIN_FILE));
        define('MANAGE_SUBSCRIPTION_PLUGIN_BASENAME_DIR', trailingslashit(dirname(MANAGE_SUBSCRIPTION_PLUGIN_BASENAME)));
        define('MANAGE_SUBSCRIPTION_PLUGIN_DIR', plugin_dir_path(MANAGE_SUBSCRIPTION_PLUGIN_FILE));
        define('MANAGE_SUBSCRIPTION_PLUGIN_URL', untrailingslashit(plugins_url('/', MANAGE_SUBSCRIPTION_PLUGIN_FILE)));
    }
 }

 new ManageSubscription();
