<?php
  //Activacion de la sesion
  session_start();

  //Titulo Cabecera
  $_SESSION['title']="Registro Estudiante";

  if(isset($_SESSION['entidades'])){
    $entidades=$_SESSION['entidades'];
  }else{
    header("Location: ../");
  }
  
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

              <form action="../controller/createStudent.php?function=newStudent" method="post">
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
            <img src="../addons/imagenes/registrarse.png" >
          </div>
                
        </div>
     </div>
  </main>  
</body>
 