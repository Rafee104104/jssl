<?php



require_once "../../../assets/template/layout.top.php";





$user_name = find_a_field('user_activity_management','username','user_id="'.$_SESSION['user']['id'].'"');



$_SESSION['employee_selected'] = find_a_field('user_activity_management','PBI_ID','user_id="'.$_SESSION['user']['id'].'"');





 $cur = '&#x9f3;';



 require "../include/custom.php";

 

  $title = "All Lead List";

 

 $table1 = 'crm_project_lead';

 $table2 = 'crm_lead_contacts';

 

 $crud1 = new crud($table1);

 $crud2 = new crud($table2);

 

 

 if(isset($_POST['insert'])){

 
mysql_query('update crm_project_org set lead=1 where id="'.$_POST['organization'].'"');

$_POST['entry_by'] = $_SESSION['user']['id'];
$log_id=$crud1->insert();

$cd= new crud('crm_lead_log');
  $_POST['lead_id']=$log_id;
  $_POST['note']="Lead Start";
  $cd->insert();
  
echo "<script>window.top.location='show_all_leads.php'</script>";
 }


?>



    <script type="text/javascript" src="../../../assets/js/bootstrap.min.js"></script>

    

    

    <div class="row well">

        <div class="col-md-12 text-right">

            <a href="../home/home.php" class="btn btn-warning" style="margin-top:12px; margin-bottom:14px;">Go Back</a>

            <a data-toggle="modal" data-target="#exampleModal"  class="btn btn-success text-light" style="margin-top:12px; margin-bottom:14px;">+ Add New</a>

        </div>    

    </div>

    

   

        <div class="col-md-12">

            <table id="example" class="table">
                <thead>

				<tr>

                    <th>SN</th>

                    <th>Organization</th>
					
					<th>Property</th>

                    <th>Assigned to</th>
					
					 <th>Status</th>

                    <th>Created at</th>

                    <th>Action</th>

					</tr>

                </thead>

                <tbody>

                

                <?php 

                

                    $sn = 1;

                    if(in_array($_SESSION['employee_selected'], $superID)){

                        $con = " 1 ";

                    }else{

                        $con = " assigned_person_id = '".$_SESSION['employee_selected']."' ";

                    }

                    

                    $leadsQry = "SELECT a.*,o.name FROM $table1 a,crm_project_org o WHERE a.organization=o.id";

                    $rslt = mysql_query($leadsQry);

                    while($row = mysql_fetch_object($rslt)){

                

                ?>

                

                    <tr>

                        <td><?=$row->id?></td>

                        <td><?=$row->name?></td>
						
						<td><?=find_a_field('crm_lead_products', 'products', 'id = "'.$row->product.'"')?></td>

                        <td><?=find_a_field('personnel_basic_info', 'PBI_NAME', 'PBI_ID = "'.$row->assign_person.'"')?></td>
						
						<td><?=find_a_field('crm_lead_status', 'status', 'id = "'.$row->status.'"')?></td>

                        <td><?=$row->entry_at?></td>

                        <td class="d-flex">

                            <a class="btn btn-sm btn-info mr-2" href="../info_maker/lead_view.php?view=<?=encrypTS($row->id)?>&tp='<?=encrypTS('lead')?>'"><i class="fa-solid fa-eye"></i></a>

                        </td>

                    </tr>

                

                <?php 

                

                    $sn++;

                    

                    } 

                    

                ?>

                

                </tbody>
            </table>   

            

        </div>











    <!-- Modal Start Here -->

    <?php if(isset($_GET['update'])){ 

        $datas = find_all_field($table1, '', 'id="'.decrypTS($_GET['update']).' AND '.$con.'"'); 

        if(isset($datas)){$assigned_id = $datas->assigned_person_id;}else{$assigned_id = $_SESSION['employee_selected'];} 

    } ?>

    

    <div id="exampleModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

      <div class="modal-dialog modal-lg">

        <div class="modal-content">

        <div class="modal-header">

            <h5 class="modal-title" id="exampleModalLongTitle">New Lead</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

              <span aria-hidden="true">&times;</span>

            </button>

          </div>

          <form method="post" enctype="multipart/form-data">

          <div class="modal-body">

          <h5 class="text-center" style="font-size:18px; font-weight:bold;">Lead Information</h5>
            
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <div class="from-group">
                        <label>Customer Name</label>
                        <select  name="organization"  class="selectpicker input_general"  data-live-search="true">
						    <option></option>
						    <? foreign_relation('crm_project_org','id','name',$lead_org,'1'); ?>
						</select>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="from-group">
                        <label>Lead Status</label>
                        <select  name="status"  class="selectpicker input_general"  data-live-search="true">
						    <option></option>
						    <? foreign_relation('crm_lead_status','id','status',$lead_status,'1'); ?>
						</select>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="from-group">
                        <label>Assign Person</label>
                        <select  name="assign_person"  class="selectpicker input_general" data-live-search="true">
						    <option></option>
						    <? foreign_relation('personnel_basic_info','PBI_ID','PBI_NAME',$assign_person,'1'); ?>
				        </select>
                    </div>
                </div>
            </div>
            
            
            <h5 class="text-center mt-5" style="font-size:18px; font-weight:bold;">Customer Requirements</h5>
            
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <div class="from-group">
                        <label>Property Type</label>
                        <select  name="property_type"  id="property_type" class="selectpicker input_general"  data-live-search="true">
						    <option value=""></option>
						    <option value="1">Commercial</option>
						    <option value="2">Plot</option>
						    <option value="3">Residential</option>
						</select>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="from-group">
                        <label>Required Location</label>
                        <input type="text" name="req_loc" id="req_loc" value="<?=$datas->req_loc?>" class="form-control">
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="from-group">
                        <label>Property Size:</label>
                         <input type="text" name="req_size" id="req_size" value="<?=$datas->req_size?>" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <div class="from-group">
                        <label>Customer Budget</label>
                        <input type="text" name="customer_bud" id="customer_bud" value="<?=$datas->customer_bud?>" class="form-control">
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="from-group">
                        <label>Required Loan</label>
                       <select  name="req_loan" id="req_loan"  class="selectpicker input_general"  data-live-search="true">
						    <option value=""></option>
						    <option value="1">Yes</option>
						    <option value="2">No</option>
						</select>
                    </div>
                </div>
                
                <div class="col-md-4 col-xs-12">
                    <div class="from-group">
                        <label>Remarks</label>
                         <input type="text" name="cus_remarks" id="cus_remarks" value="<?=$datas->cus_remarks?>" class="form-control">
                    </div>
                </div>
            </div>
            
            <h5 class="text-center mt-4" style="font-size:18px; font-weight:bold;">Offer Information</h5>
            
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <div class="from-group">
                        <label>Offered Property</label>
						<select  name="product"  class="selectpicker input_general"  data-live-search="true">
						<option></option>
						<? foreign_relation('crm_lead_products','id','products',$product,'1'); ?>
						</select>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="from-group">
                        <label>Type Of Visitor</label>
                        <select  name="visitor_type" id="visitor_type" class="selectpicker input_general"   data-live-search="true">
						    <option></option>
						    <option value="1">Broker</option>
						      <option value="2">Builder</option>
						        <option value="3">Buyer</option>
						    <?// foreign_relation('crm_project_org','id','name',$lead_org,'1'); ?>
						</select>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="from-group">
                        <label>Lead Source</label>
                        <select  name="lead_source"  class="selectpicker input_general"  data-live-search="true">
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
                    <div class="from-group">
                        <label>Upload Documents</label>
                        <input type="file" name="lead_doc1" id="lead_doc1"> 
                    </div>
                </div>
                 <div class="col-md-4 col-xs-12">
                    <div class="from-group">
                        <label>Upload Documents</label>
                        <input type="file" name="lead_doc2" id="lead_doc2"> 
                    </div>
                </div>
                 <div class="col-md-4 col-xs-12">
                    <div class="from-group">
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
            

    </div>
			<div class="modal-footer">

            <a type="button" class="btn btn-secondary text-light" data-dismiss="modal">Close</a>

            <button type="submit" class="btn btn-primary" name="insert">Save</button>

          </div>
          </form>

          

        </div>

      </div>

    </div>

    <!-- Modal End Here -->

	

<script>



    var i=1;

    $("#add_row").click(function(){



$('#addr0').append('<div class="row"><div class="col-md-6"> <table class="table"> <tbody><tr><td>Contact Person </td><td><input type="text" name="contact_name1[]" style="border-left:3.5px solid #df5b5b!important;" class="form-control" required></td></tr><tr><td>Phone </td><td><input type="text" name="contact_phone1[]" class="form-control " style="border-left:3.5px solid #df5b5b!important;"  required></td></tr></tbody></table></div><div class="col-md-6"> <table class="table"> <tbody><tr><td>Email </td><td><input type="text" name="contact_email1[]" style="border-left:3.5px solid #df5b5b!important;" class="form-control" required></td></tr><tr><td>Designation </td><td><input type="text" name="contact_designation1[]" class="form-control " style="border-left:3.5px solid #df5b5b!important;"  required></td></tr></tbody></table></div></div>');

  	});



    $(document).on('click', '.btn_remove', function () {

            var button_id = $(this).attr("id");

            $('#row' + button_id + '').remove();

            calc();

         });

		 



</script>





<?







require_once "../../../assets/template/layout.bottom.php";







?>





<?php if(isset($_GET['update'])){ ?>

    <script>

        $('.bd-example-modal-lg').modal('show');

    </script>

<?php } ?>





