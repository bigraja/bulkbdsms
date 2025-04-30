<?php

namespace Bigraja\BulkBDSms\Facades;

use Illuminate\Support\Facades\Facade;

class BulkBDSms extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'bulkbdsms';
    }
}
