<?php session_start(); ?>
<?php 
    function TotalRows($table){
        include ("../includes/db.php");
        $sql = "SELECT * FROM $table";
        $sql_query = mysqli_query($connection, $sql);
        $total = mysqli_num_rows($sql_query);
        return $total; 
    }
 ?>
<?php include('admin_inc/authentication.php'); ?>
<?php include('admin_inc/ad-header.php'); ?>
                <main>
                    <div class="container-fluid px-4">

                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <?php include '../includes/sessions.php'; ?>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary py-4 text-white mb-4">
                                    <a href="posts.php" class="stretched-link text-white">
                                        <div class="card-body text-center"></a>
                                        <h1><?= TotalRows('post') ?></h1>
                                        Posts
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning  py-4 text-white mb-4">
                                    <a href="all-cat.php" class="stretched-link text-white">
                                    <div class="card-body text-center"></a>
                                    <h1><?= TotalRows('categories') ?></h1>
                                Categories
                                </div>
                                    
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success py-4  text-white mb-4">
                                    <a href="posts.php" class="stretched-link text-white">
                                    <div class="card-body text-center"></a>
                                    <h1><?= TotalRows('comments') ?></h1>Comments</div>
                                    
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger  py-4 text-white mb-4">
                                    <a href="all-admins.php" class="stretched-link text-white">
                                    <div class="card-body text-center"></a>
                                        <h1><?= TotalRows('administrators') ?></h1>Admins</div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
 <?php include('admin_inc/ad-footer.php') ?>
<!-- end document-->
