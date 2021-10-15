<?php

namespace App\Repository;

use Illuminate\Support\Collection;

interface ShippingRepositoryInterface extends EloquentRepositoryInterface
{
   public function all(): Collection;

   public function search(string $term): Collection;
}