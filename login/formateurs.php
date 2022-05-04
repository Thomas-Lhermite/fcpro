<?php
    session_start();
    if(!isset($_SESSION['user']))
        header('Location:index.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../img/favicon.png" />
    <link rel="stylesheet" href="../css/formations.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Espace membre</title>
</head>

<body>   
<div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="../index.php">Retour sur le site</a>
        <button class="down-btn">Gestion du Site <i class="fas fa-angle-down"></i></button>
        <div class="down">
            <a class='login' href="user.php"><i class="fas fa-caret-right"></i> Gestion des utilisateurs</a>
            <a class='login' href="formations.php"><i class="fas fa-caret-right"></i> Gestion des formations</a>
            <a class='login' href="file.php"><i class="fas fa-caret-right"></i> Gestion des fichiers</a>
            <a class='login' href="formateurs.php"><i class="fas fa-caret-right"></i> Gestion des formateurs</a>
        </div>
        <a class='login' href="deconnexion.php">Déconnexion</a>
        <a class='login' style='font-size: 2rem' href=''><i class='fas fa-cogs'></i></a>
    </div>
    <div id="main">
    <header>
            <div class="top-cont">
                <div class="top-title">
                    <h1 class="title">FC PRO</h1>
                </div>
                <div class="info-user">
                    <p>vous êtes connecté en tant que <span class="info-session-user"><?php echo $_SESSION['user']?></span></p>
                </div>
                <span class="menu" onclick="openNav()"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABmJLR0QA/wD/AP+gvaeTAAAAg0lEQVRoge3WwQmDQBSE4RkrSTN7sQ5BsB9BSCGBbUZL8SDCEhCTEHi78H+3fW8P824jAQDwO5ePlFJve5b0CMrzqU3SlHN+nYOu3NpeVP8R0pHxWQ66i4/NeT9klLRGBPnSanuIDgEAAHCDGh+MGl8bajwAAGgBNT4YNb421HgAwF/tiw8eHFFMpCQAAAAASUVORK5CYII="></span>
                <script>

                    const dropdown = document.querySelectorAll('.down-btn');

                    dropdown.forEach((btn) => {
                    btn.addEventListener('click', (e) => {

                        downText = btn.nextElementSibling;
                        downText.classList.toggle('show');
                        document.getElementById("mySidenav").style.width = "15rem";
                    });
                    });;
                    

                    function openNav() {
                        document.getElementById("mySidenav").style.width = "15rem";
                    }

                    function closeNav() {
                        document.getElementById("mySidenav").style.width = "0";
                    }
                </script>
            </div>
        </header>
        <main>
            <div class="container">
                <div class="content">
                    <h3 class="title-stat">Utilisateurs :&nbsp;&nbsp;</h3>
                    <div class="msg-info-box">
                    </div>
                        <?php
                            require_once 'config.php';

                            $user = $_SESSION['user'];

                            $check = $bdd->prepare('SELECT * FROM users;');
                            $check->execute(array($user));

                            if($_SESSION['permissions'] === '**') {
                                echo "<table class='table'>";
                                echo "<thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Nom</th>
                                            <th>Permissions</th>
                                            <th>Modifier</th>
                                            <th>Réinitialiser</th>
                                            <th>Supprimer</th>
                                      </tr>
                                    </thead>";

                                while ($data = $check->fetch()) {
                                    if($data['id'] != 1) {
                                        if($data['id'] != $_SESSION['id']){
                                            echo "<tbody><tr>\n";
                                            echo "<td data-label='Identifiant'><strong>".    $data['id']    ."</strong></td>\n";
                                            echo "<td data-label='Nom'>".    $data['username']    ."</td>\n";
                                            echo "<td data-label='Permissions'>".    $data['permissions'] ."</td>\n";
                                            echo '<td data-label="Modifier"><div class="btn-table-color"><button><a href="crud/edit.php?id=' .$data['id']. '">Modifier</a></button></td>';
                                            echo '<td data-label="Réinitialiser"><div class="btn-table-color"><button><a href="crud/reset.php?id=' .$data['id']. '">Réinitialiser</a></button></td>';
                                            echo '<td data-label="Supprimer"><div class="btn-table-color"><button><a href="crud/delete.php?id=' .$data['id']. '">Supprimer</a></button></td>';
                                            echo "</tr></tbody>";
                                        }
                                    }
                                }
                                echo "</table>";
                                echo '<br/><br/><a href="crud/create-user.php" class="a-add-user">Ajouter un formateur</a>';           
                            } else {
                                echo"Vous ne possédez pas les permissions nécessaire pour visionner cette page !";
                            }
                        ?>
        <footer>
            <p>Copyright 2022 &copy; Fc-Pro | Tout droit réservés.</p>
        </footer>
    </div> 
</body>
</html>