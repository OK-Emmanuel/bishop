<?php 
ob_start(); 
$Page = $_SERVER['PHP_SELF'];
?>

<!DOCTYPE html>
<html lang="eng">

<head>
    <title>Bishop OJ Oyedola</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="images/bishop.ico" type="image/x-icon">
    <meta name="keywords" content="Bishop OJ Oyedola, Rich Pastors, Ministers to Ministers, Christ House International" />
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
    <!-- // AOS file -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
   
</head>

<body>
    <!-- inner banner -->
    <section class="inner-banner-w3ls d-flex flex-column justify-content-center align-items-center">
        <!-- header -->
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-gradient-secondary">
                <h1>
                    <a class="navbar-brand" href="index.php">
                        Bishop Oyedola
                    </a>
                </h1>
                <button class="navbar-toggler ml-md-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-lg-auto text-center">
                        <li class="nav-item  mr-lg-3 mt-lg-0 mt-3">
                            <a class="nav-link" href="index.php">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item <?php if($Page == "/bishop/about.php"){echo "active";} ?> mr-lg-3 mt-lg-0 mt-3">
                            <a class="nav-link" href="about.php">about</a>
                        </li>
 			<li class="nav-item <?php if($Page == "/bishop/blog.php" || $Page == "/bishop/single-post.php" ){echo "active";} ?> mr-lg-3 mt-lg-0 mt-3">
                            <a class="nav-link" href="blog.php">Blog</a>
                        </li>
                        <!--<li class="nav-item dropdown mr-lg-3 mt-lg-0 mt-3">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                Dropdown
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="gallery.php">gallery</a>
                                <a class="dropdown-item scroll" href="#team">team</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="index.php">explore</a>
                            </div>
                        </li>-->
                        <li class="nav-item mr-lg-3 <?php if($Page == "/bishop/contact.php"){echo "active";} ?> mt-lg-0 mt-3">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                    </ul>
                </div>

            </nav>
        </header>
        <!-- //header -->
    </section>
    <!-- //inner banner -->
    <!-- breadcrumbs -->
    <nav aria-label="breadcrumb" data-aos="fade-down" data-aos-duration="1500">
        <ol class="breadcrumb d-flex justify-content-center bg-theme">
            <li class="breadcrumb-item">
                <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page" data-aos="zoom-out" data-aos-duration="1500">
                <?php if($Page == "/bishop/contact.php"){echo "Contact";}
                    elseif ($Page == "/bishop/about.php") {echo "About" ;}
                    elseif ($Page == "/bishop/blog.php") {echo "Blog"; }
                    else{echo "Blog";}
                     ?></li>
                    
        </ol>
    </nav>
    <!-- //breadcrumbs -->