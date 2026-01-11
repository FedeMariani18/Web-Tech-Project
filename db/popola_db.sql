INSERT INTO UTENTE (username, password_hash, nome, cognome, numero_telefono, ruolo) VALUES
('mario.rossi', 2, 'Mario', 'Rossi', '3331234567', 'USER'),
('luca.bianchi', 3, 'Luca', 'Bianchi', '3339876543', 'USER'),
('admin.webtech', 4, 'Admin', 'WebTech', '3330001111', 'ADMIN');

INSERT INTO TIPO_NOTIFICA (tipologia) VALUES
('FOLLOW'),
('LIKE'),
('POST_IN_SCADENZA'),
('NUOVA_ISCRIZIONE_A_POST'),
('NUOVO_MESSAGGIO');

INSERT INTO CATEGORIA (nome_categoria) VALUES
('festa'),
('studio'),
('sport');

INSERT INTO POST (foto, data_ora, posti_disponibili, provincia, comune, indirizzo, id_categoria, id_creatore) VALUES
('festa1.jpg', '2026-01-20 21:00:00', 50, 'Milano', 'Milano', 'Via Roma 10', 4, 2),
('studio1.jpg', '2026-01-18 14:30:00', 20, 'Torino', 'Torino', 'Corso Vittorio 25', 5, 2),
('sport1.jpg', '2026-01-15 10:00:00', 15, 'Roma', 'Roma', 'Piazza Navona 5', 6, 3);