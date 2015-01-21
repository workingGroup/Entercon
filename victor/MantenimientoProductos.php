<?php
session_start();

if (isset ($_SESSION['Usuario']))
{require('coneccion.php');

$paisEmpresa = $_SESSION['Pais'];	
$empresaID= $_SESSION['Empresa'];	
$usuarioLog=$_SESSION['Usuario'];
$Role=$_SESSION['Role'];
	require('coneccion.php');
	
	$Opcion2 =mysqli_query($mysqli,"select * from ent_opcionxrole where IdPais_OpcionXRole='$paisEmpresa' AND IdEmpr_OpcionXRole='$empresaID' and IdRole_OpcionXRole ='$Role' AND IdOpcion_OpcionXRole='2'");
	$rowOpcion2=$Opcion2->fetch_assoc();
			
			if(mysqli_num_rows($Opcion2) > 0){
			$_SESSION['Permiso2']=$rowOpcion2['TipoPermiso_RoleXOpcion'];
			$_SESSION['MAESTROPRODUCTOS']=1;
		}else { $_SESSION['MAESTROPRODUCTOS']=0; }
		
if ($_SESSION['MAESTROPRODUCTOS']==1){	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Entercon-Mantenimiento Productos</title>
<link href="css/PlantillaMantenimientoProductos.css" rel="stylesheet" type="text/css" />
<style type="text/css">
label {
	font-family: Verdana, Geneva, sans-serif;
}
</style>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script type="text/javascript" src="js/jsMantenimientoProductos.js"></script>


</head>

<body>

<div class="container">
  <div class="header">
    <h3> Mantenimiento de Productos </h3>
<form id="formbusqueda" action="" method="post">
    <table><tr>
    <td><input type="text" id="Buscar"/></td>
    <td align="right"><input class="bordes" type="button" id="Buscar" value="Buscar" onclick="Search();"/></td>
    </tr></table>
  </form>
    </div>
  <div class="content">
<div  id="contenido">
  
  <form id="form1" name="form1" method="post" action="">
<table>
  <p>
  <tr>
    <td width="133"><label for="Codigo">Codigo </label></td>
    <td width="144"><input class="bordes" type="text" name="Codigo" id="Codigo"  value=" " readonly/></td>
<tr>
   <td> <label for="Nombre">Nombre</label></td>
   <td> <input type="text" name="Nombre" id="Nombre" value=""readonly/></td>
<tr>
   <td> <label for="Clasificacion">Clasificacion</label> </td> 
   <td><input type="text" name="Clasificacion" id="Clasificacion" value=""readonly/></td>  
<tr>    
      <td><label for="Marca"> Marca</label></td>
      <td><input type="text" name="Marca" id="Marca" value=""readonly/></td>
      
    <td width="122"><label for="Modelo"> Modelo</label></td>
    <td width="156"><input type="text" name="Modelo" id="Modelo" value=""readonly/></td>
<tr>    
    <td><label for="Proveedor">Proveedor</label></td>
    <td><input type="text" name="Proveedor" id="Proveedor" value=""readonly/></td>
    
    <td><label for="Minimos">Minimos</label></td>
    <td><input type="text" name="Minimos" id="Minimos" value=""readonly/></td>
<tr> 
    <td><label for="Valor de compra">Valor de compra</label></td>
    <td><input type="text" name="ValorCompra" id="ValorCompra" value=""readonly/></td>  
    
    <td><label for="Valor de Venta">Valor de Venta</label></td>
    <td><input type="text" name="ValorVenta" id="ValorVenta" value=""readonly /></td>
<tr> 
    <td><label for="Medida">Medida</label></td>
    <td><input type="text" name="Medida" id="Medida" value=""readonly/>
    
    </select></td>
   <td></td>
  
   <td>
   <input readonly="readonly" type="checkbox" name="ModificarPrecio" id="Modificar Precio" disabled="disabled"  />
    <label for="Modificar Precio">Modificar Precio</label></td>

    </table> 
    
  <p></p>
  <table width="987">
      <tr>
     <font color="#FF0000"  id="estado" >
     </font>
      <td width="827" align="right"><label for="Usuario">Usuario</label></td>
      <td width="148">  <input value="" id="Usuario" type="text" readonly/> </td>
      </tr>
      </table>
  
  <hr />
 
  </form>
<div id="TablaDUM"></div>

 <table width="793">
        <tr>
        <td width="390">&nbsp;</td>
         <td width="87">&nbsp;</td>
          <td width="86">&nbsp;</td>
           <td width="210" align="right"><input type="button" onclick="Add();" value="Agregar" /></td>
        </tr>
        </table>

<p></p>
  <div id="MovBodega"></div>
 
  </div>
  </div>
    <div  align="center" class="footer">
    <form action="" method="post">
   <table width="auto" height="36" bgcolor="#CCCCCC">
      <tr>
       
      <td width="250" align="right"><input class="bordes" type="button" onclick="Primero();" id="Inicio" value="inicio" /></td>
      <td width="43"><input class="bordes" type="button" id="Final" value="Final" onclick="Ultimo();"/></td>
      <td width="51"><input class="bordes" type="button" id="Previo" value="Previo" onclick="Anterior();"/></td>
      <td width="69"><input class="bordes" type="button"  id="Siguiente" value="Siguiente" onclick="Next();" /></td>
      <td width="65"><input class="bordes" type="button" id="Imprimir" value="Imprimir" onclick="printme();"/></td>
      <td width="62"><input class="bordes" type="button"  id="Siguiente" value="Agregar" onclick="Agregar();" /></td>
      <td width="68"><input class="bordes" type="button" id="Modificar" value="Modificar" onclick="Modify();"/></td>
      <td width="62"><input class="bordes" type="button" id="Eliminar" value="Eliminar" onclick="Delete();"/></td>
     
      </tr>
    </table>
    </form>
  </p>
  </div>
      
  <!-- end .container --></div>
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