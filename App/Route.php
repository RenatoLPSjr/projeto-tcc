<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

	protected function initRoutes() {

		//rotas do index//
					   								
		/////////////////
		$routes['login'] = array(
			'route' => '/',
			'controller' => 'indexController',
			'action' => 'index'
		);

		$routes['registro'] = array(
			'route' => '/registro',
			'controller' => 'indexController',
			'action' => 'registro'
		);

		$routes['registrar'] = array(
			'route' => '/registrar',
			'controller' => 'indexController',
			'action' => 'registrar'
		);

		//rotas de adm//
		
		///////////////

		$routes['home'] = array(
			'route' => '/adm/home',
			'controller' => 'admController',
			'action' => 'home'
		);

		$routes['funcionario'] = array(
			'route' => '/adm/funcionario',
			'controller' => 'admController',
			'action' => 'funcionario'
		);

		$routes['cadastrado'] = array(
			'route' => '/cadastrado',
			'controller' => 'admController',
			'action' => 'cadastrado'
		);

		$routes['deletar'] = array(
			'route' => '/deletar',
			'controller' => 'admController',
			'action' => 'deletar'
		);

		$routes['configurar'] = array(
			'route' => '/configurar',
			'controller' => 'admController',
			'action' => 'configurar'
		);

		//rotas de especialista//
		
		////////////////////////

		$routes['home-esp'] = array(
			'route' => '/esp/home',
			'controller' => 'espController',
			'action' => 'home'
		);
		
		//rotas de autenticação//
		
		////////////////////////

		$routes['trocar'] = array(
			'route' => '/trocar',
			'controller' => 'authController',
			'action' => 'trocar'
		);

		$routes['autenticar'] = array(
			'route' => '/autenticar',
			'controller' => 'authController',
			'action' => 'autenticar'
		);

		
		$routes['sair'] = array(
			'route' => '/sair',
			'controller' => 'authController',
			'action' => 'sair'
		);




		$this->setRoutes($routes);
	}

}

?>