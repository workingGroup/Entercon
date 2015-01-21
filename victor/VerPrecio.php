<?php

session_start();

if (isset ($_SESSION['Usuario']))
{require('coneccion.php');

$paisEmpresa = $_SESSION['Pais'];	
$empresaID= $_SESSION['Empresa'];	
$usuarioLog=$_SESSION['Usuario'];


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Entercon-Ver Precio</title>
<link href="css/PlantillaVerPrecio.css" rel="stylesheet" type="text/css" />
<style type="text/css">

</style>
</head>

<body>

<div class="container">
  <div class="header">
    <h1>Ver Precio</h1>
  </div>
  <div class="content">
 
   <form name="form1" action="" method="post">
  <table>
  <tr>
  <td><input name="Ver" type="text" value="" /></td> 
  <td><input type="submit" name="btn2" id="btn2" value="Buscar">  </td> 
  </tr>

  </table>
  </form>
  
  <table class="tabla" border="1" width="80%">
  	<thead>
  		<tr>
            <td><b>Codigo</b></td>
            <td><b>Nombre</b></td>
            <td><b>Valor Compra</b></td>
            <td><b>Valor Venta</b></td>
            
	    </tr>
  <tbody>
 <?php
if(isset($_POST["btn2"])){
$btn=$_POST["btn2"];

//////////Buscar

if ($btn=="Buscar"){
	$VALOR = $_POST["Ver"];
$QueryBuscar = " select * from ent_maesprod where  IdPais_MaesProd='$paisEmpresa' && IdEmpr_MaesProd='$empresaID' && Nombre_MaesProd  like '%$VALOR%'"; 
$resultado = $mysqli->query($QueryBuscar);

while($RowBuscar = $resultado->fetch_assoc()){
if ($resultado !=""){
?>
	<tr>
		<td><?php  echo $RowBuscar["CodigoAlt_MaesProd"];?></td>
		<td><?php  echo $RowBuscar["Nombre_MaesProd"];?></td>
        <td><?php  echo $RowBuscar["ValorCompra_MaesProd"];?></td>
		<td><?php echo $RowBuscar["ValorVenta_MaesProd"];?></td>
       
		
		
<?php 
			}
	}
	}else {echo "<script> alert('No hay resultados para tu busqueda')</script>";} 
} 
?>
     </tr>
   </tbody>
</table>
  </div>
   
  <div  align="center" class="footer"></div>
</div>
</body>
</html>
<?php  
}
else
{
	 echo "<script> alert('Debes iniciar secion primero.')</script>";
	echo'<script> window.location="Index.HTML"</script>';
		
}

?>