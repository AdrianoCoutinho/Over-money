<?php

	if (!isset($_POST['valor']))

	{

		header("Location: home.html");

		die();

	}
	
		require('connect.php');

		//conectando com o localhost - mysql

		$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

		if (!$conn)

		echo ("Erro de conexão com localhost, o seguinte erro ocorreu -> ");

		// RECEBENDO OS DADOS PREENCHIDOS DO FORMULÁRIO !

		$tipo = $_POST ["tipo"]; //atribuição de campo

		echo $tipo;

		if($tipo == "2"){
			$valor = "-".$_POST ["valor"]; //atribuição de campo
		}
		else
		{
			$valor = $_POST ["valor"]; //atribuição de campo
		}

		$descricao = $_POST ["descricao"]; //atribuição de campo

		$data = $_POST ["data"]; //atribuição de campo

		$result_usuario = "INSERT INTO movimentos (valor, descricao, data, tipo)

		VALUES ('$valor', '$descricao', '$data', '$tipo')";

		$resultado_usuario = mysqli_query($conn, $result_usuario);

		header("Location: home.php");

		die();