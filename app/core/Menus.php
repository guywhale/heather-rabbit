<?php

/**
 * Set up menus
 */

namespace Hwale\Core;

class Menus
{
    private function registerPrimaryMenu()
    {
        add_action('after_setup_theme', function () {
            register_nav_menu('primary', __('Primary Menu', 'hwale'));
        });
    }

    public function __construct()
    {
        $this->registerPrimaryMenu();
    }
}
