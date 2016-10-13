<?php
	require_once("../db/conexao.php");

	conectar();

	// Inseri um Novo Registro
	function inserirEndereco($oid_cidade, $logradouro, $numero, $cep, $bairro, $complemento){
		$query = "insert into endereco(oid_cidade, logradouro, numero, cep, bairro, complemento)
		values(". $oid_cidade .", '". $logradouro ."', '". $numero ."', '". $cep ."', '". $bairro ."', '". $complemento ."');";

		$exec = mysql_query($query);
		var_dump($exec);
		return $exec;
	}

	// Atualiza um Registro Existente
	// function atualizar($id){
	// 	$txtCategoria = $_POST['txtCategoria'];
		
	// 	$query = "update tipoPeca set nome = '". $txtCategoria ."' where oid_tipopeca = ". $id .";";
	// 	$exec = mysql_query($query);

	// 	return $exec;
	// }

	// // Exclui um Registro
	// function excluir($id){
	// 	$query = "delete from tipoPeca where oid_tipopeca =". $id .";";
	// 	$exec = mysql_query($query);

	// 	return $exec;
	// }
?>