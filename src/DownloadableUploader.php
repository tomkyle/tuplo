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
        $this->uploader = $uploader;
        $this->download_prefix = $download_prefix;
    }

    public function __invoke(string $source ) : string
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
