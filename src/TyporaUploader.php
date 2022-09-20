<?php

namespace tomkyle\Uploader;

use League\Flysystem;

class TyporaUploader
{

    /**
     * @var VariadicUploader
     */
    public $uploader;

    public function __construct(VariadicUploader $uploader)
    {
        $this->setVariadicUploader($uploader);
    }

    public function setVariadicUploader(VariadicUploader $uploader) : self
    {
        $this->uploader = $uploader;
        return $this;
    }

    public function __invoke(string $source1, ?string $source2) : array {
        $sources = array_filter([$source1, $source2]);

        $results = ($this->uploader)( ...$sources );

        echo implode(PHP_EOL, $results), PHP_EOL;
        return $results;
    }
}
