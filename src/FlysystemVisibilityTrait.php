<?php

namespace tomkyle\Uploader;

/**
 * @see https://flysystem.thephpleague.com/docs/visibility/
 */
trait FlysystemVisibilityTrait
{
    /**
     * @var string
     */
    public $visibility = "private";

    public function setVisibility(string $visibility): self
    {
        if (!in_array($visibility, ["public", "private"])) {
            $msg = sprintf("Invalid value '%s', expected 'public' or 'private'", $visibility);
            throw new \InvalidArgumentException($msg);
        }
        $this->visibility = $visibility;
        return $this;
    }

    public function getVisibility(): string
    {
        return $this->visibility;
    }
}
