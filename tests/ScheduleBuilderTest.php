<?php

namespace Tests;

use Mockery;

use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Collection;

use Instigator\Contracts\BuildsSchedules;
use Instigator\Contracts\ContainsScheduleConfig;
use Instigator\Contracts\ContainsScheduleEntries;

use Instigator\ScheduleBuilder;

class ScheduleBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_add_entries_to_a_schedule()
    {
        $type       = 'command';
        $target     = DummyCommand::class;
        $args       = ['dummy-arg'];
        $schedule   = 'daily';

        $config = $this->createConfig($type, $target, $schedule, $args);

        $repository = Mockery::mock(ContainsScheduleEntries::class);

        $repository->shouldReceive('get')
                   ->once()
                   ->andReturn(Collection::make([$config]));

        $event = Mockery::mock(Event::class);

        $event->shouldReceive($schedule)
              ->once()
              ->andReturn($event);

        $schedule = Mockery::mock(Schedule::class);

        $schedule->shouldReceive($type)
                 ->once()
                 ->with($target, $args)
                 ->andReturn($event);

        (new ScheduleBuilder($repository))->configure($schedule);
    }

    /**
     * Helper function for generating config stubs
     *
     * @param string        $type       any of command, call, job or exec
     * @param $target       $target     identifier for the above
     * @param string        $schedule   daily, hourly, etc.
     * @param mixed         $args       extra arguments to pass to the target
     */
    protected function createconfig(string $type, string $target, string $schedule, $args)
    {
        $config = Mockery::mock(ContainsScheduleConfig::class);

        $config->shouldReceive('getType')
               ->once()
               ->andReturn($type);

        $config->shouldReceive('getTarget')
               ->once()
               ->andReturn($target);

        $config->shouldReceive('resolveArguments')
               ->once()
               ->andReturn($args);

        $config->shouldReceive('getSchedule')
               ->once()
               ->andReturn($schedule);

        return $config;
    }
}

/**
 * @internal
 */
class DummyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dummy:command {user?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A dummy command for testing the scheduler';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
    } 
}
