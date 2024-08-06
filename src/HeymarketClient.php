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

    // Contacts Endpoints
    public function getContacts($params = [])
    {
        return $this->request('POST', 'contacts', ['json' => $params]);
    }

    public function createContact($data)
    {
        return $this->request('POST', 'contact', ['json' => $data]);
    }

    public function getContact($contactId)
    {
        return $this->request('GET', 'contact/' . $contactId);
    }

    public function updateContact($contactId, $data)
    {
        return $this->request('PUT', 'contact/' . $contactId, ['json' => $data]);
    }

    public function deleteContact($contactId)
    {
        return $this->request('DELETE', 'contact/' . $contactId);
    }

    public function getContactFields($params = [])
    {
        return $this->request('POST', 'contact-fields', ['json' => $params]);
    }

    public function getContactStatus($params)
    {
        return $this->request('POST', 'contact/status', ['json' => $params]);
    }

    public function setContactStatus($params)
    {
        return $this->request('POST', 'contact/set_status', ['json' => $params]);
    }

    public function createBatchContacts($contacts, $overwrite = false)
    {
        return $this->request('POST', 'batch/contacts', ['json' => $contacts, 'query' => ['overwrite' => $overwrite]]);
    }

    // Messages Endpoints
    public function getMessages($phoneNumber, $inboxId, $timestamp = null)
    {
        $query = [
            'phoneNumber' => $phoneNumber,
            'inboxID' => $inboxId,
        ];
        if ($timestamp) {
            $query['timestamp'] = $timestamp;
        }
        return $this->request('GET', 'messages', ['query' => $query]);
    }

    public function getAllMessages($params = [])
    {
        return $this->request('POST', 'messages/all', ['json' => $params]);
    }

    public function sendMessage($data)
    {
        return $this->request('POST', 'message/send', ['json' => $data]);
    }

    // Inboxes Endpoints
    public function getInboxes()
    {
        return $this->request('GET', 'inboxes');
    }

    // Users Endpoints
    public function getUsers($params)
    {
        return $this->request('GET', 'users/get', ['json' => $params]);
    }

    public function updateUser($params)
    {
        return $this->request('POST', 'users/update', ['json' => $params]);
    }

    // Teams Endpoints
    public function getTeam()
    {
        return $this->request('GET', 'team');
    }

    // Conversations Endpoints
    public function getConversations($params)
    {
        return $this->request('POST', 'conversations', ['json' => $params]);
    }

    public function markConversationRead($params)
    {
        return $this->request('POST', 'conversations/read', ['json' => $params]);
    }

    public function markConversationUnread($params)
    {
        return $this->request('POST', 'conversations/unread', ['json' => $params]);
    }

    public function reassignConversation($params)
    {
        return $this->request('POST', 'conversations/reassign', ['json' => $params]);
    }

    public function openConversation($params)
    {
        return $this->request('POST', 'conversations/open', ['json' => $params]);
    }

    public function closeConversation($params)
    {
        return $this->request('POST', 'conversations/close', ['json' => $params]);
    }

    public function transferConversation($params)
    {
        return $this->request('POST', 'conversations/transfer', ['json' => $params]);
    }

    // Lists Endpoints
    public function createList($data)
    {
        return $this->request('POST', 'list', ['json' => $data]);
    }

    public function getList($listId)
    {
        return $this->request('GET', 'list/' . $listId);
    }

    public function updateList($listId, $data)
    {
        return $this->request('PUT', 'list/' . $listId, ['json' => $data]);
    }

    public function deleteList($listId)
    {
        return $this->request('DELETE', 'list/' . $listId);
    }

    public function getAllLists($params = [])
    {
        return $this->request('POST', 'lists', ['json' => $params]);
    }

    // Templates Endpoints
    public function getTemplates($params = [])
    {
        return $this->request('POST', 'templates', ['json' => $params]);
    }

    public function createTemplate($data)
    {
        return $this->request('POST', 'template', ['json' => $data]);
    }

    public function getTemplate($templateId)
    {
        return $this->request('GET', 'template/' . $templateId);
    }

    public function updateTemplate($templateId, $data)
    {
        return $this->request('PUT', 'template/' . $templateId, ['json' => $data]);
    }

    public function deleteTemplate($templateId)
    {
        return $this->request('DELETE', 'template/' . $templateId);
    }

    // Helper function to make requests
    protected function request($method, $uri, $options = [])
    {
        $response = $this->http->request($method, $uri, $options);
        return json_decode($response->getBody(), true);
    }
}
