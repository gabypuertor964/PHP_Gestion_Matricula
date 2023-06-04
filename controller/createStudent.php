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

            //Guardar la informacion del formulario en sus respectivas variables
            $documento=recuperacion_post("documento");
            $nombreCompleto=recuperacion_post("nombreCompleto");
            $edad=recuperacion_post("edad");
            $idEntidad=recuperacion_post("idEntidad");
            $password=recuperacion_post("password");

            //Validar el formato de la informacion recibida
            type_validation(
                [
                    [$documento,"numeric"],
                    [$nombreCompleto,"string"],
                    [$edad,"numeric"],
                    [$idEntidad,"numeric"],
                    [$password,"string"]
                ],
                "../views/CreateUser.php"
            );

            //Validar si el numero de documento ingresado en el formulario corresponde a un documento ya registrado
            if(!$dbConection->validarEstudiante($documento,$nombreCompleto)){
                redireccion_rapida("../views/createUser.php");
            }

            //Validar si el idEntidad ingresado en el formulario, corresponde a una entidad ya registrada
            if($dbConection->validarEntidades($idEntidad)==NULL){
                redireccion_rapida("../views/createUser.php");
            }

        break;  
    }




?>