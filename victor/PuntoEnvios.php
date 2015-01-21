<?php

session_start();

if (isset ($_SESSION['Usuario']))
{require('coneccion.php');

$paisEmpresa = $_SESSION['Pais'];
$empresaID= $_SESSION['Empresa'];
$usuarioLog=$_SESSION['Usuario'];
$Descuento= $_SESSION['Descuento'];
$BodegaID=$_SESSION['Bodega'];
$BodegaNombre=$_SESSION['BodegaNombre'];

$Role=$_SESSION['Role'];

$Opcion8 =mysqli_query($mysqli,"select * from ent_opcionxrole where IdPais_OpcionXRole='$paisEmpresa' AND IdEmpr_OpcionXRole='$empresaID' and IdRole_OpcionXRole ='$Role' AND IdOpcion_OpcionXRole='10'");
	
			if(mysqli_num_rows($Opcion8) > 0){
			$_SESSION['MAESTRO DE CLIENTES']=1;
		}else { $_SESSION['MAESTRO DE CLIENTES']=0; }
	if($_SESSION['MAESTRO DE CLIENTES']==1){

date_default_timezone_set('America/Guatemala');

$percent= $Descuento;
$_SESSION["porciento"] = $Descuento/100;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html;utf-8" />
<title>Entercon-Envios</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<link href="css/PlantillaPuntoVenta.css" rel="stylesheet" type="text/css" />


<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script type="text/javascript" src="js/jsMantenimientoPuntoenvios.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
</head>

<body>
<div class="container">
  <div class="header">
    <h1> Envios entre Bodegas</h1>
    <input type="text" id="Buscar" />
    <input type="button" onclick="Search();" value="Buscar" />
  </div>
  <div class="content" id="Contenido" >
  
    <form name="formDOC" method="post" id="form1
    DOC" action="">
   <table width="1054" height="166" class="bordes" id="tabla" >

<tr>
<td>Doc#</td><td><?php $unicod =  time();?><input type="text" value="" readonly="readonly" disabled="disabled" id="Correlativo"/></td>

<td align="right"><input type="text" disabled="disabled" readonly="readonly"  name="Doc" id="DOC" value="" hidden=""/>
  Fecha</span></td>
<td>
  <input name="Fecha" type="text" disabled="disabled" value=""  readonly="readonly" id="fecha"/>
</td>
<td class="arriva">&nbsp;</td>
<td>&nbsp;</td>
<td width="89">&nbsp;</td>
<td width="107">&nbsp;</td>
</tr>
<tr>
<td width="145" height="29" class="arriva">Bodega Salida</td>
<td width="145" class="arriva"><input type="text" id="BodSalidaID" readonly="readonly" disabled="disabled" value=""/></td>
<td width="162"><input type="text" name="Series" id="BodSalidaNombre" readonly="readonly" disabled="disabled" value=""/></td>
<td width="161" >&nbsp;</td>
<td width="144"></td>
<td width="65">&nbsp;</td>
<td width="89">&nbsp;</td>
<tr>
<td height="27">Bodega Ingreso</td>
<td>
  <input type="text" name="BodEntradaID" id="BodEntradaID" readonly="readonly" disabled="disabled"/>
</td>

<td><span class="arriva">
  <input type="text" name="BodEntradaNombre" id="BodEntradaNombre" readonly="readonly" disabled="disabled"/>
</span></td>
<td>&nbsp;</td>
<td width="144" > </td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<tr>
<td height="27">Observaciones</td>
<td> <input type="text" name="Obs" id="Obs" disabled="disabled"/></td>
<td> </td>
<td align="right">Usuario</td>
<td><input type="text" id="Usuario" readonly="readonly" disabled="disabled" value=""/></td>
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
<td width="173" ></td>
<td width="268">&nbsp;</td>
<td width="255" id="a"></td>
<td width="144">Total Documento</td>
<td width="144" ><input disabled="disabled" type="text" name="TDoc" value="" id="Tdoc" /></td>

</tr>
</table>
</form>

 <form name="FormEnvio" method="post" id="FormEnvio"  action="" >

</form>
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