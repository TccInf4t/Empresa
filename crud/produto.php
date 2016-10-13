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
	header("location: ../produto.php");

	// Atualiza um Registro Existente
	function inserir(){
		$txtNome = $_POST['txtNome'];
		$dtAno = $_POST['dtAno'];
		$dtValidade = $_POST['dtValidade'];
		$txtCodBarras = $_POST['txtCodBarras'];
		$txtPreco = $_POST['txtPreco'];
		$txtPeso = $_POST['txtPeso'];
		$slMarca = $_POST['slMarca'];
		$slTipoPeca = $_POST['slTipoPeca'];
		$txtDescricao = $_POST['txtDescricao'];
		$qtd_acesso = 1;

		// Inserção do Produto
		$query = "insert into peca(oid_tipopeca, nome, ano, descricao, validade, codbarra, preco, peso, marca, qtd_acesso)
		values(". $slTipoPeca .", '". $txtNome ."', '". $dtAno ."', '". $txtDescricao ."', '". $dtValidade ."', '". $txtCodBarras ."', ". $txtPreco .", ". $txtPeso .", '". $slMarca ."', ". $qtd_acesso .");";
		$exec = mysql_query($query);

		// Recuperando o ID do Ultimo Produto
		$exec = mysql_query("select * from peca order by oid_peca desc limit 1;");
		$idProduto = mysql_fetch_array($exec)['oid_peca'];

		// Montando o Insert da Tabela 'peca_estoque'
		$maxEstoque = maxEstoque();
		$lista = "";

		for($i=1; $i<=$maxEstoque; $i++){
			if(isset($_POST['estoqueNome' . $i])){
				$qtdMin = $_POST['estoqueQtdMinima'. $i];
				$qtdAtual = $_POST['estoqueQtdAtual'. $i];

				if($i != $maxEstoque) $lista .= "(". $idProduto .", ". $i .", ". $qtdMin .", ". $qtdAtual ."), ";
				else $lista .= "(". $idProduto .", ". $i .", ". $qtdMin .", ". $qtdAtual .")";
			}
		}

		$query = "insert into peca_estoque(oid_peca, oid_estoque, qtdmin, qtdatual)
				  values". $lista .";";
		// echo($query);
		$exec = mysql_query($query);

		if(!$exec) echo($query);
	}

	// Retorna o Número Máximo do ID do Estoque
	function maxEstoque(){
		$exec = mysql_query("select max(oid_estoque) as max from estoque;");
		$rs = mysql_fetch_array($exec);
		$max = $rs['max'];

		return $max;
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
		$query = "delete from peca where oid_peca = ". $id .";";
		echo($query);
		$exec = mysql_query($query);

		if(!$exec) echo($query);
	}
?>