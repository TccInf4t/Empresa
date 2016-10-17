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
	header("location: ../peca_promocao.php");

	// Atualiza um Registro Existente
	function inserir(){
		$slProduto = $_POST['slProduto'];
		$slPromocao = $_POST['slPromocao'];
		$numPerc = $_POST['numPerc'];

		// Inserção do Produto
		$query = "insert into peca_promocao(oid_peca, oid_promocao, perc_unico)
				  values(". $slProduto .", ". $slPromocao .", ". $numPerc .");";
		$exec = mysql_query($query);

		if(!$exec) echo($query);
	}

	// Inseri um Novo Registro
	function atualizar($id){
		$slProduto = $_POST['slProduto'];
		$slPromocao = $_POST['slPromocao'];
		$numPerc = $_POST['numPerc'];;

		// Inserção do Produto
		$query = "update peca_promocao set oid_peca = ". $slProduto .", oid_promocao = ". $slPromocao .", perc_unico = ". $numPerc ."
				  where oid_peca_promocao = ". $id .";";
		$exec = mysql_query($query);

		if(!$exec) echo($query);
	}

	// Exclui um Registro
	function excluir($id){
		$query = "delete from peca_promocao where oid_peca_promocao = ". $id .";";
		$exec = mysql_query($query);

		if(!$exec) echo($query);
	}
?>