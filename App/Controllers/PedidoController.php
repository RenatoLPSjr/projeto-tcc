<?php

namespace App\Controllers;

//os recursos do miniframework
use App\Models\Usuario;
use MF\Controller\Action;
use MF\Model\Container;

class PedidoController extends Action 
{
    public function criacao()
	{
        $usuario = Container::getModel('Usuario');
		$usuarios = $usuario->getByTipo();

		$this->view->usuarios = $usuarios;

		$this->render('criacao', 'layout2');
	}

    public function visualizar()
	{
        $pedido = Container::getModel('Pedidos');
		$pedidos = $pedido->getAll(); 

		$this->view->pedidos = $pedidos;

		$this->render('visualizar', 'layout2');
	}

    public function criarPedido()
	{
	
		$pedido = Container::getModel('Pedidos');

		$pedido->__set('titulo', $_POST['titulo']);
        $pedido->__set('status', 1);
		$pedido->__set('receita_bruta', $_POST['receita_bruta']);
		$pedido->__set('prazo_real', $_POST['prazo_real']);
		$pedido->__set('fonte', $_POST['fonte']);
        $pedido->__set('id_usuario', $_POST['id_usuario']);
        $pedido->__set('oferta', $_POST['oferta']);
		$pedido->__set('paginas', $_POST['paginas']);
		$pedido->__set('id', $_POST['id']);
		$pedido->__set('disciplina', $_POST['disciplina']);
		$pedido->__set('tipo', $_POST['tipo']);
        $pedido->__set('metodologia', $_POST['metodologia']);
        $pedido->__set('arquivos', $_POST['arquivos']);
        $pedido->__set('prazo_entrega', $_POST['prazo_entrega']);
        $pedido->__set('prazo_garantia', $_POST['prazo_garantia']);
        $pedido->__set('tema', $_POST['tema']);
        $pedido->__set('descricao', $_POST['descricao']);
        $pedido->__set('observacao', $_POST['observacao']);
		$pedido->__set('corpo', $_POST['corpo']);

       $pedido->salvar();

       header('location: /criacao');
	}

	public function atualizarPedido()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/atualizar_pedido') {
			$pedido = Container::getModel('Pedidos');
	
			$pedido->__set('titulo', $_POST['titulo']);
			$pedido->__set('status', 1);
			$pedido->__set('receita_bruta', $_POST['receita_bruta']);
			$pedido->__set('prazo_real', $_POST['prazo_real']);
			$pedido->__set('fonte', $_POST['fonte']);
			$pedido->__set('id_usuario', $_POST['id_usuario']);
			$pedido->__set('oferta', $_POST['oferta']);
			$pedido->__set('paginas', $_POST['paginas']);
			$pedido->__set('id', $_POST['id']);
			$pedido->__set('disciplina', $_POST['disciplina']);
			$pedido->__set('tipo', $_POST['tipo']);
			$pedido->__set('metodologia', $_POST['metodologia']);
			$pedido->__set('arquivos', $_POST['arquivos']);
			$pedido->__set('prazo_entrega', $_POST['prazo_entrega']);
			$pedido->__set('prazo_garantia', $_POST['prazo_garantia']);
			$pedido->__set('tema', $_POST['tema']);
			$pedido->__set('descricao', $_POST['descricao']);
			$pedido->__set('observacao', $_POST['observacao']);
			$pedido->__set('corpo', $_POST['corpo']);
	
			$pedido->atualizar();
	
			// Redirecione o usuário para a página desejada após a atualização
			header('Location: /visualizar');
			exit;
		}
	}
	



		public function novoEspecialista() 
		{
				$id = $_GET['id'];
				$pedido = Container::getModel('Pedidos');
				$usuario = Container::getModel('Usuario');

				$pedidos = $pedido->getPedidoById($id);
				$usuarios = $usuario->getAll();

				$this->view->pedidos = $pedidos;
				$this->view->usuarios = $usuarios;
				$this->render('novo_especialista', 'layout2');
		}


		public function trocaEspecialista()
		{

			var_dump($_POST['id_usuario']);
			var_dump($_POST['id']);


    
			$pedido = Container::getModel('Pedidos');
			$pedido->__set('id_usuario', $_POST['id_usuario']);
			$pedido->__set('id', $_POST['id']);

			$pedido->trocarEspecialista();
			header('location: /visualizar');
		}

		public function editar()
		{
			$id = $_GET['id'];
			$pedido = Container::getModel('Pedidos');
			$usuario = Container::getModel('Usuario');

			$pedidos = $pedido->getPedidoById($id);
			$usuarios = $usuario->getAll();

			$this->view->pedidos = $pedidos;
			$this->view->usuarios = $usuarios;
			$this->render('editar', 'layout2');
		}


	  
	  


}

?>