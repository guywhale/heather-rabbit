<?php

namespace Hwale\Controllers;

class Header extends Layouts
{
    // Set view type to 'example';
    protected function setViewFile()
    {
        $this->viewFile = 'header';
    }

    // Get data specific to view
    protected function setData($data = [])
    {
        $this->data = [
            'title' => get_the_title(),
        ];
    }
}
