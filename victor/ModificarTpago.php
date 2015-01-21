<?php 
session_start();

if (isset ($_SESSION['Usuario']))
{
$empresaID= $_SESSION['Empresa'];	
$paisEmpresa = $_SESSION['Pais'];
$usuario=$_SESSION['Usuario'];

require('coneccion.php');

$id = $_GET['id'];
$descripcion = $_GET['descripcion'];
$tipoCambio = $_GET['cambio'];
$CalculoComicion = $_GET['Comicion'];
$maquina = gethostname();

date_default_timezone_set('America/Guatemala');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Entercon-Modificar Tipo de Pago</title>
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
<center> <h1> Modificar tipo de pago </h1> </center>
</div>
<hr/>

<form  id="form1" name="form1" method="post" action="" >
     	<table>
        <tr>
        <td><label for="ID">ID </label></td>
        <td><input name="ID" type="text" value="<?php echo $id ;?>" readonly="readonly"/></td> 
      	<tr>
        <td><label for="Descripcion">Descripcion</label></td>
        <td><input name="Descripcion" type="text" value= "<?php echo $descripcion;?> " /></td>
        <tr>
        <td><label for="Tipo de Cambio">Tipo de Cambio</label></td>
        <td><input name="TCambio" type="text"  value="<?php echo $tipoCambio;?>"/></td>
<tr>        
        <td><label for="Calculo de Comicion">Calculo de Comicion</label></td>
        <td><input name="Comicion" type="text" value="<?php echo $CalculoComicion ;?>" /></td>
     </tr>
     </table>   
     <p> </p>
     <table width="987">
      <tr>
      <td><label for="Usuario">Usuario</label></td>
      <td>  <input value="<?php  echo $usuario ; ?>" name="Usuario" type="text" readonly/> </td>
      
      <td><label for="Fecha de Creacion">Fecha de Creacion</label> </td>
      <td><input value="<?php $fecha = date('y-m-d h:i:s'); echo $fecha;?>" name="FechaCreacion" type="datetime" readonly/> </td>
      
      <td><label for="MaqCrea">MaqCrea</label> </td>
      <td><input value="<?php echo $maquina; ?>" name="MaqCreacion" type="text" readonly/></td>
      </tr>
      </table>
      <p/>
      <center><input type="submit" name="btn2" value="Guardar" /></center>
</form>
</body>
</html>

<?php if(isset($_POST["btn2"])){
$btn=$_POST["btn2"];
	if($btn=="Guardar"){
	$idnuevo=$_POST["ID"];
	$DescripcionNuevo=$_POST["Descripcion"];
	$cambio = $_POST['TCambio'];
	$Comicion =$_POST['Comicion'];
		if ($idnuevo !="" && $DescripcionNuevo !="" && $cambio !="" && $Comicion !=""  ){	
		$ActualizarQuery="UPDATE ent_maestipopago SET IdPais_MaesTipoPago='$paisEmpresa',IdEmpresa_MaesTipoPago='$empresaID',Id_MaesTipoPago='$idnuevo',Nombre_MaesTipoPago='$DescripcionNuevo',TasaCambio_MaesTipoPago='$cambio',PagaComision_MaesTipoPago='$Comicion',Usuario_MaesTipoPago='$usuario',FechaCreacion_MaesTipoPago='$fecha',MaqCreacion_MaesTipoPago='$maquina' WHERE IdPais_MaesTipoPago='$paisEmpresa' && IdEmpresa_MaesTipoPago='$empresaID' && Id_MaesTipoPago ='$id'";
	
		$respuestaActualizar=$mysqli->query($ActualizarQuery) ;
		if($respuestaActualizar !==False){ 
	 echo "<script> alert('Éxito al Actualizar')</script>";
	 echo "<script>window.opener.location.reload();</script>";
	echo "<script>	window.close();</script>";
	
}else{ 
    echo "Falló al modificar tipo de pago";
}   
		
		
		
		}else {echo "Llene todos los campos ";} 
}
	 
	 
	 
	  }?>


<?php  
}
else
{
	 echo "<script> alert('Debes iniciar secion primero.')</script>";
	echo'<script> window.location="Index.HTML"</script>';
		
}

?>