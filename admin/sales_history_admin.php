<?php 
    session_start();
    include 'config.php';
    $uid = $_SESSION['id'];

    if(!isset($_SESSION['login'])) {
        header("Location: login.php");
        exit;
    }
    
    include 'link.php';
    include 'admin_header.php';

    $date_filter = '';

    if(isset($_POST['from_date']) && isset($_POST['to_date'])) {
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];
        $from_date = mysqli_real_escape_string($conn, $from_date);
        $to_date = mysqli_real_escape_string($conn, $to_date);
        $date_filter = "WHERE date BETWEEN '$from_date' AND '$to_date'";
    }
?>
    <div class="outter-wp">
        <form method="post" action="">
            <label>From Date:</label>
            <input type="date" name="from_date" value="<?php echo isset($_POST['from_date']) ? htmlentities($_POST['from_date']) : ''; ?>" required>
            <label>To Date:</label>
            <input type="date" name="to_date" value="<?php echo isset($_POST['to_date']) ? htmlentities($_POST['to_date']) : ''; ?>" required>
            <input type="submit" name="submit" value="Filter">
            <a class="btn btn-danger" href="sales_history_admin.php">Clear</a>
        </form><br>

<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped display table-hover" width="100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Bill No</th>
            <th>Buyer Name</th>
            <th>Address</th>
            <th>City</th>
            <th>Pin Code</th>
            <th>Payment No</th>
            <th>Payment Method</th>
            <th>Bill Amount</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $query = mysqli_query($conn, "SELECT * FROM purchase $date_filter ORDER BY id DESC");
            $cnt = 1;
            while($row = mysqli_fetch_array($query)) {
        ?>									
            <tr>
                <td><?php echo htmlentities($cnt);?></td>
                <td><?php echo htmlentities($row['product_track']);?></td>
                <td><?php echo htmlentities($row['user_fullname']);?></td>
                <td><?php echo htmlentities($row['user_address']);?></td>
                <td><?php echo htmlentities($row['user_city']);?></td>
                <td><?php echo htmlentities($row['user_pin']);?></td>
                <td><?php echo htmlentities($row['payment_no']);?></td>
                <td><?php echo htmlentities($row['payment_method']);?></td>
                <td><?php echo htmlentities($row['amount']);?></td>
                <td><?php echo htmlentities($row['date']);?></td>
            </tr>
            <?php $cnt = $cnt + 1; 
            } ?>
    </tbody>			
</table>
    </div>

<?php
    include 'footer.php';
    include 'admin_sidebar.php';
?>
