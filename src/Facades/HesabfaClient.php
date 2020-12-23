<?php

namespace Amirbagh75\HesabfaClient\Facades;

use Illuminate\Support\Facades\Facade;

class HesabfaClient extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'hesabfaclient';
    }
}
