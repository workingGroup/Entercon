// JavaScript Document
var clasificacionSV=-1;
var MarcaSV=-1;
var ProveedorSV=-1;
var MedidaSV=-1;

function ClasificacionSValue(){
clasificacionSV = document.getElementById("Clasificacion").value;	
if (clasificacionSV==-1)
{alert("Seleccione Clasificacion")}
}
function MarcaSValue(){
MarcaSV = document.getElementById("Marca").value;
if (MarcaSV==-1)
{alert("Seleccione Marca")}
}
function ProveedorSValue(){
ProveedorSV = document.getElementById("Proveedor").value;	
if (ProveedorSV==-1)
{alert("Seleccione Proveedor")}
}
function MedidaSValue(){
MedidaSV = document.getElementById("Medida").value;	
if (MedidaSV==-1)
{alert("Seleccione Medida")}

}

  function Clasificacion(){
   $.ajax({
          type:"post",
          url:"ajax/AJCMantenimientoProductos.php",
          dataType:"json",
          data:"Clasificacion=",
          success:function (data){
            	var numero =0 ;
					select = document.getElementById("Clasificacion");
					var vacio = document.createElement('option');
						vacio.value =-1;
						vacio.innerHTML ="Seleccione Clasificacion";
						select.appendChild(vacio);
					
						for(numero; numero<= data.Clasificacion.length ; numero++ ){
						var opt = document.createElement('option');
						opt.value =data.Clasificacion[numero]['ID'];
						opt.innerHTML =data.Clasificacion[numero]['Nombre'];
						select.appendChild(opt);
					}
          }
        });
  }
  $(document).ready(function() {
     Clasificacion();
	 Marca();
	 Proveedor();
	 Medida();
});
    function Marca(){
   $.ajax({
          type:"post",
          url:"ajax/AJCMantenimientoProductos.php",
          dataType:"json",
          data:"Marca=",
          success:function (data){
            	var numero =0 ;
					select = document.getElementById("Marca");
					var vacio = document.createElement('option');
						vacio.value =-1;
						vacio.innerHTML ="Seleccione Marca";
						select.appendChild(vacio);
						
						for(numero; numero<= data.Marca.length ; numero++ ){
						var opt = document.createElement('option');
						opt.value =data.Marca[numero]['ID'];
						opt.innerHTML =data.Marca[numero]['Nombre'];
						select.appendChild(opt);
					}
          }
        });
  }
    function Proveedor(){
   $.ajax({
          type:"post",
          url:"ajax/AJCMantenimientoProductos.php",
          dataType:"json",
          data:"Proveedor=",
          success:function (data){
            	var numero =0 ;
					select = document.getElementById("Proveedor");
					var vacio = document.createElement('option');
						vacio.value =-1;
						vacio.innerHTML ="Seleccione Proveedor";
						select.appendChild(vacio);
						
						for(numero; numero<= data.Proveedor.length ; numero++ ){
						var opt = document.createElement('option');
						opt.value =data.Proveedor[numero]['ID'];
						opt.innerHTML =data.Proveedor[numero]['Nombre'];
						select.appendChild(opt);
					}
          }
        });
  }
function Medida(){
   $.ajax({
          type:"post",
          url:"ajax/AJCMantenimientoProductos.php",
          dataType:"json",
          data:"Medida=",
          success:function (data){
            	var numero =0 ;
					select = document.getElementById("Medida");
					var vacio = document.createElement('option');
						vacio.value =-1;
						vacio.innerHTML ="Seleccione Medida";
						select.appendChild(vacio);
					
						for(numero; numero<= data.Medida.length ; numero++ ){
						var opt = document.createElement('option');
						opt.value =data.Medida[numero]['ID'];
						opt.innerHTML =data.Medida[numero]['Nombre'];
						select.appendChild(opt);
					}
          }
        });
  }
  function AgregarProducto(){
	var Codigo =document.getElementById("Codigo").value;
	var Nombre = document.getElementById("Nombre").value;
	var Modelo =document.getElementById("Modelo").value;
	var minimos = document.getElementById("Minimos").value;
	var PC= document.getElementById("Valorc").value;
	var PV=document.getElementById("Valorv").value;
if (Codigo==""){alert ('Favor llenar Codigo')}
else {
	if (Nombre==""){alert ('Favor llenar Nombre')}
	else{ if (Modelo ==""){alert ('Favor llenar numero de Modelo')}
	     else{ if (minimos ==""){alert ('Favor llenar minimos')}
		 	  else{ if (PC ==""){alert ('Favor llenar Datos de Precio de Compra')}
			  		else{if (PV ==""){alert ('Favor llenar Valor de Precio de Venta ')}
							else {if (clasificacionSV =="-1"){alert ('Favor seleccione clasificacion ')}
							else {if (MarcaSV =="-1"){alert ('Favor seleccione Marca ')}
							 else {if (ProveedorSV =="-1"){alert ('Favor seleccione Proveedor')}
							 	else {if (MedidaSV =="-1"){alert ('Favor Seleccione MedidaSV')}
			  			else{

	$.ajax({
          type:"post",
          url:"ajax/AJCNuevo.php",
          dataType:"json",
          data:"add="+"&Codigo="+Codigo+"&Nombre="+Nombre+"&Modelo="+Modelo+"&minimos="+minimos+"&PC="+PC+"&PV="+PV+"&clasificacion="+clasificacionSV+"&Marca="+MarcaSV+"&Proveedor="+ProveedorSV+"&Medida="+MedidaSV,
		  async:false,
          success:function (data){
			  alert('Exito al Insertar guardar');
			  window.opener.location.reload();
			 window.close();
	}
	});
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
	
	
	