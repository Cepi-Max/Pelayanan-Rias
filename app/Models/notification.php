<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class notification extends Model
{
    //
    protected $fillable = ['type', 'notifable', 'data', 'read_at'];
}
