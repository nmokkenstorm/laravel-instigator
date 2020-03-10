<?php

namespace Instigator\Contracts;

use Illuminate\Support\Enumerable;

interface ContainsScheduleEntries
{
    /**
     * @return Enumerable<ContainsScheduleConfig> 
     */
    public function get() : Enumerable;
}
