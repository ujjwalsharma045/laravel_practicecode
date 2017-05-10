<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Useradded extends Event
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
	
	public $detail;
	
    public function __construct($request)
    {
		$this->detail = $request;
        //
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
