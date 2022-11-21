<?php

// Helper functions
require_once __DIR__ . '/helpers/autoloader.php';
require_once __DIR__ . '/helpers/getSVG.php';

// Core setup files
require_once __DIR__ . '/core/_autoload.php';

// Controllers
require_once __DIR__ . '/controllers/Layouts.php';
require_once __DIR__ . '/controllers/Partials.php';
require_once __DIR__ . '/controllers/Blocks.php';
require_once __DIR__ . '/controllers/Components.php';

// Controllers - Layouts
require_once __DIR__ . '/controllers/layouts/_autoload.php';

// Controllers - Partials
require_once __DIR__ . '/controllers/partials/_autoload.php';

// Controllers - Blocks
require_once __DIR__ . '/controllers/blocks/_autoload.php';

// Controllers - Components
require_once __DIR__ . '/controllers/components/_autoload.php';
