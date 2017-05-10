<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use DB;
class CustomCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:deleteinactiveusers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes Inactive Users';

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
	 
    public function handle(){
       DB::table('users')->where('password' , '')->delete(); 
       $this->info('All Inactive user deleted successfully');	   
    }
}