<?php include('includes/db.php'); ?>
<?php include('includes/header.php');?> 
<?php include ('includes/functions.php');?>
<?php 
if (!isset($_GET['postid'])) {
   header('location: blog.php');
}else{
    $SearchQueryParameter = $_GET['postid'];
}
?>
<!-- Treat the posted comment -->
<?php 
if (isset($_POST['submit_comment'])) {
    $comment = Sanitizer($_POST['comment']);
    $commenter = Sanitizer($_POST['comment-name']);
    $commentPostId = Sanitizer($_POST['commentPstid']);
    $commentEmail = Sanitizer($_POST['comment-email']);
    $CommentTime =  date('M-d-Y');;

    $export = "INSERT INTO comments(
      commenter, 
      comment_content, 
      post_id, 
      commenter_email, 
      comment_time)
    VALUES('$commenter', '$comment', '$commentPostId', '$commentEmail', '$CommentTime')";
    $query = mysqli_query($connection, $export);
    if ($query) {
         //echo "<script>window.alert('Your comment has been successfully submitted')</script>";
         header("location: single-post.php?postid=$commentPostId");
     }else{
        echo  "<script>window.alert('Something went wrong. Please try again later')</script>";
     }

}
?>

 <!-- Page content-->
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Fetch Post content-->

                    <?php 
                     $sql = "SELECT * FROM post WHERE post_id = '$SearchQueryParameter'";
                     $query = mysqli_query($connection, $sql);
                     while ($rows = mysqli_fetch_assoc($query)) {
                         $GLOBALS['PostId'] = $rows['post_id'];
                      ?>
                    <article>
                        <!-- Post header-->
                        <header class="mb-4">
                            <!-- Post title--> 
                            <h1 class="font-weight-bold text-uppercase mb-1"><?= $rows['post_title'];?> </h1>
                            <!-- Post meta content-->
                            <div class="text-muted  mb-2">Posted on January 1, 2022 by <?= $rows['post_author'];?></div>
                            <!-- Post categories-->
                            <!-- <a class="badge bg-primary text-white text-decoration-none link-light" href="#!"><?//= $rows['post_category'];?></a> -->
                            
                        </header>
                        <!-- Preview image figure-->
                        <figure class="mb-4"><img class="img-fluid rounded" src="images/<?= $rows['post_image']; ?>" alt="..." /></figure>
                        <!-- Post content-->
                        <section class="mb-5">
                            <p class="fs-5 mb-4 text-justify"> <?= $rows['post_content'];?></p>
                        </section>
                    </article>
                <?php }?>
                <hr>    

                <div class="comments">
              <h5 class="comment-title py-4">Comments</h5>
              <div class="comment d-flex mb-4">
                <div class="flex-shrink-0">
                 <!--  <div class="avatar avatar-sm rounded-circle">
                    <img class="avatar-img" src="admin/uploads/person-4.jpg" width="50%" alt="" class="img-fluid card-img">
                  </div> -->
                </div>
                <div class="flex-grow-1 ms-2 ms-sm-3">
                <!-- Get Comments Associated with each post -->
                    <?php 
                     $sql = "SELECT * FROM comments WHERE post_id='$SearchQueryParameter'";
                     $query = mysqli_query($connection, $sql);
                     if (mysqli_num_rows($query) <= 0) {
                         echo "There is no comment yet <br> Be the first to comment!";
                     }else{
                     while ($rows = mysqli_fetch_assoc($query)) {
                       
                      ?>
                  <div class="comment-meta d-flex align-items-baseline">
                    <h6 class="ms-0 font-weight-bold"> &bullet; <?= $rows['commenter'] ?></h6>
                    <span class="text-muted small ml-3"><?= $rows['commenter_email'] ?></span>
                  </div>
                  <div class="comment-body font-italic mb-5">
                    <?= $rows['comment_content'] ?>
                  </div>

                  
            <?php } }?>
                </div>
              </div>
            </div>
            <!-- End Comments -->

            <!-- ======= Comments Form ======= -->
            <hr>    
            <div class="row justify-content-center mt-5">
              <div class="col-lg-12">
                <h5 class="comment-title mb-3">Leave a Comment</h5>
                <div class="row">
                  <div class="col-lg-6 mb-3">
                     <form class="mb-4" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
                         <input type="hidden" name="commentPstid" value="<?php echo $GLOBALS['PostId']; ?>">
                    <label for="comment-name">Name</label>
                    <input type="text" class="form-control" name="comment-name" id="comment-name" placeholder="Enter your name">
                  </div>
                  <div class="col-lg-6 mb-3">
                    <label for="comment-email">Email</label>
                    <input type="text" class="form-control" name ="comment-email" id="comment-email" placeholder="Enter your email">
                  </div>
                  <div class="col-12 mb-3">
                    <textarea class="form-control" id="comment-message" placeholder="Type your comment here" name="comment" cols="30" rows="10"></textarea>
                  </div>
                  <div class="col-12">
                    <input type="submit" class="btn btn-danger w-100 mb-5" name="submit_comment" value="Post comment">
                  </div>
                </div>
              </div>
            </div><!-- End Comments Form -->


                  
                 
                </div>


                <!-- Side widgets-->
                <div class="col-lg-4">
                    <!-- Search widget-->
                    <div class="card mb-4">
                        <div class="card-header">Search</div>
                        <div class="card-body">
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                                <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                            </div>
                        </div>
                    </div>
                    <!-- Categories widget-->
                    <div class="card mb-4">
                        <div class="card-header">Categories</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <?php 
                                     $sql = "SELECT * FROM categories";
                                     $query = mysqli_query($connection, $sql);
                                     while ($rows = mysqli_fetch_assoc($query)) {
                                      ?>
                                    <ul class="list-unstyled mb-0">
                                        <li><a href="#!"><?= $rows['cat_title'] ?></a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <!-- <li><a href="#!">JavaScript</a></li> -->
                                        <?php }?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Side widget-->
                    <div class="card mb-4 shadow">
                        <div class="card-header">Recent Posts</div>
                     <?php 
                     $sql = "SELECT * FROM post LIMIT 5";
                     $query = mysqli_query($connection, $sql);
                     while ($rows = mysqli_fetch_assoc($query)) {
                        $postid = $rows['post_id'];
                      ?>
                        <div class="card-body">
                           <a href="single-post.php?postid=<?=$postid ?>" target="_blank"><?= $rows['post_title']; ?></a>
                           <hr class="my-0">
                        </div>
                    <?php }?>
                    </div>

                </div>
            </div>
        </div>
         <?php include('includes/footer.php')?>