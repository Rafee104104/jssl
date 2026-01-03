

<?



$mod_id = 17;

$mod_name = 'User Portal';

$user_level =  $_SESSION['user']['level'];

$user_id    =  $_SESSION['user']['id'];



load_menu($mod_id,$mod_name,$user_id);

?>














<?php /*?><?php



//$master_user = find_a_field('user_activity_management', 'master_user', '1');



?>







<h1 id="title_text" style="background: #0270b9; width: 100%; color: white; text-align:center; font-size:18px; margin:0px; margin-bottom:1px; padding: 10px 0px;">User Module</h1>









<div class="menu_bg">









<div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> <span> User Panel</span></a></div>







    <ul class="submenu">



        <li>   <a href="../leave/change_password.php"><span> Change Password</span></a></li>



    </ul>



    <div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> My Profile</a></div>







    <ul class="submenu">

	

        <li>  <a href="../profile/update_profile.php"><span> Update Profile</span></a></li>



</ul>



    



    <div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> <span> Leave Management</a></div>







    <ul class="submenu">







        <li>  <a href="../inventory/home.php"> <span> Leave Status</span></a></li>

		 <li>  <a href="../leave/leave_request_input.php"> <span> Application for Leave</span></a></li>

		  <li>  <a href="../leave/half_leave_request_input.php"> <span> Application For Short Leave (SHL)</span></a></li>

		   <li>  <a href="../leave/view_leave.php"> <span> Leave Approval Status</span></a></li>

		    <li>  <a href="../leave/view_leave_half.php"> <span> Short Leave Approval (SHL) Status</span></a></li>

			 <li>  <a href="../leave/leave_report_for_dept_head.php"> <span> Leave Status of Dept. Employees</span></a></li>



    </ul>







    



 <div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> <span> All Approval</a></div>







    <ul class="submenu">

	





        <li>  <a href="../leave/view_leave_incharge.php"><span> Leave</span></a></li>



		  <li>   <a href="../leave/view_leave_incharge_half.php"><span>Short Leave (SHL)</span></a></li>

      

</ul>



 <div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> <span> All Report</a></div>







    <ul class="submenu">

	

        <li>  <a href="../od_report/leaveOd_report.php"><span> Report</span></a></li>



</ul>



 <div class="silverheader"><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i> Daily Task</a></div>







    <ul class="submenu">

	

        <li>  <a href="../daily_task/add_task.php"><span> Assign Task</span></a></li>



</ul>





       



    

	

    <div class="silverheader"><a href="#" ><i class="fas fa-sign-in-alt"></i> <span> Exit Program</a></div>







    <ul class="submenu">



        <li>



            <a href="../home/index.php"><span> Log Out</span></a></li>

    </ul>







</div>











<div class="copyright" style="text-align:center">



   <img class="oe_logo_img" src="../../../logo/logo.png" height="40px;" >



</div>























<?php */?>