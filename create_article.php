<?php
require_once ('./includes/layouts/header.php');

if (!isset($_SESSION['user_id'])){
    header('Location: index.php');
    exit;
}

if (isset($_POST['add_article']))
{
    $article_image = NULL;
    echo var_dump($_POST);
    // Gestion de l'ajout d'une image
    if (isset($_FILES['image_article']))
    {
        $tmpFile = $_FILES['image_article']['tmp_name'];
        $newPath = 'includes/images/article/'. $_FILES['image_article']['name'];
        if(!move_uploaded_file($tmpFile ,$newPath))
        {
            $_SESSION['alert'] = Main::alert('danger', 'Impossible de charger l\'image');
        }
        $article_image = $_FILES['image_article']['name'];
    }
    if (isset($_POST['titre']) && !empty($_POST['titre']) && isset($_POST['contenue-html']) && !empty($_POST['contenue-html']))
    {
        Article::insertArticle($_POST['titre'], $_POST['contenue-html'], $article_image, $_POST['select_categorie'], $_SESSION['user_id']);
        $_SESSION['alert'] = Main::alert('success', 'Ajout de l\'article avec succès !');
    }
    else{
        $_SESSION['alert'] = Main::alert('danger', 'Veuillez remplir tous les champs requis !');
    }
}

?>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <h2> Création d'un article </h2>
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
                    <input type="text" class="form-control" id="titre" name="titre" placeholder="Titre">
                </div>
                <div class="form-group">
                    <label class="form-inline" style="font-weight: bold">Contenue de l'article</label>
                    <div style="height: 200px" id="editeur-contenue" name="editeur-contenue">
                    </div>
                </div>
                <div class="form-group form-inline">
                    <label style="font-weight: bold">Choisir une image : &nbsp;</label>
                    <input type="file" name="image_article">
                    <input type="hidden" name="contenue-html" id="contenue-html">
                </div>
                <div class="form-group form-inline">
                    <label class="d-inline-block" style="font-weight: bold">Catégorie de l'article : &nbsp;</label>
                    <select class="form-control w-25" id="select_categorie" name="select_categorie">
                        <?php
                        foreach (Categorie::getCategories() as $category)
                        {
                            echo '<option value="'.$category['id_categorie'].'">'.$category['nom'].'</option>';
                        }

                        ?>
                    </select>
                </div>
                <div class="col text-center">
                    <button style="width: 200px" type="submit" name="add_article" id="add_article" class="button">Ajouter l'article</button>
                </div>
            </div>
        </form>>
    </center>
</body>
<script>
    var quill = new Quill('#editeur-contenue', {
        modules: {
            toolbar: [
                [{ header: [1, 2, false] }],
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
    $('#add_article').on('click', () => {
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