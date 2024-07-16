<?php
    require_once 'include/header-ink.php';
    include 'config/connection.php';

    session_start();
    if(empty($_SESSION['login']))
    {
        header ("Location: login.php");
    }

    if(isset($_GET['add_to_cart']))
	{
		$id = intval($_GET['product_id']);

		$verres = mysqli_query($conn, "select id from product where id = '$id'");
		if(mysqli_num_rows($verres)>0)
		{
			if(isset($_SESSION['cart'][$id]))
			{
				$_SESSION['cart'][$id]['quantity']++;
				echo "<script>alert('Product has been added to the cart');location.href='search.php?source=".$_GET['source']."';</script>";
			}
			else
			{
				$sql_p = "SELECT * FROM product WHERE id={$id}";
				$query_p = mysqli_query($conn, $sql_p);
				if(mysqli_num_rows($query_p) > 0)
				{
					$row_p=mysqli_fetch_array($query_p);
					$_SESSION['cart'][$row_p['id']]=array("quantity" => 1, "price" => $row_p['price']);
					echo "<script>alert('Product has been added to the cart');location.href='search.php?source=".$_GET['source']."';</script>";
				}
				else
				{
					echo "<script>alert('Unable to add product on cart');location.href='search.php?source=".$_GET['source']."';</script>";
				}
			}
		}
		else 
		{
			echo "<script>alert('Unable to add product on cart');location.href='search.php?source=".$_GET['source']."';</script>";
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
                <div class="col-12" style="margin-top: 150px;">
                <div class="section">
        	<div class="container">
            	<div class="row">
                	<div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="section-header text-center">
                            <h2 class="h2">Search Results</h2>
                        </div>
                    </div>
                </div>
            </div>
            <?php
             if(isset($_GET['source']))
             {
                 $text = $_GET['source'];
                 $sql = "select product.id, category.name as cname, product.name, product.price, product.descrption, product.image, product.warranty from product join category on category.id = product.category_id where product.status = true and product.name LIKE '%".$text."%'";
             }
             $res4 = mysqli_query($conn, $sql);
        if(mysqli_num_rows($res4)>0)
        {?>

            <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="grid-products">
                                <div class="row">
                                    <?php
                                        while($row4 = mysqli_fetch_assoc($res4))
                                        {?>
                
                                            <div class="col-6 col-sm-6 col-md-3 col-lg-3 item">
                                                <div class="product-image">
                                                    <a href="product-details.php?product_id=<?php echo $row4['id'];?>" class="grid-view-item__link">
                                                        <img class="primary blur-up lazyload" data-src="admin/<?php echo $row4['image'];?>" src="admin/<?php echo $row4['image'];?>" alt="image" title="product">
                                                    </a>
                                                    <form class="variants add" onclick="window.location.href='search.php?source=<?php echo $_GET['source'];?>&add_to_cart&product_id=<?php echo $row4['id'];?>'"method="post">
                                                        <button class="btn btn-addto-cart" type="button" tabindex="0">Add To Cart</button>
                                                    </form>
                                                </div>
                                                <div class="product-details text-center">
                                                    <div class="product-name">
                                                        <a href="product-details.php?product_id=<?php echo $row4['id'];?>"><?php echo substr($row4['name'],0,50);?></a>
                                                    </div>
                                                    <div class="product-price">
                                                        <span class="price">RS. <?php echo number_format($row4['price'], 2);?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>

                <?php                     
        }
        else {
            echo "<h1>No Product Found..</h1>";
        }
    ?> 
            

        </div>  
               	</div>
            </div>
        </div>
        
    </div>
    
    <?php 
        require_once 'include/footer.php';
        require_once 'include/footer-link.php';
    ?>