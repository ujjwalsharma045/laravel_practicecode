<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
class SendSubscriptionEmail extends Job implements ShouldQueue
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
		foreach($this->request['email'] as $key=>$value){
			Mail::send('emails.subscription' , [			    
					 'content'=>$this->request['content'],			    
				  ] , function($message)use($value){
						$message->from('hello@app.com', 'Your Application');
						$message->to($value)->subject('Thanks For subscription with queue');
			});
		}
    }
}
