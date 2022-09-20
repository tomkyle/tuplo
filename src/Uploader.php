<?php

namespace tomkyle\Uploader;

interface Uploader
{
    /**
     * @param string $source
     */
    public function __invoke(string $source): string;
}
