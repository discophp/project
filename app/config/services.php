<?php

return Array(

    'Cache'         => function(){
        $config = require \App::path() . '/app/config/cache.php';
        \phpFastCache::setup($config);
        return phpFastCache();
    },
    'Crypt'         => 'Disco\classes\Crypt',
    'Data'          => 'Disco\http\Data',
    'DB'            => 'Disco\database\DB',
    'Event'         => 'Disco\classes\Event',
    'Email'         => 'Disco\classes\Email',
    'FileHelper'    => 'Disco\classes\FileHelper',
    'Form'          => 'Disco\html\Form',
    'Html'          => 'Disco\html\Html',
    'Log'           => 'Disco\Log',
    'Queue'         => 'Disco\classes\Queue',
    'Request'       => 'Disco\http\Request',
    'Response'      => 'Disco\http\Response',
    'Session'       => 'Disco\http\Session',
    'Template'      => 'Disco\html\Template',
    'View'          => 'Disco\html\View',

    'User'          => 'App\service\User',
    'ExceptionHandler' => 'App\exceptions\Handler',

);
