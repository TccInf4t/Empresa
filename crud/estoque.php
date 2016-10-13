<?php
	require_once("../db/conexao.php");
	require_once("endereco.php");

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
	header("location: ../estoque.php");

	// Inseri um Novo Registro
	function inserir(){
		$txtNome = $_POST['txtNome'];
		$slCidade = $_POST['slCidade'];
		$txtLogradouro = $_POST['txtLogradouro'];
		$txtNumero = $_POST['txtNumero'];
		$txtCEP = $_POST['txtCEP'];
		$txtBairro = $_POST['txtBairro'];
		$txtComplemento = $_POST['txtComplemento'];

		// Inserindo o endereço
		$query = "insert into endereco(oid_cidade, logradouro, numero, cep, bairro, complemento, classname)
		values(". $slCidade .", '". $txtLogradouro ."', '". $txtNumero ."', '". $txtCEP ."', '". $txtBairro ."', '". $txtComplemento ."', 'TEstoque');";
		mysql_query($query);

		// Recuperando o endereço inserido
		$exec = mysql_query("select * from endereco order by oid_endereco desc limit 1;");
		$idEndereco = mysql_fetch_array($exec)['oid_endereco'];

		// Inserindo o estoque com o endereço
		$query = "insert into estoque(nomeexibicao, oid_endereco) value('". $txtNome ."', ". $idEndereco .");";
		$exec = mysql_query($query);

		if(!$exec) echo($query);
	}

	// Atualiza um Registro Existente
	function atualizar($idEstoque){
		$txtNome = $_POST['txtNome'];
		$slCidade = $_POST['slCidade'];
		$txtLogradouro = $_POST['txtLogradouro'];
		$txtNumero = $_POST['txtNumero'];
		$txtCEP = $_POST['txtCEP'];
		$txtBairro = $_POST['txtBairro'];
		$txtComplemento = $_POST['txtComplemento'];

		$query = "update estoque set nomeexibicao = '". $txtNome ."' where oid_estoque = ". $idEstoque .";";
		$exec = mysql_query($query);

		$exec = mysql_query("select * from estoque where oid_estoque = ". $idEstoque .";");
		$idEndereco = mysql_fetch_array($exec);
		$idEndereco = $idEndereco["oid_endereco"];

		// Atualizando o endereço do Estoque
		$query = "update endereco set oid_cidade = ". $slCidade .", logradouro = '". $txtLogradouro ."', numero = '". $txtNumero ."', cep = '". $txtCEP ."', bairro = '".
		$txtBairro ."', complemento = '". $txtComplemento ."' where oid_endereco = ". $idEndereco .";";
		mysql_query($query);

		if(!$exec) echo($query);
	}

	// Exclui um Registro
	function excluir($id){
		$query = "delete from estoque where oid_estoque = ". $id .";";
		$exec = mysql_query($query);

		if(!$exec) echo($query);
	}
?>