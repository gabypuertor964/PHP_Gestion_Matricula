<?php

    /*
        En caso de que la variable de sesion este vacia, es decir, si alguien intenta acceder de forma directa al archivo header, el sistema lo redigira al login
    */
    if(session_status()==PHP_SESSION_NONE){
        if(isset($_COOKIE['user_data'])){
            header("Location: ../");
        }else{
            header("Location: home.php");
        }
    }
?>

<!doctype html>
<html lang="es">
    <head>

        <!--Titulo Header-->
        <title><?php echo($_SESSION['title'])?></title>

        <!--Codificacion de los caracteres-->
        <meta charset="utf-8">

        <!--Escala de Mostado-->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!--Link Hoja de Estilos Bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

        <!--Link Hoja de Estios Propia-->
        <link rel="stylesheet" href="<?php echo($_SESSION['prefix'])?>addons/style.css">

    </head>

    <body>