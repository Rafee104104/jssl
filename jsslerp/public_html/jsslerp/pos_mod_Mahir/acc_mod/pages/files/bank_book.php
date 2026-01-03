<?php

session_start();

ob_start();

require_once "../../../assets/support/inc.all.php";

require_once ('../../common/class.numbertoword.php');

jv_double_check();

$title='Bank Book';

do_calander('#fdate');
do_calander('#tdate');

create_combobox('ledger_id');
create_combobox('cc_code');

$active='bankbo';
$proj_id=$_SESSION['proj_id'];

if($_SESSION['user']['group']>1)

$cash_and_bank_balance=find_a_field('ledger_group','group_id',"group_sub_class='1020' ");

else

$cash_and_bank_balance=find_a_field('ledger_group','group_id','group_sub_class=1020');

if(isset($_REQUEST['show']))

{

$tdate=$_REQUEST['tdate'];

//fdate-------------------

$fdate=$_REQUEST["fdate"];

$ledger_id=$_REQUEST["ledger_id"];

if(isset($_REQUEST['tdate'])&&$_REQUEST['tdate']!='')

$report_detail.='<br>Period: '.$_REQUEST['fdate'].' to '.$_REQUEST['tdate'];

if(isset($_REQUEST['ledger_id'])&&$_REQUEST['ledger_id']!=''&&$_REQUEST['ledger_id']!='%')

$report_detail.='<br>Ledger Name : '.find_a_field('accounts_ledger','ledger_name','ledger_id='.$_REQUEST["ledger_id"]);

if(isset($_REQUEST['cc_code'])&&$_REQUEST['cc_code']!='')

$report_detail.='<br>Cost Center: '.find_a_field('cost_center','center_name','id='.$_REQUEST["cc_code"]);

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
							<label for="group_for" class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">From Date  :</label>
							<div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0 pr-2">

								<input name="fdate" type="text" id="fdate" size="12" class="form-control" value="<?php echo $_REQUEST['fdate'];?>" autocomplete="off"/>

							</div>
						</div>

						<div class="form-group row  m-0 mb-1 pl-3 pr-3">
							<label for="group_for" class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">To Date:</label>
							<div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0 pr-2">

								<input name="tdate" type="text" id="tdate" size="12" class="form-control" value="<?php echo $_REQUEST['tdate'];?>" autocomplete="off"/>


							</div>
						</div>

						<div class="form-group row  m-0 mb-1 pl-3 pr-3">
							<label for="group_for" class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Bank Head :</label>
							<div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0 pr-2">


								<select name="ledger_id" id="ledger_id" class="form-control" >

									<option value="0"></option>

									<?

									foreign_relation('accounts_ledger','ledger_id','ledger_name',$b_id,"ledger_group_id=126002  order by ledger_id");

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




		<div class="container-fluid">
			<p class="#"> <? include('PrintFormat.php');?></p>



			<div id="reporting">
				<div id="grp">

					<table class="table1  table-striped table-bordered table-hover table-sm">

						<thead class="thead1">
						<tr class="bgc-info">
							<th>S/N</th>
							<th>Date</th>
							<th>Voucher No</th>
							<th>Type</th>
							<th>Head Of A/C</th>
							<th>Narration</th>
							<th>Debit(TK)</th>
							<th>Credit(TK)</th>
						</tr>


						</thead>
						<tbody class="tbody1">


						<?php

						if(isset($_REQUEST['show']))

						{

							$cc_code = (int) $_REQUEST['cc_code'];



							$psql		= "select a.jv_no from journal a where  jv_date between '$fdate' and '$tdate' and  a.ledger_id='$ledger_id' order by a.jv_date,a.tr_no";

							$pquery		= mysql_query($psql);

							$pcount     = mysql_num_rows($pquery);

							if($pcount>0)

							{

								while($info=mysql_fetch_object($pquery)){

									++$c;

									if($c==1){$jvs .= $info->jv_no;}

									else{$jvs .= ','.$info->jv_no;}

								}

							}

							//echo $jvs;

							$join=" and tr_from in('Receipt','Payment','Opening','Journal_info','Contra')";

							if($cc_code > 0)

							{





								$op		= "select SUM(dr_amt)-SUM(cr_amt) from journal where ledger_id ='$ledger_id' and jv_date<'$fdate' and 1 AND cc_code=$cc_code ";



								$open	= mysql_fetch_row(mysql_query($op));

								$cur	= "select SUM(dr_amt)-SUM(cr_amt) from journal where ledger_id ='$ledger_id' and jv_date between '$fdate' and '$tdate' and 1 AND cc_code=$cc_code ";



								$current = mysql_fetch_row(mysql_query($cur));

								$close	= $open[0]+$current[0];



								$p		= "select a.jv_date,b.ledger_name,a.dr_amt,a.cr_amt,a.tr_no,a.narration,a.tr_from,a.cheq_no,a.cheq_date from journal a,accounts_ledger b where a.ledger_id=b.ledger_id AND a.cc_code=$cc_code and jv_no in (".$jvs.") and a.ledger_id!='$ledger_id' order by a.jv_date,a.tr_no";

							}

							else

							{





								$op		= "select SUM(dr_amt)-SUM(cr_amt) from journal where ledger_id ='$ledger_id' and jv_date<'$fdate' ".$join;;

								$open	= mysql_fetch_row(mysql_query($op));

								$cur	= "select SUM(dr_amt)-SUM(cr_amt) from journal where ledger_id ='$ledger_id' and jv_date between '$fdate' and '$tdate' ".$join;;





								$current = mysql_fetch_row(mysql_query($cur));

								$close	= $open[0]+$current[0];

								$p		= "select a.jv_date,b.ledger_name,a.dr_amt,a.cr_amt,a.tr_no,a.narration,a.tr_from,a.jv_no,a.cheq_no,a.cheq_date from journal a,accounts_ledger b where a.ledger_id=b.ledger_id and jv_no in (".$jvs.") and a.ledger_id!='$ledger_id' ".$join." order by a.jv_date,a.tr_no";



							}

							$i=0;

							$report = mysql_query($p);

							$old_jv = 1;

							while($rp=mysql_fetch_row($report)){

								if($old_jv != $rp[4]) $i++; else echo '&nbsp;';

								if($i%2==0)$cls=' class="alt"'; else $cls='';



								$cr_total=$cr_total+$rp[3];

								$dr_total=$dr_total+$rp[2];



								if($old_tp != $rp[6]) $i=1;$old_tp = $rp[6];



								?>

								<tr<?=$cls?>>

									<td><? if($old_jv != $rp[4]) echo $i;?></td>
<td><? echo $rp[0];?></td>
									<td><?





										if($old_jv != $rp[4])

										{

											//if($rp[6]=='Receipt'||$rp[6]=='Payment'||$rp[6]=='Journal_info'||$rp[6]=='Contra'){
//										$link="voucher_print.php?v_type=".$rp[6]."&v_date=".$ro[0]."&view=1&vo_no=".$rp[7];
//										echo "<a href='$link' target='_blank'>".$rp[4]."</a>";
//										}else
//										{
//										echo $rp[4];
//										}


											$link="general_voucher_print_view_from_journal.php?jv_no=".$rp[7];
											echo "<a href='$link' target='_blank'>".$rp[4]."</a>";

										}?></td>

									<td><? if($old_jv != $rp[4]) echo $rp[6];?></td>

									<td><?=$rp[1];?></td>

									<td ><?=$rp[5];?><?=(($rp[8]!='')?'-Cq#'.$rp[8]:'');?><?=(($rp[9]>943898400)?'-Cq-Date#'.date('d-m-Y',$rp[9]):'');?></td>

									<td style="text-align:right"><?=$rp[2];?></td>

									<td style="text-align:right"><?=$rp[3];?></td>

								</tr>

								<?php $old_jv = $rp[4];  }

							?>

							<tr>

								<th colspan="6" align="right">Total : </th>

								<th><?=number_format($dr_total,2);?></th>

								<th><?=number_format($cr_total,2);?></th>

							</tr>

							<?

						}?>

						</tbody>
					</table>
					<br>
					<br>




					<table class="tabledesign"   width="100%" cellspacing="0" cellpadding="2" border="0">



						<tr>

							<th width="70%">Opening Balance : </th>

							<th width="30%" align="right"><?php if($open[0]==0) echo "0.00"; else echo number_format($open[0],2);?></th>

						</tr>

						<tr class="alt">

							<th>Received in this Period : </th>

							<th align="right"><?=number_format($cr_total,2);?></th>

						</tr>

						<tr class="alt">

							<th>Total after Received : </th>

							<th align="right"><?=number_format(($open[0]+$cr_total),2);?></th>

						</tr>

						<tr class="alt">

							<th>Payment in this Period : </th>

							<th align="right"><?=number_format($dr_total,2);?></th>

						</tr>



						<tr>

							<th>Closing Balance : </th>

							<th align="right"><?php echo number_format($close,2);?></th>

						</tr>


					</table>


					<br />



					Amount Inwords:



					<?=convertNumberMhafuz($close)?>



					<br />



					<br /><br /><br />



					<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-bottom:#FFFFFF">

						<tr style="border-bottom:#FFFFFF">



							<td align="center" valign="bottom" style="border-bottom:#FFFFFF;border-left:0px;;border-right:0px; border-bottom:0px;">........................</td>

							<td align="center" valign="bottom" style="border-bottom:#FFFFFF; border-left:0px;border-right:0px; border-bottom:0px;">........................</td>

							<td align="center" valign="bottom" style="border-bottom:#FFFFFF; border-left:0px;border-right:0px; border-bottom:0px;">........................</td>

							<td align="center" valign="bottom" style="border-bottom:#FFFFFF; border-left:0px;border-right:0px; border-bottom:0px;">........................</td>

						</tr>

						<tr>



							<td style="border-bottom:#FFFFFF; border-left:0px;border-right:0px; border-bottom:0px;"><div align="center">Prepared by </div></td>

							<td style="border-bottom:#FFFFFF; border-left:0px;border-right:0px; border-bottom:0px;"><div align="center">Checked by </div></td>

							<td style="border-bottom:#FFFFFF; border-left:0px;border-right:0px; border-bottom:0px;"><div align="center">Director</div></td>

							<td style="border-bottom:#FFFFFF; border-left:0px;border-right:0px; border-bottom:0px;"><div align="center">Proprietor</div></td>

						</tr>

					</table>




				</div>
			</div>


		</div>





	</div>





<?/*>

	<br>
<br>
<br>
<br>
<br>
<br>
<br>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td><div class="left_report">

							<table width="100%" border="0" cellspacing="0" cellpadding="0">

								  <tr>

								    <td><div class="box_report">
											<form id="form1" name="form1" method="post" action="">
												<table width="100%" border="0" cellspacing="2" cellpadding="0">

                                      <tr>

                                        <td width="14%" align="right">

		    Period :                                       </td>

                                        <td width="15%" align="left">

                                          <input name="fdate" type="text" id="fdate" size="12" style="max-width:250px;" class="form-control" value="<?php echo $_REQUEST['fdate'];?>" />

										</td>
									    <td width="11%" align="left"><div align="center">-----</div></td>
									    <td width="49%" align="left">

                                            
                                              <input name="tdate" type="text" id="tdate" size="12" style="max-width:250px;" class="form-control" value="<?php echo $_REQUEST['tdate'];?>"/>                                       </td>

									  </tr>
									  
									  
									  <tr>
                                        <td align="center">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                        <td align="left">&nbsp;</td>
                                      </tr>

                                      

                                      <tr>

                                        <td height="48" align="right">Bank Head :</td>

                                        <td colspan="2" align="left">
											<select name="ledger_id" id="ledger_id" class="form-control" style="float:left"  >

												<option value="0"></option>
												
												<?
												

												
												foreign_relation('accounts_ledger','ledger_id','ledger_name',$b_id,"ledger_group_id=10202  order by ledger_id");
												
												?>
											</select>
											<div align="right"></div>
                                            <div align="right"></div>
                                            <div align="right"></div></td>
                                        <td align="left">&nbsp;</td>
                                      </tr>
									  
									  <tr>
                                        <td align="center">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                        <td align="left">&nbsp;</td>
                                      </tr>

//                                      <tr>
//
//                                        <td height="59" align="right">Cost Center : </td>
//
//                                        <td colspan="2" align="left"><select name="cc_code" id="cc_code" class="form-control" style="float:left"  >
//
//											<option value="0"></option>
//
//											<?
//
//											foreign_relation('cost_center','id','center_name',$_REQUEST['cc_code'],"1  order by id");
//
//											?>
//										</select></td>
//                                        <td align="left">&nbsp;</td>
//                                      </tr>

                                      <tr>
                                        <td align="center">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                        <td align="left">&nbsp;</td>
                                      </tr>
                                      <tr>

                                        <td align="center">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                        <td align="center"><input class="btn1 btn1-bg-submit" name="show" type="submit" id="show" value="Show" /></td>
										  <td align="left">&nbsp;</td>
                                      </tr>

                                    </table>

								    </form></div></td>

						      </tr>

								  <tr>

									<td align="right"><? include('PrintFormat.php');?></td>

								  </tr>

								  <tr>

									<td><div id="reporting"><div id="grp">

									<table class="tabledesign" width="100%" cellspacing="0" cellpadding="2" border="0">

							  <tr>

								<th>S/N</th>

                                <th>Voucher No</th>

                                <th>Type</th>

                                <th>Head Of A/C</th>

                                <th>Narration</th>

								<th>Debit(TK)</th>

								<th>Credit(TK)</th>

							  </tr>

<?php

	if(isset($_REQUEST['show']))

  {

	$cc_code = (int) $_REQUEST['cc_code'];

	

	$psql		= "select a.jv_no from journal a where  jv_date between '$fdate' and '$tdate' and  a.ledger_id='$ledger_id' order by a.jv_date,a.tr_no";

	$pquery		= mysql_query($psql);

	$pcount     = mysql_num_rows($pquery);

	if($pcount>0)

	{

	while($info=mysql_fetch_object($pquery)){

	++$c;

	if($c==1){$jvs .= $info->jv_no;}

	else{$jvs .= ','.$info->jv_no;}

	}

	}

	//echo $jvs;
	
	$join=" and tr_from in('Receipt','Payment','Opening','Journal_info')";

	if($cc_code > 0)

	{





		$op		= "select SUM(dr_amt)-SUM(cr_amt) from journal where ledger_id ='$ledger_id' and jv_date<'$fdate' and 1 AND cc_code=$cc_code ";

		

		$open	= mysql_fetch_row(mysql_query($op));

		$cur	= "select SUM(dr_amt)-SUM(cr_amt) from journal where ledger_id ='$ledger_id' and jv_date between '$fdate' and '$tdate' and 1 AND cc_code=$cc_code ";



		$current = mysql_fetch_row(mysql_query($cur));

		$close	= $open[0]+$current[0];



	  $p		= "select a.jv_date,b.ledger_name,a.dr_amt,a.cr_amt,a.tr_no,a.narration,a.tr_from,a.cheq_no,a.cheq_date from journal a,accounts_ledger b where a.ledger_id=b.ledger_id AND a.cc_code=$cc_code and jv_no in (".$jvs.") and a.ledger_id!='$ledger_id' order by a.jv_date,a.tr_no";

	}

	else

	{





		$op		= "select SUM(dr_amt)-SUM(cr_amt) from journal where ledger_id ='$ledger_id' and jv_date<'$fdate' ".$join;;

		$open	= mysql_fetch_row(mysql_query($op));

		$cur	= "select SUM(dr_amt)-SUM(cr_amt) from journal where ledger_id ='$ledger_id' and jv_date between '$fdate' and '$tdate' ".$join;;

		

		

		$current = mysql_fetch_row(mysql_query($cur));

		$close	= $open[0]+$current[0];

		$p		= "select a.jv_date,b.ledger_name,a.dr_amt,a.cr_amt,a.tr_no,a.narration,a.tr_from,a.jv_no,a.cheq_no,a.cheq_date from journal a,accounts_ledger b where a.ledger_id=b.ledger_id and jv_no in (".$jvs.") and a.ledger_id!='$ledger_id' ".$join." order by a.jv_date,a.tr_no";



	}

$i=0;

	$report = mysql_query($p);

	$old_jv = 1;

	while($rp=mysql_fetch_row($report)){ 

	if($old_jv != $rp[4]) $i++; else echo '&nbsp;';

	if($i%2==0)$cls=' class="alt"'; else $cls='';

	

	$cr_total=$cr_total+$rp[3];

  	$dr_total=$dr_total+$rp[2];

	

	if($old_tp != $rp[6]) $i=1;$old_tp = $rp[6];

	

	?>

							  <tr<?=$cls?>>

										<td><? if($old_jv != $rp[4]) echo $i;?></td>

										<td><? 

										

		

										if($old_jv != $rp[4]) 

										{

										//if($rp[6]=='Receipt'||$rp[6]=='Payment'||$rp[6]=='Journal_info'||$rp[6]=='Contra'){
//										$link="voucher_print.php?v_type=".$rp[6]."&v_date=".$ro[0]."&view=1&vo_no=".$rp[7];
//										echo "<a href='$link' target='_blank'>".$rp[4]."</a>";
//										}else
//										{
//										echo $rp[4];
//										}


										$link="general_voucher_print_view_from_journal.php?jv_no=".$rp[7];
										echo "<a href='$link' target='_blank'>".$rp[4]."</a>";

										}?></td>

                                        <td><? if($old_jv != $rp[4]) echo $rp[6];?></td>

										<td><?=$rp[1];?></td>

										<td ><?=$rp[5];?><?=(($rp[8]!='')?'-Cq#'.$rp[8]:'');?><?=(($rp[9]>943898400)?'-Cq-Date#'.date('d-m-Y',$rp[9]):'');?></td>								

										<td style="text-align:right"><?=$rp[2];?></td>

										<td style="text-align:right"><?=$rp[3];?></td>

							 </tr>

	<?php $old_jv = $rp[4];  }

	?>

							 <tr>

								<th colspan="5" align="right">Total : </th>

								<th><?=number_format($dr_total,2);?></th>

								<th><?=number_format($cr_total,2);?></th>

							  </tr>

                              

                              

                              

	<?

	}?>

							</table> 

									<br /><br />                          

                            <table class="tabledesign"   width="100%" cellspacing="0" cellpadding="2" border="0">

                              <tr>

                                <th width="70%">Opening Balance : </th>

                                <th width="30%" align="right"><?php if($open[0]==0) echo "0.00"; else echo number_format($open[0],2);?></th>

                              </tr>

                              <tr class="alt">

                                <th>Received in this Period : </th>

                                <th align="right"><?=number_format($cr_total,2);?></th>

                              </tr>

                              <tr class="alt">

                                <th>Total after Received : </th>

                                <th align="right"><?=number_format(($open[0]+$cr_total),2);?></th>

                              </tr>

                              <tr class="alt">

                                <th>Payment in this Period : </th>

                                <th align="right"><?=number_format($dr_total,2);?></th>

                              </tr>

                              

                              <tr>

                                <th>Closing Balance : </th>

                                <th align="right"><?php echo number_format($close,2);?></th>

                              </tr>

                            </table>

                            <br />

                            Amount Inwords:

                            <?=convertNumberMhafuz($close)?>

                            <br />

                            <br /><br /><br />

                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-bottom:#FFFFFF">

                              <tr style="border-bottom:#FFFFFF">



                                <td align="center" valign="bottom" style="border-bottom:#FFFFFF;border-left:0px;;border-right:0px; border-bottom:0px;">........................</td>

                                <td align="center" valign="bottom" style="border-bottom:#FFFFFF; border-left:0px;border-right:0px; border-bottom:0px;">........................</td>

                                <td align="center" valign="bottom" style="border-bottom:#FFFFFF; border-left:0px;border-right:0px; border-bottom:0px;">........................</td>

                                <td align="center" valign="bottom" style="border-bottom:#FFFFFF; border-left:0px;border-right:0px; border-bottom:0px;">........................</td>

                              </tr>

                              <tr>



                                <td style="border-bottom:#FFFFFF; border-left:0px;border-right:0px; border-bottom:0px;"><div align="center">Prepared by </div></td>

                                <td style="border-bottom:#FFFFFF; border-left:0px;border-right:0px; border-bottom:0px;"><div align="center">Checked by </div></td>

                                <td style="border-bottom:#FFFFFF; border-left:0px;border-right:0px; border-bottom:0px;"><div align="center">Director</div></td>

                                <td style="border-bottom:#FFFFFF; border-left:0px;border-right:0px; border-bottom:0px;"><div align="center">Proprietor</div></td>

                              </tr>

                            </table>

									</div></div>                            

							</td>

						  </tr>

						</table>



							</div></td>

    

  </tr>

</table>




	<*/?>




<?

$main_content=ob_get_contents();

ob_end_clean();

require_once "../../template/main_layout.php";

?>