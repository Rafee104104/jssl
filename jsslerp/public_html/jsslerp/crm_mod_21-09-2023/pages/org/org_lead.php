<?php

require_once "../../../assets/template/layout.top.php";

$user_name = find_a_field('user_activity_management','username','user_id="'.$_SESSION['user']['id'].'"');

$_SESSION['employee_selected'] = find_a_field('user_activity_management','PBI_ID','user_id="'.$_SESSION['user']['id'].'"');

$orgAll=find_all_field('crm_project_org','','id='.$_GET['id']);

 $table1 = 'crm_project_lead';
 $crud1 = new crud($table1);
 
 if(isset($_POST['insert'])){

$_POST['entry_by'] = $_SESSION['user']['id'];
$log_id=$crud1->insert();

$cd= new crud('crm_lead_log');
  $_POST['lead_id']=$log_id;
  $cd->insert(); 	

echo "<script>window.top.location='show_all_org.php'</script>";
 }
?>
<script type="text/javascript" src="../../../assets/js/bootstrap.min.js"></script>

<div class="modal-dialog modal-lg">

        <div class="modal-content">

        <div class="modal-header">

            <h3 class="modal-title" id="exampleModalLongTitle">Organization to Lead Convert</h3>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

            <span aria-hidden="true">&times;</span>

            </button>

          </div>

          <form method="post" >

          <div class="modal-body">
              
          <h5 class="text-center" style="font-size:18px; font-weight:bold;">Lead Information</h5>
            
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                        <label>Customer Name</label>
                        <select  name="organization"  class=" input_general" class="form-control" >
						    <? foreign_relation('crm_project_org','id','name',$orgAll->id,'id='.$orgAll->id); ?>
						</select>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                        <label>Lead Status</label>
                        <select  name="status" id="status" class=" form-control input_general"  data-live-search="true">
						    <option></option>
						    <? foreign_relation('crm_lead_status','id','status',$lead_status,'1'); ?>
						</select>
                    </div>
                    
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                        <label>Assign Person</label>
                        <select  name="assign_person"  class=" form-control input_general" data-live-search="true">
						    <option></option>
						    <? foreign_relation('personnel_basic_info','PBI_ID','PBI_NAME',$assign_person,'1'); ?>
				        </select>
                    </div>
                </div>
            </div>
            
            
            <h5 class="text-center mt-4" style="font-size:18px; font-weight:bold;">Customer Requirements</h5>
            
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                        <label>Property Type</label>
                        <select  name="property_type"  id="property_type" class="form-control input_general"  data-live-search="true">
						    <option value=""></option>
						    <option value="1">Commercial</option>
						    <option value="2">Plot</option>
						    <option value="3">Residential</option>
						</select>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                        <label>Required Location</label>
                        <input type="text" name="req_loc" id="req_loc" value="<?=$datas->req_loc?>" class="form-control">
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                        <label>Property Size:</label>
                         <input type="text" name="req_size" id="req_size" value="<?=$datas->req_size?>" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                        <label>Customer Budget</label>
                        <input type="text" name="customer_bud" id="customer_bud" value="<?=$datas->customer_bud?>" class="form-control">
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                        <label>Required Loan</label>
                       <select  name="req_loan" id="req_loan"  class=" input_general"  data-live-search="true">
						    <option value=""></option>
						    <option value="1">Yes</option>
						    <option value="2">No</option>
						</select>
                    </div>
                </div>
                
                <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                        <label>Remarks</label>
                         <input type="text" name="cus_remarks" id="cus_remarks" value="<?=$datas->cus_remarks?>" class="form-control">
                    </div>
                </div>
            </div>
            
            <h5 class="text-center mt-4" style="font-size:18px; font-weight:bold;">Offer Information</h5>
            
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                        <label>Offered Property</label>
						<select  name="product"  class=" input_general"  data-live-search="true">
						<option></option>
						<? foreign_relation('crm_lead_products','id','products',$product,'1'); ?>
						</select>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                        <label>Type Of Visitor</label>
                        <select  name="visitor_type" id="visitor_type" class=" input_general"   data-live-search="true">
						    <option></option>
						    <option value="1">Broker</option>
						      <option value="2">Builder</option>
						        <option value="3">Buyer</option>
						    <?// foreign_relation('crm_project_org','id','name',$lead_org,'1'); ?>
						</select>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                        <label>Lead Source</label>
                        <select  name="lead_source"  class=" input_general"  data-live-search="true">
						    <option></option>
						    <option value="1">99 acres</option>
						    <option value="2">Facebook</option>
						    <option value="3">Inbound</option>
						    <?// foreign_relation('crm_lead_status','id','status',$lead_status,'1'); ?>
						</select>
                    </div>
                </div>
                
            </div>
            <div class="row mt-2">
               <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                        <label>Upload Documents</label>
                        <input type="file" name="lead_doc1" id="lead_doc1"> 
                    </div>
                </div>
                 <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                        <label>Upload Documents</label>
                        <input type="file" name="lead_doc2" id="lead_doc2"> 
                    </div>
                </div>
                 <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                        <label>Upload Documents</label>
                        <input type="file" name="lead_doc3" id="lead_doc3"> 
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12 col-xs-12">
                    <div class="form-group">
                        <label>Remarks</label>
                        <textarea name="reamarks" id="reamarks" class="form-group"></textarea>
                    </div>
                </div>
            </div>

			<div class="modal-footer">

            <button type="submit" class="btn btn-primary" name="insert">Save</button>
            <span  class="btn btn-danger" onclick="location.href='show_all_org.php'">Go Back</span>

          </div>
          </form>

          

        </div>

      </div>



<? require_once "../../../assets/template/layout.bottom.php"; ?>






