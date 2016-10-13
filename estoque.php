<?php
	include("db/conexao.php");

	conectar();

	$txtNome 		= "";
	$slCidade 		= "";
	$slEstado 		= "";
	$txtLogradouro 	= "";
	$txtNumero 		= "";
	$txtCEP 		= "";
	$txtBairro 		= "";
	$txtComplemento = "";

	$btn = "Salvar";
	$idEditar = "";

	if(isset($_GET['modo']) && isset($_GET['id'])){
		$modo = $_GET['modo'];
		$id = $_GET['id'];

		if($modo == "consultar"){
			$query = "select  * from estoque where oid_estoque = ". $id .";";
			$exec = mysql_query($query);
			$rs = mysql_fetch_array($exec);

			// Preenchendo o campo do estoque
			$txtNome = $rs['nomeexibicao'];
			
			$query = "select  * from endereco where oid_endereco = ". $rs['oid_endereco'] .";";
			$exec = mysql_query($query);
			$rs = mysql_fetch_array($exec);

			// Preenchendo os campos do endereço
			$slCidade		= $rs['oid_cidade'];
			$txtLogradouro 	= $rs['logradouro'];
			$txtNumero 		= $rs['numero'];
			$txtCEP 		= $rs['cep'];
			$txtBairro 		= $rs['bairro'];
			$txtComplemento = $rs['complemento'];

			$btn = "Editar";
			$idEditar = "?id=". $id;
		}
	}

	// Bucando os estados
	$listaEstado = "";
	$listaCidade = "";
	
	// Preenchendo o conteúdo da lista de estados
	switch ($btn) {
		case 'Salvar':
			$exec = mysql_query("select * from estado;");
			while($rs = mysql_fetch_array($exec)) $listaEstado .= "<option value='". $rs['oid_estado'] ."'>". $rs['nome'] ."</option>";
			break;

		case 'Editar':
			$exec = mysql_query("select * from cidade where oid_cidade = ". $slCidade .";");
			$idEstado = mysql_fetch_array($exec)['oid_estado'];

			$exec = mysql_query("select * from estado;");

			// Carregando a lista de estados
			while($rs = mysql_fetch_array($exec)){
				if($rs['oid_estado'] == $idEstado) $listaEstado .= "<option value='". $rs['oid_estado'] ."' selected>". $rs['nome'] ."</option>";
				else $listaEstado .= "<option value='". $rs['oid_estado'] ."'>". $rs['nome'] ."</option>";
			}

			$exec = mysql_query("select * from cidade;");
			// Carregando a lista de cidades
			while($rs = mysql_fetch_array($exec)){
				if($rs['oid_cidade'] == $slCidade) $listaCidade .= "<option value='". $rs['oid_cidade'] ."' selected>". $rs['nome'] ."</option>";
				else $listaCidade .= "<option value='". $rs['oid_cidade'] ."'>". $rs['nome'] ."</option>";
			}
			break;
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>SGE</title>
		<meta charset="utf-8">

		<link rel="stylesheet" type="text/css" href="style/style-padrao.css">
		<link rel="stylesheet" type="text/css" href="style/style-conteudo.css">
		<link rel="icon" href="img/favicon.png" type="image/gif">

		<script type="text/javascript" src="js/dropdown.js"></script>
		<script type="text/javascript" src="js/jquery3.1.js"></script>
		<script type="text/javascript" src="js/estoque.js"></script>
	</head>
	<body>
		<div id="corpo">
			<?php include("header.php"); ?> <!-- Cabeçalho -->
			<?php include("menu.php"); ?> <!-- Menu -->

			<div id="conteudo">
				<h3>Cadastro de Estoques</h3>
				<hr class="linha">
				<div class="div-cadastro">
					<form action="crud/estoque.php<?php echo($idEditar); ?>" method="post" name="formulario-categoria">
						<label>Estoque</label>
						<input type="text" name="txtNome" value="<?php echo($txtNome); ?>" placeholder="Nome do estoque">

						<label>Estado</label>
						<select name="slEstado" id="slEstado">
							<option hidden selected>Selecione o estado</option>
							<?php echo($listaEstado); ?>
						</select>

						<label>Cidade</label>
						<select name="slCidade" value="<?php echo($slCidade); ?>" id="slCidade">
							<option hidden selected>Selecione a cidade</option>
							<?php echo($listaCidade); ?>
						</select>

						<label>Logradouro</label>
						<input type="text" name="txtLogradouro" value="<?php echo($txtLogradouro); ?>" placeholder="Rua, avenida, rodovia ou estrada">

						<label>Número</label>
						<input type="text" name="txtNumero" value="<?php echo($txtNumero); ?>" placeholder="Número">

						<label>CEP</label>
						<input type="text" name="txtCEP" value="<?php echo($txtCEP); ?>" placeholder="CEP">

						<label>Bairro</label>
						<input type="text" name="txtBairro" value="<?php echo($txtBairro); ?>" placeholder="Bairro">

						<label>Complemento</label>
						<textarea name="txtComplemento" placeholder="Complemento"><?php echo($txtComplemento); ?></textarea>
						
						<input type="submit" name="btnSalvar" class="btn" value="<?php echo($btn); ?>">
					</form>
				</div>
				<h3>Tabela de Registros - Estoques</h3>
				<hr class="linha">
				<table>
					<tr>
						<th>Estoque</th>
						<th>Cidade</th>
						<th>Editar</th>
						<th>Excluir</th>
					</tr>
					<?php
						$query = "select * from vw_estoque order by oid_estoque desc;";
						$exec = mysql_query($query);

						while($rs = mysql_fetch_array($exec)){
					?>
					<tr>
						<td><?php echo($rs['nomeexibicao']) ?></td>
						<td><?php echo($rs['cidade']) ?></td>
						<td>
							<a href="estoque.php?modo=consultar&id=<?php echo($rs['oid_estoque']); ?>">
								<img src="img/icon-edit.png" alt="editar registro" title=" editar registro">
							</a>
						</td>
						<td>
							<a href="crud/estoque.php?id=<?php echo($rs['oid_estoque']); ?>"><img src="img/icon-del.png" alt=" excluir registro" title="excluir registro "></a>
						</td>
					</tr>
					<?php } ?>
				</table>
			</div>
			<footer>
				<h1>Desenvolvido por Code Solution 2016</h1>
				<h2>Sistema de Gerenciamento Empresarial - OnPeças</h2>
			</footer>
		</div>
	</body>
</html>