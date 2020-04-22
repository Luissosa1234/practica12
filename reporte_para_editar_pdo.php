<?php
    //Insertamos el código PHP donde nos conectamos a la base de datos *******************************
    require_once "conn_mysql_alan.php";
    // Escribimos la consulta para recuperar los registros de la tabla de MySQL
	$sql = 
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
	municipios D ON C.id_cine = D.id_municipio';

    // Ejecutamos la consulta y asignamos el resultado a la variable llamada $result
    $result = $conn->query($sql);
      
    // Recuperamos los valores o registros de la variable $result y los asignamos a la variable $rows
    $rows = $result->fetchAll();
	
	// Los valores que tendrá la variable $rows se organizan en un arreglo asociativo
	// (Variable con varias valores)
	// y se usará un ciclo foreach para recuper los valores uno a uno de ese arreglo
    // El resultado se mostrará en una tabla HTML ***************************************************
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Regitro de registros a eliminar</title>

<style type="text/css" media="screen">

body { background-color:#999;}

#wrapper {
	margin: auto;
	width: 960px;
	height:auto;
	background-color: #CCC;
	}
	
#caja1 {
	width: 300px;
	height: 60px;
	margin-left: 10px;
	margin-right: 10px;
	margin-top: 10px;
	background-color: #FFC;
	float: left;
}

#caja2 {
	width: 300px;
	height: 60px;
	margin-left: 10px;
	margin-right: 10px;
	margin-top: 10px;
	background-color: #FFC;
	float: left;
}

#caja3 {
	width: 300px;
	height: 60px;
	margin-left: 10px;
	margin-right: 10px;
	margin-top: 10px;
	background-color: #FFC;
	float: left;
}

#caja4 {
	width: 940px;
	height:400px;
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
	width: 900px;
	margin-left: 5px;
	margin-right: 10px;
	margin-top: 10px;
	background-color: #CCC;
	padding: 5px;
	float: right;
	right: -10px;
	top: 10px;
	}

</style>

</head>

<body>

<div id="wrapper">

   <div id="caja1">Licenciatura en Tecnolog&iacute;as de la Informaci&oacute;n</div>
   <div id="caja2">Programaci&oacute;n web</div>
   <div id="caja3">Reporte de registros de una tabla para ser ACTUALIZADOS en l&iacute;nea (PHP con PDP y MySQL)</div>
 
   <div id="caja4">
     <div id="texto1"><br>
 
        <table border="1" style="width:100%;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th># Salas</th>
                <th>Telefono</th>
                <th>Domicilio</th>
                <th>Correo</th>
                <th>Eliminar</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
        
        <?php
            foreach ($rows as $row) {
			//Imprimimos en la p�gina un renglon de tabla HTML por cada registro de tabla de MySQL
        ?>
            <tr>
                <td><?php echo $row['id_cine']; ?></td>
                <td><?php echo $row['nombre_cine']; ?></td>
                <td><?php echo $row['no_salas']; ?></td>
                <td><?php echo $row['telefono_cine']; ?></td>
                <td><?php echo $row['domicilio_cine']; ?></td>
                
    
                <!-- CELDA 1 para la ilga de BORRAR -->
                <td><a href="eliminar_empleado.php?id=
				 <?php echo $row['numero']; ?>">
				       eliminar
                    </a>
                </td>
                
                <!-- CELDA 2 para la ilga de EDITAR -->
                 <td><a href="editar_empleados.php?id=
				 <?php echo $row['id_cine']; ?>">
				        editar
                     </a>
                </td>
                
         
            </tr>
			
        <?php } ?>
        
         <tr>
                <td colspan="8">&nbsp;</td>
         </tr>
         <tr>
                <td>&nbsp;</td>
                <td><a href="alta_empleados.php">Agregar otro empleado</a></td>
                <td>&nbsp;</td>
                <td colspan="5">&nbsp;</td>
         </tr>   
        </tbody>
    </table>
     </div>
  </div>
</div>
     <?php
			//Cerramos la oonexion a la base de datos **********************************************
			$conn = null;
     ?>
</body>
</html>