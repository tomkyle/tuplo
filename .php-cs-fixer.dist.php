<?php

return (new PhpCsFixer\Config())->setRules([
    '@PSR12' => true
])->setFinder(PhpCsFixer\Finder::create()->in([
    __DIR__ . '/src',
    __DIR__ . '/tests/unit'
]));
