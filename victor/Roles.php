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
<title>Edicion de roles</title>
<link href="css/PlantillaRoles.css" rel="stylesheet" type="text/css" />
<style type="text/css">

</style>
</head>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script type="text/javascript" src="js/ConjuntoCHK.js"> </script>
<body>

<div class="container">
  <div class="header">
    <h1> <font color="#fff" > Edicion de roles </font></h1>
  </div>
  <div class="content">
<form name="form1" id="form1" action="">
<select name="Clasificacion" id="Roles" onblur="RoleSelectedV();">
      </select>
<table> 
<tr>
<tr><td></td><td></td>
<td>Agregar</td>
<td>Modificar y eliminar</td>
<td>Todo</td>
</tr>
<td><input type="checkbox" name="1" id="1"/> </td>
<td>Configuracion General</td>

<td><input type="checkbox" name="1" id="11" value="1" /></td>
<td><input type="checkbox" name="1" id="111" value="1" /></td>
<td><input type="checkbox" name="1" id="1111" value="1" /></td>



</tr>

<tr>
<td><input type="checkbox" name="2" id="2"  /> </td>
<td>Maestro de Productos</td>

<td><input type="checkbox" name="2" id="22"  /></td>
<td><input type="checkbox" name="2" id="222"  /></td>
<td><input type="checkbox" name="2" id="2222"  /></td>

</tr>

<tr>
<td><input type="checkbox" name="3" id="3" /> </td>
<td>Maestro Marcas</td>

<td><input type="checkbox" name="3" id="33" /></td>
<td><input type="checkbox" name="3" id="333" /></td>
<td><input type="checkbox" name="3" id="3333" /></td>

</tr>

<tr>
<td><input type="checkbox" name="4" id="4" /> </td>
<td>Maestro de Bodegas</td>

<td><input type="checkbox" name="4" id="44" /></td>
<td><input type="checkbox" name="4" id="444" /></td>
<td><input type="checkbox" name="4" id="4444" /></td>

</tr>

<tr>
<td><input type="checkbox" name="5" id="5"  /> </td>
<td>Tipo de Productos</td>

<td><input type="checkbox" name="5" id="55"  /></td>
<td><input type="checkbox" name="5" id="555"  /></td>
<td><input type="checkbox" name="5" id="5555"  /></td>

</tr>

<tr>
<td><input type="checkbox" name="6" id="6"  /> </td>
<td>Unidad de Medida</td>

<td><input type="checkbox" name="6" id="66"  /> </td>
<td><input type="checkbox" name="6" id="666"  /> </td>
<td><input type="checkbox" name="6" id="6666"  /> </td>


</tr>

<tr>
<td><input type="checkbox" name="7" id="7"  /> </td>
<td>Reportes de Productos</td>

<td><input type="checkbox" name="7" id="77"  /> </td>
<td><input type="checkbox" name="7" id="777"  /> </td>
<td><input type="checkbox" name="7" id="7777"  /> </td>
</tr>

<tr>
<td><input type="checkbox" name="8" id="8"  /> </td>
<td>Maestro de Clientes</td>

<td><input type="checkbox" name="8" id="88"  /></td>
<td><input type="checkbox" name="8" id="888"  /></td>
<td><input type="checkbox" name="8" id="8888"  /></td>
</tr>

<tr>
<td height="31"><input type="checkbox" name="9" id="9"  /> </td>
<td>Ventas</td>

<td><input type="checkbox" name="9" id="99"  /></td>
<td><input type="checkbox" name="9" id="999"  /></td>
<td><input type="checkbox" name="9" id="9999"  /></td>
</tr>

<tr>
<td><input type="checkbox" name="10" id="10"  /> </td>
<td>Envio entre Bodegas</td>

<td><input type="checkbox" name="10" id="100"  /></td>
<td><input type="checkbox" name="10" id="1000"  /></td>
<td><input type="checkbox" name="10" id="10000"  /></td>
</tr>
<tr><td><input type="checkbox" name="11" id="11"  /></td><td>Reimprecion / Anulacion facturas</td>
<td><input type="checkbox" name="11" id="111000"  /></td>
<td><input type="checkbox" name="11" id="1100"  /></td>
<td><input type="checkbox" name="11" id="11000"  /></td>
</tr>
<tr>
  <td><input type="checkbox" name="12" id="12"  /></td>
  <td>Saldo Individual</td>
<td><input type="checkbox" name="12" id="120"  /></td>
<td><input type="checkbox" name="12" id="1200"  /></td>
<td><input type="checkbox" name="12" id="12000"  /></td>
  </tr>
<tr>
  <td><input type="checkbox" name="13" id="13"  /></td>
  <td>Reportes Clientes</td>
 <td><input type="checkbox" name="13" id="130"  /></td>
 <td><input type="checkbox" name="13" id="1300"  /></td>
 <td><input type="checkbox" name="13" id="13000"  /></td>
</tr>
<tr>
  <td><input type="checkbox" name="14" id="14"  /></td>
  <td>Proveedores</td>
<td><input type="checkbox" name="14" id="140"  /></td>
<td><input type="checkbox" name="14" id="1400"  /></td>
<td><input type="checkbox" name="14" id="14000"  /></td>
</tr>
<tr>
  <td><input type="checkbox" name="15" id="15"  /></td>
  <td>Compras</td>
  <td><input type="checkbox" name="15" id="150"  /></td>
  <td><input type="checkbox" name="15" id="1500"  /></td>
  <td><input type="checkbox" name="15" id="15000"  /></td>
  </tr>
<tr>
  <td><input type="checkbox" name="16" id="16"  /></td>
  <td>Saldo Proveedores</td>
<td><input type="checkbox" name="16" id="160"  /></td>
<td><input type="checkbox" name="16" id="1600"  /></td>
<td><input type="checkbox" name="16" id="16000"  /></td>
  </tr>
<tr>
  <td><input type="checkbox" name="17" id="17"  /></td>
  <td>Reportes Proveedores</td>
<td><input type="checkbox" name="17" id="170"  /></td>
<td><input type="checkbox" name="17" id="1700"  /></td>
<td><input type="checkbox" name="17" id="17000"  /></td>
  </tr>
<tr>
  <td><input type="checkbox" name="18" id="18"  /></td>
  <td>Copia de seguridad</td>
<td><input type="checkbox" name="18" id="180"  /></td>
<td><input type="checkbox" name="18" id="1800"  /></td>
<td><input type="checkbox" name="18" id="18000"  /></td>
</tr>
<tr>
<td><input type="checkbox" name="19" id="19"  /></td>
  <td>Actualizar</td>
<td><input type="checkbox" name="19" id="190"  /></td>
<td><input type="checkbox" name="19" id="1900"  /></td>
<td><input type="checkbox" name="19" id="19000"  /></td>
  </tr>
<tr>
<td><input type="checkbox" name="20" id="20"  /></td>
<td>Cierre de mes</td>
<td><input type="checkbox" name="20" id="200"  /></td>
<td><input type="checkbox" name="20" id="2000"  /></td>
<td><input type="checkbox" name="20" id="20000"  /></td>
</tr>
<tr>
<td><input type="checkbox" name="21" id="21"  /></td>
<td>Vitacora de errores</td>
<td><input type="checkbox" name="21" id="210"  /></td>
<td><input type="checkbox" name="21" id="2100"  /></td>
<td><input type="checkbox" name="21" id="21000"  /></td>
</tr>
<tr>
<td><input type="checkbox" name="22" id="22"  /></td>
<td>Configuracion de Impresoras</td>
<td><input type="checkbox" name="22" id="220"  /></td>
<td><input type="checkbox" name="22" id="2200"  /></td>
<td><input type="checkbox" name="22" id="22000"  /></td>
</tr>
<tr>
<td><input type="checkbox" name="23" id="23"  /></td>
<td>Usuarios</td>
<td><input type="checkbox" name="23" id="230"  /></td>
<td><input type="checkbox" name="23" id="2300"  /></td>
<td><input type="checkbox" name="23" id="23000"  /></td>
</tr>
<tr>
<td><input type="checkbox" name="24" id="24"  /></td>
<td>Mantenimiento BD</td>
<td><input type="checkbox" name="24" id="240"  /></td>
<td><input type="checkbox" name="24" id="2400"  /></td>
<td><input type="checkbox" name="24" id="24000"  /></td>
</tr>
<tr>
<td><input type="checkbox" name="25" id="25"  /></td>
<td>Permisos a Usuarios</td>
<td><input type="checkbox" name="25" id="250"  /></td>
<td><input type="checkbox" name="25" id="2500"  /></td>
<td><input type="checkbox" name="25" id="25000"  /></td>
</tr>

</table>
<p> </p>

</form>
  </div>
   
   
  <div  align="center" class="footer">
  <input type="button" value="Guardar" onclick="GettingVariable();" />
  </div>
  
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