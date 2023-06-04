<?php
    require("../addons/functions/validations.php");
    require("../model/conexion.php");

    $dbConection = new dbMatriculas();

    //Funcion encargada de calcular el descuento a realizar segun la entidad, el grupo y la edad del estudiante
    function calcularDescuento($entidad,$grupo,$edad){
        $descuento=0;

        //Descuento por IES
        if($entidad=="SENA"){
            $descuento+=35;

            //Descuento por Subgrupo
            if($grupo=="ADSO"){
                $descuento+=15;
            }
        }else{
            $descuento+=25;
        }

        //Descuento por edad
        if($edad>=16 OR $edad<20){
            $descuento+=15;
        }elseif($edad>=20 OR $edad<=25){
            $descuento+=10;
        }

        return $descuento/100;
    }

    //Validar si se envio la variable 'function' a traves del metodo $_GET
    type_validation([[$_GET['function'],"all"]],"../");

    //Realizar ciertas acciones segun la variable 'function', validad anteriormente
    switch($_GET['function']){

        case "viewEnrollment":

            //Activacion de la sesion
            session_start();

            //Obtener las entidades registradas y guardarlas en una variable de sesion
            $cursos = $dbConection->consultarCursos();

            //Transformacion de Json a Object
            $cookie_session=json_decode($_COOKIE['data_session']);

            //Validacion de integridad de datos relevantes
            type_validation(
                [
                    [$cookie_session->data_student->numDoc,"numeric"],
                    [$cookie_session->data_student->nombreEntidad,"string"],
                    [$cookie_session->data_student->nombreGrupo,"string"],
                    [$cookie_session->data_student->edad,"numeric"]
                ],
                "../"
            );

            $_SESSION['cursos']=$cursos;


            $_SESSION['descuento']=calcularDescuento($cookie_session->data_student->nombreEntidad,$cookie_session->data_student->nombreGrupo,$cookie_session->data_student->edad);

            var_dump($_SESSION['descuento']);

            //Redirigir a la vista correspondiente
            redireccion_rapida("../views/createEnrollment.php");

        break;

        case "newEnrollment":

            //Validacion de existencia de la informacion requerida
            type_validation([[$_GET['idCurso'],'all']],"../views/");

            //Activacion de la sesion
            session_start();

            //Consultar la Informacion del curso
            $infoCurso=$dbConection->validarCurso($_GET['idCurso']);

            //Validar si durante la conulta anterior pudo encontrar la informacion del curso segun el Identificador ingresado 
            if($infoCurso==NULL){
                $_SESSION['status']=FALSE;
                $_SESSION['message']="Error, Curso no registrado en el sistema";

                redireccion_rapida("../views/createEnrollment.php");
            }

            //Transformacion de Json a Object
            $cookie_session=json_decode($_COOKIE['data_session']);

            //Validacion de integridad de datos relevantes
            type_validation(
                [
                    [$cookie_session->data_student->numDoc,"numeric"],
                    [$cookie_session->data_student->nombreEntidad,"string"],
                    [$cookie_session->data_student->nombreGrupo,"string"],
                    [$cookie_session->data_student->edad,"numeric"]
                ],
                "../"
            );

            $porcentajeDescuento = calcularDescuento($cookie_session->data_student->nombreEntidad,$cookie_session->data_student->nombreGrupo,$cookie_session->data_student->edad);

            $valorDescuento=$infoCurso['precioNeto']-($infoCurso['precioNeto']*$porcentajeDescuento);

            $valorTotal=$infoCurso['precioNeto']-$valorDescuento;

            //Generacion de la fecha y hora actual
            $fechaMatricula=date("Y-m-d H:i:s");

            $_SESSION['curso']=NULL;

            if(
                $dbConection->registrarMatricula(
                    $_GET['idCurso'],$cookie_session->data_student->numDoc,
                    $infoCurso['precioNeto'],
                    $valorDescuento,
                    $valorTotal,
                    $fechaMatricula
                )
            ){
                

                $_SESSION['status']=TRUE;
                $_SESSION['message']="Se ha Matriculado Exitosamente";

                $_SESSION['nombreCurso']=$infoCurso['nombre'];
                $_SESSION['fechaInicio']=$infoCurso['fechaInicio'];
                $_SESSION['fechaFin']=$infoCurso['fechaFin'];
                $_SESSION['precioNeto']=$infoCurso['precioNeto'];
                $_SESSION['descuento']=$valorDescuento;
                $_SESSION['valorTotal']=$valorTotal;
                $_SESSION['fechaMatricula']=$fechaMatricula;

                redireccion_rapida("../views/detailedEnrollment.php");
            }else{
                $_SESSION['status']=FALSE;
                $_SESSION['message']="Ha Ocurrido un Error, intentelo Nuevamente";

                redireccion_rapida("../views");
            }

            
        break;  

        default:
            redireccion_rapida("../");
        break;
    }
?>