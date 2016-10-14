
function pesquisa(titulo)
{	
	$.ajax({
		url: 'consultaNome_ajax.php',
		type: 'GET',
		dataType: 'json',
		data: {titulo: titulo},
	})
	.done(function(filmes) {
		$('.filmes').html(layout(filmes));
		console.log(filmes[0]);
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
	
}

function layout(filmes)
{
	aux = "";
	for( i = 0 ; i < filmes.length; i++)
	{
		aux = aux+ '<div class="col-md-4 col-md-offset-4">'+
				'<div>'+
					'<p>'+
						'<img src="http://www.baldochi.unifei.edu.br/COM222/trab03/'+filmes[i]['Imagem']+'.jpg"  width="140" height="200" align="left">'+						
							'<br>'+
							'<b> Título: </b>'+filmes[i]['Titulo']+'<br>'+
							'<b> Gênero: </b>'+filmes[i]['Genero']+'<br>'+
							'<b> Diretor: </b>'+filmes[i]['Diretor']+'<br>'+
							'<b> Duracao: </b>'+filmes[i]['Duracao']+' min<br>'+
							'<b> Ano</b>: '+filmes[i]['Ano']+''+
					'</p>'+
				'</div>'+				
						'<br><br>'+
					'</div>'					
	}
	return aux;

}