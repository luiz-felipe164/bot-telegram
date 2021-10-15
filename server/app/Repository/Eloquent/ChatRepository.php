<?php

namespace App\Repository\Eloquent;

use App\Models\Chat;
use Illuminate\Support\Collection;
use App\Repository\ChatRepositoryInterface;

class ChatRepository extends BaseRepository implements ChatRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(Chat $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function search($term): Collection
    {
        return $this->model
            ->where('board', 'like', "%{$term}%")
            ->orWhere('vehicle_owner', 'like', "%{$term}%")
            ->get();
    }
}
