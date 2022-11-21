<?php

namespace Hwale\Controllers;

class Example extends Blocks
{
    // Set view type to 'example';
    protected function setViewFile()
    {
        $this->viewFile = 'example';
    }

    // Set data specific to view
    protected function setData($data = [])
    {
        $this->data = [
            'title' => get_field('title') ?: null,
            'subtitle' => get_field('subtitle') ?: null,
            'text' => get_field('text') ?: null,
            'image' => get_field('image') ?: null,
            'button' => get_field('example_button') ?: null,
        ];
    }

    /**
     * Makes new instance of current class
     *
     * As the renderCallback in block.json will not accept a 'new Class()' instantiation,
     * we can cheat by using a static init() function that instatiates the class instead.
     *
     * 'Hwale\Controllers\Class::init' can then be used to render the block in block.json.
     */
    public static function init()
    {
        new self();
    }
}
