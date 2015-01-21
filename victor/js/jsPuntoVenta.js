var Porcentaje = null;
var totalx = null ;
var total = null ;
var Unidades = null;
var CodP = null; 
var origen =null ;
var Relation = null;
var binario= null;
var ValorCompra = null ;
var Tp=null;

$(document).ready(function(){

    $('a').on('mousedown', stopNavigate);

    $('a').on('mouseleave', function () {
           $(window).on('beforeunload', function(){
                  return 'Are you sure you want to leave?';
           });
    });
});

function stopNavigate(){    
    $(window).off('beforeunload');
}
$(window).on('beforeunload', function(){
      return 'Are you sure you want to leave?';
});

$(window).unload(function(evento){
  var DocID=$('#DOC').val();
					$.ajax({	type:"post",
						  url:"ajax/AJCPuntoVenta.php",
						  dataType:"json",
						  data:"BIN="+"&IDDOC="+DocID,
						  async:false,
						  success:function (data)
						    {
							  var bin = data;
							  if (bin==0){
								  binario=bin;
								   DocumentoFacturado();						
										}else if(bin==1){
								  binario=bin;}
										
							}
			});
	  });
function TpagoSelecteValue(){
Tp = $('#Tpago').val();	
if(Tp ==-1){alert('seleccione Tipo de Pago Para continuar')
 $("#Imprimir").attr('disabled', true);}
else{
 $("#Imprimir").attr('disabled', false);
}
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
function DocumentoFacturado(){ 
	var DocID=$('#DOC').val();
	var cantidadV= null ; 
	var IdProducto= null;
	$.ajax({
          type:"post",
          url:"ajax/AJCPuntoVenta.php",
          dataType:"json",
          data:"FacturadoSN="+"&IDDOC="+DocID,
		   async : false,
          success:function (data){
			  var i =0 ;
				for(i; i<= data.valores.length ; i++ ){
					IdProducto=data.valores[i]['Producto'];
					cantidadV=data.valores[i]['CantidadV'];
						$.ajax({
						  type:"post",
						  url:"ajax/AJCPuntoVenta.php",
						  dataType:"json",
						  async : false,
						  data:"Update="+"&Codigo="+IdProducto+"&cantidadV="+cantidadV+"&IDDOC="+DocID,
						  success:function (data){
							  console.log('executing')
							  }});
				}
		  	}
        });
}
 $(function() {
    function prueba(request, response){
        $.ajax({
          type:"post",
          url:"ajax/AJCPuntoVenta.php",
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
          url:"ajax/AJCPuntoVenta.php",
          dataType:"json",
          data:valores,
		  async:false,
          success:function (data){
			  Porcentaje =  data.decuento;
			  totalx = data.ValVenta;
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
	var Serie = $('#Series').val();
	var Documento =$('#DOC').val();
	var IDmedida = $('#UM').val();
	var Fact = $('#Factura').val();
	var Nit = $('#NIT').val();
	var cliente = $('#Cliente').val();
	var Direccion = $('#Direccion').val();
	var TPago = $('#Tpago').val();
	
if (Serie==""){alert ('Favor llenar numero de serie')}
else {
	if (Fact==""){alert ('Favor llenar numero de factura')}
	else{ if (Nit ==""){alert ('Favor llenar numero de NIT')}
	     else{ if (cliente ==""){alert ('Favor llenar Nombre de Cliente')}
		 	  else{ if (Direccion ==""){alert ('Favor llenar Datos de Direccion')}
			  		else{if ((Unidades =="") || (Unidades<= 0) ){alert ('Favor llenar Valor de unidades ')}
							else {if (CodP ==""){alert ('Favor llenar codigo del producto ')}
							else {if (Descripcion ==""){alert ('Favor llenar la Descripcion ')}
							 else {if (IDmedida =="-1"){alert ('Favor Seleccione una unidad de medida ')}
							 	else {if (TPago =="-1"){alert ('Favor Seleccione Tipo de pago del documento ')}
			  			else{
							var valores =  "nuevo="+"&serieR="+Serie+"&documentoR="+Documento+"&medidaR="+UM+"&idprodR="+CodP+"&unidadesR="+Unidades+"&medidaR="+IDmedida+"&TotalDesc="+Total+"&codV="+totalx+"&OrigenMedida="+origen+"&RelationM="+Relation+"&Descrip="+Descripcion+"&valorCompra="+ValorCompra+"&TipoPago="+Tp;
							
									$.ajax({
									  type:"post",
									  url:"ajax/AJCPuntoVenta.php",
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
			}
		}
	}
}
	

	
	
    function Tabla_Data(){
		var uniquid = $('#DOC').val();
		var valoresTabla = "tabla_data="+"&Unicod="+uniquid;
      $.ajax({
          type:"post",
          url:"ajax/AJCPuntoVenta.php",
          dataType:"json",
          data:valoresTabla,
          success:function (data){
            $("#tabla_data").html(data);
          }
        });
    }
	
    function ClienteSearch(request, response){
        $.ajax({
          type:"post",
          url:"ajax/AJCPuntoVenta.php",
          dataType:"json",
		  async:false,
          data:"Cliente="+request.term,
          success:function (data){
            response(data);
          }
        });
    }
	$(function() {
    $(document).ready(function(){
  Tabla_Data();
  ComboTP();
  MaxDesc();
    });
    function ClienteFill(data){
     	var NIT =  document.getElementById("NIT").value;
		var valores =  "NITFILL="+"&nitR="+NIT ;
      $.ajax({
          type:"post",
          url:"ajax/AJCPuntoVenta.php",
          dataType:"json",
          data:valores,
		  async: false,
          success:function (data){
        document.getElementById("Cliente").value=data.Nombre;
		document.getElementById("Direccion").value=data.Direccion;

          }

        });
    }
    $( "#NIT" ).autocomplete({
      source: function(request, response){
        ClienteSearch(request, response);
      },
      select: function(event, ui){
      ClienteFill(ui.item.value);
      }
    });
  });
  
function ValoresCT(data){
var Documento = $('#DOC').val();
        $.ajax({
          type:"post",
          url:"ajax/AJCPuntoVenta.php",
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
 document.getElementById("Desc").value="";
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
          url:"ajax/AJCPuntoVenta.php",
          dataType:"json",
          data:"Eliminar="+"&DeleteID="+DeletId+"&Uniquid="+DocID,
          success:function (data){
			  ValoresCT();
			   Tabla_Data();
          }
        }); Tabla_Data(); ValoresCT();
} 

function MaxDesc(){
	console.log('descuento')
	var ValorDescuento =document.getElementById("Desc").value;
	var Descuento = ValorDescuento /100;
 	if (Porcentaje>=Descuento){
		var ValVen =document.getElementById("VV").value;
		Total = Descuento * ValVen ;		
	}else{ 
	    alert ('El porcentaje sobrepasa a su porcentaje de descuento correspondido');
	document.getElementById("Desc").value="";
	}
     
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
          url:"ajax/AJCPuntoVenta.php",
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
function Facturar(){
	var Documento =$('#DOC').val();
	var fecha =$('#fecha').val();
	var Serie =$('#Series').val();
	var Factura =$('#Factura').val();
	var NIT =$('#NIT').val();
	var Cliente =$('#Cliente').val();
	var Direccion =$('#Direccion').val();
	var Tpago =$('#Tpago').val();
	var TDoc =1;

if (Serie==""){alert ('Favor llenar numero de serie')}
else {
	if (Factura==""){alert ('Favor llenar numero de factura')}
	else{ if (NIT ==""){alert ('Favor llenar numero de NIT')}
	     else{ if (Cliente ==""){alert ('Favor llenar Nombre de Cliente')}
		 	  else{ if (Tpago ==-1){alert ('Favor seleccione Tipo de pago')}
			  		 else{ if (Direccion ==""){alert ('Favor llenar Datos de Direccion')}
			  			else{
	
	window.open('detalletipodepago.php?id='+Documento+'&fecha='+fecha+'&Series='+Serie+'&Factura='+Factura+'&NIT='+NIT+'&Cliente='+Cliente+'&Direccion='+Direccion+'&Tpago='+Tpago+'&TDoc='+TDoc+'','Tipo de Pago','width=1100, height=350');
	 return false;
									}
								}
							}
						}
					}	
				}
			}
				
	 		
function otra2(){
 	    var codP = $('#tags').val();
		var valores =  "existencias="+"&CodProd="+codP ;
      $.ajax({
          type:"post",
          url:"ajax/AJCPuntoVenta.php",
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
