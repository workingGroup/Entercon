<?php

session_start();

if (isset ($_SESSION['Usuario']))
{require('../coneccion.php');

$paisEmpresa = $_SESSION['Pais'];
$empresaID= $_SESSION['Empresa'];
$usuarioLog=$_SESSION['Usuario'];
$Bodega= 1 ; 
$Maquina=gethostname();
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
		$QueryDataProd = "select * from ent_maesprod where IdPais_MaesProd = '$paisEmpresa' AND IdEmpr_MaesProd= '$empresaID' AND IdProd_MaesProd = '$idprod'";
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

		$sqlE = "select * from ent_movprod  where Id_Pais_MovProd ='$paisEmpresa' AND Id_Empr_MovProd ='$empresaID'  AND IdProd_MovProd = '$idprod' and  Id_Bode_MovProd='$Bodega' limit 1 ";
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
						$ArrayExistencias["decuento"]=$_SESSION['porciento'];
						$ArrayExistencias["ValorCompra"]=$ValorCompra;
						
								
		
echo json_encode($ArrayExistencias);


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
elseif (isset($_POST['tabla_data'])) {
	$uniquid = $_POST['Unicod'];
$TablaTemporalQ = "SELECT * FROM ent_detalletemporal where IdPais_DetalleDocumento = '$paisEmpresa' AND IdEmpr_DetalleDocumento = '$empresaID' AND Documento_DetalleDocumento ='".$uniquid."' and IdTipoDoc_DetalleDocumento=1";

 
$ResPuesta = $mysqli->query($TablaTemporalQ);
$tilde = "'";
	$datos = '
<table class="tabla" border="1" bordercolor="#000000" bgcolor="#ccc">
<tr>

<th width="78" bgcolor="#FFFFFF">Cantidad</th>
<th width="73" bgcolor="#FFFFFF">Codigo</th>
<th width="321" bgcolor="#FFFFFF" align="left">Descripcion</th>
<th width="321" bgcolor="#FFFFFF" align="left">U medida</th>
<th width="187" bgcolor="#FFFFFF">Val Unitario</th>
<th width="126" bgcolor="#FFFFFF">Total</th>
</tr>
<tbody>';
while ($RowVenta = $ResPuesta->fetch_Assoc()){	
	$datos .='
<tr>
<td id="1">'.$RowVenta['Cantidad_DetalleDocumento'].'</td>
<td id="2">'.$RowVenta['CodigoAlter_DetalleDocumento'].'</td>
<td id="3">'.$RowVenta['Descripcion_DetalleDocumentoT'].'</td>
<td id="4">'.$RowVenta['IdUniMed_DetalleDocumento'].' </td>
<td id="5">'.$RowVenta['ValorVenta_DetalleDocumento'].' </td>
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
elseif(isset($_POST['Cliente']))
	{
$QueryCliente = "Select * from ent_maessocio where Id_MaesPais= '$paisEmpresa' AND Id_MaesEmpr='$empresaID' AND Tipo_MaesSocio=1 AND Nit_MaesSociocol LIKE '".$_POST['Cliente']."%'";
$ResCliente =$mysqli->query($QueryCliente);
$arregloCliente = array();
				while($rowCliente = mysqli_fetch_array($ResCliente))
				{
					$llave = $rowCliente['Id_Socio'];
					$arregloCliente[$llave] = $rowCliente['Nit_MaesSociocol'];
				}
		echo json_encode($arregloCliente);
	}
elseif(isset($_POST['NITFILL']))
	{
	$Nit = $_POST['nitR'];
$QueryClientefILL = "Select * from ent_maessocio where Id_MaesPais= '$paisEmpresa' AND Id_MaesEmpr='$empresaID'  AND Tipo_MaesSocio=1 AND Nit_MaesSociocol = '$Nit'";
$ResClientefILL=$mysqli->query($QueryClientefILL);

				while($rowClienteFill = $ResClientefILL->fetch_assoc())
				{
					$Nombre = $rowClienteFill['RazonSocial_MaesSocio'];
					$Direccion= $rowClienteFill['Direccion_MaesSocio'];
				}

		    echo json_encode(array("Nombre"=>$Nombre, "Direccion"=>$Direccion));
		   
	}
elseif(isset($_POST['valoresct']))
	{
	$uniquid = $_POST['DocID'];
$sumQ = "SELECT SUM(total) as total_DOC,SUM(Cantidad_DetalleDocumento) as total_U FROM ent_detalletemporal where IdPais_DetalleDocumento = '$paisEmpresa' AND IdEmpr_DetalleDocumento = '$empresaID' AND Documento_DetalleDocumento ='$uniquid' and IdTipoDoc_DetalleDocumento=1"; 
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
		$codProd = "";
		$unidades = "";
		$Descuento = "";
		$valorV="";
		$OrigenM="";
		$RELATIONM="";
		
			
$DatosRowQ = "Select *FROM ent_detalletemporal where IdPais_DetalleDocumento = '$paisEmpresa' AND IdEmpr_DetalleDocumento = '$empresaID' AND Documento_DetalleDocumento ='$IDDoc' AND Id_DetalleDocumento='$IDDelete' and IdTipoDoc_DetalleDocumento=1";
	$RDatosRowQ = $mysqli->query($DatosRowQ);
	while ($DatosRow=$RDatosRowQ->fetch_assoc()){
		$Medida = $DatosRow ['IdUniMed_DetalleDocumento'];	
		$codProd = $DatosRow ['IdProd_DetalleDocumento'];	
		$unidades = $DatosRow ['Cantidad_DetalleDocumento'];
		$OrigenM=$DatosRow['Origen_DetalleDocumento'];
	}
	

$Total=($unidades * $valorV)-$Descuento;
				if($OrigenM=="M"){
	
					$salida= $unidades ;
					}
				elseif($OrigenM=="D"){
					
						$QueryDataProd = "select * from ent_detunimed where IdPais_DetUniMedida = '$paisEmpresa' AND IdEmpr_DetUniMedida= '$empresaID' AND Id_DetUniMedida = '$Medida' ";
$ResData = $mysqli->query($QueryDataProd);
while($rowData = $ResData->fetch_assoc())

		{
			$RELATIONM=$rowData['Relacion_DetUniMed'];
		}
		$salida=$unidades/$RELATIONM;
				}
$SumarVentaQ ="update ent_movprod set Salida_MovProd = Salida_MovProd - '$salida' where Id_Pais_MovProd ='$paisEmpresa' AND Id_Empr_MovProd = '$empresaID' AND IdProd_MovProd = '$codProd' and Id_Bode_MovProd='$Bodega'";
			$respuestaSumar = $mysqli->query($SumarVentaQ);
			
			$DelQ = "DELETE FROM ent_detalletemporal where IdPais_DetalleDocumento = '$paisEmpresa' AND IdEmpr_DetalleDocumento = '$empresaID' AND Documento_DetalleDocumento ='$IDDoc' AND Id_DetalleDocumento='$IDDelete' and IdTipoDoc_DetalleDocumento=1";
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
		$ConsultaExistencias = "SELECT * FROM ent_movprod WHERE Id_Pais_MovProd='$paisEmpresa' AND Id_Empr_MovProd = '$empresaID' AND IdProd_MovProd = '$Codigo' and Id_Bode_MovProd='$Bodega'";
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
	$Serie = $_POST ['serieR'];
	$medidaUN = $_POST['medidaR'];
	$DocID = $_POST['documentoR'];
	$Descuento = $_POST['TotalDesc'];	
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
$Total=($unidades * $valorV)-$Descuento;
$IDROW = time();

			$queryADD = "INSERT INTO ent_detalletemporal(IdPais_DetalleDocumento, IdEmpr_DetalleDocumento, IdTipoDoc_DetalleDocumento, Serie_DetalleDocumento, Documento_DetalleDocumento, IdTipoPago_Documento, Id_DetalleDocumento, IdUniMed_DetalleDocumento, Origen_DetalleDocumento, IdProd_DetalleDocumento, CodigoAlter_DetalleDocumento, CantidadV_DetalleDocumento,Cantidad_DetalleDocumento, ValorCosto_DetalleDocumento, ValorVenta_DetalleDocumento, Descuento_DetalleDocumento,total,Facturado_DetalleDocumentoT,Descripcion_DetalleDocumentoT) VALUES ('$paisEmpresa','$empresaID',1,'$Serie','$DocID','$TipoPago','$IDROW','$medidaUN','$Origen','$codProd','$codAlter','$CantidadV','$unidades','$valorC','$valorV','$Descuento','$Total',0,'$Descripcion')";
			$respuestaADD = $mysqli->query($queryADD);
			
			if($Origen=="M"){
				$salida= $unidades ;
				}
				elseif($Origen="D"){
				$salida=$unidades/$RELATIONM;
				}
			$SumarVentaQ ="update ent_movprod set Salida_MovProd = Salida_MovProd + '$salida' where Id_Pais_MovProd ='$paisEmpresa' AND Id_Empr_MovProd = '$empresaID' AND IdProd_MovProd = '$codProd' AND Id_Bode_MovProd='$Bodega'";
			$respuestaSumar = $mysqli->query($SumarVentaQ);
			echo json_encode($Total);
	}
elseif(isset($_POST["Insertar"])){
	$MAXID=mysqli_query($mysqli,"select max(Correlativo)+1 as maximo from ent_documento where IdPais_Documento='$paisEmpresa' and IdEmpr_Documento='$empresaID' and IdTipoDoc_Documento =1 ");
while($rowMXID= $MAXID->fetch_assoc()){$bin = $rowMXID['maximo']; 
		if ($bin!=""){
			$maxid = $rowMXID['maximo'];}
		else{$maxid=1;}
		}
	$IDdocumento = $_POST['IDDOC'];
	$Fecha = $_POST['Fecha'];
	$Serie = $_POST['Serie'];
	$Factura = $_POST['Factura'];
	$NIT = $_POST['NIT'];
	$Tpago = $_POST['Tpago'];
	$TDoc = $_POST['TDoc'];
	$Bodega = 1;
	// $NIT = $_POST['NIT']; hacer consulta de nit y almacenar en variable $Codigo 
	$sqlIdCliente= "SELECT * FROM `ent_maessocio` WHERE `Id_MaesPais`= '$paisEmpresa' and `Id_MaesEmpr`='$empresaID' and`Nit_MaesSociocol`='$NIT' ";
	$resIdCLiente= $mysqli->query($sqlIdCliente);
	while($RowIDCliente = $resIdCLiente->fetch_assoc()){
	$Codigo=$RowIDCliente['Id_Socio'];
	}
	$sqlSuma= "SELECT sum(total)as total FROM `ent_detalletemporal` where IdPais_DetalleDocumento='$paisEmpresa' and IdEmpr_DetalleDocumento='$empresaID' and Documento_DetalleDocumento='$IDdocumento'";
	$resSuma= $mysqli->query($sqlSuma);
	while($Rowsuma = $resSuma->fetch_assoc()){
	$Total=$Rowsuma['total'];
	}
	$sqlEstatus= "SELECT * FROM Ent_MaesTipoPago where Id_MaesTipoPago='$Tpago' and IdPais_MaesTipoPago='$paisEmpresa' and IdEmpresa_MaesTipoPago='$empresaID'";
	$resEstatus= $mysqli->query($sqlEstatus);
	while($RowEstatus = $resEstatus->fetch_assoc()){
	$Estatus=$RowEstatus['Estatus_MaesTipoPago'];
	}
	
	
	$queryEncabezado = "INSERT INTO `ent_documento`(Correlativo,`IdPais_Documento`,`IdEmpr_Documento`,`IdTipoDoc_Documento`,`Serie_Documento`,`Documento_Documento`,`IdTipoPago_Documento`,`Id_Documento`,`Fecha_Documento`,`Codigo_Documento`,`IdBodSal_Documento`,`Valor_Documento`,SaldoFinal_Documento,`Estatus_Documento`,`Usuario_Documento`, `FechaCreacion_Documento`,`MaqCreacion_Documento`) VALUES ('$maxid','$paisEmpresa','$empresaID',1,'$Serie','$IDdocumento','$Tpago','$Factura','$Fecha','$Codigo','$Bodega','$Total','$Total','$Estatus','$usuarioLog','$Fecha','$Maquina') ";
	 $ResDocumento= $mysqli -> query($queryEncabezado);
	
	
$QueryTraslado = "INSERT INTO ent_detalledocumento (`IdPais_DetalleDocumento`, `IdEmpr_DetalleDocumento`, `IdTipoDoc_DetalleDocumento`, `Serie_DetalleDocumento`, `Documento_DetalleDocumento`, `IdTipoPago_Documento`, `Id_DetalleDocumento`, `IdUniMed_DetalleDocumento`, `Origen_DetalleDocumento`, `IdProd_DetalleDocumento`, `CodigoAlter_DetalleDocumento`, `CantidadV_DetalleDocumento`, `Cantidad_DetalleDocumento`, `ValorCosto_DetalleDocumento`, `ValorVenta_DetalleDocumento`, `Descuento_DetalleDocumento`)
       SELECT
          `IdPais_DetalleDocumento`, `IdEmpr_DetalleDocumento`, `IdTipoDoc_DetalleDocumento`, `Serie_DetalleDocumento`, `Documento_DetalleDocumento`, `IdTipoPago_Documento`, `Id_DetalleDocumento`, `IdUniMed_DetalleDocumento`, `Origen_DetalleDocumento`, `IdProd_DetalleDocumento`, `CodigoAlter_DetalleDocumento`, `CantidadV_DetalleDocumento`, `Cantidad_DetalleDocumento`, `ValorCosto_DetalleDocumento`, `ValorVenta_DetalleDocumento`, `Descuento_DetalleDocumento`
       FROM   ent_detalletemporal where  IdPais_DetalleDocumento = '$paisEmpresa' && IdEmpr_DetalleDocumento= '$empresaID' && Documento_DetalleDocumento = '$IDdocumento' && IdTipoDoc_DetalleDocumento=1" ;
	  $respuestaTraslado = $mysqli -> query($QueryTraslado);
	  
	  $QDetalleT = "update ent_detalletemporal set Facturado_DetalleDocumentoT = 1  where  IdPais_DetalleDocumento = '$paisEmpresa' && IdEmpr_DetalleDocumento= '$empresaID' && Documento_DetalleDocumento = '$IDdocumento' and IdTipoDoc_DetalleDocumento=1"; 	
	  $RespuestaQDT = $mysqli->query($QDetalleT);

}
elseif(isset($_POST['FacturadoSN'])){
$IDdocumento = $_POST['IDDOC'];
$miputoarraeglo=array();
$BF = "select * from ent_detalletemporal where  IdPais_DetalleDocumento = '$paisEmpresa' && IdEmpr_DetalleDocumento= '$empresaID' && Documento_DetalleDocumento = '$IDdocumento' && Facturado_DetalleDocumentoT=0 and IdTipoDoc_DetalleDocumento=1";
$RespuestaBF = $mysqli -> query($BF);
while($rowBF = $RespuestaBF->fetch_assoc())
				{			
				$llave = $rowBF['Facturado_DetalleDocumentoT'];
				$miputoarraeglo["valores"][]=array('Producto' => $rowBF['IdProd_DetalleDocumento'],'CantidadV'=>$rowBF['CantidadV_DetalleDocumento']);
				}
echo json_encode($miputoarraeglo);	
}
elseif(isset($_POST['Update']))
{
	$CantidadVI= $_POST['cantidadV'];
	$PROD = $_POST['Codigo'];
	$Doc = $_POST['IDDOC'];
$UMPRODQ= "update ent_movprod set Salida_MovProd = Salida_MovProd - '$CantidadVI' where Id_Pais_MovProd ='$paisEmpresa' AND Id_Empr_MovProd = '$empresaID' AND IdProd_MovProd = '$PROD' AND Id_Bode_MovProd='$Bodega'";
$RUMP=$mysqli->query($UMPRODQ);

	
	$DelQ = "DELETE FROM ent_detalletemporal where IdPais_DetalleDocumento = '$paisEmpresa' AND IdEmpr_DetalleDocumento = '$empresaID' AND Documento_DetalleDocumento ='$Doc' and IdTipoDoc_DetalleDocumento=1";
		$resultado = $mysqli->query($DelQ);
		
}
elseif(isset($_POST['IDDOC'])){
$IDDoc=$_POST['IDDOC'];
$BINQ = "SELECT *FROM ent_detalletemporal where IdPais_DetalleDocumento = '$paisEmpresa' AND IdEmpr_DetalleDocumento = '$empresaID' AND Documento_DetalleDocumento ='$IDDoc' and IdTipoDoc_DetalleDocumento=1 limit 1";
		$RBINQ = $mysqli->query($BINQ);
		while ($ROWBIN=$RBINQ->fetch_assoc()){$mybin =$ROWBIN['Facturado_DetalleDocumentoT'];}
	echo json_encode($mybin);
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