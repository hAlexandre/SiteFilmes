<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body>
	<?php
	include_once('conexao_bd.php');
	if(isset($_POST['submit']))
	{
		$codigo = $_GET['cod'];
		$estrelas = $_POST['estrelas'];
		$comentario = $_POST['comentario'];
		$sql = "INSERT INTO avaliacao values ('$codigo', '$estrelas', '$comentario')";
		echo $sql;
		mysql_query($sql);
		header("Location: dadosFilme.php?cod=".$codigo."?inseriu=ok");

		

	?>	
	<?php
	if(isset($_GET['inseriu']))
	{
		echo "AFJISODJFDASOIJA";
		?>
		<div align="center"> <span style="color:blue"><?php echo "Avaliação realizada com sucesso" ?></span> </div>
		<?php
	}
	}

	include_once('header.php');
	
	if(isset($_GET['cod']))
	{
		$codigo = $_GET['cod'];
		$sql = "SELECT * FROM filme WHERE Codigo = '$codigo'";
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
							
					$codigo = $aux[0];
					$titulo = $aux[1];
					$genero = $aux[2];
					$diretor = $aux[3];
					$duracao = $aux[4];
					$ano = $aux[5];
					$imagem = '"img/'.$aux[6].'.jpg"';		
					
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
						<br><br>
					</div>
					<?php 

		?>

		<div class = "col-md-4 col-md-offset-4">
			<div>
			 	<h1> Comentários:</h1>
			 	<div>
			 	<?php
			 		$sql  = "SELECT * From avaliacao WHERE CodigoFilme = '$codigo'";
			    	$result = mysql_query($sql);
			    	
			    	while ($aux = mysql_fetch_array($result))
					{											
						?>
						<div  style="margin-bottom: 15px; padding: 4px; border: solid 1px #ddd">
							<h4> Número de estrelas: <?php echo($aux[1]) ?> </h4>
							<h4> Comentário: <?php echo ($aux[2])?> </h4>
						</div>
						<?php
					}
			    	

			 	?>
			 	</div>
			</div>
		</div>


		<?php
	}

}
	?>
		<div class="col-md-4 col-md-offset-4">
		<h4>Avalie você também:</h4>			
			<form  method="POST" align="center">
				<div class="form-group col-md-4 col-md-offset-0">
					<label>Número de estrelas</label>	
					<input  class="form-control" type="number" min="1" max="5" name="estrelas"  required><br>
				</div>
				<div class="col-md-12 col-md-offset-0">
					<label>Comentário</label>	
				    <input class="form-control" type="text" name="comentario" placeholder="Comentário" required value=''> <br>
				    <button type="submit" name = "submit" class="btn btn-primary">Confirmar avaliação</button>					    
				</div>
				
	    	</form>
		</div>
</body>
</html>