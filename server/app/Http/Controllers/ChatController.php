<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Services\ChatService;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    protected $chatService;

    public function __construct(ChatService $chatService)
    {
        $this->chatService = $chatService;
    }

    public function index(Request $request)
    {
        try {

            if (isset($request->name) && $request->name != '') {
                $chats = $this->chatService->searchByName($request->name);
                return $this->responseJson($chats, 200);
            }
    
            $allChats = $this->chatService->getAll();
    
            return $this->responseJson($allChats, 200);
        } catch (Exception $e) {
            Log::error(print_r(['message' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()], true));
            return $this->responseJson(['message' => 'Ocorreu um erro desconhecido'], 500);
        }
    }
}
