<?php
return array(

    'driver' => env('MAIL_DRIVER', ''),

    'host' => env('MAIL_HOST', ''),

    'port' => env('MAIL_PORT', 587),

    'from' => array('address' => env('FROM_ADDRESS', ''), 'name' => env('MAIL_SUBJECT', '')),

    'encryption' => env('MAIL_ENCRYPTION', 'tls'),

    'username' => env('MAIL_USERNAME'),

    'password' => env('MAIL_PASSWORD'),

    'sendmail' => '/usr/sbin/sendmail -bs',

    'pretend' => false,

);
