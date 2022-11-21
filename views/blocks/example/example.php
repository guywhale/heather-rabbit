<?php

use Hwale\Controllers\Button;

[
    'title' => $title,
    'subtitle' => $subtitle,
    'text' => $text,
    'image' => $image,
    'button' => $button
] = $data;

?>
<section class="py-12 bg-black wp-block-example">
    <div data-example-script></div>
    <div class="container text-white">
        <div class="flex flex-wrap -mx-4">
            <?php if ($title) { ?>
                <h2 class="w-full mb-4 text-center"><?= $title; ?></h2>
            <?php } ?>

            <?php if ($subtitle) { ?>
                <p class="w-full mb-10 text-center h4"><?= $title; ?></p>
            <?php } ?>

            <div class="w-full px-4 text-center lg:w-1/2">
                <?php if ($image) { ?>
                    <img class="object-fill md:p-8"
                        src="<?= $image['url']; ?>"
                        alt="<?= $image['alt']; ?>"
                        width="<?= $image['width']; ?>"
                        height="<?= $image['height']; ?>">
                <?php } ?>
            </div>
            <div class="flex flex-col items-center justify-center w-full px-4 py-4 fle-col lg:w-1/2">
                <?php if ($text) { ?>
                    <div class="prose text-white"><?= $text; ?></div>
                <?php } ?>
                <?php if ($button) { ?>
                    <div class="w-full m-8">
                        <?php new Button([
                            'label' => $button['title'],
                            'href' => $button['url'],
                            'target' => $button['target'],
                        ]); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
