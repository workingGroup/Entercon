<?php
$servidor="localhost";
$user="root";
$password="";
$namedb="entercon";

  $mysqli=new mysqli($servidor , $user ,$password , $namedb);
	
	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();	
		$mysqli->close();
	}
	
?>