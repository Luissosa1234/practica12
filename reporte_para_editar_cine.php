<?php
    //Insertamos el código PHP donde nos conectamos a la base de datos *******************************
    require_once "pag/conn_mysql_alan.php";
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
<title>Practica 12 Actualizar</title>
<link rel="stylesheet" href="css/style.css">


</head>

<body>

<header class="logo">
         <img src="img/logo.png" alt="cinepolis">
        
            </header>

        

<div id="wrapper">

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
                <td><?php echo $row['correo_cine']; ?></td>
                
    
              
                
                <!-- CELDA 2 para la ilga de EDITAR -->
                 <td><a href="pag/editar_cine.php?id=
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