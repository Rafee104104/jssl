<?
//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');
//error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title><?=$module_name.' '.PROJECTS?></title>
<meta name="Developer" content="Md. Mhafuzur Rahman Cell:01815-224424 email:mhafuz@yahoo.com" />
<?
require_once "../../../assets/support/inc.all.js.php";
require_once "../../../assets/support/inc.all.css.php";
?>
</head>

<body>
<div class="wrapper">
			<div class="body_box">

					    <div class="body_middlebox_bar">

						

						

						<div class="sidebar" style="position: fixed; height:100%; overflow:scroll;scrollbar-width: none;" >

						<div class="title-image text-center" style="padding: 5px;">

						<!--<img src="../../../logo/<?$_SESSION['proj_id']?>.jpg" style="width:67%;" />-->
						<img src="../../../logo/demo7.png" style="width:67%;">

						</div>

						<?php

//$master_user = find_a_field('user_activity_management', 'master_user', '1');

?>



<h1 id="title_text" style="background: #0270b9; width: 100%; color: white; text-align:center; font-size:18px; margin:0px; margin-bottom:1px; padding: 10px 0px;">Accounts Module</h1>




<div class="menu_bg">










<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> <span> Admin Panel</a></div>



    <ul class="submenu">



        <li>   <a href="../files/project_info.php"<?php if($active=='projin') {} ?>><span> Project Info</span></a></li>

      

        <li>  <a href="../files/user_manage.php"<?php if($active=='usmanag') {} ?>><span> User Manage</span></a></li>

        



    </ul>

    

    

    




 <div class="silverheader"><a href="../files/dash_voucher.php"><i class="fa fa-cubes" aria-hidden="true"></i> <span> General Voucher</a></div>



    <ul class="submenu">
	


        <li>   <a href="../files/credit_note.php?mhafuz=2"<?php if($active=='recvou') {} ?>><span> Receipt Voucher</span></a></li>

		  <li>   <a href="../files/debit_note.php?mhafuz=2"<?php if($active=='dabit') {} ?>><span> Payment Voucher</span></a></li>

		    <li>   <a href="../files/journal_note_new.php?mhafuz=2" <?php if($active=='jourvo') {} ?>><span> Journal Voucher</span></a></li>

			  <li>   <a href="../files/coutra_note_new.php?mhafuz=2" <?php if($active=='contravou') {} ?>><span> Contra Voucher</span></a></li>
			  
			   <li>   <a href="../files/select_unfinished_voucher.php"<?php if($active=='vouview') {} ?>><span>Unfinished Voucher List</span></a></li>
		<li>   <a href="../files/unchecked_voucher_view.php" <?php if($active=='unvou') {} ?>><span> Unapproved General Vouchers</span></a></li>

			    <li>   <a href="../files/voucher_view.php"<?php if($active=='vouview') {} ?>><span>Approved General Voucher List</span></a></li>

				  

      
</ul>
       

    
	
	
	<div class="silverheader"><a href="../files/dash_voucher.php"><i class="fa fa-cubes" aria-hidden="true"></i> <span> Payment Request</a></div>



    <ul class="submenu">
	
	
	  <li>   <a href="../files/debit_note_request.php?mhafuz=2"<?php if($active=='dabit') {} ?>><span> New Payment Request</span></a></li>

</ul>



<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i>  Unapproved Payment Request </a></div>


    <ul class="submenu">


		   <li>  <a href="../files/payment_request_pending_ca.php"><span>Chief Accountant Approval</span></a></li>
		   
		   <li>  <a href="../files/payment_request_pending_fc.php"><span>Financial Controller Approval</span></a></li>
		   
		   <li>  <a href="../files/payment_request_pending_om.php"><span>Operation Manager Approval</span></a></li>
		   
		   <li>  <a href="../files/payment_request_pending_ceo.php"><span>CEO Approval</span></a></li>


    </ul>
	
	
	
<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Payment Status</a></div>


    <ul class="submenu">
	
		   <li><a href="../files/payment_request_status.php"><span>Payment Request Status</span></a></li>
		   
		   <li><a href="../files/payment_letter_status.php"><span>Payment Letter Status</span></a></li>
		   
		   
    </ul>







	
 <div class="silverheader"><a href="../files/dash_voucher.php"><i class="fa fa-cubes" aria-hidden="true"></i> <span> Special Voucher</a></div>



    <ul class="submenu">



        <li>   <a href="../files/receipt_voucher_dealer_selection.php"<?php if($active=='recvou') {} ?>><span>Chalan Wise Receipt Voucher</span></a></li>

		  <li>   <a href="../files/payment_voucher_vendor_selection.php"<?php if($active=='dabit') {} ?>><span>MRR Wise Payment Voucher</span></a></li>

		   

      

       

    </ul>


	<div class="silverheader"><a href="../files/dash_voucher.php"><i class="fa fa-cubes" aria-hidden="true"></i> <span> Manual Vouchers</a></div>



    <ul class="submenu">



	<li>   <a href="../files/bill_create.php"<?php if($active=='recvou') {} ?>><span> Bill Create</span></a></li>

	<li>   <a href="../files/select_bill.php"<?php if($active=='dabit') {} ?>><span> Bill Payment</span></a></li>

	<li>   <a href="../files/invoice_create.php"<?php if($active=='dabit') {} ?>><span> Invoice Create</span></a></li>

	<li>   <a href="../files/invoice_select.php"<?php if($active=='dabit') {} ?>><span> Invoice Receipt</span></a></li>


       

    </ul>


	

	

    

	

	

    

    

    <div class="silverheader"><a href="../files/dash_report.php"><i class="fa fa-cubes" aria-hidden="true"></i> <span> Report</a></div>



    <ul class="submenu">



        <li>  <a href="../files/chart_of_accounts2.php" <?php if($active=='treere') {} ?>><span> Chart of Accounts</span></a></li>

        <li>  <a href="../files/ledger_account1_report.php"<?php if($active=='legna') {} ?>><span> Ledger Group Name</span></a></li>

      <li>  <a href="../files/transaction_listledger.php"<?php if($active=='transstle') {} ?>><span> Transaction Statement (Ledger)</span></a></li>

      <li> <a href="../files/sale_proceeds_received_and_deposited.php" <?php if($active=='saleproceeds') {} ?>><span> Sale Proceeds Received and Deposited Report</span></a></li>

	   <li> <a href="../files/receipt&amp;paymant.php"<?php if($active=='recpay') {} ?>><span> Receipt &amp; Payment Statement(Ledger)</span></a></li>

	    <li> <a href="../files/receipt&amp;paymant_ledger.php"<?php if($active=='recpaymst') {} ?>><span> Receipt &amp; Payment Statement</span></a></li>

      

       

    </ul>

    

	

	

     <div class="silverheader"><a href="../files/dash_report.php"><i class="fa fa-cubes" aria-hidden="true"></i> <span> Advanced Report</a></div>



    <ul class="submenu">

   

		   <li>  <a href="../files/cash_book.php"<?php if($active=='cashbo') {} ?>><span> Cash Book</span></a></li>

		      <li>  <a href="../files/bank_book.php" <?php if($active=='bankbo') {} ?>><span> Bank Book</span></a></li>

			     <li>  <a href="../files/trial_balance_detail_new.php"<?php if($active=='transdetrep') {} ?>><span> Transection Detail Report</span></a></li>

				 <li>  <a href="../files/consolidated_trial_balance.php"<?php if($active=='consolidtrailbal') {} ?>><span> Consolidated Trial Balance</span></a></li>


    </ul>




<div class="silverheader"><a href=" ../files/dash_control.php"><i class="fa fa-cubes" aria-hidden="true"></i> <span> Financial Report</a></div>



    <ul class="submenu">

   

		   <li>  <a href="../files/financial_statement.php"><span> Financial Statement</span></a></li>

		      <li>  <a href="../files/financial_appropriation_accounts_new.php"><span> PL Appropriation Accounts</span></a></li>

			     <li>  <a href="../files/financial_profit_loss.php"><span> Profit & Loss Statement</span></a></li>

				

    </ul>


 
<div class="silverheader"><a href="  ../files/dash_support.php"><i class="fa fa-cubes" aria-hidden="true"></i> <span> Chalan Verification</a></div>



    <ul class="submenu">

   

		   <li>  <a href="../files/ch_received_amt.php"><span>Chalan Verify</span></a></li>

		      <li>  <a href="../files/ch_received_list.php"><span>Chalan Report</span></a></li>
		

    </ul>


<div class="silverheader"><a href="  ../files/dash_support.php"><i class="fa fa-cubes" aria-hidden="true"></i> <span> Sales Return Verification</a></div>


    <ul class="submenu">


		   <li>  <a href="../files/sr_received_amt.php"><span>Sales Return Verify</span></a></li>


    </ul>


<div class="silverheader"><a href="  ../files/dash_support.php"><i class="fa fa-cubes" aria-hidden="true"></i> <span> Purchased Order Verification</a></div>


    <ul class="submenu">


		   <li>  <a href="../files/purchased_verify_black_tea.php"><span>Purchased Verify (Black Tea)</span></a></li>
 <li>  <a href="../files/purchased_verify_packing_materials.php"><span>Purchased Verify (Packing Materials)</span></a></li>
 <li>  <a href="../files/purchased_verify_local_purchase.php"><span>Purchased Verify (Local Purchase)</span></a></li>
  <li>  <a href="../files/purchased_verify_black_tea.php"><span>Purchased Verify (Black Tea)</span></a></li>
    </ul>


<?php
 $sql = "SELECT  user_roll_manage.id,user_feature_manage.feature_icon ,user_feature_manage.feature_name, user_feature_manage.id as f_id from user_roll_manage left join user_roll_activity on user_roll_activity.user_id = user_roll_manage.id left join user_page_manage on user_page_manage.id = user_roll_activity.page_id left join user_feature_manage on user_feature_manage.id = user_page_manage.feature_id LEFT JOIN user_module_manage on user_module_manage.id = user_feature_manage.module_id where user_roll_activity.user_id = 3 and user_module_manage.module_name like '%acc%' GROUP BY user_feature_manage.id ";
$query = mysql_query($sql);
while($data = mysql_fetch_assoc($query)){
extract($data);
    ?>
    <div class="silverheader"><a href="#" ><i class="<?=$feature_icon?>"></i> <span> <?=$feature_name?></a></div>
    <ul class="submenu">
<?php
$sql1 = "SELECT user_page_manage.folder_name,user_page_manage.page_icon ,user_page_manage.page_link,user_page_manage.page_name  FROM `user_page_manage` left join user_roll_activity on user_roll_activity.page_id = user_page_manage.id where user_roll_activity.user_id = 3 and user_page_manage.feature_id='".$f_id."'";
$query1 = mysql_query($sql1);
while($data2 = mysql_fetch_assoc($query1)){
    extract($data2)
?>
    
        <li><a href="../<?=$folder_name?>/<?=$page_link?>"><span> <?=$page_name?></span></a></li>
    
    <?php
}
?>
</ul>
<?php
}
?>




    <div class="silverheader"><a href="#" ><i class="fas fa-sign-in-alt"></i> <span> Exit Program</a></div>



    <ul class="submenu">

        <li>

            <a href="../files/logout.php"><span> Log Out</span></a></li>
    </ul>



</div>





<div class="copyright" style="text-align:center">

   <img class="oe_logo_img" src="../../../logo/logo.png" height="40px;" >

</div>













						</div>

						<div class="main_content" style="width:82.5%">

						
<!--  


HEADER *************************************************************

-->

<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-fixed-top" >
<div class="button-bar ml-0"> <button type="button" id="collapse_sidebar" style="text-align:center" onclick="collapse_sidebar()"><i class="fa fa-caret-left fa-1x" style="line-height:2;"></i></button>
<button type="button" id="extract_sidebar" style="text-align:center;display:none" onclick="extract_sidebar()"><i class="fa fa-caret-right fa-2x"></i></button></div>
    <div class="container-fluid">

      <div class="navbar-header">
          <!--<a class="navbar-brand" href="#"><?php $_SESSION; echo $_SESSION['company_name']; ?></a></div>-->
		            <a class="navbar-brand" href="#" style="font-weight:bold;"><?php echo find_a_field('project_info','company_name','1'); ?></a></div>


      <!--<div class="collapse navbar-collapse" id="navbarNav">

    <ul class="navbar-nav">

      <li class="nav-item active">
 
        <a class="nav-link" href="../../../../sales_mod/pages/main/home.php">Home <span class="sr-only">(current)</span></a>

      </li>

      

     

    </ul>

  </div>-->

  <div class="clear"></div>

  <div class="userblock" style="right:248px!important;">

      <div id="avatar-upload" class="right circle">

        <div class="image-overlay dz-message"></div>

        <img src="../../../images/user/<?=$_SESSION['user']['id'];?>.jpg" class="userimg" alt=""/>
       <!--- <img src="../../../user_pic/user.png" class="userimg" alt=""/> --> 
       </div>



        <div id="user-settings-overlay" class="userdetail right vertical-centre">

            <div class="username">

                <?
				$user_info = find_all_field('user_activity_management','fname','user_id='.$_SESSION['user']['id']);
				echo $user_info->fname;
				?>            </div>

            <div class="company_name">

                <?=$user_info->designation;?></div>



        </div>

    </div>
   
		


	

  

		<div class="clear"></div>

		

		<div class="notificationblock" style="right:163px!important;">

        

       <!-- <a href="#" class="help_tooltip" data-toggle="tooltip" data-placement="bottom" data-original-title="Settings"><i class="fa fa-cogs"></i></a>



        <a href="#" class="help_tooltip" data-toggle="tooltip" data-placement="bottom" data-original-title="Notifications"><span class="badge animated zoomIn"></span><i class="fa fa-bell"></i></a>
-->


        <a href="../../pages/files/index.php" class="help_tooltip" data-toggle="tooltip" data-placement="bottom" data-original-title="Signout"><i class="fas fa-sign-out-alt"></i></a>
		

    </div>
	
<div id="clock" style="right:12px!important;">
<span class="date">{{ date }}</span>
<span class="time">{{ time }}</span>
<span class="text">IP: <?=$_SERVER['REMOTE_ADDR']?></span>
</div>


	<!--<div class="helpblock">

        <div class="help-switch pointer vertical-centre">

            <div class="on"><p>Help</p></div>

        </div>

    </div>-->

		

	    </div>

		  </nav>
		  
		  
		  
		  
		  <!-- *****************************  HEADER  *****************************-->		  



<div class="sr-main-content">
		  
<div class="sr-main-content-padding"><div class="sr-main-content-heading"><i class="fa fa-server" style="padding-right:10px;"></i><?=$title?></div></div>

<div class="sr-main-content-padding">
 <h2 style="font-size:18px; font-weight: bold ; color: #73879C;  padding-bottom: 10px;"></h2>
 <?=$main_content?>

						</div>
</div>
						</div>

                        </div>						

						</div>

						</div>		

			</div>
			
			
<script language="javascript">
var clock = new Vue({
    el: '#clock',
    data: {
        time: '',
        date: ''
    }
});

var week = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];
var timerID = setInterval(updateTime, 1000);
updateTime();
function updateTime() {
    var cd = new Date();
    clock.time = zeroPadding(cd.getHours(), 2) + ':' + zeroPadding(cd.getMinutes(), 2) + ':' + zeroPadding(cd.getSeconds(), 2);
    clock.date = zeroPadding(cd.getFullYear(), 4) + '-' + zeroPadding(cd.getMonth()+1, 2) + '-' + zeroPadding(cd.getDate(), 2) + ' ' + week[cd.getDay()];
};

function zeroPadding(num, digit) {
    var zero = '';
    for(var i = 0; i < digit; i++) {
        zero += '0';
    }
    return (zero + num).slice(-digit);
}
</script>
</body>
</html>

