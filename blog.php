 <?php include('includes/header.php')?>
 <?php include 'includes/db.php'; ?>
   <section class="blog_w3ls align-w3" id="posts">
        <div class="container">
            <div class="wthree_pvt_title text-center">
                <h4 class="w3pvt-title">blog posts
                </h4>
                <span class="sub-title">read Inspiring Articles</span>
            </div>
            <div class="row space-sec">
                <!-- blog grid -->
                    <?php
                        $query = "SELECT post.*, categories.cat_title
                            FROM post, categories
                            WHERE post.post_category=categories.cat_id";
                            $query_run = mysqli_query($connection, $query);
                            while ($rows = mysqli_fetch_assoc($query_run)): ?>
                            
                <div class="col-lg-4 col-md-6 mt-sm-0 mt-5">
                                <div class="card mb-5">
                        <div class="card-header p-0 position-relative">
                            <a href="single-post.php?postid=<?=$rows['post_id'];?>" >
                                <img class="card-img-bottom"src="images/<?= $rows['post_image']; ?>" alt="Card image cap">
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
                <!-- //blog grid -->
               
                    
                    <?php          
                            endwhile;
                     
                    ?>
                
            </div>
        </div>
    </section>
    <!-- //blog -->
 <?php include('includes/footer.php')?>