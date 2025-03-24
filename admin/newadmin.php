<?php 
session_start();

include 'admin_inc/header.php'; 
require_once '../includes/db.php';

// Collect Form Inputs
if (isset($_POST['register_admin'])) {
    $AdminName = htmlspecialchars(trim($_POST['fname']));
    $AdminUname = htmlspecialchars(trim($_POST['uname']));
    $AdminEmail = htmlspecialchars(trim($_POST['email']));
    $AdminPaswd = $_POST['password'];
    $ConfirmPassword = $_POST['cpassword'];
    $AddedBy = htmlspecialchars(trim($_POST['added_by']));
    $AdminRole = $_POST['admin_role'];

    if ($AdminPaswd == $ConfirmPassword) {
        if (!filter_var($AdminEmail, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['ErrorMessage'] = "Invalid email format";
            header("location: newadmin.php");
            exit(0);
        }

        // Check if email does not exist
        $stmt = $connection->prepare("SELECT * FROM administrators WHERE admin_email = ?");
        $stmt->bind_param("s", $AdminEmail);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Email already registered
            $_SESSION['ErrorMessage'] = "Admin with that email has already been registered";
            header("location: newadmin.php");
            exit(0);
        } else {
            // Register a non-existing email
            $AdminPaswd = password_hash($AdminPaswd, PASSWORD_DEFAULT);
            $stmt = $connection->prepare("INSERT INTO administrators(admin_name, admin_username, admin_email, admin_password, added_by, admin_role) VALUES(?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $AdminName, $AdminUname, $AdminEmail, $AdminPaswd, $AddedBy, $AdminRole);
            $user_query_run = $stmt->execute();
            
            if ($user_query_run) {
                $_SESSION['SuccessMessage'] = isset($_SESSION['auth']) 
                    ? "You Have Successfully Added a New Administrator" 
                    : "Administrator Registered Successfully";
                $redirect = isset($_SESSION['auth']) ? "all-admins.php" : "login.php";
                header("location: $redirect");
                exit(0);
            } else {
                $_SESSION['ErrorMessage'] = "Registration failed. Please try again.";
                header("location: newadmin.php");
                exit(0);
            }
        }
    } else {
        $_SESSION['ErrorMessage'] = "Passwords do not match";
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
                        <small class="">All Fields are required</small>
                    </div>
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
                                        <option value="Administrator">Administrator</option>
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
include 'admin_inc/footer.php'; 
?>
