<?php 

namespace App\Services;

use App\Repository\ChatRepositoryInterface;

class ChatService {
  protected $chatRepository;

  public function __construct(ChatRepositoryInterface $chatRepository)
  {
    $this->chatRepository = $chatRepository;
  }

  public function handle(array $data)
  {

    $chat = $this->chatRepository->findByChatId($data['contact_identifier']);
    if (!$chat) {
      return $this->saveChat($data);
    }

    return $chat;
  }

  public function saveChat(array $chat)
  {
      return $this->chatRepository->create($chat);
  }

  public function searchByName(string $name)
  {
      return $this->chatRepository->searchByName($name);
  }

  public function getAll()
  {
    return $this->chatRepository->all();
  }

}
