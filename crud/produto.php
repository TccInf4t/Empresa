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

	// Insere Uma Imagem no Servidor
	function inserirImagem($file){
		$uploaddir	= "../img/";
		$nome_arq	= basename($file['name']);
		$caminho 	= $uploaddir . $nome_arq;

		// Verificando se o Arquivo Escolhido Foi Uma Imagem Valida
		if(strstr($nome_arq,'.jpg') || strstr($nome_arq,'.png') || strstr($nome_arq,'.gif') || strstr($nome_arq,'.jpeg')){
			if(!move_uploaded_file($file["tmp_name"], $caminho)){
				echo('<script>alert("ERRO AO CADASTRAR IMAGEM");</script>');
			}

		}else { echo('<script>alert("EXTENSÃO INVÁLIDA");</script>'); }

		return $caminho;
	}

	// Inseri um Novo Registro
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
		$caminhoImg = inserirImagem($_FILES['arqImagem']);
		$qtd_acesso = 1;

		$exec = mysql_query("insert into imagem(nome, classname, caminho) values('Produto', 'TPeca', '". $caminhoImg ."');");
		$exec = mysql_query("select * from imagem order by oid_imagem desc limit 1;");
		$idImagem = mysql_fetch_array($exec)['oid_imagem'];
		
		// Inserção do Produto
		$query = "insert into peca(oid_tipopeca, nome, ano, descricao, validade, codbarra, preco, peso, marca, qtd_acesso, oid_imagem)
		values(". $slTipoPeca .", '". $txtNome ."', '". $dtAno ."', '". $txtDescricao ."', '". $dtValidade ."', '". $txtCodBarras ."', ". $txtPreco .", ". $txtPeso .", '". $slMarca ."', ". $qtd_acesso .", ". $idImagem .");";
		$exec = mysql_query($query);

		// Recuperando o ID do Ultimo Produto
		$exec = mysql_query("select * from peca order by oid_peca desc limit 1;");
		$idProduto = mysql_fetch_array($exec)['oid_peca'];

		// Montando o Insert da Tabela 'peca_estoque'
		$maxEstoque = maxEstoque();
		$lista = "";

		// Verificando os Estoques Selecionados
		for($i=1; $i<=$maxEstoque; $i++){
			if(isset($_POST['estoqueNome' . $i])){
				$qtdMin = $_POST['estoqueQtdMinima'. $i];
				$qtdAtual = $_POST['estoqueQtdAtual'. $i];

				$lista .= "(". $idProduto .", ". $i .", ". $qtdMin .", ". $qtdAtual ."),";
			}
		}

		$query = "insert into peca_estoque(oid_peca, oid_estoque, qtdmin, qtdatual)
				  values". $lista .";";
		$query = str_replace("),;", ");", $query);
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

	// Atualiza um Registro Existente
	function atualizar($id){
		$txtNome = $_POST['txtNome'];
		$dtAno = $_POST['dtAno'];
		$dtValidade = $_POST['dtValidade'];
		$txtCodBarras = $_POST['txtCodBarras'];
		$txtPreco = $_POST['txtPreco'];
		$txtPeso = $_POST['txtPeso'];
		$slMarca = $_POST['slMarca'];
		$slTipoPeca = $_POST['slTipoPeca'];
		$txtDescricao = $_POST['txtDescricao'];
		$caminhoImg = inserirImagem($_FILES['arqImagem']['name']);
		$qtd_acesso = 1;

		// Atualizando a Imagem do Produto
		$exec = mysql_query("select oid_imagem from peca where oid_peca = ". $id .";");
		$idImagem = mysql_fetch_array($exec)['oid_imagem'];
		$exec = mysql_query("update imagem set nome = '', caminho = '". $caminhoImg ."' where oid_imagem = ". $idImagem .";");

		// Atualização do Produto
		$query = "update peca set oid_tipopeca = ". $slTipoPeca .", nome = '". $txtNome ."', ano = '". $dtAno ."', descricao = '". $txtDescricao ."', validade = '". $dtValidade ."', codbarra = '". $txtCodBarras ."', preco = ". $txtPreco .", peso = '". $txtPeso ."', marca = '". $slMarca ."'	, qtd_acesso = ". $qtd_acesso ." where oid_peca = ". $id .";";
		$exec = mysql_query($query);

		// Montando o Insert da Tabela 'peca_estoque'
		$maxEstoque = maxEstoque();
		$lista = "";

		// Removendo os Estoques do Produto Para Adicionar os Novos
		$query = "delete from peca_estoque where oid_peca = ". $id .";";
		$exec = mysql_query($query);

		// Verificando os Estoques Selecionados
		for($i=1; $i<=$maxEstoque; $i++){
			if(isset($_POST['estoqueNome' . $i])){
				$qtdMin = $_POST['estoqueQtdMinima'. $i];
				$qtdAtual = $_POST['estoqueQtdAtual'. $i];

				$lista .= "(". $id .", ". $i .", ". $qtdMin .", ". $qtdAtual ."),";
			}
		}

		$query = "insert into peca_estoque(oid_peca, oid_estoque, qtdmin, qtdatual)
				  values". $lista .";";
		$query = str_replace("),;", ");", $query);
		$exec = mysql_query($query);

		if(!$exec) echo($query);
	}

	// Exclui um Registro
	function excluir($id){
		$query = "delete from peca_estoque where oid_peca = ". $id .";";
		$exec = mysql_query($query);

		$query = "delete from peca where oid_peca = ". $id .";";
		$exec = mysql_query($query);

		if(!$exec) echo($query);
	}
?>