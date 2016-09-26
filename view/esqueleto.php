<?php ?>
<!DOCTYPE html>
<html>
<head>
	<title>SGE</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="view/style/style-padrao.css">
	<link rel="stylesheet" type="text/css" href="view/style/style-conteudo.css">
	<script type="text/javascript" src="js/dropdown.js"></script>
	<link rel="icon" href="view/img/favicon.png" type="image/gif">
</head>
<body>
	<div id="corpo">
		<header>
			<h4>Gerenciamento Empresarial</h4>
			<div id="div-info">
				<div onclick="MenuDrop()" class="dropbtn">
					Usuário
				</div>
					<div id="myDropdown" class="dropdown-content">
						<a href=".html">Ajuda</a>
						<a href=".html">Perfil</a>
						<hr>
					    <a href="sair.php">Sair</a>
					</div>
			</div>
		</header>
		<nav>
			<ul id="listamenu">
				<li><a href="index.php?q=categoria" class="li-menu">Categoria</a></li>
				<li><a href="comercial.html" class="li-menu">Comercial</a></li>
				<li><a href="index.php?q=estoque" class="li-menu">Estoque</a></li>
				<li><a href="index.php?q=produto" class="li-menu">Produtos</a></li>
			</ul>	
		</nav>
		<?php 
			if($_GET['q'] == 'categoria'){
				require_once("categoria/categoria.php");
			}elseif($_GET['q'] == 'estoque'){
				require_once("estoque/estoque.php");
			}elseif($_GET['q'] == 'produto'){
				require_once("produto/produto.php");
			}
			
		?>
		<footer>
			<h1>Desenvolvido por Code Solution 2016</h1>
			<h2>Sistema de Gerenciamento Empresarial - OnPeças</h2>
		</footer>
	</div>
</body>
</html>