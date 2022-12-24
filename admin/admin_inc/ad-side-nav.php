<div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading my-0"></div>
                            <a class="nav-link mb-3" href="index.php">
                                <div class="sb-nav-link-icon "><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <hr class="bg-light">
                            <!-- <div class="sb-sidenav-menu-heading">Interface</div> -->
                            <a class="nav-link collapsed mb-3" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Users
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <?php if ($_SESSION['auth_role'] == 'Administrator') {
                               ?>
                            
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="all-admins.php"><i class="fas fa-user-cog"></i> &nbsp Admins</a>
                                    <a class="nav-link" href="all-subscribers.php"><i class="fas fa-user-circle"></i> &nbsp; Subscribers</a>
                                </nav>
                            </div>
                        <?php } 

                            elseif ($_SESSION['auth_role'] == 'Author'){
                            ?>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                
                                    <a class="nav-link" href="all-subscribers.php"><i class="fas fa-user-circle"></i> Subscribers</a>
                                </nav>
                            </div>
                        <?php } ?>

                        <!-- Posts -->
                           <a class="nav-link collapsed mb-3" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePost" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                               Posts
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            
                            <div class="collapse" id="collapsePost" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="new-post.php"><i class="fas fa-plus"></i> &nbsp; New Post</a>
                                    <a class="nav-link" href="posts.php"><i class="fas fa-book-open"></i> &nbsp; View All Posts</a>
                                </nav>
                            </div>

                        <!-- Categories -->
                           <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCategory" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                                Categories
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            
                            <div class="collapse" id="collapseCategory" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="new-cat.php"><i class="fas fa-plus"></i> &nbsp; New Category</a>
                                    <a class="nav-link" href="all-cat.php"><i class="fas fa-book-open"></i> &nbsp; View Categories</a>
                                </nav>
                            </div>
                        


                            <!-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Pages
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.php">Login</a>
                                            <a class="nav-link" href="register.php">Register</a>
                                            <a class="nav-link" href="password.php">Forgot Password</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.php">401 Page</a>
                                            <a class="nav-link" href="404.php">404 Page</a>
                                            <a class="nav-link" href="500.php">500 Page</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <!-- <div class="sb-sidenav-menu-heading">Addons</div> 
                            <a class="nav-link" href="charts.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                            <a class="nav-link" href="tables.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a>-->
                        </div> 
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                      <?= $_SESSION['auth_user']['user_full_name']; ?>
                    </div>
                </nav>
            </div>