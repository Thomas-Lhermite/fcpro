<?php

require_once '../login/config.php';

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $fid = $_GET['fid'];

        $sql = $bdd->prepare("DELETE FROM `$fid` WHERE id = :id");
        $sql->execute([
            ':id' => $id
        ]);

        header('Location: display-rate-form.php?id='.$fid); die();

    } else {
        header('Location: ../index.php'); die();
    }

?>