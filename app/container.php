<?php
$builder = new \DI\ContainerBuilder();

$builder->addDefinitions( ...array(
    __DIR__ . '/silly.php',
    __DIR__ . '/configurations.php'
));

return $builder->build();
