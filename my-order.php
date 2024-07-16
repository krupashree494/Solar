<?php
    require_once 'include/header-ink.php';
    include 'config/connection.php';

    session_start();
    if(empty($_SESSION['login']))
    {
        header ("Location: login.php");
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
               <div class="col-1"></div>
                <div class="col-12">
                    <div class="mb-4 card p-3" style="margin-top: 170px;">
                        <div class="page-title">
                            <div class="wrapper text-center">
                                <h1 class="page-width ">Your order</h1>
                            </div>
                                <?php

                        $uid = $_SESSION['id'];
                        $name = "";
                        $no = "";
                        $add = "";
                        $add2 = "";
                        $state = "";
                        $pin = "";
                        $city = "";

                    
                        
                        $sql2 = "select DISTINCT trackid, orderDate, orderStatus from orders where userid = '$uid' and orderStatus = 'Paid' order by trackid desc LIMIT 5";
                        
                        $res2 = mysqli_query($conn, $sql2);
                        $trackid = "";
                        if(mysqli_num_rows($res2)>0)
                        {
                            while($row2 = mysqli_fetch_assoc($res2))
                            {
                                
                                $trackid = $row2['trackid'];
                                $sql3 = "select Trackno from trackorder where id = '$trackid'";
                                $res3 = mysqli_query($conn, $sql3);
                                $row3 = mysqli_fetch_assoc($res3);

                                $sqlamt = "SELECT product.price,  orders.quantity FROM product join orders on product.id=orders.productId where orders.trackid='$trackid'";
                                $resamt = mysqli_query($conn, $sqlamt);
                                $totalprice=0;
                                while($rowamt = mysqli_fetch_assoc($resamt))
                                {
                                    
                                    $subtotal= $rowamt['quantity']*$rowamt['price'];
                                    $totalprice += $subtotal;
                                }

                                ?>
                                <div class="container" style="padding-right:40px">
                                <article class="card" style="padding:15px">
                                    <div class="card-body" >
                                    <p class="h5 text-right ">Date: <?php echo $row2['orderDate']; ?></p>
                                    <p class="h5">Track ID: <?php echo $row3['Trackno']; ?></p>
                                    <p><h3><?php echo "Total: ".$totalprice.".00 /-"; ?></h3> </p>
                                    <p class="h5">Status: <?php echo $row2['orderStatus']; ?></p>
                                    <a style="float:right" href="myorderdetails.php?trid=<?php echo htmlentities($trackid);?>" title="View Order">Order Details</a>
                                    </div>
                                    </article>
                                </div>
                                
                                <?php
                            }?>
                    <?php
                            
                        }
                        else
                        {
                            echo "No order found";
                        }
                    ?>
                                                </div>
                        </div>

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