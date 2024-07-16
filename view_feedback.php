<?php
    require_once 'include/header-ink.php';
    include 'config/connection.php';

    session_start();
    if(empty($_SESSION['login']))
    {
        header ("Location: login.php");
    }

    if(isset($_GET['del']))
    {
        if(mysqli_query($conn,"delete from feedback where id = '".$_GET['id']."'"))
        {
            echo "<script>alert('Feedback deleted successfully..!')</script>";
        }
        else
        {
            echo "<script>alert('Unable to delete feedback..!')</script>";
            echo mysqli_error($conn);
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
               <div class="col-2"></div>
                <div class="col-8">
                	<div class="mb-4 card p-5" style="margin-top: 150px;">
                        <div class="page-title">
                            <div class="wrapper text-center"><h1 class="page-width">View Feed</h1></div>
                        </div>
                       <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped   display table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>User Name</th>
                                        <th>Product</th>
                                        <th>Contact</th>
                                        <th>Feedback</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php 
                                    $query=mysqli_query($conn,"select product.name as pname, feedback.id, user.first_name, user.last_name, user.username, user.contact, feedback.feedback, feedback.date, feedback.status from feedback join user on feedback.userid=user.id join product on product.id = feedback.product_id where feedback.status=true order by feedback.id desc");
                                    $cnt=1;
                                    while($row=mysqli_fetch_array($query))
                                    {?>                                 
                                        <tr>
                                            <td><?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($row['first_name']." ".$row['last_name']);?></td>
                                            <td><?php echo htmlentities($row['username']);?></td>
                                            <td><?php echo htmlentities($row['pname']);?></td>
                                            <td><?php echo htmlentities($row['contact']);?></td>
                                            <td><?php echo htmlentities($row['feedback']);?></td>
                                            <td><?php echo htmlentities($row['date']);?></td>
                                            <td> <?php if($row['status']){echo 'Active';}else{echo 'In-Active';}?></td>
                                            <td>
                                                <a href="view_feedback.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">Delete</a></td>
                                        </tr>
                                        <?php $cnt=$cnt+1; 
                                    } ?>
                                </tbody>            
                            </table>
                    </div>
               	</div>
            </div>
        </div>
        
    </div>
    
    <?php 
        require_once 'include/footer.php';
        require_once 'include/footer-link.php';
    ?>