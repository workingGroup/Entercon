<?php 
session_start();

if (isset ($_SESSION['Usuario']))
{
$empresaID= $_SESSION['Empresa'];	
$paisEmpresa = $_SESSION['Pais'];
$usuario=$_SESSION['Usuario'];
$Role=$_SESSION['Role'];
require('coneccion.php');

$Opcion6 =mysqli_query($mysqli,"select * from ent_opcionxrole where IdPais_OpcionXRole='$paisEmpresa' AND IdEmpr_OpcionXRole='$empresaID' and IdRole_OpcionXRole ='$Role' AND IdOpcion_OpcionXRole='6'");
	$rowOpcion6=$Opcion6->fetch_assoc();
			if(mysqli_num_rows($Opcion6) > 0){
			$_SESSION['Permiso6']=$rowOpcion6['TipoPermiso_RoleXOpcion'];
			$_SESSION['UNIDAD DE MEDIDA']=1;
		}else { $_SESSION['UNIDAD DE MEDIDA']=0; }
		
if($_SESSION['UNIDAD DE MEDIDA']==1){

$id = $_GET['id'];
$nombre = $_GET['nombre'];
$maquina = gethostname();

date_default_timezone_set('America/Guatemala');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<style type="text/css">
body,td,th {
	color: #000;
	font-family: Verdana, Geneva, sans-serif;
}
#form2 {
	font-family: Verdana, Geneva, sans-serif;
}
.titulo {
	background-color:#CCC;
	}
body {
	background-color: #FFF;
}
</style>
</head>

<body bgcolor="#373737" text="#FFFFFF">
<div class="titulo">
<center><h1>Modificar Medida</h1></center>
</div>
<hr/>
<form id="form2" name="form2" method="POST" action=""> 
    <table>
    <tr>
      <td><label for="Unidad Medida">Unidad Medida</label></td>
      <td><input readonly="readonly" name="UnidadMedida" type="text" value ="<?php echo $id;?>" /></td>
     <tr>
      <td> <label for="Nombre">Nombre</label></td>
       <td><input name="Nombre" type="text" value ="<?php echo $nombre;?>"/></td>  
      </tr>
  </table>
        <p> </p>
        <table width="987">
      <tr>
      <td><label for="Usuario">Usuario</label></td>
      <td><input name="Usuario" type="text" value ="<?php echo $usuario;?>" readonly /></td>
      
      <td><label for="Fecha de Creacion">Fecha de Creacion</label> </td>
      <td><input name="FechaCreacion" type="datetime" value ="<?php $fecha = date('y-m-d h:i:s'); echo $fecha;?>" readonly/> </td>
      
      <td><label for="MaqCrea">MaqCrea</label> </td>
      <td><input  name="MaqCreacion" type="text" value ="<?php echo $maquina;?>" readonly/></td>
      </tr>
      </table>
      <p></p>
          <center><input type="submit" name="btn1" id="Guardar" value="Guardar"/></center>
</form>
</body>
</html>
<?php if (isset($_POST["btn1"])){
$boton = $_POST["btn1"];
$unidadMedida= $_POST["UnidadMedida"];
$nombre = $_POST["Nombre"];
	if ($boton=="Guardar"){
		if ($unidadMedida !="" && $nombre !=""){
			$actualizarMedida  = "update ent_maesunidmedida set Id_MaesUnidMedida = '$unidadMedida' ,Nombre_MaesUnidMedida = '$nombre' , Usuario_MaesUnidMedida = '$usuario' ,FechaCreacion_MaesUnidMedida ='$fecha' , MaqCreacion_MaesUnidMedida = '$maquina' where  Id_MaesUnidMedida = '$id' && IdPais_MaesUnidMedida ='$paisEmpresa' && IdEmpr_MaesUnidMedida='$empresaID'" ;
			
			$RespuestaActualizar = $mysqli->query($actualizarMedida)or die ("No se ah podido Actualizar la medida");
		if($RespuestaActualizar!==False){ 
	 echo "<script> alert('Éxito al Actualizar')</script>";
	 	echo "<script>window.opener.location.reload();</script>";
	echo "<script>	window.close();</script>";
	
}else{ 
    echo "Falló al Modificar medida"; 
}   
		}else{echo "LLene todos los campos";}
		}
}?>
<?php  
}else{echo '<script> window.location="error.php"</script>'; }
}
else
{
	 echo "<script> alert('Debes iniciar secion primero.')</script>";
	echo'<script> window.location="Index.HTML"</script>';
		
}

?>