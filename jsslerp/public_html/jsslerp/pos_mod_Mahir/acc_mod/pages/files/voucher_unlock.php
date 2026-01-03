<?php
session_start();
ob_start();

require_once "../../../assets/support/inc.all.php";
$title='Account Ledger';
 if(isset($_POST['unlock'])){
 	/////////secondary Journal Delete/////
		
		$sec_delete='delete from secondary_journal where jv_no=0';
		mysql_query($sec_delete);
	///////Journal Delete//////
	$jour_delete='delete from journal where jv_no=0';
	mysql_query($jour_delete);
 }
 
?>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>

   <form id="form1" name="form1" method="post" action="">
           <duv class="container">
		   		<div class="col-md-12 text-center">
					<input type="submit" class="btn btn-success" name="unlock" id="unlock" value="Unlock Voucher Page" />
				</div>
		   </div>    
	      </form>

 
 




<?
$main_content=ob_get_contents();
ob_end_clean();
include ("../../template/main_layout.php");
?>