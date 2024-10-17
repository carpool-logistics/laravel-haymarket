<?php

namespace CarpoolLogistics\Heymarket;

class HeymarketMessage
{
    public $to;
    public $body;
    public $inboxId;
    public $creatorId;
    public $mediaUrl;

    public static function create()
    {
        return new static();
    }

    public function to($to)
    {
        $this->to = str_replace('+', '', $to);
        return $this;
    }

    public function body($body)
    {
        $this->body = $body;
        return $this;
    }

    public function mediaUrl($mediaUrl)
    {
        $this->mediaUrl = $mediaUrl;
        return $this;
    }

    public function inboxId($inboxId)
    {
        $this->inboxId = $inboxId;
        return $this;
    }

    public function creatorId($creatorId)
    {
        $this->creatorId = $creatorId;
        return $this;
    }

    public function creatorEmail($email){

        try {

            $client = new HeymarketClient(config('heymarket.api_key'));
            $params = ['email' => [$email]];
            $users = $client->getUsers($params);
            if (isset($users->memberships[0])) {
                $this->creatorId = $users->memberships[0]->id;
            }

            return $this;

        }
        catch (\Throwable $e){
            return $this;
        }


    }

    public function toArray()
    {
        return [
            'phone_number' => $this->to,
            'text' => $this->body,
            'inbox_id' => (int) $this->inboxId ?: (int) config('heymarket.default_inbox_id'),
            'media_url' => $this->mediaUrl,
            'creator_id' => (int) $this->creatorId ?: (int) config('heymarket.default_creator_id')
        ];
    }
}
