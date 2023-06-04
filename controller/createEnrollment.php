<?php
    require("../addons/functions/validations.php");
    require("../model/conexion.php");

    $dbConection = new dbMatriculas();

    //Validar si se envio la variable 'function' a traves del metodo $_GET
    type_validation([[$_GET['function'],"all"]],"../");

    //Realizar ciertas acciones segun la variable 'function', validad anteriormente
    switch($_GET['function']){

        case "viewEnrollment":

            session_start();

            //Obtener las entidades registradas y guardarlas en una variable de sesion
            $cursos = $dbConection->consultarCursos();
            $_SESSION['cursos']=$cursos;

            //Redirigir a la vista correspondiente
            redireccion_rapida("../views/createEnrollment.php");

        break;

        case "newEnrollment":

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
                "../createStudent.php"
            );

            //Validar si el documento o el nombre ingresado en el formulario ya se encuentra registrado en el sistema
            if(!$dbConection->validarEstudiante($documento,$nombreCompleto)){
                redireccion_rapida("../createStudent.php");
            }

            //Validar si el idEntidad ingresado en el formulario, corresponde a una entidad ya registrada
            if($dbConection->validarEntidades($idEntidad)==NULL){
                redireccion_rapida("../createStudent.php");
            }

            if($dbConection->registrarEstudiante($documento,$nombreCompleto,$password,$edad,$idEntidad)){

                session_start();

                $_SESSION['status']=TRUE;
                $_SESSION['message']="Usuario Creado Exitosamente";

                redireccion_rapida("../");
            }else{
                redireccion_rapida("../createStudent.php");
            };


        break;  

        default:
            redireccion_rapida("../");
        break;
    }
?>