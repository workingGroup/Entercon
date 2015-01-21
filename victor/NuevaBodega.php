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

$maquina = gethostname();
date_default_timezone_set('America/Guatemala');

$sqlIDdm = "SELECT max(Id_MaesBode)+1 as codigo from ent_maesbode where Id_MaesPais='$paisEmpresa' and Id_MaesEmpr='$empresaID'";
		$maxM1=$mysqli->query($sqlIDdm); 
		
		while($row= $maxM1->fetch_assoc()){$bin = $row['codigo']; 
		if ($bin!=""){
			$Id = $row['codigo'];}
		else{$Id=1;}
		$Id;
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Entercon-Nueva Bodega</title>
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
<center>
  <h1>Nueva Bodega</h1> 
  </center>
</div>
<hr/>
  <form id="form3" name="form3" method="POST" action=""> 
<table width="34%">
	<tr>
	<td width="20"> <label for="ID Marca">ID </label></td>
	<td width="30"> <input value="<?php echo $Id ;?>" disabled="disabled" name="ID" type="text" /> </td>
    </tr>
    <tr>
	<td width="20" height="27"><label for="Nombre">Nombre</label></td>
	<td width="30"> <input value="" name="Nombre" type="text"  /> </td>
    <tr>
	<td width="20"> <label for="ID Marca">Direccion</label></td>
	<td width="30"> <input value="" name="Direccion" type="text" /> </td>
    </tr>
    <tr>
	<td width="20" height="27">Telefonos</td>
	<td width="30"> <input value="" name="Telefonos" type="text"  /> </td>
    <tr>
	<td width="20"><label for="Fax">Fax</label></td>
	<td width="30"> <input value="" name="Fax" type="text" /> </td>
    </tr>
    <tr>
	<td width="20" height="27"><label for="Email">Email</label></td>
	<td width="30"> <input value="" name="Email" type="text"  /> </td>
    <tr>
	<td width="20"><label for="Email">Encargado</label></td>
	<td width="30"> <input value="" name="Encargado" type="text" /> </td>
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
if (isset($_POST["btn1"])){
	$accion = $_POST["btn1"];
$nuevoID=$Id;
$nuevoNOMBRE =$_POST["Nombre"];
$nuevoDIRECCION=$_POST["Direccion"];
$nuevoTELEFONOS = $_POST["Telefonos"];
$nuevoFAX =$_POST["Fax"];
$nuevoEMAIL =$_POST["Email"];
$nuevoENCARGADO =$_POST["Encargado"];


	if ($accion=="Guardar"){
		if ($nuevoID !="" && $nuevoNOMBRE !="" && $nuevoDIRECCION !="" && $nuevoTELEFONOS !="" && $nuevoFAX !="" && $nuevoEMAIL !="" && $nuevoENCARGADO !=""){
			$actualizarMedida  = "insert into ent_maesbode (Id_MaesPais,Id_MaesEmpr,Id_MaesBode,Nombre_MaesBode,Direccion_MaesBode,Telefono_MaesBode,Fax_MaesBode,Email_MaesBode,Encargado_MaesBode,Usuario_MaesBode,FechaCreacion_MaesBode,MaquinaCreacion_MaesBode ,Estatus_MaesBode) values
('$paisEmpresa','$empresaID','$nuevoID','$nuevoNOMBRE','$nuevoDIRECCION','$nuevoTELEFONOS' ,'$nuevoFAX','$nuevoEMAIL' ,'$nuevoENCARGADO','$usuarioLog','$fecha','$maquina','1' )  " ;
			
			$RespuestaActualizar = $mysqli->query($actualizarMedida)or die ("No se ah podido Ingresar la Bodega");
		if($RespuestaActualizar!==False){ 
	 echo "<script> alert('Éxito al Ingresar')</script>";
	
}else{ 
    echo "Falló al Ingresar Bodega"; 
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
