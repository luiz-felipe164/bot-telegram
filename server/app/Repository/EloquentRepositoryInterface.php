<?php

namespace App\Repository;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface EloquentRepositoryInterface
 * @package App\Repositories
 */
interface EloquentRepositoryInterface
{
   /**
     * @return Collection
     */
    public function all();

   /**
    * @param array $attributes
    * @return Model
    */
   public function create(array $attributes): Model;

   /**
    * @param $id
    * @return Model
    */
   public function find($id): ?Model;

   /**
    * @param array $attributes
    * @param $id
    * @return Model
    */
   public function update(array $attributes, $id): bool;

   /**
    * @param $id
    * @return Model
    */
   public function delete($id): bool;
}
