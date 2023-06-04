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
      
      //Funcion encargada de realizar el proceso de validacion de login
      public function login($documento,$contraseña){
         //Declaracion de arreglo el cual contendra la informacion de la validacion
         $data_return=[];

         //Guardado de la contraseña del estudiante en una variable
         $password_student= $this -> db_conection -> query("CALL validarLogin($documento)")->fetch_assoc()['password'];

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

      //Metodo encargado de emplear el metodo el cual consulta la informacion de las entidades
      public function consultarEntidades(){
         return $this -> db_conection ->query("CALL consultarEntidades()")->fetch_all();
      }

      //Metodo encargado de emplear el procedimiento el cual valida si el Identificador ingresado corresponde a alguna entidad ya registrada
      public function validarEntidades($id_entidad){

         $this->db_conection->next_result();

         return $this -> db_conection ->query("CALL validarEntidad($id_entidad)")->fetch_assoc();
      }

      //Metodo encargado de emplear el procedimiento el cual valida si el numero de documento corresponde a algun estudiante ya registrado
      public function validarEstudiante($num_doc,$nombre_completo){

         //Arreglo contenedor de las validaciones
         $validations=[];

         //En caso de no esta registrado el nombre, el metodo retornara nulo ya que no encontro la informacion
         $validarNombre = $this->db_conection->query("CALL validarNombre('$nombre_completo')")->fetch_assoc();

         //Guardar el valor de la validacion segun la informacion recuperada en la consulta
         if($validarNombre<>NULL){
            $validations['nombre']=FALSE;
         }else{
            $validations['nombre']=TRUE;
         }

         //Permitir multi-query
         $this->db_conection->next_result();

         //En caso de no esta registrado el documento, el metodo retornara nulo ya que no encontro la informacion
         $validarDocumento=$this -> db_conection ->query("CALL validarDocumento($num_doc)")->fetch_assoc();

         //Guardar el valor de la validacion segun la informacion recuperada en la consulta
         if($validarDocumento<>NULL){
            $validations['documento']=FALSE;
         }else{
            $validations['documento']=TRUE;
         }

         //Retornar valor Validaciones
         return $validations;

      }

      //Metodo encargado de emplear el procedimiento el cual registra un nuevo estudiante
      public function registrarEstudiante($num_doc,$nombre_completo,$password,$edad,$id_entidad){

         $this->db_conection->next_result();

         //Generacion de Hash de contraseña y Transformacion del nombre a Mayusculas
         $password_hash = password_hash($password,PASSWORD_DEFAULT);
         $nombre_completo=strtoupper($nombre_completo);

         return $this -> db_conection ->query("CALL registrarEstudiante($num_doc,'$nombre_completo','$password_hash',$edad,$id_entidad)");

      }

      //Metodo encargado de emplear el procedimiento el cual consulta todos los cuales aun no han comenzado
      public function consultarCursos(){
         $this->db_conection->next_result();

         return $this->db_conection->query("CALL consultarCursos()")->fetch_assoc();
      }

      //Metodo encargado de emplear el prodecimiento el cual registra una nueva matricula
      public function registrarMatricula($id_curso,$id_estudiante,$sub_total,$valor_descuento,$total_matricula){
         $this->db_conection->next_result();

         //Generacion de la fecha y hora actual
         $fecha_matricula=date("Y-m-d H:i:s");

         return $this->db_conection->query("CALL registrarMatricula($id_curso,$id_estudiante,$sub_total,$valor_descuento,$total_matricula,$fecha_matricula)");
      }

   }
?>