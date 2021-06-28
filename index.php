<?php
require_once ('./includes/layouts/header.php');
require_once('./includes/layouts/header.php');
?>

<section class="blog-area section">
    <div class="container">
        <div id="article" class="row">
        </div>
    </div>
</section>

<?php

require_once('./includes/layouts/footer.php');
?>

<script type="text/javascript">
    $(document).ready(function(){
        loadMoreData();
        function loadMoreData(page){
            var get_id = '<?php if(isset($_GET['id'])) echo $_GET['id'];?>';
            $.ajax({
                url : "loadArticleData.php",
                type: "GET",
                cache:false,
                data:{page_no:page, id:get_id},
                success:function(data){
                    if (data) {
                        $("#show-more-div").remove(); // On retire le bouton car il est ajouté après
                        $("#article").append(data); // on ajoute les articles
                        if ($("#page-max").val() == $("#page").val()) // on vérifie si c'est le dernier article
                            $("#show-more-div").remove(); // si c'est le dernier article, on enlève le bouton
                    }else{
                        $("#show-more-div").remove(); // si aucune donnée on enlève le bouton
                    }
                }
            });
        }
        $(document).on('click', '#show-more', function(){
            loadMoreData($("#page").val()); // On load les articles à partir du dernier index chargé
        });

    });
</script>
