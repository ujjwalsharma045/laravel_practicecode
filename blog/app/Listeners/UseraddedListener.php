<?php

namespace App\Listeners;

use App\Events\Useradded;
use Mail;
class UseraddedListener 
{
    //use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

   
    public function handle(Useradded $event)
    {
		Mail::send('emails.user' , [
			     'email'=>$event->detail['email'],
			     'name'=>$event->detail['first_name'],
			     'address'=>$event->detail['address'],
			     'contact'=>$event->detail['contact']
		      ] , function($message)use($event){
				    $message->from('hello@app.com', 'Your Application');
					$message->to($event->detail['email'], @$event->detail['first_name'])->subject('Thanks For Registration');
			  });
        // Access the podcast using $event->podcast...
    }
}
