<?php

declare(strict_types=1);

namespace Amirbagh75\HesabfaClient;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Amirbagh75\HesabfaClient\Contracts\HesabfaClientInterface;

class HesabfaClient implements HesabfaClientInterface
{
    private array $requestBody;
    private object $results;
    private Client $client;

    /**
     * Create a new HesabfaClient Instance
     * @param  string  $userID
     * @param  string  $userPassword
     * @param  string  $apiKey
     * @param  int  $timeout
     */
    public function __construct(string $userID, string $userPassword, string $apiKey, int $timeout = 10)
    {
        $this->requestBody = [
            'apiKey' => $apiKey,
            'userId' =>  $userID,
            'password' => $userPassword
        ];
        $this->client = new Client([
            'base_uri' => 'https://api.hesabfa.com/v1/',
            'timeout'  => $timeout,
        ]);
    }

    /**
     * @param  string  $route
     * @throws GuzzleException
     */
    private function executeRequest(string $route)
    {
        $response = $this->client->request('POST', $route, [
            'protocols' => ['https'],
            'json' => $this->requestBody,
        ]);
        $this->results = json_decode((string)$response->getBody());
    }

    /**
     * @return object
     */
    private function showResult()
    {
        return $this->results;
    }

    /**
     * @param  string  $contactCode
     * @return object
     * @throws GuzzleException
     */
    public function getContact(string $contactCode): object
    {
        $this->requestBody['code'] = $contactCode;
        $this->executeRequest('contact/get');
        return $this->showResult();
    }

    /**
     * @param  array  $queryInfo
     * @return object
     * @throws GuzzleException
     */
    public function getContactsList(array $queryInfo): object
    {
        $this->requestBody['queryInfo'] = $queryInfo;
        $this->executeRequest('contact/getcontacts');
        return $this->showResult();
    }

    /**
     * @param  array  $contactsID
     * @return object
     * @throws GuzzleException
     */
    public function getContactsByID(array $contactsID): object
    {
        $this->requestBody['idList'] = $contactsID;
        $this->executeRequest('contact/getById');
        return $this->showResult();
    }

    /**
     * @param  string  $invoiceType
     * @param  array  $queryInfo
     * @return object
     * @throws GuzzleException
     */
    public function getInvoices(string $invoiceType, array $queryInfo): object
    {
        $this->requestBody['type'] = $invoiceType;
        $this->requestBody['queryInfo'] = $queryInfo;
        $this->executeRequest('invoice/getinvoices');
        return $this->showResult();
    }
}
