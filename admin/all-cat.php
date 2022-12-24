<?php 
session_start();
include('../includes/db.php');
include('./admin_inc/authentication.php'); 


    if (isset($_GET['del-category'])) {
          $CatDrop = $_GET['del-category'];  
          $sql = "DELETE FROM categories WHERE cat_id = '$CatDrop'";
          $sql_execute = mysqli_query($connection, $sql);
          if ($sql_execute) {
             $_SESSION['ErrorMessage'] = "Category Deleted Successfully";
             header("location: all-cat.php");
          }
    }

?>
<?php include('admin_inc/ad-header.php'); ?>
   <div class="container-fluid px-4">

        <h1 class="mt-4">Administrators</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item ">Categories</li>
        </ol>
        <?php include '../includes/sessions.php'; ?>

        <div class="row"> 
        	<div class="col-md-12">
        		<div class="card shadow">
        			<div class="card-header">
        				<h4>Administrators
                            <a href="new-cat.php" class="btn btn-primary float-end">Add New Category <i class="fas fa-plus"></i> </a></h4>
        			</div>
        			<div class="card-body">
        				<table class="table table-bordered">
        					<thead>
        						<tr>
        							<th>S/N</th>
        							<th>Name</th>
        							<th>Description</th>
        							<th>Meta Title</th>
        							<th>Action</th>
        						</tr>
        					</thead>
        					<tbody>
        					<?php 
    						$serial_no = 1;
        					$query = "SELECT * FROM categories ";
        					$query_run = mysqli_query($connection, $query);
							if(mysqli_num_rows($query_run) > 0){
        					while ($rows = mysqli_fetch_assoc($query_run)) {
        					 ?>
        					 <tr>
        					 	<td><?php echo $serial_no++; ?></td>
        					 	<td><?php echo $rows['cat_title']; ?></td>
        					 	<td><?= $rows['cat_description']; ?></td>
        					 	<td><?= $rows['meta_title']; ?></td>
        					 	<td class="btn-group btn"><a href="cat-edit.php?edit_category=<?=$rows['cat_id'];?>"><i class="fas fa-edit"></i></a>
        					 	<a href="all-cat.php?del-category=<?= $rows['cat_id']; ?>"><button type="" name="delete" class="ms-3 text-danger fas fa-trash btn-group"></button></a></td>
        					 </tr>
        					<?php }}
							else{
								echo "<div class='text-center text-danger'><h3> No Category is Found in Database</h3></div>";
							}?>
        					</tbody>
        				</table>
        			</div>
        		</div>
        	</div>
        </div>



     </div>
<?php include('admin_inc/ad-footer.php') ?>