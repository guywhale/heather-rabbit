<?php

/**
 * Components controller.
 */

namespace Hwale\Controllers;

abstract class Components extends Controller
{
    // Set view type to 'component';
    public function setViewType()
    {
        $this->viewType = 'component';
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
