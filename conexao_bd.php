<?php 
	error_reporting(E_ALL ^ E_DEPRECATED);
	$db = mysql_connect("localhost", "root");
	mysql_select_db("imdb"); 		
?>