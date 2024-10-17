<?php

namespace CarpoolLogistics\Heymarket;

use App\Notifications\Plivo\Exceptions\CouldNotSendNotification;
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

        if (! empty($message->additionalContent)) {
            foreach ($message->additionalContent as $content) {
                $this->client->sendMessage([
                    'phone_number' => $message->to,
                    'text' => $content,
                    'inbox_id' => (int) $message->inboxId ?: (int) config('heymarket.default_inbox_id'),
                    'creator_id' => (int) $message->creatorId ?: (int) config('heymarket.default_creator_id')
                ]);
            }
        }

    }
}
