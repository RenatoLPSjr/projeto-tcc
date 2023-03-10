<?php

namespace App\Controllers;

//os recursos do miniframework
use App\Models\Usuario;
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action 
{

	public function index() 
	{
		$this->view->login = isset($_GET['login']) ? $_GET['login'] : '';	
		$this->render('index', 'layout');
	}

	public function registro()
	{
		$this->render('registro', 'layout');
	}

	//Fução registrar() é responsavel por salvar o cadastro dos usuarios no banco de dados
	public function registrar()
	{
	
		$usuario = Container::getModel('Usuario');

		$usuario->__set('nome', $_POST['nome']);
		$usuario->__set('email', $_POST['email']);
		$usuario->__set('telefone', $_POST['telefone']);
		$usuario->__set('senha', md5($_POST['senha']));
        $usuario->__set('tipo', 2);
		$usuario->__set('status', 2);
		$usuario->__set('area', $_POST['area']);
		$usuario->__set('pix', $_POST['pix']);
		$usuario->__set('especialidade', $_POST['especialidade']);

		if($usuario->validarCadastro() && count($usuario->getUsuarioPorEmail()) == 0) {

			$usuario->salvar();

			$this->render('cadastrado','layout2');
				
		}else{

			$this->view->usuario = array(
				'nome' =>$_POST['nome'],
				'email' =>$_POST['email'],
				'senha' =>$_POST['senha']
			);


			header('Location: /registro?login=erro');
		}
		

	}



}


?>