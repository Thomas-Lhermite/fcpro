<?php
session_start();
if(!isset($_SESSION['user']))
header('Location:index.php');
require_once '../config.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $table = $bdd->prepare("CREATE TABLE IF NOT EXISTS `$id` (
        `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `name` CHAR ( 100 ) NOT NULL, 
        `rate` INT NOT NULL,
        `review` TEXT NOT NULL
        ) ENGINE = InnoDB CHARACTER SET latin1 COLLATE latin1_bin");
    $table->execute();

    header('Location: ../formations.php?formation=success'); die();

} else {
    header('Location: ../formations.php?formation=error');
}
?>