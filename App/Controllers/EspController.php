<?php

namespace App\Controllers;

//os recursos do miniframework
use App\Models\Usuario;
use MF\Controller\Action;
use MF\Model\Container;

class EspController extends Action 
{

    public function home() 
    {

        $this->render('home','layout3');
    }

    public function pedidos() 
    {   
        session_start();
        $pedido = Container::getModel('Pedidos');
        $pedido->__set('id_usuario', $_SESSION['id']);
		$pedidos = $pedido->getById();


        $this->view->pedidos = $pedidos;

        $this->render('pedidos','layout3');
    }

    public function aceitaPedido()
    {
        // Verifica se o formulário foi enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtém o valor enviado pelo formulário
            $servico_aceito = isset($_POST['aceita']) ? $_POST['aceita'] : 0;
        
            // Verifica se o valor é igual a 1
            if ($servico_aceito == 1) {
                
                session_start();
                $pedido = Container::getModel('Pedidos');
                $pedido->__set('id_usuario', $_SESSION['id']);
                $pedido->atualizaStatus();

                header('Location: /esp/pedidos');
                exit;
            }else if($servico_aceito == 2){

                session_start();
                $pedido = Container::getModel('Pedidos');
                $pedido->__set('id_usuario', $_SESSION['id']);
                $pedido->retirarStatus();

                header('Location: /esp/pedidos');
                exit;
            }
        }

    }
}
?>