<?php 
session_start();

if (isset ($_SESSION['Usuario']))
{
$empresaID= $_SESSION['Empresa'];	
$paisEmpresa = $_SESSION['Pais'];
$usuario=$_SESSION['Usuario'];
$Role=$_SESSION['Role'];
require('coneccion.php');

$Opcion2 =mysqli_query($mysqli,"select * from ent_opcionxrole where IdPais_OpcionXRole='$paisEmpresa' AND IdEmpr_OpcionXRole='$empresaID' and IdRole_OpcionXRole ='$Role' AND IdOpcion_OpcionXRole='2'");
	$rowOpcion2=$Opcion2->fetch_assoc();
			
			if(mysqli_num_rows($Opcion2) > 0){
			$_SESSION['Permiso2']=$rowOpcion2['TipoPermiso_RoleXOpcion'];
			$_SESSION['MAESTROPRODUCTOS']=1;
		}else { $_SESSION['MAESTROPRODUCTOS']=0; }
		
if ($_SESSION['MAESTROPRODUCTOS']==1){	

$codGET=$_GET["Codigo"];

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

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script type="text/javascript" src="js/jsModificarProd.js"></script>
</head>

<body bgcolor="#373737" text="#FFFFFF">
<div class="titulo">
<center>
  <h1>Modificar Producto</h1></center>
</div>
<hr/>
  <form id="form1" name="form1" method="post" action="">
<table>
  <p>
  <tr>
    <td width="133"><label for="Codigo">Codigo </label></td>
    <td width="144"><input class="bordes" type="text" name="Codigo" id="Codigo"  value=" <?php echo $codGET ;?>" readonly="readonly"/></td>
<tr>
   <td> <label for="Nombre">Nombre</label></td>
   <td> <input type="text" name="Nombre" id="Nombre" value=""/></td>
<tr>
   <td> <label for="Clasificacion">Clasificacion</label> </td> 
   <td><select id="Clasificacion" onblur="ClasificacionSValue();"> </select></td>  
<tr>    
      <td><label for="Marca"> Marca</label></td>
      <td><select name="Marca" id="Marca" onblur="MarcaSValue();"/></select></td>
      
    <td width="122"><label for="Modelo"> Modelo</label></td>
    <td width="156"><input type="text" name="Modelo" id="Modelo" value=""/></td>
<tr>    
    <td><label for="Proveedor">Proveedor</label></td>
    <td><select id="Proveedor" onblur="ProveedorSValue();"> </select></td>
    
    <td><label for="Minimos">Minimos</label></td>
    <td><input type="text" name="Minimos" id="Minimos" value=""/></td>
<tr> 
    <td><label for="Valor de compra">Valor de compra</label></td>
    <td><input type="text" name="ValorCompra" id="ValorCompra" value=""/></td>  
    
    <td><label for="Valor de Venta">Valor de Venta</label></td>
    <td><input type="text" name="ValorVenta" id="ValorVenta" value="" /></td>
<tr> 
    <td><label for="Medida">Medida</label></td>
    <td><select id="Medida" onblur="MedidaSValue();">
    </select></td>
   <td></td>
  
   <td> <input type="checkbox" name="ModificarPrecio" id="ModificarPrecio" onclick="ChkFacturas();"/> <label for="Modificar Precio">Modificar Precio</label></td>

    </table> 
  <p></p>
  <p></p>
          <center><input type="button" onclick="AgregarProducto();" id="Guardar" value="Guardar"/>
          <input type="submit" name="btn1" id="Desactivar" value="Desactivar"/>
          <input type="submit" name="btn1" id="Activar" value="Activar"/>
    </center>
</form>
</body>
</html>
<?php if (isset($_POST["btn1"])){
$boton = $_POST["btn1"];

$cod=$_POST["Codigo"];
$ziro=0;
$one=1;
if($boton=="Desactivar"){
	$sqlDesactivar="Update ent_maesprod set Estado_MaesProd =b'$ziro' where IdPais_MaesProd='$paisEmpresa' AND IdEmpr_MaesProd='$empresaID' and IdProd_MaesProd='$cod'";
	
		$RespuestaDesactivar= $mysqli->query($sqlDesactivar)or die ("No se ah podido desactivar Producto");
		if($RespuestaDesactivar!==False){ 
	 echo "<script> alert('Éxito al Desactivar ,este producto no estara disponible para la venta hasta activar de nuevo')</script>";
		echo "<script>window.opener.location.reload();</script>";
	echo "<script>	window.close();</script>";
}else{ 
    echo "Falló al desactivar Producto"; 	
}
}
if($boton=="Activar"){
	$sqlDesactivar="Update ent_maesprod set Estado_MaesProd =b'$one' where IdPais_MaesProd='$paisEmpresa' AND IdEmpr_MaesProd='$empresaID' and IdProd_MaesProd='$cod'";
		$RespuestaDesactivar= $mysqli->query($sqlDesactivar)or die ("No se ah podido Activar  Producto");
		if($RespuestaDesactivar!==False){ 
	 echo "<script> alert('Éxito al Activar ,este producto estara disponible de nuevo')</script>";
		echo "<script>window.opener.location.reload();</script>";
	echo "<script>	window.close();</script>";
}else{ 
    echo "Falló al Activar Producto"; 	
}
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