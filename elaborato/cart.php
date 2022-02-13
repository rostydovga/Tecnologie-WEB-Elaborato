<?php

    class Carrello {

        private $db;

        public function __construct($dbh) {
            $this->db = $dbh;
        }

        private function computeSubtotal($idutente, $idordine) {
            $tot = 0;
            $prodotticarrello = $this->db->getUserOrderProducts($idutente, $idordine);
            foreach($prodotticarrello as $prodotto) {
                $tot += $prodotto["Prezzo"]*$prodotto["QuantNelCarrello"];
            }
            return $tot;
        }

        public function addProduct($idprodotto, $idutente, $idordine, $quantita) {
            //si aggiunge al db il nuovo prodotto
            $this->db->addProductToCart($idprodotto, $idutente, $idordine, $quantita);
            //si setta anche il subtotal
            $importo = $this->computeSubtotal($idutente, $idordine);
            $this->db->setCartSubtotal($importo, $idutente, $idordine);
        }

        public function removeProduct($idprodotto, $idutente, $idordine) {
            //si toglie al db il prodotto
            $this->db->removeProductFromCart($idprodotto, $idutente, $idordine);
            //si setta anche il subtotal
            $importo = $this->computeSubtotal($idutente, $idordine);
            $this->db->setCartSubtotal($importo, $idutente, $idordine);
        }

        public function getProducts($idutente, $idordine) {
            return $this->db->getUserOrderProducts($idutente, $idordine);
        }

        public function getSubtotal($idutente, $idordine) {
            return $this->db->getCartSubtotal($idutente, $idordine);
        }

        public function isEmpty() {
            $status = true;
            if(isset($_SESSION["IdUtente"]) && isset($_SESSION["Ordine"])) {
                $status = $this->db->isCartEmpty($_SESSION["IdUtente"], $_SESSION["Ordine"]);
            }
            return $status;
        }

    }

?>