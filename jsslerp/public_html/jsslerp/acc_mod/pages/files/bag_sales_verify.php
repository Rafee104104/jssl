<?php
require_once "../../../assets/template/layout.top.php";
$title='Bag Sales Varification';
$now=time();
do_calander('#do_date_fr');
do_calander('#do_date_to');
$depot_id = $_POST['depot_id'];
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
<style>
.form-group{
	margin-bottom:3px!important;
	}
	.col-md-4{	
		padding-top:10px;
		}
</style>





<div class="form-container_large">
    
    <form id="form2" name="form2" method="post" action="">
           
        <div class="container-fluid bg-form-titel">
            <div class="row">
                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group row m-0">
                        <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">From  Date</label>
                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
                           <input name="do_date_fr" type="text" id="do_date_fr" value="<?=$_POST['do_date_fr']?>" class="form-control" autocomplete="off"/>
                        </div>
                    </div>

                </div>
				<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group row m-0">
                        <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">To Date</label>
                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
                            <input name="do_date_to" type="text" id="do_date_to" value="<?=$_POST['do_date_to']?>"  class="form-control" autocomplete="off"/>
                        </div>
                    </div>

                </div>
                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group row m-0">
                        <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Checked</label>
                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
                            <select name="checked" id="checked" class="form-control">
							  <option></option>
							  <option <?=($_POST['checked']=='NO')?'Selected':'';?>>NO</option>
							  <option <?=($_POST['checked']=='YES')?'Selected':'';?>>YES</option>
							</select>
                        </div>
                    </div>

                </div>
				<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    

                </div>

                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    

                </div>
				<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    

                </div>

            </div>
        </div>


		<div class="container-fluid p-0 ">

				<div class="n-form-btn-class">
					<input type="submit" name="submitit" id="submitit" value="View Details"  class="btn1 btn1-submit-input" />
				</div>

		</div>



            
        <div class="container-fluid pt-5 p-0 ">



                <table class="table1  table-striped table-bordered table-hover table-sm">
                    <thead class="thead1">
                    <tr class="bgc-info">
					
							<th>SL</th>
	  
						    <th>Loan No </th>
					      <th>Ledger Name</th>
						  <th>Loan  Date </th>
						  <th>Entry By </th>
						  <th>Loan  Amt</th>
						  <th>Checked?</th>
					</tr>
                    </thead>

                    <tbody class="tbody1">
						<? if($_POST['do_date_fr']!=''){
									  
							
							$i=0;
							
							$datefr = strtotime($_POST['do_date_fr']);
							$dateto = strtotime($_POST['do_date_to']);
							$day_from = mktime(0,0,0,date('m',$datefr),date('d',$datefr),date('y',$datefr));
							$day_end =  mktime(23,59,59,date('m',$dateto),date('d',$dateto),date('y',$dateto));
							if($_SESSION['user']['group']>1) $group_s='AND j.group_for='.$_SESSION['user']['group'];
							
									if($depot_id>0) $depot_con = ' and SUBSTR(j.tr_no,7,2)='.$depot_id;
									if($_POST['checked']!='') $checked_con = ' and j.checked="'.$_POST['checked'].'" ';
									if($_POST['dealer_type']!=''){$dealer_type_con=' and d.dealer_type="'.$_POST['dealer_type'].'"';}
									if($_POST['dealer_group']!='') {$dealer_group_con=' and d.product_group="'.$_POST['dealer_group'].'"';}
									   $sql="SELECT DISTINCT 
		
											  j.tr_no,
											  sum(j.dr_amt) as dr_amt,
											  sum(j.cr_amt) as cr_amt,
											  j.jv_date,
											  j.jv_no,
											  l.ledger_name,
											  j.tr_id,
											  j.entry_by,
											  j.entry_at,
											  j.checked,
											  j.jv_no,
											  u.fname,m.sr_loan_id
																		 
														
																		FROM
																		  secondary_journal j,
											  accounts_ledger l,
											  dealer_info d,
											  user_activity_management u,
											  bag_loan m
																		
																		WHERE
																		   j.entry_by=u.user_id and
											 d.account_code = l.ledger_id and 
											  j.tr_from = 'Bag Sales' AND 
											  j.tr_no = m.sr_loan_id and d.dealer_code_eng = m.dealer_code_eng and 
											  j.jv_date between '".$_POST['do_date_fr']."' AND '".$_POST['do_date_to']."'  ".$group_s." ".$depot_con.$checked_con.$dealer_type_con.$dealer_group_con." 
											group by  j.tr_no order by tr_no asc";
								  $query=mysql_query($sql);
								  
		  ?>
		  
							<?


						  
						  while($data=mysql_fetch_object($query)){
						 // $received = $received + ($data->cr_amt);
						  ?>
                      
                            <tr <?=($i%2==0)?'class="alt"':'';?> >
								  <td align="center"><div align="left"><?=++$i;?></div></td>
								  <td align="center"><? echo $data->sr_loan_id;?></td>
								  <td align="center"><div align="left"><? echo $data->ledger_name;?></div></td>
								  <td align="center"><div align="left"><?=$data->jv_date;?></div></td>
								  <td align="center"><div align="left"><?=$data->fname;?></div></td>
								  <td align="right"><? if($data->cr_amt>0) { echo $data->cr_amt; } else {echo $data->dr_amt; } ?></td>
								  <td align="center"><span id="divi_<?=$data->tr_no?>">
							<? 
							if(($data->checked=='YES')){
							?>
							<input type="button" name="Button" value="YES"  onclick="window.open('sales_sec_print_view2.php?jv_no=<?=$data->jv_no;?>');" class="btn1 btn1-bg-submit"/>
							<?
							}elseif(($data->checked=='NO')){
							?>
							<input type="button" name="Button" value="NO"  onclick="window.open('sales_sec_print_view2.php?jv_no=<?=$data->jv_no;?>');" class="btn1 btn1-bg-cancel"/>
							<? }?>
          </span></td>
                        </tr>
						
						<? } } ?>
                    </tbody>
                </table>





        </div>
    </form>
</div>











<?
require_once "../../../assets/template/layout.bottom.php";
?>
