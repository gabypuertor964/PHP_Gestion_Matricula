<?php
  //Activacion de la sesion
  session_start();

  /*
    Se enviara a traves al archivo header, la sigueinte informacion a traves de la variable SESSION:

      1. Titulo de la Cabecera de la Pagina
      2. Prefijo de ruta -> Este indicara, que tanto se debe afectar la ruta a los archivos de estilo, de acuerdo a la ubicacion de la vista

  */
  $_SESSION['title']="Inicio de Sesion";
  $_SESSION['prefix']=null;

  //Importar el archivo que contiene la cabecera de la pagina
  require("views/header.php");
?>


  <header>
    <!-- place navbar here -->
  </header>
  <main>
    <h1>Bienvenido de nuevo!!!</h1>
   <div class="container text-center ">
     
        <div class="card col-md-6">
            <div class="card-header">
              <h4 class="card-title">Inicia Sesión</h4>
            </div>
            <form action="controller/login.php" method="post">
                <div class="card-body">
                   <div class="mb-3">
                     <label for="num_id" class="form-label">Numero de identificación</label>
                     <input type="number"class="form-control" name="num_id" id="num_id" aria-describedby="helpId" placeholder="">
                   </div>
                   <div class="mb-3">
                     <label for="" class="form-label">Contraseña</label>
                     <input type="password"
                       class="form-control" name="contrasena" id="contrasena" aria-describedby="helpId" placeholder="">
                   </div>
                </div>
                <div class="card-footer text-muted">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                    <a name="" id="" class="btn btn-primary" href="archivo" role="button">Button</a>
                </div>
            </form>
        </div>

   </div>
  </main>
  <footer>
    <!-- place footer here -->
  </footer>
 

  
