<?php 
session_start();
include('../includes/db.php');
include('./admin_inc/authentication.php'); ?>
<?php 
if (isset($_POST['update_profile'])) {
   $admin_profile = $_SESSION['auth_user']['user_full_name'];
   $admin_name = $_POST['new_name'];
   $admin_username = $_POST['new_username'];
   $admin_email = $_POST['new_email'];
   $country =$_POST['new_country'];
   $admin_contact = $_POST['contact'];
   $admin_birthday = $_POST['birthdate'];
   $admin_image = $_FILES['image']['name'] ;
   // Check image extension if it's original image
   $image_extension = pathinfo($admin_image, PATHINFO_EXTENSION);
   // Rename Image
   $filename = $admin_name . " - administrator-bishop-oyedola-website." . $image_extension;

   // Update Profile Pciture if New Picture was uploaded
   if (!empty($admin_image)) {
    $query = "UPDATE administrators SET 
    admin_name='$admin_name',
    admin_username = '$admin_username',
    admin_email = '$admin_email',
    country = '$country',
    phone = '$admin_contact',
    birthdate = '$admin_birthday',
    profile_pic = '$filename'
    WHERE admin_name='$admin_profile'";

    $query_run = mysqli_query($connection, $query);
        if ($query_run) {
        // move uploaded images to general images folder
        move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/'.$filename);
        $_SESSION['SuccessMessage'] = "Your Profile has been Successfully Updated";
        header("Location: profile.php");
        exit(0);
        }else{
        $_SESSION['ErrorMessage'] = "Something went wrong. Please try again";
        header("Location: profile.php");
        exit(0);
        }
    }
    
    // Retain Existing Picture if No Picture was Uploaded
    elseif (($admin_image)) {
        $query = "UPDATE administrators SET 
        admin_name='$admin_name',
        admin_username = '$admin_username',
        admin_email = '$admin_email',
        country = '$country',
        phone = '$admin_contact',
        birthdate = '$admin_birthday',
        WHERE admin_name='$admin_profile'";

        $query_run = mysqli_query($connection, $query);
        if ($query_run) {
        $_SESSION['SuccessMessage'] = "Your Profile has been Successfully Updated";
        header("Location: profile.php");
        exit(0); }else{
        $_SESSION['ErrorMessage'] = "Something went wrong. Please try again";
        header("Location: profile.php");
        exit(0);
        }
    }
   


   

}
 ?>
<?php include('admin_inc/ad-header.php'); ?>



<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    <h1 class="mt-4">Administrators</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item ">Edit Profile</li>
        </ol>
        <?php include '../includes/sessions.php'; ?>
    
    <div class="row">
 <!-- Form Group (username)-->
    <?php 
    $profile = $_SESSION['auth_user']['user_full_name'];
    $sql = "SELECT * FROM administrators WHERE admin_name= '$profile'";
    $sql_query = mysqli_query($connection, $sql);
    while($rows = mysqli_fetch_assoc($sql_query)){
     ?>
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0 shadow">
                <div class="card-header">Profile Picture</div>
                <div class="card-body text-center">
                      <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                    <!-- Profile picture image-->
                    <img class="img-account-profile rounded-circle mb-2 w-100" value="uploads/<?= $rows['profile_pic']?>" src="uploads/<?= $rows['profile_pic']?>" alt="Your Profile Picture">
                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <!-- Profile picture upload button-->
                    <input type="file" class="btn btn-primary" name="image" id="">
                    <!-- <button class="" type="file">Upload new image</button> -->
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4 shadow">
                <div class="card-header">Account Details</div>
                <div class="card-body">
                  
            
                           <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Username (how your name will appear to other users on the site)</label>
                            <input class="form-control" id="inputUsername" value="<?= $rows['admin_username'] ;?>" name="new_username" type="text" >
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-12">
                                <label class="small mb-1" for="inputName">Full name</label>
                                <input class="form-control" id="inputName" type="text" name="new_name" value="<?= $rows['admin_name'] ;?>">
                            </div>
                            
                        </div>
                        <!-- Form Row        -->
                        <div class="row gx-3 mb-3">
                            
                        <!-- Form Group (email address)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Email address</label>
                            <input class="form-control" id="inputEmailAddress" type="email" name="new_mail" value="<?= $rows['admin_email'] ;?>" placeholder="Enter your email address" value="<?= $rows['admin_email'] ;?>">
                        </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputOrgName">Only Admin can edit role</label>
                                <input class="form-control" disabled id="inputOrgName" type="text" name="" value="<?= $rows['admin_role'] ;?>">
                            </div>
                            <!-- Form Group (location)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLocation">Country</label>
                                <input class="form-control" id="inputLocation" name="new_country" value="<?= $rows['country'] ;?>" type="text" placeholder="Enter your location">
                            </div>
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Phone number</label>
                                <input class="form-control" id="inputPhone" name="contact" value="<?= $rows['phone'] ;?>" type="tel" placeholder="Enter your phone number">
                            </div>
                            <!-- Form Group (birthday)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthday">Birthday</label>
                                <input class="form-control" id="inputBirthday" name="birthdate" type="date" value="<?= $rows['birthdate'] ;?>" name="birthday" placeholder="Enter your birthday" >
                            </div>
                        </div>
                        <!-- Save changes button-->
                        <button class="btn btn-primary" type="submit" name="update_profile">Save changes</button>
                    <?php }?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('admin_inc/ad-footer.php') ?>