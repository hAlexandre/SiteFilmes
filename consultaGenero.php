<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<title>Consulta de filmes por Gênero</title>
</head>
<body>
<div class="row">
	<?php include_once('header.php') ?>
	<div class="col-md-6 col-md-offset-3" align="center" style="margin-bottom: 10px">		
		<?php 
		error_reporting(E_ALL ^ E_DEPRECATED);
		include_once('conexao_bd.php');
		$sql = "SELECT DISTINCT Genero FROM filme ORDER BY Titulo";
		$result = mysql_query($sql);	
		$cont = 0;		
		while ($aux = mysql_fetch_array($result)) 
		{
			$cont++;
			$genero = $aux[0];
			$link = '"consultaGenero.php?genero='.$genero.'"';
			
			?>
				<a class="btn btn-info" href= <?php echo $link ?> > <?php echo($genero) ?> </a> 		
			<?php 

		}	

		?>
	</div>

	<div class="col-md-12 col-offset-0">
		<?php 
			if(isset($_GET['genero']))
			{		
				$genero = $_GET['genero'];		
				?>
					<h3 class="col-md-4 col-md-offset-4"> <?php echo $genero ?> </h3>
				<?php 
				$genero = $_GET['genero'];
				$sql = "SELECT * FROM filme WHERE Genero = '$genero' ORDER BY Titulo";
				$result = mysql_query($sql);
				while ($aux = mysql_fetch_array($result))
				{					
					$codigo = $aux[0];
					$titulo = $aux[1];
					$genero = $aux[2];
					$diretor = $aux[3];
					$duracao = $aux[4];
					$ano = $aux[5];
					$imagem = '"img/'.$aux[6].'.jpg"';		
					$link = '"dadosFilme.php?cod='.$codigo.'"';
					?>
					<div class="col-md-4 col-md-offset-4" style="margin-bottom: 10px">
				<div>
					<p> 
						<a href= <?php echo $link; ?> > <img src=<?php echo $imagem ?> width="140" height="200" align="left"> </a>																			
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
						<br><br>
					</div>
					<?php 
				}
			}
			else
			{
				$sql = "SELECT * FROM filme ORDER BY Titulo";
				$result = mysql_query($sql);
				while ($aux = mysql_fetch_array($result))
				{					
					$codigo = $aux[0];
					$titulo = $aux[1];
					$genero = $aux[2];
					$diretor = $aux[3];
					$duracao = $aux[4];
					$ano = $aux[5];
					$imagem = '"img/'.$aux[6].'.jpg"';					
					$link = '"dadosFilme.php?cod='.$codigo.'"';
					
					?>					
					<div class="col-md-4 col-md-offset-4" style="margin-bottom: 10px">
				<div>
					<p> 
						<a href= <?php echo $link; ?> > <img src=<?php echo $imagem ?> width="140" height="200" align="left"> </a>																												
							
							<b> Título:</b> <?php echo $titulo ?> <br>
							<b> Gênero:</b> <?php echo $genero ?> <br>
							<b> Diretor:</b> <?php echo $diretor ?><br>
							<b> Duracao</b>: <?php echo $duracao ?> min<br>
							<b> Ano</b>: <?php echo $ano ?><br>
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
						<br><br>
					</div>
					<?php 
				}
			}


		 ?>

		 
	</div>
</div>	

</body>
</html>

