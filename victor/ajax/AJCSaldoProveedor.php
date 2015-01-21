<?php

session_start();

if (isset ($_SESSION['Usuario']))
{require('../coneccion.php');

$paisEmpresa = $_SESSION['Pais'];
$empresaID= $_SESSION['Empresa'];
$usuarioLog=$_SESSION['Usuario'];
$Maquina=gethostname();
if(isset($_POST['Cliente']))
	{
	$Codigo=array();
		$sql = "SELECT * FROM `ent_maessocio` WHERE `Id_MaesPais`='$paisEmpresa' AND `Id_MaesEmpr`='$empresaID'  and `Tipo_MaesSocio`=2";
		$Resultado  = $mysqli->query($sql);
				while($row = $Resultado->fetch_assoc())
				{
					$Codigo["Codigo"][] = array('IdSocio' => $row['Id_Socio'],'Razon'=>$row['RazonSocial_MaesSocio']);
				}
		echo json_encode($Codigo);
	}

elseif (isset($_POST['TablaPE'])) {
	$CodSocio = $_POST['Codigo'];
$SaldoQuery = "select * from ent_documento where IdPais_Documento = '$paisEmpresa' AND IdEmpr_Documento = '$empresaID' AND IdTipoDoc_Documento = 2 AND Estatus_Documento='PP' AND IdTipoPago_Documento= 1 AND Codigo_Documento='$CodSocio' ";
	   $SaldoQueryConsulta = $mysqli->query($SaldoQuery);

$tilde = "'";
	$datos = '
<table class="tabla" border="2" bordercolor="#000000" bgcolor="#ddd">
<tr>

 		<th width="auto" valign="middle" bgcolor="#FFFFFF">No.Factura</th>
        <th width="auto" bgcolor="#FFFFFF">Envio</th>
        <th width="auto" bgcolor="#FFFFFF">Fecha</th>
        <th width="auto" bgcolor="#FFFFFF">Valor</th>
        <th width="auto" bgcolor="#FFFFFF">Pagos</th>
        <th width="auto" bgcolor="#FFFFFF">Saldo Final</th>
    
</tr>
<tbody>';
  while($RowSaldo = $SaldoQueryConsulta->fetch_Assoc()){	
	$datos .='
<tr onmouseover = "color(this)" onmouseout="colorBack(this)">
<td>'.$RowSaldo['Id_Documento'].'</td>
<td>'.$RowSaldo['Correlativo'].'</td>
<td>'. $RowSaldo['Fecha_Documento'].'</td>
<td>'.$RowSaldo['Valor_Documento'].' </td>
<td>'.$RowSaldo['Movimiento_Documento'].' </td>
<td>'.$RowSaldo['SaldoFinal_Documento'].'</td>
<td>
<input type="button" onclick="Abonar('.$RowSaldo['Documento_Documento'].');" value="Abonar"/></p>
</td>
<td>
<input type="button" onclick="VerRecivos('.$RowSaldo['Documento_Documento'].');" value="Ver Recivos"/></p>
</td>
</tr>';
}
$datos .= '
</tbody>
</table>';
echo json_encode($datos);
}
elseif (isset($_POST['TablaPEPA'])) {
	$CodSocio = $_POST['Codigo'];
$SaldoQuery = "select * from ent_documento where IdPais_Documento = '$paisEmpresa' AND IdEmpr_Documento = '$empresaID' AND IdTipoDoc_Documento = 2  AND IdTipoPago_Documento= 1 AND Codigo_Documento='$CodSocio' ";
	   $SaldoQueryConsulta = $mysqli->query($SaldoQuery);

$tilde = "'";
	$datos = '
<table class="tabla" border="2" bordercolor="#000000" bgcolor="#ddd">
<tr onmouseover = "color(this)" onmouseout="colorBack(this)">

 		<th width="auto" valign="middle" bgcolor="#FFFFFF">No.Factura</th>
        <th width="auto" bgcolor="#FFFFFF">Envio</th>
        <th width="auto" bgcolor="#FFFFFF">Fecha</th>
        <th width="auto" bgcolor="#FFFFFF">Valor</th>
        <th width="auto" bgcolor="#FFFFFF">Pagos</th>
        <th width="auto" bgcolor="#FFFFFF">Saldo Final</th>
</tr>
<tbody>';
  while($RowSaldo = $SaldoQueryConsulta->fetch_Assoc()){	
	$datos .='
<tr>
<td>'.$RowSaldo['Id_Documento'].'</td>
<td>'.$RowSaldo['Correlativo'].'</td>
<td>'. $RowSaldo['Fecha_Documento'].'</td>
<td>'.$RowSaldo['Valor_Documento'].' </td>
<td>'.$RowSaldo['Movimiento_Documento'].' </td>
<td>'.$RowSaldo['SaldoFinal_Documento'].'</td>
<td>
<input type="button" onclick="Abonar('.$RowSaldo['Documento_Documento'].');" value="Abonar"/></p>
</td>
<td>
<input type="button" onclick="VerRecivos('.$RowSaldo['Documento_Documento'].');" value="Ver Recivos"/></p>
</td>
</tr>';
}
$datos .= '
</tbody>
</table>';
echo json_encode($datos);
}
elseif(isset($_POST['Abono'])){
	date_default_timezone_set('America/Guatemala');
	 $fecha = date('y-m-d h:i:s');
$Cantidad=$_POST['Cantidad'];
$Idocumento=$_POST['Idocumento'];

$MAXID=mysqli_query($mysqli,"select max(Id_Recibo)+1 as maximo from ent_recibo where NoDocto_Recibo='$Idocumento'");
while($rowMXID= $MAXID->fetch_assoc()){$bin = $rowMXID['maximo']; 
		if ($bin!=""){
			$maxid = $rowMXID['maximo'];}
		else{$maxid=1;}
		}
		
		
		$BuscarDatosRecibo= mysqli_query($mysqli,"select * from ent_documento where IdPais_Documento='$paisEmpresa' and IdEmpr_Documento='$empresaID' and  Documento_Documento='$Idocumento'");
		$row=$BuscarDatosRecibo->fetch_assoc();
		$Codigo=$row['Codigo_Documento'];
		$CantidadAntigua=$row['Movimiento_Documento'];
$ValorDocumento=$row['Valor_Documento'];
		
		
			if($Cantidad <= $row['SaldoFinal_Documento']){
		

	
$TotalPagos=$CantidadAntigua + $Cantidad;
$TotalSaldoFinal=$ValorDocumento-$TotalPagos;
$sql=mysqli_query($mysqli,"update ent_documento set Movimiento_Documento ='$TotalPagos', SaldoFinal_Documento='$TotalSaldoFinal' where IdPais_Documento='$paisEmpresa' AND IdEmpr_Documento='$empresaID' AND Documento_Documento='$Idocumento' ");


$Cerrado=0;


			
	$Nuevoo=mysqli_query($mysqli,"INSERT INTO ent_recibo (`Id_Recibo`, `NoDocto_Recibo`, `IdCliente_Recibo`, `Fecha_Recibo`, `Valor_Recibo`, `IdTipoPago_Recibo`, Cerrado_Recibo,`Usuario_Recibo`, `FechaCreacion_Recibo`, `MaqCreacion_Recibo`) VALUES ('$maxid','$Idocumento','$Codigo','$fecha','$Cantidad','1','$Cerrado','$usuarioLog','$fecha', '$Maquina')");
echo json_encode(array("binario"=>1));
									}else {echo json_encode(array("binario"=>0));}
}



elseif (isset($_POST['Recibos'])) {
	$Documento = $_POST['Documento'];
$SaldoQuery = "select * from ent_recibo where NoDocto_Recibo ='$Documento'";
	   $SaldoQueryConsulta = $mysqli->query($SaldoQuery);

$tilde = "'";
	$datos = '
<table class="tabla" border="2" bordercolor="#000000" bgcolor="#ddd">
<tr onmouseover = "color(this)" onmouseout="colorBack(this)">

 		<th width="auto" valign="middle" bgcolor="#FFFFFF">Id</th>
        <th width="auto" bgcolor="#FFFFFF">Cliente</th>
        <th width="auto" bgcolor="#FFFFFF">Fecha</th>
        <th width="auto" bgcolor="#FFFFFF">Valor</th>
        
</tr>
<tbody>';
  while($RowSaldo = $SaldoQueryConsulta->fetch_Assoc()){	
	$datos .='
<tr>
<td>'.$RowSaldo['Id_Recibo'].'</td>
<td>'. $RowSaldo['IdCliente_Recibo'].'</td>
<td>'.$RowSaldo['Fecha_Recibo'].' </td>
<td>'.$RowSaldo['Valor_Recibo'].' </td>

</tr>';
}
$datos .= '
</tbody>
</table>';
echo json_encode($datos);
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