<?php

session_start();

if (isset ($_SESSION['Usuario']))
{require('../coneccion.php');

$paisEmpresa=$_SESSION['Pais'];	
$empresaID= $_SESSION['Empresa'];	
$usuarioLog=$_SESSION['Usuario'];
date_default_timezone_set('America/Guatemala');
$Fecha = date('y-m-d h:i:s');
$Maquina=gethostname();
///////////////////////////////////////////////
if(isset($_POST['Inicio']))
{
$UsuarioMinimo=mysqli_query($mysqli,"SELECT MIN(id_MaesUsua)AS MIN FROM ent_maesusua WHERE Id_MaesPais='$paisEmpresa' AND Id_MaesEmpr='$empresaID'");
	$rowMinimo=$UsuarioMinimo->fetch_assoc();
		$IdMinimo=$rowMinimo['MIN'];
$DatosDeUsuario=mysqli_query($mysqli,"SELECT * FROM ent_maesusua WHERE Id_MaesPais='$paisEmpresa' AND Id_MaesEmpr='$empresaID' AND id_MaesUsua='$IdMinimo'");
$RowUserData=$DatosDeUsuario->fetch_assoc();
$IdRole=mysqli_query($mysqli,"SELECT * FROM ent_rolexusuario WHERE Ent_Role_IdPais_Role='$paisEmpresa' AND Ent_Role_IdEmpr_Role='$empresaID' AND IdUsuario_UsuarioXRole='$IdMinimo'");
$rowIdRole=$IdRole->fetch_assoc();	
$IdRole=$rowIdRole['idrole_UsuarioXRole'];

$RoleQ=mysqli_query($mysqli,"SELECT * FROM ent_role WHERE IdPais_Role='$paisEmpresa' AND IdEmpr_Role='$empresaID' AND id_Role='$IdRole'");
$rowRole=$RoleQ->fetch_assoc();	
$Role=$rowRole['Nombre_Role'];	


echo json_encode(array("Id"=>$IdMinimo,"Nombre"=>$RowUserData['NombreCompleto_MaesUsua'],"Contraseña"=>"HELLO WORLD","Descuento"=>$RowUserData['MaxDscto_MaesUsua'],"NombreUsuario"=>$RowUserData['Usuario_MaesUsua'],"Role"=>$Role,"Usuario"=>$RowUserData['Ent_UsuarioCreacion'],"Fecha"=>$RowUserData['FechaCreacion_MaesUsua'],"Maquina"=>$RowUserData['MaqCreacion_MaesUsua']));

}
//////////////////////////////////////////////
if(isset($_POST['Final']))
{
$UsuarioMinimo=mysqli_query($mysqli,"SELECT MAX(id_MaesUsua)AS MIN FROM ent_maesusua WHERE Id_MaesPais='$paisEmpresa' AND Id_MaesEmpr='$empresaID'");
	$rowMinimo=$UsuarioMinimo->fetch_assoc();
		$IdMinimo=$rowMinimo['MIN'];
$DatosDeUsuario=mysqli_query($mysqli,"SELECT * FROM ent_maesusua WHERE Id_MaesPais='$paisEmpresa' AND Id_MaesEmpr='$empresaID' AND id_MaesUsua='$IdMinimo'");
$RowUserData=$DatosDeUsuario->fetch_assoc();
$IdRole=mysqli_query($mysqli,"SELECT * FROM ent_rolexusuario WHERE Ent_Role_IdPais_Role='$paisEmpresa' AND Ent_Role_IdEmpr_Role='$empresaID' AND IdUsuario_UsuarioXRole='$IdMinimo'");
$rowIdRole=$IdRole->fetch_assoc();	
$IdRole=$rowIdRole['idrole_UsuarioXRole'];

$RoleQ=mysqli_query($mysqli,"SELECT * FROM ent_role WHERE IdPais_Role='$paisEmpresa' AND IdEmpr_Role='$empresaID' AND id_Role='$IdRole'");
$rowRole=$RoleQ->fetch_assoc();	
$Role=$rowRole['Nombre_Role'];	


echo json_encode(array("Id"=>$IdMinimo,"Nombre"=>$RowUserData['NombreCompleto_MaesUsua'],"Contraseña"=>"HELLO WORLD","Descuento"=>$RowUserData['MaxDscto_MaesUsua'],"NombreUsuario"=>$RowUserData['Usuario_MaesUsua'],"Role"=>$Role,"Usuario"=>$RowUserData['Ent_UsuarioCreacion'],"Fecha"=>$RowUserData['FechaCreacion_MaesUsua'],"Maquina"=>$RowUserData['MaqCreacion_MaesUsua']));

}
//////////////////////////////////////////////
if(isset($_POST['Previo']))
{
		$IdMinimo=$_POST['Documento'];
$DatosDeUsuario=mysqli_query($mysqli,"SELECT * FROM ent_maesusua WHERE Id_MaesPais='$paisEmpresa' AND Id_MaesEmpr='$empresaID' AND id_MaesUsua < '$IdMinimo' order by id_MaesUsua desc limit 1");
$RowUserData=$DatosDeUsuario->fetch_assoc();
$IDuser=$RowUserData['id_MaesUsua'];

$IdRole=mysqli_query($mysqli,"SELECT * FROM ent_rolexusuario WHERE Ent_Role_IdPais_Role='$paisEmpresa' AND Ent_Role_IdEmpr_Role='$empresaID' AND IdUsuario_UsuarioXRole='$IDuser'");
$rowIdRole=$IdRole->fetch_assoc();	
$IdRole=$rowIdRole['idrole_UsuarioXRole'];

$RoleQ=mysqli_query($mysqli,"SELECT * FROM ent_role WHERE IdPais_Role='$paisEmpresa' AND IdEmpr_Role='$empresaID' AND id_Role='$IdRole'");
$rowRole=$RoleQ->fetch_assoc();	
$Role=$rowRole['Nombre_Role'];	


echo json_encode(array("Id"=>$IDuser,"Nombre"=>$RowUserData['NombreCompleto_MaesUsua'],"Contraseña"=>"HELLO WORLD","Descuento"=>$RowUserData['MaxDscto_MaesUsua'],"NombreUsuario"=>$RowUserData['Usuario_MaesUsua'],"Role"=>$Role,"Usuario"=>$RowUserData['Ent_UsuarioCreacion'],"Fecha"=>$RowUserData['FechaCreacion_MaesUsua'],"Maquina"=>$RowUserData['MaqCreacion_MaesUsua']));

}
//////////////////////////////////////////////
if(isset($_POST['Siguiente']))
{
		$IdMinimo=$_POST['Documento'];
$DatosDeUsuario=mysqli_query($mysqli,"SELECT * FROM ent_maesusua WHERE Id_MaesPais='$paisEmpresa' AND Id_MaesEmpr='$empresaID' AND id_MaesUsua>'$IdMinimo'");
$RowUserData=$DatosDeUsuario->fetch_assoc();
$IDuser=$RowUserData['id_MaesUsua'];
$IdRole=mysqli_query($mysqli,"SELECT * FROM ent_rolexusuario WHERE Ent_Role_IdPais_Role='$paisEmpresa' AND Ent_Role_IdEmpr_Role='$empresaID' AND IdUsuario_UsuarioXRole='$IDuser'");
$rowIdRole=$IdRole->fetch_assoc();	
$IdRole=$rowIdRole['idrole_UsuarioXRole'];

$RoleQ=mysqli_query($mysqli,"SELECT * FROM ent_role WHERE IdPais_Role='$paisEmpresa' AND IdEmpr_Role='$empresaID' AND id_Role='$IdRole'");
$rowRole=$RoleQ->fetch_assoc();	
$Role=$rowRole['Nombre_Role'];	


echo json_encode(array("Id"=>$IDuser,"Nombre"=>$RowUserData['NombreCompleto_MaesUsua'],"Contraseña"=>"HELLO WORLD","Descuento"=>$RowUserData['MaxDscto_MaesUsua'],"NombreUsuario"=>$RowUserData['Usuario_MaesUsua'],"Role"=>$Role,"Usuario"=>$RowUserData['Ent_UsuarioCreacion'],"Fecha"=>$RowUserData['FechaCreacion_MaesUsua'],"Maquina"=>$RowUserData['MaqCreacion_MaesUsua']));

}
//////////////////////////////////////////////
if(isset($_POST['Buscar']))
{
		$IdMinimo=$_POST['Item'];
$DatosDeUsuario=mysqli_query($mysqli,"SELECT * FROM ent_maesusua WHERE Id_MaesPais='$paisEmpresa' AND Id_MaesEmpr='$empresaID' AND id_MaesUsua='$IdMinimo' or NombreCompleto_MaesUsua like '".$IdMinimo."%'");
$RowUserData=$DatosDeUsuario->fetch_assoc();
$IDuser=$RowUserData['id_MaesUsua'];
$IdRole=mysqli_query($mysqli,"SELECT * FROM ent_rolexusuario WHERE Ent_Role_IdPais_Role='$paisEmpresa' AND Ent_Role_IdEmpr_Role='$empresaID' AND IdUsuario_UsuarioXRole='$IDuser'");
$rowIdRole=$IdRole->fetch_assoc();	
$IdRole=$rowIdRole['idrole_UsuarioXRole'];

$RoleQ=mysqli_query($mysqli,"SELECT * FROM ent_role WHERE IdPais_Role='$paisEmpresa' AND IdEmpr_Role='$empresaID' AND id_Role='$IdRole'");
$rowRole=$RoleQ->fetch_assoc();	
$Role=$rowRole['Nombre_Role'];	


echo json_encode(array("Id"=>$IDuser,"Nombre"=>$RowUserData['NombreCompleto_MaesUsua'],"Contraseña"=>"HELLO WORLD","Descuento"=>$RowUserData['MaxDscto_MaesUsua'],"NombreUsuario"=>$RowUserData['Usuario_MaesUsua'],"Role"=>$Role,"Usuario"=>$RowUserData['Ent_UsuarioCreacion'],"Fecha"=>$RowUserData['FechaCreacion_MaesUsua'],"Maquina"=>$RowUserData['MaqCreacion_MaesUsua']));

}
//////////////////////////////////////////////
elseif(isset($_POST['Roles'])){
	$Arreglo=array();
$RolQ=mysqli_query($mysqli,"SELECT * FROM ent_role WHERE  IdPais_Role='$paisEmpresa' AND IdEmpr_Role='$empresaID' ");
while($Row= $RolQ->fetch_assoc()){
	$Arreglo["Role"][] = array('Id' => $Row['id_Role'],'Nombre'=>$Row['Nombre_Role']);
}
echo json_encode($Arreglo);	
}
//////////////////////////////////////////////  
elseif(isset($_POST['Nuevo'])){
	$Nombre=$_POST['Nombre'];
	$Contraseña=sha1($_POST['Contraseña']);
	$Descuento=$_POST['Descuento'];
	$NombreUsuario=$_POST['Usuario'];
	$Role=$_POST['Role'];
	$sqlIDdm = "SELECT max(id_MaesUsua)+1 as codigo from ent_maesusua where Id_MaesPais='$paisEmpresa' and Id_MaesEmpr='$empresaID'";
		$maxM1=$mysqli->query($sqlIDdm); 
		
		while($row= $maxM1->fetch_assoc()){$bin = $row['codigo']; 
		if ($bin!=""){
			$Id = $row['codigo'];}
		else{$Id=1;}
		
		}
	
	
	$RolQ=mysqli_query($mysqli,"INSERT INTO `entercon`.`ent_maesusua` (`Id_MaesPais`, `Id_MaesEmpr`, `id_MaesUsua`, `NombreCompleto_MaesUsua`, `Password_MaesUsua`, `MaxDscto_MaesUsua`, `NivelPermiso_MaesUsua`, `Usuario_MaesUsua`, `FechaCreacion_MaesUsua`, `MaqCreacion_MaesUsua`, `Estatus_MaesUsua`, `Ent_UsuarioCreacion`) VALUES ('$paisEmpresa', '$empresaID', '$Id', '$Nombre', '$Contraseña', '$Descuento', '0', '$NombreUsuario', '$Fecha', '$Maquina', '1', '$usuarioLog'); ");
	
	$RolXusuario= mysqli_query($mysqli,"INSERT INTO `entercon`.`ent_rolexusuario` (`idrole_UsuarioXRole`, `IdUsuario_UsuarioXRole`, `Ent_Role_IdPais_Role`, `Ent_Role_IdEmpr_Role`) VALUES ('$Role', '$Id', '$paisEmpresa', '$empresaID');");
}
//////////////////////////////////////////////  
if (isset($_POST['tabla_data'])) {
	$Codigo = $_POST['Codigo'];
$sqlMEDIDA = "SELECT * FROM ent_usuarioxbodega where Ent_MaesBode_Id_MaesPais = '$paisEmpresa' && Ent_MaesBode_Id_MaesEmpr = '$empresaID' && IdUsuario_UsuarioXBodega ='".$Codigo."'";
$recMEDIDA = $mysqli->query($sqlMEDIDA);
$tilde = "'";
	$datos = '
<table class="tabla" border="1" bordercolor="#000000" bgcolor="#fff">
<tr>Bodegas Por usuario</tr>
<tr>

            <td><b>No Bodega</b></td>
            <td><b>Nombre bodega</b></td>

</tr>
<tbody>';

while($rowMedida=$recMEDIDA->fetch_assoc()){
	$bodID =$rowMedida['Ent_MaesBode_Id_MaesBode'];
	$BodNombre=mysqli_query($mysqli,"select*from ent_maesbode where Id_MaesPais='$paisEmpresa' and  Id_MaesEmpr='$empresaID' and Id_MaesBode='$bodID'");
	while($rowBodega=$BodNombre->fetch_assoc()){
		$nombreBodega=$rowBodega['Nombre_MaesBode'];
		}
	$datos .='
<tr>
<td>'.$rowMedida['Ent_MaesBode_Id_MaesBode'].'</td>
<td id="1">'.$nombreBodega.'</td>
<td>
<a  onclick="Eliminar('.$rowMedida['Ent_MaesBode_Id_MaesBode'].');"><p id="9"><img src="componentes/delete.png"  /></p></a>
</td>
</tr>';
}
$datos .= '
</tbody>
</table>';
echo json_encode($datos);
}
//////////////////////////////////////////////  

}
else
{
	 echo "<script> alert('Debes iniciar secion primero.')</script>";
	echo'<script> window.location="Index.HTML"</script>';
		
}
?>