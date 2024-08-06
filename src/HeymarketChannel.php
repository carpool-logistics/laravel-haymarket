<?php

namespace CarpoolLogistics\Heymarket;

use Illuminate\Notifications\Notification;

class HeymarketChannel
{
    protected $client;

    public function __construct(HeymarketClient $client)
    {
        $this->client = $client;
    }

    public function send($notifiable, Notification $notification)
    {
        if (!method_exists($notification, 'toHeymarket')) {
            throw new \Exception('Notification must have a toHeymarket method.');
        }

        $message = $notification->toHeymarket($notifiable);

        if (is_array($message)) {
            $this->client->sendMessage(array_map(function ($msg) {
                return $msg->toArray();
            }, $message));
        } else {
            $this->client->sendMessage($message->toArray());
        }
    }
}
