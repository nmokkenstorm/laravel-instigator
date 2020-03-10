<?php

namespace Instigator\Contracts;

interface ContainsScheduleEntries
{
    /**
     * @param Callable $callback
     * @return void
     */
    public function each(Callable $callback) : void;
}
