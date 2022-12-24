<?php 
session_start();
include('../includes/db.php');
include('./admin_inc/authentication.php'); 


    if (isset($_GET['del-admin'])) {
          $AdminDrop = $_GET['del-admin'];  
          $sql = "DELETE FROM administrators WHERE admin_id = '$AdminDrop'";
          $sql_execute = mysqli_query($connection, $sql);
          if ($sql_execute) {
             $_SESSION['ErrorMessage'] = "Admin Deleted Successfully";
             header("location: all-admins.php");
          }
    }

?>
<?php include('admin_inc/ad-header.php'); ?>
   <div class="container-fluid px-4">

        <h1 class="mt-4">Administrators</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item ">Admin</li>
        </ol>
        <?php include '../includes/sessions.php'; ?>

        <div class="row"> 
        	<div class="col-md-12">
        		<div class="card shadow">
        			<div class="card-header">
        				<h4>Administrators
                            <a href="newadmin.php" class="btn btn-primary float-end">Add Admin <i class="fas fa-user-plus"></i> </a></h4>
        			</div>
        			<div class="card-body">
        				<table class="table table-bordered">
        					<thead>
        						<tr>
        							<th>S/N</th>
        							<th>Name</th>
        							<th>Email</th>
        							<th>Role</th>
        							<th>Action</th>
        						</tr>
        					</thead>
        					<tbody>
        					<?php 
    						$serial_no = 1;
        					$query = "SELECT * FROM administrators ";
        					$query_run = mysqli_query($connection, $query);
        					while ($rows = mysqli_fetch_assoc($query_run)) {
        					 ?>
        					 <tr>
        					 	<td><?php echo $serial_no++; ?></td>
        					 	<td><?php echo $rows['admin_name']; ?></td>
        					 	<td><?= $rows['admin_email']; ?></td>
        					 	<td><?= $rows['admin_role']; ?></td>
        					 	<td class="btn-group btn"><a href="edit-admin.php?edit_id=<?=$rows['admin_id'];?>"><i class="fas fa-edit"></i></a>
        					 	<a href="all-admins.php?del-admin=<?= $rows['admin_id']; ?>"><button type="" name="delete" class="ms-3 text-danger fas fa-trash btn-group"></button></a></td>
        					 </tr>
        					<?php }?>
        					</tbody>
        				</table>
        			</div>
        		</div>
        	</div>
        </div>



     </div>
<?php include('admin_inc/ad-footer.php') ?>