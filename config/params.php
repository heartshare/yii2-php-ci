<?php

return [
    'adminEmail' => 'admin@example.com',

    'systemMenu' => [
        'leftMenu' => [
            'dashboard' =>[
                ['url' => '/dashboard/index', 'chanel' => 'dashboard', 'label' => 'Reports'],
            ],
            'projects' => [
                ['url' => '/projects/index', 'chanel' => 'projects' , 'label' => 'Projects']
            ],
            'setting' =>[
                ['url' => '/setting/index', 'chanel' => 'setting', 'label' => 'setting'],
                ['url' => '/modules/index', 'chanel' => 'setting.modules', 'label' => 'modules'],
            ],
        ]
    ],
];
