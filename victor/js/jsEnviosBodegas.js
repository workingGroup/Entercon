
var totalx = null ;
var Unidades = null;
var CodP = null; 
var origen =null ;
var Relation = null;
var binario= null;
var ValorCompra = null ;



 $(function() {
    function prueba(request, response){
        $.ajax({
          type:"post",
          url:"ajax/AJCEnviosBodegas.php",
          dataType:"json",
          data:"dato=",
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
          url:"ajax/AJCEnviosBodegas.php",
          dataType:"json",
          data:valores,
		  async:false,
          success:function (data){
			  Porcentaje =  data.decuento;
			 
         		document.getElementById("Descripcion").value=data.Descripcion;
			    document.getElementById("VV").value=data.ValVenta;
				$("#valorunitario").html(data.ValVenta);
				if(data.existencias==0){
					$("#existencias").html("No hay existencias en bodega de este producto")
		  		$("#add").attr('disabled',true);
				}else{$("#existencias").html(data.existencias);	
				}
		
		 document.getElementById("unidades").value="";
		 
	      var combo = document.getElementById("UM");
				
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
	var BodID = $('#BodEntradaID').val();
	var Documento =$('#DOC').val();
	var IDmedida = $('#UM').val();
	var BodNom = $('#BodEntradaNombre').val();
	
	
if (BodID==""){alert ('Favor llenar numero de bodega')}
else {
	if (BodNom==""){alert ('Favor llenar nombre de bodega')}
			  		else{if ((Unidades =="") || (Unidades<= 0) ){alert ('Favor llenar Valor de unidades ')}
							else {if (CodP ==""){alert ('Favor llenar codigo del producto ')}
							else {if (Descripcion ==""){alert ('Favor llenar la Descripcion ')}
							 else {if (IDmedida =="-1"){alert ('Favor Seleccione una unidad de medida ')}
			  			else{
							var valores =  "nuevo="+"&documentoR="+Documento+"&medidaR="+UM+"&idprodR="+CodP+"&unidadesR="+Unidades+"&medidaR="+IDmedida+"&codV="+totalx+"&OrigenMedida="+origen+"&RelationM="+Relation+"&Descrip="+Descripcion+"&valorCompra="+ValorCompra;
							
									$.ajax({
									  type:"post",
									  url:"ajax/AJCEnviosBodegas.php",
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
					}	
				}
			}
		}
	}
}
	

	
	
    function Tabla_Data(){
		var uniquid = $('#DOC').val();
		var valoresTabla = "tabla_data="+"&Unicod="+uniquid;
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
    function pruebaBod(request, response){
        $.ajax({
          type:"post",
          url:"ajax/AJCEnviosBodegas.php",
          dataType:"json",
          data:"Bodega=",
          success:function (data){
            response(data);
          }
        });
    }
    function FillBodega(data){	
		var CodBodega = $('#BodEntradaID').val();
		var valores =  "BodegasExistentes="+"&CodBodega="+CodBodega ;
      $.ajax({
          type:"post",
          url:"ajax/AJCEnviosBodegas.php",
          dataType:"json",
          data:valores,
		  async:false,
          success:function (data){
			 document.getElementById("BodEntradaNombre").value=data.Nombre
		  }

       });
    }
    $( "#BodEntradaID" ).autocomplete({
      source: function(request, response){
        pruebaBod(request, response);
      },
      select: function(event, ui){
        FillBodega(ui.item.value);
      }
    });
  });
  
function ValoresCT(data){
var Documento = $('#DOC').val();
        $.ajax({
          type:"post",
          url:"ajax/AJCEnviosBodegas.php",
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

function  Eliminar(IDdelete){
	
	var DeletId = IDdelete;
	var DocID=$('#DOC').val();
        $.ajax({
          type:"post",
          url:"ajax/AJCEnviosBodegas.php",
          dataType:"json",
          data:"Eliminar="+"&DeleteID="+DeletId+"&Uniquid="+DocID,
          success:function (data){
			  ValoresCT();
			   Tabla_Data();
          }
        }); Tabla_Data(); ValoresCT();
} 

function ValTOTAL() {
	var unidad =$("#unidades").val();
	var Res= null ;
	Res= totalx * unidad; 
	document.getElementById("VV").value = unidad * totalx ;
}
function SelectedV(){
	var UM = $('#UM').val();
	var Ncar = UM.length;
	var car=UM.charAt(Ncar-1); 
	var porcion=UM.substring(0,Ncar-1); 
	origen=car;
	id= porcion;
	if (origen=="M"){
	 otra2();
	}
	else{
		 $.ajax({
          type:"post",
          url:"ajax/AJCEnviosBodegas.php",
          dataType:"json",
		   data:"Detalle="+"&ID="+id,
          success:function (data){
			 	 ValorCompra=data.ValorCompra
			    Relation=data.relacion
			    totalx = data.ValVenta;
			    $("#existencias").html(data.existencias);
				$("#valorunitario").html(data.ValVenta);
				document.getElementById("VV").value=data.ValVenta;
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
          url:"ajax/AJCEnviosBodegas.php",
          dataType:"json",
          data:valores,
		  async:false,
          success:function (data){
			  Porcentaje =  data.decuento;
			   Relation=data.relacion
			   ValorCompra=data.ValorCompra
			  totalx = data.ValVenta;
         		document.getElementById("Descripcion").value=data.Descripcion;
			    document.getElementById("VV").value=data.ValVenta;
		  		$("#existencias").html(data.existencias);
				ValTOTAL();			
		     }
		  })
}

function ENVIAR(){	
var ttDoc =$("#Tdoc").val();
if(ttDoc==""){alert('No puedes guardar sin haber Seleccionado ningun producto!')}else{
		if (confirm('¿Realmente deseas continuar, presiona aceptar para realizar el envio o cancelar para cerrar este dialogo sin eliminar el dato?') == true) {
var documento=document.getElementById("DOC").value;
var Observaciones = document.getElementById("Obs").value;	
var BodegaeNT = document.getElementById("BodEntradaID").value;			
		$.ajax({
		type:"post",
		url:"ajax/AJCEnviosBodegas.php",
		dataType:"json",
		data:"Guardar="+"&Documento="+documento+"&Obs="+Observaciones+"&BodegaEntrada="+BodegaeNT,
		async: false,
		success : function(data) {
			 var i =0 ;
				for(i; i<= data.valores.length ; i++ ){
					IdProducto=data.valores[i]['Producto'];
					cantidadV=data.valores[i]['CantidadV'];
						$.ajax({
						  type:"post",
						  url:"ajax/AJCEnviosBodegas.php",
						  dataType:"json",
						  data:"Update="+"&Codigo="+IdProducto+"&cantidadV="+cantidadV+"&Documento="+documento+"&BodegaEntrada="+BodegaeNT,
						  success:function (data){
							  console.log('executing')
							  window.location.reload;
							  }});
				
							}
						}
					});		
				}
			}
}
