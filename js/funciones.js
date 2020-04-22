function ValidaFormulario()
{
  // nombre del cine
   var valorNombre = document.getElementById("txtnombre").value;
   //Numero de salas
   var valorSalas = document.getElementById("txtsalario").value;
   //telefono
   var valorTelefono = document.getElementById("txttelefono").value;
  //  domicilio
   var valorDomicilio = document.getElementById("txtdomicilio").value;
  //  correo
   var valorCorreo = document.getElementById("txtcategoria").value;
   //Caja de Texto ****************************************************************
   if (valorNombre == null || valorNombre.length == 0 || /^\s+$/.test(valorNombre)){
       alert("Debes escribir el nombre del empleado");
       document.getElementById("txtnombre").focus();
       return false;	 
   } 
   
  if (valorSalas == null || valorSalas.length == 0 || /^\s+$/.test(valorSalas)){
       alert("Debes escribir el numero de salas");
       document.getElementById("txtsalario").focus();
       return false;	 
   }


   if (valorTelefono == null || valorTelefono.length == 0 || /^\s+$/.test(valorTelefono)){
       alert("Debes escribir el numero de Telefono");
       document.getElementById("txtsalario").focus();
       return false;	 
   }

   if (valorDomicilio == null || valorDomicilio.length == 0 || /^\s+$/.test(valorDomicilio)){
       alert("Debes escribir el Domicilio");
       document.getElementById("txtsalario").focus();
       return false;	 
   }

   if (valorCorreo == null || valorCorreo.length == 0 || /^\s+$/.test(valorCorreo)){
       alert("Debes escribir el Correo electronico");
       document.getElementById("txtsalario").focus();
       return false;	 
   }
}