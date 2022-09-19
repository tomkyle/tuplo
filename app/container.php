<?php
$builder = new \DI\ContainerBuilder();
$builder->addDefinitions([
    \Dotenv\Dotenv::class => require_once __DIR__ . '/env.php'
]);



$builder->addDefinitions( ...array(
    __DIR__ . '/silly.php',
    __DIR__ . '/flysystem.php',
));



return $builder->build();
