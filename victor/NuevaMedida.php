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

$maquina = gethostname();
date_default_timezone_set('America/Guatemala');

$sqlIDdm = "SELECT max(Id_MaesUnidMedida)+1 as codigo from ent_maesunidmedida where IdPais_MaesUnidMedida='$paisEmpresa' and IdEmpr_MaesUnidMedida='$empresaID'";
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
<center><h1>Nueva Medida</h1></center>
</div>
<hr/>
<form id="form2" name="form2" method="POST" action=""> 
    <table>
    <tr>
      <td><label for="Unidad Medida">Unidad Medida</label></td>
      <td><input name="UnidadMedida" type="text" value ="<?php echo $Id ;?>" disabled="disabled" /></td>
     <tr>
      <td> <label for="Nombre">Nombre</label></td>
       <td><input name="Nombre" type="text" value =""/></td>  
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
$unidadMedida= $Id;
$nombre = $_POST["Nombre"];
	if ($boton=="Guardar"){
		if ($unidadMedida !="" && $nombre !=""){
			$IngresarMedida  = "insert into ent_maesunidmedida (IdPais_MaesUnidMedida,IdEmpr_MaesUnidMedida,Id_MaesUnidMedida,Nombre_MaesUnidMedida,Usuario_MaesUnidMedida,FechaCreacion_MaesUnidMedida,MaqCreacion_MaesUnidMedida)values ('$paisEmpresa' ,'$empresaID' ,'$unidadMedida' ,'$nombre','$usuario' ,'$fecha' , '$maquina')";
			
			$RespuestaIngresar = $mysqli->query($IngresarMedida)or die ("No se ah podido Insertar la medida");
		if($RespuestaIngresar!==False){ 
	 echo "<script> alert('Éxito al Insertar')</script>";
	
}else{ 
    echo "Falló al Insertar medida"; 
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