<?php
require_once "../../../assets/template/layout.top.php";
$title='Consumption Verification';
$now=time();
do_calander('#do_date_fr');
do_calander('#do_date_to');
create_combobox(ledger_id);
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



	function update_value(id)



	{



var item_id=id; // Rent

var ra=(document.getElementById('ra_'+id).value)*1;

var flag=(document.getElementById('flag_'+id).value); 

if(ra>0){

var strURL="received_amt_ajax.php?item_id="+item_id+"&ra="+ra+"&flag="+flag;}

else

{

alert('Receive Amount Must be Greater Than Zero.');

document.getElementById('ra_'+id).value = '';

document.getElementById('ra_'+id).focus();

return false;

}



		var req = getXMLHTTP();



		if (req) {



			req.onreadystatechange = function() {

				if (req.readyState == 4) {

					// only if "OK"

					if (req.status == 200) {						

						document.getElementById('divi_'+id).style.display='inline';

						document.getElementById('divi_'+id).innerHTML=req.responseText;						

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




<form id="form1" name="form1" method="post" action="">
    <div class="form-container_large">
       
        <div class="container-fluid bg-form-titel">
            <div class="row">
                <!--left form-->
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="container n-form2">
                        
                        <div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Date From</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <input name="do_date_fr" class="form-control" type="text" id="do_date_fr" value="<?=$_POST['do_date_fr']?>" required autocomplete="off"/>
                            </div>
                        </div>
						<div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Date  To</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <input name="do_date_to" type="text" id="do_date_to" value="<?=$_POST['do_date_to']?>" class="form-control"  required autocomplete="off"/>
                            </div>
                        </div>
						




                    </div>
                </div>

                <!--Right form-->
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="container n-form2">
                      

                        <!--<div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Chalan Depot </label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <select name="depot_id" id="depot_id" class="form-control">
									<option value=""></option>
                     				 <? foreign_relation('warehouse','warehouse_id','warehouse_name',$_POST['depot_id'],'1 order by warehouse_id');?>

                    			</select>
                            </div>
                        </div>-->
						<div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Ledger Head </label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <?

								$sql = "select v.ledger_id,v.ledger_name from accounts_ledger v where  v.group_for='".$_SESSION['user']['group']."' order by v.ledger_name";

								?>

								<select name="ledger_id" id="ledger_id" class="form-control">
				
								  <option></option>
				
								  <? 
				
										foreign_relation_sql($sql,$vendor_id);?>
				
								</select>
                            </div>
                        </div>
						


					<div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Checked</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <select name="checked" id="checked" class="form-control">

								  <option></option>
			
								  <option <?=($_POST['checked']=='')?'':'';?>>NO</option>
			
								  <option <?=($_POST['checked']=='YES')?'Selected':'';?>>YES</option>
			
								</select>
                            </div>
                        </div>


                    </div>
                </div>


            </div>

        </div>

        <div class="container-fluid p-0 ">

				<div class="n-form-btn-class">
					<input type="submit" name="submitit" id="submitit" value="View Chalan" class="btn1 btn1-submit-input"/>
				</div>

		</div>
		
		
		
		
		<div class="container-fluid pt-5 p-0 ">


				<table width="98%" align="center" cellspacing="0" class="tabledesign">
      <tbody>
      <tr>
      <th>SL</th>
	  
      <th>PR#</th>
      <th>Sr No </th>
      <th>Req No </th>
      <th>Req Date </th>
      <th>Accounts Head </th>
      <th>PR Date</th>
      <th>Depot / Entry By </th>
      <th> Amount</th>
      <th>&nbsp;</th>
      <th>Checked?</th>
      </tr>
	  <?
	
	  $i=0;
/*$datefr = strtotime($_POST['do_date_fr']);
$dateto = strtotime($_POST['do_date_to']);
$day_from = mktime(0,0,0,date('m',$datefr),date('d',$datefr),date('y',$datefr));
$day_end =  mktime(23,59,59,date('m',$dateto),date('d',$dateto),date('y',$dateto));*/
if($_POST['checked']=='YES')
		{
		
		if($_POST['checked']!='') $checked_con = ' and j.checked="'.$_POST['checked'].'" ';
		}
		else
		{

		if($_POST['checked']!='') $checked_con = ' and j.checked="" ';
		}

	if($_SESSION['user']['group']>1) $group_s='AND j.group_for='.$_SESSION['user']['group'];
	if($_POST['dealer_type']!='') 	 $depot_con .= ' AND d.dealer_type="'.$_POST['dealer_type'].'"';
	if($_POST['ledger_id']!='') 	 $led_con .= ' AND l.ledger_id="'.$_POST['ledger_id'].'"';

	if($depot_id>0) 				 $depot_con .= 'and j.cc_code='.$depot_id;
	 $sql="SELECT
				  j.tr_no,
				  sum(1) as co,
				  sum(j.dr_amt) as dr_amts,
				  j.jv_date as jdate,
				  j.jv_no,
				  l.ledger_name,
				  j.tr_id,
				  u.fname,
				  j.entry_at,
				  j.checked,
				  j.jv_no,
				  j.dr_amt
				FROM
				  secondary_journal j,
				  accounts_ledger l,
				  user_activity_management u
				WHERE
				  j.entry_by = u.user_id and 
				  j.tr_from = 'Consumption' AND 
				  j.dr_amt >0 AND 
				 
				  j.ledger_id = l.ledger_id and j.jv_date between '".$_POST['do_date_fr']."' and '".$_POST['do_date_to']."' ".$group_s." ".$depot_con.$dg.$led_con.$checked_con."
				group by  j.tr_no order by j.jv_date asc";
	  $query=mysql_query($sql);
	  
	  while($data=mysql_fetch_object($query)){
	  $received = $received + $data->dr_amts;
	  ?>

      <tr <?=($i%2==0)?'class="alt"':'';?>>
      <td align="center"><div align="left"><?=++$i;?></div></td>
      <td align="center"><div align="left"><? echo $data->tr_no;?></div></td>
      <td align="center"><?=find_a_field('warehouse_other_issue','manual_oi_no','oi_no='.$data->tr_no);?></td>
      <td align="center"><?=find_a_field('warehouse_other_issue','req_no','oi_no='.$data->tr_no);?></td>
      <td align="center"><?=find_a_field('warehouse_other_issue','req_date','oi_no='.$data->tr_no);?></td>
      <td align="center"><div align="left"><? echo $data->ledger_name;?></div></td>
      <td align="center"><div align="left"><?=$data->jdate;?></div></td>
      <td align="center"><div align="left"><? echo $data->fname;?></div></td>
      <td align="right"><?=number_format($data->dr_amts,2);?></td>
      <td align="center"><a target="_blank" href="packing_consumption_sec_print_view.php?jv_no=<?=$data->jv_no ?>"><img src="../images/print_hover.png" width="20" height="20" /></a></td>
      <td align="center"><span id="divi_<?=$data->tr_no?>">
<? 
if(($data->checked=='YES')){
?>
<input type="button" name="Button" value="YES"  onclick="window.open('packing_consumption_sec_print_view.php?jv_no=<?=$data->jv_no;?>');" style=" font-weight:bold;width:40px; height:24px;background-color:#66CC66;"/>
<?
}elseif(($data->checked=='NO' || $data->checked=='')){
?>
<input type="button" name="Button" value="NO" onclick="window.open('packing_consumption_sec_print_view.php?jv_no=<?=$data->jv_no;?>');" style="font-weight:bold;width:40px; height:24px;background-color:#FF0000;"/>
<? }?>
          </span></td>
      </tr>
	  <? }?>
	        <tr class="alt">
        <td colspan="8" align="center"><div align="right"><strong>Total Amt : </strong></div>
          
            <div align="left"></div></td>
        <td align="right"><?=number_format($received,2);?></td>
        <td align="center">&nbsp;</td>
        <td align="center"><div align="left"></div></td>
      </tr>
  </tbody></table>





	  </div>


        
    </div>

</form>





				<?php /*?>
 <br /> <br />

 <form id="form2" name="form2" method="post" action="">



<table width="100%" border="0" cellspacing="0" cellpadding="0">



  <tr>

    <td>      <table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr>

			<td><table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#FF9999">

              <tr>

                <td width="20%"><div align="right"><strong>PO Date :</strong></div></td>

                <td width="20%"><input name="do_date_fr" class="form-control" type="text" id="do_date_fr" value="<?=$_POST['do_date_fr']?>" required /></td>

                <td width="5%"><div align="center">-to-</div></td>

                <td width="20%"><input name="do_date_to" type="text" id="do_date_to" value="<?=$_POST['do_date_to']?>" class="form-control"  required /></td>

                <td width="20%" rowspan="4"><label>

                  <input type="submit" name="submitit" id="submitit" value="View PO" class="btn1 btn1-submit-input"/>

                </label></td>

              </tr>

              <tr>

                <td><div align="right"><strong>Checked : </strong></div></td>

                <td colspan="3"><div align="left"><span class="oe_form_group_cell" >

                    <select name="checked" id="checked" class="form-control">

                      <option></option>

                      <option <?=($_POST['checked']=='NO')?'Selected':'';?>>NO</option>

                      <option <?=($_POST['checked']=='YES')?'Selected':'';?>>YES</option>

                    </select>

                </span></div></td>

                </tr>

              <tr>

                <td><div align="right"><strong>Chalan Depot : </strong></div></td>

                <td colspan="3"><div align="left"><span class="oe_form_group_cell" >

                    <select name="depot_id" id="depot_id" class="form-control">
<option value=""></option>
                      <? foreign_relation('warehouse','warehouse_id','warehouse_name',$_POST['depot_id'],'use_type="SD" order by warehouse_id');?>

                    </select>

                </span></div></td>

                </tr>

              <tr>

                <td><div align="right"><strong>Party Name :</strong></div> </td>

                <td colspan="3">

				<?

				

						$sql = "select v.vendor_id,v.vendor_name from vendor v where  v.group_for='".$_SESSION['user']['group']."' order by v.vendor_name";

				?>

				<select name="vendor_id" id="vendor_id" class="form-control">

                  <option></option>

                  <? 

						foreign_relation_sql($sql,$vendor_id);?>

                </select></td>

              </tr>

            </table></td>

	    </tr>

		<tr><td>&nbsp;</td></tr>

        <tr>

          <td>

      <table width="98%" align="center" cellspacing="0" class="tabledesign">

      <tbody>

      <tr>

      <th>SL</th>

	  

      <th>PO#</th>

      <th>Sale No #</th>

      <th>Party Name</th>

      <th>Depot</th>

      <th>Create At</th>

      <th>Create By </th>

      <th>Payable Amt</th>

      <th>&nbsp;</th>

      <th>Checked?</th>

      </tr>

	  <?





		 if($_POST['do_date_fr']!=''){

	  $i=0;

		if($_POST['checked']!='') $checked_con = ' and j.checked="'.$_POST['checked'].'" ';

	 	if($_SESSION['user']['group']>1) $group_s='AND j.group_for='.$_SESSION['user']['group'];

		if($_POST['depot_id']>0) $depot_con = ' and w.warehouse_id="'.$_POST['depot_id'].'" ';

		if($_POST['vendor_id']!='') {$vendor_con=' and r.vendor_id="'.$_POST['vendor_id'].'"';}

	    $sql="SELECT DISTINCT 

				  j.tr_no,


				  cr_amt,

				  1,

				  j.jv_date,

				  j.jv_no,

				  l.ledger_name,

				  j.narration,

				  u.fname,

				  j.entry_at,

				  j.checked,

				  j.jv_no,
				  
				  w.warehouse_name,

				  r.po_no

				FROM

				  secondary_journal j,

				  accounts_ledger l,

				  purchase_invoice r,

				  warehouse w,

				  user_activity_management u,
				  
				  vendor v

				WHERE
				  j.cr_amt>0 and 

				  r.vendor_id=v.vendor_id and
					
				  w.warehouse_id=r.warehouse_id AND

				  j.tr_id = r.po_no AND

				  j.tr_from = 'Purchase' AND 

				  j.entry_by = u.user_id AND 

				  j.jv_date between '".$_POST['do_date_fr']."' AND  '".$_POST['do_date_to']."' AND j.ledger_id = l.ledger_id ".$group_s.$checked_con.$depot_con.$vendor_con." group by j.jv_no";

	  $query=mysql_query($sql);

	  

	  while($data=mysql_fetch_row($query)){
$received = $received + $data[1];
	  ?>



      <tr class="alt">

      <td align="center"><div align="left">

        <?=++$i;?>

      </div></td>

      <td align="center"><div align="left"><? echo $data[12];?></div></td>

      <td align="center"><div align="left"><? echo $data[6];?></div></td>

      <td align="center"><div align="left"><? echo $data[5];?></div></td>

      <td align="center"><div align="left"><? echo $data[11];?></div></td>

      <td align="center"><div align="left"><? echo $data[8];?></div></td>

      <td align="center"><div align="left"><? echo $data[7];?></div>        <div align="left"></div></td>

      <td align="right"><?=number_format($data[1],2)?></td>

      <td align="center"><a target="_blank" href="purchase_sec_print_view.php?jv_no=<?=$data[10] ?>"><img src="../images/print_hover.png" width="20" height="20" /></a></td>

      <td align="center"><span id="divi_<?=$data[0]?>">

            <? 

			  if(($data[9]=='YES')){

?>

<input type="button" name="Button" value="YES"  onclick="window.open('purchase_sec_print_view.php?jv_no=<?=$data[10] ?>');" class="btn1 btn1-bg-submit"/>

<?

}elseif(($data[9]=='')){

?>

<input type="button" name="Button" value="NO"  onclick="window.open('purchase_sec_print_view.php?jv_no=<?=$data[10] ?>');" class="btn1 btn1-bg-cancel/>

<? }?>

          </span></td>

      </tr>

	  <? }}?>

	        <tr class="alt">

        <td colspan="7" align="center"><div align="right"><strong>Total Received: </strong></div>

          

            <div align="left"></div></td>

        <td align="right"><?=number_format($received,2);?></td>

        <td align="center">&nbsp;</td>

        <td align="center"><div align="left"></div></td>

      </tr>

  </tbody></table>		  

  </td>

	    </tr>

		<tr>

		<td>&nbsp;</td>

		</tr>

		<tr>

		<td>

		<div>

                    

		<table width="100%" border="0" cellspacing="0" cellpadding="0">		

		<tr>		

		<td>

		<div style="width:380px;"></div></td>

		</tr>

		</table>

	        </div>

		</td>

		</tr>

      </table></td></tr>

</table>

</form>
<?php */?>
<?

require_once "../../../assets/template/layout.bottom.php";

?>

