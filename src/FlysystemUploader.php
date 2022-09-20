<?php

namespace tomkyle\Uploader;

use League\Flysystem;

class FlysystemUploader implements Uploader
{
    /**
     * @var Flysystem\Filesystem
     */
    public $filesystem;

    public function __construct(Flysystem\Filesystem $filesystem)
    {
        $this->setFilesystem($filesystem);
    }

    public function setFilesystem(Flysystem\Filesystem $filesystem): self
    {
        $this->filesystem = $filesystem;
        return $this;
    }

    public function __invoke(string $source): string
    {
        if (!is_readable($source)) {
            $msg = sprintf("File not readable: %s", $source);
            throw new \RuntimeException($msg);
        }

        $source_content = file_get_contents($source);
        if (!is_string($source_content)) {
            $msg = sprintf("Could not read file content: %s", $source);
            throw new \RuntimeException($msg);
        }

        $this->filesystem->write($source, $source_content);

        return (string) $source;
    }
}
