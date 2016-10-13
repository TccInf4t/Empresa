<?php
	include("db/conexao.php");

	conectar();

	$txtNome 		= "";
	$dtAno 			= "";
	$dtValidade 	= "";
	$txtCodBarras 	= "";
	$txtPreco 		= "";
	$txtPeso 		= "";
	$slMarca 		= "";
	$slTipoPeca 	= "";
	$txtDescricao 	= "";

	$btn = "Salvar";
	$idEditar = "";

	if(isset($_GET['modo']) && isset($_GET['id'])){
		$modo = $_GET['modo'];
		$id = $_GET['id'];

		if($modo == "consultar"){
			$query = "select * from peca where oid_peca = ". $id .";";
			$exec = mysql_query($query);
			$rs = mysql_fetch_array($exec);

			// Preenchendo os campos
			$txtNome 		= $rs['nome'];
			$dtAno 			= $rs['ano'];
			$dtValidade 	= $rs['validade'];
			$txtCodBarras 	= $rs['codbarra'];
			$txtPreco 		= $rs['preco'];
			$txtPeso 		= $rs['peso'];
			$slTipoPeca 	= $rs['oid_tipopeca'];
			$txtDescricao 	= $rs['descricao'];

			$btn = "Editar";
			$idEditar = "?id=". $id;
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>SGE</title>
		<meta charset="utf-8">

		<link rel="stylesheet" type="text/css" href="style/style-padrao.css">
		<link rel="stylesheet" type="text/css" href="style/style-conteudo.css">

		<script type="text/javascript" src="js/dropdown.js"></script>
		<link rel="icon" href="img/favicon.png" type="image/gif">
	</head>
	<body>
		<div id="corpo">
			<?php include("header.php"); ?> <!-- Cabeçalho -->
			<?php include("menu.php"); ?> <!-- Menu -->
			
			<div id="conteudo">
				<h3>Cadastro de Produtos</h3>
				<hr class="linha">

				<div class="div-cadastro-produto">
					<form action="crud/produto.php" method="post" name="formulario-produto">
						<label>Nome</label>
						<input type="text" name="txtNome" value="<?php echo($txtNome); ?>" placeholder="Nome do produto" />
						
						<label>Ano</label>
						<input type="date" name="dtAno" value="<?php echo($dtAno); ?>" placeholder="Ano do produto" />

						<label>validade</label>
						<input type="date" value="<?php echo($dtValidade); ?>" name="dtValidade" />

						<label>código de barras</label>
						<input type="text" name="txtCodBarras" value="<?php echo($txtCodBarras); ?>" placeholder="Preço do produto" />

						<label>preço</label>
						<input type="text" name="txtPreco" value="<?php echo($txtPreco); ?>" placeholder="Preço do produto" />

						<label>peso</label>
						<input type="text" name="txtPeso" value="<?php echo($txtPeso); ?>" placeholder="Peso do produto" />

						<label>Marca</label>
						<select name="slMarca">
							<option>Marca A</option>
							<option>Marca B</option>
							<option>Marca C</option>
						</select>

						<div>
							<label>Categoria</label>
							<select name="slTipoPeca">
								<?php
									$exec = mysql_query("select * from tipoPeca;");
									while($rs = mysql_fetch_array($exec)){
								?>
								<option value="<?php echo($rs['oid_tipopeca']); ?>"><?php echo($rs['nome']); ?></option>
								<?php } ?>
							</select>
						</div>

						<label>Descrição</label>
						<textarea name="txtDescricao"><?php echo($txtDescricao); ?></textarea>

						<!-- Carregando a Lista de Estoques Cadastrados -->
						<div id="estoque">
							<?php
								$exec = mysql_query("select * from estoque;");
								while($rs = mysql_fetch_array($exec)){
							?>
							<div class="optEstoque">
								<label><?php echo($rs['nomeexibicao']); ?></label>
								<input type="checkbox" class="chBox" name="estoqueNome<?php echo($rs['oid_estoque']); ?>" value="<?php echo($rs['oid_estoque']); ?>" />
								<input type="text" name="estoqueQtdMinima<?php echo($rs['oid_estoque']); ?>" placeholder="Quatidade Mínima" />
								<input type="text" name="estoqueQtdAtual<?php echo($rs['oid_estoque']); ?>" placeholder="Quatidade Atual" />
							</div>
							<?php } ?>
						</div>

						<input type="submit" name="btnSalvar" class="btn" value="<?php echo($btn); ?>">
					</form>
					<table>
						<tr>
							<th>Produto</th>
							<th>Preço</th>
							<th>Excluir</th>
							<th>Editar</th>
						</tr>
						<?php
							$exec = mysql_query("select * from peca;");
							while($rs = mysql_fetch_array($exec)){
						?>
						<tr>
							<td><?php echo($rs['nome']); ?></td>
							<td><?php echo($rs['preco']); ?></td>
							<td>
								<a href="crud/produto.php?id=<?php echo($rs['oid_peca']); ?>">
									<img src="img/icon-del.png" alt=" excluir registro" title="excluir registro ">
								</a>
							</td>
							<td>
								<a href="produto.php?modo=consultar&id=<?php echo($rs['oid_peca']); ?>">
									<img src="img/icon-edit.png" alt=" excluir registro" title="editar registro ">
								</a>
							</td>
						</tr>
						<?php } ?>
					</table>
				</div>
			</div>
			<footer>
				<h1>Desenvolvido por Code Solution 2016</h1>
				<h2>Sistema de Gerenciamento Empresarial - OnPeças</h2>
			</footer>
		</div>
	</body>
</html>