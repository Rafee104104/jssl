<?php 

error_reporting(0);
?>
<!DOCTYPE html>

<html style="height: 100%">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title><?php echo $module_name; ?></title>
<meta name="Developer" content="Md. Mhafuzur Rahman Cell:01815-224424 email:mhafuz@yahoo.com" />


<link rel="stylesheet" type="text/css" href="../../../assets/css/acc_mod_index.css" media="all">
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" >
<?php
if($_GET['module_id']==1){  // Accounts Module
$bg_image='accounts.png';
}
else if($_GET['module_id']==9){  //Lc Module
$bg_image='lc.png';
}
else if($_GET['module_id']==5){ //Sales Module
$bg_image='sales.png';
}
else if($_GET['module_id']==7){  //Purchase Module/Supply Chain
$bg_image='purchase.png';
}
else if($_GET['module_id']==8){  //Production Module
$bg_image='production.png';
}
else if($_GET['module_id']==10){  // Damage Module
$bg_image='damage.png';
}
else if($_GET['module_id']==6){  //Mis Module
$bg_image='mis.png';
}
else if($_GET['module_id']==4){  //Warehouse Module
$bg_image='warehouse.png';
}
else if($_GET['module_id']==2){  //HRM Module
$bg_image='hrm.png';
}
else if($_GET['module_id']==14){  //HRM Module
$bg_image='crm.png';
}

else{
$bg_image='New_ERP.png';
}

 ?>
<style type="text/css">
::placeholder{
color:#1e5fa3!important;
}
.erpcombd a.button:link, .erpcombd a.button:visited, .erpcombd button, .erpcombd input[type=submit], .erpcombd .ui-dialog-buttonpane .ui-dialog-buttonset .ui-button{
background-image:none!important;
background-color:#1e5fa3!important;
font-weight:bold;
/*font-family:montserrat;*/
}
.erpcombd .oe_enterprise form button {
margin-left:23px;
border-radius: 8px 8px 8px 8px!important;
height:44px;
border:0px!important;
font-size:22px;
text-shadow:none!important;
}
.erpcombd .oe_enterprise form fieldset input{
border-radius: 8px 8px 8px 8px!important;
width:75%!important;
margin-left:24px;
margin-bottom:40px;
font-size:13px;
font-family:raleway;
background-color:#c3ddf3;
border:none!important;
box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

}
.oe_enterprise_login_input{
margin-bottom:40px!important;

}
erpcombd .oe_enterprise .oe_enterprise_pane {
margin-left:24px;
    /* height: 218px; */
    margin: 0 auto;
    position: relative;
    padding: 18px;
    top: 180px;
    width: 250px;
    background-color: #f5f5f5;
    background-image: -moz-linear-gradient(center top,white,rgb(227,227,227));
    border-radius: 10px 10px 10px 10px;
    box-shadow: 0 3px 16px rgba(12,0,49,.35);
    }
	

.oe_enterprise_content {
    background: url(../../../logo/<?php echo $bg_image;?>);
    background-repeat: no-repeat;
  	background-attachment: fixed;
  	background-position: center;
  	
    background-size: 100% 100%;
    height: 100%!important;
    width: 100%!important;
    margin: 0px auto;
    padding: 0px;
}
/* Media Queries: Tablet Landscape */
@media screen and (max-width: 1060px) {
    #primary { width:67%; }
    #secondary { width:30%; margin-left:3%;}  
}

/* Media Queries: Tabled Portrait */
@media screen and (max-width: 768px) {
    #primary { width:100%; }
    #secondary { width:100%; margin:0; border:none; }
}
</style>
</head>

<body>



<div class="erpcombd erpcombd_webclient_container">

    <div class="oe_enterprise oe_login_signup">

            

            <div class="oe_enterprise_content">


                <div class="oe_login_pane oe_enterprise_pane">

                    <form action="" method="post">

                        <div style="opacity: 0; display: none;" class="oe_enterprise_signin">

                            <h2> Sign In</h2>

                        </div>

                        <div style="opacity: 1; display: block;" class="oe_enterprise_signup">
<div style="text-align:center; margin-bottom:40px;"><img src="../../../logo/logo.png" width="50%" ></div>
                            
                        </div>

                        <div class="oe_login_error_message oe_enterprise_error_message"></div>



                        

                        <div style="display: none;" class="oe_login_dbpane">

                            <fieldset>

                                <label>Database</label>

                                

    <select name="db">

        

            

            

                <option value="erpcombd">erpcombd</option>

            

        

    </select>



                            </fieldset>

                      </div>

                      <fieldset>

                          <!--<label>Your Company ID</label>-->
 <input autofocus="autofocus" class="oe_enterprise_login_input" name="cid" value="" placeholder="Company ID" type="text" width="75%">

                      </fieldset>

                        <fieldset>

                          <!--<label>Your Username</label>-->

                          <input autofocus="autofocus" class="oe_enterprise_login_input" placeholder="User Name" name="uid" value="" type="text" width="75%">

                          <input autofocus="autofocus" class="oe_enterprise_login_input" name="ibssignin" value="" type="hidden" width="75%">

                        </fieldset>

                        <div style="opacity: 0; display: none;" class="oe_enterprise_signin">

                        <div style="display: block;" class="oe_enterprise_checker_message">An account with this email address already exists.</div>

                      </div>



                      <div style="opacity: 1; display: block;" class="oe_enterprise_signup"></div>

                        <fieldset>

                     <!--     <label>Your Password</label>-->

                          <input name="pass" value="" type="password" placeholder="Password" width="75%">

                          <!--<div style="opacity: 0; display: none;" class="oe_enterprise_signin"> <span class="contextual_message"> <a style="display: inline;" class="oe_signup_reset_password" href="#">Forgotten your password?</a> </span> </div>
-->
                        </fieldset>

                        <div style="opacity: 1; display: block;" class="oe_enterprise_signup">

                          <fieldset class="oe_enterprise_submit" style="margin-top:0px!important">                                 
<!--<span title="Home" style="height:20px; width:30px;"><a href="../../../home/index.php"><i class="fa fa-home fa-3x" ></i></a></span>-->
                            <button name="submit" style="width:270px;float:none;">Log in</button>

                          </fieldset>

                            <!--<div class="oe_enterprise_bottom signin"><p><a href="#">Forgot Password</a></p></div>
-->
                      </div>

                        

                    </form>

                </div>

            </div>

        </div>

<div class="oe_notification ui-notify"></div></div></body>

</html>

