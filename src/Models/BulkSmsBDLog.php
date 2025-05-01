<?php

namespace Bigraja\BulkSmsBD\Models;

use Illuminate\Database\Eloquent\Model;

class BulkSmsBDLog extends Model
{
    protected $fillable = ['to', 'message', 'status', 'response'];
}
