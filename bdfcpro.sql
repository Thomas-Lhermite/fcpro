DROP DATABASE IF EXISTS BDFCPRO ;

CREATE DATABASE BDFCPRO ;

USE BDFCPRO ;

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
