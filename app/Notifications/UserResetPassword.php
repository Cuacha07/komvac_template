<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserResetPassword extends Notification
{
    use Queueable;

    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
    * The rrl for password reset form
    *
    * @var string
    */
    public $url;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token, $isCMS)
    {
        $this->token = $token;

        //CMS URL?
        if($isCMS == true) {
            $this->url = 'admin/password/reset';
        } else {
            $this->url = 'password/reset';
        }
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
                    /*->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');*/
                    ->subject(trans('passwords.password_reset'))
                    ->greeting(trans('passwords.hi'))
                    ->line(trans('passwords.message'))
                    ->action(trans('passwords.password_reset'), url($this->url, $this->token).'?email='.urlencode($notifiable->email))
                    ->line(trans('passwords.message2'));
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
