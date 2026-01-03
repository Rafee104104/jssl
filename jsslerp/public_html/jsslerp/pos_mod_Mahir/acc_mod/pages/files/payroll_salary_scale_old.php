<?php
require_once "../../../assets/template/layout.top.php";
$title='Salary Scale';
$page_url="payroll_salary_scale.php";
$proj_id=$_SESSION['proj_id'];
//echo $proj_id;
if(isset($_REQUEST['basicamt']) || isset($_REQUEST['emp_id']))
{
$emp_id=$_REQUEST['emp_id'];
//common part.............

$basicamt=$_POST['basicamt'];
$homernt=$_POST['homernt'];
$convence=$_POST['convence'];
$phone=$_POST['phone'];
$medical=$_POST['medical'];
$inctax=$_POST['inctax'];
$provident=$_POST['provident'];


	if(isset($_POST['ncenter']))
	{
		$check="select a.sub_ledger_id from sub_ledger a,emp_salary_scale b where b.emp_id=a.sub_ledger_id and a.sub_ledger_id='$emp_id'";
		//echo $check;
		if(mysql_num_rows(mysql_query($check))>0)
		{
				$type=0;
				$msg='Given Employee\'s Salary Scale is already assigned.';
		}
		else
		{
$sql="INSERT INTO emp_salary_scale (emp_id, basic_amt,home_rent,convence_bill,phone_bill,medical_allowance,income_tax,pf_amt)
VALUES ($emp_id, $basicamt, $homernt, $convence, $phone, $medical, $inctax, $provident)";
			$query=mysql_query($sql);
		$type=1;
		$msg='New Entry Successfully Inserted.';
		}
	}
	
	//for Modify..................................
	
	if(isset($_POST['mcenter']))
	{
$usql="UPDATE emp_salary_scale SET basic_amt= '$basicamt', home_rent= '$homernt', convence_bill= '$convence',phone_bill= '$phone', medical_allowance= '$medical', income_tax='$inctax', pf_amt='$provident'  WHERE emp_id = '$emp_id' LIMIT 1";
		$qry=mysql_query($sql);
				$type=1;
		$msg='Successfully Updated.';
	}
		if(isset($_POST['dcenter']))
	{
		$sql="delete from emp_salary_scale
		 WHERE emp_id = '$emp_id' LIMIT 1";
		$qry=mysql_query($sql);
				$type=1;
		$msg='Successfully Deleted.';
	}
}
if(isset($_REQUEST['emp_id']))
{
$c_id=$_REQUEST['emp_id'];
$ddd="select * from emp_salary_scale where emp_id='$c_id'";
$data=mysql_fetch_row(mysql_query($ddd));
}?>
<script type="text/javascript">
function DoNav(theUrl)
{
	document.location.href = 'salary_scale.php?emp_id='+theUrl;
}
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>    <td width="66%" style="padding-right:5%">
	<div class="left">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td>
									<table id="grp" class="tabledesign" cellspacing="0">
							  <tr>
								<th>Emp ID</th>
								<th>Emp Name</th>
								<th>Max Salary</th>
							  </tr>
<?php

	$rrr = "SELECT 
					  a.emp_id,
					  a.emp_name,
					  (b.basic_amt +b.home_rent +b.convence_bill +b.phone_bill +b.medical_allowance +b.income_tax +b.pf_amt) as max_sal,a.sub_ledger_id
					FROM
					  employee_info a,
					  emp_salary_scale b
					WHERE
					  a.id = b.emp_id";
	

	$report = mysql_query($rrr);
	$i=0;
	while($rp=mysql_fetch_row($report)){$i++; if($i%2==0)$cls=' class="alt"'; else $cls='';?>
							   <tr<?=$cls?> onclick="DoNav('<?php echo $rp[3];?>');">
								<td><?=$rp[0];?></td>
								<td><?=$rp[1];?></td>
								<td><?=$rp[2];?></td>
							  </tr>
	<?php }?>
							</table>									</td>
								  </tr>
								</table>
							</div></td>
    <td><div class="right"><form id="form2" name="form2" method="post" action="<?=$page_url?>?emp_id=<?php echo $center_id;?>">
							  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td><div class="box">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td>Employee Name: </td>
                                        <td bordercolor="#666666"><label>
                                          <select name="emp_id" id="emp_id">
                                            <?php 
		    
			$chk_emp_id = mysql_query("select emp_id from emp_salary_scale where emp_id=$emp_id");
			$selected_dept = mysql_result($chk_emp_id,0,'emp_id');
			$dept=mysql_query("select sub_ledger_id,emp_name,emp_id from employee_info");
	        while($deptv=mysql_fetch_row($dept))
	        { 
			?>
                                            <option value="<?php echo $deptv[0]; ?>" <?php if($deptv[0] == $selected_dept){ ?>selected="selected"<?php } ?>><?php echo $deptv[1]."-".$deptv[2]; ?> </option>
                                            <?php }  ?>
                                          </select>
                                        </label></td>
                                      </tr>

                                      <tr>
                                        <td>Basic Amount:</td>
                                        <td width="225" bordercolor="#666666"><input name="basicamt" type="text" id="basicamt" value="<?php echo $data[1];?>" size="30" maxlength="100" /></td>
                                      </tr>
                                      <tr>
                                        <td>Home Rent: </td>
                                        <td width="225" bordercolor="#666666"><input name="homernt" type="text" id="homernt" value="<?php echo $data[2];?>" size="30" maxlength="100" /></td>
                                      </tr>
                                      <tr>
                                        <td>Convence:</td>
                                        <td width="225" bordercolor="#666666"><input name="convence" type="text" id="convence" value="<?php echo $data[3];?>" size="30" maxlength="100" /></td>
                                      </tr>
                                      <tr>
                                        <td>Phone:</td>
                                        <td width="225" bordercolor="#666666"><input name="phone" type="text" id="phone" value="<?php echo $data[4];?>" size="30" maxlength="100" /></td>
                                      </tr>
                                      <tr>
                                        <td>Medi. Allowance:</td>
                                        <td width="225" bordercolor="#666666"><input name="medical" type="text" id="medical" value="<?php echo $data[5];?>" size="30" maxlength="100" /></td>
                                      </tr>
                                      <tr>
                                        <td>Income Tax:</td>
                                        <td width="225" bordercolor="#666666"><input name="inctax" type="text" id="inctax" value="<?php echo $data[6];?>" size="30" maxlength="100" /></td>
                                      </tr>
                                      <tr>
                                        <td>Provident Fund: </td>
                                        <td width="225" bordercolor="#666666"><input name="provident" type="text" id="provident" value="<?php echo $data[7];?>" size="30" maxlength="100" /></td>
                                      </tr>
                                    </table>
                                  </div></td>
                                </tr>
                                
                                
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>
								  <div class="box1">
								  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td><input name="ncenter" type="submit" id="ncenter" value="Record" onclick="return checkUserName()" class="btn" /></td>
                                      <td><input name="mcenter" type="submit" id="mcenter" value="Modify" class="btn" /></td>
                                      <td><input name="Button" type="button" class="btn" value="Clear" onClick="parent.location='salary_scale.php'"/></td>
                                      <td><? if($_SESSION['user']['level']==5){?><input class="btn" name="dcenter" type="submit" id="dcenter" value="Delete"/><? }?></td>
                                    </tr>
                                  </table>
								  </div>								  </td>
                                </tr>
                              </table>
    </form>
							</div></td>
  </tr>
</table>12
<script type="text/javascript">
	document.onkeypress=function(e){
	var e=window.event || e
	var keyunicode=e.charCode || e.keyCode
	if (keyunicode==13)
	{
		return false;
	}
}
</script>
<?
$main_content=ob_get_contents();
ob_end_clean();
require_once "../../template/main_layout.php";
?>