<?php

namespace CarpoolLogistics\Heymarket;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class HeymarketClient
{
    protected $http;

    private $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;

        $this->http = new Client([
            'base_uri' => 'https://api.heymarket.com/v1/'
        ]);
    }

    // Contacts Endpoints
    public function getContacts($params = [])
    {
        return $this->request('POST', 'contacts', $params);
    }

    public function createContact($data)
    {
        return $this->request('POST', 'contact', $data);
    }

    public function getContact($contactId)
    {
        return $this->request('GET', 'contact/' . $contactId);
    }

    public function updateContact($contactId, $data)
    {
        return $this->request('PUT', 'contact/' . $contactId, $data);
    }

    public function deleteContact($contactId)
    {
        return $this->request('DELETE', 'contact/' . $contactId);
    }

    public function getContactFields($params = [])
    {
        return $this->request('POST', 'contact-fields', $params);
    }

    public function getContactStatus($params)
    {
        return $this->request('POST', 'contact/status', $params);
    }

    public function setContactStatus($params)
    {
        return $this->request('POST', 'contact/set_status', $params);
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
        return $this->request('GET', 'messages', $query);
    }

    public function getAllMessages($params = [])
    {
        return $this->request('POST', 'messages/all', $params);
    }

    public function sendMessage($data)
    {
        return $this->request('POST', 'message/send', $data);
    }

    // Inboxes Endpoints
    public function getInboxes()
    {
        return $this->request('GET', 'inboxes');
    }

    // Users Endpoints
    public function getUsers($params)
    {
        return $this->request('GET', 'users/get', $params);
    }

    public function updateUser($params)
    {
        return $this->request('POST', 'users/update', $params);
    }

    // Teams Endpoints
    public function getTeam()
    {
        return $this->request('GET', 'team');
    }

    // Conversations Endpoints
    public function getConversations($params)
    {
        return $this->request('POST', 'conversations', $params);
    }

    public function markConversationRead($params)
    {
        return $this->request('POST', 'conversations/read', $params);
    }

    public function markConversationUnread($params)
    {
        return $this->request('POST', 'conversations/unread', $params);
    }

    public function reassignConversation($params)
    {
        return $this->request('POST', 'conversations/reassign', $params);
    }

    public function openConversation($params)
    {
        return $this->request('POST', 'conversations/open', $params);
    }

    public function closeConversation($params)
    {
        return $this->request('POST', 'conversations/close', $params);
    }

    public function transferConversation($params)
    {
        return $this->request('POST', 'conversations/transfer', $params);
    }

    // Lists Endpoints
    public function createList($data)
    {
        return $this->request('POST', 'list', $data);
    }

    public function getList($listId)
    {
        return $this->request('GET', 'list/' . $listId);
    }

    public function updateList($listId, $data)
    {
        return $this->request('PUT', 'list/' . $listId, $data);
    }

    public function deleteList($listId)
    {
        return $this->request('DELETE', 'list/' . $listId);
    }

    public function getAllLists($params = [])
    {
        return $this->request('POST', 'lists', $params);
    }

    // Templates Endpoints
    public function getTemplates($params = [])
    {
        return $this->request('POST', 'templates', $params);
    }

    public function createTemplate($data)
    {
        return $this->request('POST', 'template', $data);
    }

    public function getTemplate($templateId)
    {
        return $this->request('GET', 'template/' . $templateId);
    }

    public function updateTemplate($templateId, $data)
    {
        return $this->request('PUT', 'template/' . $templateId, $data);
    }

    public function deleteTemplate($templateId)
    {
        return $this->request('DELETE', 'template/' . $templateId);
    }

    // Helper function to make requests
    protected function request($method, $uri, $options = [])
    {

        $headers =  [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
        ];

        $request = new Request($method, $uri, $headers, json_encode($options));
        $res = $this->http->sendAsync($request)->wait();
        return json_decode($res->getBody());


    }
}
