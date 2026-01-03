<?php
require_once "../../../assets/template/layout.top.php";
$title='Monthly Notice Board';
$proj_id=$_SESSION['proj_id'];
$now=time();
?>
<link rel="stylesheet" type="text/css" href="../css/dash_board.css"/>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>      <div class="dashboard">
        <!-- Dashboard icons -->
        <div class="grid_7">
          <a href="../pages/project_info.php?proj_id=<?=$_SESSION['proj_id']?>" class="dashboard-module"><img src="../dash_images/1.gif" width="40" height="40" /><span>Project Info </span></a>
          
          <a href="../pages/ledger_group.php" class="dashboard-module"><img src="../dash_images/1.gif" width="40" height="40" /><span>Ledger Group </span></a>
          
          <a href="../pages/account_ledger.php" class="dashboard-module"><img src="../dash_images/1.gif" width="40" height="40" /><span>A/C Ledger </span></a>
          
          <a href="../pages/account_sub_ledger.php" class="dashboard-module"><img src="../dash_images/1.gif" width="40" height="40" /><span>Sub Ledger </span></a>
          
          <a href="../pages/cost_category.php" class="dashboard-module"><img src="../dash_images/1.gif" width="40" height="40" /><span>Cost Category </span></a>
          
          <a href="../pages/cost_center.php" class="dashboard-module"><img src="../dash_images/1.gif" width="40" height="40" /><span>Cost Center </span></a>
          
          <a href="../pages/user_manage.php?user_id=<?=$_SESSION['user_id']?>" class="dashboard-module"><img src="../dash_images/1.gif" width="40" height="40" /><span>User Manage </span></a>
          <div style="clear: both"></div>
  </div> <!-- End .grid_7 -->
      </div></td></tr>
</table>
<?
$main_content=ob_get_contents();
ob_end_clean();
require_once "../../template/main_layout.php";
?>
