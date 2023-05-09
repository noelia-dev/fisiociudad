<?php
$baseDir = dirname(dirname(__FILE__));

return [
    'plugins' => [
        'Authentication' => $baseDir . '/vendor/cakephp/authentication/',
        'BackTheme' => $baseDir . '/plugins/BackTheme/',
        'Bake' => $baseDir . '/vendor/cakephp/bake/',
        'Cake/TwigView' => $baseDir . '/vendor/cakephp/twig-view/',
        'DebugKit' => $baseDir . '/vendor/cakephp/debug_kit/',
        'FrontTheme' => $baseDir . '/plugins/FrontTheme/',
        'Migrations' => $baseDir . '/vendor/cakephp/migrations/',
    ],
];
