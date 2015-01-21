<?php
session_start();
require_once ('coneccion.php');
if (isset ($_SESSION['Usuario']))
{
$empresaID= $_SESSION['Empresa'];	
$Pais = $_SESSION['Pais'];	
$consultaEmpresa = mysqli_query($mysqli, "SELECT Nombre_MaesEmpr FROM ent_maesempr WHERE Id_MaesEmpr = '$empresaID' && Id_MaesPais ='$Pais' ");
while($row=$consultaEmpresa->fetch_assoc()){
$NombreEmpresa = $row['Nombre_MaesEmpr'];
}
$IDBodega=$_SESSION['Bodega'];
$Bodega =mysqli_query($mysqli,"select * from ent_maesbode where Id_MaesPais='$Pais' AND Id_MaesEmpr='$empresaID' AND Id_MaesBode='$IDBodega'");
	$rowBodega=$Bodega->fetch_assoc();
	$_SESSION['BodegaNombre']=$rowBodega['Nombre_MaesBode'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home</title>
<link href="css/PaginaPrincipal.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#MenuBar1 li .MenuBarItemSubmenu {

	margin-left:5px;
	background-color:#fff ;
	border-bottom:#FFF; 
	border-bottom-right-radius:15px ;
	border-top-right-radius:15px; 
	border-bottom-left-radius:15px ;
	border-top-left-radius:15px; 
	color :#000;
	
}

</style>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>


<script>
 
function bigImg(x) {
    x.style.height = "70px";
    x.style.width = "70px";
	$("#exit").attr("src","componentes/exit.png");
}

function normalImg(x) {
    x.style.height = "64px";
    x.style.width = "64px";
	$("#exit").attr("src","componentes/exitRed.png");
}
</script>
</head>
<body class="body">

<div class="container">
<div class="header">
<div id="imagen"><img src="componentes/client.png" width="64" height="64" />
<label><strong>Empresa:</strong> <?php  echo $NombreEmpresa ;?>|<strong>Usuario :</strong>  <?php echo $_SESSION["Usuario"]?>|<strong>Bodega:</strong><?php echo $_SESSION['BodegaNombre'];?> </label>
<div class="fltrt">
<button title="Cerrar Secion"><img id="exit" onmouseover="bigImg(this)" onmouseout="normalImg(this)" src="componentes/exitRed.png"width="64" height="64" /></button>
</div>
</div>

  <div class="titulo" align="center">
  <ul id="MenuBar1" class="MenuBarHorizontal">
      <li><a class="MenuBarItemSubmenu" href="#">Producto</a>
      <ul class="bordes">
        <li><a href="Mantenimiento.php" target="iframe_a">Configuraciones Generales</a></li>
        <li>  <a href="MantenimientoProductos.php" target="iframe_a">Productos</a></li>
        <li><a href="MantenimientoMarcas.php" target="iframe_a">Marcas</a></li>
        <li><a href="MantenimientoBodegas.php" target="iframe_a">Bodegas</a></li>
        <li><a href="MantenimientoTiposProducto.php" target="iframe_a">Tipo de Producto</a></li>
        <li><a href="MantenimientoTiposPago.php" target="iframe_a">Tipo Pago</a></li>
        <li><a href="MantenimientoUnidadMedida.php" target="iframe_a">Unidad Medida</a></li>
        <li><a href="#" class="MenuBarItemSubmenu">Reportes</a>
          <ul>
            <li><a href="RProductos.php">De Productos</a></li>
            <li><a href="#">Inventario Fisico</a></li>
            <li><a href="#">Movimientos</a></li>
            <li><a href="#">Estadistico</a></li>
            <li><a href="#">Ventas y Costo Venta</a></li>
            <li><a href="#">Productos Por Marca</a></li>
            <li><a href="#">Productos Generales</a></li>
          </ul>
        </li>
        <li><a href="LogOUT.php">Salida</a></li>
      </ul>
    </li>
    <li><a href="#" class="MenuBarItemSubmenu">Clientes</a>
      <ul>
        <li><a href="MantenimientoClientes.php" target="iframe_a">Clientes</a></li>
        <li><a href="PuntoDeVentados.php" target="iframe_a">Ventas</a></li>
        <li><a href="EnviosBodegas.php" target="iframe_a">Envios a Bodegas</a></li>
        <li><a href="Facturas.php" target="iframe_a">Reimpresion/Anulacion</a></li>
        <li><a href="SaldoClientes.php" target="iframe_a">Cuentas Por Cobrar</a></li>
        <li><a href="#">Ajuste Inventario</a></li>
        <li><a href="#" class="MenuBarItemSubmenu">Reportes</a>
          <ul>
            <li><a href="#"> De Clientes</a></li>
            <li><a href="#">Saldo Antiguedad</a></li>
            <li><a href="#">Aplicacion Pagos</a></li>
            <li><a href="#">Venta Diaria</a></li>
            <li><a href="#">Comisiones</a></li>
            <li><a href="#">Corte Diario</a></li>
            <li><a href="#">Facturas/Envios</a></li>
            <li><a href="#">Envios Pendientes Pago</a></li>
            <li><a href="#">Ventas/Salidas</a></li>
          </ul>
        </li>
      </ul>
    </li>
    <li><a class="MenuBarItemIE" href="#">Proveedores</a>
      <ul>
        <li><a class="MenuBarItemSubmenu" href="MantenimientoProveedores.php" target="iframe_a">Proveedores</a>
          <ul>
            <li><a href="#">Elemento 3.1.1</a></li>
            <li><a href="#">Elemento 3.1.2</a></li>
          </ul>
        </li>
        <li><a href="PuntoCompra.php" target="iframe_a">Compras</a></li>
        <li><a href="SaldoProveedores.php" target="iframe_a">Cuentas Por Pagar</a></li>
        <li><a href="#" class="MenuBarItemSubmenu">Reportes</a>
          <ul>
            <li><a href="#">De Proveedores</a></li>
            <li><a href="#">Saldo Antiguedad</a></li>
            <li><a href="#">Compras Altas</a></li>
          </ul>
        </li>
      </ul>
    </li>
    <li><a href="#" class="MenuBarItemIE">Herramientas</a>
      <ul>
        <li><a href="#">Actualizar</a></li>
        <li><a href="#">Cierre Mes</a></li>
        <li><a href="#">Transferencia Datos</a></li>
        <li><a href="#" class="MenuBarItemSubmenu">Vitacora de errores</a>
          <ul>
            <li><a href="#">Elemento sin título</a></li>
          </ul>
        </li>
        <li><a href="#">Configuracion Impresora</a></li>
        <li><a href="#">Usuarios</a></li>
        <li><a href="#">Perfiles</a></li>
        <li><a href="#">Opcion a Perfil</a></li>
        <li><a href="#">Mantenimiento BD</a></li>
      </ul>
    </li>
  <li><a href="#" class="MenuBarItemSubmenu">Ayuda</a></li></ul>
   </div>

</div>
  <p class="titulo">&nbsp;</p>
  <div class="sidebar1">
    <ul class="nav">
      <?php if ($empresaID =="1"){ ?>
      <li><a  href="MantenimientoClientes.php" target="iframe_a"><em><img src="componentes/client.png" width="64" height="64" />Clientes</a></li>
      <?php } ?>
      <li><a href="MantenimientoProveedores.php" target="iframe_a"><em><img src="componentes/Provider.png" width="64" height="64" />Proveedores</a></li>
       <li><a href="PuntoDeVentaDos.php" target="iframe_a"><em><img src="componentes/sale.png" width="64" height="51" />Ventas</a></li>
      <li><a href="MantenimientoProductos.php" target="iframe_a"><em><img src="componentes/productos1.png" width="64" height="64" />Productos</a></li>
      
      <li><a href="PuntoCompra.php" target="iframe_a"><em><img src="componentes/shopping.png" width="64" height="51" />Compras</a></li>
      <li><a href="PuntoEnvios.php" target="iframe_a"><em><img src="componentes/sendProduct.png" width="64" height="64" />Envios</a></li>
      <li><a href="#"><em><img src="componentes/users.png" width="64" height="64" />usuarios</a></li>
    </ul>
    <p>&nbsp;</p>
  <!-- end .sidebar1 --></div>
  
     <div id="content" class="content" >
    <iframe width="1180px" class="bordeDerecho" height="1000px" src="" name="iframe_a"></iframe>
    </div>
     <div class="footer">
  powered by abnerDLC
  </div>
</div>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
  </script>
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