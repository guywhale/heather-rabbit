<?php

use function Hwale\getSVG;

[
    'title' => $title
] = $data;

?>

<header class='py-16 text-center layout-header'>
    <a href="/" class="inline-block w-20 h-auto transition-colors fill-gray-600 hover:fill-red-800">
        <?php getSVG('hwale.svg'); ?>
    </a>
    <?php if ($title) { ?>
        <h1 class="text-center"><?= $title; ?></h1>
    <?php } ?>
</header>
