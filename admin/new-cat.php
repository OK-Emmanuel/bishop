<?php 
session_start(); 
include('./admin_inc/authentication.php');
 include '../includes/db.php';
?>
<?php 
// Time to handle form processes
if (isset($_POST['add_category'])) {
    // Get form inputs
   $cat_title = $_POST['cat_name'];
   $cat_slug = $_POST['cat_slug'];
   $cat_description = $_POST['cat_description'];


   $meta_title = $_POST['meta_title'];
   $meta_keywords = $_POST['meta_keywords'];
   $meta_description = $_POST['meta_description'];


   // Send SQL Query
   $query = "INSERT INTO categories(
    cat_title,   
    cat_slug,    
    cat_description, 
    meta_title,  
    meta_keyword,    
    meta_description) VALUES(
    '$cat_title', '$cat_slug', '$cat_description', '$meta_title', '$meta_keywords', '$meta_description')";

   $query_run = mysqli_query($connection, $query);
   if ($query_run) {
      $_SESSION['SuccessMessage'] = "New Category Successfully Published";
      header("location: all-cat.php");
   }else{
      $_SESSION['ErrorMessage'] = "Something went wrong. Please try again";
      header("location: new-cat.php");
   }

}
?>
<?php include('admin_inc/ad-header.php'); ?>
   <div class="container-fluid px-4">

        <h1 class="mt-4">Administrators</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item ">Add New Category</li>
        </ol>
        <?php include '../includes/sessions.php'; ?>

        <div class="row"> 
        	<div class="col-md-12">
        		<div class="card shadow">
        			<div class="card-header">
        				<h4>Add New Category 
                            <a href="all-cat.php"><button class="btn btn-primary float-end">View Categories</button></a></h4>
        			</div>
        			<div class="card-body">
                        
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="Name">Name</label>
                                    <input type="text"  name="cat_name" id="Name" class="form-control" >
                                </div>


                                <div class="col-md-6 mb-3">
                                    <label for="Slug">Slug</label>
                                    <input type="text" id="Email" name="cat_slug" class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="Slug">Description</label>
                                    <textarea name="cat_description"  class="form-control" id="" cols="30" rows="10"></textarea>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="Meta">Meta Title</label>
                                    <input type="text" id="Meta" name="meta_title" class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="keyword">Meta Keyword</label>
                                    <textarea name="meta_keywords" class="form-control" id="keyword" cols="30" rows="10"></textarea> 
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="MD">Meta Description</label>
                                    <textarea name="meta_description" class="form-control" id="MD" cols="30" rows="10"></textarea>
                                </div>

                                    <label for=""></label>
                                    <input type="submit" id="Submit" name="add_category" class="btn btn-primary form-control" value="Publish">
                               
                            </div>
                            </form>
                         
                    </div>
                </div>
            </div>
        </div>



     </div>
<?php include('admin_inc/ad-footer.php') ?>

