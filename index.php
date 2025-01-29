<?php include 'includes/db.php'; ?>
<!DOCTYPE html>
<html lang="eng">

<head>
    <title>Bishop Oyedola || Christ House International </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8" />
    <meta name="keywords" content="Bishop OJ Oyedola, Minister to Minister, Christ House International" />
    <meta content="Olawuni Emmanuel Kayode - OK Emmanuel, Techifice" name="author">

   <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- Custom Theme files -->
    <link href="css/bootstrap.css" type="text/css" rel="stylesheet" media="all">
    <link href="css/style.css" type="text/css" rel="stylesheet" media="all">
    <!-- font-awesome icons -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <!-- //Custom Theme files -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Font File -->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Raleway" />
</head>
<body>
    <!-- banner -->
    <section class="banner d-flex flex-column justify-content-center align-items-center">
        <!-- header -->
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-gradient-secondary">
                <h1>
                    <a class="navbar-brand sm" href="index.php">
                        Bishop Oyedola
                    </a>
                </h1>
                <button class="navbar-toggler ml-md-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-lg-auto text-center">
                        <li class="nav-item active  mr-lg-3 mt-lg-0 mt-3">
                            <a class="nav-link" href="index.php">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item  mr-lg-3 mt-lg-0 mt-3">
                            <a class="nav-link" href="about.php">about</a>
                        </li>
                        <li class="nav-item  mr-lg-3 mt-lg-0 mt-3">
                            <a class="nav-link" href="blog.php">Blog</a>
                        </li>
                        <!-- <li class="nav-item dropdown mr-lg-3 mt-lg-0 mt-3">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                Dropdown
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="gallery.php">gallery</a>
                                <a class="dropdown-item" href="about.php">team</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item scroll" href="#explore">explore</a>
                            </div>
                        </li> -->
                        <li class="nav-item mr-lg-3 mt-lg-0 mt-3">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                    </ul>
                </div>

            </nav>
        </header>
        <!-- //header -->
        <!-- banner text -->
        <div class="container">
            <div class="banner_text_wthree_pvt text-center">
                <h3 class="home-banner-w3 font-weight-900" data-aos="zoom-out" data-aos-duration="2000">Bishop O.J. Oyedola </h3>

                <!-- ============== LOGIN/SIGNUP MODAL===================== -->
               <!--  <div class="d-sm-flex justify-content-center">
                    <button type="button" class="btn  w3ls-btn bg-theme" data-toggle="modal" aria-pressed="false"
                        data-target="#exampleModal">login
                    </button>
                    <button type="button" class="btn  ml-2 w3ls-btn" data-toggle="modal" data-target="#exampleModal1">register</button>

                </div>
                 -->

            </div>
        </div>
        <!-- //banner text -->
    </section>
    <!-- //banner -->
    <!-- about -->
    <?php 
    include_once('includes/about.php') ?>
    <!-- //about -->
    <?php include_once 'includes/explore.php'; ?>

    

    <!-- blog -->
    <section class="blog_w3ls align-w3" id="posts" data-aos="fade-up">
        <div class="container">
            <div class="wthree_pvt_title text-center">
                <h4 class="w3pvt-title">blog posts
                </h4>
                <a href="blog.php"><span class="sub-title">read Inspiring Articles</span></a>
            </div>
            <div class="row space-sec">
                <!-- blog grid -->
                    <?php
                       $query = "SELECT post.*, categories.cat_title
                            FROM post, categories 
                            WHERE post.post_category=categories.cat_id LIMIT 3";
                        $query_run = mysqli_query($connection, $query);
                        if ($query_run):
                            while ($rows = mysqli_fetch_assoc($query_run)): ?>
                <div class="col-lg-4 col-md-6 mt-sm-0 mt-5">
                                <div class="card mb-5">
                        <div class="card-header p-0 position-relative">
                            <a href="single-post.php?postid=<?=$rows['post_id'];?>" >
                                <img class="card-img-bottom" src="images/<?= $rows['post_image']; ?>" alt="Card image cap">
                                <span class="post-icon bg-theme1"><?= $rows['cat_title']; ?></span>

                            </a>
                        </div>
                        <div class="card-body">
                            <h5 class="blog-title card-title font-weight-bold">
                                <a href="single-post.php?postid=<?=$rows['post_id'];?>"
                                    role="button" class="text-theme1"><?= $rows['post_title']; ?></a>
                            </h5>
                            <p><?php if ($rows['post_content'] > strlen(150)) {
                                                echo substr($rows['post_content'], 0, 150) . "...";
                                            } ?></p>
                            <a href="single-post.php?postid=<?=$rows['post_id']; ?>"><button type="button" class="btn btn-outline-danger mt-2">
                                Full Post &raquo;
                            </button>
                            </a>
                        </div>
                    </div>
                </div>
                    <?php          
                    endwhile;
                    endif;
                    ?>
                <!-- //blog grid -->
              
                    
                    
            
            </div>
        </div>
    </section>
    <!-- //blog -->
   <?php include("includes/footer.php") ?>