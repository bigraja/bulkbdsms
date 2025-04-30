<?php

namespace Bigraja\BulkSmsBD\Facades;

use Illuminate\Support\Facades\Facade;

class BulkSmsBD extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'bulksmsbd';
    }
}
