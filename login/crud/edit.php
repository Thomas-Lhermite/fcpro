<?php
    session_start();
    if(!isset($_SESSION['user']))
        header('Location:../index.php');
?>

<html>
    <?php
        require_once '../config.php';
        
        $id = null;
        $username = null;
        $permissions = null;

        global $id;
        global $username;
        global $permissions;


        if(isset($_GET['id'])) {
            $id=$_GET['id'];

            $check=$bdd->prepare('SELECT * FROM users WHERE id = :id');
            $check->execute(array(
                "id" => $id
            ));
            $data = $check->fetch();

            $username = $data['username'];
            $permissions = $data['permissions'];


        } else {
            header('Location:../user.php'); die();
        }
    ?>
    <head>
        <title>Utilisateur <?php echo $username ?></title>
        <link rel="icon" type="image/png" href="../../img/favicon.png" />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="../edit.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body id="bootstrap-overrides">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <h5 class="modal-title"><strong>Modification de l'utilisateur : </strong><?php echo $username ?></h5>
                <form action="edit-save.php" method="post" class="form-edit">
                    <input name=id type=hidden value="<?php echo $id?>">
                    <label for='username'>Nom d'utilisateur</label>
                    <input type="input" id="username" name="username" class="form-control" placeholder="<?php echo $username?>"required/>
                    <br />
                    <label for='permissions'>Permissions :</label>
                    <select name="permissions">
                        <option value="<?php echo $permissions?>" selected>Actuellement : <?php echo $permissions?></option>
                        <option value="*">Administrateur : *</option>
                        <option value="**">SuperAdministrateur : **</option>
                    </select><br/><br/>
                    <button type="submit" class="btn btn-success">Sauvegarder</button>
                </form>
                <div class="text-center">
                    <div class="btn-close-edit">
                        <a href="../user.php">Annuler</a>
                    </div>
                </div>
            <div>
        </div>

    </body>
</html>