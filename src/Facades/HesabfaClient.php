<?php

namespace Amirbagh75\SMSIR\Facades;

use Illuminate\Support\Facades\Facade;

class HesabfaClient extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'hesabfaclient';
    }
}
