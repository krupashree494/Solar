<?php
    require_once 'include/header-ink.php';
    include 'config/connection.php';

    session_start();
    if(!empty($_SESSION['login']))
    {
        header ("Location: index.php");
    }

    if(isset($_POST['submit']))
    {
        $pass = $_POST['password'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $uname = $_POST['uname'];
        $email = $_POST['email'];
        $num = $_POST['contact'];
        
        if(mysqli_query($conn, "insert into user(first_name, last_name, email, type, username, password, image, status, contact)values('$fname', '$lname', '$email', 'User', '$uname', '$pass', 'user/user_image.jpg', true, '$num')"))
        {
            echo "<script>alert('User registered successfully..!');location.href='index.php'</script>";
        }
        else
        {
            echo "<script>alert('Unable to insert your data, Kindly try after sometimes..')</script>";
            
        }
    }
?>

<body style="background-color:#E5E4E2;">
    <div id="page-content" style="margin-top: 150px;">        
        <div class="container">
        	<div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 main-col offset-md-3">
                	<div class="mb-4 card p-5">
                        <div class="page-title">
                            <div class="wrapper text-center"><h1 class="page-width">Sign Up</h1></div>
                        </div>
                       <form method="post" id="CustomerLoginForm" accept-charset="UTF-8" class="contact-form mt-4">	
                          <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" name="fname" autocorrect="off" autocapitalize="off" autofocus="" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" name="lname" autocorrect="off" autocapitalize="off" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="uname" required>                        	
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Email Id</label>
                                    <input type="email" name="email" required>                        	
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text"  title="Please enter 10 digit valid number" pattern="[6789][0-9]{9}" name="contact" required>                        	
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" name="password" required>                        	
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="text-center col-12 col-sm-12 col-md-12 col-lg-12">
                                <input type="submit" class="btn mb-3" value="Sign Up" name="submit">
                                <p class="mb-4">
									<a href="login.php" id="RecoverPassword">Already have an account?</a>
                                </p>
                            </div>
                         </div>
                     </form>
                    </div>
               	</div>
            </div>
        </div>
        
    </div>
    
    <?php 
        require_once 'include/footer-link.php';
    ?>