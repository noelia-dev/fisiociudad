<?php
$baseDir = dirname(dirname(__FILE__));

return [
    'plugins' => [
        'BackTheme' => $baseDir . '/plugins/BackTheme/',
        'Bake' => $baseDir . '/vendor/cakephp/bake/',
        'CakePHP-NiceAdmin' => $baseDir . '/plugins/CakePHP-NiceAdmin/',
        'Cake/TwigView' => $baseDir . '/vendor/cakephp/twig-view/',
        'DebugKit' => $baseDir . '/vendor/cakephp/debug_kit/',
        'Migrations' => $baseDir . '/vendor/cakephp/migrations/',
        'Prueba' => $baseDir . '/plugins/Prueba/',
        'template' => $baseDir . '/plugins/template/',
    ],
];
