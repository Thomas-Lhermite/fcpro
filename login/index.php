<!DOCTYPE html>
<html lang="FR-fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="../img/favicon.png" />
        <link rel="stylesheet" href="../css/login-form.css">
        <title>Connexion</title>
    </head>
    <body>
        <header>

        </header>
        <main>
            <div class="container">
                <div class="login-form">
                    <div>
                        <form action="connexion.php" method="post">
                            <h2 class="text-center">Connexion</h2>
                            <?php 
                                if(isset($_GET['login_err']))
                                {
                                    $err = htmlspecialchars($_GET['login_err']);

                                    switch($err)
                                    {
                                        case 'password':
                                        ?>
                                            <div class="alert alert-danger">
                                                <strong>Erreur : </strong> mot de passe ou nom d'utilisateur incorrect
                                            </div>
                                        <?php
                                        break;
                                        case 'already':
                                        ?>
                                            <div class="alert alert-danger">
                                                <strong>Erreur : </strong> mot de passe ou nom d'utilisateur incorrect
                                            </div>
                                        <?php
                                        break;
                                    }
                                }
                                ?>        
                            <div class="form-group">
                                <input type="username" name="username" class="form-control" placeholder="Nom d'Utilisateur" required="required" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Mot de Passe" required="required" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn-login">Connexion</button>
                            </div>   
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <footer>
            <p>FC PRO &copy; 2022 | Tout droit réservé</p>
        </footer>
    </body>
</html>