<?php


   //variables para establecer la conexion

   $servidorBD = "localhost";
   $usuarioBD = "root";
   $contrasenaBD = "";

   $nombreBD = "dbGestionMatriculas";


   //variable que contiene los datos para la conexion
   $con = new mysqli($servidorBD, $usuarioBD, $usuarioBDusuarioBD, $nombreBD);

   if ($con->connect_errno) {
      echo "Fallo al conectar a MySQL: (" . $con->connect_errno . ") " . $con->connect_error;
  }
  
  //echo $con->host_info . "\n";

  $numero_documento=1019604622;
  var_dump($con->query("CALL consultarEstudiante($numero_documento)"));

  
class matriculas{

   private $documento;
   private $contraseña;
   private $datos;

   private  $bd;


   public function __construct($servidorBD,$usuarioBD,$contrasenaBD,$nombreBD)
   {


       $this -> bd = new mysqli($servidorBD,$usuarioBD,$contrasenaBD,$nombreBD);

       $this->documento = "12345";
       $this -> contraseña = "";

       $this->datos = array();

       }
       


 
   
       # code...
   
   public function VerificarDatos($documento, $contraseña)
   {


      
      //$this -> bd -> query("CALL consultarEstudiante($documento)");
      $query = "CALL consultarEstudiante($documento)";

// Ejecutar la consulta
$stmt = $this->bd ->query($query);

// Obtener los resultados del procedimiento almacenado
$results = $stmt->fetch_all(PDO::FETCH_ASSOC);


   foreach ($results as $row) {
      foreach ($row as $key => $value) {
         if($row === 1 || $row ===2){
            $datos[1] = $value;
            $datos[2] = $value;
            
          echo $datos[1];
          echo $datos[2];
         }


         
      }
      echo "<br>";
  }



// Cerrar la conexión
$conn = null;
   }
   
}

$matriculas = new matriculas($servidorBD, $usuarioBD, $usuarioBDusuarioBD, $nombreBD);
$matriculas -> VerificarDatos(1024481368,1234);

?>