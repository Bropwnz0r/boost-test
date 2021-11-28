<?php

return [
    'class' => 'yii\db\Connection',
    'driverName'=> 'sqlite',
    'dsn' => 'sqlite:'.dirname(__DIR__).'/db/db.sqlite',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
