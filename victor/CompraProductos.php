<?php

session_start();

if (isset ($_SESSION['Usuario']))
{require('coneccion.php');

$paisEmpresa = $_SESSION['Pais'];
$empresaID= $_SESSION['Empresa'];
$usuarioLog=$_SESSION['Usuario'];
$Descuento= $_SESSION['Descuento'];
$Opcion8 =mysqli_query($mysqli,"select * from ent_opcionxrole where IdPais_OpcionXRole='$paisEmpresa' AND IdEmpr_OpcionXRole='$empresaID' and IdRole_OpcionXRole ='$Role' AND IdOpcion_OpcionXRole='15'");
	
			if(mysqli_num_rows($Opcion8) > 0){
			$_SESSION['COMPRAS']=1;
		}else { $_SESSION['COMPRAS']=0; }
	if($_SESSION['COMPRAS']==1){
date_default_timezone_set('America/Guatemala');

$percent= $Descuento;
$_SESSION["porciento"] = $Descuento/100;

$MAXID=mysqli_query($mysqli,"select max(Correlativo)+1 as maximo from ent_documento where IdPais_Documento='$paisEmpresa' and IdEmpr_Documento='$empresaID' and IdTipoDoc_Documento=2 ");
while($rowMXID= $MAXID->fetch_assoc()){$bin = $rowMXID['maximo']; 
		if ($bin!=""){
			$maxid = $rowMXID['maximo'];}
		else{$maxid=1;}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html;utf-8" />
<title>Entercon-Compras</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<link href="css/PlantillaCompra de Productos.css" rel="stylesheet" type="text/css" />


<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script type="text/javascript" src="js/jsPuntoCompra.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
</head>

<body>
<div class="container">
  <div class="header">
    <h1>Compra de Productos de Inventario</h1>
  </div>
  <div class="content">
    <form name="formDOC" method="post" id="form1
    DOC" action="">
   <table width="1113" height="95" class="bordes" id="tabla" >
<?php $unicod =  time();?>
<tr>
<td>Documento#</td><td><input type="text" value="<?php echo $maxid;?>" readonly="readonly" disabled="disabled"/></td>

<td width="260" class="arriva" align="right"><input type="text" disabled="disabled" readonly="readonly"  name="Doc" id="DOC" value="<?php echo $unicod ;?>" hidden=""/></td>
<td width="202" class="arriva" align="right">Fecha</td>
<td><span class="arriva">
  <input name="Fecha" type="text" disabled="disabled" value="<?php $fecha = date('d-m-y'); echo $fecha; ?>"  readonly="readonly"/>
</span></td>

</tr>
<tr>
<td width="184">Codigo </td>
<td width="144" ><select id="Proveedor" onblur="ProveedorSelecteValue();"></select></td>
<td width="260">&nbsp;</td>
<td width="202" align="right">Forma de Pago</td>
<td width="299"><select name="Tpago" id="Tpago" onblur="TpagoSelecteValue();">
</select></td>
<tr>
<td height="27">Bodega Ingreso</td>
<td><input type="text" name="IDBodegaIngreso" value="<?php echo $_SESSION['Bodega'];?> " id="IDBodegaIngreso" disabled="disabled"/> </td>

<td><input type="text" name="NombreBodegaIngreso" id="NombreBodegaIngreso" disabled="disabled" value="<?php echo $_SESSION['BodegaNombre'];?>"/></td>
<td></td>

<tr>
<td height="27">Observaciones </td>
<td><input type="text" name="Obs"  id="Obs"/></td>

<td> </td>
<td align="right">usuario</td>
<td width="299" >
<input type="text" id="user" value="<?php echo $usuarioLog;?>" readonly="readonly"/></td>
</tr>
</table>
</form>
<hr />
  <div id="tabla_data"></div>
 <form name="form1" method="post" id="form1" action="">
<table width="839" class="bordes">
  <tr>
<td width="144" ><input type="text" name="Tunidades" id="Tunidades"  value="" disabled="disabled"/></td>
<td width="125">Total Unidades</td>
<td width="18" id="a"></td>
<td width="156">Total Documento</td>
<td width="372" ><input disabled="disabled" type="text" name="TDoc" value="" id="Tdoc" /></td>

</tr>
</table>
</form>
<hr />
<table>
<tr>
<td><strong> Existencias:</strong> </td>
<strong><td id="existencias"> </td></strong>
</tr>
</table>
 <form name="FormEnvio" method="post" id="FormEnvio"  action="" >
<table width="1093" >
<tr>
<td width="144" height="28">Codigo Producto</td>
<td width="144">Unidades</td>
<td width="144">Descripcion</td>
<td width="114">Unidad Medida</td>
<td width="254" align="right">Valor Compra<input type="text" name="VC"  id ="VC" disabled="disabled" placeholder="Valor de Compra "/></td>
<td width="199"></td>
<td width="62" align="right"> <input type="button" name='agregarCompra' id="addCompra"value='Agregar' onclick="pruebaInsert();" disabled="disabled"/></td>
</tr>
<tr>
<td width="144"><input type="text" id="tags" name ="CodProd"/ disabled="disabled"></td>
<td width="144"><input type="text" name="unidades" id="unidades" onchange="ValTOTAL();" disabled="disabled"/>
</td>
<td width="144"><input type="text" name="Descripcion"  id ="Descripcion" disabled="disabled"/></td>
<td width="114"><select name="UM" id="UM" onblur="Ol();" disabled="disabled">
</select></td>
<td align="right">Valor Venta<input type="text" name="VV"  id ="VV" disabled="disabled" placeholder="Valor de Venta "/></td>
<td>Total <input type="text" name=TOTAL""  id ="TOTAL" disabled="disabled" placeholder="TOTAL "/></td>

<td  align="right"> <input type="button" name="Limpiar" id="Limpiar" value="Limpiar" onclick="LimpiarTXT();"/> </td>

</tr>
</table>
</form>
</div>
  <div class="footer" align="center">
<table width="auto" height="36" bgcolor="#CCCCCC">
      <tr>
       
      <td width="224" align="right">&nbsp;</td>
      
      <td width="65"><input class="bordes" type="button" name="btn1" id="Imprimir" value="Guardar Compra" onclick="Guardar();"/></td>
      <td width="248"></td>
      </tr>
    </table>
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
</html>
<?php

if (isset($_POST['btn1'])){
$accion=$_POST['btn1'];
//////imprimir
if($accion=="Imprimir"){
		$QueryTraslado = "INSERT INTO ent_detalledocumento (`IdPais_DetalleDocumento`, `IdEmpr_DetalleDocumento`, `IdTipoDoc_DetalleDocumento`, `Serie_DetalleDocumento`, `Documento_DetalleDocumento`, `IdTipoPago_Documento`, `Id_DetalleDocumento`, `IdUniMed_DetalleDocumento`, `Origen_DetalleDocumento`, `IdProd_DetalleDocumento`, `CodigoAlter_DetalleDocumento`, `CantidadV_DetalleDocumento`, `Cantidad_DetalleDocumento`, `ValorCosto_DetalleDocumento`, `ValorVenta_DetalleDocumento`, `Descuento_DetalleDocumento`)
       SELECT
          `IdPais_DetalleDocumento`, `IdEmpr_DetalleDocumento`, `IdTipoDoc_DetalleDocumento`, `Serie_DetalleDocumento`, `Documento_DetalleDocumento`, `IdTipoPago_Documento`, `Id_DetalleDocumento`, `IdUniMed_DetalleDocumento`, `Origen_DetalleDocumento`, `IdProd_DetalleDocumento`, `CodigoAlter_DetalleDocumento`, `CantidadV_DetalleDocumento`, `Cantidad_DetalleDocumento`, `ValorCosto_DetalleDocumento`, `ValorVenta_DetalleDocumento`, `Descuento_DetalleDocumento`
       FROM   ent_detalletemporal where  IdPais_DetalleDocumento = '$paisEmpresa' && IdEmpr_DetalleDocumento= '$empresaID'
      ";
	  $respuestaTraslado = $mysqli -> query($QueryTraslado);
	  if($respuestaTraslado!=""){echo "<script> alert('Exito ')</script>";}else {echo "<script> alert('Error ')</script>";}
}
//// calculadora
if($accion=="Calculadora"){
		echo "<script> window.open('Calculadora.php ', 'Calculadora','width=500, height=300')</script> " ;

}
///////salir
if ($accion=="Salir"){
		echo '<script> window.location="PaginaPrincipla.php"</script>';
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