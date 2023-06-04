<?php

    require("../addons/functions/validations.php");
    require("../model/conexion.php");

    setcookie('data_session',NULL,time()-1,'/');
    $_SESSION=NULL;

    redireccion_rapida("../");
?>