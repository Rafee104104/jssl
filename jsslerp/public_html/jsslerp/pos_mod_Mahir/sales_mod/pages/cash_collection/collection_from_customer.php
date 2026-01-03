<?php



session_start();

ob_start();


require_once "../../../assets/template/layout.top.php";

 $issue_no = $_REQUEST['issue_no'];


$title='Cash Collection From Customer';


if($_POST['warehouse_id']>0) 

$warehouse_id = $_SESSION['warehouse_id']=$_POST['warehouse_id'];

elseif($_SESSION['warehouse_id']>0) 

$warehouse_id = $_POST['warehouse_id']=$_SESSION['warehouse_id'];


auto_complete_from_db('dealer_info','dealer_name_e','concat(dealer_code,"#>",dealer_name_e)','depot="'.$warehouse_id.'"','dealer_code');


do_calander('#p_date');

if($_REQUEST['p_date']!='')

{

$p_date = $_REQUEST['p_date'];

$blend_type = $_REQUEST['blend_type'];



$p_found = find_a_field('black_tea_consumption','1',' 1 and blend_type = "'.$blend_type.'" and status="COMPLETE" and issue_date="'.$p_date.'"');

$m_found = find_a_field('black_tea_consumption','1',' 1 and blend_type = "'.$blend_type.'" and status="MANUAL" and issue_date<"'.$p_date.'"');

}

if(isset($_REQUEST['confirmit']))

{



$p_date = $_REQUEST['p_date'];

$blend_type = $_REQUEST['blend_type'];



$sql = "update black_tea_consumption set status = 'COMPLETE' where `blend_type`='".$blend_type."' and `issue_date`='".$p_date."'";

mysql_query($sql);


//$jv_no = next_journal_sec_voucher_id();

//$jv_date = strtotime($p_date);

//$narration = 'Sale NO#'.$se_sale->sale_no.' SaleDate:'.$p_date;

//$cc_code = $se_info->acc_code;

//add_to_sec_journal('STA', $jv_no, $jv_date, $se_info->ledger_id, $narration, $se_sale->total_sales, '0.00', 'Sales', $se_sale->sale_no,'','',$cc_code);

//add_to_sec_journal('STA', $jv_no, $jv_date, '3001000100000000',  $narration, '0.00', $se_sale->total_sales, 'Sales', $se_sale->sale_no,'','',$cc_code);



}







//$se_info = find_all_field('warehouse','','warehouse_id='.$se_id);

$bt_issue =  find_all_field_sql("SELECT sum(amount) issue_amount, status, issue_no FROM `black_tea_consumption` WHERE `blend_type`='".$_POST['blend_type']."' and `issue_date`='".$p_date."' ");



?>



<script>







function getXMLHTTP() { //fuction to return the xml http object







		var xmlhttp=false;	







		try{







			xmlhttp=new XMLHttpRequest();







		}







		catch(e)	{		







			try{			







				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");



			}



			catch(e){







				try{







				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");







				}







				catch(e1){







					xmlhttp=false;







				}







			}







		}







		 	







		return xmlhttp;







    }







	function update_value(account_code)

	{

var account_code=account_code; // Rent 

var p_date=(document.getElementById('p_date').value);

var warehouse_id=(document.getElementById('warehouse_id').value);

var salesman=(document.getElementById('salesman').value);

var dr_ledger_id=(document.getElementById('dr_ledger_id').value);

var dealer_code=(document.getElementById('dealer_code_'+account_code).value);

var ledger_id=(document.getElementById('ledger_id_'+account_code).value);

var collection_amt=(document.getElementById('collection_amt_'+account_code).value);


var flag=(document.getElementById('flag_'+account_code).value); 

//alert(item_rate)

var strURL="customer_collection_ajax.php?account_code="+account_code+"&p_date="+p_date+"&warehouse_id="+warehouse_id+"&salesman="+salesman+"&dr_ledger_id="+dr_ledger_id+"&dealer_code="+dealer_code
+"&ledger_id="+ledger_id+"&collection_amt="+collection_amt+"&flag="+flag;



//alert(strURL);



		var req = getXMLHTTP();







		if (req) {







			req.onreadystatechange = function() {



				if (req.readyState == 4) {



					// only if "OK"



					if (req.status == 200) {						



						document.getElementById('divi_'+account_code).style.display='inline';



						document.getElementById('divi_'+account_code).innerHTML=req.responseText;						



					} else {



						alert("There was a problem while using XMLHTTP:\n" + req.statusText);



					}



				}				



			}



			req.open("GET", strURL, true);



			req.send(null);



		}	







}







</script>





</script>

<style type="text/css">

<!--

.style1 {

	color: #FFFFFF;

	font-weight: bold;

}

-->

</style>







<div class="form-container_large">



<form action="" method="post" name="codz" id="codz">



<table width="80%" border="0" align="center">



  <tr>



    <td colspan="4" height="22" bgcolor="#FF0000"><div align="center" class="style1"><?=$title?></div></td>
    </tr>



  <?



  if(isset($_POST['p_date']))



  $p_date = $_SESSION['p_date'] = $_POST['p_date'];



  elseif($_SESSION['p_date']!='')



  $p_date = $_SESSION['p_date'];



  else



  $p_date = date('Y-m-d');



  



  ?>



  <tr>



    <td align="right" bgcolor="#FF9966"><strong> Date : </strong></td>



    <td bgcolor="#FF9966"><input name="p_date" type="text" id="p_date" style="width:120px;" value="<?=$p_date?>" /></td>



    <td rowspan="5" bgcolor="#FF9966"><strong>

      <input type="submit" name="submit" id="submit" value="Open Customer" style="width:180px; font-weight:bold; font-size:12px; height:30px; color:#090"/>

    </strong></td>

    <td rowspan="5" bgcolor="#FF9966"><a href="black_tea_transection_sheet.php?v_no=<?=$bt_issue->issue_no?>" target="_blank"><img src="../../../images/print.png" width="26" height="26" /></a></td>
  </tr>



  <tr>
    <td align="right" bgcolor="#FF9966"><strong>Warehouse  : </strong></td>
    <td bgcolor="#FF9966"><select name="warehouse_id" id="warehouse_id" style="width:220px;">

        <?

foreign_relation('warehouse','warehouse_id','warehouse_name',$_POST['warehouse_id'],'warehouse_id="'.$warehouse_id.'" ');

?>

    </select>
	<input name="salesman" type="hidden" id="salesman" value="0"  style="width:220px; height:30px;"  />	
	</td>
  </tr>
  
  <tr>

    <td align="right" bgcolor="#FF9966"><strong>Customer Name  : </strong></td>

    <td bgcolor="#FF9966">
	
	<input name="dealer_code" type="text" id="dealer_code" value="<?=$_POST['dealer_code']?>"  style="width:220px; height:30px;"  />		</td>
    </tr>
  <tr>
    <td align="right" bgcolor="#FF9966"><strong>Cash Ledger  : </strong></td>
    <td bgcolor="#FF9966"><select name="dr_ledger_id" id="dr_ledger_id" required="required" style="width:220px;">

  <? foreign_relation('accounts_ledger a, warehouse w','w.cash_ledger','a.ledger_name',$_POST['dr_ledger_id'],'a.ledger_id=w.cash_ledger and w.warehouse_id="'.$warehouse_id.'"');?>
    </select></td>
    </tr>
</table>



<br />








<!--/Recept Sale Amount-->



<?



if($_POST['dr_ledger_id']>0){



?>



<div class="tabledesign2" style="width:100%">



<table width="100%" border="0" align="center" id="grp" cellpadding="0" cellspacing="0" >



  <tr style="font-size:14px;">
    <th width="6%">SL</th>
    <th width="12%">Accounts Code </th>



    <th width="8%"> Code </th>
    <th width="25%">Customer Name </th>
    <th width="19%">Address</th>

    <th width="12%" bgcolor="#99FFFF">Opening</th>
    <th width="11%" bgcolor="#FFCCFF">Collection</th>
    <th width="7%"><div align="center">Action</div></th>
  </tr>
  



  <?

  

 if($_POST['warehouse_id']!='')

  $depot_con=" and d.depot=".$_POST['warehouse_id'];
  
  
 $dealer_name_e = $_POST['dealer_code'];
 
 $dealer=explode("#>",$dealer_name_e);

 $dealer[0];

  
 if($_POST['dealer_code']!='')

  $con=" and d.dealer_code=".$dealer[0];
  
  
  $sql = "select sum(dr_amt-cr_amt) as opening_balance, ledger_id from journal where 1 group by ledger_id ";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){

$opening_balance[$data->ledger_id]=$data->opening_balance;

}
  

   
    $sql = "SELECT d.account_code, d.dealer_code, d.dealer_name_e, d.address_e, d.depot FROM accounts_ledger a, dealer_info d WHERE a.ledger_id=d.account_code ".$con.$depot_con;



  $query = mysql_query($sql);



  while($data=mysql_fetch_object($query)){





	//$stock_qty = $data->qty-$all_issue;

  ?>



  <tr  style="font-size:14px;">
    <td><?=++$i?></td>
    <td>      <?=$data->account_code?>    </td>

    <td>      <?=$data->dealer_code?>    </td>
    <td>
	<?=$data->dealer_name_e?>
	  </td>
    <td>      <?=$data->address_e?></td>

<td bgcolor="#99FFFF"><strong>
 
  
  <?
  if($opening_balance[$data->account_code]>0)
{ $tag='(Dr)';}
elseif($opening_balance[$data->account_code]<0)
{ $tag='(Cr)'; $opening_balance[$data->account_code]=$opening_balance[$data->account_code]*(-1);}
  ?>
  
  <?=number_format($opening_balance[$data->account_code],2).' '.$tag;?>
  
</strong></td>
<td bgcolor="#FFCCFF"><strong>
 <input name="dealer_code_<?=$data->account_code?>" id="dealer_code_<?=$data->account_code?>" type="hidden" size="10"  value="<?=$data->dealer_code?>" style="width:80px;" />
 <input name="ledger_id_<?=$data->account_code?>" id="ledger_id_<?=$data->account_code?>" type="hidden" size="10"  value="<?=$data->account_code?>" style="width:80px;" />
  <input name="collection_amt_<?=$data->account_code?>" id="collection_amt_<?=$data->account_code?>" type="text" size="10"  value="" style="width:100px;"  />
</strong></td>
<td><span id="divi_<?=$data->account_code?>">



   <?

if($m_found==0&&$p_found==0)

	{

	if($info->account_code<1)

	{

?>

    <input name="flag_<?=$data->account_code?>" type="hidden" id="flag_<?=$data->account_code?>" value="0" />

    <input type="button" name="Button" value="Save"  onclick="update_value(<?=$data->account_code?>)" style="width:60px; height:30px; font-size:12px; font-weight:700; background-color:#66CC66"/>

<? }



		 else



			{?>



				  <input name="flag_<?=$data->account_code?>" type="hidden" id="flag_<?=$data->account_code?>" value="1" />



				  <input type="button" name="Button" value="Edit"  onclick="update_value(<?=$data->account_code?>)" style="width:60px;font-size:12px;   height:30px;   font-weight:700; background-color:#FF3366"/>



		 <? }}



		 ?>



          </span>&nbsp;</td>
  </tr>



  <? }?>
</table>



</div>





<? }?>



<p style="width:60%; float:left;">


<?php /*?>
   <? if($se_sale->status=='MANUAL'){?>
   
    <? }?><?php */?>

	 	   <input name="confirmit" type="hidden" id="confirmit" value="TRANSECTION COMPLETE" style=" width:300px; height:25px; background-color:#FF3300 float:right; font-weight:700;" /> 	       

 	    

	

	</p>



</form>



</div>







<?



$main_content=ob_get_contents();



ob_end_clean();



include ("../../template/main_layout.php");



?>