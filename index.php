<!doctype html>
<html lang="es">
  <head>

    <!--Titulo Header-->
    <title>Inicio de Sesion</title>

    <!--Codificacion de los caracteres-->
    <meta charset="utf-8">

    <!--Escala de Mostado-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--Link Hoja de Estilos Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <!--Link Hoja de Estios Propia-->
    <link rel="stylesheet" href="addons/style.css">

  </head>

  <body>
    
    <main>

      <h1>Bienvenido de nuevo!!!</h1>

      <div class="container col-md-12"> 

        <div class="row" id="row_login">

          <div class="col-md-6">
            <img src="addons/imagenes/inicio.png" >
          </div>
  
          <div class="col-md-6 text-center">      

            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Inicia Sesión</h4>
            </div>

            <form action="controller/login.php" method="post">

              <div class="card-body">

                <div class="mb-3">
                  <label for="documento" class="form-label">Número de identificación</label>
                  <input type="number" class="form-control" name="documento" id="documento" required>
                </div>

                <div class="mb-3">
                  <label for="password" class="form-label">Contraseña</label>
                  <input type="password" class="form-control" name="password" id="password"  required min="8">
                </div>

              </div>

              <div class="card-footer text-muted">

                <a name="createuser" id="btnCreateUser" class="createUser btn btn-primary" href="views/createUser.php" role="button">Crear Usuario</a>

                <button type="submit" class="btn_login btn btn-primary">Ingresar</button>

              </div>

            </form>

          </div>

        </div>

      </div>

    </main>

  </body>

</html>
  
