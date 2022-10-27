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
    public $vaersion = '1.0';

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

    }
 }
