<?php
namespace tomkyle\Uploader;

interface Uploader
{

    /**
     * @param  string[] $sources
     */
    public function __invoke(string $source ) : string;
}
