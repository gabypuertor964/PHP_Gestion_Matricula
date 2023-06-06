<?php

    require("../addons/functions/validations.php");
    require("../model/conexion.php");

    setcookie('data_session',NULL,time()-1,'/');
    
    session_start();
    $_SESSION=NULL;

    redireccion_rapida("../");
?>