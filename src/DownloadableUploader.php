<?php

namespace tomkyle\Uploader;

class DownloadableUploader implements Uploader
{
    use UploaderAwareTrait;
    use FlysystemVisibilityTrait;

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

    public function __invoke(string $source): string
    {
        // Store inner uploader's visibility setting
        $visibility_backup = $this->uploader->getVisibility();
        $this->uploader->setVisibility($this->visibility);

        $result = ($this->uploader)($source);
        $result = preg_replace("!^\/!", "", $result);

        // Restore previous visibility setting
        $this->uploader->setVisibility($visibility_backup);

        $out = join("/", [
            $this->download_prefix,
            $result
        ]);

        return $out;
    }
}
