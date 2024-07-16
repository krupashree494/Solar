<?php
    require_once 'include/header-ink.php';
    include 'config/connection.php';

    session_start();
    if(empty($_SESSION['login']))
    {
        header ("Location: login.php");
    }

    $trackid = $_GET['trid'];
    $sql3 = "select orders.orderDate,trackorder.trackno  from orders join trackorder on trackorder.id = orders.trackid where orders.trackid = '$trackid'";
    $res3 = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_assoc($res3);
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
    <div class="outter-wp" id="printableArea">      
        <div class="container">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8">
                    <div class="mb-4 card p-5" style="margin-top: 170px;">
                        <div class="page-title">
                            <div class="wrapper text-center">
                                <h1 class="page-width">Order Receipt</h1>
                            </div>
            <?php
                $sql = "select first_name,last_name, contact, address, address2, state, city, pincode from user where id = '".$_SESSION['id']."'";
                $res = mysqli_query($conn, $sql);
                
                $row = mysqli_fetch_assoc($res);
                ?>
            <div class="col-xs-6 col-sm-6 col-md-6">
                    <address>
                        <strong><?php echo $row['first_name']." ".$row['last_name'];?></strong>
                        <br>
                        <?php echo $row['address2'];?>
                        <br>
                        <?php echo $row['address'];?>
                        <br>
                        <?php echo $row['city'];?>, <?php echo $row['state'];?>
                        <br>
                        PIN <?php echo $row['pincode'];?>
                        <br>
                        <abbr title="Phone">Ph:</abbr> (91) <?php echo $row['contact'];?>
                    </address>
                </div>
                <div class="col-sm-8 col-md-8">
                    <p>
                        <em>Date: <?php echo $row3['orderDate'];?></em>
                    </p>
                    <p>
                        <em>Receipt #: <?php echo $row3['trackno'];?></em>
                    </p>
                </div>
            </div>
            
            <div class="row mt-2">
                </span>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql5 = "select product.id, product.name, product.price ,orders.quantity from orders join product on product.id = orders.productId where orders.trackid='$trackid'";
                    $res5 = mysqli_query($conn, $sql5);
                    echo mysqli_error($conn);
                    while($row5 = mysqli_fetch_assoc($res5))
                    {
                    ?>
                        <tr>
                            <td class="col-md-9"><strong><?php echo $row5['name'];?></strong></h4></td>
                            <td class="col-md-1" style="text-align: center"> <?php echo $row5['quantity'];?> </td>
                            <td class="col-md-1 text-center"><?php echo $row5['price'].".00";?></td>
                            <td class="col-md-1 text-center"><?php echo $row5['quantity']*$row5['price'].".00";?></td>
                        </tr>
                        <?php
                    }
                    
                    $sqlamt = "SELECT product.price,orders.quantity FROM product join orders on product.id=orders.productId where orders.trackid='$trackid'";
                    $resamt = mysqli_query($conn, $sqlamt);
                    $totalprice=0;
                    while($rowamt = mysqli_fetch_assoc($resamt))
                    {
                        
                        $subtotal= $rowamt['quantity']*$rowamt['price'];
                        $totalprice += $subtotal;
                    }
                    ?>
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td class="text-right">
                            <p>
                                <strong>Subtotal: </strong>
                            </p>
                           </td>
                            <td class="text-center">
                            <p>
                                <strong><?php echo $totalprice.".00";?></strong>
                            </p></td>
                        </tr>
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td class="text-right"><h4><strong>Total: </strong></h4></td>
                            <td class="text-center text-danger"><h4><strong><?php echo $totalprice.".00";?></strong></h4></td>
                        </tr>
                    </tbody>
                </table>
                <button onclick="printDiv('printableArea')" type="button" class="btn mb-3">
                    Print   <span class="glyphicon glyphicon-chevron-right"></span>
                </button>
            </td>
            </div>
        </div>
    </div>
</div>



    <script>
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
    </script>


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

