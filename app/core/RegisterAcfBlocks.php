<?php

/**
 * Register ACF Gutenberg blocks by scanning blocks directory
 */

namespace Hwale\Core;

class RegisterAcfBlocks
{
    private function register()
    {
        add_action('init', function () {
            $blocksPath = __DIR__ . '/../../views/blocks';

            if (!is_dir($blocksPath)) {
                return;
            }

            $blockSubDirs = array_diff(scandir($blocksPath), ['..', '.']);

            foreach ($blockSubDirs as $blockDir) {
                register_block_type($blocksPath . '/' . $blockDir);
            }
        });
    }

    public function __construct()
    {
        $this->register();
    }
}
