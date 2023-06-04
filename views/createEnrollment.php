<?php
  //Activacion de la sesion
  session_start();

  //Titulo Cabecera
  $_SESSION['title']="Registro Estudiante";

  if(isset($_SESSION['cursos'])){
    $cursos=$_SESSION['cursos'];
  }else{
    header("Location: ../views/");
  }

  var_dump($cursos);
  
  //Importar el archivo que contiene la cabecera de la pagina
  require("header.php");
?>

<body>
  <main>

    <div class="container text-center">

      <h1>Cursos Disponibles</h1>
      
      <table class="table table-bordered table-striped table-light">

        <thead>
          <tr>
            <th>Nombre Curso</th>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
            <th>Costo sin Descuento</th>
            <th>Accion</th>
          </tr>
        </thead>

        <tbody>
          
          <?php
            foreach($cursos as $curso){

              var_dump($curso);
              $idCurso=$curso[0];
              $nombreCurso=$curso[1];
              $fechaInicio=$curso[2];
              $fechaFin=$curso[3];

              echo("
                <tr>
                  <td>$nombreCurso</td>
                  <td>$fechaInicio</td>
                  <td>$fechaFin</td>
                  <td>$fechaFin</td>
                </tr>
              ");
            }

          ?>

        </tbody>

      </table>


    </div>

    


  </main>  
</body>
 