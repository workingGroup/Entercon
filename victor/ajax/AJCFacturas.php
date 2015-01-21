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
		$sql = "SELECT * FROM `ent_maessocio` WHERE `Id_MaesPais`='$paisEmpresa' AND `Id_MaesEmpr`='$empresaID'  and`Tipo_MaesSocio`=1";
		$Resultado  = $mysqli->query($sql);
				while($row = $Resultado->fetch_assoc())
				{
					$Codigo["Codigo"][] = array('IdSocio' => $row['Id_Socio'],'Razon'=>$row['RazonSocial_MaesSocio']);
				}
		echo json_encode($Codigo);
	}

elseif (isset($_POST['TablaPE'])) {
$SaldoQuery = "select * from ent_documento where IdPais_Documento = '$paisEmpresa' AND IdEmpr_Documento = '$empresaID' AND IdTipoDoc_Documento = 1  ";
	   $SaldoQueryConsulta = $mysqli->query($SaldoQuery);

$tilde = "'";
	$datos = '
<table class="tabla" border="2" bordercolor="#000000" bgcolor="#ddd">
<tr>
		<td bgcolor="#FFFFFF"><b>Envio</b></td>
		<td bgcolor="#FFFFFF"><b>Factura</b></td>
		<td bgcolor="#FFFFFF"><b>Codigo</b></td>
		<td bgcolor="#FFFFFF"><b>Fecha</b></td>
        <td bgcolor="#FFFFFF"><b>Nombre</b></td>
		<td bgcolor="#FFFFFF"><b>Valor</b></td>
		<td bgcolor="#FFFFFF"><b>Estatus</b></td>
</tr>
<tbody>';
  while($RowSaldo = $SaldoQueryConsulta->fetch_Assoc()){	
	$datos .='
<tr>
<td>'.$RowSaldo['Correlativo'].'</td>
<td>'.$RowSaldo['Id_Documento'].'</td>
<td>'.$RowSaldo['Codigo_Documento'].'</td>
<td>'.$RowSaldo['Fecha_Documento'].'</td>
<td>Nombre</td>
<td>'.$RowSaldo['Valor_Documento'].' </td>
<td>'.$RowSaldo['Estatus_Documento'].'</td>
<td>
<input type="button" onclick="Reimprimir('.$RowSaldo['Documento_Documento'].');" value="Reimprimir"/></p>
</td>
<td>
<input type="button" onclick="Anular('.$RowSaldo['Id_Documento'].');" value="Anular"/></p>
</td>
</tr>';
}
$datos .= '
</tbody>
</table>';
echo json_encode($datos);
}
elseif(isset($_POST['Abono'])){
$Cantidad=$_POST['Cantidad'];
$Idocumento=$_POST['Idocumento'];

$sqlSF=mysqli_query($mysqli,"Select* from ent_documento where IdPais_Documento='$paisEmpresa' AND IdEmpr_Documento='$empresaID' AND Documento_Documento='$Idocumento'");
$rowSF=$sqlSF->fetch_assoc();
$CantidadAntigua=$rowSF['Movimiento_Documento'];
$ValorDocumento=$rowSF['Valor_Documento'];

$TotalPagos=$CantidadAntigua + $Cantidad;
$TotalSaldoFinal=$ValorDocumento-$TotalPagos;
$sql=mysqli_query($mysqli,"update ent_documento set Movimiento_Documento ='$TotalPagos', SaldoFinal_Documento='$TotalSaldoFinal' where IdPais_Documento='$paisEmpresa' AND IdEmpr_Documento='$empresaID' AND Documento_Documento='$Idocumento' ");
echo json_encode($sql);

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