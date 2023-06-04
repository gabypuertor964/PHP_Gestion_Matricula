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
            password,
            numDoc
        FROM estudiantes 
        
        WHERE numDoc=num_doc;
    END $$;
--

--Definicion: Procedimiento encargado de consultar aquellos cursos los cuales no hayan comenzado
    DELIMITER $$
    CREATE PROCEDURE consultarCursos()

    BEGIN  
        SELECT 
            * 
        FROM cursos

        WHERE fechaInicio>NOW();

    END $$;

--

--Definicion: Procedimiento encargado de realizar el registro de una nueva matricula
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
    END $$
--