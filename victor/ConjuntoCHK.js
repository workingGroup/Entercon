// JavaScript Document
$(document).ready(function(e) {
    Roles();
});
var RoleSV=null;
var CG=0;
	var CGNIVEL=0;
var MP=0;
	var MPNIVEL=0;
var MM=0;
	var MMNIVEL=0;
var BOD=0;
	var BODNIVEL=0;
var TP=0;
	var TPNIVEL=0;
var UM=0;
	var UMNIVEL=0;
var RP=0;
	var REPNIVEL=0	
var MC=0;
	var MCNIVEL=0;
var PV=0;
	var PVNIVEL=0;
var EBD=0;
	var EBDNIVEL=0;
var RP=0;
	var RPNIVEL=0;
var SC=0;
	var SCNIVEL=0;
var RPC=0;
	var RPCNIVEL=0;
var PROV=0;
	var PROVNIVEL=0;
var PCOM=0;
	var PCOMNIVEL=0;
var SALPROV=0;
	var SALPROVNIVEL=0;
var REPPROV=0;
	var REPPROVNIVEL=0;
var CS=0;
	var CSNIVEL=0;
var ACTUALIZAR=0;
	var ACTUALIZARNIVEL=0;
var CMES=0;
	var CMESNIVEL=0;
var VE=0;
	var VENIVEL=0;
var CI=0;
	var CINIVEL=0;
var USUARIOS=0;
	var USUARIOSNIVEL=0;
var BD=0;
	var BDNIVEL=0;
var PERMISO=0;
	var PERMISONIVEL=0;
function GettingVariable(){
	ConfGeneral();
	MaestroProd();
	MaestroMarcas();
	MaestroBodega();
	TipoProducto();
	UnidadMedida()
	ReporteProducto(); 
    MaestroCliente();
	PuntoVenta();
	EnviosBodegas();
	ReimprecionFacturas();
	SaldoClientes();
	ReportesClientes();
	MaesProveedores();
	CompraProductos();
	SaldoProveedores();
	ReportesProveedores();
	CopiaSeguridad();
	Actualizar();
	CierreMes();
	Vitacora();
	ConfigurarImpresora();
	Usuarios();
	MantenimientoBD();
	PermisosUsuarios();
}
	
	
function ConfGeneral(){
	CGNIVEL=0
if ($('#1').is(":checked")){CG=1;}else{CG=0;}
if ($('#11').is(":checked")){CGNIVEL=1}
if ($('#111').is(":checked")){CGNIVEL=2}
if ($('#1111').is(":checked")){CGNIVEL=3}


}
///////////////////////////////////////////////////////
function MaestroProd(){
	
	MPNIVEL=0
if ($('#2').is(":checked")){MP=2;}else{MP=0;}
if ($('#22').is(":checked")){MPNIVEL=1}
if ($('#222').is(":checked")){MPNIVEL=2}
if ($('#2222').is(":checked")){MPNIVEL=3}

}
//////////////////////////////////////////////////////
function MaestroMarcas(){
	
	MMNIVEL=0
if ($('#3').is(":checked")){MM=3;}else{MM=0;}
if ($('#33').is(":checked")){MMNIVEL=1}
if ($('#333').is(":checked")){MMNIVEL=2}
if ($('#3333').is(":checked")){MMNIVEL=3}

}
///////////////////////////////////////////////////////
function MaestroBodega(){
	
	BODNIVEL=0
if ($('#4').is(":checked")){BOD=4;}else{BOD=0;}
if ($('#44').is(":checked")){BODNIVEL=1}
if ($('#444').is(":checked")){BODNIVEL=2}
if ($('#4444').is(":checked")){BODNIVEL=3}

}
//////////////////////////////////////////////////////
function TipoProducto(){
	TPNIVEL=0
if ($('#5').is(":checked")){TP=5;}else{TP=0;}
if ($('#55').is(":checked")){TPNIVEL=1}
if ($('#555').is(":checked")){TPNIVEL=2}
if ($('#5555').is(":checked")){TPNIVEL=3}

}
///////////////////////////////////////////////////////
function UnidadMedida(){
	
	UMNIVEL=0
if ($('#6').is(":checked")){UM=6;}else{UM=0;}
if ($('#66').is(":checked")){UMNIVEL=1}
if ($('#666').is(":checked")){UMNIVEL=2}
if ($('#6666').is(":checked")){UMNIVEL=3}

}
//////////////////////////////////////////////////////
function ReporteProducto(){
	
	REPNIVEL=0
if ($('#7').is(":checked")){RP=7;}else{RP=0;}
if ($('#77').is(":checked")){REPNIVEL=1}
if ($('#777').is(":checked")){REPNIVEL=2}
if ($('#7777').is(":checked")){REPNIVEL=3}

}

///////////////////////////////////////////////////////
function MaestroCliente(){
	MCNIVEL=0
if ($('#8').is(":checked")){MC=8;}else{MC=0;}
if ($('#88').is(":checked")){MCNIVEL=1}
if ($('#888').is(":checked")){MCNIVEL=2}
if ($('#8888').is(":checked")){MCNIVEL=3}

}

//////////////////////////////////////////////////////
function PuntoVenta(){
	
	PVNIVEL=0
if ($('#9').is(":checked")){PV=9;}else{PV=0;}
if ($('#99').is(":checked")){PVNIVEL=1}
if ($('#999').is(":checked")){PVNIVEL=2}
if ($('#9999').is(":checked")){PVNIVEL=3}

}

///////////////////////////////////////////////////////
function EnviosBodegas(){
	
	EBDNIVEL=0
if ($('#10').is(":checked")){EBD=10;}else{EBD==0;}
if ($('#100').is(":checked")){EBDNIVEL=1}
if ($('#1000').is(":checked")){EBDNIVEL=2}
if ($('#10000').is(":checked")){EBDNIVEL=3}

}

//////////////////////////////////////////////////////
function ReimprecionFacturas(){
	
	RPNIVEL=0
if ($('#11').is(":checked")){RP=11;}else{RP==0;}
if ($('#111000').is(":checked")){RPNIVEL=1}
if ($('#1100').is(":checked")){RPNIVEL=2}
if ($('#11000').is(":checked")){RPNIVEL=3}

}

///////////////////////////////////////////////////////
function SaldoClientes(){
	
	SCNIVEL=0
if ($('#12').is(":checked")){SC=12;}else{SC==0;}
if ($('#120').is(":checked")){SCNIVEL=1}
if ($('#1200').is(":checked")){SCNIVEL=2}
if ($('#12000').is(":checked")){SCNIVEL=3}

}

//////////////////////////////////////////////////////
function ReportesClientes(){
	
	RPCNIVEL=0
if ($('#13').is(":checked")){RPC=13;}else{RPC==0;}
if ($('#130').is(":checked")){RPCNIVEL=1}
if ($('#1300').is(":checked")){RPCNIVEL=2}
if ($('#13000').is(":checked")){RPCNIVEL=3}

}

///////////////////////////////////////////////////////
function MaesProveedores(){
	
	PROVNIVEL=0
if ($('#14').is(":checked")){PROV=14;}else{PROV==0;}
if ($('#140').is(":checked")){PROVNIVEL=1}
if ($('#1400').is(":checked")){PROVNIVEL=2}
if ($('#14000').is(":checked")){PROVNIVEL=3}

}

//////////////////////////////////////////////////////
function CompraProductos(){
	
	PCOMNIVEL=0
if ($('#15').is(":checked")){PCOM=15;}else{PCOM==0;}
if ($('#150').is(":checked")){PCOMNIVEL=1}
if ($('#1500').is(":checked")){PCOMNIVEL=2}
if ($('#15000').is(":checked")){PCOMNIVEL=3}

}
//////////////////////////////////////////////////////
function SaldoProveedores(){
	
	SALPROVNIVEL=0
if ($('#16').is(":checked")){SALPROV=16;}else{SALPROV==0;}
if ($('#160').is(":checked")){SALPROVNIVEL=1}
if ($('#1600').is(":checked")){SALPROVNIVEL=2}
if ($('#16000').is(":checked")){SALPROVNIVEL=3}

}

///////////////////////////////////////////////////////
function ReportesProveedores(){
	REPPROVNIVEL=0
if ($('#17').is(":checked")){REPPROV=17;}else{REPPROV==0;}
if ($('#170').is(":checked")){REPPROVNIVEL=1}
if ($('#1700').is(":checked")){REPPROVNIVEL=2}
if ($('#17000').is(":checked")){REPPROVNIVEL=3}

}

//////////////////////////////////////////////////////
function CopiaSeguridad(){
	CSNIVEL=0
if ($('#18').is(":checked")){CS=18;}else{CS==0;}
if ($('#180').is(":checked")){CSNIVEL=1}
if ($('#1800').is(":checked")){CSNIVEL=2}
if ($('#18000').is(":checked")){CSNIVEL=3}

}
///////////////////////////////////////////////////////
function Actualizar(){
	ACTUALIZARNIVEL=0
if ($('#19').is(":checked")){ACTUALIZAR=19;}else{ACTUALIZAR==0;}
if ($('#190').is(":checked")){ACTUALIZARNIVEL=1}
if ($('#1900').is(":checked")){ACTUALIZARNIVEL=2}
if ($('#19000').is(":checked")){ACTUALIZARNIVEL=3}

}

//////////////////////////////////////////////////////
function CierreMes(){
	CMESNIVEL=0
if ($('#20').is(":checked")){CMES=20;}else{CMES==0;}
if ($('#200').is(":checked")){CMESNIVEL=1}
if ($('#2000').is(":checked")){CMESNIVEL=2}
if ($('#20000').is(":checked")){CMESNIVEL=3}

}

///////////////////////////////////////////////////////
function Vitacora(){
	VENIVEL=0
if ($('#21').is(":checked")){VE=21;}else{VE==0;}
if ($('#210').is(":checked")){VENIVEL=1}
if ($('#2100').is(":checked")){VENIVEL=2}
if ($('#21000').is(":checked")){VENIVEL=3}

}

//////////////////////////////////////////////////////
function ConfigurarImpresora(){
	CINIVEL=0
if ($('#22').is(":checked")){CI=22;}else{CI==0;}
if ($('#220').is(":checked")){CINIVEL=1}
if ($('#2200').is(":checked")){CINIVEL=2}
if ($('#22000').is(":checked")){CINIVEL=3}

}

///////////////////////////////////////////////////////
function Usuarios(){
	USUARIOSNIVEL=0
if ($('#23').is(":checked")){USUARIOS=23;}else{USUARIOS==0;}
if ($('#230').is(":checked")){USUARIOSNIVEL=1}
if ($('#2300').is(":checked")){USUARIOSNIVEL=2}
if ($('#23000').is(":checked")){USUARIOSNIVEL=3}

}
///////////////////////////////////////////////////////
function MantenimientoBD(){
	BDNIVEL=0
if ($('#24').is(":checked")){BD=24;}else{BD==0;}
if ($('#240').is(":checked")){BDNIVEL=1}
if ($('#2400').is(":checked")){BDNIVEL=2}
if ($('#24000').is(":checked")){BDNIVEL=3}

}
///////////////////////////////////////////////////////
function PermisosUsuarios(){
	PERMISONIVEL=0;
if ($('#25').is(":checked")){PERMISO=25;}else{PERMISO==0;}
if ($('#250').is(":checked")){PERMISONIVEL=1}
if ($('#2500').is(":checked")){PERMISONIVEL=2}
if ($('#25000').is(":checked")){PERMISONIVEL=3}

}
function Roles(){
$.ajax({
	type:"post",
	dataType:"json",
	url:"ajax/AJCRoles.php",
	data:"Roles=",
	success: function(data){
		select = document.getElementById("Roles");
					var seleccionar = document.createElement('option');
					seleccionar.value="-1";
					seleccionar.innerHTML = "Seleccione Role";
					select.appendChild(seleccionar);
		var i=0;
		for(i;i<=data.Role.length;i++){
		var opciones=document.createElement('option');
		opciones.value=data.Role[i]['Id'];
		opciones.innerHTML=data.Role[i]['Name'];
		select.appendChild(opciones);
		}
		}
	});
}
function RoleSelectedV(){
	RoleSV=document.getElementById("Roles").value;
	Opcion1()
	//Opcion2()
	
	}
function Opcion1(){
$.ajax({
	type:"post",
	dataType:"json",
	url:"ajax/AJCRoles.php",
	data:"Opcion1="+"&Role="+RoleSV,
	success: function(data){	
	alert('.l.')
	if(data.CG1=1){
		$('#1').attr('checked', true);
		}
	if(data.Permiso1==1){
		$('#11').attr('checked', true);
		}else{ 
	if(data.Permiso1==2){
		$('#111').attr('checked', true);
		}else{
	if(data.Permiso1==3){
		$('#1111').attr('checked', true);
				}
			}
		}
	
	/////////////////
	if(data.data.CG2=1){
		$('#2').attr('checked', true);
		}
	if(data.data.Permiso2==1){
		$('#22').attr('checked', true);
		}else{ 
	if(data.data.Permiso2==2){
		$('#222').attr('checked', true);
		}else{
	if(data.data.Permiso2==3){
		$('#2222').attr('checked', true);
				}
			}
		}
	
}
});
}
/*function Opcion2(){
$.ajax({
	type:"post",
	dataType:"json",
	url:"ajax/AJCRoles.php",
	data:"Opcion1="+"&Role="+RoleSV,
	success: function(data){	
	alert('.l.')
	if(data.CG2=1){
		$('#2').attr('checked', true);
		}
	if(data.Permiso2==1){
		$('#22').attr('checked', true);
		}else{ 
	if(data.Permiso2==2){
		$('#222').attr('checked', true);
		}else{
	if(data.Permiso2==3){
		$('#2222').attr('checked', true);
				}
			}
		}
	}
});
}*/