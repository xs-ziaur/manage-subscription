<?php

namespace Xpeed\ManageSubscription\Admin;

class ManageSubscriptionMenu
{
    function __construct()
    {
        add_action('admin_menu', [$this, 'msAdminMenu']);
    }

    public function msAdminMenu()
    {
        error_log(print_r("admin menu", true));

        $parent_slug = "manage-subscription";
        $capability = 'manage-options';

        add_menu_page(
            __('Manage Subscription', 'manage-subscription'),
            __('ManageSubscription', 'manage-subscription'),
            $capability,
            $parent_slug,
            [ $this, 'manage-subscription'],
            'dashicons-welcome-view-site'
        );

        add_submenu_page(
            $parent_slug,
            __('Master Log', 'manage-subscription'),
            __('Master Log', 'manage-subscription'),
            $capability,
            $parent_slug,
            [$this, 'masterLog']
        );

        add_submenu_page(
            $parent_slug,
            __('Settings', 'manage-subscription'),
            __('Settings', 'manage-subscription'),
            $capability,
            'ms-settings',
            [$this, 'settings']
        );

    }

    /**
     * settings function
     *
     * @return void
     */
    public function settings() {
        echo "hello world from settings";
    }

    /**
     * master log function
     *
     * @return void
     */
    public function masterLog() {
        echo "hello from Master Log";
    }
}