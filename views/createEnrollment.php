<?php
  //Activacion de la sesion
  session_start();

  //Titulo Cabecera
  $_SESSION['title']="Registro Estudiante";

  if(isset($_SESSION['cursos'])){
    $cursos=$_SESSION['cursos'];
  }else{
    header("Location: ../views/");
  }
  
  //Importar el archivo que contiene la cabecera de la pagina
  require("header.php");
?>

<body>
  <main>

    <form action="" method="post">

      <select name="" id="">

        <?php
          
        ?>

      </select>

    </form>

  </main>  
</body>
 