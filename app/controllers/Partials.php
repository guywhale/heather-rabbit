<?php

/**
 * Partials controller.
 */

namespace Hwale\Controllers;

abstract class Partials extends Controller
{
    // Set view type to 'partial';
    public function setViewType()
    {
        $this->viewType = 'partial';
    }

    protected function render(string $viewType, string $viewFile, array $data = [])
    {
        $path = $this->viewsPath;
        parent::render($viewType, $viewFile, $data);

        if (!is_file(get_template_directory() . "{$path}{$viewType}s/content-{$viewFile}.php")) {
            throw new \Exception("Sorry, {$viewFile}.php doesn't exist in {$path}{$viewType}s/.");
        }

        include get_template_directory() . "{$path}{$viewType}s/content-{$viewFile}.php";
    }
}
