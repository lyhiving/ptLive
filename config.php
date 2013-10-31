<?php
return array(
    'basePath' => '..',
    'import'=>array(
        'application.models.*',
    ),
    'components' => array(
        'db' => array(
            'connectionString' => 'mysql:dbname=ptlive;host=localhost',
            'charset' => 'UTF-8'
            'username' => 'root',
            'password' => '',
            'tablePrefix' => '',
        ),
    ),
);
