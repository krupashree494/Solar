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
        $username = $_POST['username'];
        $pass = $_POST['password'];

        $res = mysqli_query($conn, "select * from user where status = true and username = '$username' and password ='$pass'");
        if(mysqli_num_rows($res)>0)
        {
            $row = mysqli_fetch_assoc($res);
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['last_name'] = $row['last_name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['type'] = $row['type'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['contact'] = $row['contact'];
            $_SESSION['login'] = true;

            if($row['type']=='Admin'){
                header("Location: admin/index.php");
            } else if($row['type']=='Employee'){
                header("Location: employee/index.php");
            } else{
                header("Location: index.php");
            }
        }
        else
        {
            echo "<script>alert('Invalid credentials..Kindly try with valid data')</script>";
        }
    }
?>

<body style="background-image:url('assets/images/advertisement-photo.png'); background-repeat: no-repeat;">
    <div id="page-content" style="margin-top: 200px;">        
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 main-col offset-md-3">
                    <div class="mb-4 card p-5">
                        <div class="page-title">
                            <div class="wrapper text-center"><h1 class="page-width">Sign In</h1></div>
                        </div>
                        <form method="post" id="CustomerLoginForm" accept-charset="UTF-8" class="contact-form mt-4">    
                          <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="username" autocorrect="off" autocapitalize="off" autofocus="" required>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password" id="password" class="form-control" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                                <i class="fa fa-eye"></i>
                                            </span>
                                        </div>
                                    </div>                        	
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="text-center col-12 col-sm-12 col-md-12 col-lg-12">
                                <input type="submit" name="submit" class="btn mb-3" value="Sign In">
                                <p class="mb-4">
                                    <a href="forgot.php" id="RecoverPassword">Forgot your password?</a> &nbsp; | &nbsp;
                                    <a href="signup.php" id="customer_register_link">Create account</a>
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

    <!-- JavaScript to toggle password visibility -->
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye / eye slash icon
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>

    <!-- Bootstrap and Font Awesome for the eye icon -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</body>
</html>
