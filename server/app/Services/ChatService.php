<?php 

namespace App\Services;

use App\Repository\ChatRepositoryInterface;
use App\Repository\MessageRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ChatService {
  protected $chatRepository;
  protected $messageRepository;

  public function __construct(
    ChatRepositoryInterface $chatRepository,
    MessageRepositoryInterface $messageRepository
  )
  {
    $this->chatRepository = $chatRepository;
    $this->messageRepository = $messageRepository;
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

  public function destroy($chatId): bool
  {
      $chat = $this->chatRepository->findByChatId($chatId);
      if (!$chat) {
        throw new ModelNotFoundException("Chat não encontrado");
      }

      $messages = $this->messageRepository->getAllByChatId($chat->_id);
      if ($messages) {
        $this->destroyMessages($messages);
      }

      return $this->chatRepository->delete($chat->_id);
  }

  private function destroyMessages($messages)
  {
    foreach ($messages as $message) {
      $this->messageRepository->delete($message->_id);
    }
  }

}
