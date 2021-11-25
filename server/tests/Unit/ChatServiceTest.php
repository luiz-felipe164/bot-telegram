<?php

namespace Tests\Unit;

use App\Models\Chat;
use App\Repository\Eloquent\ChatRepository;
use App\Repository\Eloquent\MessageRepository;
use App\Services\ChatService;
use PHPUnit\Framework\TestCase;

class ChatServiceTest extends TestCase
{
    private $chatRepositoryMock;
    private $messageRepositoryMock;
    private $chatStub;

    protected function setUp(): void
    {
        $this->chatRepositoryMock = $this->createMock(ChatRepository::class);
        $this->messageRepositoryMock = $this->createMock(MessageRepository::class);
        $this->chatStub = $this->createMock(Chat::class);
    }

    public function test_should_save_chat()
    {
        
        $this->chatRepositoryMock
            ->expects($this->once())
            ->method('findByChatId')
            ->willReturn('');

        $this->chatRepositoryMock
            ->expects($this->once())
            ->method('create')
            ->willReturn($this->chatStub);

        $data = ['contact_identifier' => 20210101];

        $chatService = new ChatService($this->chatRepositoryMock, $this->messageRepositoryMock);
        $response = $chatService->handle($data);

        $this->assertInstanceOf(Chat::class, $response);
    }

    public function test_should_return_an_chat()
    {
        
        $this->chatRepositoryMock
            ->expects($this->once())
            ->method('findByChatId')
            ->willReturn($this->chatStub);

        $data = ['contact_identifier' => 20210101];

        $chatService = new ChatService($this->chatRepositoryMock, $this->messageRepositoryMock);
        $response = $chatService->handle($data);

        $this->assertInstanceOf(Chat::class, $response);
    }

    public function test_should_find_a_chat_by_name()
    {
        $map = [
            [
                'chat 1',
                collect([$this->chatStub])
            ]
        ];

        $this->chatRepositoryMock
            ->expects($this->once())
            ->method('searchByName')
            ->will($this->returnValueMap($map));

        $name = 'chat 1';

        $chatService = new ChatService($this->chatRepositoryMock, $this->messageRepositoryMock);
        $response = $chatService->searchByName($name);

        $expected = collect([$this->chatStub]);

        $this->assertEquals($expected, $response);
    }

    public function test_should_get_all_chats()
    {
        $chat = new Chat();

        $this->chatRepositoryMock
            ->expects($this->once())
            ->method('all')
            ->willReturn(collect([$this->chatStub, $chat]));

        $chatService = new ChatService($this->chatRepositoryMock, $this->messageRepositoryMock);
        $response = $chatService->getAll();

        $expected = collect([$this->chatStub, $chat]);

        $this->assertEquals($expected, $response);
    }
}
