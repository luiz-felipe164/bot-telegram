<?php

namespace App\Repository;

use Illuminate\Support\Collection;

interface ChatRepositoryInterface extends EloquentRepositoryInterface
{
   public function findByChatId($chatId);

   public function searchByName(string $name): Collection;
}