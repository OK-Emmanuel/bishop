<?php 
session_start(); 
include('./admin_inc/authentication.php');
 include '../includes/db.php';
?>
<?php 
// Time to handle form processes
if (isset($_POST['add_post'])) {
    // Get form inputs
    $post_title = mysqli_real_escape_string($connection, $_POST['post_name']);
    $post_slug = mysqli_real_escape_string($connection, $_POST['post_slug']);
    $post_content = mysqli_real_escape_string($connection, $_POST['post_content']);
    $post_category = mysqli_real_escape_string($connection, $_POST['post_category']);
    $meta_title = mysqli_real_escape_string($connection, $_POST['meta_title']);
    $meta_keywords = mysqli_real_escape_string($connection, $_POST['meta_keywords']);
    $meta_description = mysqli_real_escape_string($connection, $_POST['meta_description']);
    $author = mysqli_real_escape_string($connection, $_POST['author']);


   $meta_title = $_POST['meta_title'];
   $meta_keywords = $_POST['meta_keywords'];
   $meta_description = $_POST['meta_description'];
   $author = $_POST['author'];

   $image = $_FILES['image']['name'] ;
   // Rename Image
   // Check image extension if it's original image
   $image_extension = pathinfo($image, PATHINFO_EXTENSION);
   $filename = $post_title. " - bishop-oyedola-blog." . $image_extension;
   // $status = $_POST['status'] == true ? '1':'0';


   // Send SQL Query
   $query = "INSERT INTO post(
    post_title,   
    post_url,
    post_content,    
    post_category, 
    meta_title,      
    meta_description,
    post_image, 
    post_author) VALUES(
    '$post_title', '$post_slug', '$post_content', '$post_category', '$meta_title', '$meta_description', '$filename', '$author')";

   $query_run = mysqli_query($connection, $query);
   if ($query_run) {
    // move uploaded images to general images folder
      move_uploaded_file($_FILES['image']['tmp_name'], '../images/'.$filename);
      $_SESSION['SuccessMessage'] = "New Post Successfully Published";
      header("location: posts.php");
      exit(0);
   }else{
      $_SESSION['ErrorMessage'] = "Something went wrong. Please try again";
      header("location: new-post.php");
      exit(0);
   }

}
?>
<?php include('admin_inc/ad-header.php'); ?>
   <div class="container-fluid px-4">

        <h1 class="mt-4">Administrators</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item ">Add New Post</li>
        </ol>
        <?php include '../includes/sessions.php'; ?>

        <div class="row"> 
        	<div class="col-md-9">
        		<div class="card shadow">
        			<div class="card-header">
        				<h4>Add New Post 
                            <a href="posts.php"><button class="btn btn-primary float-end">All Posts</button></a></h4>
        			</div>
        			<div class="card-body">
                        
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="author" value="<?= $_SESSION['auth_user']['user_full_name']; ?>">

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="Name">Post Title</label>
                                    <input type="text"  name="post_name" id="Name" class="form-control" >
                                </div>
                            


                                <div class="col-md-12 mb-3">
                                        <label for="Slug">Post Content</label>
                                        <textarea name="post_content"  class="form-control" id="" cols="30" rows="20"></textarea>
                                </div>

                                <div class="col-md-12 mb-3">
                                        <input type="submit" class="w-100 btn btn-primary" name="add_post" value="Publish">
                                </div>

                            </div>
                </div>
            </div>
        </div>

        <!-- Start side panel -->

         <div class="col-md-3">

                    <div class="mb-5">
                    <input type="submit" class="btn btn-success float-end " name="add_post" value="Publish Post"></a>
                    </div>

                     <!-- New Image-->
                    <div class="mb-3">
                    <label for="Image">Select New Featured Image</label>
                    <input type="file" id="Image" name="image" class="form-control">
                    </div>

                     <div class="col mb-3">
                                <label for="Name">Category</label>
                                <?php
                                $displayCat = "SELECT * FROM categories ";
                                $displayCatQuery = mysqli_query($connection, $displayCat);
                                if (mysqli_num_rows($displayCatQuery) > 0) {
                                ?>
                               <select name="post_category" id="" class="form-control" required>
                                <option value="">--Select Category--</option>
                                <?php   foreach ($displayCatQuery as $CatItem) {?>

                                    <option value="<?= $CatItem['cat_id']?>"><?= $CatItem['cat_title']?></option>
                                <?php } ?>
                               </select>
                                <?php
                                }else{
                                    echo "No category found";
                                }
 
                                 ?>
                               
                    </div>

                    <div class="card mb-3">
                        <div class="card-header">Slug (Post URL)</div>
                        <input type="text"  id="Email" name="post_slug" class="form-control">
                    </div>



                     <!-- Meta title -->
                    <div class="card mb-4">
                        <div class="card-header">Meta Title</div>
                        <input type="text" id="Meta"   name="meta_title" class="form-control">
                    </div>

                    <!-- Meta Keywords -->
                     <div class="card mb-3">
                       <div class="card-header">Meta Keyword</div>
                        <textarea name="meta_keywords" class="form-control resize-none" id="keyword" cols="30" rows="4"> </textarea> 
                    </div>

                    <!-- Meta Description -->
                    <div class="card mb-3">
                        <div class="card-header">Meta Description</div>
                        <textarea name="meta_description" class="form-control" id="MD" cols="30" rows="4"> </textarea>
                    </div>
                   
                </div>
                </form>

     </div>
<?php include('admin_inc/ad-footer.php') ?>

