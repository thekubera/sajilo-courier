<!-- Page Content Holder -->
<div id="content">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">

            <button type="button" id="sidebarCollapse" class="navbar-btn btn btn-dark">
                <i class="fas fa-align-justify"></i>
            </button>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-align-justify"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">  
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item active">
                       <a class="nav-link">
                           <?php
                                echo $_SESSION['name'];
                           ?>
                       </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <img src="
                            <?php  
                                if(isset($profilePath)) {
                                    echo URLROOT."/img/users/".$profilePath;
                                } else {
                                    echo URLROOT."/img/users/fox.jpg";
                                }
                            ?>
                          " width="40" height="40" class="rounded-circle">

                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                          <a class="dropdown-item" href="
                            <?php  
                                if(isset($_SESSION['aid'])) {
                                    echo URLROOT."/Admin/dashboard";
                                } else {
                                    echo URLROOT."/Staff/dashboard"; 
                                }
                            ?>
                          ">Dashboard</a>
                          <a class="dropdown-item" href="
                          <?php  
                            if(isset($_SESSION['aid'])) {
                                echo URLROOT."/Admin/changePassword";
                            } else {
                                echo URLROOT."/Staff/changePassword";
                            }
                          ?>
                          ">Change Password</a>
                          <a class="dropdown-item" href="
                            <?php  
                                if(isset($_SESSION['aid'])) {
                                    echo URLROOT."/Admin/changeProfilePicture";
                                } else {
                                    echo URLROOT."/Staff/changeProfilePicture";
                                }
                            ?>
                          ">Upload Profile Picture</a>
                          <a class="dropdown-item" href="User/logout">Log Out</a>
                        </div>
                    </li> 

                </ul>
            </div>
        </div>
    </nav>