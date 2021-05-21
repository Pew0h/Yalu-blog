


<section class="blog-area section">
    <div class="container">

        <div class="row">
<?php
foreach (Article::getArticles() as $article) {
    $img = $article['image'];
    $date = explode(" ",$article['date_creation']);
    $date_jour = $date[0];



    if (!empty($img)){
        $contenu_trunc = Article::truncate($article['contenu'], 75, '...', true); ?>
        <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="single-post post-style-1">

                        <div class="blog-image"><img src="<?= $article['image']?>" alt="Blog Image"></div>

                        <div class="blog-info">

                            <h6><a href="#"><b><?= $article['nom']?></b></a></h6>
                            <hr>


                            <h4 class="title"><a href="#"><b>
                                        <?= $article['titre']?>
                                    </b></a></h4>



                            <a href="#" class="button" ><i class="ion-pricetag"></i>  Voir l'article </a>



                            <ul class="post-footer">
                                <li><a href="#"><i class="ion-calendar"></i><?= $date_jour?></a></li>
                                <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>

                            </ul>

                        </div><!-- blog-info -->
                    </div><!-- single-post -->
                </div><!-- card -->
            </div><!-- col-lg-4 col-md-6 avec photo -->
    <?php }else{
        $contenu_trunc = Article::truncate($article['contenu'], 220, '...', true);


        ?>

        <div class="col-lg-4 col-md-6">
            <div class="card h-100">

                <div class="single-post">

                    <div class="blog-info">

                        <h6><a href="#"><b><?= $article['nom']?></b></a></h6>
                        <hr>

                        <h4 class="title"><a href="#"><b><?= $article['titre']?></b></a></h4>

                        <p class="blog-contenu"><?= $contenu_trunc?></p>

                        <a href="#" class="button"><i class="ion-pricetag"></i>  Voir l'article </a>



                        <ul class="post-footer">
                            <li><a href="#"><i class="ion-calendar"></i><?= $date_jour ?></a></li>
                            <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>

                        </ul>

                    </div><!-- blog-right -->

                </div><!-- single-post extra-blog -->

            </div><!-- card -->
        </div><!-- col-lg-4 col-md-6  sans photo-->
    <?php }

    } ?>





        </div>
    </div>
</section>