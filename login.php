<?php
    session_start();
    $_SESSION['alert'] = '';
    require_once('./includes/class/User.php');
    require_once('./includes/class/Main.php');

    if(isset($_POST['pseudo']) && isset($_POST['password']) && !empty($_POST['pseudo']) && !empty($_POST['password'])){
        if(User::isUserExist($_POST['pseudo'], $_POST['password'])){
            $_SESSION['user_id'] =  User::getUserId($_POST['pseudo'], $_POST['password']);
            //echo print_r($_SESSION, true);
            $_SESSION['alert'] = '';
        }
        else
        {
            $_SESSION['alert'] = Main::alert('danger', 'Pseudo ou mot de passe incorrect');
        }
    }
?>

<html>
<head>
    <meta charset="UTF-8"/>
    <link href="./includes/css/login.css" rel="stylesheet" id="login-css">
    <link href="./includes/css/style.css" rel="stylesheet" id="css">
    <link href="./includes/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="./includes/js/bootstrap.min.js"></script>
    <script src="./includes/js/jquery.min.js"></script>
    <title>Connexion - Yalu Blog</title>
</head>

<body id="LoginForm">
<form method="POST">
    <div class="container">
        <div class="login-form">
            <div class="main-div">
                <div class="panel">
                    <h1>Yalu Blog</h1>
                    <p>Veuillez entrer votre pseudo et votre mot de passe</p>
                </div>
                <?php
                if(isset($_SESSION['alert'])) {
                    echo $_SESSION['alert'];
                }
                ?>
                <form id="Login">
                    <div class="form-group">
                        <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Pseudo">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
                    </div>
                    <button type="submit" class="btn btn-primary">Se connecter</button>
                    <div class="form-group">
                        <br>
                        <a href="./register.php">Pas encore inscrit ?</a>
                        <br>
                        <a href="./index.php">Accéder au site sans compte ?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</form>
</body>
</html>
