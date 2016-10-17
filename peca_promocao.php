
<?php
	require_once("db/conexao.php");

	conectar();

	$slProduto = "";
	$slPromocao = "";
	$numPerc = "";

	$btn = "Salvar";
	$idEditar = "";

	if(isset($_GET['modo']) && isset($_GET['id'])){
		$modo = $_GET['modo'];
		$id = $_GET['id'];

		if($modo == "consultar"){
			$query = "select  * from peca_promocao where oid_peca_promocao = ". $id .";";
			$exec = mysql_query($query);
			$rs = mysql_fetch_array($exec);

			// Preenchendo o Conteúdo
			$slProduto = $rs['oid_peca'];
			$slPromocao = $rs['oid_promocao'];
			$numPerc = $rs['perc_unico'];
			
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
					<form name="form" method="post" action="crud/peca_promocao.php<?php echo($idEditar); ?>">
						<label>Produto</label>
						<select name="slProduto">
							<?php
								$exec = mysql_query("select * from peca;");
								while($rs = mysql_fetch_array($exec)){
									$selected = "";
									if($rs['oid_peca'] == $slProduto) $selected = "selected";
							?>
							<option value="<?php echo($rs['oid_peca']); ?>" <?php echo($selected); ?>><?php echo($rs['nome']); ?></option>
							<?php } ?>
						</select>

						<label>Promoção</label>
						<select name="slPromocao">
							<?php
								$exec = mysql_query("select * from promocao;");
								while($rs = mysql_fetch_array($exec)){
									$selected = "";
									if($rs['oid_promocao'] == $slPromocao) $selected = "selected";
							?>
							<option value="<?php echo($rs['oid_promocao']); ?>" <?php echo($selected); ?>><?php echo($rs['nome']); ?></option>
							<?php } ?>
						</select>

						<label>Percentual</label>
						<input type="number" name="numPerc" value="<?php echo($numPerc); ?>" placeholder="Percentual">

						<input type="submit" name="btnSalvar" class="btn" value="<?php echo($btn); ?>">
					</form>
				</div>
				<h3>Tabela de Registros - Categorias</h3>
				<hr class="linha">
				<table>
					<tr>
						<th>Promoção</th>
						<th>Produto</th>
						<th>Editar</th>
						<th>Excluir</th>
					</tr>
					<?php
						$query = "select * from vw_peca_promocao order by oid_peca_promocao desc;";
						$exec = mysql_query($query);

						while($rs = mysql_fetch_array($exec)){
					?>
					<tr>
						<td><?php echo($rs['promocao']); ?></td>
						<td><?php echo($rs['nome']); ?></td>
						<td>
							<a href="peca_promocao.php?modo=consultar&id=<?php echo($rs['oid_peca_promocao']); ?>">
								<img src="img/icon-edit.png" alt="editar registro" title=" editar registro">
							</a>
						</td>
						<td>
							<a href="crud/peca_promocao.php?&id=<?php echo($rs['oid_peca_promocao']); ?>">
								<img src="img/icon-del.png" alt="excluir registro" title="excluir registro ">
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