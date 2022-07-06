<?php
namespace rede;

class Mensagem extends Model{

	private $table = "mensagem";
	protected $fields = [
		"id",
		"id_enviou",
		"id_recebido",
		"mensagem",
		"data_envio"
	];

	function insertMensagem($campos){
		$this->insert($this->table, $campos);
	}

	function updateMensagem($valores, $where){
		$this->update($this->table, $valores, $where);
	}

	function deleteMensagem(){
		$this->delete($this->table, $coluna,  $valor);

	}

	function selectMensagem($campos, $where):array{
		return $this->select($this->table, $campos, $where);
	}
	function getConversasUsuarios($id){
	$sql = "SELECT id, id_enviou, id_recebido, mensagem FROM mensagem WHERE (id_enviou = :id_enviou AND id_recebido != :id_enviou)  OR (id_recebido = :id_enviou AND id_enviou != :id_enviou) ORDER BY data_envio DESC";
	$params = array(':id_enviou' => $id);
	$resultado = $this->querySelect($sql, $params);

	$id_aparece = array();
	$mensagens = array();

	array_push($id_aparece, $id);

	for ($i=0; $i < count($resultado) ; $i++) {
		$id_usuario = ($resultado[$i]['id_enviou'] === $id) ? $resultado[$i]['id_recebido'] : $resultado[$i]['id_enviou'];
		if (array_search($id_usuario, $id_aparece) === false) {
			$add = true;
			for ($t=0; $t < count($mensagens) ; $t++) { 
				
				if ($mensagens[$t]["id_enviou"] == $id && $mensagens[$t]['id_recebido'] == $id_usuario) {
					$add = false;
				}
				if ($mensagens[$t]["id_recebido"] == $id && $mensagens[$t]['id_enviou'] == $id_usuario) {
					$add = false;
				}
			}
			array_push($id_aparece, $id_usuario);
			if ($add) {
				array_push($mensagens, $resultado[$i]);
			}
		}
	}
	
	unset($id_aparece[0]);

	for ($m=0; $m < count($mensagens) ; $m++) { 
		
		$idUsuario = (int)($mensagens[$m]['id_enviou'] === $id) ? $mensagens[$m]['id_recebido'] : $mensagens[$m]['id_enviou'];

		$sql = "SELECT id, nome_user, foto_user FROM usuarios WHERE id = :idUsuario";
		$params = array(':idUsuario' => $idUsuario);
		$usuario = $this->querySelect($sql, $params)[0];
		$mensagens[$m]['mensagem'] = substr($mensagens[$m]['mensagem'], 0, 20)."...";
		$mensagens[$m]['nome_user'] = $usuario['nome_user'];

		$mensagens[$m]['foto_user'] = ($usuario['foto_user'] == '' || !is_file($usuario['foto_user'])) ? URL_BASE."resources/img/user.png" : URL_BASE.$usuario['foto_user'];
	}

	return $mensagens;
}


?>