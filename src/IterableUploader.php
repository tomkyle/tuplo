<?php

namespace tomkyle\Uploader;

class IterableUploader
{
    use UploaderAwareTrait;

    public function __construct(Uploader $uploader)
    {
        $this->setUploader($uploader);
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
