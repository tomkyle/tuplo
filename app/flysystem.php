<?php

use League\Flysystem;

return array(

    Flysystem\Filesystem::class => function($dic) : Flysystem\Filesystem
    {
        $adapter = $dic->get(Flysystem\FilesystemAdapter::class);
        return new Flysystem\Filesystem($adapter);
    },

    Flysystem\FilesystemAdapter::class => function($dic) : Flysystem\FilesystemAdapter
    {
        return $dic->get(Flysystem\Ftp\FtpAdapter::class);
    },

    Flysystem\Ftp\FtpAdapter::class => function($dic) : Flysystem\FilesystemAdapter
    {
        $options = $dic->get(Flysystem\Ftp\FtpConnectionOptions::class);
        return new Flysystem\Ftp\FtpAdapter($options);
    },

    Flysystem\Ftp\FtpConnectionOptions::class => function($dic) : Flysystem\Ftp\FtpConnectionOptions {
        return Flysystem\Ftp\FtpConnectionOptions::fromArray([
            'host'     => dotenv('FTP_HOST'),        // required
            'root'     => dotenv('FTP_PATH_PREFIX'), // required
            'username' => dotenv('FTP_USER'),        // required
            'password' => dotenv('FTP_PASS'),        // required
            'port'     => (int) dotenv('FTP_PORT'),
            'ssl'      => (bool) dotenv('FTP_SSL')
        ]);
    }
);
