<div class="sidebar "><nav class="navbar navbar-expand-lg navbar-light bg-light navbar-fixed-top" >

<div class="button-bar ml-0"> <button type="button" id="collapse_sidebar" style="text-align:center" onclick="collapse_sidebar()"><i class="fa fa-caret-left fa-1x" style="line-height:2;"></i></button>

<button type="button" id="extract_sidebar" style="text-align:center;display:none" onclick="extract_sidebar()"><i class="fa fa-caret-right fa-2x"></i></button></div>

    <div class="container-fluid">



      <div class="navbar-header">

          <!--<a class="navbar-brand" href="#"><?php $_SESSION; echo $_SESSION['company_name']; ?></a></div>-->

		            <a class="navbar-brand" href="#" style="font-weight:bold;"><?php echo find_a_field('project_info','company_name','1'); ?></a></div>





      <!--<div class="collapse navbar-collapse" id="navbarNav">



    <ul class="navbar-nav">



      <li class="nav-item active">

 

        <a class="nav-link" href="../../../../sales_mod/pages/main/home.php">Home <span class="sr-only">(current)</span></a>



      </li>



      



     



    </ul>



  </div>-->



  <div class="clear"></div>

  

  

    <!-- Navbar This for side menu dont delete this -->

            <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">

              <div class="container-fluid">

                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation"> <span class="sr-only">Toggle navigation</span> <span class="navbar-toggler-icon icon-bar"></span> <span class="navbar-toggler-icon icon-bar"></span> <span class="navbar-toggler-icon icon-bar"></span> </button>

              </div>

            </nav>

            <!-- End Navbar -->

			

			



  <div class="userblock" style="right:248px!important;">



      <div id="avatar-upload" class="right circle">



        <div class="image-overlay dz-message"></div>



        <img src="../../../images/user/<?=$_SESSION['user']['id'];?>.jpg" class="userimg" alt=""/>
		
	<!--	<img src="upload_view.php?name=<?=$row->PBI_PICTURE_ATT_PATH?>&folder=hrm_emp_pic" width="120" height="152" />-->

       <!--- <img src="../../../user_pic/user.png" class="userimg" alt=""/> --> 

       </div>







        <div id="user-settings-overlay" class="userdetail right vertical-centre">



            <div class="username">



                <?

				$user_info = find_all_field('user_activity_management','fname','user_id='.$_SESSION['user']['id']);

				echo $user_info->fname;

				?>            </div>



            <div class="company_name">



                <?=$user_info->designation;?></div>







        </div>



    </div>

   

		





	



  



		<div class="clear"></div>



		



		<div class="notificationblock" style="right:163px!important;">



        



       <!-- <a href="#" class="help_tooltip" data-toggle="tooltip" data-placement="bottom" data-original-title="Settings"><i class="fa fa-cogs"></i></a>







        <a href="#" class="help_tooltip" data-toggle="tooltip" data-placement="bottom" data-original-title="Notifications"><span class="badge animated zoomIn"></span><i class="fa fa-bell"></i></a>

-->





        <a href="../../pages/files/index.php" class="help_tooltip" data-toggle="tooltip" data-placement="bottom" data-original-title="Signout"><i class="fas fa-sign-out-alt"></i></a>

		



    </div>

	

<div id="clock" style="right:12px!important;">

<span class="date">{{ date }}</span>

<span class="time">{{ time }}</span>

<span class="text">IP: <?=$_SERVER['REMOTE_ADDR']?></span>

</div>





	<!--<div class="helpblock">



        <div class="help-switch pointer vertical-centre">



            <div class="on"><p>Help</p></div>



        </div>



    </div>-->



		



	    </div>



		  </nav>

</div>