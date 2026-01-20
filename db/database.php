<?php 
    class DatabaseHelper {
        private $db;

        public function __construct($servername, $username, $password, $dbname, $port){
            $this->db = new mysqli($servername, $username, $password, $dbname, $port);
            if($this->db->connect_error) {
                die("Connessione al db fallita");
            }
        }

        public function getCategories() {
            $stmt = $this->db->prepare("SELECT id, nome_categoria FROM categoria");
            $stmt->execute();
            $result = $stmt->get_result();
            
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function getActivePosts() {
            $stmt = $this->db->prepare("
                SELECT p.id, p.foto, p.titolo, p.descrizione, p.data_ora, p.posti_disponibili, 
                p.provincia, p.comune, p.indirizzo, 
                c.nome_categoria, u.username AS creatore
                FROM POST p, CATEGORIA c, UTENTE u
                WHERE p.id_categoria = c.id
                AND p.id_creatore = u.id
                AND p.data_ora >= NOW()
                ORDER BY p.data_ora ASC
            ");

            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function getPost($id) {
            $stmt = $this->db->prepare("SELECT p.*,c.nome_categoria FROM POST p JOIN CATEGORIA c ON c.id = p.id_categoria WHERE p.id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }

        public function getMembersFromPost($id) {
            $stmt = $this->db->prepare("SELECT u.nome, u.cognome, u.id, u.foto
                FROM ISCRIZIONE_POST ip JOIN UTENTE u ON ip.id_iscritto = u.id
                WHERE ip.id_post = ?
                ");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function getNumberOfMembersFromPost($id) {
            $stmt = $this->db->prepare(
                "SELECT COUNT(*) AS numero_iscritti
                FROM ISCRIZIONE_POST
                WHERE id_post = ?"
            );
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
            return (int) $result['numero_iscritti'];
        }

        public function getCommentsFromPost($id) {
            $stmt = $this->db->prepare(
                "SELECT *
                FROM COMMENTO
                WHERE id_post = ?"
            );
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function getUserFromComment($id) {
            $stmt = $this->db->prepare(
                "SELECT u.username, u.id, u.foto
                FROM UTENTE u JOIN COMMENTO c ON u.id = c.id_utente
                WHERE c.id = ?"
            );
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }

        public function checkLogin($username, $password){
            $stmt = $this->db->prepare(
                "SELECT *
                FROM UTENTE
                WHERE username = ? 
                AND password_hash = ?"
            );
            $stmt->bind_param("ss", $username, $password);
            
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }
                
        public function getCreatorFromPost($id) {
            $stmt = $this->db->prepare(
                "SELECT u.nome, u.cognome, u.id
                FROM UTENTE u JOIN POST p ON u.id = p.id_creatore
                WHERE p.id = ?"
            );
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }

        public function createUtente($username, $password_hash, $nome, $cognome, $numero_telefono, $mail, $foto) {
            $stmt = $this->db->prepare(
                "INSERT INTO UTENTE (username, password_hash, nome, cognome, numero_telefono, mail, foto) 
                VALUES (?, ?, ?, ?, ?, ?, ?)"
            );
            $stmt->bind_param("sssssss", $username, $password_hash, $nome, $cognome, $numero_telefono, $mail, $foto);
            return $stmt->execute();
        }

        public function getUtenti(){
            $stmt = $this->db->prepare("SELECT * FROM UTENTE");
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function getLikedPostFromUser($id) {
            $stmt = $this->db->prepare("
                SELECT 
                    p.id,
                    p.foto,
                    p.titolo,
                    p.descrizione
                FROM POST p
                JOIN LIKE_POST lp 
                    ON p.id = lp.id_post
                WHERE lp.id_utente = ?;
            ");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function getNotificationFromUser($id) {
            $stmt = $this->db->prepare("
                SELECT 
                    u.username AS mittente_username,
                    n.data_ora,
                    tn.tipologia AS nomeTipologia,
                    n.id_post,
                    p.titolo AS titoloPost
                FROM NOTIFICA n
                JOIN TIPO_NOTIFICA tn 
                    ON n.id_tipo_notifica = tn.id
                LEFT JOIN UTENTE u 
                    ON n.id_mittente = u.id
                LEFT JOIN POST p 
                    ON n.id_post = p.id
                WHERE n.id_destinatario = ?
                ORDER BY n.data_ora DESC;
            ");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function createPost($titolo, $descrizione, $data_ora, $posti_disponibili, $indirizzo, $citta, $comune, $provincia, $id_categoria, $foto, $id_creatore) {
            $stmt = $this->db->prepare(
                "INSERT INTO POST (titolo, descrizione, data_ora, posti_disponibili, indirizzo, citta, comune, provincia, id_categoria, foto, id_creatore)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
            );
            $stmt->bind_param("sssissssisi", $titolo, $descrizione, $data_ora, $posti_disponibili, $indirizzo, $citta, $comune, $provincia, $id_categoria, $foto, $id_creatore);
            
            if(!$stmt->execute()) {
                return false;
            }  
            return $this->db->insert_id;
        }

        public function getUserFromId($id) {
            $stmt = $this->db->prepare("
                SELECT * FROM UTENTE WHERE id = ?
            ");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }

        public function getUserFromUsername($username) {
            $stmt = $this->db->prepare("
                SELECT * FROM UTENTE WHERE username = ?
            ");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }

        public function getActivePostsFromUser($id) {
            $stmt = $this->db->prepare("
                SELECT p.id, p.foto, p.titolo, p.descrizione, p.data_ora, p.posti_disponibili, 
                p.provincia, p.comune, p.indirizzo, 
                c.nome_categoria, u.username
                FROM POST p, CATEGORIA c, UTENTE u
                WHERE u.id = ? AND
                p.id_categoria = c.id
                AND p.id_creatore = u.id
                AND p.data_ora >= NOW()
                ORDER BY p.data_ora ASC
            ");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function searchUsers($query) {
            $stmt = $this->db->prepare("SELECT id, username, nome, cognome, foto FROM utente WHERE username LIKE ? OR nome LIKE ? OR cognome LIKE ?");
            $like = "%".$query."%";
            $stmt->bind_param("sss", $like, $like, $like);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function searchPosts($query) {
            $sql = "
                SELECT p.id, p.titolo, p.descrizione, p.foto, c.nome_categoria, 
                p.data_ora, u.username AS creatore
                FROM post p
                JOIN categoria c ON p.id_categoria = c.id 
                JOIN utente u ON p.id_creatore = u.id 
                WHERE (
                    p.titolo LIKE ?
                    OR p.descrizione LIKE ?
                    OR c.nome_categoria LIKE ?
                )
                AND p.data_ora >= NOW()
            ";

            $stmt = $this->db->prepare($sql);
            $like = "%".$query."%";
            $stmt->bind_param("sss", $like, $like, $like);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }


        public function isUserAPartecipant($id_user, $id_post) {
            $stmt = $this->db->prepare("
                SELECT EXISTS(
                    SELECT 1
                    FROM ISCRIZIONE_POST
                    WHERE id_post = ? AND id_iscritto = ?
                ) AS is_iscritto;
            ");
            $stmt->bind_param("ii", $id_post, $id_user);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            return (bool)$row['is_iscritto'];
        }

        public function insertNewPartecipation($id_utente, $id_post) {
            $stmt = $this->db->prepare(
                "INSERT INTO ISCRIZIONE_POST (id_post, id_iscritto)
                VALUES (?, ?)"
            );
            $stmt->bind_param("ii", $id_post, $id_utente);
            
            return $stmt->execute();
        }

        public function removeParticipation($id_user, $id_post) {
            $stmt = $this->db->prepare("
                DELETE FROM ISCRIZIONE_POST
                WHERE id_post = ? AND id_iscritto = ?
            ");
            $stmt->bind_param("ii", $id_post, $id_user);
            return $stmt->execute();
        }

        public function insertNewComment($testo, $id_user, $id_post) {
            $stmt = $this->db->prepare("
                INSERT INTO COMMENTO (testo, id_utente, id_post)
                VALUES (?, ?, ?)
            ");
            $stmt->bind_param("sii", $testo, $id_user, $id_post);
            return $stmt->execute();
        }

        public function deletePost($id_post) {
            $stmt = $this->db->prepare("
                DELETE FROM POST
                WHERE id = ?
            ");
            $stmt->bind_param("i", $id_post);
            return $stmt->execute();
        }

        public function modifyAdminById($id) {
            $stmt = $this->db->prepare("
                UPDATE UTENTE
                SET ruolo = CASE 
                    WHEN ruolo = 'USER' THEN 'ADMIN'
                    WHEN ruolo = 'ADMIN' THEN 'USER'
                    ELSE ruolo
                END
                WHERE id = ?
            ");
            $stmt->bind_param("i", $id);
            return $stmt->execute();
        }
        
        public function insertNewNotification($id_tipo_notifica, $id_destinatario, $data_ora, $id_mittente, $id_post, $letto) {
            $stmt = $this->db->prepare(
                "INSERT INTO NOTIFICA (id_tipo_notifica, id_destinatario, data_ora, id_mittente, id_post, letto)
                VALUES (?, ?, ?, ?, ?, ?)"
            );
            $stmt->bind_param("iisiii", $id_tipo_notifica, $id_destinatario, $data_ora, $id_mittente, $id_post, $letto);
            
            return $stmt->execute();
        }

        public function hasUserLikedPost($id_user, $id_post) {
            $stmt = $this->db->prepare("
                SELECT EXISTS(
                    SELECT 1
                    FROM LIKE_POST
                    WHERE id_post = ? AND id_utente = ?
                ) AS haMessoLike;
            ");
            $stmt->bind_param("ii", $id_post, $id_user);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            return (bool)$row['haMessoLike'];
        }

        public function insertNewLike($id_post, $id_utente) {
            $stmt = $this->db->prepare(
                "INSERT INTO LIKE_POST (id_post, id_utente)
                VALUES (?, ?)"
            );
            $stmt->bind_param("ii", $id_post, $id_utente);
            
            return $stmt->execute();
        }

        public function removeLike($id_post, $id_utente) {
            $stmt = $this->db->prepare("
                DELETE FROM LIKE_POST
                WHERE id_post = ? AND id_utente = ?
            ");
            $stmt->bind_param("ii", $id_post, $id_utente);
            return $stmt->execute();
        }

        public function modifyBanUserById($id) {
            $stmt = $this->db->prepare("
                UPDATE UTENTE
                SET bannato = CASE 
                    WHEN bannato = 0 THEN 1
                    WHEN bannato = 1 THEN 0
                    ELSE bannato
                END
                WHERE id = ?
            ");
            $stmt->bind_param("i", $id);
            return $stmt->execute();
        }
        
        public function getPostWhereUserIsAParticipant($id) {
            $stmt = $this->db->prepare("
                SELECT p.id, p.foto, p.titolo, p.descrizione, p.data_ora, p.posti_disponibili, 
                p.provincia, p.comune, p.indirizzo, 
                c.nome_categoria, u.username
                FROM POST p
                JOIN ISCRIZIONE_POST ip ON ip.id_post = p.id
                JOIN CATEGORIA c ON p.id_categoria = c.id
                JOIN UTENTE u ON p.id_creatore = u.id
                WHERE ip.id_iscritto = ?
                AND p.data_ora >= NOW()
                ORDER BY p.data_ora ASC
            ");

            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function modifyUtente($id, $username, $password_hash, $nome, $cognome, $numero_telefono, $mail, $foto) {
            $stmt = $this->db->prepare(
                "UPDATE UTENTE 
                SET username = ?, password_hash = ?, nome = ?, cognome = ?, numero_telefono = ?, mail = ?, foto = ?
                WHERE id = ?"
            );
            $stmt->bind_param("ssssssss", $username, $password_hash, $nome, $cognome, $numero_telefono, $mail, $foto, $id);
            return $stmt->execute();
        }

        public function deleteProfilePhoto($id) {
            $stmt = $this->db->prepare(
                "UPDATE UTENTE 
                SET foto = 'default_profile.png'
                WHERE id = ?"
            );
            $stmt->bind_param("i", $id);
            return $stmt->execute();
        }

        public function removeComment($idCommento) {
            $stmt = $this->db->prepare(
                "DELETE FROM COMMENTO 
                WHERE id = ?"
            );
            $stmt->bind_param("i", $idCommento);
            return $stmt->execute();
        }
    }
?>