<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\VonageMessage;

class NewOrder extends Notification
{
    use Queueable;

    public $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // //laravel notification channels
        //  // mail, database , broadcast, vonage(nexmu), slack


        // $notification_channel = 'database, broadcast, vonage';
        // $channels = explode(',', $notification_channel);

        $notification_channel = 'vonage';
        $channels = explode(',', $notification_channel);
        return ['vonage'];

        // //explode() >> take an text and convert it to an simple array ..
        // //emplode() >> take an array and convert it to a text..

        // return $channels;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    public function toVonage($notifiable)
    {
         return (new VonageMessage)
                      ->content('هذه رسالة تجربة من خلدون')->unicode();
                    //   ->content('This is test message from khaldon');
    }

    // public function toDatabase()
    // {
    //         return [
    //             'data' => 'Theres New Order('. $this->order->user->name.') With Number(#'. $this->order->id.')',
    //             'url' => url('/')
    //         ];
    // }

    // public function toBroadcast()
    // {
    //     return [
    //         'data' => 'Theres New Order('. $this->order->user->name.') With Number(#'. $this->order->id.')',
    //         'url' => url('/')
    //     ];
    // }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)//this one use with two : database & broadcast
    {
        return [
            'data' => 'Theres New Order('. $this->order->user->name.') With Number(#'. $this->order->id.')',
            'url' => url('/')
        ];
    }
}
