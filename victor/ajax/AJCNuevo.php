<?php

session_start();

if (isset ($_SESSION['Usuario']))
{require('../coneccion.php');

$paisEmpresa = $_SESSION['Pais'];
$empresaID= $_SESSION['Empresa'];
$usuarioLog=$_SESSION['Usuario'];
$fecha = date('y-m-d h:i:s');
$maquina=gethostname();
$Bodega=$_SESSION['Bodega'];
if(isset($_POST["add"])){

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


$ModPrecio=1; 

			$slqnewp  = "insert into ent_maesprod (IdPais_MaesProd,IdEmpr_MaesProd,CodigoAlt_MaesProd,Nombre_MaesProd,IdSocio_MaesProd,IdTipoProd_MaesProd,IdUnidMedida_MaesProd,Id_Marca_MaesProd,Modelo_MaesProd,ValorCompra_MaesProd,ValorVenta_MaesProd,SaldoMinimo_MaesProd,ModificaPrecio_MaesProd,Estado_MaesProd,Usuario_MaesProd,FechaCreacion_MaesProd,MaqCreacion_MaesProd) values( '$paisEmpresa','$empresaID','$cod' ,'$nombre' ,'$proveedor', '$clasificacion','$medida','$marca', '$modelo' ,'$valorCompra' ,'$valorVenta','$minimos' ,'$ModPrecio',1 ,'$usuarioLog' ,'$fecha','$maquina')"  ;
			
			$RespuestaActualizar = $mysqli->query($slqnewp);
 		echo json_encode($slqnewp);
		
$movProd =mysqli_query($mysqli,"INSERT INTO `ent_movprod` (`Id_Pais_MovProd`, `Id_Empr_MovProd`, `Id_Bode_MovProd`, `IdProd_MovProd`, `SaldoIni_MovProd`, `Entrada_MovProd`, `Salida_MovProd`, `Usuario_MovProd`, `FechaCreacion_MovProd`, `MaqCreacion_MovProd`) VALUES ('$paisEmpresa', '$empresaID', '$Bodega', '$cod', '0', '0', '0', '$usuarioLog', '$fecha', '$maquina')");
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