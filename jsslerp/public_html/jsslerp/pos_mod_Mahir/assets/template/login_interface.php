<? $cid = explode('.', $_SERVER['HTTP_HOST'])[0];?>
<!DOCTYPE html>

<html style="height: 100%">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title><?php echo $module_name; ?></title>
<link rel="icon" type="image/x-icon" href="../../../assets/images/login/erp_favicon-32x32.png"> 
<meta name="Developer" content="Md. Mhafuzur Rahman Cell:01815-224424 email:mhafuz@yahoo.com" />


<link rel="stylesheet" type="text/css" href="../../../assets/css/acc_mod_index.css" media="all">
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" >
<?
 $cloud_bg_logo = "../../../logo/bg_image/New_ERP.png";
 $project_bg_logo = "../../../logo/bg_image/".$cid.".png";
								
	if(is_file($project_bg_logo)) {
		$bg_image = $project_bg_logo;
	} else {
		$bg_image = $cloud_bg_logo;
	}
								
?>
<style type="text/css">
    /*@import url('https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;1,200;1,300;1,400&display=swap');*/
    @import url('https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap');
    ::placeholder{
color:#1e5fa3!important;
}
    body{
        font-family: 'Roboto', sans-serif !important;
        /*height:100vh;*/
        color: #3a3e42 !important;
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
/*border-radius: 8px 8px 8px 8px!important;*/
/*width:75%!important;*/
/*margin-left:24px;*/
margin-bottom:15px !important;
/*font-size:13px;*/
    /*font-family: 'Titillium Web', sans-serif;*/
/*font-family:raleway;*/
    font-size: 15px;
    /*font-weight: bold;*/
    text-shadow: none !important;
/*background-color:#c3ddf3;*/
/*border:none!important;*/
/*box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.19);*/
}

.erpcombd .oe_enterprise form fieldset label{
    margin-top:0px !important;
    margin-bottom:0px !important;
}


.oe_enterprise_login_input{
margin-bottom:40px!important;

}
.erpcombd .oe_enterprise .oe_enterprise_pane {
margin-left:24px;
    /* height: 218px; */
    margin: 0 auto;
    position: relative;
    padding: 18px;
    /*top: 180px;*/
    top: 17%;
    /*width: 250px;*/
    /*background-color: #f5f5f5;*/
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


    /*smart input fild start css*/


.custom-field {
    position: relative;
    font-size: 14px;
    /*border-top: 20px solid transparent;*/
    margin-bottom: 5px;
    display: inline-block;
    --field-padding: 12px;
}

.custom-field input {
    border: none;
    -webkit-appearance: none;
    -ms-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background: #f2f2f2;
    padding: var(--field-padding);
    border-radius: 3px;
    width: 250px;
    outline: none;
    font-size: 14px;
}

.custom-field .placeholder {
    position: absolute;
    left: var(--field-padding);
    width: calc(100% - (var(--field-padding) * 2));
    overflow: hidden;
    font-size: 15px;
    font-weight: 400;
    white-space: nowrap;
    text-overflow: ellipsis;
    top: 22px;
    transform: translateY(-50%);
    color: #aaa;
    /*color: #8d929b;*/
    transition:
    top 0.3s ease,
    color 0.3s ease,
    font-size 0.3s ease;

}

.custom-field input.dirty + .placeholder,
.custom-field input:focus + .placeholder,
.custom-field input:not(:placeholder-shown) + .placeholder {
    top: -10px;
    font-size: 10px;
    color: #222;
}

.custom-field .error-message {
    width: 100%;
    display: flex;
    align-items: center;
    padding: 0 8px;
    font-size: 12px;
    background: #d30909;
    color: #fff;
    height: 24px;
}

.custom-field .error-message:empty {
    opacity: 0;
}

/* ONE */
.custom-field.one input {
    background: none;
    border: 2px solid #ddd;
    transition: border-color 0.3s ease;
}

.custom-field.one input + .placeholder {
    left: 8px;
    padding: 0 5px;
}

.custom-field.one input.dirty,
.custom-field.one input:not(:placeholder-shown),
.custom-field.one input:focus {
    border-color: #222;
    transition-delay: 0.1s
}

.custom-field.one input.dirty + .placeholder,
.custom-field.one input:not(:placeholder-shown) + .placeholder,
.custom-field.one input:focus + .placeholder {
    top: 0;
    font-size: 12px;
    color: #222;
    background: #fff;
    width: auto
}


/*smart input fild End css*/

</style>
</head>

<body>



<div class="erpcombd erpcombd_webclient_container">

    <div class="oe_enterprise oe_login_signup">

            

            <div class="oe_enterprise_content">


                <div class="oe_login_pane oe_enterprise_pane">

                    <form action="" method="post" style="margin-right:20px; margin-left: 20px;">

                        <div style="opacity: 0; display: none;" class="oe_enterprise_signin">

                            <h2> Sign In</h2>

                        </div>

                        <div style="opacity: 1; display: block;" class="oe_enterprise_signup">
                            <div style="text-align:center;  margin-bottom: 12px;">
                                <?
                                $cloud_logo = "../../../logo/clouderplogo.png";
                                $project_logo = "../../../logo/".$cid.".png";
if(is_file($project_logo)) {
$show_logo = $project_logo;
} else {
$show_logo = $cloud_logo;
}
                                ?>
<!--                                <img src="--><?//=$show_logo?><!--" width="200px" height="60px">-->
                                <img src="<?=$show_logo?>" width="200px" >
                                </div>
                            
                        </div>




                        <div class="oe_login_error_message oe_enterprise_error_message"></div>



                        



                        <fieldset>

                          <!--<label>Your Username</label>-->

                            <label class="custom-field one">
                                 <input class="oe_enterprise_login_input" name="cid" value="<?=$cid?>"  type="hidden"  placeholder=" "/>
                                <input autofocus="autofocus" class="oe_enterprise_login_input" name="uid"  value=""  type="text" placeholder=" " required/>
                                <span class="placeholder">User Name</span>
                            </label>

<!--                          <input autofocus="autofocus" class="oe_enterprise_login_input" placeholder="User Name" name="uid" value="" type="text" width="75%">-->
                          <input autofocus="autofocus" class="oe_enterprise_login_input" name="ibssignin" value="" type="hidden" width="75%">

                        </fieldset>

                        <div style="opacity: 0; display: none;" class="oe_enterprise_signin">

                        <div style="display: block;" class="oe_enterprise_checker_message">An account with this email address already exists.</div>

                      </div>



                      <div style="opacity: 1; display: block;" class="oe_enterprise_signup"></div>

                        <fieldset>
                            <label class="custom-field one">
                                <input  name="pass" value="" type="password" placeholder=" " required/>
                                <span class="placeholder">Password</span>
                            </label>


                            <!--     <label>Your Password</label>-->
<!--                          <input name="pass" value="" type="password" placeholder="Password" width="75%">-->

                          <!--<div style="opacity: 0; display: none;" class="oe_enterprise_signin"> <span class="contextual_message"> <a style="display: inline;" class="oe_signup_reset_password" href="#">Forgotten your password?</a> </span> </div>
-->
                        </fieldset>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminate">
                            <label class="form-check-label" for="flexCheckIndeterminate">
                                Remember me
                            </label>
                        </div>


                        <div style="opacity: 1; display: block; margin-top: 15px;" class="oe_enterprise_signup">


                          <fieldset class="oe_enterprise_submit" style="margin-top:0px!important;">
<!--<span title="Home" style="height:20px; width:30px;"><a href="../../../home/index.php"><i class="fa fa-home fa-3x" ></i></a></span>-->
                            <button name="submit" style="width: 100%; margin-left: 0px; float:none;">Log in</button>

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

