CREATE DATABASE atui;

USE atui;

CREATE TABLE utilisateur(
    IdUtilisateur INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    email VARCHAR(255),
    password VARCHAR(255)
)