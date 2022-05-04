<?php

    try {
        $bdd = new PDO('mysql:host=mysql-n-d-l-p-fcpro.alwaysdata.net;dbname=n-d-l-p-fcpro_bd;charset=utf8', '266745_admin', 'Admin12345@');
        
    } catch (Exception $e) {
        
        die('Erreur'.$e->getMessage());
    }

?>