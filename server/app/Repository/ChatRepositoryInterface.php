<?php

namespace App\Repository;

use Illuminate\Support\Collection;

interface ChatRepositoryInterface extends EloquentRepositoryInterface
{
   public function findByChatId($chat_id);

   public function searchByName(string $name): Collection;
}