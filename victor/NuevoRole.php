<?php 
session_start();

if (isset ($_SESSION['Usuario']))
{
$empresaID= $_SESSION['Empresa'];	
$paisEmpresa = $_SESSION['Pais'];
$usuario=$_SESSION['Usuario'];

require('coneccion.php');
$Role=$_SESSION['Role'];

	$Opcion3 =mysqli_query($mysqli,"select * from ent_opcionxrole where IdPais_OpcionXRole='$paisEmpresa' AND IdEmpr_OpcionXRole='$empresaID' and IdRole_OpcionXRole ='$Role' AND IdOpcion_OpcionXRole='8'");
	$rowOpcion3=$Opcion3->fetch_assoc();
	
			if(mysqli_num_rows($Opcion3) > 0){
		    $_SESSION['Permiso3']=$rowOpcion3['TipoPermiso_RoleXOpcion'];
			$_SESSION['MAESTROMARCAS']=1;
		}else { $_SESSION['MAESTROMARCAS']=0; }

if ($_SESSION['MAESTROMARCAS']==1){

$maquina = gethostname();
date_default_timezone_set('America/Guatemala');

$sqlIDdm = "SELECT max(id_Role)+1 as codigo from ent_role where IdPais_Role='$paisEmpresa' and IdEmpr_Role='$empresaID'";
		$maxM1=$mysqli->query($sqlIDdm); 
		
		while($row= $maxM1->fetch_assoc()){$bin = $row['codigo']; 
		if ($bin!=""){
			$Id = $row['codigo'];}
		else{$Id=1;}
		
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Entercon -Nuevo role</title>
<style type="text/css">
body,td,th {
	font-family: Verdana, Geneva, sans-serif;
	color: #000;
}
body {
	background-color: #FFFFFF;
}
.titulo {
	background-color:#CCC;
	}
</style>
</head>

<body>
<div class="titulo">
<center>
  <h1>Nuevo Role</h1></center>
</div>
<hr/>
<form id="formmarcanueva" name="formmarcanueva" method="POST" action=""> 
<table width="34%">
  <tr>
	<td width="65"> <label for="ID Marca">ID Role</label></td>
	<td width="180"> <input value="<?php echo $Id ;?>" name="IDMarca" type="text"  disabled="disabled" /> </td>

  </tr>
    <tr>
	<td width="65" height="27"><label for="Nombre">Nombre</label></td>
    
	<td width="180"> <input value="" name="Nombre" type="text" /> </td>
    </tr>
</table>
   
    
      
      <p>&nbsp;</p>

<table width="987">
      <tr>
      <td><label for="Usuario">Usuario</label></td>
      <td>  <input readonly="readonly" value="<?php echo $usuario; ?>" name="Usuario" type="text" /> </td>
      <td><label for="Fecha de Creacion">Fecha de Creacion</label> </td>
      <td><input value="<?php $fecha = date('y-m-d h:i:s'); echo $fecha;
?>" name="FechaCreacion" type="datetime" readonly /> </td>
      <td><label for="MaqCrea">MaqCrea</label> </td>
      <td><input value="<?php echo $maquina; ?>" name="MaqCreacion" type="text" readonly/></td>
      </tr>
      </table>
      <p></p>
      <center><input class="bordes" type="submit" name="btn1" id="add" value="Agregar" /></center>
      </form>
      
      <?php if(isset($_POST["btn1"])){
		 
	$btn=$_POST["btn1"];
	 if($btn=="Agregar"){
	
		 
		 
		$codnuevo=$Id;
		$nomNuevo=$_POST["Nombre"];	
		
		if ($codnuevo != "" && $nomNuevo !=""){	
		 $AgregarQuery = "insert into ent_role (IdPais_Role,IdEmpr_Role ,id_Role, Nombre_Role, Estatus_Role,Usuario_Role, FechaCreacion_Role, MaqCreacion_Role ) values ('$paisEmpresa','$empresaID','$codnuevo', '$nomNuevo',1,'$usuario','$fecha','$maquina' )";

     $respuestaInsert=$mysqli->query($AgregarQuery)or die ("Aun no se ha insertado ningun dato") ; 
	 
	 $Opciones=mysqli_query($mysqli,"Select*From ent_opcion");
	 $Rows=mysqli_num_rows($Opciones);

	 for($Numero=1;$Numero<=25;$Numero++)
	 {
		 $OpcionesInsert=mysqli_query($mysqli,"INSERT INTO `ent_opcionxrole`(`IdPais_OpcionXRole`, `IdEmpr_OpcionXRole`, `IdRole_OpcionXRole`, `IdOpcion_OpcionXRole`, `TipoPermiso_RoleXOpcion`, `Usuario_RoleXOpcion`, `FechaCreacion_RoleXOpcion`, `MaqCreacion_RoleXOpcion`) VALUES ('$paisEmpresa','$empresaID','$Id','$Numero',3,'$usuario','$fecha','$maquina')");
		
	 }
	 
	if ($respuestaInsert !=False ){
   
   echo "<script> alert('Éxito al Insertar')</script>";
    echo '<script> window.location="Roles.php"</script>';
	
}else{ 
    echo "Falló al Insertar Role"; 
}   
		}else{echo "LLene todos los campos";}
	 }
 
	  }
	 
	 ?>
</body>
</html>
<?php  
}else{echo '<script> window.location="error.php"</script>'; }
}
else
{
	 echo "<script> alert('Debes iniciar secion primero.')</script>";
	echo'<script> window.location="Index.HTML"</script>';
		
}

?>