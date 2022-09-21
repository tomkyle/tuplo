<?php

namespace tests;

use tomkyle\Uploader\DownloadableUploader;
use tomkyle\Uploader\Uploader;
use Prophecy;

class DownloadableUploaderTest extends \PHPUnit\Framework\TestCase
{
    public function testInstantiation(): DownloadableUploader
    {
        $prophet = new Prophecy\Prophet();

        $uploader_mock = $prophet->prophesize(Uploader::class);
        $uploader = $uploader_mock->reveal();

        $prefix = "https://localhost";

        $sut = new DownloadableUploader($uploader, $prefix);

        $this->assertInstanceOf(Uploader::class, $sut);

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
        $this->assertInstanceOf(Uploader::class, $result);
    }
}
