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

        public function getCategories() {
            $query = "SELECT IdCategoria, Nome FROM categorie";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        }

        /*Richiedo le informazioni di un prodotto dato il suo id*/
        public function getProductInfo($id){
            $query = "SELECT IdProdotto, p.Nome as NomeProdotto, Ml, Prezzo, Descrizione, Quantita, Sesso, Immagine, KCategoria, c.Nome as Categoria, Quantita FROM prodotti p, categorie c WHERE KCategoria=IdCategoria AND IdProdotto=?";
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

        public function isAdmin($id){
            $query = "SELECT IdUtente, Admin FROM utenti WHERE IdUtente=? AND Admin=1";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("i",$id);
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
            
        }
/******************************************************** */
        /*Controlla se un dato prodotto e nel carrello del cliente*/
        private function isProductInCart($idProdotto, $idUtente){
            $query = "SELECT Quantita FROM contiene_prodotti WHERE KCliente=? AND KProdotto=? ";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ii",$idUtente,$idProdotto);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();

            return $result==NULL ? 0 : $result["Quantita"];
        }

/******************************************************** */
        /*Aggiunta elemento al carrello dall'utente*/
        public function addProductToCart($idProdotto, $idUtente,$quantita){

            $current_quantity = $this->isProductInCart($idProdotto, $idUtente);
            //se il prodotto e gia presente modifico solo la quantita
            if($current_quantity>0){
                $query = "UPDATE contiene_prodotti SET Quantita=? WHERE KProdotto=? and KCliente=?";
                $quantita=$current_quantity+$quantita;
            }else{
                $query = "INSERT INTO contiene_prodotti(Quantita,KProdotto,KCliente) value (?,?,?)";
            }

            $stmt = $this->db->prepare($query);
            $stmt->bind_param("iii",$quantita,$idProdotto, $idUtente);
            $stmt->execute();

        }

/******************************************************** */
        public function removeProductFromcart($idProdotto, $idUtente){
            $current_quantity = $this->isProductInCart($idProdotto, $idUtente);
            $current_quantity-=1;

            //rimuovo un elemento alla volta -> quantita--
            if($current_quantity>0){
                $query = "UPDATE contiene_prodotti SET Quantita=? WHERE KProdotto=? and KCliente=?";
                $stmt = $this->db->prepare($query);
                $stmt->bind_param("iii",$quantita,$idProdotto, $idUtente);
            }elseif($current_quantity==0){ //se arrivo a 0 lo elimino definitivamente
                $query = "DELETE FROM contiene_prodotti WHERE KProdotto=? and KCliente=?";
                $stmt = $this->db->prepare($query);
                $stmt->bind_param("ii",$idProdotto, $idUtente);
            }

            $stmt->execute();

        }

/******************************************************** */
        /*Controllo se il carrello e vuoto*/
        public function isCartEmpty($idUtente){
            $query = "SELECT KProdotto FROM contiene_prodotti WHERE KCliente=? ";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("i",$idUtente);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            return count($result) > 0 ? false : true;
        }
        
        public function modifyProduct($idProdotto,$nome,$categoria,$prezzo,$quantita,$descrizione,$sesso){
            $query = "UPDATE prodotti 
            SET Nome=?, Prezzo=?, KCategoria=?, Quantita=?, Descrizione=?, DataInserimento=CURDATE(), Sesso=?
            WHERE IdProdotto=?";

            $stmt = $this->db->prepare($query);
            $stmt->bind_param("sdiissi",$nome,$prezzo,$categoria,$quantita,$descrizione,$sesso,$idProdotto);
            $stmt->execute();
        }


    }

?>