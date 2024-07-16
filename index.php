<?php
require_once 'include/header-ink.php';
include 'config/connection.php';

session_start();
if (empty($_SESSION['login'])) {
    header("Location: login.php");
}

if (isset($_GET['add_to_cart'])) {
    $id = intval($_GET['product_id']);

    $verres = mysqli_query($conn, "select id from product where id = '$id'");
    if (mysqli_num_rows($verres) > 0) {
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity']++;
            echo "<script>alert('Product has been added to the cart');location.href='index.php';</script>";
        } else {
            $sql_p = "SELECT * FROM product WHERE id={$id}";
            $query_p = mysqli_query($conn, $sql_p);
            if (mysqli_num_rows($query_p) > 0) {
                $row_p = mysqli_fetch_array($query_p);
                $_SESSION['cart'][$row_p['id']] = array("quantity" => 1, "price" => $row_p['price']);
                echo "<script>alert('Product has been added to the cart');location.href='index.php';</script>";
            } else {
                echo "<script>alert('Unable to add product on cart');location.href='index.php';</script>";
            }
        }
    } else {
        echo "<script>alert('Unable to add product on cart');location.href='index.php';</script>";
    }
}

if(empty($_GET['page'])){

    $sql = "select product.id, category.name as cname, product.name, product.price, product.descrption, product.image, product.warranty from product join category on category.id = product.category_id where product.status = true LIMIT 16";
}else{
    $limit = 16+$_GET['page']*12;
    echo $sql = "select product.id, category.name as cname, product.name, product.price, product.descrption, product.image, product.warranty from product join category on category.id = product.category_id where product.status = true LIMIT $limit";
}


if (isset($_POST['search'])) {
    $text = $_POST['stext'];
    $sql = "select product.id, category.name as cname, product.name, product.price, product.descrption, product.image, product.warranty from product join category on category.id = product.category_id where product.status = true and product.name LIKE '%" . $text . "%' LIMIT 16";
}
$res4 = mysqli_query($conn, $sql);
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
    <div class="slideshow slideshow-wrapper pb-section">
        <div class="home-slideshow">
            <div class="slide slideshow--medium">
                <div class="blur-up lazyload">
                    <img class="blur-up lazyload" data-src="assets/images/slider/slider3.jpg" src="admin/slider/slider3.jpg" />
                    <div class="slideshow__text-wrap slideshow__overlay classic middle">
                        <div class="slideshow__text-content classic left">
                            <div class="container">
                                <div class="wrap-caption left">
                                    <h2 class="h1 mega-title slideshow__title"></h2>
                                    <span class="mega-subtitle slideshow__subtitle"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slide slideshow--medium">
                <div class="blur-up lazyload">
                    <img class="blur-up lazyload"   data-src="assets/images/slider/slider2.jpg" src="admin/slider/slider2.jpg" />
                    <div class="slideshow__text-wrap slideshow__overlay classic middle" onclick="window.location.href = 'shop.php';">
                
                    </div>
                </div>
            </div>
            <div class="slide slideshow--medium">
                <div class="blur-up lazyload">
                    <img class="blur-up lazyload" data-src="assets/images/slider/slider4.jpg" src="admin/slider/slider4.jpg" />
                    <div class="slideshow__text-wrap slideshow__overlay classic middle">
                        <div class="slideshow__text-content classic left">
                            <div class="container">
                                <div class="wrap-caption left">
                                    <h2 class="h1 mega-title slideshow__title"></h2>
                                    <span class="mega-subtitle slideshow__subtitle"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>




    <!-- <section class="splide" aria-label="Splide Basic HTML Example">
  <div class="splide__track">
		<ul class="splide__list">
			<li class="splide__slide">Slide 01</li>
			<li class="splide__slide">Slide 02</li>
			<li class="splide__slide">Slide 03</li>
		</ul>
  </div>
</section>

<script>
  document.addEventListener( 'DOMContentLoaded', function() {
    var splide = new Splide( '.splide' );
    splide.mount();
  } );
  
</script> -->


    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="section-header text-center">
                        <h2 class="h2">Shop By Category</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-2 text-center">
                    <a href="shop.php?id=10">
                        <img src="assets/images/category/1.jpg" class="img-fluid" style="vertical-align:middle;border-radius: 50%;">
                    </a>
                    <h3 style="font-size: 18px;font-weight: 600;margin: 0;padding-top: 14px;">Solar Panel</h3>
                </div>

                <div class="col-12 col-sm-12 col-md-12 col-lg-2 text-center">
                    <a href="shop.php?id=11">
                        <img src="assets/images/category/2.jpg" class="img-fluid" style="vertical-align:middle;border-radius: 50%;">
                    </a>
                    <h3 style="font-size: 18px;font-weight: 600;margin: 0;padding-top: 14px;">Solar batteries</h3>
                </div>

                <div class="col-12 col-sm-12 col-md-12 col-lg-2 text-center">
                    <a href="shop.php?id=12">
                        <img src="assets/images/category/3.jpg" class="img-fluid" style="vertical-align:middle;border-radius: 50%;">
                    </a>
                    <h3 style="font-size: 18px;font-weight: 600;margin: 0;padding-top: 14px;">Solar Lights</h3>
                </div>

                <div class="col-12 col-sm-12 col-md-12 col-lg-2 text-center">
                    <a href="shop.php?id=13">
                        <img src="assets/images/category/4.jpg" class="img-fluid" style="vertical-align:middle;border-radius: 50%;">
                    </a>
                    <h3 style="font-size: 18px;font-weight: 600;margin: 0;padding-top: 14px;">Solar Home Products</h3>
                </div>
  
                <div class="col-12 col-sm-12 col-md-12 col-lg-2 text-center">
                    <a href="shop.php?id=14">
                        <img src="assets/images/category/5.jpg" class="img-fluid" style="vertical-align:middle;border-radius: 50%;">
                    </a>
                    <h3 style="font-size: 18px;font-weight: 600;margin: 0;padding-top: 14px;">Pumps & Heater</h3>
                </div>

                <div class="col-12 col-sm-12 col-md-12 col-lg-2 text-center">
                    <a href="shop.php?id=15">
                        <img src="assets/images/category/6.jpg" class="img-fluid" style="vertical-align:middle;border-radius: 50%;">
                    </a>
                    <h3 style="font-size: 18px;font-weight: 600;margin: 0;padding-top: 14px;">Inverters & Batteries</h3>
                </div>


            </div>
        </div>
    </div>
</div>




<?php
if (mysqli_num_rows($res4) > 0) { ?>
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="section-header text-center">
                        <h2 class="h2">Hand-picked Items for you</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="grid-products">
                        <div class="row">
                            <?php
                            while ($row4 = mysqli_fetch_assoc($res4)) { ?>

                                <div class="col-6 col-sm-6 col-md-3 col-lg-3 item p-4">
                                    <div class="card h-100 shadow p-5">
                                        <div class="product-image">
                                            <a href="product-details.php?product_id=<?php echo $row4['id']; ?>" class="grid-view-item__link">
                                                <img class="primary blur-up lazyload" data-src="admin/<?php echo $row4['image']; ?>" src="admin/<?php echo $row4['image']; ?>" alt="image" title="product">
                                            </a>
                                            <form class="variants add" onclick="window.location.href='index.php?add_to_cart&product_id=<?php echo $row4['id']; ?>'" method="post">
                                                <button class="btn btn-addto-cart" type="button" tabindex="0">Add To Cart</button>
                                            </form>
                                        </div>
                                        <div class="product-details text-center">
                                            <div class="product-name">
                                                <a href="product-details.php?product_id=<?php echo $row4['id']; ?>"><?php echo substr($row4['name'], 0, 50); ?></a>
                                            </div>
                                            <div class="product-price">
                                                <span class="price">RS. <?php echo number_format($row4['price'], 2); ?></span>
                                            </div>
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
    </div>
<?php
} else {
    echo "<h1>No Product Found..</h1>";
}
?>
</div>
<div class="text-center">
<a href="?page=<?php if(empty($_GET['page'])){$page = 1;}else{$page = $_GET['page']+1;} echo $page;?>" class="btn btn-outline-primary p-3" >View More</a> 
</div>    
    

<div class="section feature-content mt-4">
    <div class="container">
        <div class="row">
            <div class="feature-row">
                <div class="col-12 col-sm-12 col-md-6 feature-row__item">
                    <img src="assets/images/advertisement-photo.png" alt="Solar House" title="solar" />
                </div>
                <div class="col-12 col-sm-12 col-md-6 feature-row__item feature-row__text feature-row__text--left text-left">
                    <div class="row-text">
                        <h1 class="h1">SOLAR ENERGY</h1>
                        <div class="rte-setting featured-row__subtext">
                            <p>Solar energy is the most abundant of all energy resources and can even be harnessed in cloudy weather. The rate at which solar energy is intercepted by the Earth is about 10,000 times greater than the rate at which humankind consumes energy.</p>
                            <p>Solar technologies can deliver heat, cooling, natural lighting, electricity, and fuels for a host of applications. Solar technologies convert sunlight into electrical energy either through photovoltaic panels or through mirrors that concentrate solar radiation.</p>
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