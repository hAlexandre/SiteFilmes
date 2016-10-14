<?php 
include_once('conexao_bd.php');
include_once('header.php'); ?>
<!DOCTYPE html>
 <html>
 <head>
 	<title>Consulta por estrelas</title>
 	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
 </head>
 <body>
	 <div class="col-md-4 col-md-offset-4">
	 	<a class="btn btn-info" href= "consultaEstrelas.php?nEst=5">5 Estrelas</a> 
	 	<a class="btn btn-info" href= "consultaEstrelas.php?nEst=4">4 Estrelas</a> 
	 	<a class="btn btn-info" href= "consultaEstrelas.php?nEst=3">3 Estrelas</a> 
	 	<a class="btn btn-info" href= "consultaEstrelas.php?nEst=2">2 Estrelas</a> 
	 	<a class="btn btn-info" href= "consultaEstrelas.php?nEst=1">1 Estrela </a> 	 	
	 </div> 	 
 </body>
 </html>

<?php

if(isset($_GET['nEst']))
{
	$nEst = $_GET['nEst'];
	$sql = "SELECT * FROM filme";
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
		$sql2  = "SELECT COUNT(*) From avaliacao WHERE CodigoFilme = '$codigo'";
		$result2 = mysql_query($sql2);
    	$aux2 = mysql_fetch_array($result2);
    	$qtdAvaliacoes = $aux2[0];    							    	
    	
    	if($qtdAvaliacoes > 2)
    	{
    		$estrelas = 0;
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
    			$estrelas = 1;
    		} else 
    			if ($total <= 2.49)
    			{
    				$estrelas = 2;
    			} else
    				if ($total <=3.49)
    				{
    					$estrelas = 3;
    				} else
    					if ($total <= 4.49)
    					{
    						$estrelas = 4;
    					}
    					else
    					{
    						$estrelas = 5;
    					}

    	    if($estrelas == $nEst)
    	    {

    	    	?>
    	    	<div class="col-md-4 col-md-offset-4" style="margin-bottom: 10px">
    	    		<br>
    	    		<a href= <?php echo $link; ?> > <img src=<?php echo $imagem ?> width="140" height="200" align="left"> </a>
							<b> Título :</b> <?php echo $titulo ?> <br>
							<b> Gênero :</b> <?php echo $genero ?> <br>
							<b> Diretor :</b> <?php echo $diretor ?><br>
							<b> Duracao </b>: <?php echo $duracao ?> min<br>
							<b> Ano </b>: <?php echo $ano ?><br>
							<b>	<?php echo($nEst.'Estrelas')?> </b>
				</div>		

    	    	<?php
    				

    		}
	    }

    	


	}	
}

 ?>

 