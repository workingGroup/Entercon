<?php 
session_start();

if (isset ($_SESSION['Usuario']))
{
$empresaID= $_SESSION['Empresa'];	
$paisEmpresa = $_SESSION['Pais'];
$usuario=$_SESSION['Usuario'];

require('coneccion.php');

$Role=$_SESSION['Role'];

$Opcion5 =mysqli_query($mysqli,"select * from ent_opcionxrole where IdPais_OpcionXRole='$paisEmpresa' AND IdEmpr_OpcionXRole='$empresaID' and IdRole_OpcionXRole ='$Role' AND IdOpcion_OpcionXRole='5'");
	$rowOpcion5=$Opcion5->fetch_assoc();
			if(mysqli_num_rows($Opcion5) > 0){
			$_SESSION['Permiso5']=$rowOpcion5['TipoPermiso_RoleXOpcion'];
			$_SESSION['TIPO DE PRODUCTOS']=1;
		}else { $_SESSION['TIPO DE PRODUCTOS']=0; }

if($_SESSION['TIPO DE PRODUCTOS']==1){

$maquina = gethostname();
date_default_timezone_set('America/Guatemala');

$sqlIDdm = "SELECT max(Id_MaesTipoProd)+1 as codigo from ent_maestipoprod where IdPais_MaesTipoProd='$paisEmpresa' and IdEmpr_MaesTipoProd='$empresaID'";
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
<title>Modificar Tipo de Producto</title>
<style type="text/css">
body,td,th {
	font-family: Verdana, Geneva, sans-serif;
	color: #000;
}
.titulo {
	background-color:#CCC;
	}
body {
	background-color: #FFFFFF;
}
</style>
</head>

<body>

<div class="titulo" >
  <center><h1> Nuevo Tipo de Producto </h1></center>
  </div>
  <hr />
    <form id="form2" name="form2" method="POST" action=""> 
<table width="34%">
	<tr>
	<td width="20"> <label for="ID Marca">ID</label></td>
	<td width="30"> <input value="<?php echo $Id;?>" name="IDProductonuevo" type="text" disabled="disabled"/> </td>

    </tr>
    <tr>
	<td width="20" height="27"><label for="Nombre">Descripcion</label></td>
    
	<td width="30"> <input value="" name="Descripcion" type="text"  /> </td>
    </tr>
    <tr>
    	<td>Servicio</td>
        <td><input type="checkbox" name="Chk"/></td>
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
if(isset($_POST["Chk"])){$valorCHK=1;}else{$valorCHK=0;}
	if($btn=="Guardar"){
	$idnuevo=$Id;
	$descripcion=$_POST["Descripcion"];
		if ($idnuevo !="" && $descripcion !=""){	
		$ActualizarQuery="insert into ent_maestipoprod  (IdPais_MaesTipoProd,IdEmpr_MaesTipoProd,Id_MaesTipoProd,Nombre_MaesTipoProd,Inventa_MaesTipoProd,Usuario_MaesTipoProd,FechaCreacion_MaesTipoProd ,MaqCreacion_MaesTipoProd) values ('$paisEmpresa','$empresaID','$idnuevo' ,'$descripcion','$valorCHK','$usuario','$fecha','$maquina' )";
		
		$respuestaActualizar=$mysqli->query($ActualizarQuery)or die ("No se pudo Insertar Tipo de producto") ;
		if($respuestaActualizar!==False){ 
	 echo "<script> alert('Éxito al Insertar')</script>";
	
}else{ 
    echo "Falló al Insertar Tipo de producto"; 
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