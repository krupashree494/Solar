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
                <div class="col-12">
                	<div class="mb-4 card p-5" style="margin-top: 190px;">
                        <div class="page-title">
                            <div class="wrapper text-center">
                                <h1 class="page-width">Your Service Request</h1>
                            </div>

                            <table cellpadding="0" cellspacing="0" border="0" class="mt-4 datatable-1 table table-bordered table-striped  display table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Product</th>
                                        <th>Service No</th>
                                        <th>Problem</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php 
                                    $query=mysqli_query($conn,"select product.name as pname, service.id, service.amount, service.service_no, user.first_name, user.last_name, user.username, user.contact, service.problem, service.date, service.status from service join user on service.userid=user.id join product on product.id = service.product_id WHERE user.id =' $_SESSION[id]' order by service.id desc");
                                    $cnt=1;
                                    while($row=mysqli_fetch_array($query))
                                    {?>                                 
                                        <tr>
                                            <td><?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($row['first_name']." ".$row['last_name']);?></td>
                                            <td><?php echo htmlentities($row['pname']);?></td>
                                            <td><?php echo htmlentities($row['service_no']);?></td>
                                            <td><?php echo htmlentities($row['problem']);?></td>
                                            <td><?php echo htmlentities($row['date']);?></td>
                                            <td> <?php if($row['status']){echo 'Pending';}else{echo 'Solved';}?></td>
                                            <td><?php echo htmlentities($row['amount']);?></td>
                                        </tr>
                                        <?php $cnt=$cnt+1; 
                                    } ?>
                                </tbody>            
                            </table>

                        </div>
                    </div>
               	</div>
                <div class="col-2"></div>
            </div>
        </div>
        
    </div>
    
    <?php 
        require_once 'include/footer.php';
        require_once 'include/footer-link.php';
    ?>