-- En database/schema.sql
CREATE TABLE Peliculas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descripcion TEXT,
    imagen_url VARCHAR(255),
    genero VARCHAR(255)
);

CREATE TABLE Series (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descripcion TEXT,
    imagen_url VARCHAR(255),
    genero VARCHAR(255)
);

CREATE TABLE Usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    avatar_url VARCHAR(255),
    bio TEXT
);

CREATE TABLE Comentarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    pelicula_id INT,
    serie_id INT,
    contenido TEXT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(id),
    FOREIGN KEY (pelicula_id) REFERENCES Peliculas(id),
    FOREIGN KEY (serie_id) REFERENCES Series(id)
);

CREATE TABLE Valoraciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    pelicula_id INT,
    serie_id INT,
    puntuacion INT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(id),
    FOREIGN KEY (pelicula_id) REFERENCES Peliculas(id),
    FOREIGN KEY (serie_id) REFERENCES Series(id)
);

CREATE TABLE Mensajes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    remitente_id INT,
    destinatario_id INT,
    contenido TEXT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (remitente_id) REFERENCES Usuarios(id),
    FOREIGN KEY (destinatario_id) REFERENCES Usuarios(id)
);