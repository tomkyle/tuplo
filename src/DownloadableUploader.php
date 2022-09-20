<?php

namespace tomkyle\Uploader;

class DownloadableUploader implements Uploader
{
    /**
     * @var Uploader
     */
    public $uploader;

    /**
     * @var string
     */
    public $download_prefix;


    public function __construct(Uploader $uploader, string $download_prefix)
    {
        $this->setUploader($uploader);
        $this->setDownloadPrefix($download_prefix);
    }

    public function setDownloadPrefix(string $download_prefix): self
    {
        $this->download_prefix = $download_prefix;
        return $this;
    }

    public function setUploader(Uploader $uploader): self
    {
        $this->uploader = $uploader;
        return $this;
    }

    public function __invoke(string $source): string
    {
        $result = ($this->uploader)($source);
        $result = preg_replace("!^\/!", "", $result);

        $out = join("/", [
            $this->download_prefix,
            $result
        ]);

        return $out;
    }
}
