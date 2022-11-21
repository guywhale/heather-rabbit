<?php

/**
 * Add theme support features
 */

namespace Hwale\Core;

class ThemeSupport
{
    private function addSupport()
    {
        add_action('after_setup_theme', function () {
            add_theme_support('title-tag');
            add_theme_support('post-thumbnails');
            add_theme_support('align-wide');
        });
    }

    public function __construct()
    {
        $this->addSupport();
    }
}
