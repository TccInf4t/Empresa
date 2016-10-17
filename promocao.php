
<?php
	require_once("db/conexao.php");

	conectar();

	$txtNome = "";
	$dtInicio = "";
	$dtTermino = "";
	$numPerc = "";

	$btn = "Salvar";
	$idEditar = "";

	if(isset($_GET['modo']) && isset($_GET['id'])){
		$modo = $_GET['modo'];
		$id = $_GET['id'];

		if($modo == "consultar"){
			$query = "select  * from promocao where oid_promocao = ". $id .";";
			$exec = mysql_query($query);
			$rs = mysql_fetch_array($exec);

			// Preenchendo o Conteúdo
			$txtNome = $rs['nome'];
			$dtInicio = $rs['dt_inicio'];
			$dtTermino = $rs['dt_termino'];
			$numPerc = $rs['perc'];
			
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
				<link rel="stylesheet" type="text/css" href="style/style-conteudo.css">
				<h3>Cadastro de Categorias</h3>
				<hr class="linha">

				<div class="div-cadastro">
					<form name="form" method="post" action="crud/promocao.php<?php echo($idEditar); ?>">
						<label>Nome</label>
						<input type="text" name="txtNome" value="<?php echo($txtNome); ?>" placeholder="Promoção">

						<label>Data de Inicio</label>
						<input type="date" name="dtInicio" value="<?php echo($dtInicio); ?>" placeholder="Data de Inicio">

						<label>Data de Termino</label>
						<input type="date" name="dtTermino" value="<?php echo($dtTermino); ?>" placeholder="Data de Termino">

						<label>Percentual</label>
						<input type="number" name="numPerc" value="<?php echo($numPerc); ?>" placeholder="Percentual">

						<input type="submit" name="btnSalvar" class="btn" value="<?php echo($btn); ?>">
					</form>
				</div>
				<h3>Tabela de Registros - Categorias</h3>
				<hr class="linha">
				<!-- 
					nome 
					data inicio - dt_inicio
					date termino- dt_termino
					perc
				 -->
				<table>
					<tr>
						<th>Nome</th>
						<th>Editar</th>
						<th>Excluir</th>
					</tr>
					<?php
						$query = "select * from promocao;";
						$exec = mysql_query($query);

						while($rs = mysql_fetch_array($exec)){
					?>
					<tr>
						<td><?php echo($rs['nome']); ?></td>
						<td>
							<a href="promocao.php?modo=consultar&id=<?php echo($rs['oid_promocao']); ?>">
								<img src="img/icon-edit.png" alt="editar registro" title=" editar registro">
							</a>
						</td>
						<td>
							<a href="crud/promocao.php?&id=<?php echo($rs['oid_promocao']); ?>">
								<img src="img/icon-del.png" alt=" excluir registro" title="excluir registro ">
							</a>
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

<?php desconectar(); ?> <!-- Encerrando a Conexão -->