<div id="conteudo">
	<h3>Cadastro de Produtos</h3>
	<hr class="linha">
	<div class="div-cadastro-produto">
		<form action="index.html" method="post" name="formulario-produto">
			<label>Produto</label>
			<input type="text" name="txtcategoria" placeholder="Nome do produto" />
			<label>Preço</label>
			<input type="text" name="txtcategoria" placeholder="Preço do produto" />
			<div>
				<label>Categoria</label>
				<select >
					<option>1</option>
					<option>2</option>
					<option>3</option>
				</select>
			</div>
			<input type="submit" name="btnsalvar" class="btn" value="Salvar">
		</form>
		<table>
			<tr>
				<th>
					Estoque
				</th>
				<th>
					Quantidade
				</th>
				<th>
					Excluir
				</th>
			</tr>
			<tr>
				<td>Juquehy</td>
				<td>5</td>
				<td>
					<a href="index.html">
						<img src="view/img/icon-del.png" alt=" excluir registro" title="excluir registro ">
					</a>
				</td>
			</tr>
		</table>
	</div>
	<div class="div-cadastro-produto">
		<form action="index.html" method="post" name="formulario-produto">
			
			<div >
				<label>Estoque</label>
				<select >
					<option>1</option>
					<option>2</option>
					<option>3</option>
				</select>
			</div>
			<div >
				<label>Quantidade Minima</label>
				<input type="text" name="txtcategoria" placeholder="">
			</div>
			<input type="submit" name="btnsalvar" class="btn" value="Atribuir">
		</form>
	</div>
	<h3>Tabela de Registros - Estoques</h3>
	<hr class="linha">
		<table>
			<tr>
				<th>
					Produto
				</th>
				<th>
					Preço
				</th>
				<th>
					Categoria
				</th>
				<th>
					Estoque - Quantidade
				</th>
				<th>
					Editar
				</th>
				<th>
					Excluir
				</th>
			</tr>
			<tr>
				<td>Roda</td>
				<td>R$ 110,00</td>
				<td>Acessorio</td>
				<td>Juquehy - 3</td>
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
	</hr>
</div>