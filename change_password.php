<?php
    require_once 'include/header-ink.php';
    include 'config/connection.php';

    session_start();
    if(empty($_SESSION['login']))
    {
        header ("Location: login.php");
    }

    if(isset($_POST['change']))
    {
        $cpass = $_POST['cpassword'];
        $npass = $_POST['npassword'];
        $opass = $_POST['opassword'];

        if($cpass == $npass)
        {
            $email = $_SESSION['email'];
            $user = $_SESSION['username'];

            $res = mysqli_query($conn, "select password from user where email = '$email' and username='$user'");
            if(mysqli_num_rows($res)>0)
            {
                $row = mysqli_fetch_assoc($res);
                $oldpass = $row['password'];
                if($opass == $oldpass)
                {
                    if(mysqli_query($conn, "update user set password = '$npass' where email = '$email' and username='$user' "))
                    {
                        echo "<script>alert('Password updated successfully..!');</script>";
                    }
                    else
                    {
                        echo "<script>alert('Unable to update your password..!');</script>";
                    }
                }
                else
                {
                    echo "<script>alert('Invalid current password..!');</script>";
                }
            }
            else
            {
                echo "<script>alert('Unable to update your password..!');</script>";
            }
        }
        else
        {
            echo "<script>alert('Passwords dont match..!');</script>";
        }                    
    }
?>

    <div class="search">
        <div class="search__form">
            <form class="search-bar__form" action="search.php">
                <button class="go-btn search__button" type="submit"><i class="icon anm anm-search-l"></i></button>
                <input class="search__input" type="search" name="source" value="" placeholder="Search entire store..." aria-label="Search" autocomplete="off">
            </form>
            <button type="button" class="search-trigger close-btn"><i class="anm anm-times-l"></i></button>
        </div>
    </div>
    
    <?php
        require_once 'include/navigation.php';
    ?>
    
    <div id="page-content">        
        <div class="container">
        	<div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 main-col offset-md-3">
                	<div class="mb-4 card p-5" style="margin-top: 190px;">
                        <div class="page-title">
                            <div class="wrapper text-center"><h1 class="page-width">Update Password</h1></div>
                        </div>
                       <form method="post" id="CustomerLoginForm" accept-charset="UTF-8" class="contact-form mt-4">	
                          <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Current Password</label>
                                    <input type="password" name="opassword" required>   
                                    <label class="mt-3">New Password</label>
                                    <input type="password" name="npassword"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>   
                                    <label class="mt-3">Confirm Password</label>
                                    <input type="password" name="cpassword" required>                     	
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="text-center col-12 col-sm-12 col-md-12 col-lg-12">
                                <input type="submit" name="change" class="btn mb-3" value="Submit">
                            </div>
                         </div>
                     </form>
                    </div>
               	</div>
            </div>
        </div>
        
    </div>
    
    <?php 
        require_once 'include/footer.php';
        require_once 'include/footer-link.php';
    ?>