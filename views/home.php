<?php
  //Activacion de la sesion
  session_start();

  //Envio del titulo la pagina, a traves de la variable de sesion
  $_SESSION['title']="Dashboard";

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

    <!--Impresion de Mensajes de unico uso-->
    <?php messageAlert();?>
    
    <?php

      if($data_courses<>null){

        $nombreCurso=$data_courses['nombreCurso'];
        $fechaFin=$data_courses['fechaFin'];
        $fechaInicio=$data_courses['fechaInicio'];

        echo("
          <div class='card'>
            <div class='card-header'>
              <h4 class='card-title'>$nombreCurso</h4>  
            </div>
            <div class='card-body'>
              
              <table class='table table-striped '>
                <tbody>
                  <tr>
                    <th>Fecha de Finalizacion:</th>
                    <td>$fechaFin</td>
                 </tr>

                  <tr>
                    <th>Fecha de Inicio:</th>
                    <td>$fechaInicio</td>
                  </tr>

                </tbody>
              </table>
            </div>

            <div class='card-footer text-muted'>
              <a name='' class='btn btn-danger col-md-12' href='../controller/logOut.php' role='button' style='font-size:23px;'>Cerrar Sesion</a>
            </div>

          </div>
        ");

      }else{
        echo("
          <a name='' id='' class='btn btn-primary btn-lg col-md-12' href='../controller/createEnrollment.php?function=viewEnrollment' role='button'>Deseo Matricularme en un curso</a>
        ");
      }

    ?>

  </div>
  
</main>

<?php
  include("footer.php");
?>
