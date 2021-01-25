<?php

namespace Tipoff\Waivers\Commands;

use Illuminate\Console\Command;

class WaiversCommand extends Command
{
    public $signature = 'waivers';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
