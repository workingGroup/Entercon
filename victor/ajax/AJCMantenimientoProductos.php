<?php

session_start();

if (isset ($_SESSION['Usuario']))
{require('../coneccion.php');

$paisEmpresa = $_SESSION['Pais'];
$empresaID= $_SESSION['Empresa'];
$usuarioLog=$_SESSION['Usuario'];


if (isset($_POST['tabla_data'])) {
	$Codigo = $_POST['Codigo'];
$sqlMEDIDA = "SELECT * FROM ent_detunimed where IdPais_DetUniMedida = '$paisEmpresa' && IdEmpr_DetUniMedida = '$empresaID' && Codigo_DetUniMed ='".$Codigo."'";
$recMEDIDA = $mysqli->query($sqlMEDIDA);
$tilde = "'";
	$datos = '
<table class="tabla" border="1" bordercolor="#000000" bgcolor="#ccc">
<tr>
			<td><b>ID</b></td>
 			<td><b>Nombre</b></td>
            <td><b>Relacion</b></td>
            <td><b>Precio Costo</b></td>
            <td><b>Precio Venta</b></td>
            <td><b>Proporcion</b></td>

</tr>
<tbody>';

while($rowMedida=$recMEDIDA->fetch_assoc()){
	$datos .='
<tr>
<td>'.$rowMedida['Id_DetUniMedida'].'</td>
<td id="1">'.$rowMedida['Nombre_DetUniMed'].'</td>
<td id="3">'.$rowMedida['Relacion_DetUniMed'].'</td>
<td id="4">'.$rowMedida['ValUniCo_DetUniMed'].' </td>
<td> '.$rowMedida['ValUniVe_DetUniMed'].'</td>
<td id="5">'.$rowMedida['Proporcion_DetUniMed'].' </td>
<td>
<a  onclick="Eliminar('.$rowMedida['Id_DetUniMedida'].');"><p id="9"><img src="componentes/delete.png"  /></p></a>
</td>
</tr>';
}
$datos .= '
</tbody>
</table>';
echo json_encode($datos);
}


if (isset($_POST['tabla_data2'])) {
	$Codigo = $_POST['Codigo'];
$sqlBodega = "SELECT * FROM ent_movprod where Id_Pais_MovProd = '$paisEmpresa' && Id_Empr_MovProd = '$empresaID' && IdProd_MovProd ='".$Codigo."'";
$recBodega = $mysqli->query($sqlBodega);
$tilde = "'";
	$datos2 = '
<table class="tabla" border="1" bordercolor="#000000" bgcolor="#ccc">
<tr>
			<td><b>ID</b></td>
        <td><b>Bodega</b></td>
        <td><b>Saldo Inicial</b></td>
        <td><b>Entradas</b></td>
        <td><b>Salidas</b></td>
        <td><b>Existencias</b></td>

</tr>
<tbody>';

 while($rowBodega=$recBodega->fetch_assoc()){
	 $Existencias= ($rowBodega['SaldoIni_MovProd']+$rowBodega['Entrada_MovProd'])-$rowBodega['Salida_MovProd'];
	$datos2 .='
<tr>
<td>'.$rowBodega['IdProd_MovProd'].'</td>
<td id="1">'.$rowBodega['Id_Bode_MovProd'].'</td>
<td id="3">'.$rowBodega['SaldoIni_MovProd'].'</td>
<td id="4">'.$rowBodega['Entrada_MovProd'].' </td>
<td> '.$rowBodega['Salida_MovProd'].'</td>
<td id="5">'.$Existencias.' </td>
</tr>';
}
$datos2 .= '
</tbody>
</table>';
echo json_encode($datos2);
}



if(isset($_POST['Eliminar']))
	{
		$ID= $_POST["ID"];
		
			
			$DelQ = "DELETE FROM `ent_detunimed` WHERE  `IdPais_DetUniMedida` ='$paisEmpresa' && `IdEmpr_DetUniMedida` ='$empresaID' && `Id_DetUniMedida`='$ID'";
		$resultado = $mysqli->query($DelQ);
	
	}
if(isset($_POST['Delete']))
	{
		$Codigo= $_POST["DeleteID"];
		
			
			$DelQ = "DELETE FROM `ent_maesprod` WHERE  `IdPais_MaesProd` ='$paisEmpresa' && `IdEmpr_MaesProd` ='$empresaID' && `IdProd_MaesProd`='$Codigo'";
		$resultado = $mysqli->query($DelQ);
		
		$DelDetalleMedida = "DELETE FROM `ent_detunimed` WHERE  `IdPais_DetUniMedida` ='$paisEmpresa' && `IdEmpr_DetUniMedida` ='$empresaID' && `Codigo_DetUniMed`='$Codigo'";
		$resultadoDelMedida = $mysqli->query($DelDetalleMedida);
			
	}	

if(isset($_POST['Buscar'])){
	$valorB=$_POST['VB'];
	
	$sqlInicio="Select*  from ent_maesprod where IdPais_MaesProd='$paisEmpresa' AND IdEmpr_MaesProd='$empresaID' AND IdProd_MaesProd='$valorB' or CodigoAlt_MaesProd='$valorB' or Nombre_MaesProd='$valorB'";
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
		$Estado=$rowInicio['Estado_MaesProd'];
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
 
if ($Estado==0){
 $estatus="Desactivado";}else{$estatus="Activo";}
		echo json_encode(array("Codigo"=>$Codigo,"Nombre"=>$Nombre,"Clasificacion"=>$NombreClasificacion,"Marca"=>$NombreMarca,"Modelo"=>$Modelo,"Proveedor"=>$NombreProveedor,"Minimos"=>$Minimos,"ValorCompra"=>$ValorCompra,"ValorVenta"=>$ValorVenta,"Medida"=>$NombreMedida,"ModificarPrecio"=>$ModificarPrecio,"Usuario"=>$Usuario ,"Estado"=>$estatus));
}

if(isset($_POST['Iniccio'])){
	$sqlValInicio="Select Min(IdProd_MaesProd)as inicio  from ent_maesprod where IdPais_MaesProd='$paisEmpresa' AND IdEmpr_MaesProd='$empresaID' ";
	$resValInicio=$mysqli->query($sqlValInicio);
	while($rowValInicio=$resValInicio->fetch_assoc()){ 
	$valorMin= $rowValInicio['inicio'];}
	
	$sqlInicio="Select*  from ent_maesprod where IdPais_MaesProd='$paisEmpresa' AND IdEmpr_MaesProd='$empresaID' AND IdProd_MaesProd='$valorMin'";
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
		$Estado=$rowInicio['Estado_MaesProd'];
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
 if ($Estado==0){
 $estatus="Desactivado";}else{$estatus="Activo";}
		echo json_encode(array("Codigo"=>$Codigo,"Nombre"=>$Nombre,"Clasificacion"=>$NombreClasificacion,"Marca"=>$NombreMarca,"Modelo"=>$Modelo,"Proveedor"=>$NombreProveedor,"Minimos"=>$Minimos,"ValorCompra"=>$ValorCompra,"ValorVenta"=>$ValorVenta,"Medida"=>$NombreMedida,"ModificarPrecio"=>$ModificarPrecio,"Usuario"=>$Usuario ,"Estado"=>$estatus));
}
if(isset($_POST['Final'])){
	$sqlValInicio="Select MAX(IdProd_MaesProd)as inicio  from ent_maesprod where IdPais_MaesProd='$paisEmpresa' AND IdEmpr_MaesProd='$empresaID' ";
	$resValInicio=$mysqli->query($sqlValInicio);
	while($rowValInicio=$resValInicio->fetch_assoc()){ 
	$valorMin= $rowValInicio['inicio'];}
	
	$sqlInicio="Select*  from ent_maesprod where IdPais_MaesProd='$paisEmpresa' AND IdEmpr_MaesProd='$empresaID' AND IdProd_MaesProd='$valorMin'";
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
		$Estado=$rowInicio['Estado_MaesProd'];
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
 
if ($Estado==0){
 $estatus="Desactivado";}else{$estatus="Activo";}
		echo json_encode(array("Codigo"=>$Codigo,"Nombre"=>$Nombre,"Clasificacion"=>$NombreClasificacion,"Marca"=>$NombreMarca,"Modelo"=>$Modelo,"Proveedor"=>$NombreProveedor,"Minimos"=>$Minimos,"ValorCompra"=>$ValorCompra,"ValorVenta"=>$ValorVenta,"Medida"=>$NombreMedida,"ModificarPrecio"=>$ModificarPrecio,"Usuario"=>$Usuario ,"Estado"=>$estatus));
}
if(isset($_POST['Previo']))
{
	$IDproducto=$_POST['IDprod'];
	$sqlInicio="Select*  from ent_maesprod where IdPais_MaesProd='$paisEmpresa' AND IdEmpr_MaesProd='$empresaID' AND IdProd_MaesProd< '$IDproducto'";
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
		$Estado=$rowInicio['Estado_MaesProd'];
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
if ($Estado==0){
 $estatus="Desactivado";}else{$estatus="Activo";}
		echo json_encode(array("Codigo"=>$Codigo,"Nombre"=>$Nombre,"Clasificacion"=>$NombreClasificacion,"Marca"=>$NombreMarca,"Modelo"=>$Modelo,"Proveedor"=>$NombreProveedor,"Minimos"=>$Minimos,"ValorCompra"=>$ValorCompra,"ValorVenta"=>$ValorVenta,"Medida"=>$NombreMedida,"ModificarPrecio"=>$ModificarPrecio,"Usuario"=>$Usuario ,"Estado"=>$estatus));
}

if(isset($_POST['Siguiente']))
{
	$IDproducto=$_POST['IDprod'];

	
	$sqlInicio="Select*  from ent_maesprod where IdPais_MaesProd='$paisEmpresa' AND IdEmpr_MaesProd='$empresaID' AND IdProd_MaesProd >'$IDproducto' limit 1";
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
		$Estado=$rowInicio['Estado_MaesProd'];
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
 
	if ($Estado==0){
 $estatus="Desactivado";}else{$estatus="Activo";}
		echo json_encode(array("Codigo"=>$Codigo,"Nombre"=>$Nombre,"Clasificacion"=>$NombreClasificacion,"Marca"=>$NombreMarca,"Modelo"=>$Modelo,"Proveedor"=>$NombreProveedor,"Minimos"=>$Minimos,"ValorCompra"=>$ValorCompra,"ValorVenta"=>$ValorVenta,"Medida"=>$NombreMedida,"ModificarPrecio"=>$ModificarPrecio,"Usuario"=>$Usuario ,"Estado"=>$estatus));
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