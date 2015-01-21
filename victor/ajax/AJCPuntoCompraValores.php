<?php

session_start();

if (isset ($_SESSION['Usuario']))
{require('../coneccion.php');

$paisEmpresa = $_SESSION['Pais'];
$empresaID= $_SESSION['Empresa'];
$usuarioLog=$_SESSION['Usuario'];

if(isset($_POST['Inicio'])){
	$sqlValInicio="Select Min(Documento_Documento)as inicio  from ent_documento where IdPais_Documento='$paisEmpresa' AND IdEmpr_Documento='$empresaID' AND IdTipoDoc_Documento=2";
	$resValInicio=$mysqli->query($sqlValInicio);
	while($rowValInicio=$resValInicio->fetch_assoc()){ 
	$valorMin= $rowValInicio['inicio'];}
	
	$sqlInicio="Select*  from ent_documento where IdPais_Documento='$paisEmpresa' AND IdEmpr_Documento='$empresaID' AND IdTipoDoc_Documento=2 AND Documento_Documento='$valorMin'";
	$resInicio=$mysqli->query($sqlInicio);
	while($rowInicio=$resInicio->fetch_assoc()){
		$Documento=$rowInicio['Documento_Documento'];
		$Fecha=$rowInicio['Fecha_Documento'];
		$observaciones=$rowInicio['Observaciones_Documento'];
		$UsuarioDocumento=$rowInicio['Usuario_Documento'];
		//CONVERTIR ID CODIGO , TIPO PAGO Y OBTENER EL NOMBRE DE BODEGA
		
		$Codigo=$rowInicio['Codigo_Documento'];
		$TipoPago=$rowInicio['IdTipoPago_Documento'];
		$BodegaID=$rowInicio['IdBodEnt_Documento'];
		$Total = $rowInicio['SaldoFinal_Documento'];
		$Correlativo=$rowInicio['Correlativo'];
		}
		//////////////Codigo
			$sqlCodigo="Select *  from ent_maessocio where Id_MaesPais='$paisEmpresa' AND Id_MaesEmpr='$empresaID' AND Id_Socio='$Codigo'";
			$resCodigo=$mysqli->query($sqlCodigo);
			while($rowCodigo=$resCodigo->fetch_assoc()){
				$NombreCodigo=$rowCodigo['RazonSocial_MaesSocio'];
				// TIPO PAGO Y OBTENER EL NOMBRE DE BODEGA
				}
					$sqlTP="Select *  from ent_maestipopago where IdPais_MaesTipoPago='$paisEmpresa' AND IdEmpresa_MaesTipoPago='$empresaID' AND Id_MaesTipoPago='$TipoPago'";
				$resTP=$mysqli->query($sqlTP);
				while($rowTP=$resTP->fetch_assoc()){
					$NombreTP=$rowTP['Nombre_MaesTipoPago'];
					//  OBTENER EL NOMBRE DE BODEGA
					}
					
					$sqlBOD="Select *  from ent_maesbode where Id_MaesPais='$paisEmpresa' AND Id_MaesEmpr='$empresaID' AND Id_MaesBode='$BodegaID'";
				$resBOD=$mysqli->query($sqlBOD);
				while($rowBOD=$resBOD->fetch_assoc()){
					$NombreBodega=$rowBOD['Nombre_MaesBode'];
					//enviar array
					}
		
		echo json_encode(array("Documento"=>$Documento,"Fecha"=>$Fecha,"IDCodigo"=>$Codigo,"Codigo"=>$NombreCodigo,"IDtp"=>$TipoPago,"TipoPago"=>$NombreTP,"BodegaIngresoID"=>$BodegaID,"BodegaIngresoNombre"=>$NombreBodega,"Observaciones"=>$observaciones,"usuario"=>$UsuarioDocumento,"Total"=>$Total,"Correlativo"=>$Correlativo));
}
elseif(isset($_POST['Final'])){
	$sqlValInicio="Select MAX(Documento_Documento)as inicio  from ent_documento where IdPais_Documento='$paisEmpresa' AND IdEmpr_Documento='$empresaID' AND IdTipoDoc_Documento=2";
	$resValInicio=$mysqli->query($sqlValInicio);
	while($rowValInicio=$resValInicio->fetch_assoc()){ 
	$valorMin= $rowValInicio['inicio'];}
	
	$sqlInicio="Select*  from ent_documento where IdPais_Documento='$paisEmpresa' AND IdEmpr_Documento='$empresaID' AND IdTipoDoc_Documento=2 AND Documento_Documento='$valorMin'";
	$resInicio=$mysqli->query($sqlInicio);
	while($rowInicio=$resInicio->fetch_assoc()){
		$Documento=$rowInicio['Documento_Documento'];
		$Fecha=$rowInicio['Fecha_Documento'];
		$observaciones=$rowInicio['Observaciones_Documento'];
		$UsuarioDocumento=$rowInicio['Usuario_Documento'];
		//CONVERTIR ID CODIGO , TIPO PAGO Y OBTENER EL NOMBRE DE BODEGA
		
		$Codigo=$rowInicio['Codigo_Documento'];
		$TipoPago=$rowInicio['IdTipoPago_Documento'];
		$BodegaID=$rowInicio['IdBodEnt_Documento'];
		$Total = $rowInicio['SaldoFinal_Documento'];
		$Correlativo=$rowInicio['Correlativo'];
		}
		//////////////Codigo
			$sqlCodigo="Select *  from ent_maessocio where Id_MaesPais='$paisEmpresa' AND Id_MaesEmpr='$empresaID' AND Id_Socio='$Codigo'";
			$resCodigo=$mysqli->query($sqlCodigo);
			while($rowCodigo=$resCodigo->fetch_assoc()){
				$NombreCodigo=$rowCodigo['RazonSocial_MaesSocio'];
				// TIPO PAGO Y OBTENER EL NOMBRE DE BODEGA
				}
					$sqlTP="Select *  from ent_maestipopago where IdPais_MaesTipoPago='$paisEmpresa' AND IdEmpresa_MaesTipoPago='$empresaID' AND Id_MaesTipoPago='$TipoPago'";
				$resTP=$mysqli->query($sqlTP);
				while($rowTP=$resTP->fetch_assoc()){
					$NombreTP=$rowTP['Nombre_MaesTipoPago'];
					//  OBTENER EL NOMBRE DE BODEGA
					}
					
					$sqlBOD="Select *  from ent_maesbode where Id_MaesPais='$paisEmpresa' AND Id_MaesEmpr='$empresaID' AND Id_MaesBode='$BodegaID'";
				$resBOD=$mysqli->query($sqlBOD);
				while($rowBOD=$resBOD->fetch_assoc()){
					$NombreBodega=$rowBOD['Nombre_MaesBode'];
					//enviar array
					}
		
		echo json_encode(array("Documento"=>$Documento,"Fecha"=>$Fecha,"IDCodigo"=>$Codigo,"Codigo"=>$NombreCodigo,"IDtp"=>$TipoPago,"TipoPago"=>$NombreTP,"BodegaIngresoID"=>$BodegaID,"BodegaIngresoNombre"=>$NombreBodega,"Observaciones"=>$observaciones,"usuario"=>$UsuarioDocumento,"Total"=>$Total,"Correlativo"=>$Correlativo));
}
elseif(isset($_POST['Previo']))
{
$IDocumento=$_POST['Idocumento'];
	
	$sqlInicio="Select*  from ent_documento where IdPais_Documento='$paisEmpresa' AND IdEmpr_Documento='$empresaID' AND IdTipoDoc_Documento=2 AND Documento_Documento< '$IDocumento' limit 1";
	$resInicio=$mysqli->query($sqlInicio);
	while($rowInicio=$resInicio->fetch_assoc()){
		$Documento=$rowInicio['Documento_Documento'];
		$Fecha=$rowInicio['Fecha_Documento'];
		$observaciones=$rowInicio['Observaciones_Documento'];
		$UsuarioDocumento=$rowInicio['Usuario_Documento'];
		//CONVERTIR ID CODIGO , TIPO PAGO Y OBTENER EL NOMBRE DE BODEGA
		
		$Codigo=$rowInicio['Codigo_Documento'];
		$TipoPago=$rowInicio['IdTipoPago_Documento'];
		$BodegaID=$rowInicio['IdBodEnt_Documento'];
		$Total = $rowInicio['SaldoFinal_Documento'];
		$Correlativo=$rowInicio['Correlativo'];
		}
		//////////////Codigo
			$sqlCodigo="Select *  from ent_maessocio where Id_MaesPais='$paisEmpresa' AND Id_MaesEmpr='$empresaID' AND Id_Socio='$Codigo'";
			$resCodigo=$mysqli->query($sqlCodigo);
			while($rowCodigo=$resCodigo->fetch_assoc()){
				$NombreCodigo=$rowCodigo['RazonSocial_MaesSocio'];
				// TIPO PAGO Y OBTENER EL NOMBRE DE BODEGA
				}
					$sqlTP="Select *  from ent_maestipopago where IdPais_MaesTipoPago='$paisEmpresa' AND IdEmpresa_MaesTipoPago='$empresaID' AND Id_MaesTipoPago='$TipoPago'";
				$resTP=$mysqli->query($sqlTP);
				while($rowTP=$resTP->fetch_assoc()){
					$NombreTP=$rowTP['Nombre_MaesTipoPago'];
					//  OBTENER EL NOMBRE DE BODEGA
					}
					
					$sqlBOD="Select *  from ent_maesbode where Id_MaesPais='$paisEmpresa' AND Id_MaesEmpr='$empresaID' AND Id_MaesBode='$BodegaID'";
				$resBOD=$mysqli->query($sqlBOD);
				while($rowBOD=$resBOD->fetch_assoc()){
					$NombreBodega=$rowBOD['Nombre_MaesBode'];
					//enviar array
					}
		
		echo json_encode(array("Documento"=>$Documento,"Fecha"=>$Fecha,"IDCodigo"=>$Codigo,"Codigo"=>$NombreCodigo,"IDtp"=>$TipoPago,"TipoPago"=>$NombreTP,"BodegaIngresoID"=>$BodegaID,"BodegaIngresoNombre"=>$NombreBodega,"Observaciones"=>$observaciones,"usuario"=>$UsuarioDocumento,"Total"=>$Total,"Correlativo"=>$Correlativo));	
}

elseif(isset($_POST['Siguiente']))
{
$IDocumento=$_POST['Idocumento'];
	
	$sqlInicio="Select*  from ent_documento where IdPais_Documento='$paisEmpresa' AND IdEmpr_Documento='$empresaID' AND IdTipoDoc_Documento=2 AND Documento_Documento > '$IDocumento' limit 1";
	$resInicio=$mysqli->query($sqlInicio);
	while($rowInicio=$resInicio->fetch_assoc()){
		$Documento=$rowInicio['Documento_Documento'];
		$Fecha=$rowInicio['Fecha_Documento'];
		$observaciones=$rowInicio['Observaciones_Documento'];
		$UsuarioDocumento=$rowInicio['Usuario_Documento'];
		//CONVERTIR ID CODIGO , TIPO PAGO Y OBTENER EL NOMBRE DE BODEGA
		
		$Total = $rowInicio['SaldoFinal_Documento'];
		$Codigo=$rowInicio['Codigo_Documento'];
		$TipoPago=$rowInicio['IdTipoPago_Documento'];
		$BodegaID=$rowInicio['IdBodEnt_Documento'];
		$Correlativo=$rowInicio['Correlativo'];
		}
		//////////////Codigo
			$sqlCodigo="Select *  from ent_maessocio where Id_MaesPais='$paisEmpresa' AND Id_MaesEmpr='$empresaID' AND Id_Socio='$Codigo'";
			$resCodigo=$mysqli->query($sqlCodigo);
			while($rowCodigo=$resCodigo->fetch_assoc()){
				$NombreCodigo=$rowCodigo['RazonSocial_MaesSocio'];
				// TIPO PAGO Y OBTENER EL NOMBRE DE BODEGA
				}
					$sqlTP="Select *  from ent_maestipopago where IdPais_MaesTipoPago='$paisEmpresa' AND IdEmpresa_MaesTipoPago='$empresaID' AND Id_MaesTipoPago='$TipoPago'";
				$resTP=$mysqli->query($sqlTP);
				while($rowTP=$resTP->fetch_assoc()){
					$NombreTP=$rowTP['Nombre_MaesTipoPago'];
					//  OBTENER EL NOMBRE DE BODEGA
					}
					
					$sqlBOD="Select *  from ent_maesbode where Id_MaesPais='$paisEmpresa' AND Id_MaesEmpr='$empresaID' AND Id_MaesBode='$BodegaID' ";
				$resBOD=$mysqli->query($sqlBOD);
				while($rowBOD=$resBOD->fetch_assoc()){
					$NombreBodega=$rowBOD['Nombre_MaesBode'];
					//enviar array
					}
		
		echo json_encode(array("Documento"=>$Documento,"Fecha"=>$Fecha,"IDCodigo"=>$Codigo,"Codigo"=>$NombreCodigo,"IDtp"=>$TipoPago,"TipoPago"=>$NombreTP,"BodegaIngresoID"=>$BodegaID,"BodegaIngresoNombre"=>$NombreBodega,"Observaciones"=>$observaciones,"usuario"=>$UsuarioDocumento,"Total"=>$Total,"Correlativo"=>$Correlativo));	
}
elseif (isset($_POST['tabla_data'])) {
	$uniquid = $_POST['Unicod'];
$TablaTemporalQ = "SELECT * FROM ent_detalletemporal where IdPais_DetalleDocumento='$paisEmpresa' AND IdEmpr_DetalleDocumento='$empresaID' AND Documento_DetalleDocumento='$uniquid' and IdTipoDoc_DetalleDocumento=2";

 
$ResPuesta = $mysqli->query($TablaTemporalQ);
$tilde = "'";
	$datos = '
<table class="tabla" border="1" bordercolor="#000000" bgcolor="#ccc">
<tr>
<th width="73" bgcolor="#FFFFFF">Codigo</th>
<th width="78" bgcolor="#FFFFFF">Cantidad</th>
<th width="321" bgcolor="#FFFFFF" align="left">Descripcion</th>
<th width="321" bgcolor="#FFFFFF" align="left">U medida</th>
<th width="321" bgcolor="#FFFFFF" align="left">Valor Compra</th>
<th width="126" bgcolor="#FFFFFF">Total</th>
<th width="321" bgcolor="#FFFFFF" align="left"> Costo Compra</th>
<th width="187" bgcolor="#FFFFFF">Precio Venta</th>
<th width="187" bgcolor="#FFFFFF">Ganancia</th>
<th width="187" bgcolor="#FFFFFF">Precio Sugerido</th>

</tr>
<tbody>';
while ($RowVenta = $ResPuesta->fetch_Assoc()){	
	$Ganancia =$RowVenta['ValorVenta_DetalleDocumento'] -$RowVenta['ValorCosto_DetalleDocumento'];
		if($Ganancia<0){$color="bgcolor='#B61616'";}else{$color="bgcolor='#999999'";}

	$datos .='
<tr>
<td>'.$RowVenta['CodigoAlter_DetalleDocumento'].'</td>
<td id="1">'.$RowVenta['Cantidad_DetalleDocumento'].'</td>
<td id="3">'.$RowVenta['Descripcion_DetalleDocumentoT'].'</td>
<td id="4">'.$RowVenta['IdUniMed_DetalleDocumento'].' </td>
<td> '.$RowVenta['ValorCosto_DetalleDocumento'].'</td>
<td id="5">'.$RowVenta['total'].' </td>
<td bgcolor="#999999" > '.$RowVenta['ValorCosto_DetalleDocumento'].'</td>
<td  bgcolor="#999999">'.$RowVenta['ValorVenta_DetalleDocumento'].'</td>
<td '.$color.'>'.$Ganancia.' </td>
<td ><input onblur="Actualizar('.$RowVenta['Id_DetalleDocumento'].');" type="text" disabled="disabled" id="TextEdit'.$RowVenta['Id_DetalleDocumento'].'" value="'.$RowVenta['ValorVenta_DetalleDocumento'].'"></td>
<td >
<a  onclick="Editar('.$RowVenta['Id_DetalleDocumento'].');"><p id="9"><img src="componentes/edit.png"/></p></a>
</td>
</tr>';
}
$datos .= '
</tbody>
</table>';
echo json_encode($datos);
}
elseif(isset($_POST['ModPrecio'])){
$ValorAntiguo=$_POST['ValorAntiguo'];
$ValorNuevo=$_POST['ValorNuevo'];
$ID=$_POST['ID'];
$UPDATEPRICE=mysqli_query($mysqli,"update ent_maesprod set ValorVenta_MaesProd='$ValorNuevo' where IdPais_MaesProd='$paisEmpresa' AND IdEmpr_MaesProd='$empresaID' AND CodigoAlt_MaesProd='$ID'");

$UPDATEporal=mysqli_query($mysqli,"update ent_detalletemporal set ValorVenta_DetalleDocumento='$ValorNuevo' where IdPais_DetalleDocumento='$paisEmpresa' AND IdEmpr_DetalleDocumento='$empresaID' AND CodigoAlter_DetalleDocumento='$ID'");
}
elseif(isset($_POST['Eliminar'])){
	
	$DOCUMENT=$_POST['Uniquid'];
	$BorrarDetalleOriginal=mysqli_query($mysqli,"DELETE FROM ent_detalledocumento where IdPais_DetalleDocumento='$paisEmpresa' and IdEmpr_DetalleDocumento='$empresaID' and IdTipoDoc_DetalleDocumento='2' and Documento_DetalleDocumento='$DOCUMENT'");
	
		$BorrarDetalleTemporal=mysqli_query($mysqli,"DELETE FROM ent_detalletemporal where IdPais_DetalleDocumento='$paisEmpresa' and IdEmpr_DetalleDocumento='$empresaID' and IdTipoDoc_DetalleDocumento='2' and Documento_DetalleDocumento='$DOCUMENT'");
		
	$BorrarEncabezadoDocumento=mysqli_query($mysqli,"DELETE FROM ent_documento where IdPais_Documento='$paisEmpresa' and IdEmpr_Documento='$empresaID' and IdTipoDoc_Documento='2' and Documento_Documento='$DOCUMENT'");
}


elseif(isset($_POST['Buscar']))
{

	$Item=$_POST['Item'];
	$sqlInicio="Select*  from ent_documento where IdPais_Documento='$paisEmpresa' AND IdEmpr_Documento='$empresaID' AND IdTipoDoc_Documento=2 AND Correlativo= '$Item'  limit 1";
	$resInicio=$mysqli->query($sqlInicio);
	while($rowInicio=$resInicio->fetch_assoc()){
		$Documento=$rowInicio['Documento_Documento'];
		$Fecha=$rowInicio['Fecha_Documento'];
		$observaciones=$rowInicio['Observaciones_Documento'];
		$UsuarioDocumento=$rowInicio['Usuario_Documento'];
		//CONVERTIR ID CODIGO , TIPO PAGO Y OBTENER EL NOMBRE DE BODEGA
		
		$Codigo=$rowInicio['Codigo_Documento'];
		$TipoPago=$rowInicio['IdTipoPago_Documento'];
		$BodegaID=$rowInicio['IdBodEnt_Documento'];
		$Total = $rowInicio['SaldoFinal_Documento'];
		$Correlativo=$rowInicio['Correlativo'];
		}
		//////////////Codigo
			$sqlCodigo="Select *  from ent_maessocio where Id_MaesPais='$paisEmpresa' AND Id_MaesEmpr='$empresaID' AND Id_Socio='$Codigo'";
			$resCodigo=$mysqli->query($sqlCodigo);
			while($rowCodigo=$resCodigo->fetch_assoc()){
				$NombreCodigo=$rowCodigo['RazonSocial_MaesSocio'];
				// TIPO PAGO Y OBTENER EL NOMBRE DE BODEGA
				}
					$sqlTP="Select *  from ent_maestipopago where IdPais_MaesTipoPago='$paisEmpresa' AND IdEmpresa_MaesTipoPago='$empresaID' AND Id_MaesTipoPago='$TipoPago'";
				$resTP=$mysqli->query($sqlTP);
				while($rowTP=$resTP->fetch_assoc()){
					$NombreTP=$rowTP['Nombre_MaesTipoPago'];
					//  OBTENER EL NOMBRE DE BODEGA
					}
					
					$sqlBOD="Select *  from ent_maesbode where Id_MaesPais='$paisEmpresa' AND Id_MaesEmpr='$empresaID' AND Id_MaesBode='$BodegaID'";
				$resBOD=$mysqli->query($sqlBOD);
				while($rowBOD=$resBOD->fetch_assoc()){
					$NombreBodega=$rowBOD['Nombre_MaesBode'];
					//enviar array
					}
		
		echo json_encode(array("Documento"=>$Documento,"Fecha"=>$Fecha,"IDCodigo"=>$Codigo,"Codigo"=>$NombreCodigo,"IDtp"=>$TipoPago,"TipoPago"=>$NombreTP,"BodegaIngresoID"=>$BodegaID,"BodegaIngresoNombre"=>$NombreBodega,"Observaciones"=>$observaciones,"usuario"=>$UsuarioDocumento,"Total"=>$Total,"Correlativo"=>$Correlativo));	
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