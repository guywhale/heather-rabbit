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
        // Set logo image
        add_action(
            'login_enqueue_scripts',
            function () {
                $logoUrl = get_stylesheet_directory_uri() . '/images/logo-login.svg';

                echo "<style type=\"text/css\">
                    #login h1 a,
                    .login h1 a {
                        background-image: url({$logoUrl});
                        background-position: center;
                    }
                </style>";
            }
        );
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

    private function redirectLoggedOutUsers()
    {
        add_action('template_redirect', function () {
            if (!is_user_logged_in() && is_page('parents')) {
                auth_redirect();
            }
        });
    }

    public function __construct()
    {
        $this->loginEnqueue();
        $this->loginHeaderUrl();
        $this->loginHeaderTitle();
        $this->hideLanguageDropdown();
        $this->redirectLoggedOutUsers();
    }
}
