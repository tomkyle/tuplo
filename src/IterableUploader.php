<?php

namespace tomkyle\Uploader;

class IterableUploader
{
    /**
     * @var Uploader
     */
    public $uploader;

    public function __construct(Uploader $uploader)
    {
        $this->setUploader($uploader);
    }

    public function setUploader(Uploader $uploader): self
    {
        $this->uploader = $uploader;
        return $this;
    }

    /**
     * @param  iterable<string> $sources
     * @return string[]
     */
    public function __invoke(iterable $sources): array
    {
        $out = array();
        foreach ($sources as $source) {
            array_push($out, ($this->uploader)($source));
        }

        return $out;
    }
}
