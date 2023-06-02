/*Crear Base de Datos*/
CREATE DATABASE dbGestionMatriculas;

/*Usar la Base de Datos*/
USE dbGestionMatriculas;

/*
    Creacion de la tabla entidades con los siguientes campos:

        1. 
            Nombre Campo: idEntidad
            Comentario: Idenificador de la entidad

            Caracteristicas:
            
                1.  int: Campo Entero
                2.  primary Key: Llave Primaria de la tabla
                3.  auto_incremente: El valor de la columna aumentara de uno en uno x cada registro generado
            --

        --

        2. 
            Nombre Campo: nombreEntidad
            Comentario: Nombre de la Entidad

            Caracteristicas:
            
                1. varchar(40): Campo tipo String/Texto con longitud maxima de 40 caracateres

                3. Not Null: Al llenar el registro, este campo no puede estar vacio
            --
            
        --

        3. 
            Nombre Campo: nombreGrupo
            Comentario: Nombre del subgrupo de la entidad

            Caracteristicas:
            
                1. varchar(40): Campo tipo String/Texto con longitud maxima de 40 caracateres

                3. Not Null: Al llenar el registro, este campo no puede estar vacio
            --
            
        --

    --

*/
CREATE TABLE entidades(
    idEntidad int primary key AUTO_INCREMENT COMMENT 'Idenificador de la entidad',
    nombreEntidad varchar(40) NOT NULL COMMENT 'Nombre de la Entidad',
    nombreGrupo varchar(40) NOT NULL COMMENT 'Nombre del subgrupo de la entidad'
);

/*
    Creacion de la tabla estudiantes con los siguentes campos:

        1. 
            Nombre Campo: numDoc 
            Comentario: Numero de Documento del Estudiante

            Caracteristicas:
            
                1.  int: Campo Entero
                2.  primary Key: Llave Primaria de la tabla
                3.  auto_incremente: El valor de la columna aumentara de uno en uno x cada registro generado
            --
        --

        2. 

            Nombre Campo: nombreCompleto
            Comentario: Nombre Completo del Estudiante

            Caracteristicas:

                1. varchar(60): Campo tipo String/Texto con longitud maxima de 60 caracateres

                2. unique: Esto le indica a la tabla que al guardar un nuevo registro, el valor del campo nombreCompleto no puede estar repetido

                3. Not Null: Al llenar el registro, este campo no puede estar vacio

            --

        --

        3. 

            Nombre Campo: password
            Comentario: Contraseña Hasheada del Estudiante

            Caracteristicas:

                1. varchar(255): Campo tipo String/Texto con longitud maxima de 255 caracateres

                2. unique: Esto le indica a la tabla que al guardar un nuevo registro, el valor del campo contraseña no puede estar repetido

                3. Not Null: Al llenar el registro, este campo no puede estar vacio

            --

        --

        4. 

            Nombre Campo: edad
            Comentario: Edad del Estudiante

            Caracteristicas:

                1. int: Campo Entero
                2. Not Null: Al llenar el registro, este campo no puede estar vacio

            --

        --

        5. 

            Nombre Campo: fkIdEntidad
            Comentario: Llave Foranea tabla Entidades

            Caracteristicas:

                1. int: Campo Entero
                2. Not Null: Al llenar el registro, este campo no puede estar vacio

            --

        --

    --

*/
CREATE TABLE estudiantes(
    numDoc int primary key COMMENT 'Numero de Documento del Estudiante',
    nombreCompleto varchar(60) UNIQUE NOT NULL COMMENT 'Nombre Completo del Estudiante',
    password varchar(255) UNIQUE NOT NULL COMMENT 'Contraseña Hasheada del Estudiante',
    edad int NOT NULL COMMENT 'Edad del Estudiante',
    fkIdEntidad int NOT NULL COMMENT 'Llave Foranea tabla Entidades'
);

/*
    Creacion de la llave foranea entre la tabla estudiantes(fkIdEntidad) y la tabla entidades(idEntidad)
*/
ALTER TABLE estudiantes ADD FOREIGN KEY (fkIdEntidad) REFERENCES entidades(idEntidad);

/*
    Creacion de la tabla estudiantes con los siguentes campos:

        1. 
            Nombre Campo: idCurso 
            Comentario: Identificador del Curso

            Caracteristicas:
            
                1.  int: Campo Entero
                2.  primary Key: Llave Primaria de la tabla
                3.  auto_incremente: El valor de la columna aumentara de uno en uno x cada registro generado
            --
        --

        2. 

            Nombre Campo: nombre
            Comentario: Nombre del Curso

            Caracteristicas:

                1. varchar(50): Campo tipo String/Texto con longitud maxima de 50 caracateres

                2. unique: Esto le indica a la tabla que al guardar un nuevo registro, el valor del campo nombreCompleto no puede estar repetido

                3. Not Null: Al llenar el registro, este campo no puede estar vacio

            --

        --

        3. 

            Nombre Campo: fechaInicio
            Comentario: Fecha programada de inicio del curso

            Caracteristicas:

                1. date: Campo tipo fecha (yyyy-mm-ddaa)

                3. Not Null: Al llenar el registro, este campo no puede estar vacio

            --

        --

        4. 

            Nombre Campo: fechaFin
            Comentario: Fecha programada de finalizacion del curso

            Caracteristicas:

                1. date: Campo tipo fecha (yyyy-mm-ddaa)

                3. Not Null: Al llenar el registro, este campo no puede estar vacio

            --

        --

        5. 

            Nombre Campo: precioNeto
            Comentario: Valor base del curso

            Caracteristicas:

                1. int: Campo Entero
                2. Not Null: Al llenar el registro, este campo no puede estar vacio

            --

        --

    --

*/
CREATE TABLE cursos(
    idCurso int primary key AUTO_INCREMENT COMMENT 'Identificador del Curso',
    nombre varchar(50) UNIQUE NOT NULL COMMENT 'Nombre del Curso',
    fechaInicio date NOT NULL COMMENT 'Fecha programada de inicio del curso',
    fechaFin date NOT NULL COMMENT 'Fecha programada de finalizacion del curso',
    precioNeto int NOT NULL COMMENT 'Valor base del curso'
);

/*
    Creacion de la tabla estudiantes con los siguentes campos:

        1. 
            Nombre Campo: idMatricula 
            Comentario: Identificador Matricula

            Caracteristicas:
            
                1.  int: Campo Entero
                2.  primary Key: Llave Primaria de la tabla
                3.  auto_incremente: El valor de la columna aumentara de uno en uno x cada registro generado
            --
        --

        2. 

            Nombre Campo: fkIdCurso
            Comentario: Llave foranea Identificador del Curso

            Caracteristicas:

                1. int: Campo Entero
                3. Not Null: Al llenar el registro, este campo no puede estar vacio

            --

        --

        3. 

            Nombre Campo: subTotal
            Comentario: Valor del Curso antes de aplicar el descuento

            Caracteristicas:

                1. int: Campo Entero
                3. Not Null: Al llenar el registro, este campo no puede estar vacio

            --

        --

        4. 

            Nombre Campo: valorDescuento
            Comentario: Valor del descuento el cual sera descontado del subtotal

            Caracteristicas:

                1. int: Campo Entero

                3. Not Null: Al llenar el registro, este campo no puede estar vacio

            --

        --

        5. 

            Nombre Campo: fechaMatricula
            Comentario: Fecha y Hora de la Matricula 

            Caracteristicas:

                1. datetime: Campo tipo fecha y hora (yyyy-mm-dd hh:mm:ss)

                3. Not Null: Al llenar el registro, este campo no puede estar vacio

            --

        --

    --

*/
CREATE TABLE matriculas(
    idMatricula int primary key AUTO_INCREMENT COMMENT 'Identificador Matricula',
    fkIdCurso int NOT NULL COMMENT 'Llave foranea Identificador del Curso',
    fkIdEstudiante int NOT NULL COMMENT 'Llave foranea Identificador del Estudiante',
    subTotal int NOT NULL COMMENT 'Valor del Curso antes de aplicar el descuento',
    valorDescuento int NOT NULL COMMENT 'Valor del descuento el cual sera descontado del subtotal',
    totalMatricula int NOT NULL COMMENT 'Valor final de la Matricula',
    fechaMatricula datetime NOT NULL COMMENT 'Fecha y Hora de la Matricula'
);