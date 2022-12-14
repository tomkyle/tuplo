<?php

namespace tomkyle\Uploader;

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;

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
     * @param  string        $use     Configuration name to use
     * @param  array<string> $files Array with files to upload
     */
    public function __invoke(string $use, $files, OutputInterface $output): int
    {
        $config = $this->configs->get($use);
        if (!is_array($config)) {
            $msg = sprintf("Invalid configuration: expected array, got %s", gettype($config));
            throw new \UnexpectedValueException($msg);
        }

        // The actual uploader
        $uploader = UploaderFactory::fromArray($config);

        // Allow for multiple uploads in one command line
        $uploader = new VariadicUploader($uploader);

        $results = $uploader(...$files);
        $output->writeln($results);

        return Command::SUCCESS;
    }
}
