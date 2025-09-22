CREATE DATABASE IF NOT EXISTS moduleconnexion
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE moduleconnexion;

CREATE TABLE IF NOT EXISTS utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    nom VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO utilisateurs (login, prenom, nom, password)
VALUES ('admin', 'admin', 'admin', '$2y$10$k9Mf/4D0oN2K9hV8J1mBOeUNyGf1g/1KzBRzjIo8UbX0sS3bkXtFa');
