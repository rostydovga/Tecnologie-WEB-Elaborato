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
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function isAdmin($id){
            $query = "SELECT IdUtente, Venditore FROM utenti WHERE IdUtente=? AND Venditore=1";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("i", $id);
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

        public function orderProducts($attributo) {
            $query = "SELECT IdProdotto, Nome, Prezzo, Immagine FROM prodotti ORDER BY ".$attributo." DESC";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        }

        /* FUNZIONI CARRELLO */

        public function createCartForUser($idutente, $idordine) {
            $query = "INSERT INTO carrelli (IdCliente,NumeroOrdine) VALUES (?,?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ii", $idutente, $idordine);
            $stmt->execute();
        }

        /*Controlla se un prodotto si trova gia nel carrello del cliente*/
        private function isProductInCart($idprodotto, $idutente, $idordine){
            $query = "SELECT Quantita FROM contiene_prodotti WHERE KCliente=? AND KProdotto=? AND KOrdine=?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("iii", $idutente, $idprodotto, $idordine);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();

            return $result == NULL ? 0 : $result["Quantita"];
        }

        public function addProductToCart($idprodotto, $idutente, $idordine, $quantita) {

            $current_quantity = $this->isProductInCart($idprodotto, $idutente, $idordine);
            //se il prodotto e gia presente si modifica solo la quantita
            if($current_quantity > 0){
                $query = "UPDATE contiene_prodotti SET Quantita=? WHERE KProdotto=? and KCliente=? AND KOrdine=?";
                $quantita = $current_quantity + $quantita;
            }else{
                $query = "INSERT INTO contiene_prodotti(Quantita,KProdotto,KCliente,KOrdine) value (?,?,?,?)";
            }

            $stmt = $this->db->prepare($query);
            $stmt->bind_param("iiii", $quantita, $idprodotto, $idutente, $idordine);
            $stmt->execute();
        }

        public function getCartSubtotal($idutente, $idordine) {
            $query = "SELECT ImportoTotale FROM carrelli WHERE IdCliente=? AND NumeroOrdine=?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ii", $idutente, $idordine);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function setCartSubtotal($importo, $idutente, $idordine) {
            $query = "UPDATE carrelli SET ImportoTotale=? WHERE IdCliente=? AND NumeroOrdine=?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("dii", $importo, $idutente, $idordine);
            $stmt->execute();
            $result = $stmt->get_result();
        }

        public function removeProductFromCart($idprodotto, $idutente, $idordine) {
            $current_quantity = $this->isProductInCart($idprodotto, $idutente, $idordine);
            $current_quantity -= 1;

            //rimuovo un elemento alla volta -> quantita--
            if($current_quantity > 0){
                $query = "UPDATE contiene_prodotti SET Quantita=? WHERE KProdotto=? AND KCliente=? AND KOrdine=?";
                $stmt = $this->db->prepare($query);
                $stmt->bind_param("iiii", $quantita, $idprodotto, $idutente, $idordine);
            }elseif($current_quantity == 0){  //se arrivo a 0 lo elimino definitivamente
                $query = "DELETE FROM contiene_prodotti WHERE KProdotto=? AND KCliente=? AND KOrdine=?";
                $stmt = $this->db->prepare($query);
                $stmt->bind_param("iii", $idprodotto, $idutente, $idordine);
            }

            $stmt->execute();
        }

        public function getUserOrderProducts($idutente, $idordine) {
            $query = "SELECT IdProdotto, Nome, Prezzo, Immagine, c.Quantita AS QuantNelCarrello, p.Quantita AS QuantMax FROM prodotti p, contiene_prodotti c WHERE IdProdotto=KProdotto AND KCliente=? AND KOrdine=?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ii", $idutente, $idordine);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function isCartEmpty($idutente, $idordine) {
            $query = "SELECT KProdotto FROM contiene_prodotti WHERE KCliente=? AND KOrdine=?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ii", $idutente, $idordine);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            return count($result) > 0 ? false : true;
        }

        public function completeOrder($idutente, $idordine) {
            $query = "UPDATE carrelli SET DataOrdine=CURDATE() WHERE IdCliente=? AND NumeroOrdine=?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ii", $idutente, $idordine);
            $stmt->execute();
        }

        public function subtractQuantity($idprodotto, $quantita) {
            $query = "UPDATE prodotti SET Quantita=? WHERE IdProdotto=?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ii", $quantita, $idprodotto);
            $stmt->execute();
        }

        private function getCategoryIdByName($nome) {
            $query = "SELECT IdCategoria FROM categorie WHERE Nome=?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("s", $nome);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function modifyProduct($idProdotto,$nome,$categoria,$prezzo,$ml,$quantita,$descrizione,$sesso,$immagine) {
            $idcategoria = $this->getCategoryIdByName($categoria);

            $query = "UPDATE prodotti 
            SET Nome=?, Prezzo=?, KCategoria=?, Quantita=?, Ml=?, Descrizione=?, DataInserimento=CURDATE(), Sesso=?, Immagine=?
            WHERE IdProdotto=?";

            $stmt = $this->db->prepare($query);
            $stmt->bind_param("sdiiisssi",$nome,$prezzo,$idcategoria[0]["IdCategoria"],$quantita,$ml,$descrizione,$sesso,$immagine,$idProdotto);
            $stmt->execute();
        }

        public function deleteProduct($idprodotto) {
            $query = "DELETE FROM prodotti WHERE idProdotto=?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("i", $idprodotto);
            $stmt->execute();
        }

        /*private function getCategoryNameById($id) {
            $query = "SELECT Nome FROM categorie WHERE IdCategoria=?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        } */

        public function addProduct($nome, $prezzo, $desc, $quantita, $ml, $sesso, $imm, $categoria) {
            $idcategoria = $this->getCategoryIdByName($categoria);

            $query = "INSERT INTO prodotti (Nome, Prezzo, Descrizione, Quantita, Ml, Sesso, Immagine, KCategoria, DataInserimento) VALUES (?,?,?,?,?,?,?,?,CURDATE())";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("sisiissi", $nome, $prezzo, $desc, $quantita, $ml, $sesso, $imm, $idcategoria[0]["IdCategoria"]);
            $stmt->execute();
        }

    }

?>