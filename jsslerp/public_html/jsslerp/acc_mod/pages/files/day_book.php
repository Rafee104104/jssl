<?php

require_once "../../../assets/template/layout.top.php";

$title='Daily General Journal';



$proj_id 	= $_SESSION['proj_id'];

$vtype 		= $_REQUEST['v_type'];

$active='unvou';

do_calander("#fdate");
do_calander("#tdate");



if(isset($_REQUEST['show']))

{

	$fdate=$_REQUEST["fdate"];

	$tdate=$_REQUEST['tdate'];

	$vou_no=$_REQUEST['vou_no'];

	$user_id=$_REQUEST['user_id'];

	if($user_id!='')

	$user_id = find_a_field('user_activity_management','user_id',"username='".$user_id."'");

	

}



if(isset($_REQUEST['show'])||isset($_REQUEST['view']))

{

	if($vtype=='Contra'||$vtype=='contra'||$vtype=='coutra')

	{

		$vtype='coutra';

		$vo_type='contra';

	}

	else $vo_type=$vtype;

	

	if($_SESSION['user']['group']>1) $group_s='AND j.group_for='.$_SESSION['user']['group'];

	if($_POST['vou_no']>0)	{$vou_no = $_POST['vou_no']; if($vou_no>201400000000) $con .= ' and jv_no like "%'.$vou_no.'%"'; else $con .= ' and tr_no like "%'.$vou_no.'%"'; }

	if($fdate>0&&$tdate>0)	{$con .= 'AND jv_date BETWEEN "'.$fdate.'" AND "'.$tdate.'" ';  }

	if($vo_type!='')		{$con .= "AND tr_from = '".$vo_type."'";  }

	if($_POST['user_id']!='')		{$con .= "AND j.entry_by = '".$_POST['user_id']."'";  }
	
	if($_POST['checked']!=''){ $con.=" and j.checked='".$_POST['checked']."' "; }
	
	


	  $sql="SELECT  

				  j.tr_no,

				 j.dr_amt,

				 j.cr_amt,

				  j.jv_date,

				  j.jv_no,

				  a.ledger_name,

				  j.tr_from,
				  j.cv_no,
				  j.narration,
				  a.ledger_group_id

				FROM

				  secondary_journal j,

				  accounts_ledger a

				WHERE

				  1   ".$con."

				  AND j.tr_from != 'Ledger' AND j.ledger_id = a.ledger_id ".$group_s." 

				ORDER BY

				  j.jv_no ASC,               -- Group by JV
				  (j.dr_amt = 0) ASC,        -- DR rows first within JV
				  j.tr_no ASC ";

	//echo $sql;

}

if(isset($_REQUEST['view']))

{

	$v_no=$_REQUEST['v_no'];

}

////

?>

<script type="text/javascript">

	
function DoNav(theUrl)

{
    <? if($_POST['v_type']=='payment'){?>
	      var URL = 'debit_note_edit_update.php?update=1&'+theUrl;
	<? }elseif($_POST['v_type']=='receipt'){?>
	       var URL = 'credit_note_edit_update.php?update=1&'+theUrl;
	<? }elseif($_POST['v_type']=='journal'){ ?>
	       var URL = 'journal_note_edit_update.php?update=1&'+theUrl; 
	<? }elseif($_POST['v_type']=='coutra'){ ?>
		   var URL = 'coutra_note_edit_update.php?update=1&'+theUrl; 
	<? } ?>	   
	  //var URL = 'voucher_edit_confirm.php?'+theUrl;

	//popUp(URL);
	
	window.location.href = URL;

}



function popUp(URL) 

{

day = new Date();

id = day.getTime();

eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=1,menubar=0,resizable=1,width=800,height=800,left = 383,top = -16');");

}



function loadinparent(url)

{

	self.opener.location = url;

	self.blur(); 

}

</script>

<style type="text/css">

<!--

.style1 {

	color: #FF0000;

	font-size: 10px;

}

.style2 {color: #FF0000}

-->
@media print {
  @page {
    margin: 1in;
  }
  body {
    margin: 0;
  }
}

</style>




	<!--new colde-->

	<div class="d-flex justify-content-center">
		<form class="n-form1 fo-width1 pt-4" id="form1" name="form1" method="post" action="">

			<div class="container-fluid">



				

				<div class="form-group row m-0 mb-1 pl-3 pr-3">
					<label for="group_for" class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text req-input">Voucher Date :</label>
					<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 p-0">
						<input name="fdate" style="max-width:250px!important;" class="form-control" type="text" id="fdate" size="10" value="<?php  echo date('Y-m-01'); // $_POST['fdate'];  ?>" autocomplete="off"/>
					</div>

					<label for="group_for" class="col-sm-1 col-md-1 col-lg-1 col-xl-1 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> To :</label>
					<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 p-0">
						<input name="tdate" style="max-width:250px!important;" class="form-control" type="text" id="tdate" size="10" value="<?php  echo date('Y-m-d'); // $_POST['tdate'];  ?>" autocomplete="off" />
					</div>
				</div>



				<div class="form-group row m-0 mb-1 pl-3 pr-3">
					<label for="group_for" class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">User Name :</label>
					<div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0">
					
					<? if($_SESSION['user']['id']==10067 || $_SESSION['user']['id']==10001 || $_SESSION['user']['id']==10078 || $_SESSION['user']['id']==10066) { ?>
					
					<select name="user_id" id="user_id" >
					<option></option>
						<? foreign_relation('user_activity_management','user_id','username','1');?>
					</select>
					<? } else { ?>
						<input name="user_id" type="text" id="user_id" value="<?=find_a_field('user_activity_management','username',"user_id='".$_SESSION['user']['id']."'");?>" size="10" class="form-control"/>
						
						<? } ?>
					</div>
				</div>




				<div class="n-form-btn-class">
					<span class="style1">* means mandetory </span>
					<input class="btn1 btn1-bg-submit" name="show" type="submit" id="show" value="Show" />
				</div>

			</div>
		</form>
	</div>

<p class="#"> <? include('PrintFormat.php');?></p>
	<div class="form-container_large">
		<div class="container_fluid">

			<?php if(isset($_REQUEST['view'])||isset($_REQUEST['show']))

			{

				?>
				<div id="grp">
				<p style="text-align:center; ">Date: <?php echo $_POST['fdate']; ?> To <?php echo $_POST['tdate']; ?></p>
				<p style="text-align:right">Printing Time: <?php echo date("Y-m-d H:i:s"); ?> </p>
				<table width="100%" class="table1 table-striped table-bordered table-hover table-sm" cellpadding="0" cellspacing="0" >
				
    <thead class="thead1">
        <tr class="bgc-info" style="border-buttom:1px solid black;">
            <th>Account Title and Explanations</th>
            <th>Dr. Amt</th>
            <th>Cr. Amt</th>
        </tr>
    </thead>
   <tbody class="tbody1">
<?php
$query = mysql_query($sql);
$current_jv_no = null;
$total_dt_amount = 0;
$total_cr_amount = 0;
$tot_dr = 0;
$tot_cr = 0;
$rows = [];

while ($vno = mysql_fetch_row($query)) {
    $rows[] = $vno; // Store rows for later processing
}

$prev_jv = null;
foreach ($rows as $index => $vno) {
    $next_jv = isset($rows[$index+1]) ? $rows[$index+1][4] : null;

    // --- When JV changes, print subtotal row ---
    if ($current_jv_no !== null && $current_jv_no !== $vno[4]) {
        echo "<tr style='font-weight: bold; background-color: #f0f0f0;'>
                <td align='center'>Total</td>
                <td>" . number_format($total_dt_amount, 2) . "</td>
                <td>" . number_format($total_cr_amount, 2) . "</td>
              </tr>";

        $total_dt_amount = 0;
        $total_cr_amount = 0;
    }

    $current_jv_no = $vno[4]; // Track current JV
    $total_dt_amount += $vno[1];
    $total_cr_amount += $vno[2];
    $tot_dr += $vno[1];
    $tot_cr += $vno[2];

    // --- Voucher header row (only once per JV) ---
    if ($index == 0 || $rows[$index - 1][4] !== $vno[4]) {
        echo "<tr style='background-color: #d9edf7; font-weight: bold; font-size:12px;'>
                <td colspan='3' align='left'>
                    Voucher Name: {$vno[6]} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                    Voucher No: {$vno[0]} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                    Date: {$vno[3]}
                </td>
              </tr>";
    }

    // --- Border style logic for merging rows ---
    $tdStyle = "border-left:1px solid #000; border-right:1px solid #000;";
    if ($prev_jv === $vno[4]) {
        $tdStyle .= " border-top:none;";
    } else {
        $tdStyle .= " border-top:1px solid #000;"; // first row of group
    }
    if ($next_jv === $vno[4]) {
        $tdStyle .= " border-bottom:none;";
    } else {
        $tdStyle .= " border-bottom:1px solid #000;"; // last row of group
    }

    // --- Main row ---
    echo "<tr class='voucher-row'>
            <td style='{$tdStyle};'>
                <div style='text-align:justify;" . 
                    ($vno[2] != '0.00' ? " margin-left:50px;" : "") . "'>
                    " . find_a_field('ledger_group', 'group_name', 'group_id=' . $vno[9]) . "
                    <br><strong>{$vno[5]}</strong><br>{$vno[8]}
                </div>
            </td>
            <td style='{$tdStyle}'>{$vno[1]}</td>
            <td style='{$tdStyle}'>{$vno[2]}</td>
          </tr>";

    $prev_jv = $vno[4];
}

// --- Final subtotal row ---
if ($current_jv_no !== null) {
    echo "<tr style='font-weight: bold; background-color: #f0f0f0;'>
            <td align='center'>Total</td>
            <td>" . number_format($total_dt_amount, 2) . "</td>
            <td>" . number_format($total_cr_amount, 2) . "</td>
          </tr>";
}

// --- Grand total row ---
echo "<tr style='font-weight:bold; background:#ddd;'>
        <td><strong>Grand Total</strong></td>
        <td><strong>" . number_format($tot_dr, 2) . "</strong></td>
        <td><strong>" . number_format($tot_cr, 2) . "</strong></td>
      </tr>";
?>
</tbody>

	
</table>
</div>
<!-- Adding some CSS for merged borders -->
<style>
    .voucher-row td {
        border-bottom: 1px solid #ccc;
    }

    /* Merging the borders for debit and credit under the same Voucher No */
    .voucher-row:first-child {
        border-top: 1px solid #000; /* Add a solid border at the top for the first row of the voucher group */
    }

    .voucher-row:last-child {
        border-bottom: 1px solid #000; /* Add a solid border at the bottom for the last row of the voucher group */
    }
</style>





				<?php

			}

			?>

		</div>
	</div>





<?php/*>
<br>
<br>
<br>
<br>
<br>


<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td valign="top">
		<div class="left_report">

							<table width="100%" border="0" cellspacing="0" cellpadding="0">

								  <tr>

								    <td valign="top"><div class="box">

											<form id="form1" name="form1" method="post" action="">
												<table width="100%" border="0" align="" cellpadding="0" cellspacing="0">

                                     <tr>

                                        <td width="40%" align="right">

		    Voucher Type<span class="style2">*</span> : </td>

                                        <td width="60%" align="left">

											<select name="v_type" id="v_type" class="form-control" style="width:280px;">

                                          <option value="receipt"<?php if($vtype=='receipt') echo "selected"?>>Receipt Voucher</option>

                                          <option value="payment"<?php if($vtype=='payment') echo "selected"?>>Payment Voucher</option>

                                          <option value="coutra"<?php if($vtype=='coutra') echo "selected"?>>Contra Voucher</option>

                                          <option value="journal"<?php if($vtype=='journal') echo "selected"?>>Journal Voucher</option>


<!--												<option value="Purchase"--><?php //if($vtype=='Purchase') echo "selected"?><!-->Purchase Voucher</option>-->
<!---->
<!--										  <option value="Salea"--><?php //if($vtype=='Salea') echo "selected"?><!-->Salea Voucher</option>-->
<!---->
<!--										  <option value="Collection"--><?php //if($vtype=='Collection') echo "selected"?><!-->Collection Voucher</option>-->


                                        </select>

										</td>
                                      </tr>

                                      <tr>

                                        <td align="right">Voucher Date<span class="style2">*</span> : </td>

                                        <td align="left"><table  border="0" cellspacing="0" cellpadding="0">

                                          <tr>

                                            <td>
												<input name="fdate" style="max-width:250px!important;" class="form-control" type="text" id="fdate" size="10" value="<?php  echo $_POST['fdate'];  ?>" />

											</td>

                                            <td style="width:0px!important;">--</td>

                                            <td><input name="tdate" type="text" id="tdate" size="10" value="<?php echo $_POST['tdate'];  ?>" class="form-control"/></td>
                                          </tr>

                                        </table>		  </td>
                                      </tr>

                                      

                                      <tr>

                                        <td align="right">User Name  :</td>

                                        <td align="left">
											<input name="user_id" type="text" id="user_id" value="<?=$_POST['user_id'];?>" size="10" style=" width:280px" class="form-control"/>
										</td>
                                      </tr>

                                      <tr>
                                        <td align="right">Checked : </td>
                                        <td align="left">
											<select name="checked"  style=" width:280px" class="form-control">
										<option></option>
										    <option <? if($_POST['checked']=='NO') echo 'selected'; ?> value="NO">NO</option>
											<option <? if($_POST['checked']=='YES') echo 'selected'; ?> value="YES">Yes</option>
										</select>

										</td>
                                      </tr>
                                      <tr>

                                        <td align="right">Voucher No : </td>

                                        <td align="left">
											<input name="vou_no" type="text" id="vou_no" value="<?=$vou_no?>" size="10"  style=" width:280px" class="form-control" />

										</td>
                                      </tr>

                                      <tr>

                                        <td align="center"><span class="style1">* means mandetory </span></td>

                                        <td class="text-left"><input class="btn1 btn1-bg-submit" name="show" type="submit" id="show" value="Show" /></td>
                                      </tr>

                                      

                                    </table>

								    </form>
										</div>
									</td>

						      </tr>

								  <tr>

									<td style="height:3px;"> </td>

								  </tr>

								  <tr>

									<td>

										<?php if(isset($_REQUEST['view'])||isset($_REQUEST['show']))

	  {	  

	  ?>

									<table align="center" cellspacing="0" class="tabledesign" id="grp">

							  <tr>

							    <th>JV No</th>

							    <th>Vou. No</th>

								<th>Voucher Date</th>

								<th>Transection</th>

								<th>Acc Head</th>

								<th>Dt. Amnt</th>

								<th>Cr. Amnt</th>

							  </tr>

        <?php

		$query=mysql_query($sql);		  

		while($vno=mysql_fetch_row($query))

		{

			$v_type = $_REQUEST['v_type'];$i++; if($i%2==0)$cls=' class="alt"'; else $cls='';?>

							    <!--<tr<?=$cls?> onclick="DoNav('<?php echo 'v_type='.$vno[6].'&vo_no='.$vno[4] ?>');">-->
							  <tr<?=$cls?> onclick="DoNav('<?php echo 'v_type='.$vno[6].'&tr_no='.$vno[0].'&jv_no='.$vno[4] ?>');">
							     <td><?php echo $vno[4] ?></td>

							     <td><?php echo $vno[0] ?></td>

								 <td><?php echo  $vno[3] ?></td>

								 <td><?php echo $vno[6] ?></td>

								 <td><?php echo $vno[5] ?></td>

								 <td><?php echo $vno[1] ?></td>

								 <td><?php echo $vno[2] ?></td>

							  </tr>

	<?php }?>

							</table>

										<?php

    }

    ?>

									</td>

								  </tr>

		</table>



							</div>
	</td>

    

  </tr>

</table>


	<*/?>





<script type="text/javascript">

	document.onkeypress=function(e){

	var e=window.event || e

	var keyunicode=e.charCode || e.keyCode

	if (keyunicode==13)

	{

		return false;

	}

}

</script>

<?

require_once "../../../assets/template/layout.bottom.php";

?>