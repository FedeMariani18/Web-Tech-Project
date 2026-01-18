INSERT INTO UTENTE (username, mail, password_hash, nome, cognome, numero_telefono, foto, ruolo) VALUES
('mario.rossi', 'mario.rossi@email.it', '1', 'Mario', 'Rossi', '3331234567', 'user_696b6c7242a7f.png', 'USER'),
('luca.bianchi', 'luca.bianchi@email.it', '2', 'Luca', 'Bianchi', '3339876543', 'user_696b6c7242a7f.png', 'USER'),
('admin.webtech', 'admin@webtech.it', '3', 'Admin', 'WebTech', '3330001111', 'user_696b6c7242a7f.png', 'ADMIN'),
('federiani', 'federico.mariani@gmail.com', '$2y$10$g810aQvWGpjXNb55I0.gi.kXLqll2ofI2UdG4RPlkjs9nkib0o5qa', 'Federico', 'Mariani', '3384308412', 'user_696d2f99e8452.png', 'ADMIN');

INSERT INTO TIPO_NOTIFICA (id, tipologia) VALUES
(1, 'NUOVO_LIKE_A_POST'),
(2, 'NUOVA_ISCRIZIONE_A_POST'),
(3, 'NUOVO_COMMENTO_A_POST');

INSERT INTO CATEGORIA (id, nome_categoria) VALUES
(1, 'festa'),
(2, 'studio'),
(3, 'sport');

INSERT INTO POST (id, titolo, descrizione, data_ora, posti_disponibili, indirizzo, citta, comune, provincia, id_categoria, foto, id_creatore) VALUES
(1, 'Festa universitaria', 'grande festa yuhhuuu', '2026-02-3 21:00:00', 50, 'Via ciccia 546', 'Milano', 'Milano', 'Milano', 1, 'img_prova.jpeg', 1),
(2, 'Gruppo studio', 'grande studio nooooo', '2026-02-20 14:30:00', 20, 'Via Floppy 123', 'Torino', 'Torino', 'Torino', 2, 'img_prova.jpeg', 2),
(3, 'Partita di beach volley', 'grande partita yuuhhuuuu', '2026-01-31 10:00:00', 15, 'Via Business 798', 'Roma', 'Roma', 'Roma', 3, 'img_prova.jpeg', 2);

INSERT INTO ISCRIZIONE_POST (id_post, id_iscritto) VALUES
(2, 1);

INSERT INTO COMMENTO (id, testo, id_utente, id_post) VALUES
(1, "Bellissimo evento, evvai!!!", 1, 2);

INSERT INTO LIKE_POST (id_post, id_utente) VALUES
(2, 1);

INSERT INTO NOTIFICA (id, id_tipo_notifica, id_destinatario, data_ora, id_mittente, id_post, letto) 
VALUES (1, 2, 2, '2026-01-20 21:00:00', 1, 2, 0);
