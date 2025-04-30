<?php

namespace Bigraja\BulkBDSms\Models;

use Illuminate\Database\Eloquent\Model;

class SmsLog extends Model
{
    protected $fillable = ['to', 'message', 'status', 'response'];
}
