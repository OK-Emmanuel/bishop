<?php 
   session_start();

   include 'admin_inc/header.php'; 
   require_once '../includes/db.php';

   // Collect Form Inputs
   if (isset($_POST['register_admin'])) {
    $AdminName = mysqli_real_escape_string($connection, $_POST['fname']) ;
    $AdminUname = mysqli_real_escape_string($connection, $_POST['uname']) ;
    $AdminEmail = mysqli_real_escape_string($connection, $_POST['email']) ;
    $AdminPaswd = mysqli_real_escape_string($connection, $_POST['password']) ;
    $ConfirmPassword = mysqli_real_escape_string($connection, $_POST['cpassword']) ; 
    $AddedBy = mysqli_real_escape_string($connection, $_POST['added_by']);
    $AdminRole = $_POST['admin_role'];

    if ($AdminPaswd == $ConfirmPassword) {
         // Check if email does not exit
        $checkEmail = "SELECT * FROM administrators WHERE admin_email = '$AdminEmail' ";
        $runCheckQuery = mysqli_query($connection, $checkEmail);
        if (mysqli_num_rows($runCheckQuery) >0) {
            // Email already registered
            $_SESSION['ErrorMessage'] = "Admin with that email has already been registered";
            header("location: newadmin.php");
            exit(0);
        }

        //Register a non-existing email
        else{
         $user_query = "INSERT INTO administrators(admin_name,admin_username, admin_email, admin_password, added_by, admin_role) VALUES('$AdminName', '$AdminUname', '$AdminEmail', '$AdminPaswd', '$AddedBy', '$AdminRole' )";
         $user_query_run = mysqli_query($connection, $user_query);
         
         if ($user_query_run) {
            if (!isset($_SESSION['auth'])) {
                // return a success message and login
                $_SESSION['SuccessMessage'] = "Administrator Registered Successfully";
                header("location: login.php");
                exit(0);
            }elseif(isset($_SESSION['auth'])){
                 $_SESSION['SuccessMessage'] = "You Have Successfully Added a New Administrator";
                header("location: all-admins.php");
                exit(0);
            }
            }   
        }
     } 

     else{
        $_SESSION['ErrorMessage'] = "Username and password does not match";
        header("location: newadmin.php");
        exit(0);
     }


    }
   ?>

<div class="py-5 my-5 ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-header bg-danger text-light text-center text-uppercase font-weight-bold">Register New Admin <br>
                            <small class="">All Fields are required</small></div>
                        <div class="card-body">
                            <?php include '../includes/sessions.php'; ?>
                            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                            <div class="form-group mb-3">
                                <label for="Fname">Full Name</label>
                                <input type="text" required name="fname" placeholder="Enter Your full name here" class="form-control" id="Fname">
                            </div>

                            <div class="form-group mb-3">
                                <label for="Uname">Username</label>
                                <input type="text" required name="uname" placeholder="Create a username for yourself" class="form-control" id="Uname">
                            </div>

                            <div class="form-group mb-3">
                                <label for="Email">Email</label>
                                <input type="email" required name="email" placeholder="Enter Your Email Address" class="form-control" id="Email">
                            </div>

                            <div class="form-group mb-3">
                                <label for="Password">Password</label>
                                <input type="password" required name="password" placeholder="Enter Your Password" id="Password" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="CPassword">Confirm Password</label>
                                <input type="password" required name="cpassword" placeholder="Confirm Your Password" id="CPassword" class="form-control">
                            </div>

                            <?php if (isset($_SESSION['auth'])): ?>
                                <div class="form-group mb-3">
                                <label for="Role">Admin Role</label>
                                <select name="admin_role" id="Role" class="form-control">
                                    <option value="Author">Author</option>
                                    <option value="Administrator">Adminstrator</option>
                                </select>
                                </div>


                                <div class="form-group mb-3">
                                <label for="Admin">Added By</label>
                                <input type="text" name="added_by" placeholder="" value="<?= $_SESSION['auth_user']['user_name']; ?>" disabled id="Admin" class="form-control">
                                </div>

                            
                            <?php endif; ?>

                            <div class="form-group mb-3">
                               <button class="btn btn-danger w-100" type="submit" name="register_admin">Create Account</button>
                            </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>

</div>   
   <?php 
   include 'admin_inc/footer.php'; ?>