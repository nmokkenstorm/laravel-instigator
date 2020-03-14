<?php

namespace Tests;

use Mockery;
use Instigator\ServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * @return void
     */
    public function tearDown() : void
    {
        $this->addToAssertionCount(
            Mockery::getContainer()->mockery_getExpectationCount()
        );
        
        Mockery::close();

        parent::tearDown();
    }

    /**
     * @param $app
     */
    protected function getPackageProviders($app)
    {
        return [
            ServiceProvider::class
        ];
    }
}
