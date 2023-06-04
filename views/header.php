<?php

    //Validar Si se definio el titulo de la cabecera de la pagina o define un valor por defecto
    if(isset($_SESSION['title'])){
        $title=$_SESSION['title'];
    }else{
        $title="Proceso Matricula";
    }

    //Valisdar si esta definida la cookie
    if(isset($_COOKIE['data_courses'])){
        //Guardado de la informacion de los cursos
        $data_courses=json_decode($_COOKIE['data_courses']);
    }else{
        header("Location: ../");
    }

    //Funcion encargada de Mostrar los mensajes interactivos (De existir)
    function messageAlert(){
        session_start();

        //Validar si hay algun mensaje activo
        if(isset($_SESSION['status']) && isset($_SESSION['message'])){

          //Guardar el mensaje en una variable y generar la clase css a usar en el alert
          $message=$_SESSION['message'];

          if($_SESSION['status']){
            $cls_alert="success";
          }else{
            $cls_alert="danger";
          }

          //Imprimir el Alert
          echo("
            <div class='alert alert-$cls_alert' role='alert'>
              $message
            </div>
          ");

          //Borrar los datos del mensaje
          $_SESSION['status']=$_SESSION['message']=null;

        }
    }
?>

<!doctype html>
<html lang="es">
    <head>

        <!--Titulo Header-->
        <title><?php echo($title)?></title>

        <!--Codificacion de los caracteres-->
        <meta charset="utf-8">

        <!--Escala de Mostado-->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!--Link Hoja de Estilos Bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

        <!--Link Hoja de Estios Propia-->
        <link rel="stylesheet" href="../addons/style.css">

    </head>

    <body>

    