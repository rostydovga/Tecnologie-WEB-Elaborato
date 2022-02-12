<?php
/* Gestione del carrello e dei suio elementi */
    

    class Carrello {
        
        private $product = array();
        private $subtotal;
        private $db;

        public function __construct($dbhelper){
            $this->db = $dbhelper;
            
        }

        public function addProduct($idProdotto, $idUtente,$quantita) {
            //chiamata al db-> aggiungo prodotto al database
            $this->db->addProductToCart($idProdotto,$idUtente,$quantita);
        }

        public function removeProduct($idProdotto, $idUtente) {
            $this->db->removeProductFromcart($idProdotto, $idUtente);

        }

        public function getProducts() {
            //immagine
            //codice
            //nome
            //qty
            //prezzo 
            
        }

        public function getSubtotal() {

        }

        public function isEmpty() {
            
            $status = true;

            if(isset($_SESSION["IdUtente"])){
                $idUtente = $_SESSION["IdUtente"];
                $status = $this->db->isCartEmpty($idUtente);
            }

            return $status;
        }

    }

    


?>