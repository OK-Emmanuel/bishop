<?php 
session_start();
require_once '../includes/db.php';
// Redirect user to dashboard if already logged in
if (isset($_SESSION['auth'])) {
    $_SESSION['SuccessMessage'] = "You are already logged in";
   header("Location: index.php");
   exit(0);
} 

   // Collect Form Inputs
if (isset($_POST['login'])) {
    $Email = mysqli_real_escape_string($connection, $_POST['email']) ;
    $Password = mysqli_real_escape_string($connection, $_POST['password']) ;

    //Check If Admin Exists
    $login_query = "SELECT * FROM administrators WHERE admin_email = '$Email' AND admin_password = '$Password'";
    $login_query_run = mysqli_query($connection, $login_query);
    if (mysqli_num_rows($login_query_run) >0 ) {
        foreach ($login_query_run as $data) {
            $user_id = $data['admin_id'];
            $user_name = $data['admin_username'];
            $user_email = $data['admin_email'];
            $user_role = $data['admin_role'];
            $fullname = $data['admin_name'];
        }
    // Set admin details into array
        $_SESSION['auth'] = true;
        $_SESSION['auth_role'] = $user_role;
        $_SESSION['auth_user'] = [
            'user_id'=>$user_id,
            'user_name'=>$user_name,
            'user_full_name'=>$fullname,
            'user_email'=>$user_email
        ];

    // Redirect author to only blog page
        if ($_SESSION['auth_role'] == 'Author') {
              $_SESSION['SuccessMessage'] = "Welcome back " . $_SESSION['auth_user']['user_name'];
            header("location: index.php"); 
            exit(0);  
        }
    // Redirect administrator to dashboard for full privileges
        elseif ($_SESSION['auth_role'] == 'Administrator') {
            $_SESSION['SuccessMessage'] = "Welcome back " . $_SESSION['auth_user']['user_name'];
            header("location: index.php");
            exit(0);  
        }
    }
    // If Admin does not exist, redirect to login
    else{
        $_SESSION['ErrorMessage'] = "Invalid Email or Password";
        header("location: login.php");
        exit(0);
    }

    // Finish form hadling
}
  

?>
<?php include 'admin_inc/header.php'; ?>

<div class="py-5 my-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-header bg-danger text-light text-center text-uppercase font-weight-bold ">Admin Login</div>
                        <div class="card-body">
                             <?php include '../includes/sessions.php'; ?>
                              <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                            <div class="form-group mb-3">
                                <label for="Email">Email</label>
                                <input type="email" name="email" placeholder="Enter Your Email Address" class="form-control" id="Email">
                            </div>

                            <div class="form-group mb-3">
                                <label for="Password">Password</label>
                                <input type="password" name="password" placeholder="Enter Your Password" id="Password" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                               <button class="btn btn-danger" type="submit" name="login">Login</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

</div> 
<p class="my-3">.</p>  
   <?php 
   include 'admin_inc/footer.php'; ?>