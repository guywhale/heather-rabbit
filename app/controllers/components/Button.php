<?php

namespace Hwale\Controllers;

use Exception;

class Button extends Components
{
    // Set view type to 'example';
    protected function setViewFile()
    {
        $this->viewFile = 'button';
    }

    /**
     * Clean Data
     *
     * Escape HTML attributes on strings before passing to view.
     */
    private function cleanData($dataArr)
    {
        if (!$dataArr) {
            throw new \Exception('Please pass a valid data array as an argument.');
        }

        $cleanedArr = [];

        foreach ($dataArr as $key => $value) {
            $cleanedArr[$key] = esc_attr($value);
        }

        return $cleanedArr;
    }

    /**
     * Add attributes
     *
     * Add text needed to wrap data values for button HTML attributes
     */
    private function addAttributes($dataArr)
    {
        if (!$dataArr) {
            throw new \Exception('Please pass a valid data array as an argument.');
        }

        if ($dataArr['type']) {
            $dataArr['type'] = "type=\"{$dataArr['type']}\"";
        }

        if ($dataArr['href']) {
            $dataArr['href'] = "href=\"{$dataArr['href']}\"";
        }

        if ($dataArr['target']) {
            $dataArr['target'] = "target=\"_{$dataArr['target']}\"";
        }

        if ($dataArr['rel']) {
            $dataArr['rel'] = "rel=\"_{$this->data['rel']}\"";
        }

        if ($dataArr['disabled']) {
            $dataArr['disabled'] = 'disabled';
        }

        return $dataArr;
    }

    /**
     * Check tags data
     *
     * Ensure only permitted button HTML tags are passed to the view.
     *
     * @param array $data The array of button data.
     * @return array
     * @throws Exception
     **/
    private function checkTag($dataArr)
    {
        $permittedTags = ['a', 'button'];

        if (!$dataArr) {
            throw new \Exception('Please pass a valid data array as an argument.');
        }

        if (!in_array($dataArr['tag'], $permittedTags, true)) {
            throw new \Exception('Only a and button html tags are permitted.');
        }

        return $dataArr;
    }

    // Get data specific to view
    protected function setData($data = [])
    {
        /** @var array $defaultData The button's default settings.
         * 'tag' = HTML tag
         * 'type' = Set the type attribute
         * 'url' = The URL for the href attribute
         * 'target' = Set the target attribute
         * 'classes' = Additional classes to add to element
         * 'label' = Text to display on button
         * 'rel = Set the rel attribute
        */
        $defaultData = [
            'tag' => 'a',
            'type' => '',
            'href' => '',
            'target' => '',
            'classes' => '',
            'label' => 'Add a label..',
            'rel' => '',
            'disabled' => false
        ];

        // Clean data
        $defaultData = $this->cleanData($defaultData);
        //Set defaults
        $this->data = $defaultData;

        if (!empty($data)) {
            // Clean data
            $newData = $this->cleanData($data);
            // Merge default data with new. New values will override defaults.
            $this->data = array_merge($defaultData, $newData);
            // Check 'tag' argument is valid
            $this->data = $this->checkTag($this->data);
            // Set up attributes
            $this->data = $this->addAttributes($this->data);
        }
    }
}
