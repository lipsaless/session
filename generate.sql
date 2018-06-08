CREATE DATABASE login;

use login;

CREATE TABLE usuario (
id int primary key auto_increment,
nome varchar(255),
email varchar(255),
senha varchar(255)
);

CREATE TABLE mensagem (
id int primary key auto_increment,
nome LONGTEXT,
assunto LONGTEXT,
mensagem LONGTEXT
);

INSERT INTO usuario (nome,email, senha) VALUES ('Felipe','filipesales19@gmail.com', 'lipsaless');
INSERT INTO usuario (nome,email, senha) VALUES ('Administrador','adm@gmail.com', 'adm');