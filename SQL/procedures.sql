

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

--Definicion: Procedimiento encargado de consultar las matriculas activas del estudiante segun su numero de documento

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

--

--Definicion: Procedimiento encargado de consultar el listado de entidades registradas

    DELIMITER $$
    CREATE PROCEDURE consultarEntidades()
    BEGIN  

        SELECT
            *
        FROM entidades

    END $$

--

--Definicion: Procedimiento encargado de consultar el numero de entidades segun su identificador

    DELIMITER $$
    CREATE PROCEDURE validarEntidad(IN id_entidad int)
    BEGIN
        SELECT
            count(idEntidad)
        FROM entidades

        WHERE idEntidad=id_entidad;
    
    END $$

--

--Definicion: Procedimiento encargado de consultar la existencia del estudiantes segun su numero de Documento

    DELIMITER $$
    CREATE PROCEDURE validarDocumento(IN num_doc int)
    BEGIN
        SELECT
            numDoc
        FROM estudiantes

        WHERE numDoc=num_doc;
    
    END $$

--

--Definicion: Procedimiento encargado de consultar la existencia del estudiantes segun su nombre Completo

    DELIMITER $$
    CREATE PROCEDURE validarNombre(IN test varchar(60))
    BEGIN
        SELECT
            nombreCompleto
        FROM estudiantes

        WHERE nombreCompleto=test;
    
    END $$

--

--Definicion: Procedimiento encargado del registro de un Nuevo estudiante

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
    
--

--Definicion: Procedimiento encargado de validar la informacion ingresada en el Login
DELIMITER $$
CREATE PROCEDURE validarLogin(IN num_doc int)

BEGIN  
    SELECT 
        password
    FROM estudiantes 
    
    WHERE numDoc=num_doc;
END $$;
--