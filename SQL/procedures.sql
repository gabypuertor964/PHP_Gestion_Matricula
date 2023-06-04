/*
    Nombre del Procedimiento: consultarEstudiante
    Argumentos:

        1. num_doc (int): Numero de documento del estudiante 

    --
    Explicacion: Este metodo tiene como fin consultar toda la informacion de un estudiante, segun su numero de documento

    Aplicacion: Este metodo sera usado como parte de la validacion del login, ya que inicialmente se debe consulta si el numero de documento ingresado corresponde a un estudiante ya registrado, en caso de ser asi realizaria las demas validaciones correspondientes

*/
DELIMITER $$
CREATE PROCEDURE studentValidate(IN num_doc int)

BEGIN  
    SELECT 
        password
    FROM estudiantes 
    
    WHERE numDoc=num_doc;
END $$;

/*
    Nombre del Procedimiento: crearEstudiante
    Argumentos:

        1. num_doc (int): Numero de documento del estudiante 
        2. nombre_completo (varchar(60)): Nombre Completo del Estudiante
        3. password (varchar(255)): Contraseña Hasheada del estudiante
        4. edad (int): Edad del estudiante
        5. id_entidad (int): Identificador de la Entidad a la que pertenece el estudiante

    --
    Explicacion: Este metodo tiene como fin realizar el registro de un nuevo estudiante

    Aplicacion: Este metodo sera usado como paso final en el proceso final de registro de un nuevo estudiante

    Advertencias: 
    
        Desde el modelo, se debe validar que:

            1. El nombre del nuevo estudiante no se encuentre ya registrado en la BD

            2. El Id de la Entidad si este registrado en el sistema

        --

    --
*/
DELIMITER $$
CREATE PROCEDURE registrarEstudiante(
    IN num_doc int, 
    IN nombre_completo varchar(60), 
    IN password varchar(255),
    IN edad int, 
    IN id_entidad int
)

BEGIN  

    START TRANSACTION;

        INSERT INTO estudiantes VALUES(num_doc,nombre_completo,password,edad,id_entidad);

    COMMIT;

END $$;

/*
    Nombre del Procedimiento: registrarMatricula
    Argumentos:

        1. id_curso (int): Identificador del curso al cual realiza la inscripcion
        2. id_estudiante (int): Identificador del Estudiante interesado
        3. sub_total (int): Valor del curso antes de realizar el descuento
        4. valor_descuento (int): Valor del descuento
        5. total_matricula (int): Valor final de la matricula
        6. fecha_matricula (datetime): Fecha y hora de la matricula

    --
    Explicacion: Este metodo tiene como fin realizar el registro de una nueva matricula

    Aplicacion: Este metodo sera usado como paso final en el proceso final de registro de una nueva matricula

    Advertencias: 
    
        Desde el modelo, se debe validar que:

            1. El Estudiante no se encuentre con otra matricula activa

            2. El identificador del curso corresponda a un curso ya registrado en el sistema

        --

    --
*/
DELIMITER $$
CREATE PROCEDURE registrarMatricula(
    IN id_curso int, 
    IN id_estudiante int, 
    IN sub_total int, 
    IN valor_descuento int, 
    IN total_matricula int,
    IN fecha_matricula datetime
    
)

BEGIN  

    START TRANSACTION;

        INSERT INTO matriculas VALUES(null,id_curso,id_estudiante,sub_total,valor_descuento,total_matricula,fecha_matricula,1);

    COMMIT;

END $$;

/*
    Nombre del Procedimiento: consultarMatriculas
    Argumentos:

        1. num_doc (int): Numero de documento del estudiante 

    --
    Explicacion: Este metodo tiene como fin consultar el numero de matriculas activas de un estudiante

    Aplicacion: Este metodo sera usado como parte del proceso de creacion de una nueva matricula, ya que inicialmente se debe confirmar que el estudiante actual no se encuntra inscrito en ningun curso

*/
DELIMITER $$
CREATE PROCEDURE consultarMatriculas(IN num_doc int)

BEGIN  
    SELECT

        cursos.nombre,
        cursos.fechaInicio,
        cursos.fechaFin,
        matriculas.total_matricula 

    FROM matriculas 

    LEFT JOIN cursos
    ON cursos.idCurso=fkIdCurso

    LEFT JOIN estudiantes
    ON estudiantes.numDoc=num_doc

    WHERE estado=1;
END $$