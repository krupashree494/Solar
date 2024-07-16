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
        $date_filter = " WHERE trackorder.date BETWEEN '$from_date' AND '$to_date'";
    }
?>
    <button style="float:right" onclick="printDiv('printableArea')" type="button" class="btn btn-success">
    Print   <span class="glyphicon glyphicon-chevron-right"></span>
</button>

<div class="outter-wp" id="printableArea">
    <form method="post" action="">
    <label>From Date:</label>
            <input type="date" name="from_date" value="<?php echo isset($_POST['from_date']) ? htmlentities($_POST['from_date']) : ''; ?>" required>
            <label>To Date:</label>
            <input type="date" name="to_date" value="<?php echo isset($_POST['to_date']) ? htmlentities($_POST['to_date']) : ''; ?>" required>
        <input type="submit" name="submit" value="Filter">
        <a class="btn btn-danger" href="purchase.php">Clear</a>
    </form><br>

    <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display table-hover" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Bill No</th>
                <th>Buyer Name</th>
                <th>Contact</th>
                <th>Payment No</th>
                <th>Bill Amount</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                // Modify the SQL query to include date filtering
                $query=mysqli_query($conn,"SELECT DISTINCT trackorder.trackno, trackorder.date, user_payment.payment_no, user_payment.amount, user.first_name, user.last_name, user.contact FROM orders JOIN trackorder ON trackorder.id = orders.trackid JOIN user_payment ON user_payment.payment_id = orders.payment_id JOIN user ON user.id = orders.userid $date_filter");
                
                $cnt=1;
                while($row=mysqli_fetch_array($query)) {?>									
                    <tr>
                        <td><?php echo htmlentities($cnt);?></td>
                        <td><?php echo htmlentities($row['trackno']);?></td>
                        <td><?php echo htmlentities($row['first_name']." ".$row['last_name']);?></td>
                        <td><?php echo htmlentities($row['contact']);?></td>
                        <td><?php echo htmlentities($row['payment_no']);?></td>
                        <td><?php echo htmlentities($row['amount']);?></td>
                        <td><?php echo htmlentities($row['date']);?></td>
                    </tr>
                    <?php $cnt=$cnt+1; 
                } ?>
        </tbody>			
    </table>
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
<!--js -->
<script type="text/javascript" src="js/vroom.js"></script>
<script type="text/javascript" src="js/TweenLite.min.js"></script>
<script type="text/javascript" src="js/CSSPlugin.min.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>
