CREATE DATABASE IF NOT EXISTS WebTechProject;
USE WebTechProject;

-- TABELLA CATEGORIA
CREATE TABLE CATEGORIA (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_categoria VARCHAR(100) NOT NULL UNIQUE
);

-- TABELLA UTENTE
CREATE TABLE UTENTE (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    nome VARCHAR(50),
    cognome VARCHAR(50),
    numero_telefono VARCHAR(20),
    ruolo ENUM('USER', 'ADMIN') NOT NULL DEFAULT 'USER'
);

-- TABELLA POST
CREATE TABLE POST (
    id INT AUTO_INCREMENT PRIMARY KEY,
    foto VARCHAR(255),
    titolo VARCHAR(100) NOT NULL,
    descrizione TEXT,
    data_ora DATETIME NOT NULL,
    posti_disponibili INT NOT NULL,
    provincia VARCHAR(50) NOT NULL,
    comune VARCHAR(50) NOT NULL,
    indirizzo VARCHAR(255) NOT NULL,
    id_categoria INT NOT NULL,
    id_creatore INT NOT NULL,
    FOREIGN KEY (id_categoria) REFERENCES CATEGORIA(id),
    FOREIGN KEY (id_creatore) REFERENCES UTENTE(id)
);


-- TABELLA COMMENTO
CREATE TABLE COMMENTO (
    id INT AUTO_INCREMENT PRIMARY KEY,
    testo TEXT NOT NULL,
    id_utente INT NOT NULL,
    id_post INT NOT NULL,
    FOREIGN KEY (id_utente) REFERENCES UTENTE(id),
    FOREIGN KEY (id_post) REFERENCES POST(id)
);

-- TABELLA ISCRIZIONE_POST
CREATE TABLE ISCRIZIONE_POST (
    id_post INT NOT NULL,
    id_iscritto INT NOT NULL,
    PRIMARY KEY (id_post, id_iscritto),
    FOREIGN KEY (id_post) REFERENCES POST(id),
    FOREIGN KEY (id_iscritto) REFERENCES UTENTE(id)
);

-- TABELLA LIKE_POST
CREATE TABLE LIKE_POST (
    id_post INT NOT NULL,
    id_utente INT NOT NULL,
    PRIMARY KEY (id_post, id_utente),
    FOREIGN KEY (id_post) REFERENCES POST(id),
    FOREIGN KEY (id_utente) REFERENCES UTENTE(id)
);

-- TABELLA FOLLOW
CREATE TABLE FOLLOW (
    id_follower INT NOT NULL,
    id_followed INT NOT NULL,
    PRIMARY KEY (id_follower, id_followed),
    FOREIGN KEY (id_follower) REFERENCES UTENTE(id),
    FOREIGN KEY (id_followed) REFERENCES UTENTE(id)
);

-- TABELLA TIPO_NOTIFICA
CREATE TABLE TIPO_NOTIFICA (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipologia VARCHAR(50) NOT NULL UNIQUE
);

-- TABELLA NOTIFICA
CREATE TABLE NOTIFICA (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_tipo_notifica INT NOT NULL,
    id_destinatario INT NOT NULL,
    data_ora DATETIME NOT NULL,
    id_mittente INT,
    id_post INT,
    letto BOOLEAN NOT NULL DEFAULT FALSE,
    FOREIGN KEY (id_tipo_notifica) REFERENCES TIPO_NOTIFICA(id),
    FOREIGN KEY (id_destinatario) REFERENCES UTENTE(id),
    FOREIGN KEY (id_mittente) REFERENCES UTENTE(id),
    FOREIGN KEY (id_post) REFERENCES POST(id)
);