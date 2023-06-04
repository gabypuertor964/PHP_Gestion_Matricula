<?php
  //Activacion de la sesion
  session_start();

  //Titulo Cabecera
  $_SESSION['title']="Detallado Matricula";

  //Validar la existencia de la informacion a usar
  if(
    isset($_SESSION['nombreCurso']) &&
    isset($_SESSION['fechaInicio']) &&
    isset($_SESSION['fechaFin']) &&
    isset($_SESSION['precioNeto']) &&
    isset($_SESSION['descuento']) &&
    isset($_SESSION['valorTotal']) &&
    isset($_SESSION['fechaMatricula'])
  ){   
    $nombreCurso=$_SESSION['nombreCurso'];
    $fechaInicio=$_SESSION['fechaInicio'];
    $fechaFin=$_SESSION['fechaFin'];
    $precioNeto=$_SESSION['precioNeto'];
    $descuento=$_SESSION['descuento'];
    $valorTotal=$_SESSION['valorTotal'];
    $fechaMatricula=$_SESSION['fechaMatricula'];
  }else{
    header("Location: ../controller/dashboard.php");
  }
  
  //Importar el archivo que contiene la cabecera de la pagina
  require("header.php");
?>


<body>
  <main>

    <h1>Detallado Matricula</h1>

        <!--Mostrar Los mensajes-->
        <?php messageAlert();?>
    
        <div class="container text-center" >
         
            <table class=" col-md-6 table table-bordered table-hover table-striped">
        
                <!--Cuerpo Tabla-->
                <tbody>
                    <tr>
                        <th class="col-md-6">Nombre Curso</th>
                        <td class="col-md-6"><?php echo($nombreCurso)?></td>
                    </tr>
                    <tr>
                        <th >Fecha Inicio</th>
                        <td><?php echo($fechaInicio)?></td>
                    </tr>
                    <tr>
                        <th>Fecha Finalizacion</th>
                        <td><?php echo($fechaFin)?></td>
                    </tr>
                    <tr>
                        <th>Subtotal</th>
                        <td><?php echo($precioNeto)?></td>
                    </tr>
                    <tr>
                        <th>Descuento</th>
                        <td><?php echo($descuento)?></td>
                    </tr>
                    <tr>
                        <th>Costo Total</th>
                        <td><?php echo($valorTotal)?></td>
                    </tr>
                    <tr>
                        <th>Fecha y Hora Inscripcion</th>
                        <td><?php echo($fechaMatricula)?></td>
                    </tr>
    
                </tbody>
        
            </table>

            <a name="regresar" id="btn-regresar" class="btn btn-primary col-md-12" href="../controller/dashboard.php" role="button">Volver al Inicio</a> 

        </div>
  </main>  
</body>
 
<?php
  include("footer.php");
?>