<?php

return Array(

    'URL'                   => 'your-site.localhost',

    'TEMPLATE_EXTENSION'    => '.html',
    'TEMPLATE_PATH'         => '/app/template/',
    'TEMPLATE_CACHE'        => '/app/template/.cached/',
    'TEMPLATE_RELOAD'       => true,
    'TEMPLATE_AUTOESCAPE'   => false,

    'APP_MODE'              => 'DEV',
    'MAINTENANCE_MODE'      => 'NO',

    'PDO_ENGINE'            => 'mysql',
    'DB_CHARSET'            => 'utf8',

    'DB_HOST'               => '',
    'DB_USER'               => '',
    'DB_PASSWORD'           => '',
    'DB_DB'                 => '',

    'MEMCACHE_HOST'         => 'localhost',
    'MEMCACHE_PORT'         => '11211',

    'AES_KEY256'            => '',

    'SHA512_SALT_LEAD'      => '',
    'SHA512_SALT_TAIL'      => ''

);

?>
