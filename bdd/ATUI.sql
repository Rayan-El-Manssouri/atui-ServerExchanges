CREATE DATABASE atui;

USE atui;

CREATE TABLE utilisateur(
    IdUtilisateur INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    email VARCHAR(20),
    password VARCHAR(20)
)