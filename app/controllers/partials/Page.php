<?php

namespace Hwale\Controllers;

class Page extends Partials
{
    // Set view type to 'example';
    protected function setViewFile()
    {
        $this->viewFile = get_post_type();
    }
}
