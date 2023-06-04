<?php
  //Activacion de la sesion
  session_start();

  //Envio del titulo la pagina, a traves de la variable de sesion
  $_SESSION['title']="Dashboard";

  //Valisdar si esta definida la cookie
  if(isset($_COOKIE['data_courses'])){
    //Guardado de la informacion de los cursos
    $data_courses=json_decode($_COOKIE['data_courses']);
  }else{
    header("Location: ../");
  }

  //Importar el archivo que contiene la cabecera de la pagina
  require("header.php");
?>

<header>
  <?php

    //Validar si la variable de sesion "status" esta definida
    if(isset($_SESSION['status'])){
      
      //Guardar el mensaje 
      $message=$_SESSION['message'];

      //Mostrar el mensaje en forma de Alert Bootstrap
      echo("
        <div class='alert alert-success' role='alert'>
          $message
        </div>
      ");

      //Borrar la valiable de sesion "status"
      $_SESSION['status']=null;
    }

  ?>
</header>

<main>

  <div class="container text-center">

    <h1>Tus cursos</h1>

    <?php
  
      if($data_courses<>null){

        echo("

          <div class='card'>
            <div class='card-header'>
              <h4 class='card-title'>$data_courses->nombreCurso</h4>  
            </div>
            <div class='card-body'>
              
              <table class='table table-striped table-light'>
                <tbody>
                
                  <tr>
                    <th>Fecha de Inicio:</th>
                    <td>$data_courses->fechaInicio</td>
                  </tr>

                  <tr>
                    <th>Fecha de Finalizacion:</th>
                    <td>$data_courses->fechaFin</td>
                  </tr>

                </tbody>

              </table>

            </div>

            <div class='card-footer text-muted'>

              <a name='' id='btnCreateUser' class='btn_login btn btn-danger col-md-12' href='../controller/logOut.php' role='button'>Cerrar Sesion</a>

            </div>

          </div>
        ");

      }else{
        echo("
          <a name='' id='' class='btn btn-primary btn-lg col-md-12' href='views/matricular.php' role='button'>Deseo Matricularme en un curso</a>
        ");
      }

    ?>

  </div>
  
</main>
