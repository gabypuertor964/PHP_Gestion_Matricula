<?php
  //Activacion de la sesion
  session_start();

  //Titulo Cabecera
  $_SESSION['title']="Detallado Matricula";

  if(isset($_SESSION['cursos']) && isset($_SESSION['descuento'])){
    $cursos=$_SESSION['cursos'];
    $descuento=$_SESSION['descuento'];
  }else{
    header("Location: ../views/");
  }
  
  //Importar el archivo que contiene la cabecera de la pagina
  require("header.php");
?>

<body>
  <main>
    <!--Mostrar Los mensajes-->
    <?php messageAlert();?>
    <h1>Detallado Matricula</h1>
    
      <div class="container text-center" >
         
           <table  class=" col-md-6 table table-bordered table-hover table-striped">
    
            <!--Cabecera Tabla-->
            <tbody>
              <tr>
                <th class="col-md-6">Nombre Curso</th>
                <td class="col-md-6">PHP</td>
              </tr>
              <tr>
                <th >Fecha Inicio</th>
                <td></td>
              </tr>
              <tr>
                <th>Fecha Finalizacion</th>
                <td></td>
              </tr>
              <tr>
                <th>Subtotal</th>
                <td></td>
              </tr>
              <tr>
                <th>Descuento</th>
                <td></td>
              </tr>
              <tr>
                <th>Costo Total</th>
                <td></td>
              </tr>
              <tr>
                <th>Fecha y Hora Inscripcion</th>
                <td></td>
              </tr>
   
            </tbody>
    
          </table>
          <a name="regresar" id="btn-regresar" class="btn btn-primary col-md-12" href="#" role="button">Volver al Inicio</a>
      </div>
    
    
    
  </main>  
</body>
 
<?php
  include("footer.php");
?>