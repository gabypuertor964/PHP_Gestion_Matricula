<?php
  //Activacion de la sesion
  session_start();

  //Titulo Cabecera
  $_SESSION['title']="Registro Estudiante";
  $entidades=$_SESSION['entidades'];

  //Importar el archivo que contiene la cabecera de la pagina
  require("header.php");
?>

<body>
  <main>
    <div class="container col-md-12"> 
      <h1>Bienvenid@ !!!</h1> 
        
        <div class="row">
          <div class="col-md-6 text-center">         
            <div class="card">

              <div class="card-header">
                <h4 class="card-title">Registrate</h4>
              </div>

              <form action="controller/login.php" method="post">
                <div class="card-body">

                  <div class="mb-3">
                    <label for="num_id" class="form-label">Número de identificación</label>
                    <input type="number"class="form-control" name="num_id" id="num_id">
                  </div>

                  <div class="mb-3">
                    <label for="nombres" class="form-label">Nombres</label>
                    <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Digita tu nombre completo">            
                  </div>

                  <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Digita tus Apellidos Completos">
                  </div>

                  <div class="mb-3">
                    <label for="edad" class="form-label">Edad</label>
                    <input type="number" class="form-control" name="edad" id="edad">
                  </div>

                  <div class="mb-3">
                    <label for="" class="form-label">Selecciona Entidad a la que perteneciste</label>

                    <select class="form-select form-select-lg" name="" id="">
                      <option selected>Selecciona uno</option>
                      
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
                    <label for="" class="form-label">Crear Contraseña</label>
                    <input type="password" class="form-control" name="contrasena" id="contrasena" aria-describedby="helpId" placeholder="Asegurate de que sea segura :)">
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
            <img src="../addons/imagenes/registrarse.png" >
          </div>
                
        </div>
     </div>
  </main>  
</body>
 