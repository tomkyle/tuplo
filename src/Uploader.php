<?php

namespace tomkyle\Uploader;

interface Uploader
{
    /**
     * @param string $source
     */
    public function __invoke(string $source): string;

    /**
     * Allowed values: `public` or `private`
     *
     * @param string $visibility
     */
    public function setVisibility(string $visibility): self;

    /**
     * @return string `public` or `private`
     */
    public function getVisibility(): string;
}
