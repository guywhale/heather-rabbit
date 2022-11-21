<?php

namespace Hwale\Controllers;

class Post extends Partials
{
    // Set view type to 'example';
    protected function setViewFile()
    {
        $this->viewFile = 'single-' . get_post_type();
    }
}
