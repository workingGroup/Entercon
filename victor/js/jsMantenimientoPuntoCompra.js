// JavaScript Document
/////Documento
var Documento = null ;
var fecha = null ;
var Codigo = null ;
var TipoPago = null ;
var BodegaIngresoID = null;
var BodegaIngresoNombre= null; 
var Observaciones =null ;
var usuario = null;
var IDcodigo=null;
var IDtp= null;
var Total=null;
var Correlativo=null;
/////Detalle
//LLenar detalle Segun NO Documento

function Editar(idEdit){
    Antiguo =$('#TextEdit'+idEdit).val();
	if(Antiguo!=null){
$("#TextEdit"+idEdit).attr('disabled',false);}

}
function Actualizar(ID){
	$("#TextEdit"+ID).attr('disabled', true);
	var Nuevo =$('#TextEdit'+ID).val();
	$.ajax({
		type:"POST",
		url:"ajax/AJCPuntoCompraValores.php",
		dataType:"json",
		data:"ModPrecio="+"&ValorAntiguo="+Antiguo+"&ValorNuevo="+Nuevo+"&ID="+ID,
		success: function(){Tabla_Data()}

});Tabla_Data()
}

function llenarValores(){
	document.getElementById("DOC").value=Documento;
	document.getElementById("Fecha").value=fecha;
	
					select = document.getElementById("Proveedor");
					var opta = document.createElement('option');
					opta.value =IDcodigo;
					opta.innerHTML =Codigo;
					select.appendChild(opta);
	
					select = document.getElementById("Tpago");
					var optb = document.createElement('option');
					optb.value =IDtp;
					optb.innerHTML = TipoPago;
					select.appendChild(optb);
					
					select = document.getElementById("Tpago");
					var optb = document.createElement('option');
					optb.value =IDtp;
					optb.innerHTML = TipoPago;
					select.appendChild(optb);
					
	document.getElementById("IDBodegaIngreso").value=BodegaIngresoID;
	document.getElementById("NombreBodegaIngreso").value=BodegaIngresoNombre;
	document.getElementById("Obs").value=Observaciones;
	document.getElementById("user").value=usuario;	
	document.getElementById("Tdoc").value=Total;
	document.getElementById("Correlativo").value=Correlativo;
}

function Inicio(){
 $.ajax({
          type:"post",
          url:"ajax/AJCPuntoCompraValores.php",
          dataType:"json",
          data:"Inicio=",
          success:function (data){
			  
 Documento = data.Documento ;
 fecha =data.Fecha ;
 Codigo =data.Codigo ;
 TipoPago =data.TipoPago ;
 BodegaIngresoID =data.BodegaIngresoID;
 BodegaIngresoNombre=data.BodegaIngresoNombre; 
 Observaciones =data.Observaciones ;
 usuario =data.usuario;
 IDcodigo=data.IDCodigo;
 IDtp=data.IDtp;
 Total=data.Total;
 Correlativo=data.Correlativo;
         llenarValores();  
		 Tabla_Data() 
          }
        });
		Tabla_Data()

}

function Final(){
 $.ajax({
          type:"post",
          url:"ajax/AJCPuntoCompraValores.php",
          dataType:"json",
          data:"Final=",
          success:function (data){
			  
 Documento = data.Documento ;
 fecha =data.Fecha ;
 Codigo =data.Codigo ;
 TipoPago =data.TipoPago ;
 BodegaIngresoID =data.BodegaIngresoID;
 BodegaIngresoNombre=data.BodegaIngresoNombre; 
 Observaciones =data.Observaciones ;
 usuario =data.usuario;
 IDcodigo=data.IDCodigo;
 IDtp=data.IDtp;
 Total=data.Total;
  Correlativo=data.Correlativo;
         llenarValores(); 
		 Tabla_Data()  
          }
        });Tabla_Data()

}
function Previo(){
	var IDDOC = document.getElementById("DOC").value;
 $.ajax({
          type:"post",
          url:"ajax/AJCPuntoCompraValores.php",
          dataType:"json",
          data:"Previo="+"&Idocumento="+IDDOC,
          success:function (data){
			  
 Documento = data.Documento ;
 fecha =data.Fecha ;
 Codigo =data.Codigo ;
 TipoPago =data.TipoPago ;
 BodegaIngresoID =data.BodegaIngresoID;
 BodegaIngresoNombre=data.BodegaIngresoNombre; 
 Observaciones =data.Observaciones ;
 usuario =data.usuario;
 IDcodigo=data.IDCodigo;
 IDtp=data.IDtp;
 Total=data.Total;
  Correlativo=data.Correlativo;
         llenarValores();   
		 Tabla_Data()
          }
        });Tabla_Data()

}

function Siguiente(){
	var IDDOC = document.getElementById("DOC").value;
 $.ajax({
          type:"post",
          url:"ajax/AJCPuntoCompraValores.php",
          dataType:"json",
          data:"Siguiente="+"&Idocumento="+IDDOC,
          success:function (data){
			  
 Documento = data.Documento ;
 fecha =data.Fecha ;
 Codigo =data.Codigo ;
 TipoPago =data.TipoPago ;
 BodegaIngresoID =data.BodegaIngresoID;
 BodegaIngresoNombre=data.BodegaIngresoNombre; 
 Observaciones =data.Observaciones ;
 usuario =data.usuario;
 IDcodigo=data.IDCodigo;
 IDtp=data.IDtp;
 Total=data.Total;
  Correlativo=data.Correlativo;
         llenarValores();   
		 Tabla_Data()
          }
        });
		Tabla_Data()

}
function Agregar(){
	window.location.href='CompraProductos.php';
	 return false;
}

function b(){
	window.open('VerPrecio.php', 'Nueva-Marca','width=1100, height=350');
	 return false;
}
    function Tabla_Data(){
		var uniquid = $('#DOC').val();
		var valoresTabla = "tabla_data="+"&Unicod="+uniquid;
      $.ajax({
          type:"post",
          url:"ajax/AJCPuntoCompraValores.php",
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
   
  
/* function LimpiarTXT(){
	
document.getElementById("unidades").value="";
document.getElementById("tags").value="";
document.getElementById("Descripcion").value="";
document.getElementById("UM").value="";
}
*/
function  Eliminar(){

		if (confirm("¿Realmente deseas continuar presiona aceptar para eliminar compra recuerda que al eliminar no tendras comprobante de compra o cancelar para cerrar este dialogo sin eliminar el dato?") == true) {
	var DocID=$('#DOC').val();
        $.ajax({
          type:"post",
          url:"ajax/AJCPuntoCompraValores.php",
          dataType:"json",
          data:"Eliminar="+"&Uniquid="+DocID,
          success:function (data){
			  window.location.reload();
			 
			  
          }
        })
}
}

 function printcontent(el){
	  var resetearpagina  = document.body.innerHTML;
	  var Printcontent = document.getElementById(el).innerHTML;
	  document.body.innerHTML = Printcontent;
	  window.print();
	  document.body.innerHTML = resetearpagina;
  }
function Searching(){
  var SearchData= document.getElementById("Buscar").value;
$.ajax({
	type:"post",
	url:"ajax/AJCPuntoCompraValores.php",
	dataType:"json",
	data:"Buscar="+"&Item="+SearchData,
	success: function(data){console.log('buscando...')
Documento = data.Documento ;
 fecha =data.Fecha ;
 Codigo =data.Codigo ;
 TipoPago =data.TipoPago ;
 BodegaIngresoID =data.BodegaIngresoID;
 BodegaIngresoNombre=data.BodegaIngresoNombre; 
 Observaciones =data.Observaciones ;
 usuario =data.usuario;
 IDcodigo=data.IDCodigo;
 IDtp=data.IDtp;
 Total=data.Total;
  Correlativo=data.Correlativo;
         llenarValores();   
		 Tabla_Data()
          }
        });
		Tabla_Data()
	
}