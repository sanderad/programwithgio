<?php

declare(strict_types=1);
/*the table sorage is where the migrations versions will be stored
doctrine uses this to track which migrations were executed*/
return [
    'table_storage' => [
        'table_name' => 'doctrine_migration_versions',
        'version_column_name' => 'version',
        'version_column_length' => 191,
        'executed_at_column_name' => 'executed_at',
        'execution_time_column_name' => 'execution_time',
    ],
    /*doctrine will try to locate the migration files from this paths */
    /* NAMESPACE => PATH */
    'migrations_paths' => [
        'Migrations' => '/migrations',
    ], 

    'all_or_nothing' => true,
    'transactional' => true,
    'check_database_platform' => true,
    'organize_migrations' => 'none',
    'connection' => [
        'url' => 'mysql://root:root@localhost/my_db',
        'driver' => 'pdo_mysql',
    ],
    'em' => null,
];