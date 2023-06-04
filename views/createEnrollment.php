<?php
  //Activacion de la sesion
  session_start();

  //Titulo Cabecera
  $_SESSION['title']="Registro Estudiante";

  if(isset($_SESSION['cursos']) && isset($_SESSION['descuento'])){
    $cursos=$_SESSION['cursos'];
    $descuento=$_SESSION['descuento'];
  }else{
    header("Location: ../controller/dashboard.php");
  }
  
  //Importar el archivo que contiene la cabecera de la pagina
  require("header.php");
?>

<body>
  <main>

    <div class="container text-center">

      <h1>Cursos Disponibles</h1>

      <!--Mostrar Los mensajes-->
      <?php messageAlert();?>

      <br> 
      <h3>😊Asegurate de Matricularte al curso que mas se ajuste a tus horarios😉</h3>
      <br>

      <table class="table table-bordered table-hover table-striped">

        <!--Cabecera Tabla-->
        <thead>
          <tr>
            <th>Nombre Curso</th>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
            <th>Valor Total</th>
            <th>Acción</th>
          </tr>
        </thead>

        <!--Cuerpo Tabla-->
        <tbody>
          <?php
            foreach($cursos as $curso){

              $idCurso=$curso[0];
              $nombreCurso=$curso[1];
              $fechaInicio=$curso[2];
              $fechaFin=$curso[3];

              $costoTotal=$curso[4]*$descuento;

              echo("
                <tr>
                  <td>$nombreCurso</td>
                  <td>$fechaInicio</td>
                  <td>$fechaFin</td>
                  <td>$costoTotal</td>
                  <td>
                    <form action='../controller/createEnrollment.php?function=newEnrollment&idCurso=$idCurso' method='POST'>

                      <button type='submit' class='btn-matricula btn-primary col-md-12 '>Matricularme</button>
                      
                    </form>
                  </td>
                </tr>
              ");
            }

          ?> 
        </tbody>

      </table>
    </div>
  </main>  
</body>
 
<?php
  include("footer.php");
?>