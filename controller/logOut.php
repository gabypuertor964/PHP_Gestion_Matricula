<?php

    require("../addons/functions/validations.php");
    require("../model/conexion.php");

    //Volver a establecer la cokkie con valores de tiempo negativos para que esta sea borrada
    setcookie('data_session',NULL,time()-1,'/');
    
    //Activacion y borrado de la informacion de sesion guardad
    session_start();
    $_SESSION=NULL;

    //Redireccion al login
    redireccion_rapida("../");
?>