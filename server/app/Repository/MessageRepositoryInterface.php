<?php

namespace App\Repository;

use Illuminate\Support\Collection;

interface MessageRepositoryInterface extends EloquentRepositoryInterface
{
    public function getAllByChatId($chatId);
}