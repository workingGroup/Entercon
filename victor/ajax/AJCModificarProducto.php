<?php

session_start();

if (isset ($_SESSION['Usuario']))
{require('../coneccion.php');

$paisEmpresa = $_SESSION['Pais'];
$empresaID= $_SESSION['Empresa'];
$usuarioLog=$_SESSION['Usuario'];
$fecha = date('y-m-d h:i:s');
$maquina=gethostname();
if(isset($_POST["ModificarProducto"])){

$cod=$_POST["Codigo"];
	
	$sqlInicio="Select*  from ent_maesprod where IdPais_MaesProd='$paisEmpresa' AND IdEmpr_MaesProd='$empresaID' AND IdProd_MaesProd='$cod'";
	$resInicio=$mysqli->query($sqlInicio);
	while($rowInicio=$resInicio->fetch_assoc()){
		$Codigo=$rowInicio['IdProd_MaesProd'];
		$Nombre=$rowInicio['Nombre_MaesProd'];
		$Minimos=$rowInicio['SaldoMinimo_MaesProd'];
		$ValorCompra=$rowInicio['ValorCompra_MaesProd'];
		$ValorVenta=$rowInicio['ValorVenta_MaesProd'];
		$ModificarPrecio=$rowInicio['ModificaPrecio_MaesProd'];
		$Modelo=$rowInicio['Modelo_MaesProd'];
		////convertir a nombre 
		$Clasificacion=$rowInicio['IdTipoProd_MaesProd'];
		$Marca=$rowInicio['Id_Marca_MaesProd'];
		$Proveedor=$rowInicio['IdSocio_MaesProd'];
		$Medida=$rowInicio['IdUnidMedida_MaesProd'];
		$Usuario=$rowInicio['Usuario_MaesProd'];
		}
		//////////////Clasificacion
			$sqlClasificacion="Select *  from ent_maestipoprod where IdPais_MaesTipoProd='$paisEmpresa' AND IdEmpr_MaesTipoProd='$empresaID' AND Id_MaesTipoProd='$Clasificacion'";
			$resClasificacion=$mysqli->query($sqlClasificacion);
			while($rowClasificacion=$resClasificacion->fetch_assoc()){
				$NombreClasificacion=$rowClasificacion['Nombre_MaesTipoProd'];
				// Marca ,Proveedor Y Medida
				}
					$sqlMarca="Select *  from ent_maesmarca where IdPais_MaesMarca='$paisEmpresa' AND IdEmpr_MaesMarca='$empresaID' AND Id_MaesMarca='$Marca'";
				$resMarca=$mysqli->query($sqlMarca);
				while($rowMarca=$resMarca->fetch_assoc()){
					$NombreMarca=$rowMarca['Nombre_MaesMarca'];
					//  OBTENER EL Proveedor Y 
					}
					
					$sqlProveedor="Select *  from ent_maessocio where Id_MaesPais='$paisEmpresa' AND Id_MaesEmpr='$empresaID' AND Id_Socio='$Proveedor'";
				$resProveedor=$mysqli->query($sqlProveedor);
				while($rowProveedor=$resProveedor->fetch_assoc()){
					$NombreProveedor=$rowProveedor['RazonSocial_MaesSocio'];
					//Medida 
					}
					
					
					$sqlMedida="Select *  from ent_maesunidmedida where IdPais_MaesUnidMedida='$paisEmpresa' AND IdEmpr_MaesUnidMedida='$empresaID' AND Id_MaesUnidMedida='$Medida'";
				$resMedida=$mysqli->query($sqlMedida);
				while($rowMedida=$resMedida->fetch_assoc()){
					$NombreMedida=$rowMedida['Nombre_MaesUnidMedida'];
					//enviar array
					}
 
		echo json_encode(array("Codigo"=>$Codigo,"Nombre"=>$Nombre,"Clasificacion"=>$NombreClasificacion,"Marca"=>$NombreMarca,"Modelo"=>$Modelo,"Proveedor"=>$NombreProveedor,"Minimos"=>$Minimos,"ValorCompra"=>$ValorCompra,"ValorVenta"=>$ValorVenta,"Medida"=>$NombreMedida,"ModificarPrecio"=>$ModificarPrecio,"Usuario"=>$Usuario));		
}
elseif(isset($_POST['Clasificacion'])){
	$ArrayClasificacion=array();
$ClasificacionQuery = "SELECT * FROM ent_maestipoprod where IdPais_MaesTipoProd ='$paisEmpresa' && IdEmpr_MaesTipoProd ='$empresaID'";
	$ResClasificacion = $mysqli->query($ClasificacionQuery);
	while ($rowClasificacio= $ResClasificacion->fetch_assoc())
	{
	$ArrayClasificacion["Clasificacion"][] = array('ID' => $rowClasificacio['Id_MaesTipoProd'],'Nombre'=> $rowClasificacio['Nombre_MaesTipoProd']);
	}	
	echo json_encode($ArrayClasificacion);
}

elseif(isset($_POST['Marca'])){
	$ArrayMarca=array();
$MarcaQuery = "SELECT * FROM ent_maesmarca where IdPais_MaesMarca ='$paisEmpresa' && IdEmpr_MaesMarca ='$empresaID'";
	$ResMarca = $mysqli->query($MarcaQuery);
	while ($rowMarca= $ResMarca->fetch_assoc())
	{
$ArrayMarca["Marca"][] = array('ID' =>$rowMarca['Id_MaesMarca'],'Nombre'=>  $rowMarca['Nombre_MaesMarca']);
	
	}	
	echo json_encode($ArrayMarca);
}

elseif(isset($_POST['Proveedor'])){
	$ArrayProveedor=array();
$ProveedorQuery = "SELECT * FROM ent_maessocio where Id_MaesPais = '$paisEmpresa' && Id_MaesEmpr ='$empresaID' && Tipo_MaesSocio = '2'";
	$ResProv = $mysqli->query($ProveedorQuery);
	while ($rowProv= $ResProv->fetch_assoc())
	{
	$ArrayProveedor["Proveedor"][] = array('ID' =>$rowProv['Id_Socio'],'Nombre'=>$rowProv['RazonSocial_MaesSocio']);
	
	}	
	echo json_encode($ArrayProveedor);
}
elseif(isset($_POST['Medida'])){
$ArrayMedida=array();
$sqlMEDIDA = "SELECT * FROM ent_maesunidmedida where IdPais_MaesUnidMedida ='$paisEmpresa' && IdEmpr_MaesUnidMedida ='$empresaID'";
	$recMEDIDA = $mysqli->query($sqlMEDIDA);
	while ($rowMedida= $recMEDIDA->fetch_assoc())
	{	
	$ArrayMedida["Medida"][] = array('ID' =>$rowMedida['Id_MaesUnidMedida'],'Nombre'=>$rowMedida['Nombre_MaesUnidMedida']);
	
	}	
	echo json_encode($ArrayMedida);
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