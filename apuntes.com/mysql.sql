create database daw2;
use daw2;


CREATE TABLE asignaturas (
    id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE temas (
    id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    asignatura_id INT NOT NULL,
    FOREIGN KEY (asignatura_id) REFERENCES asignaturas(id),
    PRIMARY KEY (id)
);

CREATE TABLE apuntes (
    id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    apunte longtext null,
    tema_id INT NOT NULL,
    FOREIGN KEY (tema_id) REFERENCES temas(id),
    PRIMARY KEY (id)
);

ALTER TABLE apuntes
ADD COLUMN fecha datetime DEFAULT CURRENT_TIMESTAMP;

INSERT INTO temas (nombre, asignatura_id) VALUES
  ('Tema 1', 1),
  ('Tema 2', 1),
  ('Tema 3', 1),
  ('Tema 4', 1),
  ('Tema 5', 1),
  ('Tema 6', 1),
  ('Tema 7', 1),
  ('Tema 8', 1),
  ('Tema 9', 1),
  ('Tema 10', 1),
  ('Tema 11', 1),
  ('Tema 12', 1);

INSERT INTO temas (nombre, asignatura_id) VALUES
  ('Tema 1', 2),
  ('Tema 2', 2),
  ('Tema 3', 2),
  ('Tema 4', 2),
  ('Tema 5', 2),
  ('Tema 6', 2),
  ('Tema 7', 2),
  ('Tema 8', 2),
  ('Tema 9', 2),
  ('Tema 10', 2),
  ('Tema 11', 2),
  ('Tema 12', 2);
INSERT INTO temas (nombre, asignatura_id) VALUES
  ('Tema 1', 3),
  ('Tema 2', 3),
  ('Tema 3', 3),
  ('Tema 4', 3),
  ('Tema 5', 3),
  ('Tema 6', 3),
  ('Tema 7', 3),
  ('Tema 8', 3),
  ('Tema 9', 3),
  ('Tema 10', 3),
  ('Tema 11', 3),
  ('Tema 12', 3);
INSERT INTO temas (nombre, asignatura_id) VALUES
  ('Tema 1', 4),
  ('Tema 2', 4),
  ('Tema 3', 4),
  ('Tema 4', 4),
  ('Tema 5', 4),
  ('Tema 6', 4),
  ('Tema 7', 4),
  ('Tema 8', 4),
  ('Tema 9', 4),
  ('Tema 10', 4),
  ('Tema 11', 4),
  ('Tema 12', 4);
  INSERT INTO temas (nombre, asignatura_id) VALUES
  ('Tema 1', 5),
  ('Tema 2', 5),
  ('Tema 3', 5),
  ('Tema 4', 5),
  ('Tema 5', 5),
  ('Tema 6', 5),
  ('Tema 7', 5),
  ('Tema 8', 5),
  ('Tema 9', 5),
  ('Tema 10', 5),
  ('Tema 11', 5),
  ('Tema 12', 5);

INSERT INTO temas (nombre, asignatura_id) VALUES
  ('Tema 1', 6),
  ('Tema 2', 6),
  ('Tema 3', 6),
  ('Tema 4', 6),
  ('Tema 5', 6),
  ('Tema 6', 6),
  ('Tema 7', 6),
  ('Tema 8', 6),
  ('Tema 9', 6),
  ('Tema 10', 6),
  ('Tema 11', 6),
  ('Tema 12', 6);


