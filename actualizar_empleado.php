<?php
    // Insertamos el código PHP donde nos conectamos a la base de datos 
    require_once "conn_mysql_alan.php";
	
	//Recuperamos los valores de las cajas de texto y de los demás objetos de formulario
    $numero = $_POST["txtnumeroOCULTO"];
	$numero = (int)$numero;
	$nombre = strtoupper(trim($_POST["txtnombre"]));
	$salas = $_POST["txtsalario"];
	$correo = trim($_POST["txtcategoria"]);
	$domicilio = trim($_POST["txtdomicilio"]);
	$telefono = trim($_POST["txttelefono"]);
	$departamento = $_POST["combo_departamento"];
	
	echo ">>>>>>>>>>>>>>>".$departamento;
    // Escribimos la consulta para ACTUALIZAR LOS DATOS EN LA TABLA de empleados
    $sqlUPDATE  = "UPDATE cines SET nombre_cine = '$nombre', no_salas = $salas, 
	               correo_cine = '$correo', domicilio_cine = '$domicilio', 
				   telefono_cine = '$telefono', id_municipio = '$departamento'  WHERE id_cine = " . $numero;
    // Ejecutamos la sentencia UPDATE de SQL a partir de la conexión usando PDO
    $conn->exec($sqlUPDATE);
	
	
	// Escribimos la consulta para recuperar el nombre del Departamento del Empleado editado
	// Y no mostrar en pantalla el ID de departamento que no es entendible para el usuario
    $sqlDptos = "SELECT  municipio FROM municipios WHERE id_municipio ='" . $departamento . "'";
    // Almacenamos los resultados de la consulta en una variable llamada $smtp a partir de la conexión
    $stmt2 = $conn->query($sqlDptos);
    // Recuperamos los valores de los registros de la tabla que ya están en la variable $stmt
	$rows2 = $stmt2->fetchAll();
	
	


	// Verificamos si está vacia la variable $smtp, si es positivo imprimimos en pantalla que no trae
    if (empty($rows2)) {
        $result2 = "No se encontró ese departamento !!";
    } else {
		foreach ($rows2 as $row2) 
		{
			
			//Esta será la variable que se mostrará en pantalla con el Nombre Descriptivo del Departamento
			//En lugar de mostrar el ID de departamento que no es entendible para el usuario final
			$NombreDepartamento = $row2['municipio'];
		}
	}

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Actualización de empleados desde PHP hacia MySQL</title>

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

</head>

<body>

<div id="wrapper">

   <div id="caja1">Licenciatura en Tecnologías de la Información</div>
   <div id="caja2">Programación web</div>
   <div id="caja3">Datos del empleado actualizados correctamente</div>
 
   <div id="caja4">
     <div id="texto1"><br>
 
        <fieldset style="width: 90%;"    >
            <legend>CINE ACTUALIZADO SATISFACTORIAMENTE</legend>
                <div>
                    <br />
                         <b>Municipio:</b> <?php echo ($NombreDepartamento); ?>
                    <br />
                    <br />
                         <b>Número de cine:</b> <?php echo ($numero); ?>
                    <br />
                    <br />
                         <b>Nombre de empleado:</b> <?php echo ($nombre); ?>
                    <br />
                    <br />
                         <b>Numero de salas:</b> <?php echo ($salas); ?>
                    <br />
                    <br />
                         <b>Correo de cine:</b> <?php echo ($correo); ?>
                    <br />
                    <br />
                         <b>Domicilio de cine:</b> <?php echo ($domicilio); ?>
                    <br />
                    <br />
                    <a href="reporte_para_editar_pdo.php">EDITAR OTRO EMPLEADO</a>
                </div>
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