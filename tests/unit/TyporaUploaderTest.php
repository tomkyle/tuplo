<?php
namespace tests;

use tomkyle\Uploader\TyporaUploader;
use tomkyle\Uploader\Uploader;
use tomkyle\Uploader\VariadicUploader;
use Prophecy;


class TyporaUploaderTest extends \PHPUnit\Framework\TestCase
{
    public function testInstantiation() : TyporaUploader
    {
        $prophet = new Prophecy\Prophet;

        $uploader_mock = $prophet->prophesize(VariadicUploader::class);
        $uploader = $uploader_mock->reveal();

        $sut = new TyporaUploader($uploader);

        $this->assertInstanceOf(TyporaUploader::class, $sut);

        return $sut;
    }

    /**
     * @depends testInstantiation
     */
    public function testUploaderSetter( $sut ) : void
    {
        $prophet = new Prophecy\Prophet;

        $uploader_mock = $prophet->prophesize(VariadicUploader::class);
        $uploader = $uploader_mock->reveal();

        $result = $sut->setVariadicUploader($uploader);

        $this->assertSame($result, $sut);
        $this->assertInstanceOf(TyporaUploader::class, $result);
    }
}
