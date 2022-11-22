<?php

/**
 * Customisation of login, lost password and registration pages
 */

namespace Hwale\Core;

class Login
{
    /**
     * protectedPageIds
     *
     * @var array
     */
    private $protectedPageIds = [];

    /**
     * capability
     *
     * Set WordPress capability to determine which members
     * can access the dashboard.
     *
     * https://wordpress.org/support/article/roles-and-capabilities/
     *
     * @var string
     */
    private $capability = '';

    /**
     * homePortalUrl
     *
     * Set the portal home URL members who are not allowed to access
     * the dashboard should be redirected to,
     * @var string
     */
    private $homePortalUrl = '';

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
                $logo = get_field('logo', 'company_info') ?: null;

                if ($logo) {
                    $logoUrl = $logo['url'];
                }

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

    /**
     * blockNonAdminMembers
     *
     * Prevents site members without required permissions from accessing
     * the dashboard.
     *
     * Whether a user needs the dashboard is determined by checking their
     * capabilities.
     *
     * If their role lacks the specified capability, they are redirected to
     * the specified membership home portal url.
     *
     * @param  string $capability The capability to check for.
     * @param  string $homePortalUrl The URL of the portal home to redirect to.
     * @return void
     */
    private function blockNonAdminMembers(string $capability, string $homePortalUrl)
    {
        add_action('admin_init', function () use ($capability, $homePortalUrl) {
            if (!defined('DOING_AJAX') || !DOING_AJAX) {
                $user = wp_get_current_user();

                if (isset($user->allcaps) && is_array($user->allcaps)) {
                    if (!array_key_exists($capability, $user->allcaps)) {
                        wp_safe_redirect($homePortalUrl);
                        exit;
                    }
                }
            }
        });
    }

    /**
     * redirectLoggedOutUsers
     *
     * Redirect users to login page if visiting parents portal and not logged in.
     * @param  array $protectedPageIds
     * @return void
     */
    private function redirectLoggedOutUsers(array $protectedPageIds)
    {
        if (empty($protectedPageIds)) {
            return;
        }
        add_action('template_redirect', function () use ($protectedPageIds) {
            if (!is_user_logged_in() && is_page($protectedPageIds)) {
                auth_redirect();
            }
        });
    }

    /**
     * customLoginMessage
     *
     * Show a custom login message if user is redirected to login
     * from a protected page.
     * @param  array $protectedPageIds
     * @return void
     */
    private function customLoginMessage(array $protectedPageIds)
    {
        add_filter('login_message', function () use ($protectedPageIds) {
            if (empty($_REQUEST) || !key_exists('redirect_to', $_REQUEST) || empty($_REQUEST['redirect_to'])) {
                return;
            }

            $prevPath = parse_url($_REQUEST['redirect_to'], PHP_URL_PATH);
            $page = get_page_by_path($prevPath);

            if (in_array($page->ID, $protectedPageIds, true)) {
                return "<p class=\"message\">Please login to access this page.</p>";
            }
        });
    }

    /**
     * getProtectedPages
     *
     * Get an array of the page IDs of all protected pages from the ACF field in dashboard.
     * @return array
     */
    private function getProtectedPages()
    {
        $protectedIds = [];
        $protectedRaw = get_field('protected_pages', 'protected_pages') ?: null;

        if ($protectedRaw) {
            $protectedIds = array_map(fn($data) => $data['page'], $protectedRaw);
        }

        return $protectedIds;
    }

    public function __construct()
    {
        $this->protectedPageIds = $this->getProtectedPages();
        $this->capability = 'edit_posts';
        $this->homePortalUrl = home_url('/parents');

        $this->loginEnqueue();
        $this->loginHeaderUrl();
        $this->loginHeaderTitle();
        $this->hideLanguageDropdown();
        $this->redirectLoggedOutUsers($this->protectedPageIds);
        $this->customLoginMessage($this->protectedPageIds);
        $this->blockNonAdminMembers($this->capability, $this->homePortalUrl);
    }
}
