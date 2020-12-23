<?php

declare(strict_types=1);

namespace Amirbagh75\HesabfaClient;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Amirbagh75\HesabfaClient\Contracts\HesabfaClientInterface;

class HesabfaClient implements HesabfaClientInterface
{
    private $requestBody;
    private $client;

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
     * @param string $route
     * @return object
     * @throws GuzzleException
     */
    private function executeRequest(string $route): object
    {
        $response = $this->client->request('POST', $route, [
            'protocols' => ['https'],
            'json' => $this->requestBody,
        ]);
        return json_decode((string)$response->getBody());
    }

    /**
     * @param  string  $contactCode
     * @return object
     * @throws GuzzleException
     */
    public function getContact(string $contactCode): object
    {
        $this->requestBody['code'] = $contactCode;
        return $this->executeRequest('contact/get');
    }

    /**
     * @param  array  $queryInfo
     * @return object
     * @throws GuzzleException
     */
    public function getContactsList(array $queryInfo): object
    {
        $this->requestBody['queryInfo'] = $queryInfo;
        return $this->executeRequest('contact/getcontacts');
    }

    /**
     * @param  array  $contactsID
     * @return object
     * @throws GuzzleException
     */
    public function getContactsByID(array $contactsID): object
    {
        $this->requestBody['idList'] = $contactsID;
        return $this->executeRequest('contact/getById');
    }

    /**
     * @param  string  $invoiceType
     * @param  array  $queryInfo
     * @return object
     * @throws GuzzleException
     */
    public function getInvoices(string $invoiceType, array $queryInfo = []): object
    {
        $this->requestBody['type'] = $invoiceType;
        $this->requestBody['queryInfo'] = $queryInfo;
        return$this->executeRequest('invoice/getinvoices');
    }

    /**
     * @param string $url
     * @param string $hookPassword
     * @return object
     * @throws GuzzleException
     */
    public function setWebHook(string $url, string $hookPassword): object
    {
        $this->requestBody['url'] = $url;
        $this->requestBody['hookPassword'] = $hookPassword;
        return $this->executeRequest('setting/SetChangeHook');
    }

    /**
     * @param array $idList
     * @return object
     * @throws GuzzleException
     */
    public function getItemByID(array $idList): object
    {
        $this->requestBody['idList'] = $idList;
        return $this->executeRequest('item/getById');
    }
}
