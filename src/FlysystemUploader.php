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
        $this->filesystem = $filesystem;
    }

    public function __invoke(string $source ) : string
    {
        if (!is_readable($source)) {
            throw new \RuntimeException("File not readable: $source");
        }

        $source_content = file_get_contents($source);
        $this->filesystem->write($source, $source_content);

        return (string) $source;
    }
}
