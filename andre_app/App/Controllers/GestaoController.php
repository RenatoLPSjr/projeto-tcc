<?php

namespace App\Controllers;

//os recursos do miniframework
use App\Models\Usuario;
use MF\Controller\Action;
use MF\Model\Container;

class GestaoController extends Action 
{



	public function gestao() 
	{
		session_start();
		$usuario = Container::getModel('Usuario');
		$usuarios = $usuario->getGestao();


		$this->view->usuarios = $usuarios;


		$this->render('gestao','layout2');
	}

    public function gestaoEspecialista() 
	{
		session_start();
		$usuario = Container::getModel('Usuario');
		$usuarios = $usuario->getGestao();


		$this->view->usuarios = $usuarios;


		$this->render('gestao-especialista','layout2');
	}


	public function gestaoEditar() 
	{
		session_start();
		$usuario = Container::getModel('Usuario');
		$id = $_POST['id'];

		$usuarios = $usuario->getGestaoEditar($id);
		$this->view->usuarios = $usuarios;

		$this->render('gestao-editar','layout2');
	}

    public function gestaoNovo() 
	{
		session_start();
		$usuario = Container::getModel('Usuario');
		$usuarios = $usuario->getGestaoNovo();


		$this->view->usuarios = $usuarios;


		$this->render('gestao-novo','layout2');
	}

    public function gestaoNovoAceito() 
	{
		session_start();
		$usuario = Container::getModel('Usuario');
		$id = $_POST['id'];

		$usuario->__set('sigla', $_POST['sigla']);

		$usuario->getGestaoAceito($id);
		

		header('Location: /adm/gestao');
	}



}

?>