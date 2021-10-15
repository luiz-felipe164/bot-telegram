<?php

namespace App\Repository;

use Illuminate\Support\Collection;

interface ChatRepositoryInterface extends EloquentRepositoryInterface
{
   public function search(string $term): Collection;
}