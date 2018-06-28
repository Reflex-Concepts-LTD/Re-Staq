<section class="page">
    <!-- ***** Page Top Start ***** -->
    <div class="cover" data-image="images/photos/parallax.jpg">
        <div class="page-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Blog</h1>
                    </div>
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li><a href="?">Home</a></li>
                            <li class="active">Blog</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Page Top End ***** -->

    <!-- ***** Page Content Start ***** -->
    <div class="page-bottom pbottom-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="blog-list">
                        <div class="row">
                            <?php require_once 'modules/inc/blog/featured.php'; ?>
                            <?php require_once 'modules/inc/blog/posts_standard.php'; ?>
                        </div>
                    </div>

                    <?php require_once 'modules/inc/blog/pagination.php'; ?>
                </div>

                <?php require_once 'modules/inc/blog/aside.php'; ?>
            </div>
        </div>
    </div>
    <!-- ***** Page Content End ***** -->
</section>