<?php
    session_start();
    if(!isset($_SESSION['user']))
    header('Location:index.php');
    require_once '../config.php';

    if(isset($_POST['formation'])) {
        $formation = $_POST['formation'];
        $desc = $_POST['desc'];
        $file = $_POST['file'];
        $content = $_POST['content'];
        $start = $_POST['date_start'];
        $end = $_POST['date_end'];
        $id = $_POST['id'];

        $sql = $bdd->prepare('SELECT * FROM formations WHERE title = ?');
        $sql->execute([$formation]);
        $data = $sql->fetch();

        if(!$data) {
            $sql2 = $bdd->prepare('UPDATE formations SET title = :title, description = :description, content = :content, date_start = :date_start, date_end = :date_end, file = :file WHERE id = :id');
            $sql2->execute([
                ':title' => $formation,
                ':description' => $desc,
                ':content' => $content,
                ':file' => $file,
                ':date_start' => $start,
                ':date_end' => $end,
                ':id' => $id
            ]);
            header('Location: ../formations.php?editf=success');
            die();
        } else {
            header('Location: ../formations.php?editf=error');
        }

    } else {
        header('Location: ../formations.php'); die();
    }


?>