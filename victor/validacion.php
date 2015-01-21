<?php
session_start();
require_once ('coneccion.php');

$user = mysqli_real_escape_string($mysqli, $_POST['Lusuario']);
$pass = mysqli_real_escape_string($mysqli, (sha1($_POST['Lcontraseña']))); 
 $consulta = mysqli_query($mysqli, "SELECT Id_MaesPais , Id_MaesEmpr,id_MaesUsua,NivelPermiso_MaesUsua , Usuario_MaesUsua, Password_MaesUsua, MaxDscto_MaesUsua FROM ent_maesusua WHERE Usuario_MaesUsua = '$user' AND Password_MaesUsua = '$pass'");
 
  if (mysqli_num_rows($consulta) > 0)
    {
	
	$row=$consulta->fetch_assoc();
	 
		$_SESSION["Pais"]= $row['Id_MaesPais'];
		$_SESSION["Empresa"] = $row['Id_MaesEmpr'];
		$_SESSION["Id"]=$row['id_MaesUsua'];
		$_SESSION["Permiso"]=$row['NivelPermiso_MaesUsua'];
        $_SESSION["Usuario"] = $user;
		$_SESSION["Descuento"] =$row['MaxDscto_MaesUsua'];
		$_SESSION['Logged'] ='yes';
		
		$Pais =$row['Id_MaesPais'];
		$Empresa=$row['Id_MaesEmpr']; 
		$IDuser=$row['id_MaesUsua'];
		$roles = mysqli_query($mysqli,"Select * from ent_rolexusuario where Ent_Role_IdPais_Role ='$Pais' AND Ent_Role_IdEmpr_Role='$Empresa' AND IdUsuario_UsuarioXRole ='$IDuser'");
		$rowRolexUsuario=$roles->fetch_assoc();
	
			$_SESSION['Role']=$rowRolexUsuario['idrole_UsuarioXRole'];
			$IDRole=$rowRolexUsuario['idrole_UsuarioXRole'];
		/////////////////////////////////////////////////
	
		$Bodega =mysqli_query($mysqli,"select * from ent_usuarioxbodega where Ent_MaesBode_Id_MaesPais='$Pais' AND Ent_MaesBode_Id_MaesEmpr='$Empresa' AND IdUsuario_UsuarioXBodega='$IDuser'");
	$rowBodega=$Bodega->fetch_assoc();
		
			if(mysqli_num_rows($Bodega) > 1){
			 echo '<script> window.location="mantenimiento.php"</script>';
		}else {$_SESSION['Bodega']=$rowBodega['Ent_MaesBode_Id_MaesBode'];}
	


	
 echo '<script> window.location="PaginaPrincipla.php"</script>';
    }
    else{
		
        echo '<script> alert("El usuario y/o clave son incorrectas, vuelva a intentarlo.")</script>';
		echo '<script> window.location="index.html"</script>';
    }



?>