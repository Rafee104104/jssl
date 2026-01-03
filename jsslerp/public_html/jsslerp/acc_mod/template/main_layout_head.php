<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!--<title><?=PAGE_TITLE?></title>-->
<title>ACCOUNTING MANAGEMENT  ERP</title>
<link href="../css/style.css" type="text/css" rel="stylesheet"/>
<link href="../css/menu.css" type="text/css" rel="stylesheet"/>
<link href="../css/table.css" type="text/css" rel="stylesheet"/>
<link href="../css/pagination.css" rel="stylesheet" type="text/css" />
<link href="../css/jquery-ui-1.8.2.custom.css" rel="stylesheet" type="text/css" />
<link href="../css/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
<meta name="Developer" content="Md. Mhafuzur Rahman Cell:01815-224424 email:mhafuz@yahoo.com" />
<script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.8.2.custom.min.js"></script>
<script type="text/javascript" src="../js/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="../js/jquery.autocomplete.js"></script>
<script type="text/javascript" src="../js/jquery.validate.js"></script>
<script type="text/javascript" src="../js/paging.js"></script>
<script type="text/javascript" src="https://mahirgrouperp.com/ddaccordion_new.js"></script>
<script type="text/javascript" src="../js/js.js"></script>
<?=$head?>
<? if($title=='Account Ledger') include('../support/accounts_ledger.php');?>
<? if($title=='Account Sub Ledger') include('../support/accounts_sub_ledger.php');?>
<? if($title=='Account Sub Sub Ledger') include('../support/account_sub_sub_ledger.php');?>
<? if($title=='Department Information') include('../support/payroll_dept_info.php');?>
<? if($title=='Employee Info') include('../support/payroll_employee_info.php');?>
<? if($title=='Monthly Salary Scale') include('../support/payroll_salary_scale.php');?>
</head>
<body>
<div class="wrapper" align="">
			<div class="header">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td>

<img src="../../logo/title.png" width="auto" height="72" border="0" />
</a>
</td>
				<td><div class="header2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="title"><div align="right">
									<?
if($_SESSION['user']['group']>1)
echo find_a_field('user_group','group_name',"id=".$_SESSION['user']['group']);
else
echo $_SESSION['proj_name'];
				?></div></td>
                  </tr>
                  <tr>
                    <td><div align="right">
                      <table border="0" cellspacing="0" cellpadding="0" style="width:450px">
                        <tr>
                          <td width="30">&nbsp;</td>
                          <td width="30">&nbsp;</td>
                          <td width="30">&nbsp;</td>
                          <td width="30">&nbsp;</td>
                          <td width="30">&nbsp;</td>
                          <td width="30">&nbsp;</td>
                          <td width="30">&nbsp;</td>
                          <td width="30">&nbsp;</td>
						  <td width="114">&nbsp;</td>
<? if(isset($_SESSION['company_name'])){?>
<td width="29" valign="top"><a href="../pages/logout.php"><img src="../images/icon3.jpg" width="22" height="24" /></a></td>
<td width="67"><a href="../pages/logout.php">LOGOUT</a></td>
<? }?>
                        </tr>
                      </table>
                    </div></td>
                  </tr>
                </table>
				</div></td>
			  </tr>
			</table>
			</div>