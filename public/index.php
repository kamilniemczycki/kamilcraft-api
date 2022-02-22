<?php

const ROOT_PATH = __DIR__ . '/../';

use KamilCraftApi\Application;

require ROOT_PATH . 'vendor/autoload.php';

$app = new Application(ROOT_PATH . '.env');
$app->run();
