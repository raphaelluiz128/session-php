<?php

class Login extends Conexao {

	private $nome;
	private $senha;

	public function setNome($nome){
		$this->nome = $nome;
	}
	public function setSenha($senha){
		$this->senha = $senha;
	}
	public function getNome(){
		return $this->nome;
	}
	public function getSenha(){
		return $this->senha;
	}

	public function logar(){
		$pdo = parent::getDB();

		$logar = $pdo->prepare("SELECT * FROM clientes WHERE nome = ? AND senha = ?");
		$logar->bindValue(1, $this->getNome());
		$logar->bindValue(2, $this->getSenha());
		$logar->execute();
		if ($logar->rowCount() == 1):
			$dados = $logar->fetch(PDO::FETCH_OBJ);
			$_SESSION['administrador'] = $dados->nome;
			$_SESSION['logado'] = true;
			return true;
		else:
			return false;
		endif;
	}

	public static function deslogar() {
		if(isset($_SESSION['logado'])):
			unset($_SESSION['logado']);
			session_destroy();
			header("Location: index.php");
		endif;
	}
}

?>
