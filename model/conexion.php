<?php

   class dbMatriculas{

      private  $db_conection;

      /*
         Nombre Funcion: __construct
         Argumentos:

            1. host: Direccion del host del SGBD
            2. user: Nombre del Usuario de Coneccion
            3. password: Contraseña del Usuario de Coneccion 
            4. database: Nombre de la Base de Datos a Conectar

         --

         Explicacion: Esta funcion tiene como fin generar la coneccion a la BD.

         Tip: Se le definen unos valores por defecto, sin embargo, estos pueden ser modificados al momento de su instanciamiento
      */
      public function __construct($host="localhost",$user="root",$password="",$database="dbgestionmatriculas"){


         //Guardar la coneccion a la BD en el Atributo "db_conection", de la clase
         $this -> db_conection = new mysqli($host,$user,$password,$database);

      }
      
     public function login($documento,$contraseña){

         //Declaracion de arreglo el cual contendra la informacion de la validacion
         $data_return=[];

         //Guardado de la contraseña del estudiante en una variable
         $password_student= $this -> db_conection -> query("CALL studentValidate($documento)")->fetch_assoc()['password'];

         //Permitir realizar una nueva consulta sobre la coneccion actual
         $this->db_conection->next_result();

         /*
            Explicacion: Para que la validacion sea exitosa, se debe encontrar tanto la informacion del estudiante, como comprobar que la contraseña ingresada en el login, corresponda con su contraseña registrada en la BD, en caso de cumplir ambas condiciones, realizara la busqueda de sus cursos activos (De existir).

            En caso de que alguna de las validaciones fallen, el sistema debera retornar el mesanje de error correspondiente
         */
         if($password_student<>NULL && password_verify($contraseña,$password_student)){

            //Indicar que la validacion fue exitosa
            $data_return['status']=TRUE;

            //Guardado del mensaje de que la validacion fue exitosa
            $data_return['message']="Has iniciado Sesion con exito";

            //Guardado de la informacion de los cursos activos del estudiante en forma de arreglo asociativo
            $data_return['data_courses']=$this -> db_conection -> query("CALL consultarMatriculas($documento)")->fetch_assoc();

         }else{
            
            //Indicar que la validacion fue fallida
            $data_return['status']=FALSE;

            /*
               Explicacion: En caso de que la variable "data_user" este vacia, significa que no encontra la informacion de un estudiante el cual coincidiera con ese numero de documento, por lo tanto debera generar un mensaje de error correspondiente a dicho error.

               En caso, de que la informacion si haya sido encontraad, significa que lo que fallo, fue la validacion de contraseña, por lo cual, debera generar su respectivo mensaje de error
            */
            if($password_student==NULL){
               $data_return['message']="No se encontro ningun estudiante con el numero de documento $documento";
            }else{
               $data_return['message']="Contraseña Incorrecta";
            }

         }

         //Retornado de los datos de la validacion
         return $data_return;

      }

   }
?>