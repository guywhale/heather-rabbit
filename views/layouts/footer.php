<?php

[
    'copyright' => $copyright,
] = $data;

?>

<footer class="py-4 text-white bg-gray-600 layout-footer">
    <div class="container text-center">
        <?php if ($copyright) { ?>
            <a href="https://guywhale.com" target="_blank" rel="noopener"><?= $copyright; ?></p>
        <?php } ?>
    </div>
</footer>
