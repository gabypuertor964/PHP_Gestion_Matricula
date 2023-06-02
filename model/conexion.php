<?php

   //variables para establecer la conexion

   $servidorBD = "localhost";
   $usuarioBD = "root";
   $contrasenaBD = "";

   $nombreBD = "dbGestionMatriculas";


   //variable que contiene los datos para la conexion
   $con = new mysqli($servidorBD, $usuarioBD, $contrasenaBD, $nombreBD);

   if ($con->connect_errno) {
      echo "Fallo al conectar a MySQL: (" . $con->connect_errno . ") " . $con->connect_error;
  }
  
  //echo $con->host_info . "\n";

  $numero_documento=1019604622;
  var_dump($con->query("CALL consultarEstudiante($numero_documento)"));

?>