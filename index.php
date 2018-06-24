<?php
	session_start();

	require_once "classes/Conexao.class.php";
	require_once "classes/Usuario.class.php";

	if (isset($_POST['ok'])):

		$nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_MAGIC_QUOTES);
		$senha = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_MAGIC_QUOTES);

		$l = new login;
		$l->setNome($nome);
		$l->setSenha($senha);

		if($l->logar()):
			header("Location: dashboard.php");
		else:
			$erro = "Erro ao logar";
		endif;
	endif;


	if(isset($_SESSION['logado'])):
		header("Location: dashboard.php");
	else:
?>
<html lang="pt-br">
	<head>
		<meta charset="utf-8"/>
		<title>Titulo</title>
		<meta name="author" content="Raphael">
		<meta name="description" content="">
		<link rel="stylesheet" type="text/css" href="css/main.css"> 
	</head>
	<body>

		<div id="login">
			<form action="" method="POST" class="formulario">
				<div class="login">Nome</div>
				<input type="text" name="nome">
				<div class="senha">Senha</div>
				<input type="password" name="senha">
				<input type="submit" name="ok" value="Logar">
			</form>
			<?php echo isset($erro) ? $erro : ''; ?>
		</div>		


<?php
	endif;
?>

	</body>
</html>
