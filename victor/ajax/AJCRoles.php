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
if(isset($_POST["Roles"])){
$ArregloRole=array();
$Roles=mysqli_query($mysqli,"SELECT * FROM ent_role WHERE IdPais_Role='$paisEmpresa' AND IdEmpr_Role='$empresaID' ");
while($rowRole=$Roles->fetch_assoc()){
	$ArregloRole["Role"][]=array("Id"=>$rowRole['id_Role'],"Name"=>$rowRole['Nombre_Role']);
	}	
	echo json_encode($ArregloRole);	
}
///////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST['Opcion1'])){
$IdRole=$_POST['Role'];
 for($Numero=1;$Numero<=25;$Numero++)
	 {
$Opcion1 =mysqli_query($mysqli,"select * from ent_opcionxrole where IdPais_OpcionXRole='$paisEmpresa' AND IdEmpr_OpcionXRole='$empresaID' and IdRole_OpcionXRole ='$IdRole' AND IdOpcion_OpcionXRole='$Numero'");
$rowOpcion1=$Opcion1->fetch_assoc();
$Matriz=array();
$array = array();
	if(mysqli_num_rows($Opcion1) > 0){
			$Bin=1;
		    $Tpermiso=$rowOpcion1['TipoPermiso_RoleXOpcion'];
		}else { $Bin=0; 
				$Tpermiso=$rowOpcion1['TipoPermiso_RoleXOpcion'];
				}
					 
	echo json_encode(array("CG$Numero"=>$Bin,"Permiso$Numero"=>$Tpermiso)); 
}



}
/*
//////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST['Opcion2'])){
$IdRole=$_POST['Role'];
$Opcion1 =mysqli_query($mysqli,"select * from ent_opcionxrole where IdPais_OpcionXRole='$paisEmpresa' AND IdEmpr_OpcionXRole='$empresaID' and IdRole_OpcionXRole ='$IdRole' AND IdOpcion_OpcionXRole='2'");
$rowOpcion1=$Opcion1->fetch_assoc();
	if(mysqli_num_rows($Opcion1) > 0){
			$Bin=1;
		    $Tpermiso=$rowOpcion1['TipoPermiso_RoleXOpcion'];
		}else { $Bin=0; 
				$Tpermiso=$rowOpcion1['TipoPermiso_RoleXOpcion'];
				}
echo json_encode(array("CG"=>$Bin,"Permiso"=>$Tpermiso));
}

//////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST['Opcion3'])){
$IdRole=$_POST['Role'];
$Opcion1 =mysqli_query($mysqli,"select * from ent_opcionxrole where IdPais_OpcionXRole='$paisEmpresa' AND IdEmpr_OpcionXRole='$empresaID' and IdRole_OpcionXRole ='$IdRole' AND IdOpcion_OpcionXRole='3'");
$rowOpcion1=$Opcion1->fetch_assoc();
	if(mysqli_num_rows($Opcion1) > 0){
			$Bin=1;
		    $Tpermiso=$rowOpcion1['TipoPermiso_RoleXOpcion'];
		}else { $Bin=0; 
				$Tpermiso=$rowOpcion1['TipoPermiso_RoleXOpcion'];
				}
echo json_encode(array("CG"=>$Bin,"Permiso"=>$Tpermiso));
}
//////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST['Opcion1'])){
$IdRole=$_POST['Role'];
$Opcion1 =mysqli_query($mysqli,"select * from ent_opcionxrole where IdPais_OpcionXRole='$paisEmpresa' AND IdEmpr_OpcionXRole='$empresaID' and IdRole_OpcionXRole ='$IdRole' AND IdOpcion_OpcionXRole='1'");
$rowOpcion1=$Opcion1->fetch_assoc();
	if(mysqli_num_rows($Opcion1) > 0){
			$ConfiguracionGeneral=1;
		    $Tpermiso=$rowOpcion1['TipoPermiso_RoleXOpcion'];
		}else { $ConfiguracionGeneral=0; 
				$Tpermiso=$rowOpcion1['TipoPermiso_RoleXOpcion'];
				}
echo json_encode(array("CG"=>$ConfiguracionGeneral,"Permiso"=>$Tpermiso));
}
//////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST['Opcion1'])){
$IdRole=$_POST['Role'];
$Opcion1 =mysqli_query($mysqli,"select * from ent_opcionxrole where IdPais_OpcionXRole='$paisEmpresa' AND IdEmpr_OpcionXRole='$empresaID' and IdRole_OpcionXRole ='$IdRole' AND IdOpcion_OpcionXRole='1'");
$rowOpcion1=$Opcion1->fetch_assoc();
	if(mysqli_num_rows($Opcion1) > 0){
			$ConfiguracionGeneral=1;
		    $Tpermiso=$rowOpcion1['TipoPermiso_RoleXOpcion'];
		}else { $ConfiguracionGeneral=0; 
				$Tpermiso=$rowOpcion1['TipoPermiso_RoleXOpcion'];
				}
echo json_encode(array("CG"=>$ConfiguracionGeneral,"Permiso"=>$Tpermiso));
}
//////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST['Opcion1'])){
$IdRole=$_POST['Role'];
$Opcion1 =mysqli_query($mysqli,"select * from ent_opcionxrole where IdPais_OpcionXRole='$paisEmpresa' AND IdEmpr_OpcionXRole='$empresaID' and IdRole_OpcionXRole ='$IdRole' AND IdOpcion_OpcionXRole='1'");
$rowOpcion1=$Opcion1->fetch_assoc();
	if(mysqli_num_rows($Opcion1) > 0){
			$ConfiguracionGeneral=1;
		    $Tpermiso=$rowOpcion1['TipoPermiso_RoleXOpcion'];
		}else { $ConfiguracionGeneral=0; 
				$Tpermiso=$rowOpcion1['TipoPermiso_RoleXOpcion'];
				}
echo json_encode(array("CG"=>$ConfiguracionGeneral,"Permiso"=>$Tpermiso));
}
//////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST['Opcion1'])){
$IdRole=$_POST['Role'];
$Opcion1 =mysqli_query($mysqli,"select * from ent_opcionxrole where IdPais_OpcionXRole='$paisEmpresa' AND IdEmpr_OpcionXRole='$empresaID' and IdRole_OpcionXRole ='$IdRole' AND IdOpcion_OpcionXRole='1'");
$rowOpcion1=$Opcion1->fetch_assoc();
	if(mysqli_num_rows($Opcion1) > 0){
			$ConfiguracionGeneral=1;
		    $Tpermiso=$rowOpcion1['TipoPermiso_RoleXOpcion'];
		}else { $ConfiguracionGeneral=0; 
				$Tpermiso=$rowOpcion1['TipoPermiso_RoleXOpcion'];
				}
echo json_encode(array("CG"=>$ConfiguracionGeneral,"Permiso"=>$Tpermiso));
}
//////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST['Opcion1'])){
$IdRole=$_POST['Role'];
$Opcion1 =mysqli_query($mysqli,"select * from ent_opcionxrole where IdPais_OpcionXRole='$paisEmpresa' AND IdEmpr_OpcionXRole='$empresaID' and IdRole_OpcionXRole ='$IdRole' AND IdOpcion_OpcionXRole='1'");
$rowOpcion1=$Opcion1->fetch_assoc();
	if(mysqli_num_rows($Opcion1) > 0){
			$ConfiguracionGeneral=1;
		    $Tpermiso=$rowOpcion1['TipoPermiso_RoleXOpcion'];
		}else { $ConfiguracionGeneral=0; 
				$Tpermiso=$rowOpcion1['TipoPermiso_RoleXOpcion'];
				}
echo json_encode(array("CG"=>$ConfiguracionGeneral,"Permiso"=>$Tpermiso));
}
//////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST['Opcion1'])){
$IdRole=$_POST['Role'];
$Opcion1 =mysqli_query($mysqli,"select * from ent_opcionxrole where IdPais_OpcionXRole='$paisEmpresa' AND IdEmpr_OpcionXRole='$empresaID' and IdRole_OpcionXRole ='$IdRole' AND IdOpcion_OpcionXRole='1'");
$rowOpcion1=$Opcion1->fetch_assoc();
	if(mysqli_num_rows($Opcion1) > 0){
			$ConfiguracionGeneral=1;
		    $Tpermiso=$rowOpcion1['TipoPermiso_RoleXOpcion'];
		}else { $ConfiguracionGeneral=0; 
				$Tpermiso=$rowOpcion1['TipoPermiso_RoleXOpcion'];
				}
echo json_encode(array("CG"=>$ConfiguracionGeneral,"Permiso"=>$Tpermiso));
}
//////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST['Opcion1'])){
$IdRole=$_POST['Role'];
$Opcion1 =mysqli_query($mysqli,"select * from ent_opcionxrole where IdPais_OpcionXRole='$paisEmpresa' AND IdEmpr_OpcionXRole='$empresaID' and IdRole_OpcionXRole ='$IdRole' AND IdOpcion_OpcionXRole='1'");
$rowOpcion1=$Opcion1->fetch_assoc();
	if(mysqli_num_rows($Opcion1) > 0){
			$ConfiguracionGeneral=1;
		    $Tpermiso=$rowOpcion1['TipoPermiso_RoleXOpcion'];
		}else { $ConfiguracionGeneral=0; 
				$Tpermiso=$rowOpcion1['TipoPermiso_RoleXOpcion'];
				}
echo json_encode(array("CG"=>$ConfiguracionGeneral,"Permiso"=>$Tpermiso));
}
//////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST['Opcion1'])){
$IdRole=$_POST['Role'];
$Opcion1 =mysqli_query($mysqli,"select * from ent_opcionxrole where IdPais_OpcionXRole='$paisEmpresa' AND IdEmpr_OpcionXRole='$empresaID' and IdRole_OpcionXRole ='$IdRole' AND IdOpcion_OpcionXRole='1'");
$rowOpcion1=$Opcion1->fetch_assoc();
	if(mysqli_num_rows($Opcion1) > 0){
			$ConfiguracionGeneral=1;
		    $Tpermiso=$rowOpcion1['TipoPermiso_RoleXOpcion'];
		}else { $ConfiguracionGeneral=0; 
				$Tpermiso=$rowOpcion1['TipoPermiso_RoleXOpcion'];
				}
echo json_encode(array("CG"=>$ConfiguracionGeneral,"Permiso"=>$Tpermiso));
}
//////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST['Opcion1'])){
$IdRole=$_POST['Role'];
$Opcion1 =mysqli_query($mysqli,"select * from ent_opcionxrole where IdPais_OpcionXRole='$paisEmpresa' AND IdEmpr_OpcionXRole='$empresaID' and IdRole_OpcionXRole ='$IdRole' AND IdOpcion_OpcionXRole='1'");
$rowOpcion1=$Opcion1->fetch_assoc();
	if(mysqli_num_rows($Opcion1) > 0){
			$ConfiguracionGeneral=1;
		    $Tpermiso=$rowOpcion1['TipoPermiso_RoleXOpcion'];
		}else { $ConfiguracionGeneral=0; 
				$Tpermiso=$rowOpcion1['TipoPermiso_RoleXOpcion'];
				}
echo json_encode(array("CG"=>$ConfiguracionGeneral,"Permiso"=>$Tpermiso));
}
//////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST['Opcion1'])){
$IdRole=$_POST['Role'];
$Opcion1 =mysqli_query($mysqli,"select * from ent_opcionxrole where IdPais_OpcionXRole='$paisEmpresa' AND IdEmpr_OpcionXRole='$empresaID' and IdRole_OpcionXRole ='$IdRole' AND IdOpcion_OpcionXRole='1'");
$rowOpcion1=$Opcion1->fetch_assoc();
	if(mysqli_num_rows($Opcion1) > 0){
			$ConfiguracionGeneral=1;
		    $Tpermiso=$rowOpcion1['TipoPermiso_RoleXOpcion'];
		}else { $ConfiguracionGeneral=0; 
				$Tpermiso=$rowOpcion1['TipoPermiso_RoleXOpcion'];
				}
echo json_encode(array("CG"=>$ConfiguracionGeneral,"Permiso"=>$Tpermiso));
}
//////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST['Opcion1'])){
$IdRole=$_POST['Role'];
$Opcion1 =mysqli_query($mysqli,"select * from ent_opcionxrole where IdPais_OpcionXRole='$paisEmpresa' AND IdEmpr_OpcionXRole='$empresaID' and IdRole_OpcionXRole ='$IdRole' AND IdOpcion_OpcionXRole='1'");
$rowOpcion1=$Opcion1->fetch_assoc();
	if(mysqli_num_rows($Opcion1) > 0){
			$ConfiguracionGeneral=1;
		    $Tpermiso=$rowOpcion1['TipoPermiso_RoleXOpcion'];
		}else { $ConfiguracionGeneral=0; 
				$Tpermiso=$rowOpcion1['TipoPermiso_RoleXOpcion'];
				}
echo json_encode(array("CG"=>$ConfiguracionGeneral,"Permiso"=>$Tpermiso));
}
//////////////////////////////////////////////////////////////////////////////////////////
*/?> 
<?php	
}
else
{
	 echo "<script> alert('Debes iniciar secion primero.')</script>";
	echo'<script> window.location="Index.HTML"</script>';

}
?>