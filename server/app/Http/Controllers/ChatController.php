<?php

namespace App\Http\Controllers;

use App\Events\DeletedChatEvent;
use Exception;
use Illuminate\Http\Request;
use App\Services\ChatService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    public function destroy($chatId)
    {
        try {
            $chatId = (int) $chatId;
            $delete = $this->chatService->destroy($chatId);

            if ($delete) {
                $message = ['id' => $chatId];
                event(new DeletedChatEvent($message));

                return $this->responseJson(['message' => 'Chat excluído com sucesso'], 200);
            }
        
            return $this->responseJson(['message' => 'Ocorreu um erro ao tentar excluir o chat'], 500);
            
        } catch (ModelNotFoundException $e) {
            return $this->responseJson(['message' => $e->getMessage()], 404);
        } catch (Exception $e) {
            Log::error(print_r(['message' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile()], true));
            return $this->responseJson(['message' => 'Ocorreu um erro desconhecido'], 500);
        }


    }
}
