<?php



session_start();



ob_start();



require_once "../../../assets/support/inc.all.php";



require_once ('../../common/class.numbertoword.php');



$title='Cash Book';

do_calander('#fdate');
do_calander('#tdate');

create_combobox('ledger_id');
create_combobox('cc_code');
$active='cashbo';

$proj_id=$_SESSION['proj_id'];



jv_double_check();



if($_SESSION['user']['group']>1)



$cash_and_bank_balance=find_a_field('ledger_group','group_id',"group_sub_class='1020' and group_for=".$_SESSION['user']['group']);



else



$cash_and_bank_balance=find_a_field('ledger_group','group_id','group_sub_class=1020');











if(isset($_REQUEST['show']))



{



$tdate=$_REQUEST['tdate'];



//fdate-------------------



$fdate=$_REQUEST["fdate"];



$ledger_id=$_REQUEST["ledger_id"];







if(isset($_REQUEST['tdate'])&&$_REQUEST['tdate']!='')



$report_detail.='<br>Report date : '.$_REQUEST['tdate'];



if(isset($_REQUEST['cc_code'])&&$_REQUEST['cc_code']!='')



$report_detail.='<br>CC Code : '.find_a_field('cost_center','center_name','id='.$_REQUEST["cc_code"]);











$j=0;



for($i=0;$i<strlen($fdate);$i++)



{



if(is_numeric($fdate[$i]))



$time1[$j]=$time1[$j].$fdate[$i];







else $j++;



}







//$fdate=mktime(0,0,-1,$time1[1],$time1[0],$time1[2]);







//tdate-------------------











$j=0;



for($i=0;$i<strlen($tdate);$i++)



{



if(is_numeric($tdate[$i]))



$time[$j]=$time[$j].$tdate[$i];



else $j++;



}



//$tdate=mktime(23,59,59,$time[1],$time[0],$time[2]);











}



?>



<?php  



	



	$led1=mysql_query("SELECT id, center_name FROM cost_center WHERE 1 ORDER BY center_name");



	  if(mysql_num_rows($led1) > 0)



	  {	



		  $data1 = '[';



		  while($ledg1 = mysql_fetch_row($led1)){



			  $data1 .= '{ name: "'.$ledg1[1].'", id: "'.$ledg1[0].'" },';



		  }



		  $data1 = substr($data1, 0, -1);



		  $data1 .= ']';



	  }



	  else



	  {



		$data1 = '[{ name: "empty", id: "" }]';



	  }



?>



<script type="text/javascript">







$(document).ready(function(){







    function formatItem(row) {



		//return row[0] + " " + row[1] + " ";



	}



	function formatResult(row) {



		return row[0].replace(/(<.+?>)/gi, '');



	}







    var data = <?php echo $data; ?>;



    $("#ledger_id").autocomplete(data, {



		matchContains: true,



		minChars: 0,



		scroll: true,



		scrollHeight: 300,



        formatItem: function(row, i, max, term) {



            return row.name + " [" + row.id + "]";



		},



		formatResult: function(row) {



			return row.id;



		}



	});



	



	var data = <?php echo $data1; ?>;



    $("#cc_code").autocomplete(data, {



		matchContains: true,



		minChars: 0,        



		scroll: true,



		scrollHeight: 300,



        formatItem: function(row, i, max, term) {



            return row.name + " : [" + row.id + "]";



		},



		formatResult: function(row) {            



			return row.id;



		}



	});	



  });



	



</script>



<!--<script type="text/javascript">



$(document).ready(function(){



	



	$(function() {



		$("#fdate").datepicker({



			changeMonth: true,



			changeYear: true,



			dateFormat: 'dd-mm-y'



		});



	});



		$(function() {



		$("#tdate").datepicker({



			changeMonth: true,



			changeYear: true,



			dateFormat: 'dd-mm-y'



		});



	});







});



</script>-->


<style>
.box_report{
	border:3px solid cadetblue;
	background:aliceblue;
}

</style>













	<div class="form-container_large">

		<form  id="form1" name="form1" method="post" action="">
			<div class="d-flex  justify-content-center">

				<div class="n-form1 fo-short pt-2">
					<div class="container">
						<div class="form-group row  m-0 mb-1 pl-3 pr-3">
							<label for="group_for" class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">From Date :</label>
							<div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0 pr-2">
								<input name="fdate" type="text" id="fdate" size="12"  class="form-control" value="<?php echo $_REQUEST['fdate'];?>" autocomplete="off"/>
							</div>
						</div>

						<div class="form-group row  m-0 mb-1 pl-3 pr-3">
							<label for="group_for" class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">To Date :</label>
							<div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0 pr-2">
								<input name="tdate" type="text" id="tdate" size="12"  class="form-control" value="<?php echo $_REQUEST['tdate'];?>" autocomplete="off"/>
							</div>
						</div>

						<div class="form-group row  m-0 mb-1 pl-3 pr-3">
							<label for="group_for" class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Cash Head :</label>
							<div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0 pr-2">


								<select name="ledger_id" id="ledger_id" class="form-control">
									<option value="0"></option>

									<?
									$cash_group= find_a_field('config_group_class','cash_group','group_for="'.$_SESSION['user']['group'].'"');
									foreign_relation('accounts_ledger','ledger_id','ledger_name',$c_id,"ledger_group_id=".$cash_group." order by ledger_id");

									?>
								</select>

							</div>
						</div>


					</div>

					<div class="n-form-btn-class">
						<input class="btn1 btn1-bg-submit" name="show" type="submit" id="show" value="Show" />

					</div>

				</div>

			</div>

		</form>


	<p class="#"> <? include('PrintFormat.php');?> </p>
		<div class="container-fluid">
		



			<div id="reporting">
				<div id="grp">

<?php
if(isset($_REQUEST['show'])) {







$cc_code = (int) $_REQUEST['cc_code'];
$c = 0;
$cr_total = 0;
$dr_total = 0;

// ---------- Collect JV numbers ----------
$psql = "SELECT a.jv_no FROM journal a 
         WHERE jv_date BETWEEN '$fdate' AND '$tdate' 
         AND a.ledger_id='$ledger_id' 
         ORDER BY a.jv_date,a.tr_no";
$pquery = mysql_query($psql);
$jvs = '';
while($info = mysql_fetch_object($pquery)){
    $c++;
    $jvs .= ($c == 1) ? $info->jv_no : ','.$info->jv_no;
}

// ---------- Opening, Current & Closing Balance ----------
if($cc_code > 0){
    $op = "SELECT SUM(dr_amt)-SUM(cr_amt) FROM journal 
           WHERE ledger_id='$ledger_id' AND jv_date<'$fdate' AND cc_code=$cc_code";
    $cur = "SELECT SUM(dr_amt)-SUM(cr_amt) FROM journal 
           WHERE ledger_id='$ledger_id' AND jv_date BETWEEN '$fdate' AND '$tdate' AND cc_code=$cc_code";
} else {
    $op = "SELECT SUM(dr_amt)-SUM(cr_amt) FROM journal 
           WHERE ledger_id='$ledger_id' AND jv_date<'$fdate'";
    $cur = "SELECT SUM(dr_amt)-SUM(cr_amt) FROM journal 
           WHERE ledger_id='$ledger_id' AND jv_date BETWEEN '$fdate' AND '$tdate'";
}

$open = mysql_fetch_row(mysql_query($op));
$current = mysql_fetch_row(mysql_query($cur));
$close = $open[0] + $current[0];

// ---------- Get Opposite Ledgers ----------
if($cc_code > 0){
    $p = "SELECT a.jv_no,a.jv_date,a.tr_no,a.tr_from,a.narration,a.cheq_no,a.cheq_date,
                 a.dr_amt,a.cr_amt,b.ledger_name
          FROM journal a
          JOIN accounts_ledger b ON a.ledger_id=b.ledger_id
          WHERE a.cc_code=$cc_code 
            AND a.ledger_id!='$ledger_id' 
            AND a.jv_no IN ($jvs)
          ORDER BY a.jv_date,a.tr_no";
} else {
    $p = "SELECT a.jv_no,a.jv_date,a.tr_no,a.tr_from,a.narration,a.cheq_no,a.cheq_date,
                 a.dr_amt,a.cr_amt,b.ledger_name
          FROM journal a
          JOIN accounts_ledger b ON a.ledger_id=b.ledger_id
          WHERE a.ledger_id!='$ledger_id' 
            AND a.jv_no IN ($jvs)
          ORDER BY a.jv_date,a.tr_no";
}

$q = mysql_query($p);

$received = [];
$payments = [];

// ---------- Filter by Matching Amount with Cash Ledger ----------
while($row = mysql_fetch_object($q)){

    // Get all cash ledger entries for the same JV
    $cash_sql = "SELECT dr_amt, cr_amt,tr_from FROM journal 
                 WHERE jv_no='$row->jv_no' AND ledger_id='$ledger_id'";
    if($cc_code > 0) $cash_sql .= " AND cc_code=$cc_code";
    $cash_q = mysql_query($cash_sql);

   $is_payment = ($row->tr_from == 'Payment');

while($cash = mysql_fetch_object($cash_q)) {

    // If Payment ? show all opposite ledgers, no amount match needed
    if($is_payment){
        if($row->dr_amt > 0) $received[] = $row;
        if($row->cr_amt > 0) $payments[] = $row;
        break; // no need to check more
    }

    // Normal logic (matching amount)
    if(($row->dr_amt == $cash->cr_amt && $row->dr_amt > 0) ||
       ($row->cr_amt == $cash->dr_amt && $row->cr_amt > 0)) {

        if($row->dr_amt > 0) $received[] = $row;
        if($row->cr_amt > 0) $payments[] = $row;
    }
}


    }


// ---------- Display Two Tables ----------
echo '<div style="width:100%; margin:0 auto; font-family:Arial, sans-serif;">';
echo '<div style="display:flex; width:100%;">';

// ====== Received (Dr) ======
echo '<div style="flex:1; padding:5px;">';
echo '<h4>Received / Dr</h4>';
echo '<table border="1" cellspacing="0" cellpadding="4" width="100%" style="border-collapse:collapse;">';
echo '<tr><th>#</th><th>Date</th><th>Voucher</th><th>Type</th><th>Ledger</th><th>Narration</th><th align="right">Amount</th></tr>';
$i=0; $cr_total=0;
foreach($payments as $r){
    $i++;
    echo "<tr>
            <td>$i</td>
            <td>$r->jv_date</td>
            <td><a href='general_voucher_print_view_from_journal.php?jv_no=$r->jv_no' target='_blank'>$r->tr_no</a></td>
            <td>$r->tr_from</td>
            <td>$r->ledger_name</td>
            <td>$r->narration</td>
            <td align='right'>".number_format($r->cr_amt,2)."</td>
          </tr>";
    $cr_total += $r->cr_amt;
}
echo "<tr><th colspan='6' align='right'>Total</th><th align='right'>".number_format($cr_total,2)."</th></tr>";
echo '</table></div>';

// ====== Payments (Cr) ======
echo '<div style="flex:1; padding:5px;">';
echo '<h4 style="text-align:right;">Payments / Cr</h4>';
echo '<table border="1" cellspacing="0" cellpadding="4" width="100%" style="border-collapse:collapse;">';
echo '<tr><th>#</th><th>Date</th><th>Voucher</th><th>Type</th><th>Ledger</th><th>Narration</th><th align="right">Amount</th></tr>';
$i=0; $dr_total=0;
foreach($received as $r){
    $i++;
    echo "<tr>
            <td>$i</td>
            <td>$r->jv_date</td>
            <td><a href='general_voucher_print_view_from_journal.php?jv_no=$r->jv_no' target='_blank'>$r->tr_no</a></td>
            <td>$r->tr_from</td>
            <td>$r->ledger_name</td>
            <td>$r->narration</td>
            <td align='right'>".number_format($r->dr_amt,2)."</td>
          </tr>";
    $dr_total += $r->dr_amt;
}
echo "<tr><th colspan='6' align='right'>Total</th><th align='right'>".number_format($dr_total,2)."</th></tr>";
echo '</table></div>';

echo '</div>'; // end flex container

// ---------- Summary Section ----------
echo '<br><br>';
echo '<table width="100%" cellspacing="0" cellpadding="4" border="1" style="border-collapse:collapse; font-family:Arial, sans-serif;">';
echo '<tr><th width="70%" style="text-align:left;">Opening Balance :</th><th width="30%" style="text-align:right;">'.number_format($open[0],2).'</th></tr>';
echo '<tr class="alt"><th style="text-align:left;">Received in this Period :</th><th style="text-align:right;">'.number_format($cr_total,2).'</th></tr>';
$total = ($open[0]) + $cr_total;
echo '<tr class="alt"><th style="text-align:left;">Total after Received :</th><th style="text-align:right;">'.number_format($total,2).'</th></tr>';
echo '<tr class="alt"><th style="text-align:left;">Payment in this Period :</th><th style="text-align:right;">'.number_format($dr_total,2).'</th></tr>';
$close2 = $total - $dr_total;
$closing_display = $close2 > 0 ? number_format($close2,2) : "(".number_format(abs($close2),2).")";
echo '<tr><th style="text-align:left;">Closing Balance :</th><th style="text-align:right;">'.$closing_display.'</th></tr>';
echo '</table>';

// ---------- Amount In Words ----------
echo '<br><strong>Amount In Words:</strong> ';
if($close2 < 0){
    echo convertNumberMhafuz(abs($close2));
} else {
    echo convertNumberMhafuz($close2);
}

echo '</div>'; // end main wrapper


}

?>


</div>
</div>
</div>
<br /><br /><br />
<table width="100%" border="0">
<tr>
    <th style="text-align:center">----------------------------</th>
    <th style="text-align:center">-----------------------</th>
    <th style="text-align:center">-----------------------------</th>
    <th style="text-align:center">---------------------------</th>
    <th style="text-align:center">--------------------</th>
  </tr>
  <tr>
    <th style="text-align:center">Executive,Accounts</th>
    <th style="text-align:center">Manager (Admin)</th>
    <th style="text-align:center">Manager (Operation)</th>
    <th style="text-align:center">Manager, Accounts</th>
    <th style="text-align:center">GM(Operation)</th>
  </tr>
</table>




<?


$main_content=ob_get_contents();



ob_end_clean();



require_once "../../template/main_layout.php";



?>