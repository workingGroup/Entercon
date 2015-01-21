<?php

session_start();

if (isset ($_SESSION['Usuario']))
{require('../coneccion.php');

$paisEmpresa = $_SESSION['Pais'];
$empresaID= $_SESSION['Empresa'];
$usuarioLog=$_SESSION['Usuario'];
$Bodega=$_SESSION['Bodega'];
$Maquina=gethostname();
$Fecha = date('d-m-y'); 
date_default_timezone_set('America/Guatemala');
if(isset($_POST['dato']))
	{
		$sql = "select * from ent_maesprod  where IdPais_MaesProd ='$paisEmpresa' AND IdEmpr_MaesProd = '$empresaID' AND Estado_MaesProd =1";
		$Resultado  = $mysqli->query($sql);
		$array = array();
				while($row = mysqli_fetch_array($Resultado))
				{
					$key = $row['IdProd_MaesProd'];
					$array[$key] = $row['IdProd_MaesProd'];
				}


		echo json_encode($array);
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
		$ValorCompra=$rowData['ValorCompra_MaesProd'];		
		$valorVenta=$rowData['ValorVenta_MaesProd'];
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

		$sqlE = "select * from ent_movprod  where Id_Pais_MovProd ='$paisEmpresa' AND Id_Empr_MovProd ='$empresaID'  AND IdProd_MovProd = '$idprod' and Id_Bode_MovProd='$Bodega' limit 1 ";
			$ResultadoExistencias  = $mysqli->query($sqlE);
		$Mibinario  = mysqli_num_rows($ResultadoExistencias);
			if ($Mibinario > 0)
				{
				while($rowE= $ResultadoExistencias->fetch_assoc())
						{
			$existencias  =  (($rowE['SaldoIni_MovProd'] + $rowE['Entrada_MovProd'])- $rowE['Salida_MovProd']);
			$id = $rowE['Entrada_MovProd'];
						}
					}else {					
						$existencias = 0;
						}
						$ArrayExistencias["existencias"]=$existencias;
						$ArrayExistencias["Descripcion"]=$Descripcion;
						$ArrayExistencias["ValVenta"]=$valorVenta;
						$ArrayExistencias["UnM"]=$IDUnidadMedida;
						$ArrayExistencias["UnMN"]=$NombreUM;
						$ArrayExistencias["ValorCompra"]=$ValorCompra;
						
								
		
echo json_encode($ArrayExistencias);


}

elseif (isset($_POST['tabla_data'])) {
	$uniquid = $_POST['Unicod'];
$TablaTemporalQ = "SELECT * FROM ent_detalletemporal where IdPais_DetalleDocumento = '$paisEmpresa' AND IdEmpr_DetalleDocumento = '$empresaID' AND Documento_DetalleDocumento ='".$uniquid."' AND IdTipoDoc_DetalleDocumento=3";

 
$ResPuesta = $mysqli->query($TablaTemporalQ);
$tilde = "'";
	$datos = '
<table class="tabla" border="1" bordercolor="#000000" bgcolor="#ccc">
<tr>

<th width="78" bgcolor="#FFFFFF">Codigo</th>
<th width="73" bgcolor="#FFFFFF">Cantidad</th>
<th width="321" bgcolor="#FFFFFF" align="left">Descripcion</th>
<th width="321" bgcolor="#FFFFFF" align="left">Unidad de medida</th>
<th width="187" bgcolor="#FFFFFF">Valor Compra</th>
<th width="126" bgcolor="#FFFFFF">Valor Venta</th>
<th width="126" bgcolor="#FFFFFF">Total</th>
</tr>
<tbody>';
while ($RowVenta = $ResPuesta->fetch_Assoc()){	
	$datos .='
<tr>
<td id="1">'.$RowVenta['CodigoAlter_DetalleDocumento'].'</td>
<td id="2">'.$RowVenta['Cantidad_DetalleDocumento'].'</td>
<td id="3">'.$RowVenta['Descripcion_DetalleDocumentoT'].'</td>
<td id="4">'.$RowVenta['IdUniMed_DetalleDocumento'].' </td>
<td id="5">'.$RowVenta['ValorCosto_DetalleDocumento'].' </td>
<td id="6">'.$RowVenta['ValorCosto_DetalleDocumento'].'</td>
<td id="6">'.$RowVenta['total'].'</td>
<td id="7">
<a id="8" onclick="Eliminar('.$RowVenta['Id_DetalleDocumento'].');"><p id="9"><img src="componentes/delete.png"  /></p></a>
</td>
</tr>';
}
$datos .= '
</tbody>
</table>';
echo json_encode($datos);
}
elseif(isset($_POST['Bodega']))
	{
$QueryBodega = "Select * from ent_maesbode where Id_MaesPais= '$paisEmpresa' AND Id_MaesEmpr='$empresaID'";
$ResBodega =$mysqli->query($QueryBodega);
$arregloBodega = array();
				while($rowBodega = mysqli_fetch_array($ResBodega))
				{
					$llave = $rowBodega['Id_MaesBode'];
					$arregloBodega[$llave] = $rowBodega['Id_MaesBode'];
				}
		echo json_encode($arregloBodega);
	}
elseif(isset($_POST['BodegasExistentes']))
	{
	$CodBodega = $_POST['CodBodega'];
$QueryBodegaFill = "Select * from ent_maesbode where Id_MaesPais= '$paisEmpresa' AND Id_MaesEmpr='$empresaID'  AND Id_MaesBode = '$CodBodega'";
$ResBodegafILL=$mysqli->query($QueryBodegaFill);

				while($rowBodegaFill = $ResBodegafILL->fetch_assoc())
				{
					$Nombre = $rowBodegaFill['Nombre_MaesBode'];
					
				}

		    echo json_encode(array("Nombre"=>$Nombre));
		   
	}
elseif(isset($_POST['valoresct']))
	{
	$uniquid = $_POST['DocID'];
$sumQ = "SELECT SUM(total) as total_DOC,SUM(Cantidad_DetalleDocumento) as total_U FROM ent_detalletemporal where IdPais_DetalleDocumento = '$paisEmpresa' AND IdEmpr_DetalleDocumento = '$empresaID' AND Documento_DetalleDocumento ='$uniquid' AND IdTipoDoc_DetalleDocumento=3"; 
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
		
			$DelQ = "DELETE FROM ent_detalletemporal where IdPais_DetalleDocumento = '$paisEmpresa' AND IdEmpr_DetalleDocumento = '$empresaID' AND Documento_DetalleDocumento ='$IDDoc' AND Id_DetalleDocumento='$IDDelete' AND IdTipoDoc_DetalleDocumento=3";
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
				$Relacion= $thisRows['Relacion_DetUniMed'];
				$ValorCompra=$thisRows['ValUniCo_DetUniMed'];
				}
		$ConsultaExistencias = "SELECT * FROM ent_movprod WHERE Id_Pais_MovProd='$paisEmpresa' AND Id_Empr_MovProd = '$empresaID' AND IdProd_MovProd = '$Codigo' AND Id_Bode_MovProd='$Bodega'";
		$ResultadoConsulta = $mysqli->query($ConsultaExistencias);
				while($RowsResultado= $ResultadoConsulta->fetch_assoc()){ 
		$Resultado =(($RowsResultado['SaldoIni_MovProd']+$RowsResultado['Entrada_MovProd'])-$RowsResultado['Salida_MovProd'])* $Relacion;

		}
			echo json_encode(array("ValVenta"=>$ValorVentaUnidad ,"existencias"=>$Resultado ,"relacion"=>$Relacion,"ValorCompra"=>$ValorCompra));
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
	$Descripcion=$_POST['Descrip'];
	$valorC= $_POST['valorCompra'];
	$TipoPago=$_POST['TipoPago'];
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
$Total=$unidades * $valorV;
$IDROW = time();

			$queryADD = "INSERT INTO ent_detalletemporal(IdPais_DetalleDocumento, IdEmpr_DetalleDocumento, IdTipoDoc_DetalleDocumento, Serie_DetalleDocumento, Documento_DetalleDocumento, Id_DetalleDocumento, IdUniMed_DetalleDocumento, Origen_DetalleDocumento, IdProd_DetalleDocumento, CodigoAlter_DetalleDocumento, CantidadV_DetalleDocumento,Cantidad_DetalleDocumento, ValorCosto_DetalleDocumento, ValorVenta_DetalleDocumento, total,Facturado_DetalleDocumentoT,Descripcion_DetalleDocumentoT) VALUES ('$paisEmpresa','$empresaID',3,'$Serie','$DocID','$IDROW','$medidaUN','$Origen','$codProd','$codAlter','$CantidadV','$unidades','$valorC','$valorV','$Total',0,'$Descripcion')";
			$respuestaADD = $mysqli->query($queryADD);
			
		
	}
	
	//////////////////////PENDIENTE 
	
elseif(isset($_POST['Guardar'])){
////////////////////////////////////////////////////////
$MAXID=mysqli_query($mysqli,"select max(Correlativo)+1 as maximo from ent_documento where IdPais_Documento='$paisEmpresa' and IdEmpr_Documento='$empresaID' and IdTipoDoc_Documento=3");
while($rowMXID= $MAXID->fetch_assoc()){$bin = $rowMXID['maximo']; 
		if ($bin!=""){
			$maxid = $rowMXID['maximo'];}
		else{$maxid=1;}
}
////////////////////////////////////////////////////////
	$Documento = $_POST['Documento'];
	$Observaciones = $_POST['Obs'];
	$BodegaEntrada=$_POST['BodegaEntrada'];
	
		
$sqlSuma= "SELECT sum(total)as total FROM `ent_detalletemporal` where IdPais_DetalleDocumento='$paisEmpresa' and IdEmpr_DetalleDocumento='$empresaID' and Documento_DetalleDocumento='$Documento' and IdTipoDoc_DetalleDocumento=3";
	$resSuma= $mysqli->query($sqlSuma);
	while($Rowsuma = $resSuma->fetch_assoc()){
	$Total=$Rowsuma['total'];
	}
	
	
	$queryEncabezado = "INSERT INTO `entercon`.`ent_documento` (`Correlativo`, `IdPais_Documento`, `IdEmpr_Documento`, `IdTipoDoc_Documento`, `Documento_Documento`, `Fecha_Documento`,`IdBodSal_Documento`, `IdBodEnt_Documento`, `Valor_Documento`, `SaldoFinal_Documento` ,`Observaciones_Documento`, `Usuario_Documento`, `FechaCreacion_Documento`, `MaqCreacion_Documento`) VALUES ($maxid,'$paisEmpresa','$empresaID',3,'$Documento','$Fecha','$Bodega','$BodegaEntrada','$Total','$Total','$Observaciones','$usuarioLog','$Fecha','$Maquina') ";
	 $ResDocumento= $mysqli -> query($queryEncabezado);
	
	
$QueryTraslado = "INSERT INTO ent_detalledocumento (`IdPais_DetalleDocumento`, `IdEmpr_DetalleDocumento`, `IdTipoDoc_DetalleDocumento`, `Serie_DetalleDocumento`, `Documento_DetalleDocumento`, `IdTipoPago_Documento`, `Id_DetalleDocumento`, `IdUniMed_DetalleDocumento`, `Origen_DetalleDocumento`, `IdProd_DetalleDocumento`, `CodigoAlter_DetalleDocumento`, `CantidadV_DetalleDocumento`, `Cantidad_DetalleDocumento`, `ValorCosto_DetalleDocumento`, `ValorVenta_DetalleDocumento`, `Descuento_DetalleDocumento`)
       SELECT
          `IdPais_DetalleDocumento`, `IdEmpr_DetalleDocumento`, `IdTipoDoc_DetalleDocumento`, `Serie_DetalleDocumento`, `Documento_DetalleDocumento`, `IdTipoPago_Documento`, `Id_DetalleDocumento`, `IdUniMed_DetalleDocumento`, `Origen_DetalleDocumento`, `IdProd_DetalleDocumento`, `CodigoAlter_DetalleDocumento`, `CantidadV_DetalleDocumento`, `Cantidad_DetalleDocumento`, `ValorCosto_DetalleDocumento`, `ValorVenta_DetalleDocumento`, `Descuento_DetalleDocumento`
       FROM   ent_detalletemporal where  IdPais_DetalleDocumento = '$paisEmpresa' && IdEmpr_DetalleDocumento= '$empresaID' && Documento_DetalleDocumento = '$Documento' && IdTipoDoc_DetalleDocumento=3 AND Facturado_DetalleDocumentoT=0";
	  $respuestaTraslado = $mysqli -> query($QueryTraslado);
	  
	  $QDetalleT = "update ent_detalletemporal set Facturado_DetalleDocumentoT = 1  where  IdPais_DetalleDocumento = '$paisEmpresa' && IdEmpr_DetalleDocumento= '$empresaID' && Documento_DetalleDocumento = '$Documento' and IdTipoDoc_DetalleDocumento=3"; 
	   
	 
	  
	   $miputoarraeglo=array();
$BF = "select * from ent_detalletemporal where  IdPais_DetalleDocumento = '$paisEmpresa' && IdEmpr_DetalleDocumento= '$empresaID' && Documento_DetalleDocumento = '$Documento' && Facturado_DetalleDocumentoT=0 and IdTipoDoc_DetalleDocumento=3";
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
	$BodegaEntrada=$_POST['BodegaEntrada'];
	
$Sumarsalida= mysqli_query($mysqli,"update ent_movprod set Salida_MovProd  = Salida_MovProd  + '$CantidadVI' where Id_Pais_MovProd ='$paisEmpresa' AND Id_Empr_MovProd = '$empresaID' AND IdProd_MovProd = '$PROD' AND Id_Bode_MovProd='$Bodega'");


$SumarEntrada= mysqli_query($mysqli,"update ent_movprod set Entrada_MovProd = Entrada_MovProd + '$CantidadVI' where Id_Pais_MovProd ='$paisEmpresa' AND Id_Empr_MovProd = '$empresaID' AND IdProd_MovProd = '$PROD' AND Id_Bode_MovProd='$BodegaEntrada'");

	   $QDetalleT = "update ent_detalletemporal set Facturado_DetalleDocumentoT = 1  where  IdPais_DetalleDocumento = '$paisEmpresa' && IdEmpr_DetalleDocumento= '$empresaID' && Documento_DetalleDocumento = '$Documento' and IdTipoDoc_DetalleDocumento=3"; 	
	  $RespuestaQDT = $mysqli->query($QDetalleT);
	echo  json_encode($_POST);
		
}
if(isset($_POST['Inicio'])){
	$sqlValInicio="Select Min(Documento_Documento)as inicio  from ent_documento where IdPais_Documento='$paisEmpresa' AND IdEmpr_Documento='$empresaID' AND IdTipoDoc_Documento=3";
	$resValInicio=$mysqli->query($sqlValInicio);
	while($rowValInicio=$resValInicio->fetch_assoc()){ 
	$valorMin= $rowValInicio['inicio'];}
	
	$sqlInicio="Select*  from ent_documento where IdPais_Documento='$paisEmpresa' AND IdEmpr_Documento='$empresaID' AND IdTipoDoc_Documento=3 AND Documento_Documento='$valorMin'";
	$resInicio=$mysqli->query($sqlInicio);
	while($rowInicio=$resInicio->fetch_assoc()){
		$Documento=$rowInicio['Documento_Documento'];
		$Fecha=$rowInicio['Fecha_Documento'];
		$observaciones=$rowInicio['Observaciones_Documento'];
		$UsuarioDocumento=$rowInicio['Usuario_Documento'];
		//CONVERTIR ID CODIGO , TIPO PAGO Y OBTENER EL NOMBRE DE BODEGA
		$BodegaSalidaID=$rowInicio['IdBodSal_Documento'];
		$BodegaEntradaID=$rowInicio['IdBodEnt_Documento'];
		$Correlativo=$rowInicio['Correlativo'];
		$Total = $rowInicio['SaldoFinal_Documento'];
		
		}
				
					//  OBTENER EL NOMBRE DE BODEGA
					
					$sqlBOD="Select *  from ent_maesbode where Id_MaesPais='$paisEmpresa' AND Id_MaesEmpr='$empresaID' AND Id_MaesBode='$BodegaSalidaID'";
				$resBOD=$mysqli->query($sqlBOD);
				while($rowBOD=$resBOD->fetch_assoc()){
					$NombreBodegaSalida=$rowBOD['Nombre_MaesBode'];
					//enviar array
					}
					$sqlBODent="Select * from ent_maesbode where Id_MaesPais='$paisEmpresa' AND Id_MaesEmpr='$empresaID' AND Id_MaesBode='$BodegaEntradaID'";
				$resBODnt=$mysqli->query($sqlBODent);
				while($rowBODent=$resBODnt->fetch_assoc()){
					$NombreBodegaEntrada=$rowBODent['Nombre_MaesBode'];
					//enviar array
					}
				
		
		echo json_encode(array("Documento"=>$Documento,"Fecha"=>$Fecha,"BodegaIngresoID"=>$BodegaEntradaID,"BodegaIngresoNombre"=>$NombreBodegaEntrada,"Observaciones"=>$observaciones,"usuario"=>$UsuarioDocumento,"BodegaSalidaId"=>$BodegaSalidaID,"BodegaSalidaNombre"=>$NombreBodegaSalida,"Total"=>$Total,"Correlativo"=>$Correlativo));
}
elseif(isset($_POST['Final'])){
	$sqlValInicio="Select max(Documento_Documento)as maximo  from ent_documento where IdPais_Documento='$paisEmpresa' AND IdEmpr_Documento='$empresaID' AND IdTipoDoc_Documento=3";
	$resValInicio=$mysqli->query($sqlValInicio);
	while($rowValInicio=$resValInicio->fetch_assoc()){ 
	$valorMAX= $rowValInicio['maximo'];}
	
	$sqlInicio="Select*  from ent_documento where IdPais_Documento='$paisEmpresa' AND IdEmpr_Documento='$empresaID' AND IdTipoDoc_Documento=3 AND Documento_Documento='$valorMAX'";
	$resInicio=$mysqli->query($sqlInicio);
	while($rowInicio=$resInicio->fetch_assoc()){
		$Documento=$rowInicio['Documento_Documento'];
		$Fecha=$rowInicio['Fecha_Documento'];
		$observaciones=$rowInicio['Observaciones_Documento'];
		$UsuarioDocumento=$rowInicio['Usuario_Documento'];
		//CONVERTIR ID CODIGO , TIPO PAGO Y OBTENER EL NOMBRE DE BODEGA
		$BodegaSalidaID=$rowInicio['IdBodSal_Documento'];
		$BodegaEntradaID=$rowInicio['IdBodEnt_Documento'];
		$Correlativo=$rowInicio['Correlativo'];
		$Total = $rowInicio['SaldoFinal_Documento'];
		
		}
				
					//  OBTENER EL NOMBRE DE BODEGA
					
					$sqlBOD="Select *  from ent_maesbode where Id_MaesPais='$paisEmpresa' AND Id_MaesEmpr='$empresaID' AND Id_MaesBode='$BodegaSalidaID'";
				$resBOD=$mysqli->query($sqlBOD);
				while($rowBOD=$resBOD->fetch_assoc()){
					$NombreBodegaSalida=$rowBOD['Nombre_MaesBode'];
					//enviar array
					}
					$sqlBODent="Select * from ent_maesbode where Id_MaesPais='$paisEmpresa' AND Id_MaesEmpr='$empresaID' AND Id_MaesBode='$BodegaEntradaID'";
				$resBODnt=$mysqli->query($sqlBODent);
				while($rowBODent=$resBODnt->fetch_assoc()){
					$NombreBodegaEntrada=$rowBODent['Nombre_MaesBode'];
					//enviar array
					}
				
		
		echo json_encode(array("Documento"=>$Documento,"Fecha"=>$Fecha,"BodegaIngresoID"=>$BodegaEntradaID,"BodegaIngresoNombre"=>$NombreBodegaEntrada,"Observaciones"=>$observaciones,"usuario"=>$UsuarioDocumento,"BodegaSalidaId"=>$BodegaSalidaID,"BodegaSalidaNombre"=>$NombreBodegaSalida,"Total"=>$Total,"Correlativo"=>$Correlativo));
}
elseif(isset($_POST['Previo']))
{
$IDocumento=$_POST['Idocumento'];
	
	$sqlPrevio="Select * from ent_documento where IdPais_Documento='$paisEmpresa' AND IdEmpr_Documento='$empresaID' AND IdTipoDoc_Documento=3 AND Documento_Documento < '$IDocumento' ";
	$resPrevio=$mysqli->query($sqlPrevio);
		while($rowPrevio=$resPrevio->fetch_assoc()){
		$Documento=$rowPrevio['Documento_Documento'];
		$Fecha=$rowPrevio['Fecha_Documento'];
		$observaciones=$rowPrevio['Observaciones_Documento'];
		$UsuarioDocumento=$rowPrevio['Usuario_Documento'];
		//CONVERTIR ID CODIGO , TIPO PAGO Y OBTENER EL NOMBRE DE BODEGA
		$BodegaSalidaID=$rowPrevio['IdBodSal_Documento'];
		$BodegaEntradaID=$rowPrevio['IdBodEnt_Documento'];
		$Correlativo=$rowPrevio['Correlativo'];
		$Total = $rowPrevio['SaldoFinal_Documento'];
		
		}
				
					//  OBTENER EL NOMBRE DE BODEGA
					
					$sqlBOD="Select *  from ent_maesbode where Id_MaesPais='$paisEmpresa' AND Id_MaesEmpr='$empresaID' AND Id_MaesBode='$BodegaSalidaID'";
				$resBOD=$mysqli->query($sqlBOD);
				while($rowBOD=$resBOD->fetch_assoc()){
					$NombreBodegaSalida=$rowBOD['Nombre_MaesBode'];
					//enviar array
					}
					$sqlBODent="Select * from ent_maesbode where Id_MaesPais='$paisEmpresa' AND Id_MaesEmpr='$empresaID' AND Id_MaesBode='$BodegaEntradaID'";
				$resBODnt=$mysqli->query($sqlBODent);
				while($rowBODent=$resBODnt->fetch_assoc()){
					$NombreBodegaEntrada=$rowBODent['Nombre_MaesBode'];
					//enviar array
					}
				
		
		echo json_encode(array("Documento"=>$Documento,"Fecha"=>$Fecha,"BodegaIngresoID"=>$BodegaEntradaID,"BodegaIngresoNombre"=>$NombreBodegaEntrada,"Observaciones"=>$observaciones,"usuario"=>$UsuarioDocumento,"BodegaSalidaId"=>$BodegaSalidaID,"BodegaSalidaNombre"=>$NombreBodegaSalida,"Total"=>$Total,"Correlativo"=>$Correlativo));

}

elseif(isset($_POST['Siguiente']))
{
$IDocumento=$_POST['Idocumento'];
	
	$sqlInicio="Select*  from ent_documento where IdPais_Documento='$paisEmpresa' AND IdEmpr_Documento='$empresaID' AND IdTipoDoc_Documento=3 AND Documento_Documento > '$IDocumento' limit 1";
	$resInicio=$mysqli->query($sqlInicio);
		while($rowInicio=$resInicio->fetch_assoc()){
		$Documento=$rowInicio['Documento_Documento'];
		$Fecha=$rowInicio['Fecha_Documento'];
		$observaciones=$rowInicio['Observaciones_Documento'];
		$UsuarioDocumento=$rowInicio['Usuario_Documento'];
		//CONVERTIR ID CODIGO , TIPO PAGO Y OBTENER EL NOMBRE DE BODEGA
		$BodegaSalidaID=$rowInicio['IdBodSal_Documento'];
		$BodegaEntradaID=$rowInicio['IdBodEnt_Documento'];
		$Correlativo=$rowInicio['Correlativo'];
		$Total = $rowInicio['SaldoFinal_Documento'];
		
		}
				
					//  OBTENER EL NOMBRE DE BODEGA
					
					$sqlBOD="Select *  from ent_maesbode where Id_MaesPais='$paisEmpresa' AND Id_MaesEmpr='$empresaID' AND Id_MaesBode='$BodegaSalidaID'";
				$resBOD=$mysqli->query($sqlBOD);
				while($rowBOD=$resBOD->fetch_assoc()){
					$NombreBodegaSalida=$rowBOD['Nombre_MaesBode'];
					//enviar array
					}
					$sqlBODent="Select * from ent_maesbode where Id_MaesPais='$paisEmpresa' AND Id_MaesEmpr='$empresaID' AND Id_MaesBode='$BodegaEntradaID'";
				$resBODnt=$mysqli->query($sqlBODent);
				while($rowBODent=$resBODnt->fetch_assoc()){
					$NombreBodegaEntrada=$rowBODent['Nombre_MaesBode'];
					//enviar array
					}
				
		
		echo json_encode(array("Documento"=>$Documento,"Fecha"=>$Fecha,"BodegaIngresoID"=>$BodegaEntradaID,"BodegaIngresoNombre"=>$NombreBodegaEntrada,"Observaciones"=>$observaciones,"usuario"=>$UsuarioDocumento,"BodegaSalidaId"=>$BodegaSalidaID,"BodegaSalidaNombre"=>$NombreBodegaSalida,"Total"=>$Total,"Correlativo"=>$Correlativo));

}

elseif(isset($_POST['Buscar']))
{
$IDocumento=$_POST['Item'];
	
	$sqlInicio="Select*  from ent_documento where IdPais_Documento='$paisEmpresa' AND IdEmpr_Documento='$empresaID' AND IdTipoDoc_Documento=3 AND Correlativo = '$IDocumento' limit 1";
	$resInicio=$mysqli->query($sqlInicio);
		while($rowInicio=$resInicio->fetch_assoc()){
		$Documento=$rowInicio['Documento_Documento'];
		$Fecha=$rowInicio['Fecha_Documento'];
		$observaciones=$rowInicio['Observaciones_Documento'];
		$UsuarioDocumento=$rowInicio['Usuario_Documento'];
		//CONVERTIR ID CODIGO , TIPO PAGO Y OBTENER EL NOMBRE DE BODEGA
		$BodegaSalidaID=$rowInicio['IdBodSal_Documento'];
		$BodegaEntradaID=$rowInicio['IdBodEnt_Documento'];
		$Correlativo=$rowInicio['Correlativo'];
		$Total = $rowInicio['SaldoFinal_Documento'];
		
		}
				
					//  OBTENER EL NOMBRE DE BODEGA
					
					$sqlBOD="Select *  from ent_maesbode where Id_MaesPais='$paisEmpresa' AND Id_MaesEmpr='$empresaID' AND Id_MaesBode='$BodegaSalidaID'";
				$resBOD=$mysqli->query($sqlBOD);
				while($rowBOD=$resBOD->fetch_assoc()){
					$NombreBodegaSalida=$rowBOD['Nombre_MaesBode'];
					//enviar array
					}
					$sqlBODent="Select * from ent_maesbode where Id_MaesPais='$paisEmpresa' AND Id_MaesEmpr='$empresaID' AND Id_MaesBode='$BodegaEntradaID'";
				$resBODnt=$mysqli->query($sqlBODent);
				while($rowBODent=$resBODnt->fetch_assoc()){
					$NombreBodegaEntrada=$rowBODent['Nombre_MaesBode'];
					//enviar array
					}
				
		
		echo json_encode(array("Documento"=>$Documento,"Fecha"=>$Fecha,"BodegaIngresoID"=>$BodegaEntradaID,"BodegaIngresoNombre"=>$NombreBodegaEntrada,"Observaciones"=>$observaciones,"usuario"=>$UsuarioDocumento,"BodegaSalidaId"=>$BodegaSalidaID,"BodegaSalidaNombre"=>$NombreBodegaSalida,"Total"=>$Total,"Correlativo"=>$Correlativo));

}

elseif (isset($_POST['tabla_dataMantenimiento'])) {
	$uniquid = $_POST['Unicod'];
$TablaTemporalQ = "SELECT * FROM ent_detalletemporal where IdPais_DetalleDocumento = '$paisEmpresa' AND IdEmpr_DetalleDocumento = '$empresaID' AND Documento_DetalleDocumento ='".$uniquid."' AND IdTipoDoc_DetalleDocumento=3";

 
$ResPuesta = $mysqli->query($TablaTemporalQ);
$tilde = "'";
	$datos = '
<table class="tabla" border="1" bordercolor="#000000" bgcolor="#ccc">
<tr>

<th width="78" bgcolor="#FFFFFF">Codigo</th>
<th width="73" bgcolor="#FFFFFF">Cantidad</th>
<th width="321" bgcolor="#FFFFFF" align="left">Descripcion</th>
<th width="321" bgcolor="#FFFFFF" align="left">Unidad de medida</th>
<th width="187" bgcolor="#FFFFFF">Valor Compra</th>
<th width="126" bgcolor="#FFFFFF">Valor Venta</th>
<th width="126" bgcolor="#FFFFFF">Total</th>
</tr>
<tbody>';
while ($RowVenta = $ResPuesta->fetch_Assoc()){	
	$datos .='
<tr>
<td id="1">'.$RowVenta['CodigoAlter_DetalleDocumento'].'</td>
<td id="2">'.$RowVenta['Cantidad_DetalleDocumento'].'</td>
<td id="3">'.$RowVenta['Descripcion_DetalleDocumentoT'].'</td>
<td id="4">'.$RowVenta['IdUniMed_DetalleDocumento'].' </td>
<td id="5">'.$RowVenta['ValorCosto_DetalleDocumento'].' </td>
<td id="6">'.$RowVenta['ValorCosto_DetalleDocumento'].'</td>
<td id="6">'.$RowVenta['total'].'</td>
</tr>';
}
$datos .= '
</tbody>
</table>';
echo json_encode($datos);
}


elseif(isset($_POST['Eliminar'])){
	
	$DOCUMENT=$_POST['NoDocumento'];
	$BorrarDetalleOriginal=mysqli_query($mysqli,"DELETE FROM ent_detalledocumento where IdPais_DetalleDocumento='$paisEmpresa' and IdEmpr_DetalleDocumento='$empresaID' and IdTipoDoc_DetalleDocumento='3' and Documento_DetalleDocumento='$DOCUMENT'");
	
		$BorrarDetalleTemporal=mysqli_query($mysqli,"DELETE FROM ent_detalletemporal where IdPais_DetalleDocumento='$paisEmpresa' and IdEmpr_DetalleDocumento='$empresaID' and IdTipoDoc_DetalleDocumento='3' and Documento_DetalleDocumento='$DOCUMENT'");
		
	$BorrarEncabezadoDocumento=mysqli_query($mysqli,"DELETE FROM ent_documento where IdPais_Documento='$paisEmpresa' and IdEmpr_Documento='$empresaID' and IdTipoDoc_Documento='3' and Documento_Documento='$DOCUMENT'");
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