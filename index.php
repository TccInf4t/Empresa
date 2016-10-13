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
				<h3>Cadastro de Categorias</h3>
				<hr class="linha">
				<div class="div-cadastro">
					<form action="index.html" method="post" name="formulario-categoria">
						<label>Categoria:</label>
						<input type="text" name="txtcategoria" placeholder="Produtos importados">
						<input type="submit" name="btnsalvar" class="btn" value="Salvar">
					</form>
				</div>
				<h3>Tabela de Registros - Categorias</h3>
				<hr class="linha">
				<table>
					<tr>
						<th>
							Categoria
						</th>
						<th>
							Editar
						</th>
						<th>
							Excluir
						</th>
					</tr>
					<tr>
						<td>Produtos importados</td>
						<td>
							<a href="index.html">	
								<img src="img/icon-edit.png" alt="editar registro" title=" editar registro">
							</a>
						</td>
						<td>
							<a href="index.html">
								<img src="img/icon-del.png" alt=" excluir registro" title="excluir registro ">
							</a>
						</td>
					</tr>
				</table>
			</div>
			<footer>
				<h1>Desenvolvido por Code Solution 2016</h1>
				<h2>Sistema de Gerenciamento Empresarial - OnPeças</h2>
			</footer>
		</div>
	</body>
</html>