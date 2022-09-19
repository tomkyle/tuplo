#!/usr/bin/env php
<?php
try {
    $root_dir = __DIR__;
    require $root_dir . '/vendor/autoload.php';

    $container = require_once $root_dir . '/app/container.php';

    $app = $container->get(\Silly\Application::class);
    $app->run();
}
catch (\Throwable $e) {
    echo sprintf("Throwable: %s", get_class($e)),  PHP_EOL;
    echo sprintf("Message:   %s", $e->getMessage()), PHP_EOL;
    echo sprintf("Where:     %s:%s", $e->getFile(), $e->getLine()), PHP_EOL;
}
