<?php

namespace App\Console\Commands;

use App\Services\BossTimer;
use Illuminate\Console\Command;

class BossCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'boss';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Like a boss.';

    protected $timer;

    /**
     * BossCommand constructor.
     * @param BossTimer $timer
     */
    public function __construct(BossTimer $timer)
    {
        $this->timer = $timer;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->timer->take();
        $this->alert('Like a boss');

         $this->info('call migrate:fresh');
         $this->call('migrate:fresh');


        $this->info('call migrate');
        $this->call('migrate');

        $this->info('call seed');
        $this->call('db:seed');

        $this->alert('Boss command complete, it took: ' . $this->timer->difference());
    }
}
