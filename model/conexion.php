<?php

   //variables para establecer la conexion

   $servidorBD = "localhost";
   $usuarioBD = "root";
   $contrasenaBD = "";

   $nombreBD = "bd_gestionmatricula";


   //variable que contiene los datos para la conexion
   $con = new mysqli($servidorBD, $usuarioBD, $contrasenaBD, $nombreBD);

   if ($con->connect_errno) {
      echo "Fallo al conectar a MySQL: (" . $con->connect_errno . ") " . $con->connect_error;
  }
  
  echo $con->host_info . "\n";
  ?>

?>