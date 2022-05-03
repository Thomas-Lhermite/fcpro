<?php
require_once('../config.php');

if(isset($_GET['del'])) {
    $id=$_GET['del'];

    $sql=$bdd->prepare("SELECT * FROM upload WHERE id = :id ");
    $sql->execute([
        ':id' => $id
    ]);
    $row=$sql->fetch();
    $file = $row['name'];
    
    function GetRelativePath($path)
    {
        $npath = str_replace('\\', '/', $path);
        return $npath;
    }

    $path = GetRelativePath(dirname(__FILE__))."/upload/".$file;

    if( file_exists($path) ) {

        unlink($path);

        $sql2=$bdd->prepare("DELETE FROM upload WHERE id = :id ");
        $sql2->execute([
            ':id' => $id
        ]);
        header("Location:../file.php?delfile=success"); die();
    } else {

        header("Loaction:../file.php?delfile=null"); die();
    }
} else {
    header("Location:../file.php?delfile=error"); die();
}

?>