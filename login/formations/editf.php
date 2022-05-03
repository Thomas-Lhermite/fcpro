<?php
    session_start();
    if(!isset($_SESSION['user']))
        header('Location:../index.php');
?>

<?php
require_once '../config.php';

    $id = null;
    $formation = null;
    $desc = null;
    $content = null;
    $start = null;
    $end = null;
    $file = null;

    global $id;
    global $formation;
    global $desc;
    global $content;
    global $start;
    global $end;
    global $file;

    if(isset($_GET['id'])) {
        $id=$_GET['id'];

        $check=$bdd->prepare('SELECT * FROM formations WHERE id = :id');
        $check->execute(array(
            "id" => $id
        ));
        $data = $check->fetch();

        $formation = $data['title'];
        $desc = $data['description'];
        $content = $data['content'];
        $start = $data['date_start'];
        $end = $data['date_end'];
        $file = $data['file'];


    } else {
        header('Location:../formations.php'); die();
    }

?>
<html>
<head>
    <title>Formation <?php echo $formation?></title>
    <link rel="icon" type="image/png" href="../../img/favicon.png" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../edit.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body id="bootstrap-overrides">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <h5 class="modal-title"><strong>Modification de la formation : </strong><?php echo $formation ?></h5>
            <form action="editf-save.php" method="post" class="form-edit">
                <input name=id type=hidden value="<?php echo $id?>">
                <label for='formation'>Titre de la formation :</label>
                <input type="input" id="formation" name="formation" class="form-control" placeholder="<?php echo $formation ?>" required/>
                <br />
                <label for='desc'>Description de la formation :</label>
                <textarea name="desc" id="desc" class="form-control" cols="40" rows="5" required><?php echo $desc ?></textarea>
                <!-- <input type="input" id="desc" name="desc" class="form-control" value=""required/> -->
                <br />
                <label for='content'>Contenut de la formation :</label>
                <textarea name="content" id="content_editor" class="form-control" cols="40" rows="30" required><?php echo $content ?></textarea>
                <br />
                <label for="schedule">Date du Début :</label><br/>
                <input type="date" name="date_start" class="form-control" value="<?php echo $start ?>"required><br/><br/>
                <label for="schedule">Date de Fin :</label><br/>
                <input type="date" name="date_end" class="form-control" value="<?php echo $end ?>"required><br/><br/>
                <label for='file'>Choisir un fichier en lien avec la formation :</label><br/>
                <select name="file">
                    <option value="<?php echo $file ?>" selected>Actuellement : <?php echo $file ?></option>
                    <?php
                    
                    $option = $bdd->prepare('SELECT * FROM upload');
                    $option->execute();
                    while($data = $option->fetch()) {
                        echo"<option value=".$data['name'].">".$data['name']."</option>";
                    }                        
                    ?>
                </select><br/><br/>
                <button type="submit" class="btn btn-success">Modifier</button>
            </form>
            <div class="text-center">
                <div class="btn-close-edit">
                    <a href="../formations.php">Annuler</a>
                </div>
            </div>
        <div>
    </div>
    <script src="../ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content_editor');
    </script>
</body>
</html>