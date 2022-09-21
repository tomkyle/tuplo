<?php

namespace tomkyle\Uploader;

class UploaderFactory
{
    /**
     * @param  array<mixed> $config Upload configuration
     */
    public static function fromArray(array $config): Uploader
    {
        $filesystem = FlysystemFactory::fromArray($config);
        $uploader = new FlysystemUploader($filesystem);

        $download_prefix = $config['downloadUrl'] ?? null;
        if ($download_prefix) {
            if (!is_string($download_prefix)) {
                $msg = sprintf("Invalid download prefix: expected string, got %s", gettype($download_prefix));
                throw new \UnexpectedValueException($msg);
            }
            $uploader = new DownloadableUploader($uploader, $download_prefix);
        }

        return $uploader;
    }
}
