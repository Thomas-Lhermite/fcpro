/*DROP DATABASE IF EXISTS BDFCPRO ;*/

/*CREATE DATABASE BDFCPRO ;*/

/*USE BDFCPRO ;*/

USE `n-d-l-p-fcpro_bd`;
Drop TABLE IF EXISTS users (
    id  INT   NOT NULL   PRIMARY KEY   AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    date datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE users
(	id 		INT			NOT NULL   PRIMARY KEY   AUTO_INCREMENT,
	username		CHAR( 30 )	NOT NULL , 
    password		CHAR( 64 )	NOT NULL ,
	permissions		CHAR( 2 )	NOT NULL

) ENGINE = InnoDB CHARACTER SET latin1 COLLATE latin1_bin;

INSERT INTO users
(	username,
	password,
	permissions
)
VALUES
	( 'superadmin',	'186cf774c97b60a1c106ef718d10970a6a06e06bef89553d9ae65d938a886eae', '**'),
	( 'admin',	'8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '*');


CREATE TABLE formations (
    id 		INT			NOT NULL   PRIMARY KEY   AUTO_INCREMENT,
	title	CHAR( 100 )	NOT NULL , 
    description    TEXT    	NOT NULL ,
    content        TEXT     NOT NULL,
    date_start     DATE     NOT NULL,
    date_end       DATE     NOT NULL,
    file    CHAR( 100 ) NOT NULL
) ENGINE = InnoDB CHARACTER SET latin1 COLLATE latin1_bin;

CREATE TABLE formateurs (
    id 		INT			NOT NULL   PRIMARY KEY   AUTO_INCREMENT,
	nom 	CHAR( 20 )	NOT NULL , 
) ENGINE = InnoDB CHARACTER SET latin1 COLLATE latin1_bin;


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS upload (
    id  INT   NOT NULL   PRIMARY KEY   AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    date datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;