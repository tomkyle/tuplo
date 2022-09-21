<?php

namespace tomkyle\Uploader;

interface UploaderAware
{
    public function setUploader(Uploader $uploader): self;
}
