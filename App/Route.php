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

		$routes['chat-adm'] = array(
			'route' => '/adm/chat',
			'controller' => 'admController',
			'action' => 'chat'
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

		$routes['editar'] = array(
			'route' => '/editar',
			'controller' => 'PedidoController',
			'action' => 'editar'
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

		$routes['pedido_entregue'] = array(
			'route' => '/pedido_entregue',
			'controller' => 'AdmController',
			'action' => 'pedidoEntregue'
		);

		$routes['pedido_revisão_final'] = array(
			'route' => '/pedido_revisao_final',
			'controller' => 'AdmController',
			'action' => 'pedidoRevisaoFinal'
		);



		//rotas de especialista//
		
		////////////////////////

		$routes['home-esp'] = array(
			'route' => '/esp/home',
			'controller' => 'espController',
			'action' => 'home'
		);

		
		$routes['uploadImagemEsp'] = array(
			'route' => '/uploadImagemEsp',
			'controller' => 'EspController',
			'action' => 'uploadImagem'
		);

		$routes['configurar'] = array(
			'route' => '/esp/configurar',
			'controller' => 'EspController',
			'action' => 'configurar'
		);

		$routes['pedidos-esp'] = array(
			'route' => '/esp/pedidos',
			'controller' => 'EspController',
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

		$routes['calendario'] = array(
			'route' => '/esp/calendario',
			'controller' => 'EspController',
			'action' => 'calendario'
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
			'action' => 'criarPedido'
		);

		$routes['atualizar_pedido'] = array(
			'route' => '/atualizar_pedido',
			'controller' => 'PedidoController',
			'action' => 'atualizarPedido'
		);

		//rotas de CHAT//
		
		////////////////////////


		$routes['nova-conversa'] = array(
			'route' => '/nova-conversa',
			'controller' => 'ChatController',
			'action' => 'CriarConversa'
		);

		$this->setRoutes($routes);
	}
	
}

?>