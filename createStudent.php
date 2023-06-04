<!doctype html>
<html lang="es">
  <head>

    <!--Titulo Header-->
    <title>Proceso de Registro</title>

    <!--Codificacion de los caracteres-->
    <meta charset="utf-8">

    <!--Escala de Mostado-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--Link Hoja de Estilos Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <!--Link Hoja de Estios Propia-->
    <link rel="stylesheet" href="addons/style.css">

    <!--Validar si se ha recibido la informacion de las entidades-->
    <?php
      session_start();

      if(isset($_SESSION['entidades'])){
        $entidades=$_SESSION['entidades'];
      }else{

        //Generar mensaje de Error y redireccionar
        $_SESSION['status']=FALSE;
        $_SESSION['message']="Ha ocurrido un error, intentelo de nuevo mas tarde";

        header("Location: ../gestionMatricula");
      }
    ?>

  </head>

  <body>
    <main>
      <div class="container col-md-12"> 
        <h1>Bienvenid@ !!!</h1> 

            <!--Sistema de Impresion de Mensajes-->
            <?php

              //Validar si hay algun mensaje activo
              if(isset($_SESSION['status']) && isset($_SESSION['message']) && isset($_SESSION['entidades'])){

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

            ?>
          
          <div class="row">
            <div class="col-md-6 text-center">         
              <div class="card">

                <div class="card-header">
                  <h4 class="card-title">Registrate</h4>
                </div>

                <form action="controller/createStudent.php?function=newStudent" method="post">
                  <div class="card-body">

                    <div class="mb-3">
                      <label for="documento" class="form-label">Número de identificación</label>
                      <input type="number"class="form-control" name="documento" id="documento" required>
                    </div>

                    <div class="mb-3">
                      <label for="nombreCompleto" class="form-label">Nombre Completo</label>
                      <input type="text" class="form-control" name="nombreCompleto" id="nombreCompleto" placeholder="Digita tu nombre completo" max="60" required>            
                    </div>

                    <div class="mb-3">
                      <label for="edad" class="form-label">Edad</label>
                      <input type="number" class="form-control" name="edad" id="edad" required>
                    </div>

                    <div class="mb-3">
                      <label for="idEntidad" class="form-label">Selecciona Entidad a la que perteneciste</label>

                      <select class="form-select form-select-lg" name="idEntidad" id="idEntidad">
                        <option selected>Selecciona uno</option>
                        
                        <!--Generacion de Options segun las entidades registradas-->
                        <?php

                          //Transformar cada registro individual de cada entidad en un option
                          foreach($entidades as $entidad){

                            $idEntidad=$entidad[0];
                            $nombreEntidad=$entidad[1];
                            $nombreGrupo=$entidad[2];

                            echo("
                              <option value='$idEntidad'> $nombreEntidad - $nombreGrupo</option>
                            ");
                          }
                        ?>

                      </select>
                    </div>

                    <div class="mb-3">
                      <label for="password" class="form-label">Crear Contraseña</label>
                      <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Asegurate de que sea segura :)" required min="8">

                      <small id="helpId" class="form-text text-muted">Crea una contraseña Minimo de 8 caracteres</small>
                    </div>

                  </div>

                  <div class="card-footer text-muted">             
                    <button type="submit" class="btn btn-primary">Enviar</button>
                  </div>

                </form>
                        
              </div>

            </div>

            <div class="col-md-6">
              <img src="addons/imagenes/registrarse.png" >
            </div>
                  
          </div>
      </div>
    </main>  
  </body>

</html>