<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderNotification extends Notification
{
    use Queueable;

    protected $info;

    public function __construct($info)
    {
        $this->info = $info;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'info' => $this->info,
            'user' => [$notifiable->id, $notifiable->username]
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'info' => $this->info
        ]);
    }
}
