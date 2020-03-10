<?php

namespace Instigator;

use Illuminate\Console\Scheduling\Schedule;

use Instigator\Contracts\BuildsSchedules;
use Instigator\Contracts\ContainsScheduleConfig;
use Instigator\Contracts\ContainsScheduleEntries;

class ScheduleBuilder implements BuildsSchedules
{
    /**
     * @var ContainsScheduleEntries
     */
    private $repository;

    /**
     * @param ContainsScheduleEntries $repository
     */
    public function __construct(ContainsScheduleEntries $repository)
    {
        $this->repository = $repository; 
    }

    /**
     * @param Schedule $schedule
     * @return void
     */
    public function configure(Schedule $schedule) : void
    {
        $this->repository->get()->each(
            function (ContainsScheduleConfig $config) use ($schedule) : void {
                $this->configureEntry($schedule, $config);
            }
        );
    }

    /**
     * @param Schedule $schedule
     * @param ContainsScheduleConfig $config
     * @return void
     */
    private function configureEntry(Schedule $schedule, ContainsScheduleConfig $config) : void
    {
        $schedule->{$config->getType()}($config->getTarget(), $config->resolveArguments())->{$config->getSchedule()}();
    }
}
