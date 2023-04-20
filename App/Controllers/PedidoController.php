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

    public function criar()
	{
	
		$pedido = Container::getModel('Pedidos');

		$pedido->__set('titulo', $_POST['titulo']);
        $pedido->__set('status', 0);
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

       $pedido->salvar();

       header('location: /criacao');

		

	}


}

?>