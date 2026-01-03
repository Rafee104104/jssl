<?php 
session_start();
include 'config/db.php';
include 'config/function.php';
$page="reports";
$user_id = $_SESSION['user_id'];
$order_no=$_GET['do'];
$order = findall('select * from ss_do_master where do_no="'.$order_no.'"');

include 'include/main_menu.php';


?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>Secondary Sales</title>

    <!-- manifest meta -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <!--<link rel="manifest" href="manifest.json" />-->

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="assets/img/favicon180.png" sizes="180x180">
    <link rel="icon" href="assets/img/favicon32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="assets/img/favicon16.png" sizes="16x16" type="image/png">

    <!-- Google fonts-->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- nouislider CSS -->
    <link href="assets/vendor/nouislider/nouislider.min.css" rel="stylesheet">

    <!-- date rage picker -->
    <link rel="stylesheet" href="assets/vendor/daterangepicker/daterangepicker.css">

    <!-- swiper carousel css -->
    <link rel="stylesheet" href="assets/vendor/swiperjs-6.6.2/swiper-bundle.min.css">

    <!-- style css for this template -->
    <link href="assets/scss/style.css" rel="stylesheet" id="style">
</head>
	<!-- pages wrapper -->
	<div class="pages-wrapper">
		
		<!-- profile -->
		<div class="profile">
			<div class="container">
				
<center><div class="alert alert-primary" role="alert">DO NO <?php echo $order_no;?> . Date # <?php echo $order->do_date;?></div>
<div><strong>Order Status: <?=$order->status;?></strong></div>
</center>		
<div class="container">           
  <table class="table table-sm">
    <thead>
      <tr>
			<th>#</th>
			<th class="text-left">Product</th>
			<th class="text-left">TP</th>
			<th class="text-left">%</th>
			<th class="text-left">Rate</th>
			<th class="text-left">Qty</th>
			<th class="text-left">TOTAL</th>
      </tr>
    </thead>
    <tbody>
<?php 
$res=mysqli_query($conn,"select distinct(d.id) ,d.*,i.item_name 
from ss_do_details d,item_info i,ss_do_master m
where m.do_no=d.do_no and m.do_no='$order_no' and  d.item_id=i.item_id GROUP by d.id");
$sl=1;
while($row=mysqli_fetch_object($res)){
?>			 
	<tr>
		<td class="no"><?php echo $sl++?></td>
		<td class="text-left"><?php echo $row->item_name?></td>
		<td class="unit"><?php echo $row->t_price?></td>
		<td class="unit"><?php echo $row->nsp_per?></td>
		<td class="unit"><?php echo $row->unit_price?></td>
		<td class="qty"><?php echo $row->total_unit?></td>
		<td class="total"><?php $total = ($row->unit_price*$row->total_unit); echo $total; $final_amount +=$total;?></td>
	</tr>
         <?php } ?>
	<tr>
	  <td class="no">&nbsp;</td>
	  <td class="no">&nbsp;</td>
	  <td class="no">&nbsp;</td>
	  <td class="text-left">&nbsp;</td>
	  <td class="unit">&nbsp;</td>
	  <td class="qty">&nbsp;</td>
	  <td class="total"><strong><?php echo $final_amount?></strong></td>
	  </tr>
    </tbody>
  </table>

<? if($order->status=='Manual'){?>  
 <a href="do.php?do_no=<?=$order_no?>" class="btn btn-primary btn-lg" role="button">Back to Order</a> 
<? }else{ ?> 
 <a href="home.php" class="btn btn-light shadow-sm btn-lg w-100 btn-rounded">Back to Home</a>
 <a href="do_status.php" class="btn btn-light shadow-sm btn-lg w-100 btn-rounded mt-2">Back to Order List</a>
 <? } ?>
</div>				
				

				




			</div>
		</div>
		<!-- end profile -->

	</div>
	<!-- end pages wrapper -->

<?php include 'include/footer.php'; ?>