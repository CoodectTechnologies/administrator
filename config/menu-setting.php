<?php

return [
    [
        'section' => [
            'name' => 'SISTEMA',
            'modules' => [
                [
                    'name' => 'Bienvenido',
                    'icon' => 'fa fa-dashboard',
                    'urlName' => 'admin.setting.welcome',
                    'active' => 'admin.setting.welcome',
                    'canany' => [null]
                ],
                [
                    'name' => 'Permisos',
                    'icon' => 'fa-solid fa-gear',
                    'urlName' => 'admin.setting.permission',
                    'active' => 'admin.setting.permission',
                    'canany' => ['permisos'],
                ],
                [
                    'name' => 'Roles',
                    'icon' => 'fa-solid fa-gear',
                    'urlName' => 'admin.setting.role.index',
                    'active' => 'admin.setting.role*',
                    'canany' => ['roles'],
                ],
                [
                    'name' => 'Logs de sistema',
                    'icon' => 'fa-solid fa-spinner',
                    'urlName' => 'admin.setting.log',
                    'active' => 'admin.setting.log',
                    'canany' => ['logs'],
                ],
                [
                    'name' => 'Backups',
                    'icon' => 'fa-solid fa-database',
                    'urlName' => 'admin.setting.backup',
                    'active' => 'admin.setting.backup',
                    'canany' => ['backups'],
                ],
                [
                    'name' => 'Módulos web',
                    'icon' => 'fa-solid fa-code',
                    'urlName' => 'admin.setting.module-web',
                    'active' => 'admin.setting.module-web',
                    'canany' => ['módulos web'],
                ]
            ]
        ],
    ],
    [
        'section' => [
            'name' => 'E-COMMERCE',
            'modules' => [
                [
                    'name' => 'Zonas de envío',
                    'icon' => 'fa-solid fa-truck',
                    'urlName' => 'admin.setting.shipping-zone.index',
                    'active' => 'admin.setting.shipping-zone*',
                    'canany' => ['zonas de envío']
                ],
                [
                    'name' => 'Clases de envío',
                    'icon' => 'fa-solid fa-tag',
                    'urlName' => 'admin.setting.shipping-class',
                    'active' => 'admin.setting.shipping-class',
                    'canany' => ['clases de envío'],
                ],
                [
                    'name' => 'Países',
                    'icon' => 'fa-solid fa-earth-americas',
                    'urlName' => 'admin.setting.country',
                    'active' => 'admin.setting.country',
                    'canany' => ['países'],
                ],
                [
                    'name' => 'Estados',
                    'icon' => 'fa-solid fa-map',
                    'urlName' => 'admin.setting.state',
                    'active' => 'admin.setting.state',
                    'canany' => ['estados'],
                ],
                [
                    'name' => 'Ciudades',
                    'icon' => 'fa-solid fa-city',
                    'urlName' => 'admin.setting.city',
                    'active' => 'admin.setting.city',
                    'canany' => ['ciudades'],
                ],
                [
                    'name' => 'Cuenta bancaría',
                    'icon' => 'fa-solid fa-money-check',
                    'urlName' => 'admin.setting.info-account-bank',
                    'active' => 'admin.setting.info-account-bank',
                    'canany' => ['cuenta bancaria'],
                ],
                [
                    'name' => 'Monedas',
                    'icon' => 'fa-solid fa-dollar-sign',
                    'urlName' => 'admin.setting.currency',
                    'active' => 'admin.setting.currency',
                    'canany' => ['monedas'],
                ],
                [
                    'name' => 'Accesos a pasarelas de pago',
                    'icon' => 'fa-solid fa-money-check-dollar',
                    'urlName' => 'admin.setting.access-payment',
                    'active' => 'admin.setting.access-payment',
                    'canany' => ['pasarelas de pago'],
                ]
            ]
        ],
    ],
    [
        'section' => [
            'name' => 'WEB',
            'modules' => [
                [
                    'name' => 'Web',
                    'icon' => 'fa-solid fa-envelope',
                    'urlName' => 'admin.setting.contact',
                    'active' => 'admin.setting.contact',
                    'canany' => ['contacto']
                ],
            ]
        ],
    ],
];
