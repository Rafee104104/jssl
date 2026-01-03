<?php

session_start();

include 'config/db.php';

include 'config/function.php';

include 'config/access.php';

$u_id= $_SESSION['user_id']; //$_SESSION['user']['id'];
$PBI_ID = find_a_field('user_activity_management','PBI_ID','user_id='.$u_id);

$user_id	= $PBI_ID; //$_SESSION['user_id'];



$page="report_list";



include "inc/header.php";






 date("Y-m-d H:i:s");










?>

<style>

  .openerp img{

    width: 100%;

  }

  .mob.scrollbar{

  display:none;

  }

  

  /* Extra small devices (phones, 600px and down) */

@media(max-width: 600px) {

  

  .mob.scrollbar{

  	display:block;

  	margin-left: 30px;

	float: left;

	height: 300px;

	width: 555px;

	background: #F5F5F5;

	overflow-y: scroll;

	margin-bottom: 25px;

  

  }



  



  

  

}





</style>




<div class="form-container_large">




  <div class="row m-0">

    <div class="col-md-12 p-0 mob">

      <p style=" text-align: center; font-weight: bold; margin-top: 20px;  text-decoration: underline;">Attendance Statistics For :

        <?=date('Y')?>

        -

        <?=date('F')?>

      </p>

      <table id="example" class="table table-bordered scrollbar table-sm" style="font-size: 12px;">

        <thead style="background: #1ABB9C;">

          <tr>

            <th style="color: white;">User Name</th>

            <th style="color: white;">Date</th>

            <th style="color: white;">Day</th>

            <th style="color: white;">In Time</th>

            <th style="color: white;">In Time Location</th>



            <th style="color: white;">Out Time</th>

            <th style="color: white;">Out Time Location</th>


          </tr>

        </thead>

        <tbody>

          <?

      $month_end = strtotime('last day of this month', time());



//  $end_day =  date('d', $month_end).'<br/>';

 $end_day =  31;



for($i=1;$i<=$end_day;$i++){



          ?>

          <tr>

            <td><?=find_a_field('user_activity_management','fname','user_id="'.$u_id.'"')?></td>

            <td><?=date('Y')?>

              -

              <?=date('m')?>

              -

              <?=$i?></td>

            <td><?

$date = date('Y').'-'.date('m').'-'.$i;

 $off_day =  date('D', strtotime($date));

 if($off_day=='Fri'){ echo '<span class="btn btn-warning btn-xs">'.date('l', strtotime($date)).'</span>';}else{ echo '<span class="btn btn-primary btn-xs">'.date('l', strtotime($date)).'</span>'; }

?>

            </td>

            <td><? $in_time = find_a_field('hrm_attdump','min(xtime)','xenrollid="'.$PBI_ID.'" and xdate="'.$date.'" group by xdate'); if($in_time!=''){ echo $in_time;}else{ if($off_day=='Fri'){ echo '<span class="btn btn-success btn-xs">Day Off</span>'; }else{ echo '<span class="btn btn-danger btn-xs">Absent</span>'; } }?></td>

            <td><? $in_latitute =  find_a_field('hrm_attdump','latitude','bizid="'.$PBI_ID.'" and xdate="'.$date.'" and xtime="'.$in_time.'"'); $in_longitude = find_a_field('hrm_attdump','longitude',

'bizid="'.$PBI_ID.'" and xdate="'.$date.'" and xtime="'.$in_time.'"'); if($in_latitute!='' && $in_longitude!=''){?>

              <a href="https://www.latlong.net/c/?lat=<?=$in_latitute?>&long=<?=$in_longitude?>" target="_blank" class="btn btn-warning btn-xs">View</a>

              <? } ?></td>

        

            <td><? $out_time = find_a_field('hrm_attdump','max(xtime)','xenrollid="'.$PBI_ID.'" and xdate="'.$date.'" group by xdate'); if($out_time!=''){ echo $out_time;}else{ if($off_day=='Fri'){ echo '<span class="btn btn-success btn-xs">Day Off</span>'; }else{ echo '<span class="btn btn-danger btn-xs">Absent</span>'; } }?></td>

            <td><? $out_latitute =  find_a_field('hrm_attdump','latitude','xenrollid="'.$PBI_ID.'" and xdate="'.$date.'" and xtime="'.$out_time.'"'); $out_longitude = find_a_field('hrm_attdump','longitude',

'xenrollid="'.$PBI_ID.'" and xdate="'.$date.'" and xtime="'.$out_time.'"'); if($out_latitute!='' && $out_longitude!=''){?>

              <a href="https://www.latlong.net/c/?lat=<?=$out_latitute?>&long=<?=$out_longitude?>" target="_blank" class="btn btn-warning btn-xs">View</a>

              <? } ?></td>

        

          </tr>

          <? } ?>

        </tbody>

        <tfoot>

          <tr>

            <th>User Name</th>

            <th>Date</th>

            <th>Day</th>

            <th>In Time</th>

            <th>In Time Location</th>



            <th>Out Time</th>

            <th>Out Time Location</th>

    

          </tr>

        </tfoot>

      </table>

    </div>

  </div>

</div>



<?php include "inc/footer.php"; ?>