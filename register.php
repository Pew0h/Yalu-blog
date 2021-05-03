<html>
<head>
    <meta charset="UTF-8"/>
    <link href="./includes/css/login.css" rel="stylesheet" id="login-css">
    <link href="./includes/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="./includes/js/bootstrap.min.js"></script>
    <script src="./includes/js/jquery.min.js"></script>
    <title>Register - Yalu Blog</title>
</head>

<body id="RegisterForm" style="margin: 0">
<form method="POST">
    <div class="container">
        <div class="login-form">
            <div class="main-div">
                <div class="panel">
                    <h1 style="padding-bottom: 20px">Yalu Blog</h1>
                </div>
                <form id="Login">
                    <div class="form-group">
                        <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Pseudo">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
                    </div>
                    <button type="submit" class="btn btn-primary">S'enregistrer</button>
                    <div class="form-group">
                        <br>
                        <a href="./inscription.php">Pas encore inscrit ?</a>
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


