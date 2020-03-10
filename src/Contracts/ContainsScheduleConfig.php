<?php

namespace Instigator\Contracts;

interface ContainsScheduleConfig
{
    /**
     * @return string
     */
    public function getType() : string;

    /**
     * @return string
     */
    public function getTarget() : string;

    /**
     * @return mixed
     */
    public function resolveArguments();

    /**
     * @return string
     */
    public function getSchedule() : string;
}
