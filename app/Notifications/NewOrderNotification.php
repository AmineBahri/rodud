<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOrderNotification extends Notification
{
    use Queueable;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        // Define notification channels (e.g., mail, database, SMS)
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Order Received')
            ->line('A new order has been placed.')
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            'order' => $this->order,
            'message' => 'Your order has been created.',
        ];
    }

    public function databaseType(object $notifiable): string
    {
        return 'order-created';
    }
}
