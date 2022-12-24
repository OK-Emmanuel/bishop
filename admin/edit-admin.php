<?php 
session_start();
include '../includes/db.php';
include('./admin_inc/authentication.php'); 
?>
<?php 
// Time to handle form processes
if (isset($_POST['update_admin'])) {
   $admin_id = $_POST['admin_id'];
   $admin_role = $_POST['role_as'];
   $admin_name = $_POST['new_name'];

   $query = "UPDATE administrators SET 
   admin_name='$admin_name',
   admin_role = '$admin_role'
   WHERE admin_id='$admin_id'";

   $query_run = mysqli_query($connection, $query);
   if ($query_run) {
      $_SESSION['SuccessMessage'] = "Admin details updated successfully";
      header("location: all-admins.php");
   }

}
?>
<?php include('admin_inc/ad-header.php'); ?>
   <div class="container-fluid px-4">

        <h1 class="mt-4">Administrators</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item ">Edit Admin Profile</li>
        </ol>
        <?php include '../includes/sessions.php'; ?>

        <div class="row"> 
        	<div class="col-md-12">
        		<div class="card shadow">
        			<div class="card-header">
        				<h4>Edit Admin Info</h4>
                        <small class="text-danger">You cannot edit all admin details, but you can change admin privileges</small>
        			</div>
        			<div class="card-body">
                        <?php 
                        // Display form and previous admin details
                        if (isset($_GET['edit_id'])) {
                            $admin_id  = $_GET['edit_id'];
                        $query = "SELECT * FROM administrators WHERE admin_id='$admin_id'";
                        $query_run = mysqli_query($connection, $query);
                        if (mysqli_num_rows($query_run) > 0) {
                           foreach ($query_run as $admin) { ?>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="Name">Name</label>
                                    <input type="text" value="<?= $admin['admin_name'] ?>"  name="new_name" id="Name" class="form-control" >
                                </div>


                                <div class="col-md-6 mb-3">
                                    <label for="Email">Email</label>
                                    <input type="email" value="<?= $admin['admin_email'] ?>" id="Email" name="new_mail" class="form-control" disabled >
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="">Admin Role</label>
                                    <select class="form-control" name="role_as" id="">
                                        <option value="">--Select Role--</option>
                                        <!-- Ternary to check admin role -->
                                        <option value="Author" <?= $admin['admin_role'] == 'Author' ? 'selected': ''?>>Author</option>
                                        <option value="Administrator" <?= $admin['admin_role'] == 'Administrator' ? 'selected': ''?>>Administrator</option>
                                    </select>
                                </div>

                                <input type="hidden" name="admin_id" value="<?= $admin['admin_id'];?>">

                                 <div class="col-md-6 mb-3">
                                    <label for=""></label>
                                    <input type="submit" id="Submit" name="update_admin" class="btn btn-primary form-control" value="Update">
                                </div>
                            </div>
                            </form>
                            <?php } //End Foreach      
                                } //End if admin exists
                              }
                        ?>
                    </div>
                </div>
            </div>
        </div>



     </div>
<?php include('admin_inc/ad-footer.php') ?>

