<?php

namespace tests;

use tomkyle\Uploader\IterableUploader;
use tomkyle\Uploader\Uploader;
use Prophecy;

class IterableUploaderTest extends \PHPUnit\Framework\TestCase
{
    public function testInstantiation(): IterableUploader
    {
        $prophet = new Prophecy\Prophet();

        $uploader_mock = $prophet->prophesize(Uploader::class);
        $uploader = $uploader_mock->reveal();

        $sut = new IterableUploader($uploader);

        $this->assertInstanceOf(IterableUploader::class, $sut);

        return $sut;
    }



    /**
     * @depends testInstantiation
     */
    public function testUploaderSetter($sut): void
    {
        $prophet = new Prophecy\Prophet();

        $uploader_mock = $prophet->prophesize(Uploader::class);
        $uploader = $uploader_mock->reveal();


        $result = $sut->setUploader($uploader);

        $this->assertSame($result, $sut);
        $this->assertInstanceOf(IterableUploader::class, $result);
    }
}
