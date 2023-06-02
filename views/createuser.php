<header>
    <!-- place navbar here -->
  </header>
  <body>
    
    <main>
      <h1>Bienvenid@ !!!</h1>
      <div class="container col-md-12"> 
        <div class="row">
              <div class="col-md-6">
                <img src="addons/imagenes/inicio.png" >
              </div>
  
              <div class="col-md-6  text-center ">         
                  <div class="card ">
                      <div class="card-header">
                        <h4 class="card-title">Inicia Sesión</h4>
                      </div>
                      <form action="controller/login.php" method="post">
                          <div class="card-body">
                            <div class="mb-3">
                              <label for="num_id" class="form-label">Número de identificación</label>
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
                          </div>
                      </form>
                  </div>
                </div>
        </div>
     </div>
    </main>
  
  </body>

  <footer>
    <!-- place footer here -->
  </footer>
 