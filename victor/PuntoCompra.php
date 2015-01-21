<?php

session_start();

if (isset ($_SESSION['Usuario']))
{require('coneccion.php');

$paisEmpresa = $_SESSION['Pais'];
$empresaID= $_SESSION['Empresa'];
$usuarioLog=$_SESSION['Usuario'];
$Descuento= $_SESSION['Descuento'];

$Role=$_SESSION['Role'];

$Opcion8 =mysqli_query($mysqli,"select * from ent_opcionxrole where IdPais_OpcionXRole='$paisEmpresa' AND IdEmpr_OpcionXRole='$empresaID' and IdRole_OpcionXRole ='$Role' AND IdOpcion_OpcionXRole='15'");
	
			if(mysqli_num_rows($Opcion8) > 0){
			$_SESSION['COMPRAS']=1;
		}else { $_SESSION['COMPRAS']=0; }
	if($_SESSION['COMPRAS']==1){

date_default_timezone_set('America/Guatemala');

$percent= $Descuento;
$_SESSION["porciento"] = $Descuento/100;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html;utf-8" />
<title>Entercon-Punto de Compra</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<link href="css/PlantillaCompra de Productos.css" rel="stylesheet" type="text/css" />


<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script type="text/javascript" src="js/jsMantenimientoPuntoCompra.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
</head>

<body>
<div class="container">
  <div class="header">
    <h1>Punto de Compra</h1>
    <form action="" method="post">
    <input type="text" name="btn1" id="Buscar" />
    <input class="bordes" type="button" value="Buscar" onclick="Searching();"/>
    </form>
  </div>
  <div class="content" id="Contenido">
    <form name="formDOC" method="post" id="form1
    DOC" action="">
   <table width="1096" height="95" class="bordes" id="tabla" >
<?php $unicod =  time();?>
<tr>
<td>Documento#</td><td><input type="text" value="" readonly="readonly" disabled="disabled" id="Correlativo"/></td>

<td width="198" class="arriva" align="right"><input type="text" disabled="disabled" readonly="readonly"  name="Doc" id="DOC" value="" hidden=""/></td>
<td width="155" class="arriva">&nbsp;</td>
<td><span class="arriva">Fecha</span></td>
<td><span class="arriva">
  <input name="Fecha" type="text" disabled="disabled" value=""  id="Fecha" readonly="readonly"/>
</span></td>
</tr>
<tr>
<td width="152">Codigo </td>
<td width="144" ><select id="Proveedor" onblur="ProveedorSelecteValue();" disabled="disabled"></select></td>
<td width="198"></td>
<td width="155">&nbsp;</td>
<td width="128">Forma de Pago</td>
<td><select name="Tpago"  disabled="disabled" id="Tpago" onblur="TpagoSelecteValue();">
</select></td>
<tr>
<td height="27">Bodega Ingreso</td>
<td><input type="text" name="IDBodegaIngreso"  id="IDBodegaIngreso"  disabled="disabled"/> </td>

<td><input type="text" name="NombreBodegaIngreso" id="NombreBodegaIngreso"  disabled="disabled"/></td>
<td> </td>
<td>usuario </td>
<td><input type="text" id="user" value="" readonly="readonly"  disabled="disabled"/></td>
<tr>
<td height="27">Observaciones </td>
<td><input type="text" name="Obs"  id="Obs"  disabled="disabled"/></td>
<td> </td>
<td> </td>
<td width="128">&nbsp;</td>
<td width="291" >&nbsp;</td>
</tr>

</table>
</form>
<hr />
  <div id="tabla_data"></div>


 <form name="form1" method="post" id="form1" action="">
<table width="839" class="bordes">
  <tr>
<td width="144" >&nbsp;</td>
<td width="125">&nbsp;</td>
<td width="18" id="a"></td>
<td width="156">Total Documento</td>
<td width="372" ><input disabled="disabled" type="text" name="TDoc" value="" id="Tdoc" /></td>

</tr>
</table>
</form>
<hr />


</div>
  <div class="footer" align="center">
<table width="auto" height="36" bgcolor="#CCCCCC">
      <tr>
       
      <td width="250" align="right">&nbsp;</td>
      <td width="86">&nbsp;</td>
      <td width="45"><input class="bordes" type="button" onclick="Inicio();" name="Inicio" id="Inicio" value="inicio" /></td>
      <td width="43"><input class="bordes" type="button" name="Final" id="Final" value="Final" onclick="Final();"/></td>
      <td width="51"><input class="bordes" type="button" name="Previo" id="Previo" value="Previo" onclick="Previo();"/></td>
      <td width="69"><input class="bordes" type="button"  id="Siguiente" value="Siguiente" onclick="Siguiente();" /></td>
      <td width="65"><input class="bordes" type="button" name="btn1" id="Imprimir" value="Imprimir" onclick="printcontent('Contenido')"/></td>
      <td width="62"><input class="bordes" type="button" name="Agregar" id="Agregar" value="Agregar" onclick="Agregar();"/></td>
      <td width="62"><input class="bordes" type="button" name="Eliminar" id="Eliminar" value="Eliminar" onclick="Eliminar();"/></td>
     
      </tr>
    </table>
    <!-- end .footer --></div>
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