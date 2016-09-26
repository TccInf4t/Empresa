<div id="conteudo">
	<link rel="stylesheet" type="text/css" href="view/style/style-conteudo.css">
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
						<img src="view/img/icon-edit.png" alt="editar registro" title=" editar registro">
					</a>
				</td>
				<td>
					<a href="index.html">
						<img src="view/img/icon-del.png" alt=" excluir registro" title="excluir registro ">
					</a>
				</td>
			</tr>
		</table>
</div>