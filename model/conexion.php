<?php

   class dbMatriculas{

      private $documento;
      private $contraseña;
      private $datos;

      private  $db_conection;

      /*
         Nombre Funcion: __construct
         Argumentos:

            1. host: Direccion del host del SGBD
            2. user: Nombre del Usuario de Coneccion
            3. password: Contraseña del Usuario de Coneccion 
            4. database: Nombre de la Base de Datos a Conectar

         --

         Explicacion: Esta funcion tiene como fin generar la coneccion a la BD, segun la informacion de coneccion que le ingresemos al momento de su instanciamiento
      */
      public function __construct($host,$user,$password,$database){

         //Guardar la coneccion a la BD en el Atributo "db_conection", de la clase
         $this -> db_conection = new mysqli($host,$user,$password,$database);

      }
         

      public function login($documento,$contraseña){

         //Declaracion de arreglo el cual contendra la informacion de la validacion
         $data_return=[];

         //Guardado de la informacion del usuario en forma de arreglo asociativo
         $data_user= $this -> db_conection -> query("CALL consultarEstudiante($documento)")->fetch_assoc();

         $this->db_conection->next_result();

         /*
            Explicacion: Para que la validacion sea exitosa, se debe encontrar tanto la informacion del estudiante, como comprobar que la contraseña ingresada en el login, corresponda con su contraseña registrada, en caso de cumplir ambas condiciones, realizara la busqueda de sus cursos activos (De existir).

            En caso de que las validaciones, fallen, el sistema debera retornar el mesanje de error correspondiente
         */
         if($data_user<>NULL && password_verify($contraseña,$data_user['password'])){

            //Indicar que la validacion fue exitosa
            $data_return['status']=TRUE;

            //Guardado del mensaje de que la validacion fue exitosa
            $data_return['message']="Has iniciado Sesion con exito";

            //Guardado de la informacion del usuario
            $data_return['data_user']=$data_user;
                     
            //Guardar en forma de Arreglo Asociativo, la informa de los cursos activos del estudiante
            $data_courses = $this -> db_conection -> query("CALL consultarMatriculas($documento)")->fetch_assoc();

            //Guardado de la informacion de los cursos activos del estudiante
            $data_return['data_courses']=$data_courses;

         }else{
            
            //Indicar que la validacion fue fallida
            $data_return['status']=FALSE;

            /*
               Explicacion: En caso de que la variable "data_user" este vacia, significa que no encontra la informacion de un estudiante el cual coincidiera con ese numero de documento, por lo tanto debera generar un mensaje de error correspondiente a dicho error.

               En caso, de que la informacion si haya sido encontraad, significa que lo que fallo, fue la validacion de contraseña, por lo cual, debera generar su respectivo mensaje de error
            */
            if($data_user==NULL){
               $data_return['message']="No se encontro ningun estudiante con el numero de documento $documento";
            }else{
               $data_return['message']="Contraseña Incorrecta";
            }

         }

         //Retornado de los datos de la validacion
         return $data_return;

      }

   }

   $datos=new dbMatriculas("localhost","root","","dbgestionmatriculas");
   var_dump($datos->login(1019604622,12345789));


?>