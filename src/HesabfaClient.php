<?php

declare(strict_types=1);

namespace Amirbagh75\HesabfaClient;

use Amirbagh75\HesabfaClient\Contracts\HesabfaClientInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class HesabfaClient implements HesabfaClientInterface
{
    private $requestBody;
    private $client;

    /**
     * Create a new HesabfaClient Instance.
     *
     * @param string $userID
     * @param string $userPassword
     * @param string $apiKey
     * @param int    $timeout
     */
    public function __construct(string $userID, string $userPassword, string $apiKey, int $timeout = 10)
    {
        $this->requestBody = [
            'apiKey'   => $apiKey,
            'userId'   => $userID,
            'password' => $userPassword,
        ];
        $this->client = new Client([
            'base_uri' => 'https://api.hesabfa.com/v1/',
            'timeout'  => $timeout,
        ]);
    }

    /**
     * @param string $route
     *
     * @throws GuzzleException
     *
     * @return object
     */
    private function executeRequest(string $route): object
    {
        $response = $this->client->request('POST', $route, [
            'protocols' => ['https'],
            'json'      => $this->requestBody,
        ]);

        return json_decode((string) $response->getBody());
    }

    /**
     * @param string $contactCode
     *
     * @throws GuzzleException
     *
     * @return object
     */
    public function getContact(string $contactCode): object
    {
        $this->requestBody['code'] = $contactCode;

        return $this->executeRequest('contact/get');
    }

    /**
     * @param array $queryInfo
     *
     * @throws GuzzleException
     *
     * @return object
     */
    public function getContactsList(array $queryInfo = []): object
    {
        $this->requestBody['queryInfo'] = $queryInfo;

        return $this->executeRequest('contact/getcontacts');
    }

    /**
     * @param array $contactsID
     *
     * @throws GuzzleException
     *
     * @return object
     */
    public function getContactsByID(array $contactsID): object
    {
        $this->requestBody['idList'] = $contactsID;

        return $this->executeRequest('contact/getById');
    }

    /**
     * @param string $invoiceType
     * @param array  $queryInfo
     *
     * @throws GuzzleException
     *
     * @return object
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
     *
     * @throws GuzzleException
     *
     * @return object
     */
    public function setWebHook(string $url, string $hookPassword): object
    {
        $this->requestBody['url'] = $url;
        $this->requestBody['hookPassword'] = $hookPassword;

        return $this->executeRequest('setting/SetChangeHook');
    }

    /**
     * @param array $idList
     *
     * @throws GuzzleException
     *
     * @return object
     */
    public function getItemByID(array $idList): object
    {
        $this->requestBody['idList'] = $idList;

        return $this->executeRequest('item/getById');
    }
}
