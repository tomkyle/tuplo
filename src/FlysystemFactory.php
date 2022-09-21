<?php

namespace tomkyle\Uploader;

use League\Flysystem;

class FlysystemFactory
{
    /**
     * @param  array<mixed> $configuration
     */
    public static function fromArray(array $configuration): Flysystem\Filesystem
    {
        $method = $configuration['method'] ?? 'ftp';
        if (!is_string($method)) {
            $msg = sprintf("Invalid upload method: expected string, got %s", gettype($method));
            throw new \UnexpectedValueException($msg);
        }
        $adapter = null;

        switch($method) {
            case "ftp":
                $options = Flysystem\Ftp\FtpConnectionOptions::fromArray($configuration);
                $adapter = new Flysystem\Ftp\FtpAdapter($options);
                break;

            case "sftp":

                $connection_provider = new Flysystem\PhpseclibV3\SftpConnectionProvider(
                    $configuration['host'],               // host (required)
                    $configuration['username'],           // username (required)
                    $configuration['password']   ?? null, // password (optional, set to null if privateKey is used)
                    $configuration['privateKey'] ?? null,
                    $configuration['privateKeyPass'] ?? null,
                    $configuration['port']           ?? 22,
                    $configuration['useAgent']       ?? false, // use agent (optional, default: false)
                    $configuration['timeout']        ?? 10,    // timeout (optional, default: 10)
                    $configuration['maxTries']       ?? 4,     // max tries (optional, default: 4)
                    $configuration['fingerprint']    ?? null,  // host fingerprint (optional, default: null),
                    $configuration['connectivityChecker'] ?? null
                );

                $root_path = $configuration['root']; // (required)

                $visibility = Flysystem\UnixVisibility\PortableVisibilityConverter::fromArray([
                    'file' => ['public' => 0640, 'private' => 0604 ],
                    'dir' =>  ['public' => 0740, 'private' => 7604 ],
                ]);

                $adapter = new Flysystem\PhpseclibV3\SftpAdapter(
                    $connection_provider,
                    $root_path,
                    $visibility
                );
                break;
            default:
                break;
        }

        if (!$adapter) {
            $msg = sprintf("Unknown method used in upload configuration: '%s'", $method);
            throw new \RuntimeException($msg);
        }

        return new Flysystem\Filesystem($adapter);
    }
}
