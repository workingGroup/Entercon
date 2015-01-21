<?php

session_start();

if (isset ($_SESSION['Usuario']))
{require('../coneccion.php');
$Fecha = date('d-m-y'); 
date_default_timezone_set('America/Guatemala');
$Maquina=gethostname();
$paisEmpresa = $_SESSION['Pais'];
$empresaID= $_SESSION['Empresa'];
$usuarioLog=$_SESSION['Usuario'];
$Bodega=$_SESSION['Bodega'];
if(isset($_POST['dato']))
	{
	$Proveedor = $_POST['ProveedorID'];
		$sql = "select * from ent_maesprod  where IdPais_MaesProd ='$paisEmpresa' AND IdEmpr_MaesProd = '$empresaID' AND IdSocio_MaesProd = '$Proveedor'";
		$Resultado  = $mysqli->query($sql);
		$array = array();
				while($row = mysqli_fetch_array($Resultado))
				{
					$key = $row['IdProd_MaesProd'];
					$array[$key] = $row['IdProd_MaesProd'];
				}


		echo json_encode($array);
	}
elseif(isset($_POST['comboPago'])){
		$Pago=array();
	$OpcionesPagoQ="Select * from ent_maestipopago where IdPais_MaesTipoPago ='$paisEmpresa' AND IdEmpresa_MaesTipoPago = '$empresaID'";
	$a=$mysqli->query($OpcionesPagoQ);
		while($bRow=$a->fetch_assoc()){					
					$Pago["TP"][] = array('ID' => $bRow['Id_MaesTipoPago'],'TPago'=>$bRow['Nombre_MaesTipoPago']);
		}
		echo json_encode($Pago);
	}
	
elseif(isset($_POST['PR'])){
		$PR=array();
	$QProveedor = "SELECT * FROM `ent_maessocio` WHERE `Id_MaesPais`='$paisEmpresa' AND `Id_MaesEmpr`='$empresaID' AND Tipo_MaesSocio=2";
	$RP=$mysqli->query($QProveedor);
		while($RowP=$RP->fetch_assoc()){					
					$PR["PR"][] = array('ID' => $RowP['Id_Socio'],'Nombre'=>$RowP['RazonSocial_MaesSocio']);
		}
		echo json_encode($PR);
	}	
	
elseif(isset($_POST['existencias']))
	{	
		$idprod = $_POST['CodProd'];
		$QueryDataProd = "select * from ent_maesprod where IdPais_MaesProd = '$paisEmpresa' AND IdEmpr_MaesProd= '$empresaID' AND IdProd_MaesProd = '$idprod' ";
		$ResData = $mysqli->query($QueryDataProd);
		while($rowData = $ResData->fetch_assoc())
		{
		$Descripcion= $rowData['Nombre_MaesProd'];
		$IDUnidadMedida=$rowData['IdUnidMedida_MaesProd'];
		$IDUnidadMedida .="M";
		$valorVenta=$rowData['ValorVenta_MaesProd'];
		$ValorCompra=$rowData['ValorCompra_MaesProd'];
		}
		$NombreiDUMQuery = "SELECT * FROM ent_maesunidmedida WHERE IdPais_MaesUnidMedida= '$paisEmpresa' AND IdEmpr_MaesUnidMedida = '$empresaID' AND Id_MaesUnidMedida = '$IDUnidadMedida'";
		$ResNombre = $mysqli->query($NombreiDUMQuery);
		while($rowNombre = $ResNombre->fetch_assoc()){
			$NombreUM= $rowNombre['Nombre_MaesUnidMedida'];
	}
	$ArrayExistencias = array();
	
	$DetalleUMQ = "SELECT * FROM ent_detunimed WHERE IdPais_DetUniMedida= '$paisEmpresa' AND IdEmpr_DetUniMedida = '$empresaID' AND Codigo_DetUniMed = '$idprod'";
		$ResDetalleUMQ = $mysqli->query($DetalleUMQ);
		while($rowDetalleUMQ = $ResDetalleUMQ->fetch_assoc()){
			$key = $rowDetalleUMQ['Id_DetUniMedida'];
			$key .="D";
			
$ArrayExistencias["DetalleUNM"][] = array('valor' => $rowDetalleUMQ['Nombre_DetUniMed'],'id'=>$key);
	}

		$sqlE = "select * from ent_movprod  where Id_Pais_MovProd ='$paisEmpresa' AND Id_Empr_MovProd ='$empresaID'  AND IdProd_MovProd = '$idprod' and Id_Bode_MovProd='$Bodega'";
			$ResultadoExistencias  = $mysqli->query($sqlE);
			$Mibinario  = mysqli_num_rows($ResultadoExistencias);
			if ($Mibinario > 0)
				{
				while($rowE= $ResultadoExistencias->fetch_assoc())
						{
			$existencias  =  (($rowE['SaldoIni_MovProd'] + $rowE['Entrada_MovProd'])- $rowE['Salida_MovProd']);
			
						
						}
					}else {					
						$existencias = 0;
						}
						
						$ArrayExistencias["existencias"]=$existencias;
						$ArrayExistencias["Descripcion"]=$Descripcion;
						$ArrayExistencias["Compra"]=$ValorCompra;
						$ArrayExistencias["ValVenta"]=$valorVenta;
						$ArrayExistencias["UnM"]=$IDUnidadMedida;
						$ArrayExistencias["UnMN"]=$NombreUM;
	
echo json_encode($ArrayExistencias);


}
elseif (isset($_POST['tabla_data'])) {
	$uniquid = $_POST['Unicod'];
$TablaTemporalQ = "SELECT * FROM ent_detalletemporal where IdPais_DetalleDocumento = '$paisEmpresa' AND IdEmpr_DetalleDocumento = '$empresaID' AND Documento_DetalleDocumento ='".$uniquid."' and IdTipoDoc_DetalleDocumento=2";

 
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
<td ><input onblur="Actualizar('.$RowVenta['CodigoAlter_DetalleDocumento'].');" type="text" disabled="disabled" id="TextEdit'.$RowVenta['CodigoAlter_DetalleDocumento'].'" value="'.$RowVenta['ValorVenta_DetalleDocumento'].'"></td>
<td >
<a  onclick="Eliminar('.$RowVenta['Id_DetalleDocumento'].');"><p id="9"><img src="componentes/delete.png"  /></p></a>
</td>
<td >
<a  onclick="Editar('.$RowVenta['CodigoAlter_DetalleDocumento'].');"><p id="9"><img src="componentes/edit.png"/></p></a>
</td>
</tr>';
}
$datos .= '
</tbody>
</table>';
echo json_encode($datos);
}

elseif(isset($_POST['valoresct']))
	{
	$uniquid = $_POST['DocID'];
$sumQ = "SELECT SUM(total) as total_DOC,SUM(Cantidad_DetalleDocumento) as total_U FROM ent_detalletemporal where IdPais_DetalleDocumento = '$paisEmpresa' AND IdEmpr_DetalleDocumento = '$empresaID' AND Documento_DetalleDocumento ='$uniquid' and IdTipoDoc_DetalleDocumento=2"; 
$ResSum=$mysqli->query($sumQ);
				while($rowTOTALU = $ResSum->fetch_assoc())
				{
					$totalTT = $rowTOTALU['total_DOC'];
					$totalU= $rowTOTALU['total_U'];
				}

		    echo json_encode(array("totalQ"=>$totalTT , "totalU"=>$totalU));
	}	
elseif(isset($_POST['Eliminar']))
	{
		$IDDelete= $_POST["DeleteID"];
	    $IDDoc=$_POST["Uniquid"];
		
			
			$DelQ = "DELETE FROM ent_detalletemporal where IdPais_DetalleDocumento = '$paisEmpresa' AND IdEmpr_DetalleDocumento = '$empresaID' AND Documento_DetalleDocumento ='$IDDoc' AND Id_DetalleDocumento='$IDDelete' and IdTipoDoc_DetalleDocumento=2";
		$resultado = $mysqli->query($DelQ);
			
			
	}
		elseif(isset($_POST['Detalle']))
	{
		$IDDetalle=$_POST["ID"];
		$ValorVentaMedidaQ="SELECT * FROM ent_detunimed WHERE IdPais_DetUniMedida= '$paisEmpresa' AND	      IdEmpr_DetUniMedida='$empresaID' AND Id_DetUniMedida='$IDDetalle'";
		$resQ =$mysqli->query($ValorVentaMedidaQ);
			while($thisRows=$resQ->fetch_assoc()){
				$Codigo = $thisRows['Codigo_DetUniMed'];
				$ValorVentaUnidad = $thisRows['ValUniVe_DetUniMed'];
				$ValorCompra= $thisRows['ValUniCo_DetUniMed'];
				$Relacion= $thisRows['Relacion_DetUniMed'];
				}
		$ConsultaExistencias = "SELECT * FROM ent_movprod WHERE Id_Pais_MovProd='$paisEmpresa' AND Id_Empr_MovProd = '$empresaID' AND IdProd_MovProd = '$Codigo' AND Id_Bode_MovProd='$Bodega'";
		$ResultadoConsulta = $mysqli->query($ConsultaExistencias);
				while($RowsResultado= $ResultadoConsulta->fetch_assoc()){ 
		$Resultado =(($RowsResultado['SaldoIni_MovProd']+$RowsResultado['Entrada_MovProd'])-$RowsResultado['Salida_MovProd'])* $Relacion;

		}
			echo json_encode(array("ValorCompra"=>$ValorCompra,"ValVenta"=>$ValorVentaUnidad ,"existencias"=>$Resultado ,"relacion"=>$Relacion));
	}
elseif(isset($_POST['nuevo']))
	{
	$codProd = $_POST ['idprodR'];
	$unidades = $_POST ['unidadesR'];
	$medidaUN = $_POST['medidaR'];
	$DocID = $_POST['documentoR'];
	$valorV=$_POST['codV'];
	$Origen=$_POST['OrigenMedida'];
	$RELATIONM=$_POST['RelationM'];
	$Descripcion =$_POST['Descripcion'];
	$Total= $_POST['Total'];
	$ValorCompra= $_POST['ValorCompra'];
	$TP=$_POST['Tp'];
	if ($Origen=="M"){
	$CantidadV = $unidades/1;
	}
	elseif($Origen=="D"){
	$CantidadV = $unidades/$RELATIONM;
	}
	
	$QueryDataProd = "select * from ent_maesprod where IdPais_MaesProd = '$paisEmpresa' AND IdEmpr_MaesProd= '$empresaID' AND IdProd_MaesProd = '$codProd' ";
$ResData = $mysqli->query($QueryDataProd);
while($rowData = $ResData->fetch_assoc())
		{
			$codAlter=$rowData['CodigoAlt_MaesProd'];
		}
$IDROW = time();

			$queryADD = "INSERT INTO ent_detalletemporal(IdPais_DetalleDocumento, IdEmpr_DetalleDocumento, IdTipoDoc_DetalleDocumento, Documento_DetalleDocumento, IdTipoPago_Documento, Id_DetalleDocumento, IdUniMed_DetalleDocumento, Origen_DetalleDocumento, IdProd_DetalleDocumento, CodigoAlter_DetalleDocumento, CantidadV_DetalleDocumento,Cantidad_DetalleDocumento, ValorCosto_DetalleDocumento, ValorVenta_DetalleDocumento, total,Descripcion_DetalleDocumentoT) VALUES ('$paisEmpresa','$empresaID',2,'$DocID','$TP','$IDROW','$medidaUN','$Origen','$codProd','$codAlter','$CantidadV','$unidades','$ValorCompra','$valorV','$Total','$Descripcion')";
			$respuestaADD = $mysqli->query($queryADD);
			
			
			echo json_encode ($queryADD);
	}
elseif(isset($_POST['Guardar'])){
////////////////////////////////////////////////////////
$MAXID=mysqli_query($mysqli,"select max(Correlativo)+1 as maximo from ent_documento where IdPais_Documento='$paisEmpresa' and IdEmpr_Documento='$empresaID' and IdTipoDoc_Documento=2 ");
while($rowMXID= $MAXID->fetch_assoc()){$bin = $rowMXID['maximo']; 
		if ($bin!=""){
			$maxid = $rowMXID['maximo'];}
		else{$maxid=1;}
}
////////////////////////////////////////////////////////
	$Documento = $_POST['Documento'];
	$Observaciones = $_POST['Obs'];
	$Proveedor = $_POST['Proveedor'];
	$Tp = $_POST['Tp'];
		
$sqlSuma= "SELECT sum(total)as total FROM `ent_detalletemporal` where IdPais_DetalleDocumento='$paisEmpresa' and IdEmpr_DetalleDocumento='$empresaID' and Documento_DetalleDocumento='$Documento' and IdTipoDoc_DetalleDocumento=2";
	$resSuma= $mysqli->query($sqlSuma);
	while($Rowsuma = $resSuma->fetch_assoc()){
	$Total=$Rowsuma['total'];
	}
	$sqlEstatus= "SELECT * FROM Ent_MaesTipoPago where Id_MaesTipoPago='$Tp' and IdPais_MaesTipoPago='$paisEmpresa' and IdEmpresa_MaesTipoPago='$empresaID'";
	$resEstatus= $mysqli->query($sqlEstatus);
	while($RowEstatus = $resEstatus->fetch_assoc()){
	$Estatus=$RowEstatus['Estatus_MaesTipoPago'];
	}
	
	
	$queryEncabezado = "INSERT INTO `ent_documento`(Correlativo,`IdPais_Documento`,`IdEmpr_Documento`,`IdTipoDoc_Documento`,`Documento_Documento`,`IdTipoPago_Documento`,`Fecha_Documento`,`Codigo_Documento`,`IdBodEnt_Documento`,`Valor_Documento`,SaldoFinal_Documento,`Estatus_Documento`,Observaciones_Documento,`Usuario_Documento`, `FechaCreacion_Documento`,`MaqCreacion_Documento`) VALUES ($maxid,'$paisEmpresa','$empresaID',2,'$Documento','$Tp','$Fecha','$Proveedor','$Bodega','$Total','$Total','$Estatus','$Observaciones','$usuarioLog','$Fecha','$Maquina') ";
	 $ResDocumento= $mysqli -> query($queryEncabezado);
	
	
$QueryTraslado = "INSERT INTO ent_detalledocumento (`IdPais_DetalleDocumento`, `IdEmpr_DetalleDocumento`, `IdTipoDoc_DetalleDocumento`, `Serie_DetalleDocumento`, `Documento_DetalleDocumento`, `IdTipoPago_Documento`, `Id_DetalleDocumento`, `IdUniMed_DetalleDocumento`, `Origen_DetalleDocumento`, `IdProd_DetalleDocumento`, `CodigoAlter_DetalleDocumento`, `CantidadV_DetalleDocumento`, `Cantidad_DetalleDocumento`, `ValorCosto_DetalleDocumento`, `ValorVenta_DetalleDocumento`, `Descuento_DetalleDocumento`)
       SELECT
          `IdPais_DetalleDocumento`, `IdEmpr_DetalleDocumento`, `IdTipoDoc_DetalleDocumento`, `Serie_DetalleDocumento`, `Documento_DetalleDocumento`, `IdTipoPago_Documento`, `Id_DetalleDocumento`, `IdUniMed_DetalleDocumento`, `Origen_DetalleDocumento`, `IdProd_DetalleDocumento`, `CodigoAlter_DetalleDocumento`, `CantidadV_DetalleDocumento`, `Cantidad_DetalleDocumento`, `ValorCosto_DetalleDocumento`, `ValorVenta_DetalleDocumento`, `Descuento_DetalleDocumento`
       FROM   ent_detalletemporal where  IdPais_DetalleDocumento = '$paisEmpresa' && IdEmpr_DetalleDocumento= '$empresaID' && Documento_DetalleDocumento = '$Documento' && IdTipoDoc_DetalleDocumento=2" ;
	  $respuestaTraslado = $mysqli -> query($QueryTraslado);
	  
	  $QDetalleT = "update ent_detalletemporal set Facturado_DetalleDocumentoT = 1  where  IdPais_DetalleDocumento = '$paisEmpresa' && IdEmpr_DetalleDocumento= '$empresaID' && Documento_DetalleDocumento = '$Documento' and IdTipoDoc_DetalleDocumento=2"; 
	   
	 
	  
	   $miputoarraeglo=array();
$BF = "select * from ent_detalletemporal where  IdPais_DetalleDocumento = '$paisEmpresa' && IdEmpr_DetalleDocumento= '$empresaID' && Documento_DetalleDocumento = '$Documento' && Facturado_DetalleDocumentoT=0 and IdTipoDoc_DetalleDocumento=2";
$RespuestaBF = $mysqli -> query($BF);
while($rowBF = $RespuestaBF->fetch_assoc())
				{			
				$llave = $rowBF['Facturado_DetalleDocumentoT'];
				$miputoarraeglo["valores"][]=array('Producto' => $rowBF['IdProd_DetalleDocumento'],'CantidadV'=>$rowBF['CantidadV_DetalleDocumento']);
				}
echo json_encode($miputoarraeglo);	
}
elseif(isset($_POST['Update'])){
	$Documento = $_POST['Documento'];
	$CantidadVI= $_POST['cantidadV'];
	$PROD = $_POST['Codigo'];
	
$UMPRODQ= mysqli_query($mysqli,"update ent_movprod set Entrada_MovProd = Entrada_MovProd + '$CantidadVI' where Id_Pais_MovProd ='$paisEmpresa' AND Id_Empr_MovProd = '$empresaID' AND IdProd_MovProd = '$PROD' AND Id_Bode_MovProd='$Bodega'");
$RUMP=$mysqli->query($UMPRODQ);

	   $QDetalleT = "update ent_detalletemporal set Facturado_DetalleDocumentoT = 1  where  IdPais_DetalleDocumento = '$paisEmpresa' && IdEmpr_DetalleDocumento= '$empresaID' && Documento_DetalleDocumento = '$Documento' and IdTipoDoc_DetalleDocumento=2"; 	
	  $RespuestaQDT = $mysqli->query($QDetalleT);
		
}
elseif(isset($_POST['ModPrecio'])){
$ValorAntiguo=$_POST['ValorAntiguo'];
$ValorNuevo=$_POST['ValorNuevo'];
$ID=$_POST['ID'];
$UPDATEPRICE=mysqli_query($mysqli,"update ent_maesprod set ValorVenta_MaesProd='$ValorNuevo' where IdPais_MaesProd='$paisEmpresa' AND IdEmpr_MaesProd='$empresaID' AND CodigoAlt_MaesProd='$ID'");

$UPDATEporal=mysqli_query($mysqli,"update ent_detalletemporal set ValorVenta_DetalleDocumento='$ValorNuevo' where IdPais_DetalleDocumento='$paisEmpresa' AND IdEmpr_DetalleDocumento='$empresaID' AND CodigoAlter_DetalleDocumento='$ID'");
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