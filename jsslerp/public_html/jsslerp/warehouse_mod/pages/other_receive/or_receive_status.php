<?php
session_start();
ob_start();
require_once "../../../assets/template/layout.top.php";
$title='Other Receive Status';

do_calander('#fdate');
do_calander('#tdate');
$tr_type="Show";
$table_master='warehouse_other_receive';
$table_details='warehouse_other_receive_detail';
$unique='or_no';
$tr_type="Show";

$target_url = '../other_receive/or_receive_report.php';

if($_REQUEST[$unique]>0)
{
$_SESSION[$unique] = $_REQUEST[$unique];
header('location:'.$target_url);
}
$tr_from="Warehouse";
?>
<script language="javascript">
function custom(theUrl)
{
	window.open('<?=$target_url?>?v_no='+theUrl);
}
</script>





  <div class="form-container_large">
    <form action="" method="post" name="codz" id="codz">

      <div class="container-fluid bg-form-titel">
        <div class="row">
          <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5">
            <div class="form-group row m-0">
              <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">From Date :</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
                <input type="text" name="fdate" id="fdate" value="<? if($_POST['fdate']>0){ echo $_POST['fdate'];}else{ echo date('Y-m-01');}?>" required autocomplete="off" />
              </div>
            </div>

          </div>
          <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5">
            <div class="form-group row m-0">
              <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">To Date:</label>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
                <input type="text" name="tdate" id="tdate" value="<? if($_POST['tdate']>0){ echo $_POST['tdate'];}else{ echo date('Y-m-01');}?>" required autocomplete="off"/>
              </div>
            </div>
          </div>

          <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
            <input type="submit" name="submitit" id="submitit" value="VIEW DETAIL" class="btn1 btn1-submit-input">
          </div>

        </div>
      </div>




      <!--Table start-->
      <div class="container-fluid pt-5 p-0 ">

        <?
        if(isset($_POST['submitit'])){


          if($_POST['fdate']!=''&&$_POST['tdate']!='')
            $con .= 'and a.or_date between "'.$_POST['fdate'].'" and "'.$_POST['tdate'].'"';

          $res='select  a.* ,sum(amount) as Total
from warehouse_other_receive a,warehouse_other_receive_detail b
where a.or_no=b.or_no
'.$con.'
group by a.bag_mark order by a.or_no desc';
//group by a.or_no order by a.or_no desc';
          //echo link_report($res,'po_print_view.php');

          $query = mysql_query($res);

        ?>

        <table class="table1  table-striped table-bordered table-hover table-sm">
          <thead class="thead1">
          <tr class="bgc-info">
            <th>Or No</th>
            <th>Token No.</th>
            <th>Bag Mark</th>
            <th>Booking No</th>
            <th>Receive From</th>
            <th> Date</th>

            <th>Action </th>

          </tr>
          </thead>

          <tbody class="tbody1">

          <?
          while($row = mysql_fetch_object($query)){
            ?>
            <tr>
              <td><?=$row->or_no?></td>
              <td><?=$row->token_number?></td>
              <td><?=$row->bag_mark?></td>
              <td><?=$row->booking_number?></td>
              <td><?=$row->farmer_name?></td>
              <td><?=$row->or_date?></td>

              <td><input type="submit" name="submitit" id="submitit" value="VIEW" class="btn1 btn1-submit-input" onclick="custom(<?=$row->or_no?>);"></td>

            </tr>

          <? } ?>

          </tbody>
        </table>

<?}?>

      </div>
    </form>
  </div>








<?/*>
  <br>
<br>
<br>
<br>
<br>

<div class="form-container_large">
  <form action="" method="post" name="codz" id="codz">
    <table width="80%" border="0" align="center">
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="right" bgcolor="#FF9966"><strong>Date Interval :</strong></td>
        <td width="1" bgcolor="#FF9966"><strong>
          <input type="text" name="fdate" id="fdate" style="width:80px;" value="<?=date('Y-m-01')?>" />
        </strong></td>
        <td align="center" bgcolor="#FF9966"><strong> -to- </strong></td>
        <td width="1" bgcolor="#FF9966"><strong>
          <input type="text" name="tdate" id="tdate" style="width:80px;" value="<?=date('Y-m-d')?>" />
        </strong></td>
        <td bgcolor="#FF9966"><strong>
          <input type="submit" name="submitit" id="submitit" value="VIEW DETAIL" style="width:120px; font-weight:bold; font-size:12px; height:30px; color:#090"/>
        </strong></td>
      </tr>
    </table>
  </form>


  <table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td><div class="tabledesign2">
<? 
if(isset($_POST['submitit'])){


if($_POST['fdate']!=''&&$_POST['tdate']!='')
$con .= 'and a.or_date between "'.$_POST['fdate'].'" and "'.$_POST['tdate'].'"';

$res='select  a.or_no,a.or_no as or_no,a.receive_type as type,a.or_date as or_date,a.or_subject as slip_no, a.vendor_name as receive_from,sum(amount) as Total,a.entry_at,c.fname as user 
from warehouse_other_receive a,warehouse_other_receive_detail b, user_activity_management c
where a.or_no=b.or_no and a.entry_by=c.user_id and a.warehouse_id = "'.$_SESSION['user']['depot'].'" 
and a.receive_type in ("Other Receive","Sales Return","Sample Receive","SKU Change Receive") 
'.$con.' 
group by a.or_no order by a.or_no desc';
echo link_report($res,'po_print_view.php');


}
?>
</div></td>
</tr>
</table>
</div>


  <*/?>




<?
require_once "../../../assets/template/layout.bottom.php";
?>