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
        $uid = $_SESSION['id'];
        $service = $_POST['service'];
        $prod = $_POST['product'];
        $service_no = "SER".rand(100000, 999999);
        
        if(mysqli_query($conn, "insert into service(userid, problem, status, product_id, service_no)values('$uid','$service',true, '$prod', '$service_no')"))
        {
            echo "<script>alert('Service request sent successfully..!');</script>";
        }
        else
        {
            echo "<script>alert('Unable to send your request..!');</script>";
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
                            <div class="wrapper text-center"><h1 class="page-width">Service Request</h1></div>
                        </div>
                       <form method="post" action="#">
                        <div class="form-group mt-3">
                            <div class="col-sm-12">
                                <select name="product" id="selector1" class="form-control1" required>
                                    <option value="">Choose Product</option>
                                    <?php $res = mysqli_query($conn, "select distinct product.id, product.name from product join orders on orders.productId = product.id where orders.userid= ' $_SESSION[id]' AND status=true and orders.orderStatus='Paid'");
                                        while($row = mysqli_fetch_assoc($res))
                                        {?>
                                            <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                                        <?php
                                        }?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12" style="margin-top:15px"><textarea name="service" cols="50" rows="5" class="form-control1" placeholder="Write your problem" style="height: 75px;" required></textarea></div>
                        </div>

                        <div class="text-center col-12 col-sm-12 col-md-12 col-lg-12">
                                <input type="submit" name="change" class="btn mb-3" value="Submit">
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

    <!--js -->
<link rel="stylesheet" href="assets/css/vroom.css">
<script type="text/javascript" src="assets/js/vroom.js"></script>
<script type="text/javascript" src="assets/js/TweenLite.min.js"></script>
<script type="text/javascript" src="assets/js/CSSPlugin.min.js"></script>
<script src="assets/js/jquery.nicescroll.js"></script>
<script src="assets/js/scripts.js"></script>

<!-- Bootstrap Core JavaScript -->
   <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>