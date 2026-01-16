INSERT INTO UTENTE (username, password_hash, nome, cognome, numero_telefono, ruolo) VALUES
('mario.rossi', 1, 'Mario', 'Rossi', '3331234567', 'USER'),
('luca.bianchi', 2, 'Luca', 'Bianchi', '3339876543', 'USER'),
('admin.webtech', 3, 'Admin', 'WebTech', '3330001111', 'ADMIN');

INSERT INTO TIPO_NOTIFICA (id, tipologia) VALUES
(1, 'NUOVO_LIKE_A_POST'),
(2, 'NUOVA_ISCRIZIONE_A_POST'),
(3, 'NUOVO_COMMENTO_A_POST');

INSERT INTO CATEGORIA (id, nome_categoria) VALUES
(1, 'festa'),
(2, 'studio'),
(3, 'sport');

INSERT INTO POST (id, foto, titolo, descrizione, data_ora, posti_disponibili, provincia, comune, indirizzo, id_categoria, id_creatore) VALUES
(1, 'img_prova.jpeg', 'Festa universitaria', 'grande festa yuhhuuu', '2026-01-20 21:00:00', 50, 'Milano', 'Milano', 'Via Roma 10', 1, 1),
(2, 'img_prova.jpeg', 'Gruppo studio', 'grande studio nooooo', '2026-01-18 14:30:00', 20, 'Torino', 'Torino', 'Corso Vittorio 25', 2, 2),
(3, 'img_prova.jpeg', 'Partita di beach volley', 'grande partita yuuhhuuuu', '2026-01-31 10:00:00', 15, 'Roma', 'Roma', 'Piazza Navona 5', 3, 2);

INSERT INTO ISCRIZIONE_POST (id_post, id_iscritto) VALUES
(2, 1);

INSERT INTO COMMENTO (id, testo, id_utente, id_post) VALUES
(1, "Bellissimo evento, evvai!!!", 1, 2)

INSERT INTO LIKE_POST (id_post, id_utente) VALUES
(2, 1)