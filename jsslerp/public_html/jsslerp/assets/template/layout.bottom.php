<?



$trans_end = microtime(true);



$execution_time = ($trans_end - $trans_start);



$address1 = explode('/',$_SERVER['REQUEST_URI']);


$address=preg_replace('/\\?.*/', '', $address1);


$s= count($address);



$module_id = find_a_field('user_module_manage','id','module_file="'.$address[$s-4].'"');



$page_all=find_all_field('user_page_manage','','page_link = "'.$address[$s-1].'" and folder_name="'.$address[$s-2].'"'); 



 $page_id=$page_all->id;

$page_name=$page_all->page_name;



if($execution_time>10)



echo "<div style='background-color:red'>Error Load Time: ".$execution_time."</div>";



//echo '<h2 style="background-color:red;color:blue;">Page Id: <?php echo $page_id;  

//include("../../../assets/template/page_debug_form.php");

//include("../../../assets/template/page_debug_verify_check.php");

$main_content=ob_get_contents();



ob_end_clean();



include ("../../template/main_layout.php");







$trans_end = microtime(true);



$execution_time = ($trans_end - $trans_start);



activity_log($module_id,$page_id,$page_name,$tr_from,$tr_no,$tr_id,$tr_type,$execution_time);







?>



