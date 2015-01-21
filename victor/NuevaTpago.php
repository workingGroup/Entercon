<?php 
session_start();

if (isset ($_SESSION['Usuario']))
{
$empresaID= $_SESSION['Empresa'];	
$paisEmpresa = $_SESSION['Pais'];
$usuario=$_SESSION['Usuario'];

require('coneccion.php');


$maquina = gethostname();
date_default_timezone_set('America/Guatemala');
$sqlIDdm = "SELECT max(Id_MaesTipoPago)+1 as codigo from ent_maestipopago where IdPais_MaesTipoPago='$paisEmpresa' and IdEmpresa_MaesTipoPago='$empresaID'";
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
<title>Entercon-Modificar Tipo de Pago</title>
<style type="text/css">
body,td,th {
	font-family: Verdana, Geneva, sans-serif;
	color: #000;
}
body {
	background-color: #fff;
}
.titulo {
	background-color:#CCC;
	}
</style>
</head>

<body>
<div class="titulo"> 
<center> <h1> Nuevo tipo de pago </h1> </center>
</div>
<hr/>

 <form  id="form1" name="form1" method="post" action="" >
     	<table>
        <tr>
        <td><label for="ID">ID </label></td>
        <td><input name="ID" type="text" value="<?php echo $Id ; ?>" disabled="disabled" /></td> 
      	<tr>
        <td><label for="Descripcion">Descripcion</label></td>
        <td><input name="Descripcion" type="text" value= " " /></td>
        <tr>
        <td><label for="Tipo de Cambio">Tipo de Cambio</label></td>
        <td><input name="TCambio" type="text"  value=""/></td>
<tr>        
        <td><label for="Calculo de Comicion">Calculo de Comicion</label></td>
        <td><input name="Comicion" type="text" value="" /></td>
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
	$idnuevo=$Id;
	$DescripcionNuevo=$_POST["Descripcion"];
	$cambio = $_POST['TCambio'];
	$Comicion =$_POST['Comicion'];
		if ($idnuevo !="" && $DescripcionNuevo !="" && $cambio !="" && $Comicion !=""  ){	
		$ActualizarQuery="INSERT INTO `ent_maestipopago`(`IdPais_MaesTipoPago`, `IdEmpresa_MaesTipoPago`, `Id_MaesTipoPago`, `Nombre_MaesTipoPago`, `TasaCambio_MaesTipoPago`, `PagaComision_MaesTipoPago`, `Usuario_MaesTipoPago`, `FechaCreacion_MaesTipoPago`, `MaqCreacion_MaesTipoPago`) VALUES ('$paisEmpresa','$empresaID','$idnuevo','$DescripcionNuevo','$cambio','$Comicion','$usuario','$fecha','$maquina')";
		
		$respuestaActualizar=$mysqli->query($ActualizarQuery)or die ("No se pudo Insertar tipo de pago") ;
		if($respuestaActualizar!==False){ 
	 echo "<script> alert('Éxito al insertar tipo de pago')</script>";
	
}else{ 
    echo "Falló al insertar tipo de pago"; 
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