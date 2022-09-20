<?php
namespace tests;

use tomkyle\Uploader\FlysystemUploader;
use tomkyle\Uploader\Uploader;
use League\Flysystem;
use Prophecy;


class FlysystemUploaderTest extends \PHPUnit\Framework\TestCase
{
    public function testInstantiation() : FlysystemUploader
    {
        $prophet = new Prophecy\Prophet;

        $flysystem_mock = $prophet->prophesize(Flysystem\Filesystem::class);
        $flysystem = $flysystem_mock->reveal();

        $sut = new FlysystemUploader($flysystem);

        $this->assertInstanceOf(Uploader::class, $sut);

        return $sut;
    }

    /**
     * @depends testInstantiation
     */
    public function testFilesystemSetter( $sut ) : void
    {
        $prophet = new Prophecy\Prophet;
        $flysystem_mock = $prophet->prophesize(Flysystem\Filesystem::class);
        $flysystem = $flysystem_mock->reveal();

        $result = $sut->setFilesystem($flysystem);

        $this->assertSame($result, $sut);
        $this->assertInstanceOf(Uploader::class, $result);
    }
}
