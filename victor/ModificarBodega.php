<?php  

session_start();

if (isset ($_SESSION['Usuario']))
{require('coneccion.php');

$paisEmpresa = $_SESSION['Pais'];	
$empresaID= $_SESSION['Empresa'];	
$usuarioLog=$_SESSION['Usuario'];
$Role=$_SESSION['Role'];

$Opcion4 =mysqli_query($mysqli,"select * from ent_opcionxrole where IdPais_OpcionXRole='$paisEmpresa' AND IdEmpr_OpcionXRole='$empresaID' and IdRole_OpcionXRole ='$Role' AND IdOpcion_OpcionXRole='4'");
	$rowOpcion4=$Opcion4->fetch_assoc();
	
			if(mysqli_num_rows($Opcion4) > 0){
			$_SESSION['Permiso4']=$rowOpcion4['TipoPermiso_RoleXOpcion'];
			$_SESSION['MAESTRO DE BODEGAS']=1;
		}else { $_SESSION['MAESTRO DE BODEGAS']=0; }

if($_SESSION['MAESTRO DE BODEGAS']==1){

$id = $_GET['id'];
$nombre= $_GET['nombre'];
$direccion= $_GET['direccion'];
$telefonos= $_GET['telefonos'];
$fax= $_GET['fax'];
$email= $_GET['email'];
$encargado= $_GET['encargado'];

$maquina = gethostname();
$estadoini= $_GET['Estado']; 


date_default_timezone_set('America/Guatemala');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Entercon-Modificar Bodega</title>
<style type="text/css">
body,td,th {
	font-family: Verdana, Geneva, sans-serif;
	color: #000;
}
body {
	background-color: #FFF;
}
.titulo {
	background-color:#ccc; 
}
</style>
</head>

<body>
<div class="titulo">
<center><h1>Modificar Bodega</h1> </center>
</div>
<hr/>
  <form id="form3" name="form3" method="POST" action=""> 
<table width="82%">
	<tr>
	<td width="84"> <label for="ID Marca">ID </label></td>
	<td width="216"> <input value="<?php echo $id; ?>" name="ID" type="text"  readonly="readonly"/> </td>
    </tr>
    <tr>
	<td width="84" height="27"><label for="Nombre">Nombre</label></td>
	<td width="216"> <input value="<?php echo $nombre;?>" name="Nombre" type="text"  /> </td>
    <tr>
	<td width="84"> <label for="ID Marca">Direccion</label></td>
	<td width="216"> <input value="<?php echo $direccion ;?>" name="Direccion" type="text" /> </td>
    </tr>
    <tr>
	<td width="84" height="27">Telefonos</td>
	<td width="216"> <input value="<?php echo $telefonos ; ?>" name="Telefonos" type="text"  /> </td>
    <tr>
	<td width="84"><label for="Fax">Fax</label></td>
	<td width="216"> <input value="<?php echo $fax ; ?>" name="Fax" type="text" /> </td>
    </tr>
    <tr>
	<td width="84" height="27"><label for="Email">Email</label></td>
	<td width="216"> <input value="<?php echo $email ; ?>" name="Email" type="text"  /> </td>
    <tr>
	<td width="84"><label for="Email">Encargado</label></td>
	<td width="216"> <input value="<?php echo $encargado; ?>" name="Encargado" type="text" /> </td>
    <td  width="96" align="right">Estado</td>
    <td width="20"> 
   <?php if ($estadoini==0){
		echo ' <input  type="checkbox" name="Estado"  />';
}else if ($estadoini==1){ echo ' <input checked="checked" type="checkbox" name="Estado" />' ;  }?>
    </tr>
    
    </table>
   <p>&nbsp;</p>

    <table width="987">
      <tr>
      <td><label for="Usuario">Usuario</label></td>
      <td>  <input value="<?php echo $usuarioLog; ?>" name="Usuario" type="text" readonly/> </td>
      
      <td><label for="Fecha de Creacion">Fecha de Creacion</label> </td>
      <td><input value=" <?php $fecha = date('y-m-d h:i:s'); echo $fecha;?>" name="FechaCreacion" type="datetime" readonly/> </td>
      
      <td><label for="MaqCrea">MaqCrea</label> </td>
      <td><input value="<?php echo $maquina ; ?>" name="MaqCreacion" type="text" readonly/></td>
      </tr>
      </table>
      <P/>
      <center><input type="submit"  name="btn1" value="Guardar" /></center>
      
</form>
<?php 
if ( isset ($_POST["Estado"]) ){ $estado= 1; }else{$estado= 0;} 

if (isset($_POST["btn1"])){
	$accion = $_POST["btn1"];
$nuevoID=$_POST["ID"];
$nuevoNOMBRE =$_POST["Nombre"];
$nuevoDIRECCION=$_POST["Direccion"];
$nuevoTELEFONOS = $_POST["Telefonos"];
$nuevoFAX =$_POST["Fax"];
$nuevoEMAIL =$_POST["Email"];
$nuevoENCARGADO =$_POST["Encargado"];


	if ($accion=="Guardar"){
		if ($nuevoID !="" && $nuevoNOMBRE !="" && $nuevoDIRECCION !="" && $nuevoTELEFONOS !="" && $nuevoFAX !="" && $nuevoEMAIL !="" && $nuevoENCARGADO !=""){
			$actualizarMedida  = "update ent_maesbode set Id_MaesBode = '$nuevoID' ,Nombre_MaesBode = '$nuevoNOMBRE' , Direccion_MaesBode = '$nuevoDIRECCION' ,Telefono_MaesBode ='$nuevoTELEFONOS' , Fax_MaesBode = '$nuevoFAX' , Email_MaesBode = '$nuevoEMAIL' , Encargado_MaesBode = '$nuevoENCARGADO' ,Estatus_MaesBode = '$estado' ,  Usuario_MaesBode = '$usuarioLog' , FechaCreacion_MaesBode = '$fecha' , MaquinaCreacion_MaesBode = '$maquina' where  Id_MaesBode = '$id' && Id_MaesPais ='$paisEmpresa' && Id_MaesEmpr='$empresaID'" ;
			
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
