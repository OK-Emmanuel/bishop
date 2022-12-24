<?php 
session_start(); 
include('./admin_inc/authentication.php');
 include '../includes/db.php';
?>
<?php 
// Time to handle form processes
if (isset($_POST['update_post'])) {
    // Get form inputs
   $PostID = $_POST['PostID'];
   $post_title = $_POST['post_name'];
   $post_slug = $_POST['post_slug'];
   $post_content = $_POST['post_content'];
   $post_category = $_POST['post_category'];


   $meta_title = $_POST['meta_title'];
   $meta_keywords = $_POST['meta_keywords'];
   $meta_description = $_POST['meta_description'];
   $author = $_POST['author'];


   $image = $_FILES['image']['name'] ;
   // Rename Image
   // Check image extension if it's original image
   $image_extension = pathinfo($image, PATHINFO_EXTENSION);
   $filename = $post_title. " - bishop-oyedola-blog." . $image_extension;


   if (empty($image)) {
    // Send SQL Query
   $query = "UPDATE post SET
    post_title = '$post_title',   
    post_url = '$post_slug',
    post_content = '$post_content',
    post_category ='$post_category',
    meta_title = '$meta_title',
    meta_description = '$meta_description',
    post_author = '$author'
    WHERE post_id = '$PostID'
    ";

       $query_run = mysqli_query($connection, $query);
       if ($query_run) {
         $_SESSION['SuccessMessage'] = "Post Successfully Updated";
          header("Location: edit-post.php?edit_id=" . $PostID);
          exit(0);
       } else{
          $_SESSION['ErrorMessage'] = "Something went wrong. Please try again";
          header("Location: edit-post.php?edit_id=" . $PostID);
          exit(0);

       }
    }
    else{
    $query = "UPDATE post SET
    post_title = '$post_title',   
    post_url = '$post_slug',
    post_content = '$post_content',
    post_category ='$post_category',
    meta_title = '$meta_title',
    meta_description = '$meta_description',
    post_author = '$author',
    post_image = '$filename'
    WHERE post_id = '$PostID'";

           $query_run = mysqli_query($connection, $query);
           if ($query_run) {
           // move uploaded images to general images folder
            move_uploaded_file($_FILES['image']['tmp_name'], '../images/'.$filename);
             $_SESSION['SuccessMessage'] = "Post Successfully Updated";
              header("Location: edit-post.php?edit_id=" . $PostID);
              exit(0);
           } else{
              $_SESSION['ErrorMessage'] = "Something went wrong. Please try again";
              header("Location: edit-posts.php?edit_id=" . $PostID);
              exit(0);

           }
        }

} ?>
<?php include('admin_inc/ad-header.php'); ?>



   <div class="container-fluid px-4">

        <h1 class="mt-4">Administrators</h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item ">Edit Post</li>
        </ol>
        <div class="small text-danger mb-4"><i class="fas fa-hand-point-up"></i> You can collapse the admin sidebar to have a better view</div>
        <?php include '../includes/sessions.php'; ?>

        <div class="row"> 
        	<div class="col-md-9">
        		<div class="card shadow">
        			<div class="card-header">
        				<h4><i class="fas fa-edit"></i> 
                            Edit Post 
                        <a href="posts.php"><button class="btn btn-primary btn-group float-end">All Posts</button></a>
                        </h4>
        			</div>
        			<div class="card-body">
                        <?php   
                            if (isset($_GET['edit_id'])) {
                              $edit = $_GET['edit_id'];
                              $post_query = "SELECT * FROM post WHERE post_id='$edit'";
                              $post_query_run = mysqli_query($connection, $post_query);
                              if (mysqli_num_rows($post_query_run) > 0) {
                                  $row = mysqli_fetch_array($post_query_run); ?>

                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="PostID" value="<?= $row['post_id']?>">
                                 <input type="hidden" name="author" value="<?= $_SESSION['auth_user']['user_full_name']; ?>">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="Name">Post Title</label>
                                    <input type="text" value="<?= $row['post_title']; ?>"  name="post_name" id="Name" class="form-control" >
                                </div>


                            <div class="col-md-12 mb-3">
                                    <label for="Slug">Post Content</label>
                                    <textarea name="post_content"  class="form-control" id="" cols="30" rows="30"><?= $row['post_content']; ?></textarea>
                                </div>
                                

                                <input type="submit" id="Submit" name="update_post" class="btn btn-primary form-control" value="Publish">
                               
                           
                           
                    </div>
                </div>
            </div>
        </div>

        <!-- Side Bar -->
            <div class="col-md-3">

                    <div class="mb-5">
                    <input type="submit" class="btn btn-success float-end " name="update_post" value="Publish Post"></a>
                    </div>

                    <!-- New Image-->
                    <div class="mb-3">
                    <label for="Image">Select New Featured Image</label>
                    <input type="hidden" name="image" value="<?= $row['post_image']; ?>">
                    <input type="file" id="Image" name="image" class="form-control">
                    </div>
                    <!-- Image Preview-->                       
                        <div class="mb-3">
                            <div class="card">
                                <div class="card-header">Existing Image</div>
                            <img src="../images/<?= $row['post_image']; ?>" alt="">
                            </div>
                        </div>

                    <!-- Post Slug -->
                    <div class="card mb-3">
                        <div class="card-header">Slug (Post URL)</div>
                        <input type="text"  value="<?= $row['post_url']; ?>" id="Email" name="post_slug" class="form-control">
                    </div>

                    <!-- Categories widget-->
                    <div class="card mb-4">
                        <div class="card-header">Categories</div>
                                <?php
                                $displayCat = "SELECT * FROM categories ";
                                $displayCatQuery = mysqli_query($connection, $displayCat);
                                if (mysqli_num_rows($displayCatQuery) > 0) {
                                ?>
                               <select name="post_category" id="" class="form-control" required>
                                <option value="">--Select Category--</option>
                                <?php   foreach ($displayCatQuery as $CatItem) {?>

                                    <option value="<?= $CatItem['cat_id']?>" <?= $CatItem['cat_id'] == $row['post_category'] ? "selected" : ''?>><?= $CatItem['cat_title'] ?></option>
                                <?php } ?>
                               </select>
                                <?php
                                }else{
                                    echo "No category found";
                                }
 
                                 ?>
                    </div>

                    <!-- Meta title -->
                    <div class="card mb-4">
                        <div class="card-header">Meta Title</div>
                        <input type="text" id="Meta"  value="<?= $row['meta_title']; ?>" name="meta_title" class="form-control">
                    </div>

                    <!-- Meta Keywords -->
                     <div class="card mb-3">
                       <div class="card-header">Meta Keyword</div>
                        <textarea name="meta_keywords" class="form-control" id="keyword" cols="30" rows="4"> </textarea> 
                    </div>

                    <!-- Meta Description -->
                    <div class="card mb-3">
                        <div class="card-header">Meta Description</div>
                        <textarea name="meta_description" class="form-control" id="MD" cols="30" rows="4"> <?= $row['meta_description']; ?></textarea>
                    </div>

                </div> <!-- Close Side Widget -->
            </form>
        </div> <!-- Close container fluid page space  -->
                        <?php
                              }


                            }
                         ?>


<?php include('admin_inc/ad-footer.php') ?>

