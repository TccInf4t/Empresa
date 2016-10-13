<?php
	include("../db/conexao.php");

	$con = conectar();

	$id = $_GET['id_estado'];

	$query = "select * from cidade where oid_estado = ". $id .";";
	$exec = mysql_query($query);

	// Montando Lista de Cidades Referentes ao Estado Escolhido
	while($rs = mysql_fetch_array($exec)){
		echo("<option value='". $rs['oid_cidade'] ."'>". $rs['nome'] ."</option>");
	}
?>