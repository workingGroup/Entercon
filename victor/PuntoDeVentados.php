<?php

session_start();

if (isset ($_SESSION['Usuario']))
{require('coneccion.php');

$paisEmpresa = $_SESSION['Pais'];
$empresaID= $_SESSION['Empresa'];
$usuarioLog=$_SESSION['Usuario'];
$Descuento= $_SESSION['Descuento'];

date_default_timezone_set('America/Guatemala');

$percent= $Descuento;
$_SESSION["porciento"] = $Descuento/100;
$MAXID=mysqli_query($mysqli,"select max(Correlativo)+1 as maximo from ent_documento where IdPais_Documento='$paisEmpresa' and IdEmpr_Documento='$empresaID' and IdTipoDoc_Documento =1 ");
while($rowMXID= $MAXID->fetch_assoc()){$bin = $rowMXID['maximo']; 
		if ($bin!=""){
			$maxid = $rowMXID['maximo'];}
		else{$maxid=1;}
	
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html;utf-8" />
<title>Entercon-Punto de Venta</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<link href="css/PlantillaPuntoVenta.css" rel="stylesheet" type="text/css" />


<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script type="text/javascript" src="js/jsPuntoVenta.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
</head>

<body>
<div class="container">
  <div class="header">
    <h1> Punto de Venta</h1>
  </div>
  <div class="content">

<form name="formDOC" method="post" id="formDOC" action="">
 <table width="87" height="250" class="fltrt">
 <tr>
 <td width="79"  align="right">

  <button type="button" onclick="Facturar();" id="Imprimir"  disabled="disabled"><img src="componentes/print.png"></button></td>
 </tr>
 </tr>

  <tr>
 <td align="right"> <button type="button" onclick="VerPrecio();"><img src="componentes/search.png"></button></td>
 </tr>



   <tr>
 <td  align="right"><button type="button" onclick="VerPrecio();"><img src="componentes/calcu.png"></button></td>
 </tr>

  <tr>
 <td  align="right">
 <button type="button" onclick="VerPrecio();"><img src="componentes/Cotizacion.png"></button>
</td>
 </tr>

  <tr>
 <td  align="right"><button type="button" onclick="VerPrecio();"><img src="componentes/exit.png"></button></td>
 </tr>
 </table>
 </form>


    <form name="formDOC" method="post" id="form1
    DOC" action="">
   <table width="979" height="166" class="bordes" id="tabla" >

<tr>
<td>Doc#</td><td><?php $unicod = time() ;?><input type="text" value="<?php echo $maxid;?>" readonly="readonly" disabled="disabled"/></td>
<td><input type="text" disabled="disabled" readonly="readonly"  name="Doc" id="DOC" value="<?php echo $unicod ;?>" hidden=""/></td>
<td></td>
<td></td>
<td class="arriva">Nit</td>
<td><input type="text" name="NIT" id="NIT" /></td>
<td width="188">Tipo de pago</td>
<td width="108"><select name="Tpago" id="Tpago" onblur="TpagoSelecteValue();">
</select></td>
</tr>
<tr>
<td width="47" height="29" class="arriva">Fecha</td>
<td width="144" class="arriva"><input name="Fecha" type="text" disabled="disabled" value="<?php $fecha = date('d-m-y'); echo $fecha; ?>"  readonly="readonly" id="fecha"/> </td>
<td width="78"> </td>
<td width="145" > </td>
<td width="10"></td>
<td width="74">Cliente</td>
<td width="145"><input type="text" name="Cliente" id="Cliente"  /></td>
<tr>
<td height="27">Serie</td>
<td><input type="text" name="Series" value="213" id="Series"/> </td>

<td>Factura</td>
<td><input type="text" name="Factura"  value="213" id="Factura"/> </td>
<td width="10" > </td>
<td>Direccion</td>
<td><input type="text" name="Direccion"  id="Direccion" /></td>
<tr>
<td height="27"> </td>
<td> </td>
<td> </td>
<td> </td>
<td></td>
<td>&nbsp;</td>
<td><a href="#" onclick="window.open('NuevoCliente.php', 'Nuevo-Cliente','width=1100, height=500,resizable=NO')">Cliente nuevo? </a></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td></td>
<td>&nbsp;</td>
<td></td>
<td></td>
<td >&nbsp;</td>
</tr>
</table>
</form>
 <hr />
  <div id="tabla_data"></div>
 <hr />
<p> </p>
 <form name="form1" method="post" id="form1" action="">
<table width="1049" class="bordes">
  <tr>
<td width="173" ><input type="text" name="Tunidades" id="Tunidades"  value="" disabled="disabled"/></td>
<td width="268">Total Unidades</td>
<td width="255" id="a"></td>
<td width="144">Total Documento</td>
<td width="144" ><input disabled="disabled" type="text" name="TDoc" value="" id="Tdoc" /></td>

</tr>
</table>
</form>

<table>
<tr>
<td><strong> Existencias:</strong> </td>
<strong><td id="existencias"> </td></strong>
<td></td>
<td><strong> Valor unidad:</strong> </td>
<strong><td id="valorunitario"> </td></strong>
</tr>
</table>
 <form name="FormEnvio" method="post" id="FormEnvio"  action="" >
<table width="1052" >
<tr>
<td width="160">Codigo Producto</td>
<td width="160">Unidades</td>
<td width="160">Descripcion</td>
<td width="307">Unidad Medida</td>
<td width="144"><input type="text" name="VV"  id ="VV" disabled="disabled" placeholder="Valor de Venta "/></td>
<td width="93" align="right"><input type="button" id="add" value="Agregar" onclick=" pruebaInsert();" /></td>
</tr>
<tr>
<td width="160"><input type="text" id="tags" name ="CodProd"/></td>
<td width="160"><input type="text" name="unidades" id="unidades" onchange="ValTOTAL();" />
</td>
<td width="160"><input type="text" name="Descripcion"  id ="Descripcion"/></td>
<td width="307"><select name="UM" id="UM" onblur="SelectedV();">
</select></td>
<td align="right"><input type="text" onchange="MaxDesc();" name="Desc" placeholder="Descuento max:<?php echo $percent ;?>%" id ="Desc" value="0"/> </td>
<td  align="right"> <input type="button" name="Limpiar" id="Limpiar" value="Limpiar" onclick="LimpiarTXT();"/> </td>

</tr>
</table>
</form>
</div>
  <div class="footer" align="center">

    <!-- end .footer --></div>
  <!-- end .container --></div>
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