<?php

session_start();

if (isset ($_SESSION['Usuario']))
{require('../coneccion.php');

$paisEmpresa = $_SESSION['Pais'];
$empresaID= $_SESSION['Empresa'];
$usuarioLog=$_SESSION['Usuario'];
$fecha = date('y-m-d h:i:s');
$maquina=gethostname();
if(isset($_POST['Modify']))
{
	
$cod=$_POST["Codigo"];
$nombre=$_POST["Nombre"];
$clasificacion=$_POST["clasificacion"];
$marca =$_POST["Marca"];
$modelo=$_POST["Modelo"];
$proveedor=$_POST["Proveedor"];
$minimos =$_POST["minimos"];
$valorCompra=$_POST["PC"];
$valorVenta =$_POST["PV"];
$medida =$_POST["Medida"];
$ModPrecio=$_POST["CHK"]; 


$Refresh  = "UPDATE `ent_maesprod` SET`Nombre_MaesProd`='$nombre',`IdSocio_MaesProd`='$proveedor',`IdTipoProd_MaesProd`='$clasificacion',`IdUnidMedida_MaesProd`='$medida',`Id_Marca_MaesProd`='$marca',`Modelo_MaesProd`='$marca',`ValorCompra_MaesProd`='$valorCompra',`ValorVenta_MaesProd`='$valorVenta',`SaldoMinimo_MaesProd`='$minimos',`ModificaPrecio_MaesProd`=b'$ModPrecio',`Usuario_MaesProd`='$usuarioLog',`FechaCreacion_MaesProd`='$fecha',`MaqCreacion_MaesProd`='$maquina' WHERE `IdPais_MaesProd`='$paisEmpresa' AND `IdEmpr_MaesProd`='$empresaID' AND `IdProd_MaesProd`='$cod'";
			
			$RespuestaActualizar = $mysqli->query($Refresh);
			
echo json_encode($Refresh);
	
}
?>
<?php	
}
else
{
	 echo "<script> alert('Debes iniciar secion primero.')</script>";
	echo'<script> window.location="Index.HTML"</script>';

}
?>