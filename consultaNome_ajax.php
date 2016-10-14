<?php 
	include_once('conexao_bd.php');
	error_reporting(E_ALL ^ E_DEPRECATED);
	if(isset($_GET['titulo']))
	{
		$titulo = $_GET['titulo'];
		$sql = "SELECT * FROM filme WHERE Titulo LIKE '%$titulo%' ORDER BY Titulo";
		$result = mysql_query($sql);	
		$res = array();
		while($aux = mysql_fetch_object($result))
		{
			array_push($res, $aux);
		}
		echo json_encode($res);

	}	

	


 ?>