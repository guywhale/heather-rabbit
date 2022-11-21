<?php

/**
 * Layouts controller.
 */

namespace Hwale\Controllers;

abstract class Layouts extends Controller
{
    // Set view type to 'layout';
    public function setViewType()
    {
        $this->viewType = 'layout';
    }

    protected function render(string $viewType, string $viewFile, array $data = [])
    {
        $path = $this->viewsPath;
        parent::render($viewType, $viewFile, $data);

        if (!is_file(get_template_directory() . "{$path}{$viewType}s/{$viewFile}.php")) {
            throw new \Exception("Sorry, {$viewFile}.php doesn't exist in {$path}{$viewType}s/.");
        }

        include get_template_directory() . "{$path}{$viewType}s/{$viewFile}.php";
    }
}
