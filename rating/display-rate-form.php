<?php
session_start();
require_once '../login/config.php';

$title = null;
$rate = null;
$id = null;
$count = null;
$prctof5 = null;
$prctof4 = null;
$prctof3 = null;
$prctof2 = null;
$prctof1 = null;

global $count;
global $rate;
global $title;
global $id;
global $prctof5;
global $prctof4;
global $prctof3;
global $prctof2;
global $prctof1;

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = $bdd->prepare('SELECT * FROM formations WHERE id = ?');
    $sql->execute(array($id));
    $data = $sql->fetch();

    $title = $data['title'];

    $sql2 = $bdd->query("SELECT AVG(rate) FROM `$id`");
    $data = $sql2->fetch();

    $rate = $data['AVG(rate)'];  


} else {
    header('Location : ../formation.php');
}

?>

<!DOCTYPE html>
<html lang="FR-fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/display-rate-form.css">
    <link rel="icon" type="image/png" href="../img/favicon.png" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title><?php echo $title ?></title>
</head>
<body>
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="../index.php">Accueil</a>
        <a href="../formation.php">Formations</a>
        <?php
            if(isset($_SESSION['user'])) {
                echo "<a class='login' href='../login/deconnexion.php'>Déconnexion</a>";
                echo "<a class='login' href='login/landing.php'>Panel d'Administration</a>";
                echo "<a class='login' style='font-size: 2rem' href=''><i class='fas fa-cogs'></i></a>";
            } else {
                echo "<a class='login' href='../login/index.php'>Connexion</a>";
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
                <div class="cont-tot-info">
                    <div class="inline-title-star">
                        <div class="star-tot-p">
                            <h3>Note Total obtenu par la formation : </h3>
                        </div>
                        <div class="display-star">
                            <?php
                            
                                $ratecount = round($rate, 1);

                                for ($i = 1; $i <= $ratecount; $i++) {
                                    echo "<i class='fa fa-star' style='color: #36a9e1;'></i>";
                                    $rest = 5 - $i;
                                }
                                for ($i = 1; $i <= $rest; $i++) {
                                    echo "<i class='fa fa-star' style='color: #535050;'></i>";
                                }
                                echo "&nbsp;".$ratecount ."/5";

                            ?>
                        </div>
                        <div class="tot-review">
                            <?php
                                $sql = $bdd->prepare("SELECT * FROM `$id`");
                                $sql->execute();
                                $count = $sql->rowCount();

                                echo "<p class='nbr-tot-review'>".$count." évaluations</p>"
                            ?>
                        </div>
                        <div class="progress-bar-star">
                            <?php
                                $sql = $bdd->query("SELECT rate FROM `$id` WHERE rate = 5");
                                $data = $sql->rowCount();

                                $nbrof5 = $data / $count;
                                $prctof5 = $nbrof5 * 100;
                            ?>
                            <p class="nbr-label">5 étoiles :</p>
                            <div class="progressbar-cont">
                                <div class="progressbar" style="width:<?php echo $prctof5?>%"></div>
                            </div>
                            <div class="progressbar-text"><?php echo round($prctof5, 1)?>%</div>
                        </div>
                        <div class="progress-bar-star">
                            <?php
                                $sql = $bdd->query("SELECT rate FROM `$id` WHERE rate = 4");
                                $data = $sql->rowCount();

                                $nbrof4 = $data / $count;
                                $prctof4 = $nbrof4 * 100;
                            ?>
                            <p class="nbr-label">4 étoiles :</p>
                            <div class="progressbar-cont">
                                <div class="progressbar" style="width:<?php echo $prctof4?>%"></div>
                            </div>
                            <div class="progressbar-text"><?php echo round($prctof4, 1)?>%</div>
                        </div>
                        <div class="progress-bar-star">
                            <?php
                                $sql = $bdd->query("SELECT rate FROM `$id` WHERE rate = 3");
                                $data = $sql->rowCount();

                                $nbrof3 = $data / $count;
                                $prctof3 = $nbrof3 * 100;
                            ?>
                            <p class="nbr-label">3 étoiles :</p>
                            <div class="progressbar-cont">
                                <div class="progressbar" style="width:<?php echo $prctof3?>%"></div>
                            </div>
                            <div class="progressbar-text"><?php echo round($prctof3, 1)?>%</div>
                        </div>
                        <div class="progress-bar-star">
                            <?php
                                $sql = $bdd->query("SELECT rate FROM `$id` WHERE rate = 2");
                                $data = $sql->rowCount();

                                $nbrof2 = $data / $count;
                                $prctof2 = $nbrof2 * 100;
                            ?>
                            <p class="nbr-label">2 étoiles :</p>
                            <div class="progressbar-cont">
                                <div class="progressbar" style="width:<?php echo $prctof2?>%"></div>
                            </div>
                            <div class="progressbar-text"><?php echo round($prctof2, 1)?>%</div>
                        </div>
                        <div class="progress-bar-star">
                            <?php
                                $sql = $bdd->query("SELECT rate FROM `$id` WHERE rate = 1");
                                $data = $sql->rowCount();

                                $nbrof1 = $data / $count;
                                $prctof1 = $nbrof1 * 100;
                            ?>
                            <p class="nbr-label">1 étoiles :</p>
                            <div class="progressbar-cont">
                                <div class="progressbar" style="width:<?php echo $prctof1?>%"></div>
                            </div>
                            <div class="progressbar-text"><?php echo round($prctof1, 1)?>%</div>
                        </div>
                    </div>
                </div>
                <div class="cont-review">
                    <div class="all-review">
                        <?php
                        
                            $sql = $bdd->prepare("SELECT * FROM `$id`");
                            $sql->execute();
                            
                            while($data = $sql->fetch()) {
                                echo "<div class='review'>";
                                echo "<div class='review-grid'><h3 class='name-review'>".$data['name']."<h3>";
                                if(isset($_SESSION['user'])) {
                                    echo "<div class='review-trash'><a href='delete-review.php?id=".$data['id']."&fid=".$id."'><i class='fas fa-trash'></i></a></div>";
                                }
                                echo "</div><p class='rate'>Note : ".$data['rate']."</p>";
                                echo "<p class='content-review'>" .$data['review']. "</p>" ;
                                echo "</div>";
                            }
                        ?>
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