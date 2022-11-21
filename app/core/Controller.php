<?php

/**
 * Sets up Controller.
 */

namespace Hwale\Controllers;

abstract class Controller
{
    /** @var String $viewsPathPath to /views/ dir as a string. Maintains consistency across Exception messages. */
    protected $viewsPath = '/views/';

    /** @var String $viewType Type of view to get. */
    protected $viewType = '';

    /** @var String $viewFile Name of view file. */
    protected $viewFile = '';

    /** @var Array $data Array of data to be passed as argument to the view. */
    protected $data = [];

    /**
     * Set the view type
     *
     * Used in child classes to set the view type
     **/
    abstract protected function setViewType();

    /**
     * Set the view type
     *
     * Used in child classes to set the view file
     **/
    abstract protected function setViewFile();

    /**
     * Set the data to be passed to the view
     *
     * Used in child classes to set data arguments
     **/
    protected function setData($data = [])
    {
        $this->data = $data;
    }

    /**
     * Renders view
     *
     * Checks for existence of view file. Includes it if it
     * exists. Passes any needed arguments to view file as
     * data array.
     *
     * @param string $viewType Type of view to get.
     * @param string $viewFile Name of view file.
     * @param array $data Arguments to pass to view template file.
     * @throws Exception
     **/
    protected function render(string $viewType, string $viewFile, array $data = [])
    {
        // Permitted types
        $allowedTypes = ['block', 'component', 'layout', 'partial'];
        // Permitted types as string for Exception messages
        $allowedTypesStr = implode(', ', $allowedTypes);
        $path = $this->viewsPath;

        if (!$viewType) {
            throw new \Exception("Please specify a type of template to get. Permitted types are: {$allowedTypesStr}. A type must have a corresponding directory in {$path}.");
        }

        if (!in_array($viewType, $allowedTypes, true)) {
            throw new \Exception("'{$viewType}' is not a permitted type. Permitted types are: {$allowedTypesStr}. A type must have a corresponding directory in {$path}.");
        }

        if (!is_dir(get_template_directory() . "{$path}{$viewType}s")) {
            throw new \Exception("The '{$viewType}' type does not have a corresponding directory in {$path}. Please create one and ensure the name is plual e.g. '{$path}{$viewType}s'.");
        }

        if (!$viewFile) {
            throw new \Exception("You must specify a viewFile for the template file. Do not use '.php' extension.");
        }
    }

    /**
     * Constructor
     *
     * Set arguments and pass to render method
     *
     **/
    public function __construct($data = [])
    {
        $this->setViewType();
        $this->setViewFile();
        $this->setData($data);

        $this->render($this->viewType, $this->viewFile, $this->data);
    }
}
