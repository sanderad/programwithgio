<?php

declare (strict_types = 1);

namespace App;

class DbCredentials
{
    protected array $config = [];

    public function __construct(array $env) 
    {
        /*setting each credential with its key that reffer to another key which is on the dotenv 444444 */
        $this->config = [
            'db' => [
                'host'   => $env['DB_HOST'],
                'username'   => $env['DB_USER'],
                'password'   => $env['DB_PASS'],
                'database' => $env['DB_DATABASE'],
                'driver' => $env['DB_DRIVER'] ?? 'mysql',
                'charset'   => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix'    => '',
            ],  
            'mailer' => [
                'dsn' => $env['MAILER_DSN'] ?? '',
            ],
            'apiKeys' => [
                'emailable' => $env['EMAILABLE_API_KEY'] ?? '',
            ]
            ];
    }
    /*gets called because db method does not exist and the credentials exist and are avaliable within the config protected array so we are accessing it 4444444  */
    public function __get($name)
    {
        return $this->config[$name] ?? null;
    }
}