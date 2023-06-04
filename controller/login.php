<?php

    //Importar Archivo de Validaciones
    require_once("../addons/functions/validations.php");

    //Importar Archivo de Coneccion a BD
    require_once("../model/conexion.php");

    //Instanciamiento Objeto BD
    $db_conection =  new dbMatriculas();

    //Guardado Numero del Documento Ingresado
    $documento=recuperacion_post("documento");

    //Guardado Contraseña Ingresada
    $password=recuperacion_post("password");

    //Validacion de la Informacion Ingresada
    type_validation(
        [
            [$documento,"numeric"],
            [$password,"string"]
        ],
        "../"
    );

    //Variable de Testeo Controlador Login 
    $validacion_login = $db_conection->login($documento,$password);

    session_start();

    //Guardado de la informacion de la validacion en variables de sesion
    $_SESSION['status']=$validacion_login['status'];
    $_SESSION['message']=$validacion_login['message'];

    if($validacion_login['status']==TRUE){

        //Definicion de la informacion de los cursos del estudiante en forma de cookie
        setcookie('data_session',json_encode($validacion_login),time()+3600,"/");

        //Redireccion a la vista home
        header("Location: dashboard.php");

    }else{
        redireccion_rapida("../");
    }

?>