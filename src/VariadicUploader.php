<?php
namespace tomkyle\Uploader;

class VariadicUploader
{

    /**
     * @var Uploader
     */
    public $uploader;

    /**
     * @var string
     */
    public $separator = \PHP_EOL;

    public function __construct(Uploader $uploader)
    {
        $this->uploader = $uploader;
    }

    public function __invoke( ...$sources ) : array
    {
        $out = array();
        foreach($sources as $source) {
            array_push($out, ($this->uploader)($source));
        }

        return $out;
    }
}
