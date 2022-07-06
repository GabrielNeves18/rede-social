<?php

//cadastrar usuario
namespace rede\Controllers;

use rede\usuario;
use rede\Mensagem;

// inicia uma sessão
if(!isset($_SESSION)){
	session_start();
}

class UserController{

	private $user;
	function __construct(){
		$this->user = new usuario;
	}

	public function login_usuario($request, $response, $args){
		$email = $request->getParsedBodyParam('email');
		$senha = $request->getParsedBodyParam('senha');

		$campos = array(
			'id',
			'email_user'
		);

		$where = array(
			'email_user' => $email
		);
		$resultado = $this->user->selectUser($campos, $where);

		if ($resultado){

			$retorno= $this->login($email, $senha);

			if($retorno){

				$resposta_retorno['status'] = '1';
				$resposta_retorno['redirecionar_pagina'] = URL_BASE.'feed';
				return $response->withJson($resposta_retorno);

			}else{

				$resposta_retorno['status'] = '0';
				$resposta_retorno['msg'] = 'Email ou senha inválidos';
				return $response->withJson($resposta_retorno);
			}


		}else{

			$resposta_retorno['status'] = '0';
			$resposta_retorno['msg'] = 'Email ou senha inválidos';
			return $response->withJson($resposta_retorno);
		}
	}

	public function cadastrar($request, $response, $args){

		$nome = $request->getParsedBodyParam('nome');
		$email = $request->getParsedBodyParam('email');
		$telefone = $request->getParsedBodyParam('telefone');
		$senha = $request->getParsedBodyParam('senha');

		//validação de email, verificar se tem mais de um igual
		$campos = array(
			'id',
			'email_user'
		);

		$where = array(
			'email_user' => $email
		);
		$resultado = $this->user->selectUser($campos, $where);


		if ($resultado){

				$resposta_retorno['status'] = '0';
				$resposta_retorno['msg'] = 'Email já existente';
				return $response->withJson($resposta_retorno);
		}else{

			// injeção de usuarios
			$campos = array(
				'nome_user' => $nome,
				'email_user' => $email,
				'telefone_user' => $telefone,
				'senha_user' => password_hash($senha, PASSWORD_DEFAULT, ["cost"=>12])
			);

			$this->user->insertUser($campos);

			$retorno = $this->login($email, $senha);

			$url_perfil = $this->user->gerarUrlPerfil($nome, $_SESSION['usuario_logado']['id']);

			$valores = array(
				'url_user' => $url_perfil
			);
			$where = array(
				'id' => (int)$_SESSION['usuario_logado']['id']
			);

			$this->user->updateUser($valores, $where);

			if($retorno){
				$resposta_retorno['status'] = '1';
				$resposta_retorno['redirecionar_pagina'] = URL_BASE.'feed';
				return $response->withJson($resposta_retorno);

			}else{
				$resposta_retorno['status'] = '0';
				$resposta_retorno['msg'] = 'Erro no login';
				$resposta_retorno['resetar_form'] = true;
				return $response->withJson($resposta_retorno);
			}
		}
	}
	// fazer login
	function login($email='', $senha=''){
		if($email !== '' && $senha !== ''){
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
				"senha_user"
			);
			$where = array(
				'email_user' => $email
			);

			$resultado = $this->user->selectUser($campos, $where);

			// verifica os dados passados pelo usuario e cria uma sessão
			if (password_verify($senha, $resultado[0]['senha_user'])){

				$this->user->setData($resultado[0]);
				$_SESSION['usuario_logado'] = $this->user->getValues();

				return true;

			}else{
				return false;
			
			}

		}else{
			return null;
		}
	}

	public static function verify_login(){
		if (!isset($_SESSION['usuario_logado']) OR $_SESSION['usuario_logado'] == NULL){
			header("Location: ".URL_BASE);
			exit();
		}
	}
	public function logout(){
		if (isset($_SESSION['usuario_logado'])) {

			$_SESSION['usuario_logado'] = NULL;
			unset($_SESSION['usuario_logado']);
		}

		header("Location: ".URL_BASE);
		exit();
	}

	public function quem_sou_eu($request, $response, $args){
		$bio = $request->getParsedBodyParam('quem_sou_eu');

		if ($bio != '' && $bio != NULL){

			$valores = array(
				'descricao_user' => $bio

			);

			$where = array(
				'id' => (int)$_SESSION['usuario_logado']['id']
			);

			$this->user->updateUser($valores, $where);

			$resposta_retorno['status'] = '1';
			$resposta_retorno['msg'] = 'Atualização com sucesso! :)';
			return $response->withJson($resposta_retorno);
		}else{

			$resposta_retorno['status'] = '0';
			$resposta_retorno['msg'] = 'Não é possível atualizar! :(';
			return $response->withJson($resposta_retorno);
		}
		
	}

	public function nova_mensagem($request, $response, $args){
		$id_user_recebe = $request->getParsedBodyParam('id_user_recebe');
		$mensagem_enviada = $request->getParsedBodyParam('mensagem');

		if ($mensagem_enviada != '' && $mensagem_enviada != NULL){

			$nova_mensagem = new Mensagem;

			$campos = array(
				'id_enviou' => (int)$_SESSION['usuario_logado']['id'],
				'id_recebido' => (int)$id_user_recebe,
				'mensagem' => $mensagem_enviada,
				'data_envio' => date("d-m-Y H:i:s")
			);

			$nova_mensagem->insertMensagem($campos);

			$resposta_retorno['status'] = '1';
			$resposta_retorno['msg'] = 'Mensagem envida :)';
			$resposta_retorno['resetar_form'] = true;
			$resposta_retorno['ocultar_alerta'] = true;
			return $response->withJson($resposta_retorno);
		
		}else{

			$resposta_retorno['status'] = '0';
			$resposta_retorno['msg'] = 'Evite su a mensagem! :(';
			$resposta_retorno['ocultar_alerta'] = true;
			return $response->withJson($resposta_retorno);
		}	
	}
}

?>
