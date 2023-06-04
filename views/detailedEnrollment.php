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

    <h1>Cursos Disponibles</h1>

    <!--Mostrar Los mensajes-->
    <?php messageAlert();?>

    
  </main>  
</body>
 
<?php
  include("footer.php");
?>