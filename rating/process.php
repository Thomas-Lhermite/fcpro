<?php
    require_once '../login/config.php';

    if(isset($_POST['id'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $rate = $_POST['rate'];
        $review = $_POST['review'];

        // echo $id. " ". $name . " ". $rate . " ". $review;

        $sql = $bdd->prepare("INSERT INTO `$id` (name, rate, review) VALUES (:name, :rate, :review)");
        $sql->execute([
            ':name' => $name,
            ':rate' => $rate,
            ':review' => $review
        ]);

        header('Location: ../formation.php'); die();

    } else {
        header('Location : ../formation.php'); die();
    }
?>