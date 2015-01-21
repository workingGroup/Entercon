// JavaScript Document
var Documento=null;
var CodigoID=null;
    $(document).ready(function(){
		console.log('ready')
 ComboCodigoFill();
    });
	 
	 
  function printcontent(el){
	  var resetearpagina  = document.body.innerHTML;
	  var Printcontent = document.getElementById(el).innerHTML;
	  document.body.innerHTML = Printcontent;
	  window.print();
	  document.body.innerHTML = restorepage;
  }

function ChkFacturas(){
if ($('#Chk').is(":checked"))
{
Tabla_DataFactPEPA()
}else{ 
Tabla_DataFactPE()
}

	
}
 function ComboCodigoFill(){
	 
   $.ajax({
          type:"post",
          url:"ajax/AJCSaldoProveedor.php",
          dataType:"json",
          data:"Cliente=",
          success:function (data){
            	var i =0 ;
				select = document.getElementById("Codigo");
		  		var vacio = document.createElement('option');
				vacio.value ="-1";
				vacio.innerHTML = "Seleccione Proveedor";
				select.appendChild(vacio);
				
				for(i; i<= data.Codigo.length ; i++ ){
				var option = document.createElement('option');
				option.value =data.Codigo[i]['IdSocio'];
				option.innerHTML =data.Codigo[i]['Razon'];
				select.appendChild(option);
					}
          }
        });
  }

function selectedValue(){
	CodigoID=document.getElementById("Codigo").value;
	Tabla_DataFactPE()
	

}	
 function Tabla_DataFactPE(){
      $.ajax({
          type:"post",
          url:"ajax/AJCSaldoProveedor.php",
          dataType:"json",
          data:"TablaPE="+"&Codigo="+CodigoID,
          success:function (data){
            $("#Tabla").html(data);
          }
        });
    }
function Tabla_DataFactPEPA(){
		 $.ajax({
          type:"post",
          url:"ajax/AJCSaldoProveedor.php",
          dataType:"json",
          data:"TablaPEPA="+"&Codigo="+CodigoID,
          success:function (data){
            $("#Tabla").html(data);
          }
        });
    }
	
	function Abonar(ID) {
	  var Cantidad = prompt("Ingrese cantidad a abonar", "");
    if (Cantidad != null) {
     $.ajax({
          type:"post",
          url:"ajax/AJCSaldoProveedor.php",
          dataType:"json",
          data:"Abono="+"&Cantidad="+Cantidad+"&Idocumento="+ID,
          success:function (data){
           Tabla_DataFactPE()
		   if(data.binario=0){alert('su pago es mayor al de su deuda')}else{alert('Recibo Creado')}
          }
        });
    }
}

function VerRecivos(ID) {
	Documento=ID;
	
      $.ajax({
          type:"post",
          url:"ajax/AJCSaldoProveedor.php",
          dataType:"json",
          data:"Recibos="+"&Documento="+ID,
          success:function (data){
            $("#Recibo").html(data);
          }
        });
    }
	

   function colorBack(obj) {
 var fila = obj;
  fila.style.background ='white';
}
function color(obj) {
 var fila = obj;
  fila.style.background = 'PaleGreen';
}