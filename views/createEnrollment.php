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

 
  
  //Importar el archivo que contiene la cabecera de la pagina
  require("header.php");
?>

<body>
  <main>

    <div class="container text-center">

      <h1>Cursos Disponibles</h1>
      <div class="card text-black">
       
        <br>
        <p>😊 Asegurate de Matricularte al curso que mas se ajuste a tus horarios 😉</p>
        <div class="card-body">
          
            <table class="table table-bordered table-hover table-striped ">

                <thead>
                  <tr>
                    <th>Nombre Curso</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Valor Total </th>
                    <th>Acción</th>
                  </tr>
                </thead>

                <tbody>

                    <tr>
                      <td>Python</td>
                      <td>2023-12-12</td>
                      <td>2023-06-29</td>
                      <td>20000</td>                   
                      <td>
                        <input class="btn-matricula" type="button" value="Matricularme">
                     </td>
                    </tr>

                    <tr>
                      <td>PHP</td>
                      <td>2023-06-23</td>
                      <td>2023-06-30</td>
                      <td>250000</td>
                      <td>
                        <input class="btn-matricula"  type="button" value="Matricularme">
                     </td>
                    </tr>

                    <tr>
                      <td>JS</td>
                      <td>2023-06-29</td>
                      <td>2023-07-20</td>
                      <td>300000</td>
                      <td>
                        <input  class="btn-matricula" type="button" value="Matricularme">
                     </td>
                    </tr>


                    <tr>
                      <td>Css</td>
                      <td>2023-06-30</td>
                      <td>2023-07-20</td>
                      <td>79800</td>
                      <td>
                        <input class="btn-matricula" type="button" value="Matricularme">
                     </td>
                    </tr>


                    <tr>
                      <td>Java</td>
                      <td>2023-07-01</td>
                      <td>2023-07-23</td>
                      <td>130000</td>
                      <td>
                        <input class="btn-matricula" type="button" value="Matricularme">
                     </td>
                    </tr>

                </tbody>

            </table>



        </div>
      </div>
      
      
    </div>

    


  </main>  
</body>
 