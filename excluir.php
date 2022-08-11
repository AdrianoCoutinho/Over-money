<?php
		require('connect.php');
		//conectando com o localhost - mysql
		$id = $_GET ["id"];
		$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
		if (!$conn)
		echo ("Erro de conexão com localhost, o seguinte erro ocorreu -> ");
		$sql = "DELETE FROM movimentos WHERE id = '$id'";
		$result = $conn->query($sql);
		header("Location: home.php");
		die();
?>