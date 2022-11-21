<?php

namespace Hwale;

/**
 * Echo SVGs from /images/
 *
 * If specified SVG exists in /images/ it will be returned as a string.
 *
 * @param string $fileName Name of the SVG in /images/
 * @return string
 **/

function subGetSVG(string $fileName = null): string
{
    if (!$fileName) {
        throw new \Exception("You must specify a filename for the SVG file. You must use the '.svg' extension.");
    }

    if (!str_ends_with($fileName, '.svg')) {
        throw new \Exception("The file must be an SVG file with an '.svg' extension.");
    }

    if (!is_file(get_template_directory() . "/images/{$fileName}")) {
        throw new \Exception("Sorry, '{$fileName}' doesn't exist in /images/.");
    }

    $svg = file_get_contents(get_template_directory() . "/images/{$fileName}");

    return $svg;
}

/**
 * Try/Catch wrapper for subGetSVG()
 *
 * Wraps each instance of the SVG rendering function in a try/catch statement.
 * This allows for errors to be displayed without blocking the execution of the rest
 * of the page's code.
 *
 * @param string $fileName Name of the SVG in /src/assets/images
 * @return string
 * @throws Exception
 **/
function getSVG(string $fileName = null): void
{
    try {
        echo subGetSVG($fileName);
    } catch (\Exception $e) {
        echo '<pre class="exception-msg">Caught exception: ',  $e->getMessage(), '</pre>';
    }
}
