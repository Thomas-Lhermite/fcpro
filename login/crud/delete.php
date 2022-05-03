<html>
    <head>
        <title>Espace membre</title>
    </head>
    <body>
        <?php
            session_start();
            require_once '../config.php';    

            if(isset($_GET['id'])) {
                $id=$_GET['id'];

                $check = $bdd->prepare('DELETE FROM users WHERE id = :id');
                $check->execute([
                    ':id' => $id
                ]);

                header('Location:../user.php?delete=success');
                die();

            } else {
                header('Location:../user.php'); die();
            }
        ?>
    </body>
</html>