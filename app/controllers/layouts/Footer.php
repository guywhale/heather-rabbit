<?php

namespace Hwale\Controllers;

class Footer extends Layouts
{
    // Set view type to 'example';
    protected function setViewFile()
    {
        $this->viewFile = 'footer';
    }

    // Get data specific to view
    protected function setData($data = [])
    {
        $this->data = [
            'copyright' => '© 2022 Guy Whale. All rights reserved.',
        ];
    }
}
