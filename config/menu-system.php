<?php

return [
    [
        'section' => [
            'name' => 'DASHBOARD',
            'modules' => [
                [
                    'name' => 'Dashboards',
                    'icon' => 'fa fa-dashboard',
                    'urlName' => null,
                    'active' => 'admin.dashboard*',
                    'canany' => [null, 'ordenes', 'blog', 'correos'],
                    'submodules' => [
                        [
                            'name' => 'General',
                            'urlName' => 'admin.dashboard.general.index',
                            'active' => 'admin.dashboard.general*',
                            'can' => null
                        ],
                        [
                            'name' => 'E-Commerce',
                            'urlName' => 'admin.dashboard.order.index',
                            'active' => 'admin.dashboard.order*',
                            'can' => 'ordenes'
                        ],
                        [
                            'name' => 'Blog',
                            'urlName' => 'admin.dashboard.blog.index',
                            'active' => 'admin.dashboard.blog*',
                            'can' => 'blog'
                        ],
                        [
                            'name' => 'Correos web',
                            'urlName' => 'admin.dashboard.email-web.index',
                            'active' => 'admin.dashboard.email-web*',
                            'can' => 'correos'
                        ],
                    ]
                ],
            ]
        ],
    ],
    [
        'section' => [
            'name' => 'WEB',
            'modules' => [
                [
                    'name' => 'Banner',
                    'icon' => 'fa-regular fa-image',
                    'urlName' => 'admin.banner.index',
                    'active' => 'admin.banner*',
                    'canany' => ['banners'],
                    'submodules' => []
                ],
                [
                    'name' => 'Galería',
                    'icon' => 'fa-regular fa-images',
                    'urlName' => 'admin.gallery.index',
                    'active' => 'admin.gallery*',
                    'canany' => ['galería'],
                    'submodules' => []
                ],
                [
                    'name' => 'Nosotros',
                    'icon' => 'fa-regular fa-user',
                    'urlName' => 'admin.about.index',
                    'active' => 'admin.about*',
                    'canany' => ['nosotros'],
                    'submodules' => []
                ],
                [
                    'name' => 'Socios',
                    'icon' => 'fa-solid fa-users',
                    'urlName' => 'admin.partner.index',
                    'active' => 'admin.partner*',
                    'canany' => ['socios'],
                    'submodules' => []
                ],
                [
                    'name' => 'Videos',
                    'icon' => 'fa-brands fa-youtube',
                    'urlName' => 'admin.video.index',
                    'active' => 'admin.video*',
                    'canany' => ['videos'],
                    'submodules' => []
                ],
                [
                    'name' => 'Servicios',
                    'icon' => 'fa-solid fa-bolt',
                    'urlName' => 'admin.service.index',
                    'active' => 'admin.service*',
                    'canany' => ['servicios'],
                    'submodules' => []
                ],
                [
                    'name' => 'Portafolio',
                    'icon' => 'fa-solid fa-briefcase',
                    'urlName' => 'admin.portfolio.index',
                    'active' => 'admin.portfolio*',
                    'canany' => ['portafolio'],
                    'submodules' => []
                ],
                [
                    'name' => 'Paquetes',
                    'icon' => 'fa-solid fa-cube',
                    'urlName' => null,
                    'active' => 'admin.package*',
                    'canany' => ['paquetes', 'paquetes características'],
                    'submodules' => [
                        [
                            'name' => 'Paquetes',
                            'urlName' => 'admin.package.package.index',
                            'active' => 'admin.package.package*',
                            'can' => 'paquetes'
                        ],
                        [
                            'name' => 'Caracteristicas',
                            'urlName' => 'admin.package.feature.index',
                            'active' => 'admin.package.feature*',
                            'can' => 'paquetes características'
                        ]
                    ]
                ],
                [
                    'name' => 'Testimonios',
                    'icon' => 'fa-solid fa-comments',
                    'urlName' => 'admin.testimony.index',
                    'active' => 'admin.testimony*',
                    'canany' => ['testimonios'],
                    'submodules' => []
                ],
                [
                    'name' => 'Preguntas y respuestas',
                    'icon' => 'fa-solid fa-circle-question',
                    'urlName' => 'admin.question-answer.index',
                    'active' => 'admin.question-answer*',
                    'canany' => ['preguntas y respuestas'],
                    'submodules' => []
                ],
                [
                    'name' => 'Suscriptores',
                    'icon' => 'fa-regular fa-user',
                    'urlName' => 'admin.subscriber.index',
                    'active' => 'admin.subscriber*',
                    'canany' => ['subscriptores'],
                    'submodules' => []
                ],
                [
                    'name' => 'Correos web',
                    'icon' => 'fa-solid fa-envelopes-bulk',
                    'urlName' => 'admin.email-web.index',
                    'active' => 'admin.email-web*',
                    'canany' => ['correos'],
                    'submodules' => []
                ],
                [
                    'name' => 'Blog',
                    'icon' => 'fa-solid fa-blog',
                    'urlName' => null,
                    'active' => 'admin.blog*',
                    'canany' => ['blog', 'blog categorías', 'blog etiquetas'],
                    'submodules' => [
                        [
                            'name' => 'Posts',
                            'urlName' => 'admin.blog.post.index',
                            'active' => 'admin.blog.post*',
                            'can' => 'blog'
                        ],
                        [
                            'name' => 'Categorías',
                            'urlName' => 'admin.blog.category.index',
                            'active' => 'admin.blog.category*',
                            'can' => 'blog categorías'
                        ],
                        [
                            'name' => 'Etiquetas',
                            'urlName' => 'admin.blog.tag.index',
                            'active' => 'admin.blog.tag*',
                            'can' => 'blog etiquetas',
                        ],
                    ]
                ],
            ]
        ],
    ],
    [
        'section' => [
            'name' => 'E-COMMERCE',
            'modules' => [
                [
                    'name' => 'Ordenes',
                    'icon' => 'fa-solid fa-bag-shopping',
                    'urlName' => 'admin.order.index',
                    'active' => 'admin.order*',
                    'canany' => ['ordenes'],
                    'submodules' => []
                ],
                [
                    'name' => 'Catalogo',
                    'icon' => 'fa-solid fa-cart-shopping',
                    'urlName' => null,
                    'active' => 'admin.catalog*',
                    'canany' => ['productos', 'producto categorías', 'producto marcas', 'producto géneros'],
                    'submodules' => [
                        [
                            'name' => 'Productos',
                            'urlName' => 'admin.catalog.product.index',
                            'active' => 'admin.catalog.product*',
                            'can' => 'productos'
                        ],
                        [
                            'name' => 'Categorías',
                            'urlName' => 'admin.catalog.category.index',
                            'active' => 'admin.catalog.category*',
                            'can' => 'producto categorías'
                        ],
                        [
                            'name' => 'Marcas',
                            'urlName' => 'admin.catalog.brand.index',
                            'active' => 'admin.catalog.brand*',
                            'can' => 'producto marcas',
                        ],
                        [
                            'name' => 'Géneros',
                            'urlName' => 'admin.catalog.gender.index',
                            'active' => 'admin.catalog.gender*',
                            'can' => 'producto géneros',
                        ],

                    ]
                ],
                [
                    'name' => 'Promociones',
                    'icon' => 'fa-solid fa-percent',
                    'urlName' => 'admin.promotion.index',
                    'active' => 'admin.promotion.index',
                    'canany' => ['promociones'],
                    'submodules' => []
                ],
                [
                    'name' => 'Cupones',
                    'icon' => 'fa-solid fa-ticket',
                    'urlName' => 'admin.coupon.index',
                    'active' => 'admin.coupon.index',
                    'canany' => ['cupones'],
                    'submodules' => []
                ],
                [
                    'name' => 'Zonas de envío',
                    'icon' => 'fa-solid fa-truck',
                    'urlName' => 'admin.setting.shipping-zone',
                    'active' => 'admin.setting.shipping-zone',
                    'canany' => ['zonas de envío'],
                    'submodules' => []
                ],
                [
                    'name' => 'Clases de envío',
                    'icon' => 'fa-solid fa-tag',
                    'urlName' => 'admin.setting.shipping-class',
                    'active' => 'admin.setting.shipping-class',
                    'canany' => ['clases de envío'],
                    'submodules' => []
                ],
                [
                    'name' => 'Países',
                    'icon' => 'fa-solid fa-earth-americas',
                    'urlName' => 'admin.setting.country',
                    'active' => 'admin.setting.country',
                    'canany' => ['países'],
                    'submodules' => []
                ],
                [
                    'name' => 'Estados',
                    'icon' => 'fa-solid fa-map',
                    'urlName' => 'admin.setting.state',
                    'active' => 'admin.setting.state',
                    'canany' => ['estados'],
                    'submodules' => []
                ],
                [
                    'name' => 'Ciudades',
                    'icon' => 'fa-solid fa-city',
                    'urlName' => 'admin.setting.city',
                    'active' => 'admin.setting.city',
                    'canany' => ['ciudades'],
                    'submodules' => []
                ],
            ]
        ],
    ],
    [
        'section' => [
            'name' => 'AJUSTES',
            'modules' => [
                [
                    'name' => 'Usuarios',
                    'icon' => 'fa-solid fa-users',
                    'urlName' => 'admin.user.index',
                    'active' => 'admin.user*',
                    'canany' => ['usuarios'],
                    'submodules' => []
                ],
                [
                    'name' => 'Configuración',
                    'icon' => 'fa-solid fa-gear',
                    'urlName' => 'admin.setting.welcome',
                    'active' => 'admin.setting*',
                    'canany' => [null],
                    'submodules' => []
                ]
            ]
        ],
    ],
];
