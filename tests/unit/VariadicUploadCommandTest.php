<?php

namespace tests;

use tomkyle\Uploader\VariadicUploadCommand;
use tomkyle\Uploader\Uploader;
use Psr\Container\ContainerInterface;
use Prophecy;

class VariadicUploadCommandTest extends \PHPUnit\Framework\TestCase
{
    public function testInstantiation(): VariadicUploadCommand
    {
        $prophet = new Prophecy\Prophet();
        $container_mock = $prophet->prophesize(ContainerInterface::class);
        $container = $container_mock->reveal();

        $sut = new VariadicUploadCommand($container);

        $this->assertIsCallable($sut);

        return $sut;
    }


    /**
     * @depends testInstantiation
     */
    public function testConfigurationsSetter(VariadicUploadCommand $sut): void
    {
        $prophet = new Prophecy\Prophet();
        $container_mock = $prophet->prophesize(ContainerInterface::class);
        $container = $container_mock->reveal();

        $result = $sut->setConfigurations($container);

        $this->assertSame($result, $sut);
    }
}
