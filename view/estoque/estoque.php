<div id="conteudo">
	<h3>Cadastro de Estoques</h3>
	<hr class="linha">
	<div class="div-cadastro">
		<form action="index.html" method="post" name="formulario-categoria">
			<label>Estoque</label>
			<input type="text" name="txtcategoria" placeholder="Produtos importados">
			<label>Local</label>
			<select >
				<option>1</option>
				<option>2</option>
				<option>3</option>
			</select>
			<input type="submit" name="btnsalvar" class="btn" value="Salvar">
		</form>
	</div>
	<h3>Tabela de Registros - Estoques</h3>
	<hr class="linha">
		<table>
			<tr><th>
					Estoque
				</th>
				<th>
					Local
				</th>
				<th>
					Editar
				</th>
				<th>
					Excluir
				</th>
			</tr>
			<tr>
				<td>Locação</td>
				<td>Juquehy</td>
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