<?php

namespace Modules\LaravelPreset\Console\Commands;

use App\Traits\DeleteUserTrait;
use Illuminate\Console\Command;

class DeleteUserCommand extends Command
{
   use DeleteUserTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:delete {id} {--skip=false}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       $skippable= ($this->option('skip') == 'true');
       if (!$skippable) {
          if (!$this->confirm('Are you sure want to remove the user completely?')) {
             return false;
          }
       }

       try {
          $this->remove($this->argument('id'));
          return 0;
       } catch (\Throwable $th) {
          throw $th;
       }

    }
}
