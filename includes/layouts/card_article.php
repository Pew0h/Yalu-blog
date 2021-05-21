


<section class="blog-area section">
    <div class="container">

        <div class="row">
<?php
foreach (Article::getArticles() as $article) {
    $img = $article['image'];

    if (!empty($img)){ ?>
        <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="single-post post-style-1">

                        <div class="blog-image"><img src="<?= $article['image']?>" alt="Blog Image"></div>

                        <div class="blog-info">

                            <h6><a href="#"><b><?= $article['nom']?></b></a></h6>


                            <h4 class="title"><a href="#"><b>
                                        <?= $article['titre']?>
                                    </b></a></h4>




                            <ul class="post-footer">
                                <li><a href="#"><i class="ion-filing"></i><?= $article['date_creation']?></a></li>
                                <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>

                            </ul>

                        </div><!-- blog-info -->
                    </div><!-- single-post -->
                </div><!-- card -->
            </div><!-- col-lg-4 col-md-6 avec photo -->
    <?php }else{ ?>
        <div class="col-lg-4 col-md-6">
            <div class="card h-100">

                <div class="single-post post-style-2 post-style-3">

                    <div class="blog-info">

                        <h6><a href="#"><b><?= $article['nom']?></b></a></h6>

                        <h4 class="title"><a href="#"><b><?= $article['titre']?></b></a></h4>

                        <p><?= $article['contenu']?></p>


                        <ul class="post-footer">
                            <li><a href="#"><i class="ion-filing"></i><?= $article['date_creation']?></a></li>
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