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
        $this->to = $to;
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



    }

    public function toArray()
    {
        return [
            'phone_number' => $this->to,
            'text' => $this->body,
            'inbox_id' => $this->inboxId ?: config('heymarket.default_inbox_id'),
            'media_url' => $this->mediaUrl,
            'creator_id' => $this->creatorId ?: config('heymarket.default_creator_id')
        ];
    }
}
