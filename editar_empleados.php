<?php
    // Insertamos el código PHP donde nos conectamos a la base de datos 
    require_once "conn_mysql_alan.php";
    $result = "";
	$result2 = "";

    // Escribimos la consulta para recuperar los cines de la tabla cines
    $sqlDptos = 'SELECT id_municipio, municipio FROM municipios';
    // Almacenamos los resultados de la consulta en una variable llamada $smtp a partir de la conexión
    $stmt2 = $conn->query($sqlDptos);
    // Recuperamos los valores de los registros de la tabla que ya están en la variable $stmt
    $rows2 = $stmt2->fetchAll();
	// Verificamos si está vacia la variable $smtp, si es positivo imprimimos en pantalla que no trae
    if (empty($rows2)) {
        $result2 = "No se encontraron cines !!";
    }
	
	// Recuperamos los valores de los objetos de QUERYSTRING que viene desde la URL mediante GET ******
	$idcine= $_GET["id"];
	
	// Conversión explicita de CARACTER a ENTERO mediante el forzado de (int), 
	// los valores por GET son tipo STRING ************************************************************
	$idcine = (int)$idcine; //*****************************************************************
	
    //Verificamos que SI VENGA EL NUMERO DE EMPLEADO **************************************************
	if($idcine == "")
	{
		header("Location: reporte_para_editar_pdo.php");
		exit;
	}
	if(is_null($idcine))
	{
		header("Location: reporte_para_editar_pdo.php");
		exit;
	}
	
    // Escribimos la consulta para recuperar el UNICO REGISTRO de MySQL mediante el ID obtenido por _GET
	$sql3 = 
	'SELECT 
	C.id_cine, 
	C.nombre_cine, 
	C.no_salas, 
	C.domicilio_cine, 
	C.telefono_cine, 
	C.correo_cine, 
	D.id_municipio, 
	D.municipio 
	FROM cines C 
	INNER JOIN 
	municipios D ON  C.id_cine ='. $idcine  ;
	
    //echo ($sql3);
	//die();

    // Ejecutamos la consulta y asignamos el resultado a la variable llamada $result
    $result = $conn->query($sql3);
      
    // Recuperamos los valores o registros de la variable $result y los asignamos a la variable $rows
    $rows = $result->fetchAll();
	
    // El resultado se mostrará en la página, en el BODY ***************************************************
    if (empty($rows)) {
        $result = "No se encontraron empleados !!";
		header("Location: reporte_para_editar_pdo.php");
		exit;
    }
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Regitro de empleados desde PHP hacia MySQL</title>

<style type="text/css" media="screen">

body { background-color:#999;}

#wrapper {
	margin: auto;
	width: 960px;
	height: 550px;
	background-color: #CCC;
	}
	
#caja1 {
	width: 300px;
	height: 50px;
	margin-left: 10px;
	margin-right: 10px;
	margin-top: 10px;
	background-color: #FFC;
	float: left;
}

#caja2 {
	width: 300px;
	height: 50px;
	margin-left: 10px;
	margin-right: 10px;
	margin-top: 10px;
	background-color: #FFC;
	float: left;
}

#caja3 {
	width: 300px;
	height: 50px;
	margin-left: 10px;
	margin-right: 10px;
	margin-top: 10px;
	background-color: #FFC;
	float: left;
}

#caja4 {
	width: 940px;
	height: 450px;
	margin-left: 10px;
	margin-right: 10px;
	margin-top: 40px;
	background-color: #333;
	clear: both;
	/*
		 position:absolute; 
		 top:200px;
		 */
		 
	position: relative;
	top: 10px;
	}
	
#imagen1 { position:relative; top:10px; right:-10px; }

#texto1 {
	width: 500px;
	height: 400px;
	margin-left: 5px;
	margin-right: 10px;
	margin-top: 10px;
	background-color: #CCC;
	padding: 5px;
	float: right;
	right: -10px;
	top: 10px;
	}
	
#AddEmpleado{ 
    position: absolute;
    right: 50px;
    border:3px solid #009;
    padding: 10px;
}

</style>

<script language="javascript">
  <!--
	  function ValidaFormulario()
	  {
		 //Recuperamos lo elegido en el combo de los id_cine
		 var id_cine = document.getElementById("combo_departamento").selectedIndex;
		 //Recuperamos lo escrito en la caja del número de empleado:
		 var valorNumero = document.getElementById("txtnumero").value;
		 //Recuperamos lo escrito en la caja del nombre del empleado:
		 var valorNombre = document.getElementById("txtnombre").value;
		 //Recuperamos lo escrito en la caja del salario del empleado:
		 var valorSalario = document.getElementById("txtsalario").value;
		 //Recuperamos lo escrito en la caja de la categoría del empleado:
		 var valorCategoria = document.getElementById("txtcategoria").value;
		 //Recuperamos lo elegido en el combo de los sexos
		 var sexo = document.getElementById("combo_sexo").selectedIndex;	
		 //VALIDACIONES *****************************************************************
		 //Caja de Texto ****************************************************************
         if(valorNumero == null || valorNumero.length == 0 || /^\s+$/.test(valorNumero)) 
		 {
			 alert("Debes escribir el número de empleado");
			 document.getElementById("txtnumero").focus();
             return false;
		 } else if (valorNombre == null || valorNombre.length == 0 || /^\s+$/.test(valorNombre)){
			 alert("Debes escribir el nombre del empleado");
			 document.getElementById("txtnombre").focus();
             return false;	 
	     } else if (valorSalario == null || valorSalario.length == 0 || /^\s+$/.test(valorSalario)){
			 alert("Debes escribir el salario del empleado");
			 document.getElementById("txtsalario").focus();
             return false;
		 } else if (valorCategoria == null || valorCategoria.length == 0 || /^\s+$/.test(valorCategoria)){
			 alert("Debes escribir la categoría del empleado");
			 document.getElementById("txtcategoria").focus();
             return false;	 
		 //Cajas de Selección (Combo Box) ****************************************************************
         } else if (sexo == null || sexo == 0){
			 alert("Debes elegir un sexo");
			 document.getElementById("combo_sexo").focus();
             return false;
		 } else if (id_cine == null || id_cine == 0){
			 alert("Debes elegir un id_cine");
			 document.getElementById("combo_departamento").focus();
             return false;
         } //Cuando ya están contestadas todas las cajas de texto y seleccionados los combobox enviamos el form
			 return true; 
		 }
  //-->
</script>

</head>

<body>

<div id="wrapper">

   <div id="caja1">Licenciatura en Tecnologías de la Información</div>
   <div id="caja2">Programación web</div>
   <div id="caja3">Formulario para editar la información de los empleados en la BD desde una página web</div>
 
   <div id="caja4">
     <div id="texto1"><br>
 
        <fieldset style="width: 90%; font-weight: bold;"    >
            <legend>EDITAR EL CINE SELECCIONADO</legend>
          <form action="actualizar_empleado.php" method="post" id="formulario1" onsubmit="return ValidaFormulario()">
		  <?php
            foreach ($rows as $row) {}
			//Imprimimos en la página EL UNICO REGISTRO de MySQL en un renglon de HTML
          ?>
                <div>
                    <br />
                      <label for="id_municipio">Municipio del cine:</label>

                      <select name="combo_departamento" id="combo_departamento">
                      <option value="0">-- Selecciona un municipio --</option>
                      
							<?php 
								 foreach ($rows2 as $row2) 
								 {
									echo '<option value="'.$row2['id_municipio'].'">'.$row2['municipio'].'</option>';
								 }
							?>
                                        
						  <option value="<?php echo $row['id_municipio']; ?>" selected>
							 <?php echo $row['municipio']; ?>
						  </option>
                      </select>
                           
                      
                    <br />
                    <br />
                    Número de cine: 
                    <input type="text" name="txtnumero" id="txtnumero" size="10" 
                    value="<?php echo $row['id_cine']; ?>" disabled />
                    <br />
                    <br />
                    Nombre de cine: 
                    <input type="text" name="txtnombre" id="txtnombre" size="40" 
                    value="<?php echo $row['nombre_cine']; ?>" />
                    <br />
                    <br />
                         Salario de empleado_: 
                    <input type="text" name="txtsalario" id="txtsalario" size="15" 
                    value="<?php echo $row['no_salas']; ?>" />
                    <br />
                    <br />
					Telefono de cine: 
                    <input type="text" name="txttelefono" id="txttelefono" size="40" 
                    value="<?php echo $row['telefono_cine']; ?>" />
                    <br />
                    <br />
					Domicilio de cine: 
                    <input type="text" name="txtdomicilio" id="txtdomicilio" size="40" 
                    value="<?php echo $row['domicilio_cine']; ?>" />
                    <br />
                    <br />
                         Correo cine: 
                    <input type="text" name="txtcategoria" id="txtcategoria" size="40" value="<?php echo $row['correo_cine']; ?>" />
                    <br />
                   
                    
                      <input type="hidden" name="txtnumeroOCULTO" id="txtnumeroOCULTO" value="<?php echo $row['id_cine']; ?>" />
                      <input type="submit" name="AddEmpleado" id="AddEmpleado" value="  Guardar cambios " />
                    <br />
                </div>
								<?php  ?>
            </form>
        </fieldset> 
     </div>
  </div>
</div>
     <?php
			//Cerramos la oonexion a la base de datos **********************************************
			$conn = null;
     ?>
</body>
</html>