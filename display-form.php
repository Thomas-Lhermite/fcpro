<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <?php
    session_start();
    require_once 'login/config.php';

    $title = null;
    $content = null;
    $avis = null;
    $file = null;
    $start = null;
    $end = null;
    $rate = null;
    
    global $note;
    global $title;
    global $content;
    global $avis;
    global $file;
    global $start;
    global $end;
    global $rate;

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $sql = $bdd->prepare('SELECT * FROM formations WHERE id = :id');
        $sql->execute(array(
            "id" => $id
        ));
        $formation = $sql->fetch();

        $title = $formation['title'];
        $content = $formation['content'];
        // $avis = $formation['avis'];
        $file = $formation['file'];
        $start = $formation['date_start'];
        $end = $formation['date_end'];

        $sql2 = $bdd->query("SELECT AVG(rate) FROM `$id`");
        $sql2->execute();
        $data = $sql2->fetch();

        $rate = $data['AVG(rate)'];    
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/display-form.css">
    <link rel="icon" type="image/png" href="img/favicon.png" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title><?php echo $title?></title>
</head>

<body>
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="index.php">Accueil</a>
        <a href="formation.php">Formations</a>
        <a href="formateur.php">Formateurs</a>
        <?php
            if(isset($_SESSION['user'])) {
                echo "<a class='login' href='login/deconnexion.php'>Déconnexion</a>";
                echo "<a class='login' href='login/landing.php'>Panel d'Administration</a>";
                echo "<a class='login' style='font-size: 2rem' href=''><i class='fas fa-cogs'></i></a>";
            } else {
                echo "<a class='login' href='login/index.php'>Connexion</a>";
            }
        ?>
    </div>
    <div id="main">
        <header>
            <div class="top-cont">
                <div class="top-title">
                    <h1 class="title">FC PRO</h1>
                </div>
                <span class="menu" onclick="openNav()"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABmJLR0QA/wD/AP+gvaeTAAAAg0lEQVRoge3WwQmDQBSE4RkrSTN7sQ5BsB9BSCGBbUZL8SDCEhCTEHi78H+3fW8P824jAQDwO5ePlFJve5b0CMrzqU3SlHN+nYOu3NpeVP8R0pHxWQ66i4/NeT9klLRGBPnSanuIDgEAAHCDGh+MGl8bajwAAGgBNT4YNb421HgAwF/tiw8eHFFMpCQAAAAASUVORK5CYII="></span>
                <script>
                    function openNav() {
                        document.getElementById("mySidenav").style.width = "15rem";
                        // document.getElementById("main").style.marginLeft = "250px";
                    }

                    function closeNav() {
                        document.getElementById("mySidenav").style.width = "0";
                        // document.getElementById("main").style.marginLeft = "0";
                    }
                </script>
            </div>
        </header>
        <main>
            <div class="container">
                <div class="body">
                    <h1 class="title-form"><?php echo $title?></h1>
                    <p class="content-form"><?php echo $content?></p>
                </div>
                <div class="info">
                    <div class="info-left">
                        <img class="info-schedule" src="img/scheduleb.png"/>
                        <div class="info-left-p">
                            <p>Date de début : <?php echo $start ?></p>
                            <p>Date de fin : <?php echo $end ?></p>
                        </div>
                    </div>
                    <div class="info-middle">
                        <img class="info-rating" src="img/ratingw.png">
                        <div class="rate-system">
                            <p><a href="rating/display-rate-form.php?id=<?php echo $id?>">Note de la formation : <?php echo round($rate, 1)?>/5</a></p>

                        <?php } else { header('Location:formations.php'); die(); } ?>
                        </div>
                    </div>
                    <div class="info-right">
                        <img class="info-file" src="img/filew.png"/>
                        <div class="link-info-file">
                            <a class='link-form' href='readfile/read.php?name=<?php echo $file?>' target='_blank'>Consulter la Documentation</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer>
            <p>FC PRO &copy; 2022 | Tout droit réservé</p>
        </footer>
    </div>
</body>

</html>