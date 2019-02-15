<?php

require __DIR__ . '/autoload.php';
require __DIR__ . '/vendor/autoload.php';

use Ocms\core\Kernel;

$kernel = Kernel::getInstance(__DIR__);
$kernel->run();
