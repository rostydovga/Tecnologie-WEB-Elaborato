<?php

    class DatabaseHelper{
        private $db;

        public function __construct($servername, $username, $password, $dbname, $port){
            //istanzio connessione al db
            $this->db = new mysqli($servername, $username, $password, $dbname, $port);

            //controllo connessione
            if($this->db->connect_error){
                die("Connection to DB failed");
            }
        }

        /*per prendere casualmente i prodotti*/
        public function getRandomProducts($n=4){
            $stmt = $this->db->prepare("SELECT IdProdotto, Nome, Prezzo, Immagine FROM prodotti ORDER BY RAND() LIMIT ?");
            $stmt->bind_param("i", $n);
            $stmt->execute();
            $result = $stmt->get_result();
            
            //restituisco un array associativo - dizionario
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        /*Prendo tutti i prodotti*/
        public function getProducts($n=-1){
            $query = "SELECT IdProdotto, Nome, Prezzo, Immagine FROM prodotti";
            if($n>0){
                $query.=" LIMIT ?";
            }
            $stmt = $this->db->prepare($query);
            
            if($n>0){
                $stmt->bind_param("i",$n);
            }

            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        }

        /*Richiedo le informazioni di un prodotto dato il suo id*/
        public function getProductInfo($id){
            $query = "SELECT IdProdotto, p.Nome as NomeProdotto, Ml, Prezzo, Descrizione, Quantita, Sesso, Immagine, c.Nome as Categoria, Quantita FROM prodotti p, categorie c WHERE KCategoria=IdCategoria AND IdProdotto=?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("i",$id);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_assoc();
        }

        /*controllo sul login*/
        public function checkLogin($email, $password){
            $query = "SELECT IdUtente, Nome, Cognome FROM utenti WHERE Email=? AND Pwd=?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ss",$email, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        }

        /*Controllo che l'email inserita non esista gia */
        public function checkEmailExisting($email){
            $query = "SELECT Email FROM utenti WHERE Email=? ";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s",$email);
            $stmt->execute();
            $result = $stmt->get_result();
            
            return $result->fetch_all(MYSQLI_ASSOC);
        }


        /*Registrazione utente*/
        public function registerUser($nome, $cognome, $email, $password){
            $query = "INSERT INTO utenti(Nome,Cognome,Email,Pwd) value (?,?,?,?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ssss",$nome, $cognome, $email, $password);
            $stmt->execute();
            
            //$result = $stmt->get_result();
        }
        
    }

?>