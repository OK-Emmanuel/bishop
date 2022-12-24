<?php 
session_start(); 
include('./admin_inc/authentication.php');
 include '../includes/db.php';
?>
<?php 
// Time to handle form processes
if (isset($_POST['update_category'])) {
    // Get form inputs
   $cat_title = $_POST['cat_name'];
   $cat_slug = $_POST['cat_slug'];
   $cat_description = $_POST['cat_description'];
   $catId = $_POST['cat_id'];

   $meta_title = $_POST['meta_title'];
   $meta_keywords = $_POST['meta_keywords'];
   $meta_description = $_POST['meta_description'];


   // Send SQL Query
   $query = "UPDATE categories SET
    cat_title =  '$cat_title', 
    cat_slug =  '$cat_slug',  
    cat_description = '$cat_description',
    meta_title =  '$meta_title'
    meta_keyword = '$meta_keywords',  
    meta_description = '$meta_description'
     WHERE cat_id = '$catId'";

   $query_run = mysqli_query($connection, $query);
   if ($query_run) {
      $_SESSION['SuccessMessage'] = "Category Updated Successfully";
      header("location: all-cat.php");
   }else{
      $_SESSION['ErrorMessage'] = "Something went wrong. Please try again";
      header("location: edit-cat.php?edit_id=''");
   }

}
?>
<?php include('admin_inc/ad-header.php'); ?>
   <div class="container-fluid px-4">

        <h1 class="mt-4">Administrators</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item ">Edit Category</li>
        </ol>
        <?php include '../includes/sessions.php'; ?>

        <div class="row"> 
        	<div class="col-md-12">
        		<div class="card shadow">
        			<div class="card-header">
        				<h4>Edit Category 
                            <a href="all-cat.php"><button class="btn btn-primary float-end">View Categories</button></a></h4>
        			</div>
        			<div class="card-body">
                        <?php 
                        // Display form and previous admin details
                        if (isset($_GET['edit_id'])) {
                            $cat_id  = $_GET['edit_id'];
                        $query = "SELECT * FROM categories WHERE cat_id='$cat_id'";
                        $query_run = mysqli_query($connection, $query);
                        if (mysqli_num_rows($query_run) > 0) {
                           foreach ($query_run as $cat) { ?>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                            <div class="row">
                                <input type="hidden" value="<?= $cat['cat_id']?>" name="cat_id">

                                <div class="col-md-6 mb-3">
                                    <label for="Name">Name</label>
                                    <input type="text" value="<?= $cat['cat_title']?>"  name="cat_name" id="Name" class="form-control" >
                                </div>


                                <div class="col-md-6 mb-3">
                                    <label for="Slug">Slug</label>
                                    <input type="text" id="Email" value="<?= $cat['cat_slug']?>" name="cat_slug" class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="Slug">Description</label>
                                    <textarea name="cat_description" class="form-control" id="" cols="30" rows="10"><?= $cat['cat_description']?></textarea>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="Meta">Meta Title</label>
                                    <input type="text" id="Meta" value="<?= $cat['meta_title']?>" name="meta_title" class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="keyword">Meta Keyword</label>
                                    <textarea name="meta_keywords" class="form-control" id="keyword" cols="30" rows="10"><?= $cat['meta_keyword']?></textarea> 
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="MD">Meta Description</label>
                                    <textarea name="meta_description"  class="form-control" id="MD" cols="30" rows="10"><?= $cat['meta_description']?></textarea>
                                </div>

                                    <label for=""></label>
                                    <input type="submit" id="Submit" name="update_category" class="btn btn-primary form-control" value="Publish">
                               
                            </div>
                            </form>
                         <?php } 
                     } }
                     ?>
                    </div>
                </div>
            </div>
        </div>



     </div>
<?php include('admin_inc/ad-footer.php') ?>

