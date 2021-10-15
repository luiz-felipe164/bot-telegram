<?php 

namespace App\Services;

use App\Repository\ChatRepositoryInterface;
use App\Repository\Eloquent\ChatRepository;

class NewMessageService {
  protected $chatRepository;

  public function __construct(ChatRepositoryInterface $chatRepository)
  {
    $this->chatRepository = $chatRepository;
  }

  public function handle(array $message)
  {
    $formatted_message = $this->formatMessage($message);
  }

  private function formatMessage($message) 
  {
    return [
      'chat_id' => $message['chat_id'],
    ];
  }
}
