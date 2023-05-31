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
                $pedido->__set('id', $_POST['id']);
                $pedido->atualizaStatus();

                header('Location: /esp/pedidos');
                exit;
            }else if($servico_aceito == 2){

                session_start();
                $pedido = Container::getModel('Pedidos');
                $pedido->__set('id', $_POST['id']);
                $pedido->retirarStatus();

                header('Location: /esp/pedidos');
                exit;
            }
        }

    }

    public function finalizaPedido()
    {
        // Verifica se o formulário foi enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtém o valor enviado pelo formulário
            $servico_aceito = isset($_POST['aceita']) ? $_POST['aceita'] : 0;
        
            // Verifica se o valor é igual a 1
            if ($servico_aceito == 1) {
                
                session_start();
                $pedido = Container::getModel('Pedidos');
                $pedido->__set('id', $_POST['id']);
                $pedido->atualizaStatusFinalizado();

                header('Location: /esp/pedidos');
                exit;
            }else if($servico_aceito == 2){

                session_start();
                header('Location: /esp/pedidos');
                exit;
            }
        }
    }

    public function revisaPedido()
    {
        // Verifica se o formulário foi enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtém o valor enviado pelo formulário
            $servico_aceito = isset($_POST['aceita']) ? $_POST['aceita'] : 0;
        
            // Verifica se o valor é igual a 1
            if ($servico_aceito == 1) {
                
                session_start();
                $pedido = Container::getModel('Pedidos');
                $pedido->__set('id', $_POST['id']);
                $pedido->atualizaStatusRevisado();

                header('Location: /esp/pedidos');
                exit;
            }else if($servico_aceito == 2){

                session_start();
                header('Location: /esp/pedidos');
                exit;
            }
        }
    }

    
		public function pedidoVisuEsp()
		{
    
			$id = $_GET['id'];
            
			$pedido = Container::getModel('Pedidos');

			$pedidos = $pedido->getPedidoById($id);

			$this->view->pedidos = $pedidos;
			$this->render('pedido_visu_esp', 'layout3');
		}
}
?>