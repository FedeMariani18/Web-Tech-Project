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
            $stmt = $this->db->prepare("SELECT * FROM POST WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }

        public function getMembersFromPost($id) {
            $stmt = $this->db->prepare("SELECT u.nome, u.cognome, u.id
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
                "SELECT u.username, u.id
                FROM UTENTE u JOIN COMMENTO c ON u.id = c.id_utente
                WHERE c.id = ?"
            );
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }

    }
?>