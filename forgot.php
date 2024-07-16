<?php
    require_once 'include/header-ink.php';
    include 'config/connection.php';

    session_start();
    if(!empty($_SESSION['login']))
    {
        header ("Location: index.php");
    }

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    if(isset($_POST['submit']))
      {
        $email = $_POST['email'];
        $res = mysqli_query($conn, "select first_name, password, email from user where email = '$email' and status = true ");
        if(mysqli_num_rows($res)>0)
        {
            $rows = mysqli_fetch_assoc($res);
            $name1 = $rows['first_name'];
            $useremail1 = $rows['email'];
            $password1 = $rows['password'];
            $title = "Green Energy";

            try 
            {
                require './vendor-email/autoload.php';

                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 465;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->SMTPAuth = true;
                $mail->IsHTML(true);
        
                $mail->Username = 'naikkrupashree@gmail.com';
                $mail->Password = 'zzue mgew tork tyyq';
        
                $mail->setFrom('naikkrupashree@gmail.com', $title);
                $mail->addReplyTo('naikkrupashree@gmail.com', $title);

                $mail->addAddress($useremail1, $name1);
                
                $mail->Subject = "Forgot Password : ".$title;
                $mail->Body = 'Dear '.$name1.'<br> You recently requested reset your password<br> Password : '.$password1.'<br><br> Thank you<br>Team '.$title;
                $mail->AltBody = 'Forgot password reset email';

                if ($mail->send()) {

                    echo "<script type='text/javascript'>alert('Password has been sent to your registered email address!')</script>";
                } else {
        
                    echo "<script type='text/javascript'>alert('Unable to process!')</script>";
                } 
            } 
            catch (Exception $e) 
            {
                echo "<script>alert('Invalid data you provided..!');</script>";
            }

        }
        else
        {
          echo "<script>alert('Invalid data you provided..!');</script>";
        }

    }
?>


    <div id="page-content" style="margin-top: 150px;">        
        <div class="container">
        	<div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 main-col offset-md-3">
                	<div class="mb-4 card p-5">
                        <div class="page-title">
                            <div class="wrapper text-center"><h1 class="page-width">Forgot Password?</h1></div>
                        </div>
                       <form method="post" accept-charset="UTF-8" class="contact-form mt-4">	
                          <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" autocorrect="off" autocapitalize="off" autofocus="" required>
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="text-center col-12 col-sm-12 col-md-12 col-lg-12">
                                <input type="submit" name="submit" class="btn mb-3" value="Reset">
                                <p class="mb-4">
									<a href="login.php" id="RecoverPassword">Remember your password?</a>
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