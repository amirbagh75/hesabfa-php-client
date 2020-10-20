<?php

require '../vendor/autoload.php';
use Amirbagh75\HesabfaClient\HesabfaClient;

$userID = getenv('USER_ID');
$userPassword = getenv('USER_PASSWORD');
$apiKey = getenv('API_KEY');

$hesabfa = new HesabfaClient($userID, $userPassword, $apiKey);


$res = $hesabfa->getContactsList([1,2]);
dump($res->Result->List[0]);
