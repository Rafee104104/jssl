<?php
require_once "../../../assets/template/layout.top.php";
$title='Cost Center';
$center_id=$_REQUEST['center_id'];
$proj_id=$_SESSION['proj_id'];
//echo $proj_id;
if(isset($_REQUEST['cost_center']) && !empty($_REQUEST['cost_center']))
{
	//common part.............
	$cost_center 	= mysql_real_escape_string($_REQUEST['cost_center']);
	$category_id 	= mysql_real_escape_string($_REQUEST['category_id']);

	if(isset($_POST['ncenter']))
	{
		$check="select id from cost_center where center_name='$cost_center'";
		//echo $check;
		if(mysql_num_rows(mysql_query($check))>0)
		{
				$type=0;
				$msg='Given Name('.$cost_center.') is already exists.';
		}
		else
		{
			$sql="INSERT INTO `cost_center` (
			`center_name`, `category_id`, `proj_id`)
			VALUES ('$cost_center', '$category_id', '$proj_id')";
			$query=mysql_query($sql);
		$type=1;
		$msg='New Entry Successfully Inserted.';
		}
	}
	
	//for Modify..................................
	
	if(isset($_POST['mcenter']))
	{
		$sql="UPDATE `cost_center` SET `center_name` = '$cost_center', category_id = '$category_id'
		 WHERE `id` = '$center_id' LIMIT 1";
		$qry=mysql_query($sql);
				$type=1;
		$msg='Successfully Updated.';
	}
		if(isset($_POST['dcenter']))
	{
		$sql="delete from cost_center
		 WHERE `id` = '$center_id' LIMIT 1";
		$qry=mysql_query($sql);
				$type=1;
		$msg='Successfully Deleted.';
	}
}
if(isset($_REQUEST['center_id']))
{
	$c_id=$_REQUEST['center_id'];
	$ddd="SELECT cen.id, cen.center_name, cat.category_name FROM cost_center cen, cost_category cat WHERE cen.category_id = cat.id AND cen.id='$c_id'";
	$data=mysql_fetch_row(mysql_query($ddd));
	//echo $ddd;
}?>
<script type="text/javascript">
function DoNav(theUrl)
{
	document.location.href = 'cost_center.php?center_id='+theUrl;
}
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>    <td width="66%" style="padding-right:5%">
	<div class="left">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td>
									<table id="" class="table table-bordered" cellspacing="0">
							  <tr>
								<th>ID</th>
								<th>Cost Center</th>
								<th>Category</th>
							  </tr>
<?php
	$rrr = "SELECT 
					  cen.id,
					  cen.center_name,
					  cat.category_name
					FROM
					  cost_center cen,
					  cost_category cat
					WHERE
					  cen.category_id = cat.id";
	

	$report = mysql_query($rrr);
	$i=0;
	while($rp=mysql_fetch_row($report)){$i++; if($i%2==0)$cls=' class="alt"'; else $cls='';?>
							   <tr<?=$cls?> onclick="DoNav('<?php echo $rp[0];?>');">
								<td><?=$rp[0];?></td>
								<td><?=$rp[1];?></td>
								<td><?=$rp[2];?></td>
							  </tr>
	<?php }?>
							</table>									</td>
								  </tr>
								</table>

							</div></td>
    <td valign="top"><div class="center"><form id="form2" name="form2" method="post" action="cost_center.php?center_id=<?php echo $center_id;?>">
							  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td><div class="box">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td>Cost Center  :</td>
                                        <td><input name="cost_center" type="text" id="cost_center" value="<?php echo $data[1];?>"/ class="form-control"></td>
									  </tr>

                                      <tr>
                                        <td>Category :</td>
                                        <td><select name="category_id" class="form-control">
                                          <?php
				$cat_listQ = mysql_query('SELECT id, category_name FROM cost_category');
				while($cat_list = mysql_fetch_row($cat_listQ)){
					$selected = ($cat_list[1]==$data[2])?'selected':'';
					echo '<option value="'.$cat_list[0].'" '.$selected.'>'.$cat_list[1].'</option>';
				}
				?>
                                        </select></td>
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
                                      <td><input name="ncenter" type="submit" id="ncenter" value="Record" onclick="return checkUserName()" class="btn btn-primary" /></td>
                                      <td><input name="mcenter" type="submit" id="mcenter" value="Modify" class="btn btn-secondary " /></td>
                                      <td><input name="Button" type="button" class="btn  btn-success" value="Clear" onClick="parent.location='cost_center.php'"/></td>
                                      <td><input class="btn btn-danger" name="dcenter" type="submit" id="dcenter" value="Delete"/></td>
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
require_once "../../../assets/template/layout.bottom.php";
?>