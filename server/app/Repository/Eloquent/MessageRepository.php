<?php

namespace App\Repository\Eloquent;

use App\Models\Message;
use App\Repository\MessageRepositoryInterface;

class MessageRepository extends BaseRepository implements MessageRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(Message $model)
    {
        parent::__construct($model);
    }

    public function getAllByChatId($chatId) 
    {
        return $this->model
                    ->where('chat_id', $chatId)
                    ->get();
    }
}
