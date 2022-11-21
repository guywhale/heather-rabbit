<?php

/**
 * Configure ACF
 */

namespace Hwale\Core;

class AcfConfig
{
    private function addOptionsPage()
    {
        if (function_exists('acf_add_options_page')) {
            acf_add_options_page([
                'page_title'    => 'Company Information',
                'menu_title'    => 'Company Information',
                'menu_slug'     => 'company-information',
                'capability'    => 'edit_posts',
                'redirect'      => false,
                'post_id'       => 'company_info',
            ]);

            acf_add_options_page([
                'page_title'    => 'Protected Pages',
                'menu_title'    => 'Protected Pages',
                'menu_slug'     => 'protected-pages',
                'capability'    => 'edit_posts',
                'redirect'      => false,
                'post_id'       => 'protected_pages',
            ]);
        }
    }

    public function __construct()
    {
        $this->addOptionsPage();
    }
}
