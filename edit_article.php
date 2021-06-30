<?php
require_once ('./includes/layouts/header.php');

if ($_GET['id'])
{
    $id = $_GET['id'];
    if (!Article::getArticleById($id)){ // Si l'article n'existe pas
        header('Location: index.php');
        exit;
    }
}
else{
    header('Location: index.php');
    exit;
}

if (isset($_SESSION['user_id'])){
    if (Role::getUserRole($_SESSION['user_id']) == 'Administrateur' || Article::getArticleInformation($id, 'id_utilisateur') == $_SESSION['user_id']){
    }
    else{
        header('Location: index.php');
        exit;
    }
}

else
{
    header('Location: index.php');
    exit;
}

if (isset($_POST['modify_article']))
{
    if (isset($_POST['titre']) && !empty($_POST['titre']) && isset($_POST['contenue-html']) && !empty($_POST['contenue-html']))
    {
        if (strlen($_POST['titre']) > 100)
        {
            $_SESSION['alert'] = Main::alert('danger', 'Le titre ne peut pas dépasser 100 caractères !');
        }
        else
        {
            Article::updateArticle($id, utf8_decode($_POST['titre']), utf8_decode($_POST['contenue-html']), utf8_decode($_POST['select_categorie']));
            header('location: article.php?id='.$id);
        }
    }
    else{
        $_SESSION['alert'] = Main::alert('danger', 'Veuillez remplir tous les champs requis !');
    }
}

?>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <h2> Modification de l'article </h2>
    <br>
    <center>
        <form id="article-form" method="POST" action="" enctype="multipart/form-data">
            <div class="shadow p-3 mb-5 bg-white rounded" style="width: 70%;">
                <?php
                if(isset($_SESSION['alert'])) {
                    echo $_SESSION['alert'];
                }
                ?>
                <div class="form-group">
                    <label class="form-inline" style="font-weight: bold">Titre de l'article</label>
                    <input type="text" class="form-control" id="titre" name="titre" maxlength="100" value="<?= utf8_encode(Article::getArticleInformation($id, 'titre')) ?>">
                </div>
                <div class="form-group">
                    <label class="form-inline" style="font-weight: bold">Contenue de l'article</label>
                    <div style="height: 350px" id="editeur-contenue" name="editeur-contenue">
                        <?= utf8_encode(Article::getArticleInformation($id, 'contenu')) ?>
                    </div>
                </div>
                <div class="form-group form-inline">
                    <input type="hidden" name="contenue-html" id="contenue-html">
                </div>
                <div class="form-group form-inline">
                    <label class="d-inline-block" style="font-weight: bold">Catégorie de l'article : &nbsp;</label>
                    <select class="form-control w-25" id="select_categorie" name="select_categorie">
                        <?php
                        foreach (Categorie::getCategories() as $category)
                        {
                            if (Article::getArticleInformation($id, 'id_categorie') == $category['id_categorie'])
                                echo '<option selected="selected" value="'.$category['id_categorie'].'">'.$category['nom'].'</option>';
                            else
                                echo '<option value="'.$category['id_categorie'].'">'.$category['nom'].'</option>';
                        }

                        ?>
                    </select>
                </div>
                <div class="col text-center">
                    <button style="width: 200px" type="submit" name="modify_article" id="modify_article" class="button">Modifier l'article</button>
                </div>
            </div>
        </form>>
    </center>
</body>
<script>
    var quill = new Quill('#editeur-contenue', {
        modules: {
            toolbar: [
                [{ header: [3, 4, false] }],
                [{ 'font': [] }],
                [{ 'color': [] }, { 'background': [] }],
                ['bold', 'italic', 'underline', 'strike', 'blockquote'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                [{ 'indent': '-1' }, { 'indent': '+1' }],          // outdent/indent
                [{ 'align': [] }],
                ['link'],
            ]
        },
        theme: 'snow'  // or 'bubble'
    });


    // When the submit button is clicked, update output
    $('#modify_article').on('click', () => {
        // Get HTML content
        var html = quill.root.innerHTML;
        $('#contenue-html').val(html)
        //alert(html);
    })
</script>
</html>

<?php
require_once ('./includes/layouts/footer.php');
?>