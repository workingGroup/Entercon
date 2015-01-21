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
<title>Mantenimiento Usuario</title>
<link href="css/PlantillaMantenimientoUsuarios.css" rel="stylesheet" type="text/css" />
<style type="text/css">

</style>
</head>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script type="text/javascript" src="js/jsMantenimientoUsuario.js"></script>

<body>

<div class="container">
  <div class="header">
    <h1>Mantenimiento Usuario</h1>
    <form>
    <input type="search" id="Buscar"/>
    <input type="button" value="Buscar" />
  </form>
  </div>
  <div class="content" id="Contenido">
  <form name="form1" action="">
  <table width="697">
  <tr>
  <td width="113">ID</td> 
  <td width="185"><input type="text" id="ID" readonly="readonly"/></td> 
  <td width="161" >Descuento</td> 
  <td width="218"><input type="text" id="Descuento" readonly="readonly"/></td> 
  </tr>
    <tr>
  <td>Nombre</td> 
  <td><input type="text" id="Nombre" readonly="readonly"/></td> 
  <td>Nombre de Usuario</td> 
  <td><input type="text" id="Usuario" readonly="readonly"/></td> 
 
  </tr>
     <tr>
  <td>Contraseña</td> 
  <td><input type="password" id="Contraseña" readonly="readonly"/></td> 
 <td>Role</td> 
  <td><input type="text" id="Role" readonly="readonly"/></td> 
  </tr>
  </table>
  <p>&nbsp;</p>
  <table>
  <tr>
  	<td>Usuario</td>
    <td ><input type="text" id="UsuarioCrecion" readonly="readonly"/></td>
    <td>Fecha</td>
    <td><input type="text" id="FechaCreacion" readonly="readonly"/></td>
    <td>Maquina</td>
    <td><input type="text" id="MaquinaCreacion" readonly="readonly" onclick="Inicio();"/></td>
  </tr>
  </table>
  </form>
  </div>
   
  <div  align="center" class="footer">
<form>
     <table width="auto" height="36" bgcolor="#CCCCCC">
      <tr>
       
      <td width="224" align="right"><input class="bordes" type="button" value="inicio" onclick="Inicio();"/></td>
      <td width="51"><input class="bordes" type="button" value="Previo" onclick="Previo();"/ /></td>
      <td width="69"><input class="bordes" type="button" value="Siguiente" onclick="Siguiente();"/ /></td>
      <td width="43"><input class="bordes" type="button" value="Final" onclick="Final();"/></td>
      <td width="65"><input class="bordes" type="button" value="Imprimir" onclick="printcontent('Contenido');"/></td>
      <td width="62"><input class="bordes" type="button" value="Agregar"/></td>
      <td width="68"><input class="bordes"type="button" value="Modificar" /></td>
      <td width="62"><input class="bordes" type="button" value="Eliminar" /></td>
      <td width="248"><input class="bordes"type="button" value="Salir" /></td>
      </tr>
    </table>
  </form>
  </div>
  
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