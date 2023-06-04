<?php
    require("../addons/functions/validations.php");
    require("../model/conexion.php");
    
    $dbConection = new dbMatriculas();

    //Validacion existencia de Cookie
    if(!isset($_COOKIE['data_session'])){
        redireccion_rapida("../");
    }

    //Activacion de la Sesion
    session_start();

    //Borrado de todos los datos de sesion para evitar regresar a vistas bloqueadas
    $_SESSION=null;

    //Recuperacion y posterior guardado en variables de sesion de los cursos activos del estudiante
    $_SESSION['data_courses']=$dbConection->consultarMatriculas(json_decode($_COOKIE['data_session'])->data_student->numDoc);

    redireccion_rapida("../views/");

?>