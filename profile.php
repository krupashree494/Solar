<?php
    require_once 'include/header-ink.php';
    include 'config/connection.php';

    session_start();
    if(empty($_SESSION['login']))
    {
        header ("Location: login.php");
    }

    $ids = $_SESSION['id'];

    if(isset($_POST['change']))
    {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $num = $_POST['contact'];
        $address = $_POST['address'];
        
        if(mysqli_query($conn, "update user set first_name = '$fname', last_name = '$lname', email = '$email', address = '$address', contact = '$num' where id = '$ids'"))
        {     
            echo "<script>alert('Profile updated successfully..!');location.href='profile.php'</script>";
        }
        else
        {
            echo "<script>alert('Unable to update profile..!');</script>";
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
                            <div class="wrapper text-center"><h1 class="page-width">Your Profile</h1></div>
                        </div>
                       <form method="post" id="CustomerLoginForm" accept-charset="UTF-8" class="contact-form mt-4">	
                       <?php
                       $sql = "select * from user where id = '$ids'";
                        $res = mysqli_query($conn,$sql);
                        $row=mysqli_fetch_assoc($res);?>
                       <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" name="fname" required value="<?php echo $row['first_name'];?>">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" name="lname" required value="<?php echo $row['last_name'];?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Email Id</label>
                                    <input type="email" name="email" value="<?php echo $row['email'];?>" required>                        	
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text" title="Please enter 10 digit valid number" value="<?php echo $row['contact'];?>" pattern="[6789][0-9]{9}" name="contact" required>                        	
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea name="address" cols="50" rows="5" class="form-control1" required><?php echo $row['address'];?></textarea>
                                </div>
                            </div>
                          </div>
                          <div class="row"> 
                            <div class="text-center col-12 col-sm-12 col-md-12 col-lg-12">
                                <input type="submit" class="btn mb-3" value="Update Profile" name="change">
                                
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