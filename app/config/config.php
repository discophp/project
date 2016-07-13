<?php

return Array(

    'DEV_MODE'              => false,
    'MAINTENANCE_MODE'      => false,

    'DOMAIN'                => 'your-site.localhost',
    'FORCE_HTTPS'           => false,

    'CSRF_TOKEN_NAME'       => 'APP_CSRF_TOKEN',

    'TEMPLATE_EXTENSION'    => Array('.html','.twig'),
    'TEMPLATE_PATH'         => '/app/template/',

    'DB_ENGINE'             => 'mysql',
    'DB_CHARSET'            => 'utf8',

    'DB_HOST'               => '127.0.0.1',
    'DB_USER'               => 'root',
    'DB_PASSWORD'           => '',
    'DB_DB'                 => 'YOUR_DB',

    'AES_KEY256'            => '',

    'SHA512_SALT_LEAD'      => '',
    'SHA512_SALT_TAIL'      => ''

);

?>
