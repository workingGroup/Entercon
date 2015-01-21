var Nombre = null ;
var Clasificacion = null ;
var Marca = null ;
var Modelo = null;
var Proveedor= null; 
var Minimos =null ;
var ValorCompra = null;
var ValorVenta=null;
var Medida= null;
var ModificarPrecio= null;
var Usuario=null;
/////Detalle
//LLenar detalle Segun NO Documento
function llenarValores(){
	
	document.getElementById("Nombre").value=Nombre;
	document.getElementById("Modelo").value=Modelo;
	document.getElementById("Minimos").value=Minimos;
	document.getElementById("ValorCompra").value=ValorCompra;
	document.getElementById("ValorVenta").value=ValorVenta;	
	document.getElementById("Medida").value=Medida;	
	if(ModificarPrecio==1){
		 document.getElementById("ModificarPrecio").checked = true;
	}else if(ModificarPrecio==0){
		 document.getElementById("ModificarPrecio").checked = false;
		
	}
}

function Primero(){
	var Codigo =document.getElementById("Codigo").value;
 $.ajax({
          type:"post",
          url:"ajax/AJCModificarProducto.php",
          dataType:"json",
          data:"ModificarProducto="+"&Codigo="+Codigo,
          success:function (data){

 Nombre =  data.Nombre ;
 Modelo =  data.Modelo;
 Minimos = data.Minimos ;
 ValorCompra =  data.ValorCompra;
 ValorVenta= data.ValorVenta;
 ModificarPrecio=  data.ModificarPrecio;
 Usuario= data.Usuario;
         llenarValores(); 
		  
          }
        });

}
	
   $(document).ready(function(){
Primero();
 tipoProd()
	 Marcas();
	 Proveedores();
	 Medidas();
    }); 
	
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

  function tipoProd(){
   $.ajax({
          type:"post",
          url:"ajax/AJCModificarProducto.php",
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
    function Marcas(){
   $.ajax({
          type:"post",
          url:"ajax/AJCModificarProducto.php",
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
    function Proveedores(){
   $.ajax({
          type:"post",
          url:"ajax/AJCModificarProducto.php",
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
function Medidas(){
   $.ajax({
          type:"post",
          url:"ajax/AJCModificarProducto.php",
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
  ChkFacturas();
function ChkFacturas(){
	var VALORCHK=0;
 if ($('#ModificarPrecio').is(":checked"))
{
chk=1;
}else{ 
chk=0;
}
}
   function AgregarProducto(){
	var Codigo =document.getElementById("Codigo").value;
	var Nombre = document.getElementById("Nombre").value;
	var Modelo =document.getElementById("Modelo").value;
	var minimos = document.getElementById("Minimos").value;
	var PC= document.getElementById("ValorCompra").value;
	var PV=document.getElementById("ValorVenta").value;
	
	

	
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
          url:"ajax/AJCModificar.php",
          dataType:"json",
          data:"Modify="+"&Codigo="+Codigo+"&Nombre="+Nombre+"&Modelo="+Modelo+"&minimos="+minimos+"&PC="+PC+"&PV="+PV+"&clasificacion="+clasificacionSV+"&Marca="+MarcaSV+"&Proveedor="+ProveedorSV+"&Medida="+MedidaSV+"&CHK="+chk,
		  async:false,
          success:function (data){
			  alert('Exito al Actualizar');
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