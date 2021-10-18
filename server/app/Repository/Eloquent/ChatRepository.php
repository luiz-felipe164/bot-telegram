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
    public function searchByName(string $name): Collection
    {
        return $this->model
                ->where('name', 'like', "%{$name}%")
                ->get();
    }

    public function findByChatId($chatId)
    {
        return $this->model->where('contact_identifier', $chatId)->first();
    }
}
