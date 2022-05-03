<?php

    require_once '../config.php';    

    if(isset($_GET['id'])) {
        $id=$_GET['id'];

        $drop = $bdd->prepare("DROP TABLE `$id`");
        $drop->execute();

        $check = $bdd->prepare('DELETE FROM formations WHERE id = :id');
        $check->execute([
            ':id' => $id
        ]);

        header('Location:../formations.php?deletef=success');
        die();

    } else {
        header('Location:../formations.php'); die();
    }

?>