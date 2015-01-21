<?php 
session_start();

if (isset ($_SESSION['Usuario']))
{
$empresaID= $_SESSION['Empresa'];	
$paisEmpresa = $_SESSION['Pais'];
$usuario=$_SESSION['Usuario'];
$Role=$_SESSION['Role'];

require('coneccion.php');


$Opcion5 =mysqli_query($mysqli,"select * from ent_opcionxrole where IdPais_OpcionXRole='$paisEmpresa' AND IdEmpr_OpcionXRole='$empresaID' and IdRole_OpcionXRole ='$Role' AND IdOpcion_OpcionXRole='5'");
	$rowOpcion5=$Opcion5->fetch_assoc();
			if(mysqli_num_rows($Opcion5) > 0){
			$_SESSION['Permiso5']=$rowOpcion5['TipoPermiso_RoleXOpcion'];
			$_SESSION['TIPO DE PRODUCTOS']=1;
		}else { $_SESSION['TIPO DE PRODUCTOS']=0; }

if($_SESSION['TIPO DE PRODUCTOS']==1){

$id = $_GET['id'];
$descripcion = $_GET['descripcion'];
$maquina = gethostname();
date_default_timezone_set('America/Guatemala');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Modificar Tipo de Producto</title>
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
  <h1> Modificar Tipo de Producto </h1></center>
  </div>
  <hr />
    <form id="form2" name="form2" method="POST" action=""> 
<table width="34%">
	<tr>
	<td width="20"> <label for="ID Marca">ID</label></td>
	<td width="30"> <input value="<?php echo $id;?>" name="IDProductonuevo" type="text" readonly="readonly"/> </td>

    </tr>
    <tr>
	<td width="20" height="27"><label for="Nombre">Descripcion</label></td>
    
	<td width="30"> <input value="<?php echo $descripcion;?>" name="Descripcion" type="text"  /> </td>
    </tr>
</table>
   
    
      
      <p>&nbsp;</p>

<table width="987">
      <tr>
      <td><label for="Usuario">Usuario</label></td>
      <td>  <input value="<?php  echo $usuario ; ?>" name="Usuario" type="text" readonly/> </td>
      
      <td><label for="Fecha de Creacion">Fecha de Creacion</label> </td>
      <td><input value="<?php  $fecha = date('y-m-d h:i:s'); echo $fecha;?>" name="FechaCreacion" type="datetime" readonly/> </td>
      
      <td><label for="MaqCrea">MaqCrea</label> </td>
      <td><input value="<?php echo $maquina; ?>" name="MaqCreacion" type="text" readonly/></td>
      </tr>
      </table>
      <p></p>
      <center> <input type="submit" name="btn2" value="Guardar"  /></center>
      </form>
</body>
</html>

<?php 

if(isset($_POST["btn2"])){
$btn=$_POST["btn2"];
	if($btn=="Guardar"){
	$idnuevo=$_POST["IDProductonuevo"];
	$descripcion=$_POST["Descripcion"];
		if ($idnuevo !="" && $descripcion !=""){	
		$ActualizarQuery="update ent_maestipoprod set Id_MaesTipoProd ='$idnuevo' ,Nombre_MaesTipoProd='$descripcion',Usuario_MaesTipoProd='$usuario',FechaCreacion_MaesTipoProd='$fecha',MaqCreacion_MaesTipoProd='$maquina' where Id_MaesTipoProd='$id' && IdPais_MaesTipoProd = '$paisEmpresa' &&   IdEmpr_MaesTipoProd ='$empresaID'";
	
		$respuestaActualizar=$mysqli->query($ActualizarQuery)or die ("No se pudo Actualizar Tipo de producto") ;
		if($respuestaActualizar!==False){ 
	 echo "<script> alert('Éxito al Actualizar')</script>";
		echo "<script>window.opener.location.reload();</script>";
	echo "<script>	window.close();</script>";
	
}else{ 
    echo "Falló al modificar marca"; 
}   
			
		}else {echo "Llene todos los campos ";} 
	}
}
	 
?>
<?php 
}else{echo '<script> window.location="error.php"</script>'; } 
}
else
{
	 echo "<script> alert('Debes iniciar secion primero.')</script>";
	echo'<script> window.location="Index.HTML"</script>';
		
}

?>