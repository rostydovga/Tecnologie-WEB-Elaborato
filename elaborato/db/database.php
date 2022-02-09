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


    }

?>