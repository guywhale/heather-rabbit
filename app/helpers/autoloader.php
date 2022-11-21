<?php

namespace Hwale;

/**
 * Autoloader
 *
 * Undocumented function long description
 *
 * @param string $folder Folder to scan for files
 * @return void
 * @throws Exception
 **/
function autoloader(string $folder = null)
{
    $librariesPath = get_stylesheet_directory() . '/app/' . $folder . '/';
    $libraries = array_diff(scandir($librariesPath), array('..', '.'));

    foreach ($libraries as $fileName) {
        require_once "{$librariesPath}{$fileName}";
    }
}
