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
        $conversa = Container::getModel('Conversa');
        $mensagem = Container::getModel('Mensagens');
        $mainUser = $_POST['mainUser'];
        $otherUser = $_POST['otherUser'];

        // Verificar se já existe uma conversa entre mainUser e otherUser
        $conversaExistente = $conversa->verificarConversaExistente($mainUser, $otherUser);


        if (!$conversaExistente) {
            // Não existe uma conversa, chamar a função iniciarConversa
            $idConversa = $conversa->iniciarConversa($mainUser, $otherUser);
            $mensagem->iniciarMensagem($mainUser, $otherUser, $idConversa);

            $mensagensConversa = $mensagem->buscarMensagensConversa($mainUser, $otherUser);
        } else {
            // Já existe uma conversa, chamar a função buscarMensagensConversa
            $mensagensConversa = $mensagem->buscarMensagensConversa($mainUser, $otherUser);
        }

        if ($mensagensConversa) {
            echo json_encode($mensagensConversa);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao criar ou buscar a conversa.']);
        }
    }

    public function enviarMensagem()
    {
        session_start();
        $mensagem = Container::getModel('Mensagens');
        $mainUser = $_POST['mainUser'];
        $otherUser = $_POST['otherUser'];
        $mensagens = $_POST['mensagem'];

        $criarMensagem = $mensagem->novaMensagem($mainUser, $otherUser, $mensagens);

        if ($criarMensagem) {
            echo json_encode($criarMensagem);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao criar a mensagem.']);
        }
    }

    public function enviarMensagemPedido()
    {
        session_start();
        $mensagem = Container::getModel('Mensagens');
        $mainUser = $_POST['mainUser'];
        $otherUser = $_POST['otherUser'];
        $mensagens = $_POST['mensagem'];
        $idPedido = $_POST['idPedido'];

        $criarMensagem = $mensagem->novaMensagemPedido($mainUser, $otherUser, $mensagens, $idPedido);

        if ($criarMensagem) {
            echo json_encode($criarMensagem);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao criar a mensagem.']);
        }
    }

    public function buscarMensagem()
    {
        session_start();
        $mensagem = Container::getModel('Mensagens');
        $mainUser = $_POST['mainUser'];
        $otherUser = $_POST['otherUser'];

        $buscarMensagem = $mensagem->buscarMensagensConversa($mainUser, $otherUser);

        if ($buscarMensagem) {
            echo json_encode($buscarMensagem);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao criar a mensagem.']);
        }
    }



    public function criarConversaPedido()
    {

        session_start();
        $mensagem = Container::getModel('Mensagens');
        $mainUser = $_POST['mainUser'];
        $otherUser = $_POST['otherUser'];
        $idPedido = $_POST['idPedido'];

        $conversaExistente = $mensagem->verificarConversaPedido($mainUser, $otherUser,$idPedido);


        if (!$conversaExistente) {
            // Não existe uma conversa, chamar a função iniciarConversa
            $mensagem->iniciarMensagemPedido($mainUser, $otherUser, $idPedido);
            $mensagensConversa = $mensagem->buscarMensagensConversaPedido($mainUser, $otherUser, $idPedido);

        } else {
            // Já existe uma conversa, chamar a função buscarMensagensConversa
            $mensagensConversa = $mensagem->buscarMensagensConversaPedido($mainUser, $otherUser, $idPedido);
        }

        if ($mensagensConversa) {

            echo json_encode($mensagensConversa);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao criar ou buscar a conversa.']);
        }
    }

}

?>