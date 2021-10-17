<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Chat extends Model
{
    protected $collection = 'chats';

    protected $fillable = [
        'contact_identifier',
        'platform_type',
        'name'
    ];
}
