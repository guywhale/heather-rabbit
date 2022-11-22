<?php

/**
 * Speed optimisation tweaks.
 */

namespace Hwale\Core;

class Optimise
{
    /**
     * disableEmojis
     *
     * Enabled by default, disables the emoji script and accompanying stylesheet
     * @return void
     */
    private function disableEmojis()
    {
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');
    }

    /**
     * disableReact
     *
     * Remove React on the front-end. Comment out if needed.
     * @return void
     */
    private function disableReact()
    {
        add_filter('wp_enqueue_scripts', function () {
            wp_dequeue_script('react');
            wp_deregister_script('react');

            wp_dequeue_script('react-dom');
            wp_deregister_script('react-dom');
        });
    }

    public function __construct()
    {
        $this->disableEmojis();
        $this->disableReact();
    }
}
