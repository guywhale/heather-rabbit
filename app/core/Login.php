<?php

/**
 * Customisation of login, lost password and registration pages
 */

namespace Hwale\Core;

class Login
{
    /**
     * loginEnqueue
     *
     * Set style sheet
     * @return void
     */
    private function loginEnqueue()
    {
        add_action('login_enqueue_scripts', fn() =>  wp_enqueue_style('app', get_theme_file_uri('/build/app.css')));
    }

    /**
     * loginHeaderUrl
     *
     * Change logo link to homepage
     * @return void
     */
    private function loginHeaderUrl()
    {
        add_filter('login_headerurl', fn() => esc_url(site_url('/')));
    }

    /**
     * loginHeaderTitle
     *
     * Change home link title from 'Powered by WordPress' to site name
     * @return void
     */
    private function loginHeaderTitle()
    {
        add_filter('login_headertext', fn() => get_bloginfo('name'));
    }

    /**
     * hideLanguageDropdown
     *
     * Hide the language dropdown on login/registration pages
     * @return void
     */
    private function hideLanguageDropdown()
    {
        add_filter('login_display_language_dropdown', '__return_false');
    }

    public function __construct()
    {
        $this->loginEnqueue();
        $this->loginHeaderUrl();
        $this->loginHeaderTitle();
        $this->hideLanguageDropdown();
    }
}
