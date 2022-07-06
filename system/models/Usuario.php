<?php
namespace rede;

class usuario extends Model{

	private $table = "usuarios";
	protected $fields = [
		"id",
		"url_user",
		"nome_user",
		"sobrenome_user",
		"telefone_user",
		"email_user",
		"foto_user",
		"descricao_user",
		"data_cadastro"
	];

	function insertUser($campos){
		$this->insert($this->table, $campos);
	}

	function updateUser($valores, $where){
		$this->update($this->table, $valores, $where);
	}

	function deleteUser(){
		$this->delete($this->table, $coluna,  $valor);

	}

	function selectUser($campos, $where):array{
		return $this->select($this->table, $campos, $where);
	}

	function getUsuario($campos){

		$resultado = $this->selectUser($this->fields, array('email_user' => $campos['email_user']))[0];

		if ($resultado['foto_user'] == '' OR !is_file($resultado['foto_user'])){
			$resultado['foto_user'] = URL_BASE."resources/img/user.png";
		}else{
			$resultado['foto_user'] = URL_BASE.$resultado['foto_user'];
		}

		return $resultado;
	}
		function gerarUrlPerfil($primeiroNome, $id) {

		$search = ['@<script[^>]*?>.*?</script>@si', '@<style[^>]*?>.*?</style>@siU', '@<[\/\!]*?[^<>]*?>@si', '@<![\s\S]*?--[ \t\n\r]*>@'];

		$string = preg_replace($search, '', $primeiroNome);

		$table = ['Š'=>'S','š'=>'s','Đ'=>'Dj','đ'=>'dj','Ž'=>'Z','ž'=>'z','Č'=>'C','č'=>'c','Ć'=>'C','ć'=>'c','À'=>'A','Á'=>'A','Â'=>'A','Ã'=>'A','Ä'=>'A','Å'=>'A','Æ'=>'A','Ç'=>'C','È'=>'E','É'=>'E','Ê'=>'E','Ë'=>'E','Ì'=>'I','Í'=>'I','Î'=>'I','Ï'=>'I','Ñ'=>'N','Ò'=>'O','Ó'=>'O','Ô'=>'O','Õ'=>'O','Ö'=>'O','Ø'=>'O','Ù'=>'U','Ú'=>'U','Û'=>'U','Ü'=>'U','Ý'=>'Y','Þ'=>'B','ß'=>'Ss','à'=>'a','á'=>'a','â'=>'a','ã'=>'a','ä'=>'a','å'=>'a','æ'=>'a','ç'=>'c','è'=>'e','é'=>'e','ê'=>'e','ë'=>'e','ì'=>'i','í'=>'i','î'=>'i','ï'=>'i','ð'=>'o','ñ'=>'n','ò'=>'o','ó'=>'o','ô'=>'o','õ'=>'o','ö'=>'o','ø'=>'o','ù'=>'u','ú'=>'u','û'=>'u','ý'=>'y','ý'=>'y','þ'=>'b','ÿ'=>'y','Ŕ'=>'R','ŕ'=>'r'
		];

		$string = strtr($string, $table);
		$string = mb_strtolower($string);
		$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
		return $string.$id;
	}
}


?>