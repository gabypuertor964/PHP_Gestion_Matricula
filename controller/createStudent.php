<?php
    require("../addons/functions/validations.php");
    require("../model/conexion.php");

    $dbConection = new dbMatriculas();

    //Validar si se envio la variable 'function' a traves del metodo $_GET
    type_validation([[$_GET['function'],"all"]],"../");

    //Realizar ciertas acciones segun la variable 'function', validad anteriormente
    switch($_GET['function']){

        case "viewStudent":

            session_start();
            
            //Obtener las entidades registradas y guardarlas en una variable de sesion
            $entidades = $dbConection->consultarEntidades();
            $_SESSION['entidades']=$entidades;

            //Redirigir a la vista correspondiente
            redireccion_rapida("../views/createUser.php");

        break;

        case "newStudent":

        break;

        default:
            redireccion_rapida("../");
        break;
    }




?>