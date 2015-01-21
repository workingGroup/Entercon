<?php 
session_start();

if (isset ($_SESSION['Usuario']))
{
$empresaID= $_SESSION['Empresa'];	
$paisEmpresa = $_SESSION['Pais'];
$usuario=$_SESSION['Usuario'];

require('coneccion.php');
$Role=$_SESSION['Role'];

	$Opcion3 =mysqli_query($mysqli,"select * from ent_opcionxrole where IdPais_OpcionXRole='$paisEmpresa' AND IdEmpr_OpcionXRole='$empresaID' and IdRole_OpcionXRole ='$Role' AND IdOpcion_OpcionXRole='3'");
	$rowOpcion3=$Opcion3->fetch_assoc();
	
			if(mysqli_num_rows($Opcion3) > 0){
		    $_SESSION['Permiso3']=$rowOpcion3['TipoPermiso_RoleXOpcion'];
			$_SESSION['MAESTROMARCAS']=1;
		}else { $_SESSION['MAESTROMARCAS']=0; }

if ($_SESSION['MAESTROMARCAS']==1){

$id = $_GET['id'];
$nombre = $_GET['nombre'];
$estadoini= $_GET['Estado'];
$maquina = gethostname();

date_default_timezone_set('America/Guatemala');


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Modificar Marca</title>
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
<center><h1>Modificar Marca</h1></center>
</div>
<hr/>
<form id="formeditar" name="formeditar" method="POST" action=""> 
<table width="84%">
  <tr>
	<td width="101"> <label for="IDMarcanuevo">ID Marca</label></td>
	<td width="144"> <input value="<?php echo $id ;?>" name="IDMarcanuevo" type="text" readonly="readonly"/> </td>

  </tr>
    <tr>
	<td width="101" height="27"><label for="Nombrenuevo">Nombre</label></td>
	<td width="144"> <input value="<?php echo $nombre ?>" name="Nombrenuevo" type="text" /> </td>
    
    <td width="183" align="right"> Estado </td>
    
    <td width="16"> <?php if ($estadoini==0){
		echo ' <input  type="checkbox" name="Estado"  />';
}else if ($estadoini==1){ echo ' <input checked="checked" type="checkbox" name="Estado" />' ;  }?> </td>
    
    </tr>
</table>
      
      <p>&nbsp;</p>

<table width="987">
      <tr>
      <td><label for="Usuario">Usuario</label></td>
      <td>  <input readonly="readonly" value="<?php echo $usuario ; ?>" name="Usuarionuevo" type="text" /> </td>
      
      <td><label for="FechaCreacionnuevo">Fecha de Creacion</label> </td>
      <td><input value="<?php $fecha = date('y-m-d h:i:s'); echo $fecha;?>" name="FechaCreacionnuevo" type="text" readonly="readonly" /> </td>
      
      <td><label for="MaqCreacionnuevo">MaqCrea</label> </td>
      <td><input value="<?php echo $maquina ;?>" name="MaqCreacionnuevo" type="text" readonly="readonly" /></td>
      </tr>
      </table>
      <p></p>
      <center><input class="bordes" type="submit" name="btn2" id="Inicio" value="Guardar" /></center>
       </form>
<?php 
if ( isset ($_POST["Estado"]) ){ $estado= 1; }else{$estado= 0;} 
if(isset($_POST["btn2"])){
$btn=$_POST["btn2"];
	if($btn=="Guardar"){
	$idnuevo=$_POST["IDMarcanuevo"];
	$nomNuevo=$_POST["Nombrenuevo"];
		if ($idnuevo !="" && $nomNuevo !=""){	
		$ActualizarQuery="update ent_maesmarca set Id_MaesMarca ='$idnuevo' ,Nombre_MaesMarca='$nomNuevo',Usuario_MaesMarca='$usuario',FechaCreacion_MaesMarca='$fecha',MaqCreacion_MaesMarca='$maquina' , Estatus_MaesMarca =$estado  where Id_MaesMarca='$id' &&  IdPais_MaesMarca = '$paisEmpresa' &&   IdEmpr_MaesMarca ='$empresaID' ";
		
		$respuestaActualizar=$mysqli->query($ActualizarQuery)or die ("No se pudo Actualizar marca") ;
		if($respuestaActualizar!==False){ 
	 echo "<script> alert('Éxito al Actualizar')</script>";
		echo "<script>window.opener.location.reload();</script>";
	echo "<script>	window.close();</script>";
}else{ 
    echo "Falló al modificar marca"; 
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