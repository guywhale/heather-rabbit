<?php

/**
 * Blocks controller.
 */

namespace Hwale\Controllers;

abstract class Blocks extends Controller
{
    // Set view type to 'block';
    public function setViewType()
    {
        $this->viewType = 'block';
    }

    protected function render(string $viewType, string $viewFile, array $data = [])
    {
        $path = $this->viewsPath;
        parent::render($viewType, $viewFile, $data);

        if (!is_file(get_template_directory() . "{$path}{$viewType}s/{$viewFile}/{$viewFile}.php")) {
            throw new \Exception("Sorry, {$viewFile}.php doesn't exist in {$path}{$viewType}s/.");
        }

        include get_template_directory() . "{$path}{$viewType}s/{$viewFile}/{$viewFile}.php";
    }
}
