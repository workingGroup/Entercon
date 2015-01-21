<?php 
session_start();

if (isset ($_SESSION['Usuario']))
{
$empresaID= $_SESSION['Empresa'];	
$paisEmpresa = $_SESSION['Pais'];
$usuario=$_SESSION['Usuario'];
$Role=$_SESSION['Role'];
require('coneccion.php');

$Opcion8 =mysqli_query($mysqli,"select * from ent_opcionxrole where IdPais_OpcionXRole='$paisEmpresa' AND IdEmpr_OpcionXRole='$empresaID' and IdRole_OpcionXRole ='$Role' AND IdOpcion_OpcionXRole='9'");
	
			if(mysqli_num_rows($Opcion8) > 0){
			$_SESSION['MAESTRO DE CLIENTES']=1;
		}else { $_SESSION['MAESTRO DE CLIENTES']=0; }
	if($_SESSION['MAESTRO DE CLIENTES']==1){

$id = $_GET['id'];
$nit = $_GET['nit'];
$razon = $_GET['razon'];
$direccion = $_GET['direccion'];
$telefonos = $_GET['telefonos'];
$fax = $_GET['fax'];
$email = $_GET['email'];

$maquina = gethostname();

date_default_timezone_set('America/Guatemala');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Modificar Cliente</title>
<style type="text/css">
body,td,th {
	color: #000;
	font-family: Verdana, Geneva, sans-serif;
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
  <h1>Modificar Cliente</h1></center>
</div>
<hr/>
  <form id="form1" name="form1" method="post" action="">
<table>
	 <tr> 
         <td> <label for="ID">ID</label></td>
         <td> <input type="text" name="IDnuevo" id="Id" value="<?php echo $id ; ?>" readonly="readonly" /></td>
  	 <tr>        
         <td> <label for="Nit">Nit</label></td>
         <td> <input type="text" name="Nitnuevo" id="Nit" value="<?php echo $nit ; ?>"/></td>
     <tr>      
         <td> <label for="Razon">Razon</label></td>
         <td> <input type="text" name="Razonnuevo" id="Razon" value="<?php echo $razon ; ?>"/></td>
     <tr>      
         <td> <label for="Direccion">Direccion</label></td>
         <td> <input type="text" name="Direccionnuevo" id="Direccion" value="<?php echo $direccion ; ?>"/></td>
     <tr>     
         <td> <label for="Telefonos">Telefonos</label></td>
         <td> <input type="text" name="Telefonosnuevo" id="Telefonos" value="<?php echo $telefonos ; ?>"/></td>
         
         <td> <label for="Fax">Fax</label></td>
         <td> <input type="text" name="Faxnuevo" id="Fax"  value="<?php echo $fax ; ?>"/></td>
     <tr>  
         <td height="27">  <label for="email">email</label></td>
         <td> <input type="text" name="emailnuevo" id="email" value="<?php echo $email ; ?>" />    </td> 
     <tr>
     </tr>
     </table>
     <p>&nbsp;</p>
     <table width="987">
     <tr>
         <td width="77">  <label for="Usuario">Usuario</label></td>
         <td width="178"> <input type="text" name="Usuario" id="Usuario" value ="<?php echo $usuario ; ?>"readonly="readonly"/></td>
      
         <td width="104"> <label for="FechaCrea">FechaCrea</label></td>
         <td width="203"> <input type="text" name="FechaCrea" id="FechaCrea" value=" <?php $fecha = date('y-m-d h:i:s'); echo $fecha;?>" readonly="readonly"/></td>
       
        <td width="115"> <label for="MaqCrea">MaqCrea</label></td>
        <td width="282">  <input type="text" name="MaqCrea" id="MaqCrea"
        value="<?php echo $maquina;  ?>" readonly="readonly"/></td>
    </tr>
    </table> 
      <p></p>
      <center><input class="bordes" type="submit" name="btn2" id="Inicio" value="Guardar" /></center>
</form>
<?php


if(isset($_POST["btn2"])){
$btn=$_POST["btn2"];
	if($btn=="Guardar"){
	$idnuevo=$_POST["IDnuevo"];
	$NitNuevo=$_POST["Nitnuevo"];
	$razonNuevo=$_POST["Razonnuevo"];
	$direccionNuevo=$_POST["Direccionnuevo"];
	$TelefonoNuevo=$_POST["Telefonosnuevo"];
	$FaxNuevo=$_POST["Faxnuevo"];
	$emailNuevo=$_POST["emailnuevo"];
	
	
		if ($idnuevo !="" && $NitNuevo !=""){	
		$ActualizarQuery="update ent_maessocio set Id_Socio = '$idnuevo' , Nit_MaesSociocol = '$NitNuevo' , RazonSocial_MaesSocio = '$razonNuevo' , Direccion_MaesSocio = '$direccionNuevo' , Telefono_MaesSocio = '$TelefonoNuevo' , Email_MaesSocio = '$emailNuevo' , Usuario_MaesSocio ='$usuario' , FechaCreacion_MaesSocio = '$fecha' , MaqCreacion_MaesSocio ='$maquina' where Id_Socio = '$id' && Id_MaesPais = '$paisEmpresa' && Id_MaesEmpr = '$empresaID'  ";
		
		$respuestaActualizar=$mysqli->query($ActualizarQuery)or die ("No se pudo Actualizar Cliente") ;
		if($respuestaActualizar!==False){ 
	 echo "<script> alert('Éxito al Actualizar')</script>";
		echo "<script>window.opener.location.reload();</script>";
	echo "<script>	window.close();</script>";
}else{ 
    echo "Falló al modificar Cliente"; 
}   
		
		
		
		}else {echo "Llene todos los campos ";} 
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