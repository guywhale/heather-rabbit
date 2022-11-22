<?php

use Hwale\Controllers\Button;

use function Hwale\getSVG;

[
    'title' => $title,
    'loggedIn' => $loggedIn,
] = $data;

?>

<header class='container py-16 text-center layout-header'>
    <nav class="flex justify-between mb-10">
        <a href="/" class="inline-block w-20 h-auto transition-colors fill-gray-600 hover:fill-red-800">
            <?php getSVG('hwale.svg'); ?>
        </a>
        <ul class="flex">
            <?php if ($loggedIn) { ?>
                <li>
                    <?php new Button([
                        'href' => wp_logout_url(home_url()),
                        'label' => 'Logout',
                    ]) ?>
                </li>
            <?php } else {?>
                <li class="mr-4">
                    <?php new Button([
                        'href' => wp_login_url(),
                        'label' => 'Login',
                    ]) ?>
                </li>
                <li>
                    <?php new Button([
                        'href' => wp_registration_url(),
                        'label' => 'Register',
                    ]) ?>
                </li>
            <?php } ?>
        </ul>
    </nav>
    <?php if ($title) { ?>
        <h1 class="text-center"><?= $title; ?></h1>
    <?php } ?>
</header>
