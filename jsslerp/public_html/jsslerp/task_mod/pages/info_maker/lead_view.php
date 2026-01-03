<?php
require_once "../../../assets/template/layout.top.php";

$title = "Lead Info";

do_calander('#date');

 $cur = '&#x9f3;';

 $table1 = 'crm_project_lead';

 $table2 = 'crm_task_lists';
 require "../include/custom.php";

 $id = decrypTS($_GET['view']);
 $orgId=find_a_field('crm_project_lead','organization','id="'.$id.'"');
 $type = decrypTS($_GET['tp']);
$condition="id=".$id;
$data=db_fetch_object('crm_project_lead',$condition);
while (list($key, $value)=@each($data))
{ $$key=$value;}


if(isset($_POST['insert'])){

$crud= new crud('crm_lead_activity');
$_POST['entry_by']=$_SESSION['user']['id'];
$_POST['entry_at']=date('Y-m-d H:i:s');
$crud->insert();
}
if(isset($_POST['leadUp'])){
$crud= new crud('crm_project_lead');
$_POST['id']=$id;
$crud->update('id');
 $lastStatus=find_a_field('crm_lead_log','status','lead_id="'.$id.'" order by id DESC');
if($lastStatus!=$_POST['status']){
$sql='insert into crm_lead_log (lead_id,status,assign_person,entry_by) values("'.$id.'","'.$_POST['status'].'","'.$_POST['assign_person'].'","'.$_SESSION['user']['id'].'")';
mysql_query($sql);
}
echo "<script>window.top.location='../lead_management/show_all_leads.php'</script>";

}
if(isset($_POST['actDel'])){
mysql_query('delete from crm_lead_activity where id="'.$_POST['del_activity'].'"');
}


?>







    <div class="row">

        <div class="col-lg-12">

            

            <div class="card">

                

                

                <?php 


                    

                        $qry = "SELECT * FROM crm_project_lead WHERE id = '$id'";

                        $rslt = mysql_query($qry);

                        if($rows = mysql_fetch_object($rslt)){

                            

                ?>

                    

                        <div class="card-header" style="background:#f3f3f3;">
<?php /*?>
                            <h5>Lead Details <span class="float-right" style="font-size:11.5px;">[Status:<b> <?=find_a_field('crm_lead_status', 'status', 'id = "'.$rows->status.'"')?></b>]</span></h5><?php */?>
						
							<form method="post"><label>Product</label>
						<select  name="product"  class=" input_general mt-2"  data-live-search="true"  disabled="disabled">
						<option></option>
						<? foreign_relation('crm_lead_products','id','products',$product,'1'); ?>
						</select><label >Lead Status</label>
				<select  name="status"  class=" input_general mt-2"  data-live-search="true">
						<option></option>
						<? foreign_relation('crm_lead_status','id','status',$status,'1'); ?>
				</select><label>Assign Person</label>
				<select  name="assign_person"  class=" input_general mt-2"  data-live-search="true">
						<option></option>
						<? foreign_relation('personnel_basic_info','PBI_ID','PBI_NAME',$assign_person,'1'); ?>
				</select><button name="leadUp" type="submit" class="mt-2 btn btn-warning" style="margin-bottom: 0.5%;">Update</button></form>

                        </div>

                        

                        <div class="card-body">

                

                            <h5 class="card-title mb-2"><b>

                                <?=$rows->name?></b>

                                <span class="float-right">

                                    <a href="../lead_management/show_all_leads.php" class="btn btn-primary text-light btn-sm"><i class="fa fa-arrow-left"></i> Go Back</a>

                                  

                                </span>

                            </h5>

                            <hr>
<?
                    

                        $qry = "SELECT * FROM crm_project_org WHERE id = '$orgId'";

                        $rslt = mysql_query($qry);

                        if($rows = mysql_fetch_object($rslt)){

?>
                            <div class="d-flex">

                                <div class="col-md-6">

                                    

                                    <?php if($rows->logo != NULL){ ?>

                                    <div class="col-md-3 mb-3 p-0">

                                        <img src="../lead_management/imgs/company_logo/<?=$rows->logo?>" width="82" height="76" style="border: 1px solid #b7b7b79e;">

                                    </div>

                                    <?php } ?>

                                    

                                    <p class="card-text"><b>Company</b>: <?=$rows->name?></p>

                                    

                                    <?php if($rows->description !=''){ ?>

                                        <p class="card-text"><b>Description</b>: <?=$rows->description?></p>

                                    <?php } ?>

    

                                    <p class="card-text"><b>Entry By</b>: <?=find_a_field('user_activity_management', 'fname', 'PBI_ID = "'.$rows->entry_by.'"')?></p>

                                    

                                    <?php if($rows->lead_type != 0){ ?>

                                        <p class="card-text"><b>Work Field</b>: <?=find_a_field('crm_lead_type', 'type', 'id = "'.$rows->lead_type.'"')?></p>

                                    <?php } ?>

                                    

                                    

                                    <h6 class="mt-2"><u>Office Address</u></h6>

                                    <span class="card-text"><b>Address</b>: <?php if($rows->address != ''){echo $rows->address.', ';} ?> 

                                        <?php if($rows->city != ''){echo $rows->city.', ';} ?>

                                        <?php if($rows->zip != 0){echo find_a_field('crm_postalcode_list', 'concat(po_name,"-",po_code)', 'id = "'.$rows->zip.'"').', ';} ?>

                                        <?php if($rows->country != 0){echo find_a_field('crm_country_management', 'country_name', 'id = "'.$rows->country.'"');} ?>

                                    </span>

                                    

                                    <?php if($rows->website !=''){ ?>

                                    <p class="card-text mt-1"><b>Website</b>: <a href="<?=$rows->website?>" target="_blank"><?=$rows->website?></a></p>

                                    <?php } ?>

                                    

                                    <?php if($rows->annual_revenue != 0.0){ ?>

                                    <p class="card-text mt-1"><b>Revenue</b>:

                                        <?=$rows->annual_revenue?>/year</p>

                                    <?php } ?>

                                    

                                    <?php if($rows->total_employees != 0){ ?>

                                    <p class="card-text mt-1"><b>Total Employee(s)</b>:

                                        <?=$rows->total_employees?></p>

                                    <?php } ?>

                                    

                                    <?php if($rows->lead_source !=''){ ?>

                                    <p class="card-text mt-1"><b>Source</b>:

                                        <?=find_a_field('crm_lead_source', 'source', 'id="'.$rows->lead_source.'"')?></p>

                                    <?php } ?>

    

                                </div>

                                

                                <div class="col-md-6 lead-contacts">

                                    

                                <?php 

                                

                                    $isContact = find_a_field('crm_org_contacts', 'count(*)', 'project_id = "'.$rows->id.'"'); 

                    

                                    if($isContact > 0){

                                

                                        $leadContactSql = "SELECT * FROM crm_org_contacts WHERE project_id = '$rows->id'";

                                        $leadContactRslt = mysql_query($leadContactSql);

                                        $i = 1;

                                        

                                        while($leadContacts = mysql_fetch_object($leadContactRslt)){ 

                                

                                ?>

                                

                                                <h6 class="mt-2"><u>Contact</u> <small style="font-size: 11px;">(<?=$i?>)</small></h6>

                                                <span class="card-text"><b>Name</b>: <?=$leadContacts->contact_name?></span>

                                                <span class="card-text"><b>Designation</b>: <?=$leadContacts->contact_designation?></span>

                                                <span class="card-text"><b>Phone</b>: <a href="tel:<?=$leadContacts->contact_phone?>"><?=$leadContacts->contact_phone?></a></span>

                                                <span class="card-text"><b>Email</b>: <a href="mailto:<?=$leadContacts->contact_email?>"><?=$leadContacts->contact_email?></a></span>

                                    

                                <?php   

                                            

                                            $i++;

                                        }

                                        

                                        $flag = 1;

                                        

                                    }else{

                                        $flag = 0;

                                    }

                                

                                 

                                    if($flag == 0){ 

                                       echo '<h5 class="text-muted">No Contacts Found!</h5>';  

                                    }

                                 

                                ?>

                                    
                                    

                                </div>

                                

                            </div>
							
							<? }?>

                            

                        </div>

                        

                        <hr>

                        

                        <div class="row mt-3 mb-4">

                            <div class="col-12 p-3">

                                        

                                <h5 class="mt-2 text-center mb-4">

                                    Activities



<a data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-success btn-sm float-right mr-4 text-light">+ Add New</a>

                                    

                                </h5>

                                

                                <?php
                                    $taskQry = "SELECT * FROM crm_lead_activity WHERE lead_id = '$id'";

                                    $taskRslt = mysql_query($taskQry);

                                    while($taskRows = mysql_fetch_object($taskRslt)){

                                   
                                ?>

                                

                                <div class="card lead-task-card">

                                    <div class=" col-md-12">

                                        <h4>

                                            <span><b>Type:<u><?=$taskRows->activity_type?></u></b></span>

                                            

                                            <span class="float-right">

    	 <form method="post"> 
		 <input type="hidden" name="del_activity" value="<?=$taskRows->id?>" />                   
 		<button class="btn btn-sm btn-danger mr-2" type="submit" name="actDel"><i class="fa-solid fa-trash"></i></button>
		</form>       
  

                                            </span>

                                            

                                        </h4>

                                        

                                        <span><b>Date</b>:<?=date('d-m-Y',strtotime($taskRows->date))?></span> <br>

                                        <span><b>time</b>: <?=date('h:i a',strtotime($taskRows->time))?></span> <br>
										<span><b>Notes</b>: <?=$taskRows->details?></span>

                                    </div>

                                </div> 

                                

                                <?php } ?>

                                

                            </div>

                        </div>

                        

                        <div class="card-footer" style="background:#f3f3f3; margin:0!important;">

                 
							
							

                        </div>

                    

                <?php 

                    

                        }


                //Lead View -End-    

                ?>


                

            </div>

            

        </div>

    </div>

	
<?php /*?><div  id="exampleModalCenter" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Lead Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <form method="post" >

          <div class="modal-body">

          <h5 class=text-center>Lead Information</h5>

            <div class="row">
                <div class="col-6">
						<label>Organization Name</label>
						<select  name="organization"  class="selectpicker input_general"  data-live-search="true">
						<option></option>
						<? foreign_relation('crm_project_org','id','name',$organization,'1'); ?>
						</select>

                </div>
				<div class="col-6">
				<label>Lead Status</label>
				<select  name="status"  class="selectpicker input_general"  data-live-search="true">
						<option></option>
						<? foreign_relation('crm_lead_status','id','status',$status,'1'); ?>
				</select>
				
				</div>
				<div class="col-12 mt-4 ml-4">
				<label>Assign Person</label>
				<select  name="assign_person"  class="selectpicker input_general"  data-live-search="true">
						<option></option>
						<? foreign_relation('personnel_basic_info','PBI_ID','PBI_NAME',$assign_person,'1'); ?>
				</select>
				
				</div>
            </div>
		
        
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="leadUp">Update</button>
      </div>
	    </form>
    </div>
  </div>
</div>
<?php */?>


<div id="exampleModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

      <div class="modal-dialog modal-lg">

        <div class="modal-content">

        <div class="modal-header">

            <h5 class="modal-title" id="exampleModalLongTitle">New Activity</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

              <span aria-hidden="true">&times;</span>

            </button>

          </div>

          <form method="post" >

          <div class="modal-body">

          <h5 class=text-center>Add a New Activity</h5>

            <div class="row">
               <div class="col-md-6">
                <table class="table">
                  <tbody>
                    <tr>
                      <td>Activity type</td>
                      <td>
					  <select type="text" style="border-left: 3.5px solid #aeddf7 !important;" name="activity_type" class="form-control">
					  <option></option>
					  <option>Call</option>
					  <option>Visit</option>
					  <option>Email</option>
					  <option>Meeting</option>
					  <option>Documentation</option>
					  </select>
					  </td>
                    </tr>
                     <tr>
                      <td>Time</td>
                      <td><input type="time" style="border-left: 3.5px solid #aeddf7 !important;" autocomplete="off" name="time" class="form-control"></td>
                    </tr>
					</tr>
                  </tbody>
                </table>

              </div>
			  <div class="col-md-6">
                <table class="table">
                  <tbody>
                    <tr>
                      <td>Date</td>
                      <td><input type="text" style="border-left: 3.5px solid #aeddf7 !important;" autocomplete="off" name="date" id="date" class="form-control"></td>
                    </tr>
					  <tr>
                      <td>Details</td>
                      <td>
					  <textarea rows="10" name="details"></textarea>
					  </td>
                    </tr>
                    
                  </tbody>
                </table>

              </div>
			  <input name="lead_id" type="hidden" value="<?= $id?>" />
			  
            </div>
			<div class="modal-footer">

            <a type="button" class="btn btn-secondary text-light" data-dismiss="modal">Close</a>

            <button type="submit" class="btn btn-primary" name="insert">Save</button>

          </div>
          </form>

          

        </div>
      </div>
    </div>
	
    <script type="text/javascript" src="../../../assets/js/bootstrap.min.js"></script>		
   <!-- jQuery first, then Popper.js, then Bootstrap JS -->



<?







require_once "../../../assets/template/layout.bottom.php";







?>