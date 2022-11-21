<?php

[
    'tag' => $tag,
    'type' => $type,
    'href' => $href,
    'target' => $target,
    'classes' => $classes,
    'label' => $label,
    'rel' => $rel,
    'disabled' => $disabled,
] = $data;

// echo '<pre style="color: #fff;">'; print_r($data); echo '</pre>';
?>

<<?= $tag, ' class="component-button button ' . $classes . '"', $type, $href, $target, $rel, $disabled; ?>
>
    <?= $label; ?>
</<?= $tag; ?>>
