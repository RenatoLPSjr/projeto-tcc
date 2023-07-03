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
        session_start();

        $this->render('home','layout3');
    }

    public function calendario() 
    {

        session_start();
        $usuario = Container::getModel('Usuario');
        $id = $_SESSION['id'];
		$usuario = $usuario->getById($id);

        $this->view->usuario = $usuario;

        $this->render('calendario','layout3');
    }

    public function chat() 
	{
		$usuario = Container::getModel('Usuario');
		$usuarios = $usuario->getChatEsp();

		$this->view->usuarios = $usuarios;
		$this->render('chat','layout3');
	}

    public function chatPedido() 
	{
		$usuario = Container::getModel('Usuario');
		$pedido = Container::getModel('Pedidos');
		$id = $_GET['id'];

		$pedidos = $pedido->getPedidoById($id);
		$usuarios = $usuario->getChatEsp();

		$this->view->pedidos = $pedidos;
		$this->view->usuarios = $usuarios;
		$this->render('chat-pedidos','layout3');
	}

    public function configurar()
	{
        session_start();
        $usuario = Container::getModel('Usuario');
        $id = $_SESSION['id'];
		$usuario = $usuario->getById($id);

        $this->view->usuario = $usuario;

		$this->render('configurar','layout3');
	}

    public function lateral()
	{
        session_start();
        $usuario = Container::getModel('Usuario');
        $id = $_SESSION['id'];
		$usuario = $usuario->getById($id);

        $this->view->usuario = $usuario;
		$this->render('lateral','layout3');
	}

    public function pedidos() 
    {   
        session_start();
        $pedido = Container::getModel('Pedidos');
        $usuario = Container::getModel('Usuario');
        $id = $_SESSION['id'];
        $usuario = $usuario->getById($id);

        $pedido->__set('id_usuario', $_SESSION['id']);
		$pedidos = $pedido->getById();
		

        $this->view->usuario = $usuario;
        $this->view->pedidos = $pedidos;


        $this->render('pedidos','layout3');
    }


    public function aceitaPedido()
    {
        // Verifica se o formulário foi enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtém o valor enviado pelo formulário
            $servico_aceito = isset($_POST['aceita']) ? $_POST['aceita'] : 1;
        
            // Verifica se o valor é igual a 1
            if ($servico_aceito == 1) {
                
                session_start();
                $pedido = Container::getModel('Pedidos');
                $pedido->__set('id', $_POST['id']);
                $pedido->atualizaStatus();

                header('Location: /esp/pedidos');
                exit;
            }else{

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
                $pedido->pedidoEntregue();

                header('Location: /esp/pedidos');
                exit;
            }else{

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

        public function uploadImagem()
        {
            if (isset($_FILES['image'])) {
                $file = $_FILES['image'];
                if($file['size'] > 2097152){
                    die("Arquivo muito grande, max 2mb");
                }

                // Verificar se houve algum erro no upload
                if ($file['error'] === UPLOAD_ERR_OK) {
                  $pasta = "arquivos/";
                  $nomeDoArquivo = $file['name'];
                  $novoNomeDoArquivo = uniqid();
                  $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

                    if($extensao != "jpg" && $extensao != 'png' && $extensao != 'jpeg'){
                        die("Tipo de arquivo não aceito");
                    }

                    $path = $pasta . $novoNomeDoArquivo . "." . $extensao;

                    $deu_certo = move_uploaded_file($file["tmp_name"], $pasta . $novoNomeDoArquivo . "." . $extensao);
                    
                    if($deu_certo){
                        session_start();
                        $usuario = Container::getModel('Usuario');
                        $usuario->__set('path_imagem', $path);
                        $usuario->__set('id', $_SESSION['id']);

                        $usuario->uploadImagem();
              
                        header('Location:/esp/configurar');
                    }else
                        echo "<p>Falha ao enviar arquivo</p>";

                  // Conectar ao banco de dados



                }
              }
              
        }

}
?>