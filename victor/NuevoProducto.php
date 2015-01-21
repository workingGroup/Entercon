<?php 
session_start();

if (isset ($_SESSION['Usuario']))
{
$empresaID= $_SESSION['Empresa'];	
$paisEmpresa = $_SESSION['Pais'];
$usuario=$_SESSION['Usuario'];

require('coneccion.php');
$Role=$_SESSION['Role'];

$Opcion2 =mysqli_query($mysqli,"select * from ent_opcionxrole where IdPais_OpcionXRole='$paisEmpresa' AND IdEmpr_OpcionXRole='$empresaID' and IdRole_OpcionXRole ='$Role' AND IdOpcion_OpcionXRole='2'");
	$rowOpcion2=$Opcion2->fetch_assoc();
			
			if(mysqli_num_rows($Opcion2) > 0){
			$_SESSION['Permiso2']=$rowOpcion2['TipoPermiso_RoleXOpcion'];
			$_SESSION['MAESTROPRODUCTOS']=1;
		}else { $_SESSION['MAESTROPRODUCTOS']=0; }
		
if ($_SESSION['MAESTROPRODUCTOS']==1){	

$maquina = gethostname();
	date_default_timezone_set('America/Guatemala');
	
$sqlIDdm = "SELECT max(IdProd_MaesProd)+1 as codigo from ent_maesprod where IdPais_MaesProd='$paisEmpresa' and IdEmpr_MaesProd='$empresaID'";
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
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script type="text/javascript" src="js/jsNuevoProd.js"></script>

</head>

<body bgcolor="#373737" text="#FFFFFF">
<div class="titulo">
<center>
  <h1>Nuevo Producto</h1></center>
</div>
<hr/>
  <form id="form1" name="form1" method="post" action="">
<table>
  <p>
  <tr>
    <td width="133"><label for="Codigo">Codigo </label></td>
    <td width="144"><input class="bordes" type="text" name="Codigo" id="Codigo"  value="<?php echo $Id;?>" disabled="disabled"/></td>
<tr>
   <td> <label for="Nombre">Nombre</label></td>
   <td> <input type="text" name="Nombre" id="Nombre" value=""/></td>
<tr>
   <td> <label for="Clasificacion">Clasificacion</label> </td> 
   <td> <select name="Clasificacion" id="Clasificacion" onblur="ClasificacionSValue();">
      </select></td>  
<tr>    
      <td><label for="Marca"> Marca</label></td>
      <td><select name="Marca" id="Marca" onblur="MarcaSValue();">     
      </select> </td>
      
    <td width="122"><label for="Modelo"> Modelo</label></td>
    <td width="156"><input type="text" name="Modelo" id="Modelo" value=""/></td>
<tr>    
    <td><label for="Proveedor">Proveedor</label></td>
    <td><select name="Proveedor" id="Proveedor" onblur="ProveedorSValue();">
    </select></td>
    
    <td><label for="Minimos">Minimos</label></td>
    <td><input type="text" name="Minimos" id="Minimos" value=" "/></td>
<tr> 
    <td><label for="Valor de compra">Valor de compra</label></td>
    <td><input type="text" name="ValorCompra" id="Valorc" value=""/></td>  
    
    <td><label for="Valor de Venta">Valor de Venta</label></td>
    <td><input type="text" name="ValorVenta" id="Valorv" value="" /></td>
<tr> 
    <td><label for="Medida">Medida</label></td>
    <td><select name="Medida" id="Medida" onblur="MedidaSValue();">
    </select>
    </td>
   <td></td>
  
 

    </table> 
  <p></p>
  <table width="987">
      <tr>
      <td height="24"><label for="Usuario">Usuario</label></td>
      <td>  <input value="<?php echo $usuario ; ?>" name="Usuario" type="text" readonly /> </td>
     
      <td><label for="Fecha de Creacion">Fecha de Creacion</label> </td>
      <td><input value="<?php $fecha = date('y-m-d h:i:s'); echo $fecha;?>" name="FechaCreacion" type="datetime" readonly/> </td>
      <td><label for="MaqCrea">MaqCrea</label> </td>
      <td><input value="<?php echo $maquina ; ?>" name="MaqCreacion" type="text" readonly /></td>
      </tr>
      </table>
      <p></p>
          <center><input type="button" id="Guardar" value="Guardar" onclick="AgregarProducto();"/></center>
</form>
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