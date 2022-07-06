<?php
namespace rede\Controllers;
use Rain\Tpl;
use rede\Controllers\UserController;
use rede\Usuario;
use rede\Mensagem;

if (!isset($_SESSION)){
	session_start();
}


class HomeController{
	private $tpl;
	private $default = array(
		'footer' => true,
		'header_login' => false,
		'links' => true,
		'pagina_mensagem' => false
	);

	private $usuarios_logado = array();

	function __construct(){

		$config = array(
			'base_url' => __DIR_PRINCIPAL__,
			'tpl_dir' => $_SERVER['DOCUMENT_ROOT'].__DIR_PRINCIPAL__.'/system/views/',
			'cache_dir' => $_SERVER['DOCUMENT_ROOT'].__DIR_PRINCIPAL__.'/cache/',
			'tpl_ext' => 'php'

		);

		Tpl::configure($config);
		$this->tpl = new Tpl;

		if(isset($_SESSION['usuario_logado']) && $_SESSION['usuario_logado'] != NULL){
			$user = new Usuario;
			$this->usuario_logado = $user->getUsuario($_SESSION['usuario_logado']);
		}	
	}

	function __destruct(){
		if ($this->default['footer'] === true){
			$this->setTpl('footer');
		}
		
		$this->setTpl('fim_html');
	}

	public function setTpl($template, $data=array(), $returnHtml = false){

		$this->setData($data);

		return $this->tpl->draw($template, $returnHtml);

	}

	public function setData($data= array()){

		foreach ($data as $key => $value){
			$this->tpl->assign($key, $value);
		}
	}

	public function login(){
		if (isset($_SESSION['usuario_logado']) && $_SESSION['usuario_logado'] != NULL){
			header("Location: ".URL_BASE.'feed');
			exit();
		}
		$info = array(
			'titulo_pagina' => 'login',
			'header_login' => true,
			'url_base' => URL_BASE

		);

		$this->setTpl('header', $info);  
		$this->setTpl('login');

	
	}
	public function feed(){
		$this->default['footer'] = false;
		UserController::verify_login();


		$info = array(
			'titulo_pagina' => 'feed',
			'header_login' => $this->default['header_login'],
			'url_base' => URL_BASE,
			'links' => $this->default['links'],
			'pagina_mensagem' => $this->default['pagina_mensagem'],
			'usuarios' => $this->usuario_logado,
			'usuario_logado' => $this->usuario_logado

		);
		
		$this->setTpl('header', $info);
		$this->setTpl('inicio_central', array('classPrincipal' => 'feed'));
		$this->setTpl('esquerda');
		$this->setTpl('feed');
		$this->setTpl('direita');
		$this->setTpl('final_central');

	}

	public function feed_usuario($request, $response, $args){
		UserController::verify_login();

		$this->default['footer'] = false;
		$url_usuario = $args['usuario'];

		if ($this->usuario_logado['url_user'] === $url_usuario){
			$usuario = $this->usuario_logado;

		}else{
			$user = new Usuario;

			$campos = array(
				"id",
				"url_user",
				"nome_user",
				"sobrenome_user",
				"telefone_user",
				"email_user",
				"foto_user",
				"descricao_user",
				"data_cadastro",
			);
			$where = array(
				'url_user' => $url_usuario
			);

			$usuario = $user->selectUser($campos, $where)[0];	

			if ($usuario['foto_user'] == '' OR !is_file($usuario['foto_user'])){
				$usuario['foto_user'] = URL_BASE."resources/img/user.png";
			}else{
				$usuario['foto_user'] = URL_BASE.$usuario['foto_user'];
			}	
		}
		
		$info = array(
			'titulo_pagina' => 'feed de '.$usuario['nome_user'],
			'header_login' => $this->default['header_login'],
			'url_base' => URL_BASE,
			'links' => false,
			'pagina_mensagem' => $this->default['pagina_mensagem'],
			'usuarios' => $usuario,
			'usuario_logado' => $this->usuario_logado
		);

		
		$this->setTpl('header', $info);
		$this->setTpl('inicio_central', array('classPrincipal' => 'feed'));
		$this->setTpl('esquerda');
		$this->setTpl('feed_usuario');
		$this->setTpl('direita');
		$this->setTpl('final_central');
	}

	public function configuracao(){
		UserController::verify_login();

		$info = array(
			'titulo_pagina' => 'configuracao',
			'header_login' => $this->default['header_login'],
			'url_base' => URL_BASE,
			'links' => $this->default['links'],
			'pagina_mensagem' => $this->default['pagina_mensagem'],
			'usuarios' => $this->usuario_logado,
			'usuario_logado' => $this->usuario_logado
			
		);

		$this->setTpl('header', $info);
		$this->setTpl('inicio_central', array('classPrincipal' => 'configuracao'));
		$this->setTpl('esquerda');
		$this->setTpl('configura');
		$this->setTpl('final_central');
	}

	public function pesquisa(){
		UserController::verify_login();

		$this->default['footer'] = false;

		$info = array(
			'titulo_pagina' => 'pesquisa',
			'header_login' => $this->default['header_login'],
			'url_base' => URL_BASE,
			'links' => $this->default['links'],
			'pagina_mensagem' => $this->default['pagina_mensagem'],
			'usuarios' => $this->usuario_logado,
			'usuario_logado' => $this->usuario_logado

		);
		
		$this->setTpl('header', $info);
		$this->setTpl('inicio_central', array('classPrincipal' => 'pesquisa'));
		$this->setTpl('esquerda');
		$this->setTpl('pesquisa');
		$this->setTpl('direita');
		$this->setTpl('final_central');
	}

	public function mensagem(){
		UserController::verify_login();

		$lista_mensagem = new Mensagem;

		$lista_conversas = $lista_mensagem->getConversasUsuarios((int)$_SESSION['usuario_logado']['id']);

		echo '<pre>';
		var_dump($lista_conversas);
		exit();

		$info = array(
			'titulo_pagina' => 'Minhas mensagem',
			'header_login' => $this->default['header_login'],
			'url_base' => URL_BASE,
			'links' => $this->default['links'],
			'pagina_mensagem' => true,
			'usuarios' => $this->usuario_logado,
			'usuario_logado' => $this->usuario_logado,
			'lista_mensagens' => $lista_conversas

		);

		$this->setTpl('header', $info);
		$this->setTpl('inicio_central', array('classPrincipal' => 'mensagens'));
		$this->setTpl('esquerda');
		$this->setTpl('mensagem');
		$this->setTpl('final_central');
	
	}

	public function fotos(){
		UserController::verify_login();

		$info = array(
			'titulo_pagina' => 'fotos',
			'header_login' => $this->default['header_login'],
			'url_base' => URL_BASE,
			'links' => $this->default['links'],
			'pagina_mensagem' => $this->default['pagina_mensagem'],
			'usuarios' => $this->usuario_logado,
			'usuario_logado' => $this->usuario_logado

		);

		$this->setTpl('header', $info);
		$this->setTpl('inicio_central', array('classPrincipal' => 'minhas_fotos'));
		$this->setTpl('esquerda');
		$this->setTpl('fotos');
		$this->setTpl('final_central');
	}


}

?>
