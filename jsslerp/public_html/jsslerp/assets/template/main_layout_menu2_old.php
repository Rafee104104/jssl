<?

$mod_id = $_SESSION['mod'];
$mod_name = find_a_field('user_module_manage','module_name','id='.$_SESSION['mod']);
$user_level =  $_SESSION['user']['level'];
$user_id    =  $_SESSION['user']['id'];

//load_menu($mod_id,$mod_name,$user_id);

function load_menu2($mod_id,$mod_name,$user_id){
    ?>
    
                    <style type="text/css">
                        .page_title{
                            border: solid .1rem #dfdfdf;
                            border-radius: 5px;
                            margin-bottom: 10px;
                            background: transparent;
                            border: none;
                            float: left;
                            top: 3px;
                            margin-bottom: 15px;
                        }

                        .breadcrumb {
                            background-color: transparent;
                            border: none;
                            padding: 9px 13px;
                            margin-bottom: 0px;
                            padding-left: 0;
                            padding-bottom: 0;
                        }

                        .ol {
                            list-style-position: outside;
                            padding-left: 22px;
                        }


                        ol, ul {
                            margin-top: 0;
                            margin-bottom: 10px;
                        }


                        * {
                            -webkit-box-sizing: border-box;
                            -moz-box-sizing: border-box;
                            box-sizing: border-box;
                        }

                        ol {
                            display: block;
                            list-style-type: decimal;
                            margin-block-start: 1em;
                            margin-block-end: 1em;
                            margin-inline-start: 0px;
                            margin-inline-end: 0px;
                            padding-inline-start: 40px;
                        }

                        .sidebar::before, .off-canvas-sidebar nav .navbar-collapse::before{
                            height:auto!important;
                        }

                        @media only screen and  (max-width: 1023px) {
                            .main_content
                            {
                                position: relative;
                                float: left;
                                width: 100%;
                            }
                            .sidebar{width:50%;}
                        }



                        @media only screen and  (max-width: 3000px) {
                            .main_content{
                                position: relative;
                                float:right;
                                width: 82%;
                            }
                            .sidebar{width:18%;}
                        }

                        .sidebar::-webkit-scrollbar {
                            width: .2em;
                            height: .0em;
                        }


                        .sidebar::-webkit-scrollbar-track {
                            box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
                        }

                        /*.sidebar::-webkit-scrollbar-thumb {*/
                        /*background-color: green;*/
                        /*outline: 1px solid slategrey;*/
                        /*}*/


                        .sidebar{
                            height:100%;
                            overflow:scroll;
                            scrollbar-width: none;
                        }

                        .main_content{
                            position: relative; float: right;
                        }

                        #collapse_sidebar{
                            display: none;
                        }

                        @media only screen and (max-width: 991px)  {
                            .main_content{
                                width: 100% !important;
                            }
                            .navbar-brand{
                                margin-left: 50px !important;
                            }
                            .navbar .navbar-toggler{
                                margin-top:7px;
                                z-index: 1000;
                                background: #c5c5d2;
                                color: white;
                                padding: 5px;
                            }
                        }

                        @media only screen and (max-width: 700px)  {
                            #user-settings-overlay{
                                display: none !important;
                            }
                            #clock{
                                display: none !important;
                            }

                            #avatar-upload{
                                display: none !important;
                            }
                            .help_tooltip{
                                display: none !important;
                            }

                            .sidebar{
                                /*width: 18% !important;*/
                                width: 260px !important;
                            }
                        }

                        @media only screen and (min-width: 992px)  {
                            .sidebar{
                                width: 18% !important;
                            }

                            .main_content{
                                width: 82% !important;
                            }
                        }

                        .nav-open .sidebar{
                            left:0px !important;
                            z-index: 10;
                        }

                        .sidebar{
                            background: white !important;
                        }
                    </style>
                    <!--full menu start-->
<div class="sidebar p-0">
                        <!--menu left side start-->
                        <div class="left1 theme_color_bg" align="center">
                            <br/>
                            <br/>
                            <ul class="ul1 pt-2">
                                <li class="li1 active-icon">
                                    <b></b>
                                    <b></b>
                                    <a href="#"><i class="fas fa-store"></i></a>
                                </li>
                                <div style="height: 10px;"></div>


                                <?

$user_id=$_SESSION['user']['id'];
$module_sql='select m.module_name,m.id,m.module_link,m.module_icon_img,m.module_menu_icon,d.module_id,d.user_id from user_module_define d,user_module_manage m where d.module_id=m.id and d.user_id="'.$user_id.'" and m.id!='.$mod_id.' ';
$module_query=mysql_query($module_sql);

while($module_data=mysql_fetch_object($module_query))
{
    ?>
<!--                                 <li class="li1 mt-1"><a href="../../../--><?//=$module_data->module_link;?><!--?mod_id=--><?//=$module_data->module_id;?><!--"><img src="../../../home/--><?//=$module_data->module_icon_img?><!--" style="width: 50%;position: absolute; left: 10px; padding-top: 5px;"></a><ul class="ul2"><li class="li2">--><?//=$module_data->module_name; ?><!--</li></ul></li>-->
                                 <li class="li1 mt-1"><a href="../../../<?=$module_data->module_link;?>?mod_id=<?=$module_data->module_id;?>"><img src="../../../home/module_icon/<?=$module_data->module_menu_icon?>" style="width: 75%;position: absolute; left: 7px; padding-top: 3px; "></a><ul class="ul2"><li class="li2"><?=$module_data->module_name; ?></li></ul></li>
    <?
}
?>


                            </ul>

                            <br/>
                            <br/>
<!---->
<!--                            <footer>-->
<!--                                <a href="../../../" class="help_tooltip" data-toggle="tooltip" data-placement="bottom" data-original-title="Signout">-->
<!--                                    <i class="fas fa-power-off"></i>-->
<!--                                </a>-->
<!--                            </footer>-->
                        </div>


                        <!--menu right side start-->
                        <div class="right1" align="right">
                            <!--image start-->
                            <p class="title-image " style="padding-top: 5px !important;">
                                <img src="../../../logo/<?=$_SESSION['user']['group']?>.png" style="width:75px;" height="50px">
                            </p>

                            <!--menu and dropdown menu start-->
                            <h1 id="title_text" class="module-title" ><?=$mod_name?></h1>
                            <div class="menu_bg" align="center">
<?

    
    $subsql="select p.* from user_roll_activity r, user_page_manage p where r.access>0 and p.id=r.page_id and p.status='Yes'  and r.user_id=".$user_id." order by p.ordering,p.feature_id,p.id ";
    $subquery=mysql_query($subsql);
    while($submenu=mysql_fetch_object($subquery))
    {
        
    if($sb_count[$submenu->feature_id]==0) $sb_count[$submenu->feature_id] = 1;
    else $sb_count[$submenu->feature_id] = $sb_count[$submenu->feature_id] + 1;
   
    $sb_id[$submenu->feature_id][$sb_count[$submenu->feature_id]] = $submenu->id;     
    $sb_folder[$submenu->feature_id][$sb_count[$submenu->feature_id]] = $submenu->folder_name;
    $sb_link[$submenu->feature_id][$sb_count[$submenu->feature_id]] = $submenu->page_link;
    $sb_name[$submenu->feature_id][$sb_count[$submenu->feature_id]] = $submenu->page_name;
    $sb_title[$submenu->feature_id][$sb_count[$submenu->feature_id]] = $submenu->page_title;
    }
    

    
    $sql="select distinct f.id, f.feature_name, f.icon
    from user_feature_manage f, user_roll_activity r, user_page_manage p 
    where r.access>0 and p.id=r.page_id and p.feature_id=f.id and r.user_id=".$user_id." and f.module_id=".$mod_id."  order by f.ordering,f.id";
    $query=mysql_query($sql);
    $count = mysql_num_rows($query);
    if($count>0)
    {
        $m = 1;
        while($menu = mysql_fetch_object($query))
        { if($m==4) $m=1; else $m++;
            

                        echo '<div class="dashboard1-nav-dropdown">';
                            echo '<a class="dashboard1-nav-item  dashboard1-nav-dropdown-toggle"><i class="fas fa-clipboard-list"></i>'.$menu->feature_name.' </a>';
                                    echo '<div class="dashboard1-nav-dropdown-menu">';
                                        for($x=1;$x<$sb_count[$menu->id]+1;$x++)
                                        {
                                        echo '<a href="../'.$sb_folder[$menu->id][$x].'/'.$sb_link[$menu->id][$x].'" class="dashboard1-nav-dropdown-item">'.$sb_name[$menu->id][$x].'</a>';
                                        
                //   if($_SESSION['notify'][$sb_id[$menu->id][$x]]>0)
                //	echo '<span class="badge badge-pill badge-danger float-right" style="padding:4px 6px!important;border-radius:0px;font-size:80%;">'.$_SESSION['notify'][$sb_id[$menu->id][$x]].'</span>' ;

                                        }
                                echo '</div>';
                                echo '</div>';
        }
            
    }
?>
</div>
</div>
</div>

    <?
}

load_menu2($mod_id,$mod_name,$user_id);
?>











