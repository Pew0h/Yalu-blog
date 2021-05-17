<?php
require_once('../includes/layouts/header_admin.php');


?>
<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h2><i class="fas fa-home"></i> Dashboard</h2>
                <hr>
            </div>
            <div class="col-md-3">
                <div class="card-counter users">
                    <i class="fas fa-users"></i>
                    <span class="count-numbers"><?= User::getNumberUsers(); ?></span>
                    <span class="count-name">Utilisateurs</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-counter articles">
                    <i class="far fa-newspaper"></i>
                    <span class="count-numbers"><?= Article::getNumberArticles() ?></span>
                    <span class="count-name">Articles</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-counter commentary">
                    <i class="far fa-comments"></i>
                    <span class="count-numbers"><?= Commentaire::getNumberCommentaires() ?></span>
                    <span class="count-name">Commentaires</span>
                </div>
            </div><div class="col-md-3">
                <div class="card-counter category">
                    <i class="fas fa-list"></i>
                    <span class="count-numbers"><?= Categorie::getNumberCategories() ?></span>
                    <span class="count-name">Catégories</span>
                </div>
            </div>


        </div>
    </div>
</div>

</div>
</body>
</html>
