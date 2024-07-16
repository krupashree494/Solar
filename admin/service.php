<?php 
    session_start();
    include 'config.php';
    $uid = $_SESSION['id'];

    if(!isset($_SESSION['login']))
    {
        header("Location: login.php");
    }
    include 'link.php';
    include 'admin_header.php';

    $date_filter = '';

    if(isset($_POST['submit'])) {
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];

        $from_date = mysqli_real_escape_string($conn, $from_date);
        $to_date = mysqli_real_escape_string($conn, $to_date);

        $date_filter = " WHERE service.date BETWEEN '$from_date' AND '$to_date'";
    }
?>

<button style="float:right" onclick="printDiv('printableArea')" type="button" class="btn btn-success">
    Print   <span class="glyphicon glyphicon-chevron-right"></span>
</button>

<div class="outter-wp">
<form method="post" action="">
<label>From Date:</label>
            <input type="date" name="from_date" value="<?php echo isset($_POST['from_date']) ? htmlentities($_POST['from_date']) : ''; ?>" required>
            <label>To Date:</label>
            <input type="date" name="to_date" value="<?php echo isset($_POST['to_date']) ? htmlentities($_POST['to_date']) : ''; ?>" required>
        <input type="submit" name="submit" value="Filter">
        <a class=" btn btn-danger btn-sm" href="service.php">Clear</a>
</form><br>

<div class="outter-wp" id="printableArea">
    <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped display table-hover" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Contact</th>
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
                $query = mysqli_query($conn, "SELECT service.id, service.amount, product.name AS pname, user.contact, service.id, service.service_no, user.first_name, user.last_name, user.username, user.contact, service.problem, service.date, service.status FROM service JOIN user ON service.userid=user.id JOIN product ON product.id = service.product_id $date_filter ORDER BY service.id DESC");
                
                $cnt = 1;
                while($row = mysqli_fetch_array($query)) {?>									
                    <tr>
                        <td><?php echo htmlentities($cnt);?></td>
                        <td><?php echo htmlentities($row['first_name']." ".$row['last_name']);?></td>
                        <td><?php echo htmlentities($row['contact']);?></td>
                        <td><?php echo htmlentities($row['pname']);?></td>
                        <td><?php echo htmlentities($row['service_no']);?></td>
                        <td><?php echo htmlentities($row['problem']);?></td>
                        <td><?php echo htmlentities($row['date']);?></td>
                        <td><?php echo $row['status'] ? 'Pending' : 'Solved';?></td>
                        <td><?php echo htmlentities($row['amount']);?></td>
                    </tr>
                    <?php $cnt = $cnt + 1; 
                } ?>
        </tbody>			
    </table>
</div>
            </div>
        
<?php
    include 'footer.php';
    include 'admin_sidebar.php';
?>
<script>
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
<script type="text/javascript" src="js/vroom.js"></script>
<script type="text/javascript" src="js/TweenLite.min.js"></script>
<script type="text/javascript" src="js/CSSPlugin.min.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
   <script src="js/bootstrap.min.js"></script>
</body>
</html>
