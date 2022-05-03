<?php
    require_once '../login/config.php';

    $title = null;
    $id = null;

    global $title;
    global $id;

    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = $bdd->prepare('SELECT * FROM formations WHERE id = ?');
        $sql->execute(array($id));

        $data = $sql->fetch();
        $title = $data['title'];

?>

<!DOCTYPE html>
<html lang="FR-fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/rating.css">
    <link rel="icon" type="image/png" href="../img/favicon.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title><?php echo $title ?></title>
</head>
<body>
    <div class="container">
        <div class="content">
            <h5 class="modal-title">Notation de la <?php echo $title?> : </h5>
            <form action="process.php" method="post" class="form-edit">
                <input type="hidden" name="id" value="<?php echo $id?>"/>
                <input type="input" name="name" id="name" value="" placeholder="Nom" class="form-control" required/><br/>
                <div class="star-rate">
                    <input type="radio" name="rate" id="rate-5" value="5"/>
                    <label for="rate-5" class="fa fa-star"></label>
                    <input type="radio" name="rate" id="rate-4" value="4"/>
                    <label for="rate-4" class="fa fa-star"></label>
                    <input type="radio" name="rate" id="rate-3" value="3"/>
                    <label for="rate-3" class="fa fa-star"></label>
                    <input type="radio" name="rate" id="rate-2" value="2"/>
                    <label for="rate-2" class="fa fa-star"></label>
                    <input type="radio" name="rate" id="rate-1" value="1"/>
                    <label for="rate-1" class="fa fa-star"></label>
                </div>
                <div class="textarea-rate">
                    <textarea name="review" id="review" cols="40" rows="10" class="form-control" placeholder="Donner votre avis ici..." maxlength="200" required></textarea><br/>
                </div>
                <button type="submit" class="btn btn-success">Envoyer</button>
            </form>
            <?php } ?>
        </div>
    </div> 
</body>
</html>