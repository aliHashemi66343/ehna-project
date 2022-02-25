<?php

namespace App\Listeners;

use App\Events\MosahebeAdded;
use App\Mail\MailMosahebeToUser;
use App\Models\Mosahebe;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ListenToMosahebeAdded
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(MosahebeAdded $event)
    {
        //

//        $mosahebe=new Mosahebe;

        echo($event->mosahebe);
//        DB::table("mosahebes")->insert(['title'=>$event->mosahebe->title,'detail'=>$event->mosahebe->detail,'date'=>$event->mosahebe->date]);
//        $mosahebe->title=$event->mosahebe->title;
//        $mosahebe->detail=$event->mosahebe->detail;
//        $mosahebe->date=$event->mosahebe->date;
//        $mosahebe->save();
        Mail::to(Auth::user()->email)->send(new MailMosahebeToUser($event->mosahebe));
    }
}
