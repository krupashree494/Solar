<?php
    require_once 'include/header-ink.php';
    include 'config/connection.php';

    session_start();
    if(empty($_SESSION['login']))
    {
        header ("Location: login.php");
    }

    if (isset($_POST['submit'])) {

		$tridm = $_GET['trackid'];
		$amt = $_GET['amt'];

		$pyno = "PAY987".$tridm."MM".$tridm;
        mysqli_query($conn,"insert into user_payment (payment_no, user_id, amount, payment_status, track_id) values('$pyno', '".$_SESSION['id']."','$amt', 'PAID', '$tridm')");

        // echo mysqli_error($conn);
        $resb = mysqli_query($conn,"select payment_id from user_payment where track_id = '$tridm'");
        $rowb = mysqli_fetch_assoc($resb);
        $pid = $rowb['payment_id'];

        date_default_timezone_set('Asia/Kolkata');
        $dateo = date('Y-m-d h:i:s a');
        mysqli_query($conn,"update orders set orderStatus = 'Paid', order_remark = 'Order has been begin', orderDate = '$dateo', payment_id='$pid' where userid='".$_SESSION['id']."' and trackid = '$tridm'");

        unset($_SESSION['cart']);
        header('location:my-order.php');
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
                            <div class="wrapper text-center"><h1 class="page-width">Payment Gateway</h1></div>
                        </div>
                       <form method="post" id="CustomerLoginForm" accept-charset="UTF-8" class="contact-form mt-4">	
                      
                       <div class="form-group">
                                    <label>Name on Card</label>
                                    <input type="text" required>                        	
                                </div>
                      
                      
                                <div class="form-group">
                                    <label>card number</label>
                                    <input type="text" maxlength="16" pattern="[0-9]{16}" title="Accept numbers only" required>                        	
                                </div>
                      
                       <div class="row">
                       <div class="col-4">
                                        <div class="form-group">
                                            <label>Card Expiry</label>
                                            <select>
                                                <option>Month</option>
                                                <option>Jan</option>
                                                <option>Feb</option>
                                                <option>Mar</option>
                                                <option>Apr</option>
                                                <option>May</option>
                                                <option>Jun</option>
                                                <option>Jul</option>
                                                <option>Aug</option>
                                                <option>Sep</option>
                                                <option>Oct</option>
                                                <option>Nov</option>
                                                <option>Dec</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <select>
                                                <option>Year</option>
                                                <option>2024</option>
                                                <option>2025</option>
                                                <option>2026</option>
                                                <option>2027</option>
                                                <option>2028</option>
                                                <option>2029</option>
                                                <option>2030</option>
                                                <option>2031</option>
                                                <option>2032</option>
                                                <option>2033</option>
                                                <option>2034</option>
                                                <option>2035</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>CVV</label>
                                            <input type="password" maxlength="3" pattern="[0-9]{3}" title="Accept numbers only" required>
                                        </div>
                                        </div>
                                    </div>
                                <div class="row"> 
                            <div class="text-center col-12 col-sm-12 col-md-12 col-lg-12">
                                <input type="submit" class="btn mb-3" value="submit" name="submit">
                                
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