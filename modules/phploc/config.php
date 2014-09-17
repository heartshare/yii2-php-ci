<?php

return [
    //module basic info
    'module' => 'phploc',
    'name' => 'PHPLoc',
    'description' => 'phploc is a tool for quickly measuring the size and analyzing the structure of a PHP project.',
    'version' => '1.0',
    'category' => '',
    'url' => '',
    //module config info
    'config' => [
        'configure' => [
            'class' => 'app\modules\phploc\Module',
        ],
        'setting' => [
            'route' => 'phploc/default/index',
        ]

    ],

];
