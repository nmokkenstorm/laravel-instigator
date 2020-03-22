<?php

namespace Instigator;

use Illuminate\Support\Enumerable;
use Instigator\Contracts\ContainsScheduleEntries;

class DatabaseScheduleConfigRepository implements ContainsScheduleEntries
{
    /**
     * @return Enumerable<ContainsScheduleConfig> 
     */
    public function get() : Enumerable
    {
        // 
    }
}
