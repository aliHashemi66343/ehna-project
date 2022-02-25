<?php

namespace App\Jobs;

use App\Mail\MailMosahebeToUser;
use App\Models\Mosahebe;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Auth;
use Mail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $email;
    protected $emailClass;
    public $mosahebe;
    /**
     * Create a new job instance.
     *
     * @return void
     */

    public function __construct($mosahebe)
    {
//        $this->email = $email;
//        $this->emailClass= $emailClass;
        $this->mosahebe=$mosahebe;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mosahebe=Mosahebe::find(1);
        Mail::to(Auth::user()->email)->send(new MailMosahebeToUser($mosahebe));
    }
}
