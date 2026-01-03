<?php


session_start();


require_once "../../../assets/template/layout.top.php";


@ini_set('error_reporting', E_ALL);


@ini_set('display_errors', 'Off');


$str = $_POST['data'];


$data=explode('##',$str);


  $combination=$data[0];
  
  $combination_exp=explode('->',$combination);
  
   $paper_comb_id=$combination_exp[0];
  
  
  $sqm=find_all_field('paper_combination','',"id=".$paper_comb_id);


?>

<input  name="paper_combination_id" type="hidden" class="input3" id="paper_combination_id" style="width:60px; height:30px;"  readonly="" value="<?=$paper_comb_id?>" />
<input  name="paper_combination" type="hidden" class="input3" id="paper_combination" style="width:60px; height:30px;"  readonly="" value="<?=$sqm->paper_combination?>" />

<input  name="sqm_rate" type="text" class="input3" id="sqm_rate" style="width:60px; height:30px;" value="<?=$sqm->sqm_rate?>" required="required"  readonly="" onchange="count_formula()"/>





