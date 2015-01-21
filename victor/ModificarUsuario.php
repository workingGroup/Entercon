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
<title>Modificar Usuario</title>
<link href="css/PlantillaMantenimientoUsuarios.css" rel="stylesheet" type="text/css" />
<style type="text/css">

</style>
</head>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script type="text/javascript" src="js/jsNuevoUsuario.js"></script>

<body>

<div class="container">
  <div class="header">
    <h1>Modificar Usuario</h1>
  </div>
  <div class="content" id="Contenido">
  <form name="form1" action="">
  <table width="697">
  <tr>
  <td width="113">ID</td> 
  <td width="185"><input type="text" id="ID" readonly="readonly" disabled="disabled" value="<?php echo $_GET['Id']?>"/></td> 
  <td width="161" >Descuento</td> 
  <td width="218"><input type="text" id="Descuento" value="<?php echo $_GET['Descuento']?>" /></td> 
  </tr>
    <tr>
  <td>Nombre</td> 
  <td><input type="text" id="Nombre" value="<?php echo $_GET['Nombre'];?> "/></td> 
  <td>Nombre de Usuario</td> 
  <td><input type="text" id="Usuario" value="<?php echo $_GET['Usuario']?>"/></td> 
 
  </tr>
     <tr>
  <td>Contraseña</td> 
  <td><input type="text" id="Contraseña" placeholder="Dejar vacio para no modificar" title="Dejar vacio para no modificar"/></td> 
 <td>Role</td> 
  <td><select id="Role" onblur="RoleSV();"></select></td> 
  </tr>
  </table>
  <p>&nbsp;</p>
  </form>
  </div>
   
  <div  align="center" class="footer">
<form>
     <table width="auto" height="36" bgcolor="#CCCCCC">
      <tr>
       
      <td width="224" align="right">&nbsp;</td>
      <td width="51">&nbsp;</td>
      <td width="69">&nbsp;</td>
      <td width="43">&nbsp;</td>
      <td width="65"><input class="bordes" type="button" value="Agregar" onclick="ModifyingValue();"/></td>
      <td width="62">&nbsp;</td>
      <td width="68">&nbsp;</td>
      <td width="62">&nbsp;</td>
      <td width="248">&nbsp;</td>
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