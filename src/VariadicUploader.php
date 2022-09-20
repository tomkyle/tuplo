<?php

namespace tomkyle\Uploader;

class VariadicUploader
{
    use UploaderAwareTrait;

    public function __construct(Uploader $uploader)
    {
        $this->setUploader($uploader);
    }

    /**
     * @param  string ...$sources
     * @return string[]
     */
    public function __invoke(...$sources): array
    {
        $out = array();
        foreach ($sources as $source) {
            array_push($out, ($this->uploader)($source));
        }

        return $out;
    }
}
