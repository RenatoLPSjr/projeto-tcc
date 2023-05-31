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

		$routes['troca_pagamento'] = array(
			'route' => '/troca_pagamento',
			'controller' => 'admController',
			'action' => 'trocaPagamento'
		);

		$routes['novo_especialista'] = array(
			'route' => '/novo_especialista',
			'controller' => 'PedidoController',
			'action' => 'novoEspecialista'
		);

		$routes['trocar_especialista'] = array(
			'route' => '/trocar_especialista',
			'controller' => 'PedidoController',
			'action' => 'trocaEspecialista'
		);

		$routes['pedido_visu_adm'] = array(
			'route' => '/pedido_visu_adm',
			'controller' => 'AdmController',
			'action' => 'pedidoVisuAdm'
		);

		$routes['pedido_pago'] = array(
			'route' => '/pedido_pago',
			'controller' => 'AdmController',
			'action' => 'pedidoPago'
		);

		$routes['pedido_revisão'] = array(
			'route' => '/pedido_revisao',
			'controller' => 'AdmController',
			'action' => 'pedidoRevisao'
		);



		//rotas de especialista//
		
		////////////////////////

		$routes['home-esp'] = array(
			'route' => '/esp/home',
			'controller' => 'espController',
			'action' => 'home'
		);

		$routes['pedidos-esp'] = array(
			'route' => '/esp/pedidos',
			'controller' => 'espController',
			'action' => 'pedidos'
		);

		$routes['aceita_pedido'] = array(
			'route' => '/esp/aceita_pedido',
			'controller' => 'espController',
			'action' => 'aceitaPedido'
		);

		$routes['finaliza_pedido'] = array(
			'route' => '/esp/finaliza_pedido',
			'controller' => 'espController',
			'action' => 'finalizaPedido'
		);

		$routes['revisa_pedido'] = array(
			'route' => '/esp/revisa_pedido',
			'controller' => 'espController',
			'action' => 'revisaPedido'
		);

		
		$routes['pedido_visu_esp'] = array(
			'route' => '/esp/pedido_visu_esp',
			'controller' => 'EspController',
			'action' => 'pedidoVisuEsp'
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

		$routes['criacao'] = array(
			'route' => '/criacao',
			'controller' => 'PedidoController',
			'action' => 'criacao'
		);

		$routes['visualizar'] = array(
			'route' => '/visualizar',
			'controller' => 'PedidoController',
			'action' => 'visualizar'
		);

		$routes['criar_pedido'] = array(
			'route' => '/criar_pedido',
			'controller' => 'PedidoController',
			'action' => 'criar'
		);





		$this->setRoutes($routes);
	}

}

?>