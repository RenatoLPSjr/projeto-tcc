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
		$this->render('home','layout2');
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

	public function configurar()
	{
		$this->render('configurar','layout2');
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

	
}



?>