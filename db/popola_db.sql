INSERT INTO UTENTE (id, username, password_hash, nome, cognome, numero_telefono, mail, foto, ruolo, bannato) VALUES
(1, 'federiani', '$2y$10$6n05D.ZIau7a4e6qVslwLu418KPoTa2IP0nVQB5L/MIqC2Seu0oPa', 'Federico', 'Mariani', '3384308484', 'federico@gmail.com', 'user_696e5c296423e.png', 'ADMIN', 0),
(2, 'mario.rossi', '$2y$10$qgVX/exy5N4iQH48YOhVyOHRMo6f54OhVHEouKjmn33zGnIqxps.W', 'Mario', 'Rossi', '3384308888', 'mario@gmail.com', 'user_696e5bc831c73.png', 'USER', 0),
(3, 'ilCIle', '$2y$10$MU1zOKtNSy9I6POF4QnmtOENrhypGqyS93quH96cSPMHD7MMOHrdm', 'Alan', 'Barzanti', '3384308888', 'alan@gmail.com', 'user_696e5be14d27a.png', 'USER', 0),
(4, 'gian', '$2y$10$V3tkAqBF5lGgMhufhZQ/B.9PQnSOUxWZKbRw6j09thdFsYrtboSOm', 'Gianmarco', 'Bianchi', '3384308484', 'gian@gmail.com', 'user_696e5c01aafb0.png', 'USER', 0),
(5, 'marcomonda', '$2y$10$di6kM9zQxxKHd/Vhjahz0OoydGXo6lzH1uIjCq7m1aBaJTGOlj8.C', 'Marco', 'Mondardini', '3384308888', 'marco@gmail.com', 'user_696e5c296423e.png', 'USER', 0),
(6, 'samuello', '$2y$10$WwQ8.saNsRdBzrCx9U15hOrLcHVW5Pjrb9CiAxUYpTFUvhOOVWMwC', 'Samuele', 'Rossi', '3384308888', 'samuele@gmail.com', 'user_696e5c296423e.png', 'USER', 0),
(7, 'francy', '$2y$10$wChuU7NEsytw4Fdjdp7n4Oc2eKOctSqx6noITUG6.SKpFur2CqRA6', 'Francesco', 'Casanova', '123445678909', 'fra@gmail.com', 'user_696e5c5fe461f.png', 'USER', 0),
(8, 'boscos', '$2y$10$SFzuF9PU1k/x7nMqwCv.buTT94YPp.PDykaxHubSbwQZfR4BY7jMy', 'Manuel', 'Boschetti', '123445678909', 'basco@gmail.com', 'user_696e5c7c10a1e.png', 'USER', 0),
(9, 'the_monster', '$2y$10$Jw/j2g8Ei.nxvHemjh8FN.b6mkdgQpVfQJw7eKq9Ew.iZzYvwCHTW', 'Luca', 'Neri', '123445678909', 'luca@gmail.com', 'user_696e5cb2d08c6.png', 'USER', 0),
(10, 'caparezza', '$2y$10$/DaaBWpnt9YsSIk83gdJXeEri1mFPkNVLntCBRbzLTxSKUjPwWV9C', 'Michele', 'Torini', '338338338', 'capa@gmail.com', 'user_696e5cd9c7072.png', 'USER', 0),
(11, 'saraxpro', '$2y$10$CJmJxWNXqUyfJz3oqnbqF.fMT0qI4p34B34puS33y0So/nkUht2XS', 'Sara', 'Grigi', '3384308888', 'sara@gmail.com', 'user_696e5d06bf0ea.png', 'USER', 0),
(12, 'george', '$2y$10$eNk0VTsW6PqNuSYarsQlx.7oNRL0TV6OOJA.DpEY9uE15u3oCP5XC', 'Giorgia', 'Molari', '123445678909', 'giorgia@gmail.com', 'user_696e5d2a6bba2.png', 'USER', 0);

INSERT INTO CATEGORIA (id, nome_categoria) VALUES
(1, 'festa'),
(2, 'studio'),
(3, 'sport');

INSERT INTO TIPO_NOTIFICA (id, tipologia) VALUES
(1, 'NUOVO_LIKE_A_POST'),
(2, 'NUOVA_ISCRIZIONE_A_POST'),
(3, 'NUOVO_COMMENTO_A_POST'),
(4, 'POST_ELIMINATO'),
(5, 'UTENTE_DISISCRITTO_DA_TUO_POST');

INSERT INTO POST
(id, titolo, descrizione, data_ora, posti_disponibili, indirizzo, citta, comune, provincia, id_categoria, foto, id_creatore)
VALUES
-- FESTE (1)
(1, 'Festa matricole università',
 'Festa dedicata alle matricole per conoscersi, socializzare e iniziare la vita universitaria con musica, drink economici e un ambiente accogliente e informale.',
 '2026-02-01 21:30:00', 50, 'Via Università 5', 'Roma', 'Roma', 'RM', 1, 'festa_matricole.jpg', 1),

(2, 'Aperitivo universitario',
 'Aperitivo tra studenti di diverse facoltà per rilassarsi dopo le lezioni, scambiare due chiacchiere e creare nuove amicizie in un locale vicino al campus.',
 '2026-02-03 19:00:00', 30, 'Via dei Giovani 18', 'Milano', 'Milano', 'MI', 1, 'aperitivo.png', 4),

(3, 'Festa in casa post-esami',
 'Serata informale organizzata da studenti dopo la sessione, con musica, giochi e voglia di divertirsi dopo settimane intense di studio.',
 '2026-02-06 22:00:00', 25, 'Via Leopardi 22', 'Torino', 'Torino', 'TO', 1, 'post_esami.jpg', 7),

(4, 'Karaoke night studenti',
 'Serata karaoke aperta a tutti gli universitari, ideale per divertirsi, cantare senza giudizio e passare del tempo insieme fuori dalle aule.',
 '2026-02-10 21:00:00', 40, 'Via Centrale 9', 'Padova', 'Padova', 'PD', 1, 'karaoke.jpg', 10),

(5, 'Party Erasmus',
 'Festa internazionale con studenti Erasmus e italiani, musica da tutto il mondo e ottima occasione per praticare lingue e conoscere nuove culture.',
 '2026-02-14 22:30:00', 60, 'Via Europa 3', 'Bologna', 'Bologna', 'BO', 1, 'erasmus_party.png', 12),

-- STUDIO (2)
(6, 'Studio di gruppo Analisi 1',
 'Gruppo di studio per studenti del primo anno, utile per chiarire dubbi, svolgere esercizi e prepararsi insieme all’esame di analisi matematica.',
 '2026-02-02 15:00:00', 6, 'Biblioteca Centrale', 'Pisa', 'Pisa', 'PI', 2, 'analisi1.jpg', 2),

(7, 'Ripasso Economia Aziendale',
 'Incontro di studio collaborativo per ripassare concetti chiave di economia aziendale, confrontarsi sugli appunti e prepararsi all’esame scritto.',
 '2026-02-04 16:00:00', 8, 'Aula Studio Sud', 'Napoli', 'Napoli', 'NA', 2, 'economia.png', 3),

(8, 'Preparazione esame Diritto',
 'Sessione di studio focalizzata sugli argomenti principali di diritto, con confronto tra studenti e spiegazioni reciproche degli istituti giuridici.',
 '2026-02-07 14:00:00', 7, 'Biblioteca Giuridica', 'Roma', 'Roma', 'RM', 2, 'diritto.jpg', 5),

(9, 'Gruppo studio Informatica',
 'Incontro tra studenti di informatica per ripassare algoritmi, strutture dati e prepararsi agli esami condividendo esercizi e soluzioni.',
 '2026-02-09 15:30:00', 10, 'Aula Studio Tech', 'Milano', 'Milano', 'MI', 2, 'informatica.png', 8),

(10, 'Studio tesi triennale',
 'Incontro tra laureandi per confrontarsi sulla stesura della tesi, organizzare il lavoro e scambiarsi consigli utili su fonti e metodologia.',
 '2026-02-12 17:00:00', 5, 'Biblioteca Umanistica', 'Firenze', 'Firenze', 'FI', 2, 'tesi.jpg', 11),

(11, 'Ripasso Fisica generale',
 'Sessione di studio per studenti di ingegneria e scienze, concentrata su esercizi e teoria di fisica generale in vista dell’esame.',
 '2026-02-15 15:00:00', 9, 'Aula Studio Ingegneria', 'Trento', 'Trento', 'TN', 2, 'fisica.png', 6),

-- SPORT (3)
(12, 'Calcetto universitario',
 'Partita di calcetto tra studenti universitari di livello amatoriale, ideale per fare sport, divertirsi e conoscere nuove persone.',
 '2026-02-03 18:30:00', 10, 'Centro Sportivo Uni', 'Roma', 'Roma', 'RM', 3, 'calcetto.jpg', 4),

(13, 'Pallavolo mista',
 'Allenamento e partita amichevole di pallavolo mista aperta a studenti di tutte le facoltà, senza necessità di esperienza.',
 '2026-02-05 19:00:00', 12, 'Palestra Universitaria', 'Bologna', 'Bologna', 'BO', 3, 'pallavolo.png', 9),

(14, 'Corsa al parco',
 'Allenamento di corsa leggera al parco per studenti universitari, adatto a tutti i livelli e perfetto per scaricare lo stress.',
 '2026-02-08 17:30:00', 15, 'Parco Cittadino', 'Firenze', 'Firenze', 'FI', 3, 'corsa.jpg', 1),

(15, 'Allenamento palestra',
 'Sessione di allenamento in palestra tra studenti per motivarsi a vicenda e mantenersi in forma durante il periodo universitario.',
 '2026-02-11 18:00:00', 6, 'Palestra Campus', 'Milano', 'Milano', 'MI', 3, 'palestra.png', 7),

(16, 'Basket tra studenti',
 'Partita amichevole di basket tra universitari, ideale per divertirsi, fare movimento e socializzare fuori dalle lezioni.',
 '2026-02-13 20:00:00', 10, 'Campo Basket Uni', 'Torino', 'Torino', 'TO', 3, 'basket.jpg', 10),

(17, 'Yoga per studenti',
 'Lezione di yoga rilassante dedicata agli studenti universitari, perfetta per migliorare concentrazione e benessere fisico.',
 '2026-02-16 17:00:00', 12, 'Sala Polifunzionale', 'Padova', 'Padova', 'PD', 3, 'yoga.png', 12),

(18, 'Evento specializzato networking',
 'Evento dedicato al networking tra studenti e professionisti, con tavoli tematici e opportunità di conoscere persone del settore.',
 '2026-02-18 18:30:00', 50, 'Centro Conferenze', 'Milano', 'Milano', 'MI', 1, 'networking.jpg', 5);

INSERT INTO COMMENTO (testo, id_utente, id_post) VALUES
-- POST 1
('Ottima idea per iniziare l università', 3, 1),
('Perfetto per conoscere nuove persone', 7, 1),
('Evento ideale per le matricole', 10, 1),

-- POST 2
('Aperitivo rilassante dopo le lezioni', 2, 2),
('Locale comodo vicino al campus', 6, 2),
('Ottima occasione per socializzare', 11, 2),

-- POST 3
('Finalmente una festa post esami', 4, 3),
('Serata semplice ma divertente', 9, 3),
('Perfetta per staccare dallo studio', 1, 3),

-- POST 4
('Karaoke sempre una bella idea', 8, 4),
('Serata diversa dal solito', 12, 4),
('Ottimo per divertirsi insieme', 5, 4),

-- POST 5
('Bellissima atmosfera internazionale', 6, 5),
('Ottimo evento per studenti Erasmus', 2, 5),
('Perfetto per fare nuove amicizie', 9, 5),

-- POST 6
('Gruppo studio molto utile', 1, 6),
('Perfetto per chiarire i dubbi', 7, 6),
('Analisi diventa più semplice insieme', 11, 6),

-- POST 7
('Ripasso fatto molto bene', 3, 7),
('Utile per prepararsi all esame', 10, 7),
('Ottimo confronto tra studenti', 6, 7),

-- POST 8
('Argomenti spiegati in modo chiaro', 4, 8),
('Diritto sembra meno complicato', 12, 8),
('Ottima iniziativa per lo studio', 8, 8),

-- POST 9
('Informatica studiata meglio in gruppo', 5, 9),
('Esercizi spiegati molto bene', 2, 9),
('Ambiente collaborativo e utile', 11, 9),

-- POST 10
('Confronto utile per la tesi', 9, 10),
('Ottimi consigli sulla stesura', 3, 10),
('Incontro molto produttivo', 7, 10),

-- POST 11
('Fisica più semplice insieme', 6, 11),
('Esercizi spiegati passo passo', 1, 11),
('Sessione di studio efficace', 10, 11),

-- POST 12
('Calcetto perfetto dopo le lezioni', 8, 12),
('Partita divertente e rilassante', 4, 12),
('Ottimo modo per fare sport', 12, 12),

-- POST 13
('Pallavolo mista molto inclusiva', 2, 13),
('Ambiente amichevole e sportivo', 9, 13),
('Allenamento leggero ma divertente', 6, 13),

-- POST 14
('Corsa ideale per scaricare stress', 11, 14),
('Adatta a tutti i livelli', 5, 14),
('Ottima iniziativa per studenti', 3, 14),

-- POST 15
('Allenarsi insieme motiva molto', 7, 15),
('Palestra comoda e ben attrezzata', 1, 15),
('Sessione utile e ben organizzata', 10, 15),

-- POST 16
('Basket sempre una buona idea', 4, 16),
('Partita divertente tra studenti', 8, 16),
('Bel modo di socializzare', 12, 16),

-- POST 17
('Yoga perfetto per rilassarsi', 6, 17),
('Aiuta concentrazione e benessere', 2, 17),
('Lezione molto piacevole', 9, 17),

-- POST 18
('Evento ben organizzato', 3, 18),
('Contenuti interessanti e utili', 11, 18),
('Partecipazione consigliata', 7, 18);

INSERT INTO ISCRIZIONE_POST (id_post, id_iscritto) VALUES
-- POST 1
(1, 1), (1, 2), (1, 3), (1, 4), (1, 5), (1, 6),
-- POST 2
(2, 3), (2, 5), (2, 6), (2, 1), (2, 8),
-- POST 3
(3, 2), (3, 7), (3, 8), (3, 9), (3, 4),
-- POST 4
(4, 1), (4, 4), (4, 10), (4, 6), (4, 7),
-- POST 5
(5, 6), (5, 7), (5, 11), (5, 12), (5, 2),
-- POST 6
(6, 2), (6, 3), (6, 8), (6, 9),
-- POST 7
(7, 4), (7, 5), (7, 6), (7, 1),
-- POST 8
(8, 1), (8, 7), (8, 10),
-- POST 9
(9, 8), (9, 9), (9, 10), (9, 2),
-- POST 10
(10, 3), (10, 11), (10, 4),
-- POST 11
(11, 2), (11, 6), (11, 12),
-- POST 12
(12, 1), (12, 4), (12, 5), (12, 7),
-- POST 13
(13, 6), (13, 8),
-- POST 14
(14, 9), (14, 10), (14, 11),
-- POST 15
(15, 3), (15, 4),
-- POST 16
(16, 5), (16, 6), (16, 12),
-- POST 17
(17, 2), (17, 8),
-- POST 18
(18, 1), (18, 9);


INSERT INTO LIKE_POST (id_post, id_utente) VALUES
-- POST 1
(1,1), (1,2), (1,3), (1,4), (1,5),
-- POST 2
(2,1), (2,3), (2,6), (2,8),
-- POST 3
(3,2), (3,4), (3,7), (3,9), (3,10),
-- POST 4
(4,1), (4,6), (4,7), (4,10),
-- POST 5
(5,2), (5,6), (5,7), (5,11), (5,12),
-- POST 6
(6,1), (6,2), (6,3),
-- POST 7
(7,4), (7,5), (7,6), (7,7),
-- POST 8
(8,1), (8,7), (8,10),
-- POST 9
(9,2), (9,8), (9,9), (9,10),
-- POST 10
(10,3), (10,4), (10,11),
-- POST 11
(11,2), (11,6), (11,12),
-- POST 12
(12,1), (12,4), (12,5), (12,7), (12,8),
-- POST 13
(13,6), (13,8),
-- POST 14
(14,9), (14,10), (14,11),
-- POST 15
(15,3), (15,4),
-- POST 16
(16,5), (16,6), (16,12),
-- POST 17
(17,2), (17,8),
-- POST 18
(18,1), (18,9), (18,10);

INSERT INTO NOTIFICA
(id_tipo_notifica, id_destinatario, data_ora, id_mittente, id_post, letto)
VALUES
-- LIKE (1)
(1, 1, '2026-02-01 10:00:00', 2, 1, FALSE),
(1, 3, '2026-02-01 10:05:00', 4, 2, FALSE),
(1, 5, '2026-02-01 10:10:00', 6, 3, TRUE),
(1, 7, '2026-02-01 10:15:00', 8, 4, FALSE),
(1, 9, '2026-02-01 10:20:00', 10, 5, TRUE),
(1, 11, '2026-02-01 10:25:00', 12, 6, FALSE),
(1, 2, '2026-02-01 10:30:00', 1, 7, FALSE),
(1, 4, '2026-02-01 10:35:00', 3, 8, TRUE),
(1, 6, '2026-02-01 10:40:00', 5, 9, FALSE),
(1, 8, '2026-02-01 10:45:00', 7, 10, TRUE),
(1, 10, '2026-02-01 10:50:00', 9, 11, FALSE),
(1, 12, '2026-02-01 10:55:00', 11, 12, TRUE),

-- PARTECIPAZIONE (2)
(2, 1, '2026-02-02 11:00:00', 3, 2, FALSE),
(2, 2, '2026-02-02 11:05:00', 4, 3, FALSE),
(2, 3, '2026-02-02 11:10:00', 5, 4, TRUE),
(2, 4, '2026-02-02 11:15:00', 6, 5, FALSE),
(2, 5, '2026-02-02 11:20:00', 7, 6, TRUE),
(2, 6, '2026-02-02 11:25:00', 8, 7, FALSE),
(2, 7, '2026-02-02 11:30:00', 9, 8, FALSE),
(2, 8, '2026-02-02 11:35:00', 10, 9, TRUE),
(2, 9, '2026-02-02 11:40:00', 11, 10, FALSE),
(2, 10, '2026-02-02 11:45:00', 12, 11, TRUE),
(2, 11, '2026-02-02 11:50:00', 1, 12, FALSE),
(2, 12, '2026-02-02 11:55:00', 2, 13, TRUE),

-- COMMENTO (3)
(3, 1, '2026-02-03 12:00:00', 4, 3, FALSE),
(3, 2, '2026-02-03 12:05:00', 5, 4, TRUE),
(3, 3, '2026-02-03 12:10:00', 6, 5, FALSE),
(3, 4, '2026-02-03 12:15:00', 7, 6, TRUE),
(3, 5, '2026-02-03 12:20:00', 8, 7, FALSE),
(3, 6, '2026-02-03 12:25:00', 9, 8, FALSE),
(3, 7, '2026-02-03 12:30:00', 10, 9, TRUE),
(3, 8, '2026-02-03 12:35:00', 11, 10, FALSE),
(3, 9, '2026-02-03 12:40:00', 12, 11, TRUE),
(3, 10, '2026-02-03 12:45:00', 1, 12, FALSE),
(3, 11, '2026-02-03 12:50:00', 2, 13, TRUE),
(3, 12, '2026-02-03 12:55:00', 3, 14, FALSE),

-- DISISCRIZIONE (4)
(5, 1, '2026-02-04 13:00:00', 5, 6, FALSE),
(5, 2, '2026-02-04 13:05:00', 6, 7, TRUE),
(5, 3, '2026-02-04 13:10:00', 7, 8, FALSE),
(5, 4, '2026-02-04 13:15:00', 8, 9, TRUE),
(5, 5, '2026-02-04 13:20:00', 9, 10, FALSE),
(5, 6, '2026-02-04 13:25:00', 10, 11, TRUE);