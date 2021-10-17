<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Message extends Model
{
    protected $collection = 'messages';

    protected $fillable = [
        'content',
        'chat_id',
        'date'
    ];
}
