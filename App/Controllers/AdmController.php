<?php

namespace App\Controllers;

//os recursos do miniframework
use App\Models\Usuario;
use MF\Controller\Action;
use MF\Model\Container;

class AdmController extends Action 
{
	public function home() 
	{
		session_start();
		$usuario = Container::getModel('Usuario');
		$usuarios = $usuario->getHome();
		$graficos = $usuario->getHomeGrafico();

		$this->view->usuarios = $usuarios;
		$this->view->graficos = $graficos;

		$this->render('home','layout2');
	}

	public function configurar() 
	{
        session_start();
        $usuario = Container::getModel('Usuario');
        $id = $_SESSION['id'];
		$usuario = $usuario->getById($id);

        $this->view->usuario = $usuario;

		$this->render('configurar','layout2');
	}

	public function chat() 
	{
		$usuario = Container::getModel('Usuario');
		$usuarios = $usuario->getChat();

		$this->view->usuarios = $usuarios;
		$this->render('chat','layout2');
	}

	public function funcionario() 
	{
		$usuario = Container::getModel('Usuario');
		$usuarios = $usuario->getByTipo();

		$this->view->usuarios = $usuarios;
		$this->render('funcionario','layout2');
	}


	public function cadastrado()
	{
		$this->render('cadastrado','layout2');
	}


	public function deletar()
	{	
		

		$id = $_GET['id'];
		$usuario = Container::getModel('Usuario');
		$usuarioId = $usuario->getById($id);
		$usuario->deletar($usuarioId);

		$usuario->deletar($id);

		header('Location: /adm/funcionario');
	}

	public function aceitar()
	{	
		

		$id = $_GET['id'];
		$usuario = Container::getModel('Usuario');
		$usuarioId = $usuario->getById($id);
		$usuario->deletar($usuarioId);

		$usuario->deletar($id);

		header('Location: /adm/funcionario');
	}


		public function trocaPagamento()
		{
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				// Obtém o valor enviado pelo formulário
				$pagamento = isset($_POST['pagamento']) ? $_POST['pagamento'] : null;
			
				// Verifica se foi selecionada uma opção válida
				if ($pagamento !== null && ($pagamento === '0' || $pagamento === '1')) {
					// Conecta no banco de dados e atualiza o registro
					$pedido = Container::getModel('Pedido');
					$pedido->__set('id', $_POST['id']);
					$pedido->__set('pagamento', $_POST['pagamento']);
					$pedido->atualzarPagamento();

					header('Location: /visualizar');
				}
			}
		}


		
		public function pedidoVisuAdm()
		{
    
			$id = $_GET['id'];
			$id_usuario = $_GET['id_usuario'];
            
			$pedido = Container::getModel('Pedidos');
			$usuario = Container::getModel('Usuario');

			$pedidos = $pedido->getPedidoById($id);
			$usuarios = $usuario->getById($id_usuario);


			$this->view->pedidos = $pedidos;
			$this->view->usuarios = $usuarios;
			$this->render('pedido_visu_adm', 'layout2');
		}

		public function pedidoPago()
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
					$pedido->pedidoPago(); 
	
					header('Location: /visualizar');
					exit;
				}else{
	
					session_start();
					$pedido = Container::getModel('Pedidos');
					$pedido->__set('id', $_POST['id']);
					$pedido->pedidoRevisar();
	
					header('Location: /visualizar');
					exit;
				}
			}
		}

		public function pedidoEntregue()
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
					$pedido->pedidoRevisar();
	
					header('Location: /visualizar');
					exit;
				}else{
	
					session_start();
					$pedido = Container::getModel('Pedidos');
					$pedido->__set('id', $_POST['id']);
					$pedido->pedidoGarantia();

					header('Location: /visualizar');
					exit;
				}
			}
		}


		public function pedidoRevisaoFinal()
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
	
					header('Location: /visualizar');
					exit;
				}else if($servico_aceito == 2){
	
					session_start();
					$pedido = Container::getModel('Pedidos');
					$pedido->__set('id', $_POST['id']);
					$pedido->pedidoGarantia();

					header('Location: /visualizar');
					exit;
				}else if($servico_aceito == 3){
	
					session_start();
					$pedido = Container::getModel('Pedidos');
					$pedido->__set('id', $_POST['id']);
					$pedido->pedidoPago();

					header('Location: /visualizar');
					exit;
				}
			}
		}

		public function uploadImagem()
        {
			session_start();
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
                        $usuario = Container::getModel('Usuario');
                        $usuario->__set('path_imagem', $path);
                        $usuario->__set('id', $_SESSION['id']);

                        $usuario->uploadImagem();
              
                        header('Location:/adm/configurar');
                    }else
                        echo "<p>Falha ao enviar arquivo</p>";

                  // Conectar ao banco de dados



                }
              }
			}


	
}



?>