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
            redireccion_rapida("../createStudent.php");

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
                "../createStudent.php"
            );

            session_start();

            //Validar si el documento o el nombre ingresado en el formulario ya se encuentra registrado en el sistema
            $validationStudent=$dbConection->validarEstudiante($documento,$nombreCompleto);

            //Revisar Validacion del documento y en caso de ser necesario generar el mensaje de error y realizar el redireccionamiento correspondiente
            if($validationStudent['documento']==FALSE){
                $_SESSION['status']=FALSE;
                $_SESSION['message']="Error, ya se encuentra registrado este Documento";

                redireccion_rapida("../createStudent.php");
            }

            //Revisar Validacion del nombre y en caso de ser necesario generar el mensaje de error y realizar el redireccionamiento correspondiente
            if($validationStudent['nombre']==FALSE){
                $_SESSION['status']=FALSE;
                $_SESSION['message']="Error, ya se encuentra registrado este Nombre";

                redireccion_rapida("../createStudent.php");
            }

            //Validar si el idEntidad ingresado en el formulario, corresponde a una entidad ya registrada
            if($dbConection->validarEntidades($idEntidad)==NULL){

                $_SESSION['status']=FALSE;
                $_SESSION['message']="Error, Entidad no registrada";
                
                redireccion_rapida("../createStudent.php");
            }

            //Validar si el registro del estudiante se realizo de forma exitosa, y generar su respectivo mensaje (Tanto Afirmativo como negativo)
            if($dbConection->registrarEstudiante($documento,$nombreCompleto,$password,$edad,$idEntidad)){

                $_SESSION['status']=TRUE;
                $_SESSION['message']="Felicidades, se ha registrado Exitosamente";

                redireccion_rapida("../");
            }else{

                $_SESSION['status']=FALSE;
                $_SESSION['message']="Ha ocurrido un error, intentelo de nuevo mas tarde";

                redireccion_rapida("../createStudent.php");
            };


        break;  

        default:
            redireccion_rapida("../");
        break;
    }
?>