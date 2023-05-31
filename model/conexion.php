<?php

   //variables para establecer la conexion

   $servidorBD = "localhost";
   $usuarioBD = "root";
   $contrasenaBD = "";

   $nombreBD = "bd_gestionmatricula";


   //variable que contiene los datos para la conexion
   $con = new mysqli($servidorBD, $usuarioBD, $contrasenaBD, $nombreBD);

?>