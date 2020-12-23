<?php

return [
    // SMS.ir Api Key
    'id' => env('HESABFA_USER_ID', 'Your api key'),
    // SMS.ir Secret Key
    'password' => env('HESABFA_USER_PASSWORD', 'Your Username'),
    // Your sms.ir line number
    'key' => env('HESABFA_API_KEY', 'Your Password'),
    //HTTP Request Timeout (seconds)
    'timeout'=> 10
];
