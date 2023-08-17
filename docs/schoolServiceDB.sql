-- DROP DATABASE IF EXISTS schoolServiceDB;
CREATE DATABASE IF NOT EXISTS schoolServiceDB;
SET foreign_key_checks = 0;
-- USE schoolServiceDB;

CREATE TABLE IF NOT EXISTS usuarios(idUsuario INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
nombres VARCHAR(99) NOT NULL,
apellidoP VARCHAR(50) NOT NULL,
apellidoM VARCHAR(50) NOT NULL,
rfc VARCHAR(50) NOT NULL UNIQUE,
correo VARCHAR(99) NOT NULL UNIQUE,
pass VARCHAR(99) NOT NULL,
carrera VARCHAR(50) NOT NULL,
horas INT NOT NULL DEFAULT 0,
tipo TINYINT(1) NOT NULL DEFAULT 1

)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS actividades(idActividad INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
titulo VARCHAR(99) NOT NULL,
descripcion VARCHAR(255) NOT NULL,
organizacion VARCHAR(99) NOT NULL,
horasActividad INT NOT NULL,
vacantes INT NOT NULL,
horaInicio TIME NOT NULL,
fecha DATE NOT NULL,
lugar VARCHAR(255) NOT NULL,
estado TINYINT(1) NOT NULL  DEFAULT 1

)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS usuarioActividad(idUsuarioActividad INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
evidencia VARCHAR(255) NULL,
estado TINYINT(1) NOT NULL  DEFAULT 1,

idUsuario INT NOT NULL,
idActividad INT NOT NULL,

FOREIGN KEY (idUsuario) REFERENCES usuarios(idUsuario),
FOREIGN KEY (idActividad) REFERENCES actividades(idActividad),

UNIQUE(idUsuario,idActividad)

)ENGINE=InnoDB;


