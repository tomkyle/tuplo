<?php

namespace tomkyle\Uploader;

trait UploaderAwareTrait
{
    /**
     * @var Uploader
     */
    public $uploader;

    public function setUploader(Uploader $uploader): self
    {
        $this->uploader = $uploader;
        return $this;
    }
}
