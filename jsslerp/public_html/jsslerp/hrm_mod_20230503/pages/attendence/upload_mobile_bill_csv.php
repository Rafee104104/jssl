<?php

require_once "../../../assets/template/layout.top.php";
$title="Upload Mobile Bill";

do_calander('#m_date');

$head='<link href="../../css/report_selection.css" type="text/css" rel="stylesheet"/>';

auto_complete_from_db('personnel_basic_info','concat(PBI_NAME,"-",PBI_ID)','PBI_ID','','PBI_ID');

$table='hrm_inout';

$unique='id';



if(isset($_POST["upload"]))
{

$filename=$_FILES["mobile_bill"]["tmp_name"];

	if($_FILES["mobile_bill"]["tmp_name"]!="")
	{
	echo '<span style="color: red;">Excel File Successfully Imported</span>';
	$file = fopen($filename, "r");
			while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
			{
			$s_sql="select * from hrm_moblie_bill where year=$emapData[0] and month=$emapData[1] and emp_id=$emapData[2]";
			$s_query=mysql_query($s_sql);
			$s_num_row=mysql_num_rows($s_query);
			
				if($s_num_row==0)
				{
				//mysql_query('delete from hrm_moblie_bill where year = "'.$emapData[0].'" and month = "'.$emapData[1].'" and emp_id ="'.$emapData[2].'" ');
$sql = "INSERT into hrm_moblie_bill (year, month, emp_id, mobile_no, mobile_bill, entry_by, entry_at) 
values('".$emapData[0]."','".$emapData[1]."','".$emapData[2]."','".$emapData[3]."','".$emapData[4]."','".$_SESSION['user']['id']."','".date('Y-m-d H:i:s')."')";
mysql_query($sql);
				}
				else
				{
$sql = 'update hrm_moblie_bill set  mobile_no = "'.$emapData[3].'",mobile_bill = "'.$emapData[4].'",edit_by = "'.$_SESSION['user']['id'].'",edit_at = "'.date('Y-m-d H:i:s').'"
where year = "'.$emapData[0].'" and month = "'.$emapData[1].'" and emp_id ="'.$emapData[2].'"';
mysql_query($sql);
				}
			}
			
	}
fclose($file);
 

} 

?>





<style type="text/css">

<!--

.style1 {font-size: 24px}
.style2 {
	color: #FF66CC;
	font-weight: bold;
}

-->

</style>







    <form  action=""  method="post" enctype="multipart/form-data">
        <div class="d-flex justify-content-center">

            <div class="n-form1 fo-white pt-0">
                <h4 class="text-center bg-titel bold pt-2 pb-2">  Upload Mobile Bill   </h4>

                <div class="container">
                    <div class="form-group row  m-0 mb-1 pl-3 pr-3">
                        <label for="group_for" class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Upload File :  </label>
                        <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0 pr-2">
                            <input name="mobile_bill"  type="file" id="mobile_bill"/>
                        </div>
                    </div>

                </div>

                <div class="n-form-btn-class">
                    <input name="upload" class="btn1 btn1-bg-submit" type="submit" id="upload" value="Upload File" />
                </div>

                <div class="alert alert-danger p-1 pl-2 pr-2 m-0" role="alert">
                    Note: File must be at CSV format. Example: mobile.csv
                </div>

                <div class="alert alert-warning p-1 m-0 pl-2 pr-2" role="alert">
                    And Filed example: 2017 | 4 | 1867 | 8801955530038 | 200
                </div>

            </div>

        </div>

    </form>








<?php/*>
<br>
<br>
<br>
<br>
<br>

<div class="oe_view_manager oe_view_manager_current">

        <form action=""  method="post" enctype="multipart/form-data">



        <div class="oe_view_manager_body">

            

                <div  class="oe_view_manager_view_list"></div>

            

                <div class="oe_view_manager_view_form">
                    <div style="opacity: 1;" class="oe_formview oe_view oe_form_editable">

        <div class="oe_form_buttons"></div>

        <div class="oe_form_sidebar"></div>

        <div class="oe_form_pager"></div>

        <div class="oe_form_container"><div class="oe_form">

          <div class="">

		     

<div class="oe_form_sheetbg">

        <div class="oe_form_sheet oe_form_sheet_width">



          <div  class="oe_view_manager_view_list"><div  class="oe_list oe_view">

            <table width="80%" border="1" align="center">

              <tr>

                <td height="40" colspan="4" bgcolor="#00FF00"><div align="center" class="style1">Upload Mobile Bill  </div></td>
                </tr>

              <tr>

                <td width="20%"><div align="right">Upload File : </div></td>

                <td><input name="mobile_bill"  type="file" id="mobile_bill"/></td>
                <td><input name="upload" class="btn1 btn1-bg-submit" type="submit" id="upload" value="Upload File" /></td>
                <td>&nbsp;</td>
              </tr>


              <tr>

                <td colspan="4"><label>

                    <div align="center">
                      <p>&nbsp;</p>
                      <p align="left" class="style2">Note: File must be at CSV format. Example: mobile.csv </p>
                      <p align="left" class="style2"> And Filed example: 2017 | 4 | 1867 | 8801955530038 | 200</p>
                    </div>

                    </label></td>
              </tr>
            </table>

            <br />
          </div>
          </div>

          </div>

    </div>

    <div class="oe_chatter"><div class="oe_followers oe_form_invisible">

      <div class="oe_follower_list"></div>

    </div></div></div></div></div>

    </div></div>

            

        </div>

 </form>   </div>

    <*/?>











<?

$main_content=ob_get_contents();

ob_end_clean();

include ("../../template/main_layout.php");

?>