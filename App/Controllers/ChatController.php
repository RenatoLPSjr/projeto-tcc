<?php

namespace App\Controllers;

//os recursos do miniframework
use App\Models\Usuario;
use MF\Controller\Action;
use MF\Model\Container;

class ChatController extends Action 
{

    public function criarConversa()
    {
        session_start();
        $mensagem = Container::getModel('Mensagens');
        $mainUser = $_SESSION['id'];
        $otherUser = $_POST['OtherUser'];
		$mensagensConversa = $mensagem->buscarMensagensConversa($mainUser, $otherUser);

        if ($mensagem) {
            
            echo json_encode([$mensagensConversa]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao criar a conversa.']);
        }
    }
}

?>