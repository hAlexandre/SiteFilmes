<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<title>Consultar filme</title>
	<script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript" src="js/jquery-2.2.4.min.js"></script>
</head>
<body>
	<?php include_once('header.php'); ?>		
	<div class="col-md-4 col-md-offset-4">
		<label>Título</label>	
    	<input onkeyup="pesquisa(this.value)"class="form-control" type="text" name="ano" placeholder="Título" required value=<?php if(isset($_POST['ano'])) echo $_POST['ano'] ?>><br>			
	</div>

	<?php 
		error_reporting(E_ALL ^ E_DEPRECATED);
		include_once('conexao_bd.php');
		$sql = "SELECT * FROM filme ORDER BY Titulo";
		$result = mysql_query($sql);
		?>
		<div class="filmes">
		<?php 
		while($aux = mysql_fetch_object($result))
		{
			$codigo = $aux->Codigo;
			$titulo = $aux->Titulo;			
			$genero = $aux->Genero;
			$diretor = $aux->Diretor;
			$duracao = $aux->Duracao;
			$ano = $aux->Ano;			
			//$imagem = '"http://www.baldochi.unifei.edu.br/COM222/trab03/'.$aux->Imagem.'.jpg"';			
			$imagem = '"img/'.$aux->Imagem.'.jpg"';
			?>
			
			<div class="col-md-4 col-md-offset-4" style="margin-bottom: 10px">
				<div>
					<p> 
						<img src=<?php echo $imagem ?> width="140" height="200" align="left">																												
							<br>
							<b> Título :</b> <?php echo $titulo ?> <br>
							<b> Gênero :</b> <?php echo $genero ?> <br>
							<b> Diretor :</b> <?php echo $diretor ?><br>
							<b> Duracao </b>: <?php echo $duracao ?> min<br>
							<b> Ano </b>: <?php echo $ano ?><br>
							<b>												
						    <?php  

						    	//Verificar se possui três ou mais avaliações
						    	$sql2  = "SELECT COUNT(*) From avaliacao WHERE CodigoFilme = '$codigo'";
						    	$result2 = mysql_query($sql2);
						    	$aux2 = mysql_fetch_array($result2);
						    	$qtdAvaliacoes = $aux2[0];
						    	if($qtdAvaliacoes < 3)
						    	{						    		
						    		echo "Avaliações insuficientes";
						    	}
						    							    	
						    	
						    	if($aux2[0] > 2)
						    	{
						    		//Média das avaliações
						    		$sql3 = "SELECT * FROM avaliacao WHERE CodigoFilme = '$codigo'";
						    		$result3 = mysql_query($sql3);						    		
						    		$total = 0;
						    		while ($aux3 = mysql_fetch_array($result3))
						    		{
						    			$total = $total + $aux3[1];
						    		}
						    		$total = $total / $qtdAvaliacoes;
						    		if ($total <= 1.49)
						    		{
						    			echo "1 Estrela";
						    		} else 
						    			if ($total <= 2.49)
						    			{
						    				echo "2 Estrelas";
						    			} else
						    				if ($total <=3.49)
						    				{
						    					echo "3 Estrelas";
						    				} else
						    					if ($total <= 4.49)
						    					{
						    						echo "4 Estrelas";
						    					}
						    					else
						    					{
						    						echo "5 Estrelas";
						    					}


						    	}

						    ?>
						    </b>
					</p>
				</div>						
						<br><br><br>
					</div>

			<?php 

			}		
	 	?>
	 	</div>

</body>
</html>
