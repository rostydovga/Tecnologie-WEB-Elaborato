<?php

    class CentroNotifiche {

        private $db;

        public function __construct($dbh) {
            $this->db = $dbh;
        }

        //aggiunge una notifica al db
        public function addMessage($idutente, $descrizione) {
            $this->db->addNotification($idutente, $descrizione);
        }

        //ritorna tutte le notifiche di un utente
        public function getMessages($idutente) {
            return $this->db->getNotifications($idutente);
        }

    }

?>