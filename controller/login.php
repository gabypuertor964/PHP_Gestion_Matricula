<?php

    require("../addons/functions/validations.php");

    //Guardado Numero del Documento Ingresado
    $num_doc=recuperacion_post("num_doc");

    //Guardado Contraseña Ingresada
    $password=recuperacion_post("password");

    //Validacion de la Informacion Ingresada
    type_validation(
        [
            [$num_doc,"numeric"],
            [$password,"string"]
        ],
        "../"
    );

    //Variable de Testeo Controlador Login 
    $validacion_login = [
        'status'=>TRUE,
        'message'=>'',
        'data_user'=>[
            'numDoc'=>1019604622
        ]
    ];

    //Guardado de la informacion de la validacion en variables de sesion
    $_SESSION['status']=$validacion_login['status'];
    $_SESSION['message']=$validacion_login['message'];

    //En caso de que la validacion de inicio de Sesion, el sistema realizara
    if($validacion_login['status']==TRUE){

        //Guardado de la informacion del usuario en una variable de sesion
        $_SESSION['data_user']=$validacion_login['data_user'];
        
        //Validar Si el usuario cuenta con cursos activos
        if(isset($validacion_login['data_courses'])){
            $_SESSION['data_courses']=$validacion_login['data_courses'];
        }else{
            $_SESSION['data_courses']=NULL;
        }

        //Redireccion a la vista home
        header("Location: ../views/home.php");

    }else{

        redireccion_rapida("../");

    }

?>