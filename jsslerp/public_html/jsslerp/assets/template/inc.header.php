

<?php
$cid = explode('.', $_SERVER['HTTP_HOST'])[0];
$sql = "SELECT * FROM config_template WHERE status=1";
$template = mysql_query($sql);
$temp = mysql_fetch_object($template);

if($temp->template_id==1){?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-1 navbar-fixed-top" style="height: 60px !important;" >
        <div class="button-bar ml-0"> <button type="button" id="collapse_sidebar" style="text-align:center" onclick="collapse_sidebar()"><i class="fa fa-caret-left fa-1x" style="line-height:2;"></i></button>
            <button type="button" id="extract_sidebar" style="text-align:center;display:none" onclick="extract_sidebar()"><i class="fa fa-caret-right fa-2x"></i></button></div>
        <div class="container-fluid">

            <div class="navbar-header">
                <!--<a class="navbar-brand" href="#"><?php var_dump($_SESSION); echo $_SESSION['company_name']; ?></a></div>-->
                <span style="font-weight:bold;"><?=find_a_field('user_group','group_name','id='.$_SESSION['user']['group']);//echo $_SESSION['company_name']; ?></span>

                <p class="company_name m-0">
                    <?=find_a_field('warehouse','warehouse_name','warehouse_id='.$_SESSION['user']['depot']);?>



                </p>

            </div>



            <!--<div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="../../../../sales_mod/pages/main/home.php">Home <span class="sr-only">(current)</span></a>
            </li>
          </ul>
        </div>-->

            <div class="clear"></div>

            <div class="userblock" style="right:248px!important;">

                <div id="avatar-upload" class="right circle">

                    <div class="image-overlay dz-message"></div>

           	
					       <? 
						     $find = find_a_field('user_activity_management','user_pic','user_id="'.$_SESSION['user']['id'].'"');
							 
							 if($find!=""){ ?>
							<img src="../../../assets/support/upload_view.php?name=<?=$find?>&folder=user_pic&folder=user_pic&proj_id=<?=$cid?>&mod=mis_mod" class="userimg" />
							
					        <? }else{ ?>
                           <img src="../../../user_pic/user.png" class="userimg" alt=""/>
                            <? } ?>
                </div>



                <div id="user-settings-overlay" class="userdetail right vertical-centre">

                    <div class="username">

                        <?
                        $user_info = find_all_field('user_activity_management','fname','user_id='.$_SESSION['user']['id']);
                        echo $user_info->fname;
                        ?>            </div>

                    <div class="company_name">
                        <?=$user_info->designation;?>
                    </div>
                    <div class="company_name">
                        <?//=find_a_field('warehouse','warehouse_name','warehouse_id='.$_SESSION['user']['depot']);?>
                    </div>


                </div>

            </div>








            <div class="clear"></div>



            <div class="notificationblock" style="right:163px!important;">

                <a href="../../../login/pages/main/logout.php" class="help_tooltip" data-toggle="tooltip" data-placement="bottom" data-original-title="Signout"><i class="fas fa-sign-out-alt"></i></a>
            </div>

            <div id="clock" style="right:12px!important; width: 145px;">
                <span class="date" style="overflow: hidden!important;">{{ date }}</span>
                <span class="time" style="overflow: hidden!important;">{{ time }}</span>
                <span class="text" style="overflow: hidden!important;">IP: <?=$_SERVER['REMOTE_ADDR']?></span>
            </div>


            <!--<div class="helpblock">
                <div class="help-switch pointer vertical-centre">
                    <div class="on"><p>Help</p></div>
                </div>
            </div>-->



        </div>

    </nav>


    <?php
}


elseif($temp->template_id==2){?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light m-0 pl-0 navbar-fixed-top" style="height: 60px !important;" >
        <div class="button-bar ml-0"> <button type="button" id="collapse_sidebar" style="text-align:center" onclick="collapse_sidebar()"><i class="fa fa-caret-left fa-1x" style="line-height:2;"></i></button>
            <button type="button" id="extract_sidebar" style="text-align:center;display:none" onclick="extract_sidebar()"><i class="fa fa-caret-right fa-2x"></i></button></div>

        <div class="sidemenu ml-0">
			<i class="open fa-duotone fa-circle-chevron-left"></i>
			<i class=" close1 fa-solid fa-circle-chevron-right"></i>
           
       
        </div>

        <div class="container-fluid">
            <div class="navbar-header" style=" margin-left: 30px;">

                <!--<a class="navbar-brand" href="#"><?php var_dump($_SESSION); echo $_SESSION['company_name']; ?></a></div>-->
                <span  class="theme_color" style="font-weight:bold;"><?=find_a_field('user_group','group_name','id='.$_SESSION['user']['group']);//echo $_SESSION['company_name']; ?></span>

                <p class="company_name theme_color m-0">
                    <?=find_a_field('warehouse','warehouse_name','warehouse_id='.$_SESSION['user']['depot']);?>
                </p>
            </div>


            <div class="clear"></div>
            <div class="userblock" style="right:300px">
                <div id="avatar-upload" class="right circle">
                    <div class="image-overlay dz-message"></div>
					
	
					
					       <? 
						     $find = find_a_field('user_activity_management','user_pic','user_id="'.$_SESSION['user']['id'].'"');
							 
							 if($find!=""){ ?>
                        
							<img src="../../../assets/support/upload_view.php?name=<?=$find?>&folder=user_pic&folder=user_pic&proj_id=<?=$cid?>&mod=mis_mod" class="userimg" />
							
					        <? }else{ ?>
                           <img src="../../../user_pic/user.png" class="userimg" alt=""/>
                            <? } ?>
							
							
					
                </div>

                <div id="user-settings-overlay" class="userdetail right vertical-centre theme_color">

                    <p class="username m-0 p-0" style="font-size: 14px;">

                        <?
                        $user_info = find_all_field('user_activity_management','fname','user_id='.$_SESSION['user']['id']);
                        echo $user_info->fname;
                        ?>            </p>

                    <p class="company_name m-0 p-0" align="left">
                        <?=$user_info->designation;?>
                    </p>
                </div>
            </div>





            <div class="clear"></div>
            <div class="notificationblock" >
                <a href="#" class="bell-massage" data-toggle="tooltip" data-placement="bottom" data-original-title="Notifications">
                    <span class="badge animated zoomIn"></span>
                    <i class="fas fa-bell"></i>
                </a>

                <a href="#" class="bell-massage" data-toggle="tooltip" data-placement="bottom" data-original-title="massage">
                    <span class="badge animated zoomIn"></span>
                    <i class="fas fa-envelope"></i>
                    <!-- <span class="badge badge-pill badge-danger">0</span>-->
                </a>

                <a href="../../../login/pages/main/logout.php" class="sing-out" data-toggle="tooltip" data-placement="bottom" data-original-title="Signout">
                    <i class="fas fa-sign-out-alt"></i>
					
					<!--<i class="fas fa-power-off"></i>-->
                </a>


            </div>




            <div id="clock" align="center">
                <span class="date">{{ date }}</span>

                <span class="time">{{ time }}</span>

                <span class="text">IP: <?=$_SERVER['REMOTE_ADDR']?></span>
            </div>



        </div>
    </nav>

    <!--Side Menu hide and open js start-->
    <script>
        let menuToggle = document.querySelector('.sidemenu');
        let sidebar = document.querySelector('.sidebar');
        let main_content = document.querySelector('.main_content');
        let left1 = document.querySelector('.left1');
        menuToggle.onclick = function(){
            menuToggle.classList.toggle('active');
            sidebar.classList.toggle('active');
            main_content.classList.toggle('active');
            left1.classList.toggle('active');
        }
    </script>



    <?php
}

else{

    echo "No records matching.";
}
?>


