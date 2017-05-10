<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
class OtherCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:changestatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change description';

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
     * @return mixed
     */
    public function handle()
    {
       DB::table('users')->where('password' , '')->update(['admin'=>'2']); 
       $this->info('All user city updated successfully');	
    }
}
