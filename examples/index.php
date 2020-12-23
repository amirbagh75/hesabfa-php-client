<?php

require __DIR__.'/../vendor/autoload.php';

use Amirbagh75\HesabfaClient\HesabfaClient;
use GuzzleHttp\Exception\GuzzleException;

$userID = getenv('USER_ID');
$userPassword = getenv('USER_PASSWORD');
$apiKey = getenv('API_KEY');

$hesabfa = new HesabfaClient($userID, $userPassword, $apiKey);

try {
    $res = $hesabfa->getInvoices(1, [
        'SortBy'   => 'Date',
        'SortDesc' => true,
        'Take'     => 1,
        'Skip'     => 0,
    ]);
    print_r($res);
} catch (GuzzleException $e) {
    print_r('Problem happened: '.$e->getMessage());
}
