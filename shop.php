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
				echo "<script>alert('Product has been added to the cart');location.href='shop.php?id=$_GET[id]';</script>";
			}
			else
			{
				$sql_p = "SELECT * FROM product WHERE id={$id}";
				$query_p = mysqli_query($conn, $sql_p);
				if(mysqli_num_rows($query_p) > 0)
				{
					$row_p=mysqli_fetch_array($query_p);
					$_SESSION['cart'][$row_p['id']]=array("quantity" => 1, "price" => $row_p['price']);
					echo "<script>alert('Product has been added to the cart');location.href='shop.php?id=$_GET[id]';</script>";
				}
				else
				{
					echo "<script>alert('Unable to add product on cart');location.href='shop.php?id=$_GET[id]';</script>";
				}
			}
		}
		else 
		{
			echo "<script>alert('Unable to add product on cart');location.href='shop.php?id=$_GET[id]';</script>";
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
        
        <div class="container" >
        	<div class="row">
            	<!--Sidebar-->
            	<div class="col-12 col-sm-12 col-md-3 col-lg-3 sidebar filterbar" style="margin-top:185px">
                	<div class="closeFilter d-block d-md-none d-lg-none"><i class="icon icon anm anm-times-l"></i></div>
                	<div class="sidebar_tags">
                    	<!--Categories-->
                    	<div class="sidebar_widget categories filter-widget">
                            <div class="widget-title"><h2>Categories</h2></div>
                            <div class="widget-content">
                                <ul class="sidebar_categories">
                                <?php
                                     $res4 = mysqli_query($conn, "SELECT * FROM category");
                                     if(mysqli_num_rows($res4)>0){
                                     while($row4 = mysqli_fetch_assoc($res4))
                                     {
                                     ?>
                                        <li class="lvl-1"><a href="shop.php?id=<?php echo $row4['id'];?>" class="site-nav"><?php echo $row4['name'] ?></a></li>
                                    <?php
                                     }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        
						<div class="sidebar_widget">
                        	<div class="widget-title"><h2>New Products</h2></div>
							<div class="widget-content">
                                <div class="list list-sidebar-products">
                                  <div class="grid">
                                  <?php
                                        $res4 = mysqli_query($conn, "SELECT * FROM product ORDER BY id DESC LIMIT 5");
                                        if(mysqli_num_rows($res4)>0){
                                        while($row4 = mysqli_fetch_assoc($res4))
                                        {
                                ?>
                                  
                                    <div class="grid__item">
                                      <div class="mini-list-item">
                                        <div class="mini-view_image">
                                            <a class="grid-view-item__link" href="product-details.php?product_id=<?php echo $row4['id'];?>">
                                                <img class="grid-view-item__image" src="admin/<?php echo $row4['image'];?>" alt="" />
                                            </a>
                                        </div>
                                        <div class="details"> <a class="grid-view-item__title" href="product-details.php?product_id=<?php echo $row4['id'];?>"><?php echo substr($row4['name'],0,50);?></a>
                                          <div class="grid-view-item__meta"><span class="product-price__price"><span class="money">RS. <?php echo number_format($row4['price'], 2);?></span></span></div>
                                        </div>
                                      </div>
                                    </div>
                                   
                                    <?php
                                        }}
                                        ?>

                                  </div>
                                </div>
                          	</div>
						</div>
                        
                    </div>
                </div>
                <!--End Sidebar-->
                <!--Main Content-->
                <div class="col-12 col-sm-12 col-md-9 col-lg-9 main-col pl-5 border-left"  style="margin-top:185px">
                	
                	<div class="productList product-load-more">
                        <div class="grid-products grid--view-items">
                            <div class="row">
                               
                                
                            <?php
                                            $cid = 10;
                                            if(!empty($_GET['id'])){
                                                $cid = $_GET['id'];
                                            }
                                            $sql5 = mysqli_query($conn, "SELECT * FROM product WHERE category_id = '$cid'");
                                            if(mysqli_num_rows($sql5)>0){
                                                while($row5 = mysqli_fetch_assoc($sql5))
                                                {
                                           
                                            ?>

                                <div class="col-6 col-sm-6 col-md-4 col-lg-3 item">
                                    <!-- start product image -->
                                    <div class="product-image">
                                    <a href="product-details.php?product_id=<?php echo $row5['id'];?>" class="grid-view-item__link">
                                                        <img class="primary blur-up lazyload" data-src="admin/<?php echo $row5['image'];?>" src="admin/<?php echo $row5['image'];?>" alt="image" title="product">
                                                    </a>
                                                    <form class="variants add" method="get">
                                                        <input type="hidden" name="product_id" value="<?php echo $row5['id'];?>"/>
                                                        <input type="hidden" name="id" value="<?php echo $cid;?>"/>
                                                        <button class="btn btn-addto-cart" tabindex="0" type="submit" name="add_to_cart">Add To Cart</button>
                                                    </form>
                                       
                                    </div>
                                    <!-- end product image -->

                                    <!--start product details -->
                                    <div class="product-details text-center">
                                    <div class="product-name">
                                                        <a href="product-details.php?product_id=<?php echo $row5['id'];?>"><?php echo substr($row5['name'],0,50);?></a>
                                                    </div>
                                                    <div class="product-price">
                                                        <span class="price">RS. <?php echo number_format($row5['price'], 2);?></span>
                                                    </div>
                                        
                                    </div>
                                </div>
                                
<?php
                                                }

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