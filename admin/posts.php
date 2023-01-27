<?php 
session_start();
include('../includes/db.php');
include('./admin_inc/authentication.php'); 


    if (isset($_GET['del-post'])) {
          $PostDrop = $_GET['del-post'];  
          $sql = "DELETE FROM post WHERE post_id = '$PostDrop'";
          $sql_execute = mysqli_query($connection, $sql);
          if ($sql_execute) {
             $_SESSION['ErrorMessage'] = "Post Deleted Successfully";
             header("Location: posts.php");
          }
    }

?>
<?php include('admin_inc/ad-header.php'); ?>
   <div class="container-fluid px-4">

        <h1 class="mt-4">Administrators</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item ">Posts</li>
        </ol>
        <?php include '../includes/sessions.php'; ?>

        <div class="row"> 
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h4>Administrators
                            <a href="new-post.php" class="btn btn-primary float-end">Add New Post <i class="fas fa-plus"></i> </a></h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th> Image</th>
                                    <th>Author</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $serial_no = 1;
                            // $query = "SELECT * FROM post ";
                            // Fetch categories associated with posts
                            $query = "SELECT post.*, categories.cat_title
                                        FROM post, categories
                                        WHERE post.post_category=categories.cat_id";
                            $query_run = mysqli_query($connection, $query);
                            if (mysqli_num_rows($query_run) > 0) {
                            
                            while ($rows = mysqli_fetch_assoc($query_run)) {
                            
                             ?>
                             <tr>
                                <td><?php echo $serial_no++; ?></td>
                                <td><?php echo $rows['post_title']; ?></td>
                                <td><?= $rows['cat_title']; ?></td>
                                <td>
                                    <img src="../images/<?= $rows['post_image']; ?>" width="60px" height="40px" alt="">
                                </td>
                                <td><?= $rows['post_author']; ?></td>
                                <td class="btn-group btn"><a href="edit-post.php?edit_id=<?=$rows['post_id'];?>"><i class="fas fa-edit" title="Edit Post"></i></a>

                                <a href="../single-post.php?postid=<?=$rows['post_id']; ?>" target="_blank"><button type="" title="Live Preview" class="ms-3  fas fa-eye btn-group"></button></a>

                                <a href="posts.php?del-post=<?= $rows['post_id']; ?>"><button type="submit" title="Delete Post" name="delete" class="ms-3 text-danger fas fa-trash btn-group"></button></a></td>
                             </tr>
                            </tbody>
                            <?php } 
                            }else{
                                echo "<div class='text-center text-danger'><h3> No post found in database</h3></div>";
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>



     </div>
<?php include('admin_inc/ad-footer.php') ?>