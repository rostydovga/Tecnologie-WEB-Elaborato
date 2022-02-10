<?php
/* Gestione del carrello e dei suio elementi */
    

    class Carrello {
        
        private $product;  //array associativo formato da id:quantità
        private $subtotal;

        public function addProduct() {

            //setta anche il subtotal
        }

        public function removeProduct() {

        }

        public function getProducts() { //prende tutti i prodotti che serviranno per l'ultima pagina
            //controllare session e/o cookie
            //se l'utente e loggato controllo se ha roba nel carrello

            //se non e loggato controllo i Cookie
        }

        public function getSubtotal() {

        }

        public function isEmpty() {
            //boolea
            return true;
        }

    }

    


?>