<?php 

namespace App\Services;

use Carbon\Carbon;
use App\Repository\MessageRepositoryInterface;

class NewMessageService {
  protected $messageRepository;
  protected $chatService;

  public function __construct(MessageRepositoryInterface $messageRepo, ChatService $chatService)
  {
    $this->messageRepository = $messageRepo;
    $this->chatService = $chatService;
  }

  public function handle(array $message): void
  {
    $formatted_message = $this->formatMessage($message);

    $chat = $this->chatService->handle($formatted_message['contact']);

    $formatted_message['message']['chat_id'] = $chat->_id;
    $this->messageRepository->create($formatted_message['message']);
  }

  private function formatMessage($message) 
  {
    $last_name = isset($message['from']['last_name']) ? " " . $message['from']['last_name'] : '';
    $full_name = $message['from']['first_name'] . $last_name;

    return [
      'contact' => [
        'contact_identifier' => $message['from']['id'],
        'platform_type' => 'Telegram',
        'name' => $full_name,
      ],
      'message' => [
        'content' => $message['text'],
        'date'    => Carbon::parse($message['date'])->format('Y-m-d H:i:s')
      ]
    ];
  }
}
