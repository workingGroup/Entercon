// JavaScript Document
var CodigoID=null;
    $(document).ready(function(){
		console.log('ready')
 Tabla_DataFact()
    });
	 
	 
  function printcontent(el){
	  var resetearpagina  = document.body.innerHTML;
	  var Printcontent = document.getElementById(el).innerHTML;
	  document.body.innerHTML = Printcontent;
	  window.print();
	  document.body.innerHTML = restorepage;
  }

 function Tabla_DataFact(){
      $.ajax({
          type:"post",
          url:"ajax/AJCFacturas.php",
          dataType:"json",
          data:"TablaPE=",
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
          url:"ajax/AJCSaldoCliente.php",
          dataType:"json",
          data:"Abono="+"&Cantidad="+Cantidad+"&Idocumento="+ID,
          success:function (data){
           Tabla_DataFactPE()
          }
        });
    }
}

function VerRecivos(ID) {
	alert(ID)
}

   