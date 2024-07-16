<?php
require_once 'include/header-ink.php';
include 'config/connection.php';

session_start();
if (empty($_SESSION['login'])) {
    header("Location: login.php");
}

if (isset($_GET['add'])) {
    $qty = $_GET['quantity'];
    $id = $_GET['pid'];

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity'] = $_SESSION['cart'][$id]['quantity'] + 1;
    }
}

if (isset($_GET['less'])) {
    $qty = $_GET['quantity'];
    $id = $_GET['pid'];

    if (isset($_SESSION['cart'][$id])) {
        if ($_SESSION['cart'][$id]['quantity'] == 1) {
            echo "<script>alert('Quantity must be 1 or more');location.href='checkout.php';</script>";
        } else {
            $_SESSION['cart'][$id]['quantity'] = $_SESSION['cart'][$id]['quantity'] - 1;
        }
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['pid'];
    if (!empty($_SESSION['cart']) || isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
    }
}

if (empty($_SESSION['cart'])) {

    header("Location: index.php");
    exit();
}

if (isset($_POST['shipupdate'])) {

    $saddress = $_POST['shippingaddress'];
    $saddress2 = $_POST['shippingaddress2'];
    $sstate = $_POST['shippingstate'];
    $scity = $_POST['shippingcity'];
    $spincode = $_POST['shippingpincode'];
    $query = mysqli_query($conn, "update user set address='$saddress',address2='$saddress2',state='$sstate',city='$scity',pincode='$spincode' where id='" . $_SESSION['id'] . "'");
    if ($query) {
        echo "<script>alert('Shipping Address has been updated');location.href='checkout.php';</script>";
    }
}

if (isset($_POST['ordersubmit'])) {

    $saddress = $_POST['shippingaddress'];
    $saddress2 = $_POST['shippingaddress2'];
    $sstate = $_POST['shippingstate'];
    $scity = $_POST['shippingcity'];
    $spincode = $_POST['shippingpincode'];

    $query = mysqli_query($conn, "update user set address='$saddress',address2='$saddress2',state='$sstate',city='$scity',pincode='$spincode' where id='" . $_SESSION['id'] . "'");
    if ($query) {

        $pdd = $_SESSION['pid'];
        $trackno = "BBORD" . $_SESSION['id'] . "TRC" . date("YmdHis");
        $trstatus = "Initiated";
        $trremark = "Order has been Initiated.";
        $trid = 0;
        $sql = "INSERT INTO trackorder (userid, trackno, status, remark) VALUES ('" . $_SESSION['id'] . "','$trackno','$trstatus','$trremark')";
        if (mysqli_query($conn, $sql)) {
            $sql1 = "SELECT id FROM trackorder WHERE trackno = '$trackno' ";
            $result1 = mysqli_query($conn, $sql1);

            if (mysqli_num_rows($result1) > 0) {
                $trid = 0;
                while ($row1 = mysqli_fetch_assoc($result1)) {
                    $trid = $row1["id"];
                }
                date_default_timezone_set('Asia/Kolkata');
                $dateo = date('Y-m-d h:i:s a');

                $myquantity = $_POST['myquantity'];
                $value = array_combine($pdd, $myquantity);

                foreach ($value as $qty => $val34) {
                    if (mysqli_query($conn, "insert into orders(userid,trackid,productId,quantity, orderStatus, 
                        order_remark, orderDate) values('" . $_SESSION['id'] . "','$trid','$qty','$val34','$trstatus','$trremark','$dateo')")) {
                        header('location:payment_method.php?trackid=' . $trid . '&amt=' . $_POST['total']);
                    } else {
                        echo mysqli_error($conn);
                    }
                }
            } else {
                echo "<script>alert('Unable to process your request! Kindly try after sometimes');location.href='checkout.php';</script>";
            }
        } else {
            echo "<script>alert('Unable to process your request! Kindly try after sometimes');location.href='checkout.php';</script>";
        }
    } else {
        echo "<script>alert('Unable to process your request! Kindly try after sometimes');location.href='checkout.php';</script>";
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
        <form name="cart" method="post">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col" style="margin-top: 185px;">
                    <div class="cart style2">
                        <?php
                        if (!empty($_SESSION['cart']) || isset($_SESSION['cart'])) {
                        ?>
                            <table>
                                <thead class="cart__row cart__header">
                                    <tr>
                                        <th>#</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Grandtotal</th>
                                        <th class="action">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tbody>
                                    <?php
                                    $pdtid = array();
                                    $sql = "SELECT * FROM product WHERE id IN(";
                                    foreach ($_SESSION['cart'] as $id => $value) {
                                        $sql .= $id . ",";
                                    }
                                    $sql = substr($sql, 0, -1) . ") ORDER BY id ASC";
                                    $query = mysqli_query($conn, $sql);
                                    $totalprice = 0;
                                    $totalqunty = 0;
                                    if (!empty($query)) {
                                        $count = 1;
                                        while ($row = mysqli_fetch_array($query)) {

                                            $quantity = $_SESSION['cart'][$row['id']]['quantity'];
                                            $subtotal = $_SESSION['cart'][$row['id']]['quantity'] * $row['price'];
                                            $totalprice += $subtotal;
                                            $_SESSION['qnty'] = $totalqunty += $quantity;

                                            array_push($pdtid, $row['id']);
                                    ?>
                                            <tr class="cart__row border-bottom line1 cart-flex border-top">
                                                <td class="cart__image-wrapper cart-flex-item">
                                                    <a href="product-details.php?product_id=<?php echo $row['id']; ?>"><img class="cart__image" src="admin/<?php echo $row['image']; ?>"></a>
                                                </td>
                                                <td class="cart__meta small--text-left cart-flex-item">
                                                    <div class="list-view-item__title">
                                                        <a href="product-details.php?product_id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="cart__price-wrapper cart-flex-item">
                                                    <span class="money"><?php echo "Rs" . " " . $row['price']; ?>.00</span>
                                                </td>
                                                <td class="cart__update-wrapper cart-flex-item text-right">
                                                    <div class="cart__qty text-center">
                                                        <div class="qtyField">
                                                            <a class="qtyBtn minus" href="?less&quantity=<?php echo $_SESSION['cart'][$row['id']]['quantity']; ?>&pid=<?php echo $row['id'] ?>"><i class="icon icon-minus"></i></a>
                                                            <input class="cart__qty-input qty" type="text" name="quantity" value="<?php echo $_SESSION['cart'][$row['id']]['quantity']; ?>" pattern="[0-9]*">
                                                            <a class="qtyBtn plus" href="?add&quantity=<?php echo $_SESSION['cart'][$row['id']]['quantity']; ?>&pid=<?php echo $row['id'] ?>"><i class="icon icon-plus"></i></a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-right small--hide cart-price">
                                                    <div><span class="money"><?php echo ($_SESSION['cart'][$row['id']]['quantity'] * $row['price']); ?>.00</span>
                                                    </div>
                                                </td>
                                                <td class="text-center small--hide"><a href="?delete&pid=<?php echo $row['id'] ?>" class="btn btn--secondary cart__remove" title="Remove tem"><i class="icon icon anm anm-times-l"></i></a></td>
                                            </tr>
                                            <input type="hidden" value="<?php echo $_SESSION['cart'][$row['id']]['quantity']; ?>" name="myquantity[<?php echo $row['id']; ?>]">
                                    <?php
                                            $count = $count + 1;
                                        }
                                    }
                                    $_SESSION['pid'] = $pdtid;
                                    ?>
                                </tbody>
                            </table>
                        <?php
                        }
                        ?>
                    </div>
                </div>


                <div class="container mt-4">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 mb-4">
                            <h5 class="mb-3">Shipping Address</h5>
                            <?php
                            $query = mysqli_query($conn, "select * from user where id='" . $_SESSION['id'] . "'");
                            $row = mysqli_fetch_array($query);
                            ?>
                            <div class="form-group">
                                <label for="address_zip">Address line1<span>*</span></label>
                                <input type="text" name="shippingaddress" required value="<?php echo $row['address']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="address_zip">Shipping State <span>*</span></label>
                                <input type="text" name="shippingstate" value="<?php echo $row['state']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="address_zip">Shipping Pincode<span>*</span></label>
                                <input type="text" name="shippingpincode" required="required" pattern="[0-9]{6}" title="Please enter a 6-digit pincode" value="<?php echo $row['pincode']; ?>">
                            </div>
                            <div class="actionRow">
                                <div><input type="submit" class="btn btn-secondary btn--small" value="Update Address" name="shipupdate">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 mb-4">
                            <h5 class="mb-3">&nbsp;</h5>
                            <div class="form-group">
                                <label for="address_zip">Address line2<span>*</span></label>
                                <input type="text" name="shippingaddress2" required value="<?php echo $row['address2']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="address_zip">Shipping City<span>*</span></label>
                                <input type="text" name="shippingcity" required="required" value="<?php echo $row['city']; ?>">
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 cart__footer">
                            <div class="solid-border">

                                <div class="row border-bottom pb-2 pt-2">
                                    <span class="col-12 col-sm-6 cart__subtotal-title h2"><strong>Grand
                                            Total</strong></span>
                                    <span class="col-12 col-sm-6 cart__subtotal-title h2 cart__subtotal text-right"><span class="money"><?php echo "Rs. " . $_SESSION['tp'] = "$totalprice" . ".00"; ?></span></span>
                                </div>
                                <input type="hidden" name="total" value="<?php echo $totalprice; ?>">

                                <input type="submit" name="ordersubmit" class="btn btn--small-wide checkout" value="Proceed To Checkout">
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

</div>

<?php
require_once 'include/footer.php';
require_once 'include/footer-link.php';
?>

<link rel="stylesheet" href="css/vroom.css">
<script type="text/javascript" src="js/vroom.js"></script>
<script type="text/javascript" src="js/TweenLite.min.js"></script>
<script type="text/javascript" src="js/CSSPlugin.min.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>

</html>