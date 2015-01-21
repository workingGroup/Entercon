<?php

session_start();

if (isset ($_SESSION['Usuario']))
{require('coneccion.php');

$paisEmpresa = $_SESSION['Pais'];	
$empresaID= $_SESSION['Empresa'];	
$usuarioLog=$_SESSION['Usuario'];
$Role=$_SESSION['Role'];

$Opcion8 =mysqli_query($mysqli,"select * from ent_opcionxrole where IdPais_OpcionXRole='$paisEmpresa' AND IdEmpr_OpcionXRole='$empresaID' and IdRole_OpcionXRole ='$Role' AND IdOpcion_OpcionXRole='16'");
	
			if(mysqli_num_rows($Opcion8) > 0){
			$_SESSION['SALDO PROVEDORES']=1;
		}else { $_SESSION['SALDO PROVEDORES']=0; }
	if($_SESSION['SALDO PROVEDORES']==1){

	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>entercon-Cuentas Por cobrar</title>
<link href="css/PlantillaSaldoProveedores.css" rel="stylesheet" type="text/css" />
<style type="text/css">

</style>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script type="text/javascript" src="js/jsSaldoProveedor.js"></script>
</head>
<body>

<div class="container">
  <div class="header">
    <h1>Saldo de Proveedores</h1>
  </div>
  <div class="content">
    <div id="TabbedPanels1" class="TabbedPanels">
      <ul class="TabbedPanelsTabGroup">
        <li class="TabbedPanelsTab" tabindex="0">Saldos Proveedores</li>
        <li class="TabbedPanelsTab" tabindex="0">Resibos de Facturas</li>
      </ul>
      <div class="TabbedPanelsContentGroup">
        <div class="TabbedPanelsContent">
        <form id="form3" name="form3" method="POST" action=""> 
       <table width="976"> 
       <tr>
       <!-- encabezado tabla  -->
       <td width="86" height="48">Codigo</td>
       <td width="170">
   <select id="Codigo" onblur="selectedValue();"></select>
        </td>
      
       <td width="101" align="right"> <input type="checkbox" name="FacturasPagadas" id="Chk" onchange="ChkFacturas();"/></td>
       <td width="235">Ver Facturas Pagadas ?</td>
       </tr>
       </table>
        </form>
        <div id="Tabla">
      
    </div>
        </div>
        <div class="TabbedPanelsContent"><div id="Recibo"></div></div>
      </div>
    </div>
  </div>
  <!-- end .container --></div>
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
</script>
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