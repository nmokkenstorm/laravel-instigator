<?php

namespace Tests;

use Instigator\DatabaseScheduleConfigRepository;

class DatabaseScheduleConfigRepositoryTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_be_able_to_retrieve_configuration()
    {
        $repository = $this->app->make(DatabaseScheduleConfigRepository::class);

        $repository->get();
    }
}
