<?php
	require_once("../db/conexao.php");

	conectar();

	if(isset($_POST['btnSalvar']) && $_POST['btnSalvar'] == "Salvar"){
		inserir();

	}else if(isset($_POST['btnSalvar']) && $_POST['btnSalvar'] == "Editar"){
		$id = $_GET['id'];
		atualizar($id);

	}else if(isset($_GET['id'])){
		$id = $_GET['id'];
		excluir($id);
	}

	// Redirecionando Para a Página de Cadastro
	header("location: ../categoria.php");

	// Atualiza um Registro Existente
	function inserir(){
		$id = $_GET['id'];
		$txtCategoria = $_POST['txtCategoria'];

		$query = "insert into tipoPeca(nome) values('". $txtCategoria ."');";
		$exec = mysql_query($query);

		if(!$exec) echo($query);
	}

	// Inseri um Novo Registro
	function atualizar($id){
		$txtCategoria = $_POST['txtCategoria'];
		
		$query = "update tipoPeca set nome = '". $txtCategoria ."' where oid_tipopeca = ". $id .";";
		$exec = mysql_query($query);

		if(!$exec) echo($query);
	}

	// Exclui um Registro
	function excluir($id){
		$query = "delete from tipoPeca where oid_tipopeca =". $id .";";
		$exec = mysql_query($query);

		if(!$exec) echo($query);
	}
?>