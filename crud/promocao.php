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
	header("location: ../promocao.php");

	// Atualiza um Registro Existente
	function inserir(){
		$txtNome = $_POST['txtNome'];
		$dtInicio = $_POST['dtInicio'];
		$dtTermino = $_POST['dtTermino'];
		$numPerc = $_POST['numPerc'];

		// Inserção do Produto
		$query = "insert into promocao(nome, dt_inicio, dt_termino, perc)
				  values('". $txtNome ."', '". $dtInicio ."', '". $dtTermino ."', ". $numPerc .");";
		$exec = mysql_query($query);

		if(!$exec) echo($query);
	}

	// Inseri um Novo Registro
	function atualizar($id){
		$txtNome = $_POST['txtNome'];
		$dtInicio = $_POST['dtInicio'];
		$dtTermino = $_POST['dtTermino'];
		$numPerc = $_POST['numPerc'];

		// Inserção do Produto
		$query = "update promocao set nome = '". $txtNome ."', dt_inicio = '". $dtInicio ."', dt_termino = '". $dtTermino ."', perc = ". $numPerc ."
				  where oid_promocao = ". $id .";";
		$exec = mysql_query($query);

		if(!$exec) echo($query);
	}

	// Exclui um Registro
	function excluir($id){
		$query = "delete from promocao where oid_promocao = ". $id .";";
		$exec = mysql_query($query);

		if(!$exec) echo($query);
	}
?>