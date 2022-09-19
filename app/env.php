<?php
/**
 * Executing this file (PHP's require/include) will load
 * environment variables from .env and return \Dotenv\Dotenv instance
 *
 * @see https://github.com/vlucas/phpdotenv
 *
 * @return \Dotenv\Dotenv
 */

/**
 * Map getenv-like calls to $_ENV
 * @param  string $var Enviroment variable name
 * @return mixed Enviroment variable value
 */
function dotenv( string $var )
{
    return $_SERVER[ $var ];
}


$root_path  = dirname( __DIR__ );

$dotenv = \Dotenv\Dotenv::createImmutable($root_path);
$dotenv->load();
$dotenv->required([
    'FTP_HOST',
    'FTP_USER',
    'FTP_PASS',
    'FTP_PORT',
    'FTP_SSL',
    'FTP_PATH_PREFIX',

    'DOWNLOAD_PREFIX'
]);

return $dotenv;
