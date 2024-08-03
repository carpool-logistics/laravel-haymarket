<?php

namespace CarpoolLogistics\Heymarket;

use GuzzleHttp\Client;

class HeymarketClient
{
    protected $http;

    public function __construct($apiKey)
    {
        $this->http = new Client([
            'base_uri' => 'https://api.heymarket.com/v1/',
            'headers' => [
                'Authorization' => 'Bearer ' . $apiKey,
                'Accept' => 'application/json',
            ]
        ]);
    }

    // Contacts
    public function getContacts()
    {
        return $this->request('GET', 'contacts');
    }

    public function createContact($data)
    {
        return $this->request('POST', 'contacts', ['json' => $data]);
    }

    public function getContact($contactId)
    {
        return $this->request('GET', 'contacts/' . $contactId);
    }

    public function updateContact($contactId, $data)
    {
        return $this->request('PUT', 'contacts/' . $contactId, ['json' => $data]);
    }

    public function deleteContact($contactId)
    {
        return $this->request('DELETE', 'contacts/' . $contactId);
    }

    // Messages
    public function getMessages()
    {
        return $this->request('GET', 'messages');
    }

    public function createMessage($data)
    {
        return $this->request('POST', 'messages', ['json' => $data]);
    }

    public function getMessage($messageId)
    {
        return $this->request('GET', 'messages/' . $messageId);
    }

    public function deleteMessage($messageId)
    {
        return $this->request('DELETE', 'messages/' . $messageId);
    }

    // Teams
    public function getTeams()
    {
        return $this->request('GET', 'teams');
    }

    public function createTeam($data)
    {
        return $this->request('POST', 'teams', ['json' => $data]);
    }

    public function getTeam($teamId)
    {
        return $this->request('GET', 'teams/' . $teamId);
    }

    public function updateTeam($teamId, $data)
    {
        return $this->request('PUT', 'teams/' . $teamId, ['json' => $data]);
    }

    public function deleteTeam($teamId)
    {
        return $this->request('DELETE', 'teams/' . $teamId);
    }

    // Tags
    public function getTags()
    {
        return $this->request('GET', 'tags');
    }

    public function createTag($data)
    {
        return $this->request('POST', 'tags', ['json' => $data]);
    }

    public function getTag($tagId)
    {
        return $this->request('GET', 'tags/' . $tagId);
    }

    public function updateTag($tagId, $data)
    {
        return $this->request('PUT', 'tags/' . $tagId, ['json' => $data]);
    }

    public function deleteTag($tagId)
    {
        return $this->request('DELETE', 'tags/' . $tagId);
    }

    // Request Helper
    protected function request($method, $uri, $options = [])
    {
        $response = $this->http->request($method, $uri, $options);
        return json_decode($response->getBody(), true);
    }
}
