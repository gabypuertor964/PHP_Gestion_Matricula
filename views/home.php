<?php
  //Activacion de la sesion
  session_start();

  /*
    Se enviara a traves al archivo header, la sigueinte informacion a traves de la variable SESSION:

      1. Titulo de la Cabecera de la Pagina

  */
  $_SESSION['title']="Dashboard";

  //Importar el archivo que contiene la cabecera de la pagina
  require("header.php");
?>

<header>
    <!-- place navbar here -->
  </header>
  <body>
    
    <main>
      
      <div class="container col-md-12"> 

        <h1>Tus cursos </h1> 
        <div class="row">
              <div class="col-md-6  text-center ">         
                  <div class="card ">
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
                              <input type="text" class="form-control" name="nombres" id="nombres"  placeholder="Digita tu nombre completo">
                              
                            </div>
                            <div class="mb-3">
                              <label for="apellidos" class="form-label">Apellidos</label>
                              <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Digita tus Apellidos Completos">
                            </div>
                            <div class="mb-3">
                              <label for="edad" class="form-label">Edad</label>
                              <input type="number"
                                class="form-control" name="edad" id="edad">
                            </div>
                            <div class="mb-3">
                              <label for="" class="form-label">Crear Contraseña</label>
                              <input type="password"
                                class="form-control" name="contrasena" id="contrasena" aria-describedby="helpId" placeholder="Asegurate de que sea segura :)">
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

  <footer>
    <!-- place footer here -->
  </footer>
 