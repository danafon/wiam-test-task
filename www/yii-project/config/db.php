<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=yii_postgres;port=5432;dbname=app',
    'username' => 'tester',
    'password' => 'letmein',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
