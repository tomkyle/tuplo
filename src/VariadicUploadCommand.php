<?php

namespace tomkyle\Uploader;

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;

class VariadicUploadCommand
{
    /**
     * @var ContainerInterface
     */
    public $configs;

    public function __construct(ContainerInterface $configs)
    {
        $this->setConfigurations($configs);
    }

    public function setConfigurations(ContainerInterface $configs): self
    {
        $this->configs = $configs;
        return $this;
    }


    /**
     * @param  string        $name    Configuration name
     * @param  array<string> $sources Array with files to upload
     */
    public function __invoke(string $name, $sources): int
    {
        $config = $this->configs->get($name);
        if (!is_array($config)) {
            $msg = sprintf("Invalid configuration: expected array, got %s", gettype($config));
            throw new \UnexpectedValueException($msg);
        }

        // The actual uploader
        $uploader = UploaderFactory::fromArray($config);

        // Allow for multiple uploads in one command line
        $uploader = new VariadicUploader($uploader);

        $results = $uploader(...$sources);
        echo implode(PHP_EOL, $results), PHP_EOL;

        return Command::SUCCESS;
    }
}
