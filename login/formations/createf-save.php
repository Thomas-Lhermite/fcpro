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

        $sql = $bdd->prepare('SELECT * FROM formations WHERE title = ?');
        $sql->execute([$formation]);
        $data = $sql->fetch();

        if(!$data) {

            $sql2 = $bdd->prepare('INSERT INTO formations (title, description, content, date_start, date_end, file) VALUES (:title,:description, :content, :date_start, :date_end, :file)');

            $sql2->execute([
                ':title' => $formation,
                ':description' => $desc,
                ':content' => $content,
                ':date_start' => $start,
                ':date_end' => $end,
                ':file' => $file
            ]);

            $sql3 = $bdd->prepare('SELECT * FROM formations WHERE title = ?');
            $sql3->execute(array($formation));
            $data2 = $sql3->fetch();

            $id = $data2['id'];

            header('Location: table-form.php?id='.$id.''); die();

        } else {
            header('Location: ../formations.php?formation=error');
        }
    } else {
        header('Location: ../formations.php'); die();
    }

?>