<?php

namespace Instigator\Contracts;

use Illuminate\Console\Scheduling\Schedule;

interface BuildsSchedules
{
    /**
     * @param Schedule $schedule
     * @return void
     */
    public function configure(Schedule $schedule) : void;
}
