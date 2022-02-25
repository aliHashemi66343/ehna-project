<?php

namespace App\Notifications;

use App\Models\Mosahebe;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MosahebeNotify extends Notification implements  ShouldQueue
{
    use Queueable;
    public $mosahebe;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Mosahebe $mosahebe)
    {
        //
        $this->mosahebe=$mosahebe;
//        $this->delay($mosahebe->date)->subMinutes(30);
        $this->delay(Carbon::now('Asia/Tehran')->addMinute(1));

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];//notification will be sent via database and mail

    }

//    /**
//     * Get the mail representation of the notification.
//     *
//     * @param  mixed  $notifiable
//     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line($this->mosahebe->title)
                    ->line($this->mosahebe->detail)
                    ->line($this->mosahebe->date);
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
        'repliedTime'=>Carbon::now('Asia/Tehran')->format('h:i:s Y/m/d')
    ];
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
