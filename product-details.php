<?php
    require_once 'include/header-ink.php';
    include 'config/connection.php';

    session_start();
    if(empty($_SESSION['login']))
    {
        header ("Location: login.php");
    }

    $ids = 0;
    if(!empty($_GET['product_id'])){
        $ids = $_GET['product_id'];
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

        if(isset($_GET['add_to_cart']))
	{
		$id = intval($_GET['id']);
		$pqty = intval($_GET['quantity']);

		$verres = mysqli_query($conn, "select id from product where id = '$id'");
		if(mysqli_num_rows($verres)>0)
		{
			if(isset($_SESSION['cart'][$id]))
			{
				$_SESSION['cart'][$id]['quantity']+=$pqty;
				echo "<script>alert('Product has been added to the cart');location.href='product-details.php?product_id=$id';</script>";
			}
			else
			{
				$sql_p = "SELECT * FROM product WHERE id={$id}";
				$query_p = mysqli_query($conn, $sql_p);
				if(mysqli_num_rows($query_p) > 0)
				{
					$row_p=mysqli_fetch_array($query_p);
					$_SESSION['cart'][$row_p['id']]=array("quantity" => $pqty, "price" => $row_p['price']);
					echo "<script>alert('Product has been added to the cart');location.href='product-details.php?product_id=$id';</script>";
				}
				else
				{
					echo "<script>alert('Unable to add product on cart');location.href='product-details.php?product_id=$id';</script>";
				}
			}
		}
		else 
		{
			echo "<script>alert('Unable to add product on cart');location.href='product-details.php?product_id=$id';</script>";
		}
		
	}
    ?>
    
    <div id="page-content">        
        <div class="container">
        	<div class="row">
                <div class="col-12" style="margin-top: 200px;">
                    <div class="product-template__container prstyle2 container">
                        <div class="product-single product-single-1">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="product-details-img product-single__photos bottom">
                                        <div class="zoompro-wrap product-zoom-right pl-20">
                                            <div class="zoompro-span">
                                                <?php
                                                    $res4 = mysqli_query($conn, "SELECT * FROM product WHERE id = '$ids'");
                                                    if(mysqli_num_rows($res4)>0){
                                                    $res4 = mysqli_fetch_assoc($res4);
                                                    // print_r($res4);
                                                    } else{
                                                        echo "<script>alert('Unable to process');location.href='index.php'</script>";
                                                    }
                                                ?>
                                                <img class="blur-up lazyload zoompro" alt="" src="admin/<?php echo $res4['image'];?>" />  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="product-single__meta">
                                        <h1 class="product-single__title"><?php echo ($res4['name']);?></h1>
                                            <div class="prInfoRow"></div>
                                                <p class="product-single__price product-single__price-product-template">
                                                    <span class="visually-hidden">Regular price</span>
                                                    <span class="product-price__price product-price__price-product-template product-price__sale product-price__sale--single">
                                                    <span id="ProductPrice-product-template"><span class="money">RS. <?php echo number_format($res4['price'], 2);?></span></span>
                                                    </span>
                                        </p>
                                        <div class="product-single__description rte">
                                            <p><?php echo ($res4['descrption']);?></p>
                                        </div>
                                        <form method="GET" class="product-form product-form-product-template hidedropdown" enctype="multipart/form-data">
                                            <div class="product-action clearfix">
                                                <div class="product-form__item--quantity">
                                                    <div class="wrapQtyBtn">
                                                        <div class="qtyField">
                                                            <a class="qtyBtn minus" href="javascript:void(0);"><i class="fa anm anm-minus-r" aria-hidden="true"></i></a>
                                                            <input type="text" id="Quantity" name="quantity" value="1" class="product-form__input qty">
                                                            <input type="hidden" name="id" value="<?php echo $ids;?>"/>
                                                            <a class="qtyBtn plus" href="javascript:void(0);"><i class="fa anm anm-plus-r" aria-hidden="true"></i></a>
                                                        </div>
                                                    </div>
                                                </div>                                
                                                <div class="product-form__item--submit">
                                                    <button type="submit" name="add_to_cart" class="btn product-form__cart-submit">
                                                        <span>Add to cart</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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