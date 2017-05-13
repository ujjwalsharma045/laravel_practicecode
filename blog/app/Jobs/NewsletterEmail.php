<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
class NewsletterEmail extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
	protected $request; 
    public function __construct($request)
    {
        //
		$this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //		
		Mail::send('emails.user' , [
			     'email'=>$this->request['email'],
			     'name'=>$this->request['first_name'],
			     'address'=>$this->request['address'],
			     'contact'=>$this->request['contact']
		      ] , function($message){
				    $message->from('hello@app.com', 'Your Application');
					$message->to($this->request['email'], @$this->request['first_name'])->subject('Thanks For Registration with queue');
		});
	
    }
}
