<?php
function consulta($query, $array = null){
	$servidor="localhost";
        $user="root";
        $password="";
        $namedb="entercon";
	$con = new mysqli($servidor , $user ,$password , $namedb);
	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
		return false;
	}
	$query = $con->query($query);
	if($array == null){
		$con->close();
		return $query;
	}else{
		$array = Array();
		while($dato = $query->fetch_array(MYSQLI_BOTH)){
			$array[] = $dato;
		}
		$con->close();
		return $dato;
	}
}
?>