<?php

namespace tests;

use tomkyle\Uploader\VariadicUploader;
use tomkyle\Uploader\Uploader;
use Prophecy;

class VariadicUploaderTest extends \PHPUnit\Framework\TestCase
{
    public function testInstantiation(): VariadicUploader
    {
        $prophet = new Prophecy\Prophet();

        $uploader_mock = $prophet->prophesize(Uploader::class);
        $uploader = $uploader_mock->reveal();

        $sut = new VariadicUploader($uploader);

        $this->assertInstanceOf(VariadicUploader::class, $sut);

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
        $this->assertInstanceOf(VariadicUploader::class, $result);
    }
}
