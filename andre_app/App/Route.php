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

		$routes['gestao'] = array(
			'route' => '/adm/gestao',
			'controller' => 'gestaoController',
			'action' => 'gestao'
		);

		$routes['gestao-novo'] = array(
			'route' => '/adm/gestao-novo',
			'controller' => 'gestaoController',
			'action' => 'gestaoNovo'
		);

		$routes['gestao-novo-aceitar'] = array(
			'route' => '/aceitar-novo-esp',
			'controller' => 'gestaoController',
			'action' => 'gestaoNovoAceito'
		);

		$routes['gestao-especialista'] = array(
			'route' => '/adm/gestao-especialista',
			'controller' => 'gestaoController',
			'action' => 'gestaoEspecialista'
		);

		$routes['gestao-editar'] = array(
			'route' => '/adm/gestao-editar',
			'controller' => 'gestaoController',
			'action' => 'gestaoEditar'
		);

		$routes['calendario-adm'] = array(
			'route' => '/adm/calendario',
			'controller' => 'admController',
			'action' => 'calendario'
		);

		$routes['chat-adm'] = array(
			'route' => '/adm/chat',
			'controller' => 'admController',
			'action' => 'chat'
		);

		$routes['chat-pedido-adm'] = array(
			'route' => '/adm/chat-pedido',
			'controller' => 'admController',
			'action' => 'chatPedido'
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

		$routes['configurar-adm'] = array(
			'route' => '/adm/configurar',
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

		$routes['novo-especialista-home'] = array(
			'route' => '/adm/novo-especialista',
			'controller' => 'AdmController',
			'action' => 'novoEspecialistaAdm'
		);

		$routes['novo-especialista-registrar'] = array(
			'route' => '/adm/registrar-novo',
			'controller' => 'AdmController',
			'action' => 'novoEspecialistaRegistrado'
		);

		$routes['uploadImagemAdm'] = array(
			'route' => '/uploadImagemAdm',
			'controller' => 'AdmController',
			'action' => 'uploadImagem'
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

		$routes['atualizar_especialista'] = array(
			'route' => '/atualizar_especialista',
			'controller' => 'AdmController',
			'action' => 'atualizarEspecialista'
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

		$routes['configurar-esp'] = array(
			'route' => '/esp/configurar',
			'controller' => 'EspController',
			'action' => 'configurar'
		);

		$routes['pedidos-esp'] = array(
			'route' => '/esp/pedidos',
			'controller' => 'EspController',
			'action' => 'pedidos'
		);

		$routes['chat-pedido-esp'] = array(
			'route' => '/esp/chat-pedido',
			'controller' => 'EspController',
			'action' => 'chatPedido'
		);

		$routes['chat-esp'] = array(
			'route' => '/esp/chat',
			'controller' => 'EspController',
			'action' => 'chat'
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
			'action' => 'criarConversa'
		);

		$routes['nova-conversa-pedido'] = array(
			'route' => '/nova-conversa-pedido',
			'controller' => 'ChatController',
			'action' => 'criarConversaPedido'
		);

		$routes['enviar-mensagem'] = array(
			'route' => '/enviar-mensagem',
			'controller' => 'ChatController',
			'action' => 'enviarMensagem'
		);

		$routes['enviar-mensagem-pedido'] = array(
			'route' => '/enviar-mensagem-pedido',
			'controller' => 'ChatController',
			'action' => 'enviarMensagemPedido'
		);

		$routes['buscar-mensagem'] = array(
			'route' => '/buscar-mensagens',
			'controller' => 'ChatController',
			'action' => 'buscarMensagem'
		);

		$routes['buscar-mensagem-pedido'] = array(
			'route' => '/buscar-mensagens-pedido',
			'controller' => 'ChatController',
			'action' => 'criarConversaPedido'
		);

		$this->setRoutes($routes);
	}
	
}

?>