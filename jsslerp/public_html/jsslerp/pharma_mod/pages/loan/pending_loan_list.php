<?php
require_once "../../../assets/template/layout.top.php";// ::::: Edit This Section ::::: 


$title='Loan Receive';			// Page Name and Page Title



$page="advance_payment.php";		// PHP File Name

$edit_page = "installment_receive.php";

$input_page="advance_payment.php";



$root='payroll';


$table='loan_info';		// Database Table Name Mainly related to this page



$unique='loan_no';			// Primary Key of this Database table



$shown='advance_amt';				// For a New or Edit Data a must have data field


do_datatable('grp');
// ::::: End Edit Section :::::



// ::::: End Edit Section :::::

$crud      =new crud($table);


$$unique = $_GET[$unique];




if(!isset($$unique)) $$unique=db_last_insert_id($table,$unique);


$$unique = $_GET[$unique];


?>



<script type="text/javascript"> function DoNav(lk){

  
   
	//document.location.href = '<?=$view_page?>?<?=$unique?>='+lk,'_blank';
    window.open("<?=$edit_page?>?<?=$unique?>="+lk);


	}

	


function install_amnt_auto_cal(){



var tot_amnt=document.getElementById('advance_amt').value;



var tot_istl=document.getElementById('total_installment').value;



var istl_amnt=tot_amnt/tot_istl;



document.getElementById('payable_amt').value = istl_amnt;


}



</script>

<div class="oe_view_manager oe_view_manager_current">



      <form action="" method="post" enctype="multipart/form-data">  



     <? //include('../../common/title_bar.php');?>



    </form>



    <form action="" method="post" enctype="multipart/form-data">



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


          <div  class="oe_view_manager_view_list"><div  class="oe_list oe_view">



          <? $res='select l.loan_no,p.PBI_NAME as Employee_name,t.type,l.loan_amt,l.loan_date,l.total_installment,l.status,u.fname as entry_by from loan_master l, personnel_basic_info p,loan_type t, user_activity_management u where l.PBI_ID=p.PBI_ID and t.id=l.type and u.user_id=l.entry_by and l.status="ISSUED"';



				echo link_report1($res,$link);?>



          </div></div>



          </div>



    </div>



    <div class="oe_chatter"><div class="oe_followers oe_form_invisible">



      <div class="oe_follower_list"></div>



    </div></div></div></div></div>



    </div></div>



            



        </div>



  </form>



</div>

<?


require_once "../../../assets/template/layout.bottom.php";


?>