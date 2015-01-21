// JavaScript Document
/////Documento
var Documento = null ;
var fecha = null ;
var BodegaSalidaID = null ;
var BodegaSalidaNombre = null ;
var BodegaIngresoID = null;
var BodegaIngresoNombre= null; 
var Observaciones =null ;
var usuario = null;
var total = null ;
var Correlativo=null;
/////Detalle
//LLenar detalle Segun NO Documento


function llenarValores(){
	document.getElementById("DOC").value=Documento;
	document.getElementById("fecha").value=fecha;
	document.getElementById("BodSalidaID").value=BodegaSalidaID;
	document.getElementById("BodSalidaNombre").value=BodegaSalidaNombre;				
	document.getElementById("BodEntradaID").value=BodegaIngresoID;
	document.getElementById("BodEntradaNombre").value=BodegaIngresoNombre;
	document.getElementById("Obs").value=Observaciones;
	document.getElementById("Usuario").value=usuario;	
	document.getElementById("Tdoc").value=total;
	document.getElementById("Correlativo").value=Correlativo;
}
function Search(){
	var Item =$("#Buscar").val()
$.ajax({
	type:"post",
	dataType:"json",
	url:"ajax/AJCEnviosBodegas.php",
	data:"Buscar="+"&Item="+Item,
	success: function(data){
		Correlativo=data.Correlativo;
 Documento = data.Documento ;
 fecha =data.Fecha ;
 BodegaSalidaID =data.BodegaSalidaId;
 BodegaSalidaNombre=data.BodegaSalidaNombre; 
 BodegaIngresoID =data.BodegaIngresoID;
 BodegaIngresoNombre=data.BodegaIngresoNombre; 
 Observaciones =data.Observaciones ;
 usuario =data.usuario;
 total=data.Total;
         llenarValores();  
		 Tabla_Data(); 
		}
});
	
}
function Inicio(){
 $.ajax({
          type:"post",
          url:"ajax/AJCEnviosBodegas.php",
          dataType:"json",
          data:"Inicio=",
          success:function (data){
 Correlativo=data.Correlativo;
 Documento = data.Documento ;
 fecha =data.Fecha ;
 BodegaSalidaID =data.BodegaSalidaId;
 BodegaSalidaNombre=data.BodegaSalidaNombre; 
 BodegaIngresoID =data.BodegaIngresoID;
 BodegaIngresoNombre=data.BodegaIngresoNombre; 
 Observaciones =data.Observaciones ;
 usuario =data.usuario;
 total=data.Total;
         llenarValores();  
		 Tabla_Data(); 
          }
        });

}

function Final(){
 $.ajax({
          type:"post",
          url:"ajax/AJCEnviosBodegas.php",
          dataType:"json",
          data:"Final=",
          success:function (data){
 Correlativo=data.Correlativo;
 Documento = data.Documento ;
 fecha =data.Fecha ;
 BodegaSalidaID =data.BodegaSalidaId;
 BodegaSalidaNombre=data.BodegaSalidaNombre; 
 BodegaIngresoID =data.BodegaIngresoID;
 BodegaIngresoNombre=data.BodegaIngresoNombre; 
 Observaciones =data.Observaciones ;
 usuario =data.usuario;
total=data.Total;
         llenarValores();  
		 Tabla_Data();  
          }
        });

}
function Previo(){
	var IDDOC = document.getElementById("DOC").value;
 $.ajax({
          type:"post",
          url:"ajax/AJCEnviosBodegas.php",
          dataType:"json",
          data:"Previo="+"&Idocumento="+IDDOC,
          success:function (data){
  Correlativo=data.Correlativo;
 Documento = data.Documento ;
 fecha =data.Fecha ;
 BodegaSalidaID =data.BodegaSalidaId;
 BodegaSalidaNombre=data.BodegaSalidaNombre; 
 BodegaIngresoID =data.BodegaIngresoID;
 BodegaIngresoNombre=data.BodegaIngresoNombre; 
 Observaciones =data.Observaciones ;
 usuario =data.usuario;
total=data.Total;
         llenarValores();  
		 Tabla_Data();   
          }
        });

}

function Siguiente(){
	var IDDOC = document.getElementById("DOC").value;
 $.ajax({
          type:"post",
          url:"ajax/AJCEnviosBodegas.php",
          dataType:"json",
          data:"Siguiente="+"&Idocumento="+IDDOC,
          success:function (data){
  Correlativo=data.Correlativo;
 Documento = data.Documento ;
 fecha =data.Fecha ;
 BodegaSalidaID =data.BodegaSalidaId;
 BodegaSalidaNombre=data.BodegaSalidaNombre; 
 BodegaIngresoID =data.BodegaIngresoID;
 BodegaIngresoNombre=data.BodegaIngresoNombre; 
 Observaciones =data.Observaciones ;
 usuario =data.usuario;
total=data.Total;
         llenarValores();  
		 Tabla_Data();  
          }
        });

}
function printcontent(el){
	  var resetearpagina  = document.body.innerHTML;
	  var Printcontent = document.getElementById(el).innerHTML;
	  document.body.innerHTML = Printcontent;
	  window.print(Printcontent);
	  document.body.innerHTML = resetearpagina;
  }
function Agregar(){
	window.location.href='EnviosBodegas.php';
	 return false;
}
    function Tabla_Data(){
		var uniquid = $('#DOC').val();
		var valoresTabla = "tabla_dataMantenimiento="+"&Unicod="+uniquid;
      $.ajax({
          type:"post",
          url:"ajax/AJCEnviosBodegas.php",
          dataType:"json",
          data:valoresTabla,
          success:function (data){
            $("#tabla_data").html(data);
          }
        });
    }
	$(function() {
    $(document).ready(function(){
  Tabla_Data();
    Inicio();
  
    });
	});
  function Eliminar(){
		if (confirm("¿Realmente deseas continuar presiona aceptar para eliminar envio recuerda que si eliminas no tendras comprobante de envio o cancelar para cerrar este dialogo sin eliminar el dato?") == true) {
	 var NoDocumento=$("#DOC").val();
	$.ajax({
		type:"post",
		dataType:"json",
		url:"ajax/AJCEnviosBodegas.php",
		data:"Eliminar="+"&NoDocumento="+NoDocumento,
		success: function(){}
	});
	  
  }
  
	 }