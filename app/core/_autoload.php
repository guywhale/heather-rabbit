<?php

use Hwale\Core\AcfConfig;
use Hwale\Core\Assets;
use Hwale\Core\Menus;
use Hwale\Core\ParentRole;
use Hwale\Core\RegisterAcfBlocks;
use Hwale\Core\ThemeSupport;

use function Hwale\autoloader;

autoloader('core');

// Init
new ParentRole();
new Assets();
new AcfConfig();
new RegisterAcfBlocks();
new Menus();
new ThemeSupport();
