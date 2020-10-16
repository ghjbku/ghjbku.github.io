<?php
/**
 * Ez a változó tartalmazza az összes olyan beállítást, amire szükség van az oldal működéséhez.
 * Ezek például az adatbáziskapcsolatok, az oldal felépítése, a menü felépítése stb.
 */
$GLOBALS = [
    'mysql' => [
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'db' => 'uniproject'
    ],
    'uploadFolder' => 'H:/xampp/htdocs/uploads',
    'allowedExtensions' => [
        'jpg',
        'gif',
        'png',
        'jpeg'
    ],
    'url' => 'http://localhost/',
    'page' => [
        'render' => [
            'head' => 'page-sections/head.php',
            'navbar' => 'page-sections/navbar.php',
            'footer' => 'page-sections/footer.php',
        ],
        'menu' => [
            [
                'name' => 'Galéria',
                'icon' => 'fa fa-image',
                'link' => 'gallery'
            ],
            [
                'name' => 'Kategóriák',
                'icon' => 'fa fa-book',
                'link' => 'categories'
            ],
            [
                'name' => 'API',
                'icon' => 'fa fa-code',
                'link' => 'api'
            ],
            [
                'name' => 'Beállítások',
                'icon' => 'fa fa-cogs',
                'link' => 'settings'
            ],
            [
                'name' => 'Feltöltés',
                'icon' => 'fa fa-upload',
                'link' => 'upload'
            ],
            [
                'name' => 'Kilépés',
                'icon' => 'fa fa-sign-out-alt',
                'link' => 'logout'
            ]
        ]
    ]
];