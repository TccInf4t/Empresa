$(function(){
	// carregar_cidades($("#slEstado").val());
	// console.log($("#slEstado").val());

	$("#slEstado").change(function(){
		carregar_cidades($(this).val());
	});
});

function carregar_cidades(id_estado){
	// Montando a lista de cidades
	$.get("crud/lista_cidade.php", {id_estado: id_estado}, function(dados){
		$("#slCidade").html(dados);
	});
}