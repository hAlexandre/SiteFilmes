<!DOCTYPE html>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<title>Cadastro de filmes</title>
	
</head>
<body>

	<?php 
	include_once('header.php');
		if(isset($_GET['inseriu']))
		{
			if($_GET['inseriu'] == 'ok')
			{
		?> 
			<div align="center"> <span style="color:blue"><?php echo "Filme cadastrado com sucesso	" ?></span> </div>
			
		<?php
			}
		
			if($_GET['inseriu'] == 'cod')
			{
				?>
			<div align="center"> <span style="color:red"><?php echo "Código já cadastrado" ?></span> </div>	

		<?php 
			}
		}
	 ?>
	<form  method="POST" align="center">
	  		<div class="row">
			    <legend>Cadastrar filme</legend>
			    <div class="form-group col-md-4 col-md-offset-4" style="margin-bottom: 0px">
				    <label>Código</label>		    
				    <input class="form-control" type="text" name="codigo" placeholder="Código" required value=<?php if(isset($_POST['codigo'])) echo $_POST['codigo'] ?>> <br>
			    </div>

				<div class="form-group col-md-4 col-md-offset-4" style="margin-bottom: 0px; margin-top: 0px">
					<label>Título</label>		    
			    	<input class="form-control"type="text" name="titulo" placeholder="Título" required value=<?php if(isset($_POST['titulo'])) echo $_POST['titulo'] ?>><br>	
			    </div>

			    <div class="form-group col-md-4 col-md-offset-4" style="margin-bottom: 0px; margin-top: 0px">
					<label>Gênero</label>		    
			   		<input  class="form-control" type="text" name="genero" placeholder="Gênero" required value=<?php if(isset($_POST['genero'])) echo $_POST['genero'] ?>><br>
			    </div>

			    <div class="form-group col-md-4 col-md-offset-4" style="margin-bottom: 0px; margin-top: 0px">
			    	<label>Diretor</label>		    
				    <input  class="form-control" type="text" name="diretor" placeholder="Diretor" required value=<?php if(isset($_POST['diretor'])) echo $_POST['diretor'] ?>><br>
				
			    </div>

			    <div class="form-group col-md-4 col-md-offset-4" style="margin-bottom: 0px; margin-top: 0px">
					<label>Duração</label>		    
			    	<input class="form-control" type="number" name="duracao" placeholder="Duração" required value=<?php if(isset($_POST['duracao'])) echo $_POST['duracao'] ?>><br>		    
			    </div>

			    
				<div class="form-group col-md-4 col-md-offset-4" style="margin-bottom: 0px; margin-top: 0px">
					<label>Ano</label>		    
				    <input class="form-control" type="number" name="ano" placeholder="Ano" required value=<?php if(isset($_POST['ano'])) echo $_POST['ano'] ?>><br>			
			    </div>			    			    	    		  
			</div>    
			<div class=" col-md-4 col-md-offset-4">
				<button type="submit" name = "submit" class="btn btn-primary">Cadastar</button>
			</div>
		    
	    
	</form>
</body>
</html>


<?php 

	error_reporting(E_ALL ^ E_DEPRECATED);
	include_once("/conexao_bd.php");

	if(isset($_POST['submit']))
	{
		$codigo = $_POST['codigo'];
		$titulo = $_POST['titulo'];
		$genero = $_POST['genero'];
		$diretor = $_POST['diretor'];
		$duracao = $_POST['duracao'];
		$ano = $_POST['ano'];
		$imagem = 'poster0';

		// Verificação código
		$sql = "SELECT * FROM filme WHERE codigo = '$codigo'";
		$result = mysql_query($sql);		
		$aux = mysql_fetch_array($result);		
		// Insere caso não exista o código
		if(count($aux) == 1 )
		{			
			
			$sql = "INSERT INTO filme VALUES 
				( '$codigo', '$titulo', '$genero', '$diretor', '$duracao', '$ano', '$imagem' ) ";		
			mysql_query($sql);			
			echo($sql);
			header("Location: cadastro.php?inseriu=ok");
		}
		else
		{
			header("Location: cadastro.php?inseriu=cod");
		}


	}
 ?>	

