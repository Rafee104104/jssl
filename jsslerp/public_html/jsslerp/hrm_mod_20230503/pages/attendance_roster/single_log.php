<?php

require_once "../../../assets/template/layout.top.php";

require_once "../sms_function.php";

$title='Single Log  Report';

$page_id = 35;

do_datatable('grp');

function auto_dropdown($sql){

$res=mysql_query($sql);

while($data=mysql_fetch_row($res)){

if($value==$data[0])

echo '<option value="'.$data[0].'" selected>'.$data[1].'</option>';

else

echo '<option value="'.$data[0].'">'.$data[1].'</option>';

}}



//ini_set('display_errors', 1);

//ini_set('display_startup_errors', 1);

//error_reporting(E_ALL);

$head='<link href="../../css/report_selection.css" type="text/css" rel="stylesheet"/>';

do_calander('#start_date');

do_calander('#end_date');

$PBI_ID = $_POST['PBI_ID'];



?>



<div class="form-container_large">
 	<form action="?"  method="post">
          <h4 class="text-center bg-titel bold pt-2 pb-2">Select Employee</h4>
        <div class="container-fluid bg-form-titel">
					
		
		
				<div class="row">
					
							<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
								<div class="form-group row m-0">
									<label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">From Date</label>
									<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
										<input type="text" name="start_date" id="start_date"  required 

	value="<? if(isset($_POST['start_date'])){ echo $_POST['start_date']; }else{echo date('Y-m-01'); } ?>" />
	  
									</div>
								</div>
				
							</div>
							<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
								<div class="form-group row m-0">
									<label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">To Date</label>
									<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
										<input type="text" name="end_date" id="end_date"  required 

	 value="<? if(isset($_POST['end_date'])){ echo $_POST['end_date']; }else{echo date('Y-m-25'); } ?>"/>
				
									</div>
								</div>
							</div>
							<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
								<div class="form-group row m-0">
									<label class="col-sm-5 col-md-5 col-lg-5 col-xl-5 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Employee ID</label>
									<div class="col-sm-7 col-md-7 col-lg-7 col-xl-7 p-0">
										<input name="PBI_ID"  type="text" id="PBI_ID" size="10" onblur="" tabindex="1" style="width:400px;" required="required" value="<?=$_POST['PBI_ID']?>" />
    
									</div>
								</div>
				
						
					</div>
				
					<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
						
						<input name="create" type="submit" id="create" class="btn1 btn1-bg-submit" value="Show Report" />
					</div>
				</div>

			</div>
	
		<br />
		
		<table class="table1  table-striped table-bordered table-hover table-sm">
					<thead class="thead1">
					
					</thead>

					<tbody class="tbody1">
							<? if($_POST['PBI_ID']>0){


								
								$start_date = $_POST['start_date'];
								
								$end_date = $_POST['end_date'];
								
								
								
								$begin = new DateTime($start_date);
								
								$end = new DateTime($end_date);
								
								$end->modify('+1 day');
								
								
								
								$startTime = $days1=mktime(1,1,1,date('m',strtotime($start_date)),26,date('y',strtotime($start_date)));
								
								
								
								$endTime = $days2=mktime(1,1,1,date('m',strtotime($end_date)),25,date('y',strtotime($end_date)));
								
								
								
								$days_mon=($endTime - $startTime)/(3600*24);
								
								
								
								for ($i = $startTime; $i <= $endTime; $i = $i + 86400) {
								
								$day   = date('l',$i);
								
								${'day'.date('N',$i)}++;
								
								
								
								//if(isset($$day))
								
								//$$day .= ',"'.date('Y-m-d', $i).'"';
								
								//else
								
								//$$day .= '"'.date('Y-m-d', $i).'"';
								
								}
								
								
								
								$ab="SELECT 
								
								a.PBI_NAME as name,
								
								c.group_name as company,
								
								desi.DESG_DESC as designation, 
								
								d.DEPT_DESC as department,
								
								j.LOCATION_NAME
								
								FROM 
								
								personnel_basic_info a, 
								
								user_group c, 
								
								department d, 
								
								designation desi,
								
								office_location j 
								
								WHERE 
								
								a.PBI_ORG=c.id and 
								
								a.DEPT_ID=d.DEPT_ID and 
								
								a.DESG_ID=desi.DESG_ID and 
								
								
								
								a.PBI_ID='".$_POST['PBI_ID']."'";
								
								$abb = mysql_query($ab);
								
								$pbi=mysql_fetch_object($abb);
								
						?>
						
						
						<tr class="">
							<td>Name: </td>
						
							<td>&nbsp;<?=$pbi->name?></td>
						
							<td>Company:</td>
						
							<td>&nbsp;<?=$pbi->company?>,<?=$pbi->LOCATION_NAME?></td>
						
						</tr>
						<tr class="">

							<td>Designation:</td>
						
							<td>&nbsp;<?=$pbi->designation?></td>
						
							<td>Department:</td>
						
							<td>&nbsp;<?=$pbi->department?></td>
						
						 </tr>
				
						
					</tbody>
				</table>
				
				<? 


					
					// SMS Send
					
					if($_POST['PBI_ID']=='1867'){
					
					$dest_addr='8801711763169';
					
					$sms_text = 'Single Log View from '.$_POST['start_date'].' to '.$_POST['end_date'].' by id:'.$_SESSION['user']['id'];
					
					gpsms('SAJEEBGROUP',$dest_addr,$sms_text);
					
					}
					
					
					}
					
					
			 ?>
				
			</form>
			
			
		




    <form  action="" method="post" enctype="multipart/form-data">
        
        <div class="container-fluid pt-5 p-0 ">
			<?php
			
			$table='hrm_attdump';
			
			$unique='sl';
			
			$crud  =new crud($table);
			
			$res = "SELECT sl,xenrollid as code,xlocationid as location_id,xmechineid as machine_id,xdate,xtime
			
			FROM hrm_attdump WHERE xenrollid = '".$_POST['PBI_ID']."' and xdate between '".$_POST['start_date']."' and '".$_POST['end_date']."'
			
			";
			
			echo link_report1($res,$link);
			
			
			
			?>


            

        </div>

    </form>
</div>





<?php /*?><div class="oe_view_manager oe_view_manager_current">

        

        <div class="oe_view_manager_body">

            

                <div  class="oe_view_manager_view_list"></div>

            

                <div class="oe_view_manager_view_form"><div style="opacity: 1;" class="oe_formview oe_view oe_form_editable">

        <div class="oe_form_buttons"></div>

        <div class="oe_form_sidebar"></div>

        <div class="oe_form_pager"></div>

        <div class="oe_form_container"><div class="oe_form">

          <div class="">

<div class="oe_form_sheetbg">

        <div class="oe_form_sheet oe_form_sheet_width">



          <div  class="oe_view_manager_view_list"><div  class="oe_list oe_view"><form action="?"  method="post">

<table width="100%" border="0" class="table table-bordered table-sm"><thead>

<!--<tr class="oe_list_header_columns">

  <th colspan="4"><span style="text-align: center; font-size:18px; color:#09F">Single Log  Report </span></th>

  </tr>-->

<tr class="table-info" style="text-align:center">

  <th colspan="4"><span style="text-align: center; font-size:16px; color:#C00">Select Employee</span></th>

  </tr>

</thead><tfoot>

</tfoot><tbody>



  <tr  class="alt">

    <td width="37%" align="right"><strong>Employee Code  :</strong></td><td colspan="3" align="left">

	<!--<input name="PBI_ID"  type="text" id="PBI_ID" size="10" onblur="" tabindex="1" style="width:400px;" required value="<?=$_POST['PBI_ID']?>" />-->

	<input name="PBI_ID"  type="text" id="PBI_ID" size="10" onblur="" tabindex="1" style="width:400px;" required="required" value="<?=$_POST['PBI_ID']?>" /></td>

    </tr>

	  <tr >

    <td align="right"><strong>Start Date  :</strong></td>

    <td width="9%" align="left">

	<input type="text" name="start_date" id="start_date" style="width:100px;" required 

	value="<? if(isset($_POST['start_date'])){ echo $_POST['start_date']; }else{echo date('Y-m-01'); } ?>" /></td>

	

    <td width="16%" align="right"><strong>End Date   :</strong></td>

    <td width="38%">

	<input type="text" name="end_date" id="end_date" style="width:100px;" required 

	 value="<? if(isset($_POST['end_date'])){ echo $_POST['end_date']; }else{echo date('Y-m-25'); } ?>"/></td>

  </tr>

<tr class="oe_list_header_columns">

  <th colspan="4"><table width="1%" border="0" align="center" cellpadding="0" cellspacing="0">

    <tr>

      <td><input name="create" type="submit" id="create" class="btn1 btn1-bg-submit" value="Show Report" /></td>

    </tr>

  </table>

    </th>

</tr>



  </tbody></table></form>

<br /><? if($_POST['PBI_ID']>0){



$start_date = $_POST['start_date'];

$end_date = $_POST['end_date'];



$begin = new DateTime($start_date);

$end = new DateTime($end_date);

$end->modify('+1 day');



$startTime = $days1=mktime(1,1,1,date('m',strtotime($start_date)),26,date('y',strtotime($start_date)));



$endTime = $days2=mktime(1,1,1,date('m',strtotime($end_date)),25,date('y',strtotime($end_date)));



$days_mon=($endTime - $startTime)/(3600*24);



for ($i = $startTime; $i <= $endTime; $i = $i + 86400) {

$day   = date('l',$i);

${'day'.date('N',$i)}++;



//if(isset($$day))

//$$day .= ',"'.date('Y-m-d', $i).'"';

//else

//$$day .= '"'.date('Y-m-d', $i).'"';

}



$ab="SELECT 

a.PBI_NAME as name,

c.group_name as company,

desi.DESG_DESC as designation, 

d.DEPT_DESC as department,

j.LOCATION_NAME

FROM 

personnel_basic_info a, 

user_group c, 

department d, 

designation desi,

office_location j 

WHERE 

a.PBI_ORG=c.id and 

a.DEPT_ID=d.DEPT_ID and 

a.DESG_ID=desi.DESG_ID and 



a.PBI_ID='".$_POST['PBI_ID']."'";

$abb = mysql_query($ab);

$pbi=mysql_fetch_object($abb);

?>

<div style="text-align:center">

<table width="100%" class="table table-bordered table-sm">

<thead>

<tr><td colspan="4"><span id="id_view"></span>          

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr class="table-warning">

    <td>Name: </td>

    <td>&nbsp;<?=$pbi->name?></td>

    <td>Company:</td>

    <td>&nbsp;<?=$pbi->company?>,<?=$pbi->LOCATION_NAME?></td>

  </tr>

  <tr class="table-warning">

    <td>Designation:</td>

    <td>&nbsp;<?=$pbi->designation?></td>

    <td>Department:</td>

    <td>&nbsp;<?=$pbi->department?></td>

  </tr>

</table>

<? 



// SMS Send

if($_POST['PBI_ID']=='1867'){

$dest_addr='8801711763169';

$sms_text = 'Single Log View from '.$_POST['start_date'].' to '.$_POST['end_date'].' by id:'.$_SESSION['user']['id'];

gpsms('SAJEEBGROUP',$dest_addr,$sms_text);

}





} ?>

<p>

<?php

$table='hrm_attdump';

$unique='sl';

$crud  =new crud($table);

$res = "SELECT sl,xenrollid as code,xlocationid as location_id,xmechineid as machine_id,xdate,xtime

FROM hrm_attdump WHERE xenrollid = '".$_POST['PBI_ID']."' and xdate between '".$_POST['start_date']."' and '".$_POST['end_date']."'

";

echo $crud->link_report($res,$link);



?>

  <div class="oe_chatter"><div class="oe_followers oe_form_invisible">

      <div class="oe_follower_list"></div>

    </div></div>
<?php */?>




<?

require_once "../../../assets/template/layout.bottom.php";

?>