// JavaScript Document
var ValorVenta = null ;
var ValorCompra = null ;
var total = null ;
var Unidades = null;
var CodP = null; 
var origen =null ;
var Relation = null;
var ProveedorID= null ;
var Tp=null;
var idMedida = null ;
var Antiguo = null;

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
		url:"ajax/AJCPuntoCompra.php",
		dataType:"json",
		data:"ModPrecio="+"&ValorAntiguo="+Antiguo+"&ValorNuevo="+Nuevo+"&ID="+ID,
		success: function(){Tabla_Data()}
	

});  Tabla_Data()
}
	 
  function ComboTP(){
   $.ajax({
          type:"post",
          url:"ajax/AJCPuntoCompra.php",
          dataType:"json",
          data:"comboPago=",
          success:function (data){
            	var numero =0 ;
					select = document.getElementById("Tpago");
					var vacio = document.createElement('option');
					vacio.value ="-1";
					vacio.innerHTML = "Seleccione Pago";
					select.appendChild(vacio);
					
						for(numero; numero<= data.TP.length ; numero++ ){
						var opt = document.createElement('option');
						opt.value =data.TP[numero]['ID'];
						opt.innerHTML =data.TP[numero]['TPago'];
						select.appendChild(opt);
					}
          }
        });
  }

  function ComboPR(){
   $.ajax({
          type:"post",
          url:"ajax/AJCPuntoCompra.php",
          dataType:"json",
          data:"PR=",
          success:function (data){
            	var i =0 ;
				select = document.getElementById("Proveedor");
		  		var vacio = document.createElement('option');
				vacio.value ="-1";
				vacio.innerHTML = "Seleccione Proveedor";
				select.appendChild(vacio);
				
				for(i; i<= data.PR.length ; i++ ){
				var option = document.createElement('option');
				option.value =data.PR[i]['ID'];
				option.innerHTML =data.PR[i]['Nombre'];
				select.appendChild(option);
					}
          }
        });
  }
function ProveedorSelecteValue(){
ProveedorID = $('#Proveedor').val();
if(ProveedorID ==-1){alert('seleccione Proveedor')}
else{
 $("#tags").attr('disabled', false);
 $("#unidades").attr('disabled', false);
 $("#Descripcion").attr('disabled', false);
  $("#UM").attr('disabled', false);
}
}
function TpagoSelecteValue(){
Tp = $('#Tpago').val();	
if(Tp ==-1){alert('seleccione TP')}
else{
 $("#addCompra").attr('disabled', false);
}
}
 $(function() {
    function prueba(request, response){
        $.ajax({
          type:"post",
          url:"ajax/AJCPuntoCompra.php",
          dataType:"json",
          data:"dato="+"&ProveedorID="+ProveedorID,
          success:function (data){
            response(data);
          }
        });
    }
    function prueba2(data){	
		var codP = $('#tags').val();
		var valores =  "existencias="+"&CodProd="+codP ;
      $.ajax({
          type:"post",
          url:"ajax/AJCPuntoCompra.php",
          dataType:"json",
          data:valores,
		  async:false,
          success:function (data){
			  ValorVenta = data.ValVenta;
			  ValorCompra = data.Compra;
         		document.getElementById("Descripcion").value=data.Descripcion;
			    document.getElementById("VV").value=data.ValVenta;
				document.getElementById("VC").value=data.Compra;

		  		$("#existencias").html(data.existencias);
				
		 			document.getElementById("unidades").value="";
				
					document.getElementById("UM").innerHTML = "";
					select = document.getElementById('UM');
					var vacio = document.createElement('option');
					vacio.value ="-1";
					vacio.innerHTML = "Seleccione Medida";
					select.appendChild(vacio);
					
	
			
					var opt = document.createElement('option');
					opt.value = data.UnM;
					opt.innerHTML = data.UnMN;
					select.appendChild(opt);
					
					var numero =0 ;
					for(numero; numero<= data.DetalleUNM.length ; numero++ ){
					var opt = document.createElement('option');
					opt.value =data.DetalleUNM[numero]['id'];
					opt.innerHTML =data.DetalleUNM[numero]['valor'];
					select.appendChild(opt);
				}
				
			
          }

       });
    }
    $( "#tags" ).autocomplete({
      source: function(request, response){
        prueba(request, response);
      },
      select: function(event, ui){
        prueba2(ui.item.value);
      }
    });
  });
 function pruebaInsert(){	 
	Unidades = $('#unidades').val();
	CodP = $('#tags').val();
	var Descripcion = $('#Descripcion').val();
	var UM = $('#UM').val();
	var Documento =$('#DOC').val();
	
							var valores =  "nuevo="+"&documentoR="+Documento+"&medidaR="+UM+"&idprodR="+CodP+"&unidadesR="+Unidades+"&medidaR="+idMedida+"&codV="+ValorVenta+"&OrigenMedida="+origen+"&RelationM="+Relation+"&Descripcion="+Descripcion+"&Total="+total+"&ValorCompra="+ValorCompra+"&Tp="+Tp;
								
									$.ajax({
									  type:"post",
									  url:"ajax/AJCPuntoCompra.php",
									  dataType:"json",
									  data:valores,
									  async: false,
									  success : function() {
										  Tabla_Data();
										  ValoresCT();
										  LimpiarTXT();
									  }
									});
									Tabla_Data();
									ValoresCT();
									LimpiarTXT();
								
									}
								
							
	


    function Tabla_Data(){
		var uniquid = $('#DOC').val();
		var valoresTabla = "tabla_data="+"&Unicod="+uniquid;
      $.ajax({
          type:"post",
          url:"ajax/AJCPuntoCompra.php",
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
  ComboTP();
  ComboPR();
    });
	});
  
  
function ValoresCT(data){
var Documento = $('#DOC').val();
        $.ajax({
          type:"post",
          url:"ajax/AJCPuntoCompra.php",
          dataType:"json",
		  async:false,
          data:"valoresct="+"&DocID="+Documento,
          success:function (data){
			  document.getElementById("Tdoc").value=data.totalQ;
			  document.getElementById("Tunidades").value=data.totalU;
			 
          }
        });
    }
function LimpiarTXT(){
	
document.getElementById("unidades").value="";
document.getElementById("tags").value="";
document.getElementById("Descripcion").value="";
document.getElementById("UM").value="";
}
function VerPrecio(){
	window.open('VerPrecio.php', 'Nueva-Marca','width=1100, height=350');
	 return false;
}

function  Eliminar(IDdelete){
	
	var DeletId = IDdelete;
	var DocID=$('#DOC').val();
        $.ajax({
          type:"post",
          url:"ajax/AJCPuntoCompra.php",
          dataType:"json",
          data:"Eliminar="+"&DeleteID="+DeletId+"&Uniquid="+DocID,
          success:function (data){
			  Tabla_Data();
			  ValoresCT();
			
          }
        });
		Tabla_Data();
		ValoresCT();
	
}


function ValTOTAL() {
	var unidad =$("#unidades").val();
	document.getElementById("TOTAL").value = unidad * ValorCompra ;
	total =  unidad * ValorCompra;
}
function Ol(){
	var UM = $('#UM').val();
	var Ncar = UM.length;
	var car=UM.charAt(Ncar-1); 
	var porcion=UM.substring(0,Ncar-1); 
	origen=car;
	idMedida= porcion;
	if (origen=="M"){
	 otra2();
	}
	else{
		 $.ajax({
          type:"post",
          url:"ajax/AJCPuntoCompra.php",
          dataType:"json",
		   data:"Detalle="+"&ID="+idMedida,
          success:function (data){
			    Relation=data.relacion
			    ValorVenta = data.ValVenta;
				ValorCompra = data.ValorCompra;
			    $("#existencias").html(data.existencias);
				document.getElementById("VV").value=data.ValVenta;
				document.getElementById("VC").value=data.ValorCompra;
				        ValTOTAL() 
				  }
        });
	}
	}
function otra2(){
 	    var codP = $('#tags').val();
		var valores =  "existencias="+"&CodProd="+codP ;
      $.ajax({
          type:"post",
          url:"ajax/AJCPuntoCompra.php",
          dataType:"json",
          data:valores,
		  async:false,
          success:function (data){
			  Porcentaje =  data.decuento;
			   Relation=data.relacion
			  ValorVenta = data.ValVenta;
         		document.getElementById("Descripcion").value=data.Descripcion;
			    document.getElementById("VV").value=data.ValVenta;
		  		$("#existencias").html(data.existencias);
					ValTOTAL()	
		     }
		  })
}

function Guardar(){	
var ttDoc =$("#Tdoc").val();
if(ttDoc==""){alert('No puedes guardar sin haber comprado nada!')}else{
		if (confirm("¿Realmente deseas continuar presiona aceptar para agregar compra o cancelar para cerrar este dialogo sin eliminar el dato?") == true) {
var documento=document.getElementById("DOC").value;
var Observaciones = document.getElementById("Obs").value;				
		$.ajax({
		type:"post",
		url:"ajax/AJCPuntoCompra.php",
		dataType:"json",
		data:"Guardar="+"&Documento="+documento+"&Obs="+Observaciones+"&Proveedor="+ProveedorID+"&Tp="+Tp,
		async: false,
		success : function(data) {
			 var i =0 ;
				for(i; i<= data.valores.length ; i++ ){
					IdProducto=data.valores[i]['Producto'];
					cantidadV=data.valores[i]['CantidadV'];
						$.ajax({
						  type:"post",
						  url:"ajax/AJCPuntoCompra.php",
						  dataType:"json",
						  data:"Update="+"&Codigo="+IdProducto+"&cantidadV="+cantidadV+"&Documento="+documento,
						  success:function (data){
							  console.log('executing')
							  window.opener.location.reload;
							  window.close();
							  }});
				
							}
						}
					});		
				}
			}
}