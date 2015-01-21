<?php

session_start();

if (isset ($_SESSION['Usuario']))
{require('coneccion.php');

$paisEmpresa = $_SESSION['Pais'];
$empresaID= $_SESSION['Empresa'];
$usuarioLog=$_SESSION['Usuario'];
$BodegaID=$_SESSION['Bodega'];
$BodegaNombre=$_SESSION['BodegaNombre'];
$Role=$_SESSION['Role'];

$Opcion8 =mysqli_query($mysqli,"select * from ent_opcionxrole where IdPais_OpcionXRole='$paisEmpresa' AND IdEmpr_OpcionXRole='$empresaID' and IdRole_OpcionXRole ='$Role' AND IdOpcion_OpcionXRole='10'");
	
			if(mysqli_num_rows($Opcion8) > 0){
			$_SESSION['MAESTRO DE CLIENTES']=1;
		}else { $_SESSION['MAESTRO DE CLIENTES']=0; }
	if($_SESSION['MAESTRO DE CLIENTES']==1){

date_default_timezone_set('America/Guatemala');
$MAXID=mysqli_query($mysqli,"select max(Correlativo)+1 as maximo from ent_documento where IdPais_Documento='$paisEmpresa' and IdEmpr_Documento='$empresaID' and IdTipoDoc_Documento=3 ");
while($rowMXID= $MAXID->fetch_assoc()){$bin = $rowMXID['maximo']; 
		if ($bin!=""){
			$maxid = $rowMXID['maximo'];}
		else{$maxid=1;}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html;utf-8" />
<title>Entercon-Envios</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<link href="css/PlantillaPuntoVenta.css" rel="stylesheet" type="text/css" />


<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script type="text/javascript" src="js/jsEnviosBodegas.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
</head>

<body>
<div class="container">
  <div class="header">
    <h1> Envios entre Bodegas</h1>
  </div>
  <div class="content">
    <form name="formDOC" method="post" id="form1
    DOC" action="">
   <table width="1054" height="166" class="bordes" id="tabla" >

<tr>
<td>Doc#</td><td><?php $unicod =  time();?><input type="text" value="<?php echo $maxid;?>" readonly="readonly" disabled="disabled"/></td>

<td align="right"><input type="text" disabled="disabled" readonly="readonly"  name="Doc" id="DOC" value="<?php echo $unicod ;?>" hidden=""/>
  Fecha</span></td>
<td>
  <input name="Fecha" type="text" disabled="disabled" value="<?php $fecha = date('d-m-y'); echo $fecha; ?>"  readonly="readonly" id="fecha"/>
</td>
<td class="arriva">&nbsp;</td>
<td>&nbsp;</td>
<td width="89">&nbsp;</td>
<td width="107">&nbsp;</td>
</tr>
<tr>
<td width="145" height="29" class="arriva">Bodega Salida</td>
<td width="145" class="arriva"><input type="text" id="BodSalidaID" readonly="readonly" disabled="disabled" value="<?php echo $BodegaID ;?>"/></td>
<td width="162"><input type="text" name="Series" id="BodSalidaNombre" readonly="readonly" disabled="disabled" value="<?php echo $BodegaNombre;?>"/></td>
<td width="161" >&nbsp;</td>
<td width="144"></td>
<td width="65">&nbsp;</td>
<td width="89">&nbsp;</td>
<tr>
<td height="27">Bodega Ingreso</td>
<td>
  <input type="text" name="BodEntradaID" id="BodEntradaID" />
</td>

<td><span class="arriva">
  <input type="text" name="BodEntradaNombre" id="BodEntradaNombre"  />
</span></td>
<td>&nbsp;</td>
<td width="144" > </td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<tr>
<td height="27">Observaciones</td>
<td> <input type="text" name="Obs" id="Obs" /></td>
<td> </td>
<td align="right">Usuario</td>
<td><input type="text" id="Usuario" readonly="readonly" disabled="disabled" value="<?php echo $usuarioLog;?>"/></td>
<td>&nbsp;</td>
<td>&nbsp;</td>

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
<td align="right"> </td>
<td  align="right"> <input type="button" name="Limpiar" id="Limpiar" value="Limpiar" onclick="LimpiarTXT();"/> </td>

</tr>
</table>
</form>
</div>
  <div class="footer" align="center">
<form> 
<input type="button" value="Realizar Envio" onclick="ENVIAR();" />
</form>
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