<?php

session_start();

include 'config/db.php';

include 'config/function.php';

include 'config/access.php';

$page="home";







$dealer_code	=$_SESSION['warehouse_id'];

$dinfo=findall("select * from dealer_info where dealer_code='".$dealer_code."' ");

$user_id	=$_SESSION['user_id'];

$emp_code	=$_SESSION['username'];





$fdate = date('Y-m-01'); $tdate = date('Y-m-d'); 



$year = date("Y",strtotime($tdate));

$mon = date("m",strtotime($tdate));







$contribution = find1("select target_con from ss_target_ratio where emp_code='".$emp_code."' and target_year='".$year."' and target_month='".$mon."'");

if($contribution=='') $contribution =100;

include "inc/header.php";



?>

<!-- main page content -->

<div class="main-container container">



<?

// today

$visit			=find1("select sum(visit) from ss_do_master where do_date='".date('Y-m-d')."' and status in('CHECKED','COMPLETED') and entry_by='".$emp_code."'");

$memo			=find1("select sum(memo) from ss_do_master where do_date='".date('Y-m-d')."' and status in('CHECKED','COMPLETED') and entry_by='".$emp_code."'");



$total_order 	=find1("select sum(total_amt) from ss_do_details d, ss_do_master m where m.do_no=d.do_no and m.do_date='".date('Y-m-d')."' 

and m.status in('CHECKED','COMPLETED') and m.entry_by='".$emp_code."'");



$total_delivery	=find1("select sum((item_ex-item_in)*item_price) as sales from ss_journal_item 

where ji_date='".date('Y-m-d')."' and entry_by='".$emp_code."' and tr_from in('Sales','Sales Return')");



// yesterday

$vsql="select sum(visit) from ss_do_master where do_date='".date('Y-m-d',strtotime("-1 days"))."' and status in('CHECKED','COMPLETED') and entry_by='".$emp_code."'";

$visit2			=find1($vsql);

$memo2			=find1("select sum(memo) from ss_do_master where do_date='".date('Y-m-d',strtotime("-1 days"))."' and status in('CHECKED','COMPLETED') and entry_by='".$emp_code."'");

$total_order2 	=find1("select sum(total_amt) from ss_do_details d, ss_do_master m where m.do_no=d.do_no and m.do_date='".date('Y-m-d',strtotime("-1 days"))."' and m.status in('CHECKED','COMPLETED') and m.entry_by='".$emp_code."'");



$total_delivery2	=find1("select sum((item_ex-item_in)*item_price) as sales from ss_journal_item 

where ji_date='".date('Y-m-d',strtotime("-1 days"))."' and entry_by='".$emp_code."' and tr_from in('Sales','Sales Return')");

?>





<!-- Top Baner info -->

<div class="row mb-3 gap-0 text-center">

<div class="col-12"><h6 class="title"><?=$emp_code?> <?=$name?> </h6></div>

<?

$region_name = find1("select BRANCH_NAME from branch where BRANCH_ID='".$user_region_id."'");

$zone_name = find1("select ZONE_NAME from zon where ZONE_CODE='".$user_zone_id."'");

$area_name = find1("select AREA_NAME from area where AREA_CODE='".$user_area_id."'");

?>

<div class="col-12"><h6 class="title"><?=$region_name?>-<?=$zone_name?>-<?=$area_name?></h6></div>

<div class="col-12"><h6 class="title">Dealer: <?=$dinfo->dealer_code?> <?=$dinfo->dealer_name_e?> <?=$dinfo->mobile_no?></h6></div>

		

<!--<div class="col-4"><h6 class="title"><a href="setup_shop.php"><button type="button" class="btn btn-success">New Shop</button></a></h6></div>-->

    

    </div>





  
    
<marquee>*** Please use <span style="color:red; font-weight: bold;">"Google Chrome"</span> browser to enable all of features. ***</marquee>
<!--<center><div><a  href="new_shop.php"><button type="button" class="btn btn-primary btn-sm btn-block">New SHop</button></a></div>  </center> -->
<center><div><a  href="new_shop.php"><button type="button" class="btn btn-success btn-sm btn-block">New Shop Open</button></a></div>  </center> 

    <br>

<div class="row bg-purple text-white mb-3">

                <div class="col align-self-center">

                    <div class="text-center py-4">

                        <p class="small">Today</p>

                    </div>

                </div>

                <div class="col align-self-center">

                    <div class="text-center py-4">

                        <h4 class="mb-0"><span class="countertext"><?=$visit?>/<?=$memo?></span></h4>

                        <p class="small">Visit/Memo</p>

                    </div>

                </div>

                <div class="col align-self-center">

                    <div class="text-center py-4">

                        <h4 class="mb-0"><span class="countertext"><?=(int)$total_order?></span></h4>

                        <p class="small">Order</p>

                    </div>

                </div>

                <div class="col align-self-center">

                    <div class="text-center py-4">

                        <h4 class="mb-0"><span class="countertext"><?=(int)$total_delivery?></span></h4>

                        <p class="small">Delivery</p>

                    </div>

                </div>

</div>

            





<div class="row bg-theme text-white mb-3">

                <div class="col align-self-center">

                    <div class="text-center py-4">

                        <p class="small">LastDay</p>

                    </div>

                </div>

                <div class="col align-self-center">

                    <div class="text-center py-4">

                        <h4 class="mb-0"><span class="countertext"><?=$visit2?>/<?=$memo2?></span></h4>

                        <p class="small">Visit/Memo</p>

                    </div>

                </div>

                <div class="col align-self-center">

                    <div class="text-center py-4">

                        <h4 class="mb-0"><span class="countertext"><?=(int)$total_order2?></span></h4>

                        <p class="small">Order</p>

                    </div>

                </div>

                <div class="col align-self-center">

                    <div class="text-center py-4">

                        <h4 class="mb-0"><span class="countertext"><?=(int)$total_delivery2?></span></h4>

                        <p class="small">Delivery</p>

                    </div>

                </div>

</div>





<?

// ----------------- TARGET ----------------







$st="select target_amount from ss_target_upload where target_year='".$year."' and target_month='".$mon."' and so_code='".$emp_code."'";
$sales_target = find1($st);


$sales	=find1("select sum((item_ex-item_in)*item_price) as sales from ss_journal_item 
where ji_date between '".$fdate."' and '".$tdate."' and entry_by='".$emp_code."' and tr_from in('Sales','Sales Return')");



@$target_ratio = number_format((($sales/$sales_target)*100),2);


$due_amount = (int)($sales_target-$sales);

?>



<div class="row mb-3"><center><h5>Target/Sales (<?=(int)$sales_target?>/<?=(int)$sales?>)</h5>

<h6>Per Day Target: <?=(int)($sales_target/30);?></h6>

</center>

<!--  <div class="progress mt-2" style="height: 32px;">

    <div class="progress-bar bg-info progress-bar-striped" style="width:<?=$target_ratio?>%"><?=$target_ratio?>%</div>

  </div>-->

</div>





<script src="assets/highcharts_js/jquery.min.js"></script>

<script src="assets/highcharts_js/highcharts.js"></script>

<script src="assets/highcharts_js/highcharts-more.js"></script>

<script src="assets/highcharts_js/solid-gauge.js"></script>



<div id="container" style="height: 200px;">

</div> 

 

<script>

$(function() {



  var rawData = <?=$target_ratio?>,

    data = getData(rawData);



  function getData(rawData) {

    var data = [],

      start = Math.round(Math.floor(rawData / 10) * 10);

    data.push(rawData);

    for (i = start; i > 0; i -= 10) {

      data.push({

        y: i

      });

    }

    return data;

  }



  Highcharts.chart('container', {

    chart: {

      type: 'solidgauge',

      marginTop: 10

    },

    

    title: {

      text: ''

    },

    

    subtitle: {

      text: rawData,

      style: {

        'font-size': '60px'

      },

      y: 130,

      zIndex: 7

    },



    tooltip: {

      enabled: false

    },



    pane: [{

      startAngle: -120,

      endAngle: 120,

      background: [{ // Track for Move

        outerRadius: '100%',

        innerRadius: '80%',

        backgroundColor: Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0.3).get(),

        borderWidth: 0,

        shape: 'arc'

      }],

      size: '120%',

      center: ['50%', '65%']

    }, {

      startAngle: -120,

      endAngle: 120,

      size: '95%',

      center: ['50%', '65%'],

      background: []

    }],



    yAxis: [{

      min: 0,

      max: 100,

      lineWidth: 2,

      lineColor: 'white',

      tickInterval: 10,

      labels: {

        enabled: false

      },

      minorTickWidth: 0,

      tickLength: 50,

      tickWidth: 5,

      tickColor: 'white',

      zIndex: 6,

      stops: [

        [0, '#fff'],

        [0.101, '#0f0'],

        [0.201, '#2d0'],

        [0.301, '#4b0'],

        [0.401, '#690'],

        [0.501, '#870'],

        [0.601, '#a50'],

        [0.701, '#c30'],

        [0.801, '#e10'],

        [0.901, '#f03'],

        [1, '#f06']

      ]

    }, {

      linkedTo: 0,

      pane: 1,

      lineWidth: 5,

      lineColor: 'white',

      tickPositions: [],

      zIndex: 6

    }],

    

    series: [{

      animation: false,

      dataLabels: {

        enabled: false

      },

      borderWidth: 0,

      color: Highcharts.getOptions().colors[0],

      radius: '100%',

      innerRadius: '80%',

      data: data

    }]

  });

});



</script> 

 

<?

function get_working_day($sdate) {

	define('ONE_WEEK', 604800);

    $days=0x20;

	$start=strtotime($sdate);

	$tdate = date("Y-m-t", $start);

	$end=strtotime($tdate);



	$w = array(date('w', $start), date('w', $end));

    $x = floor(($end-$start)/ONE_WEEK);

    $sum = 0;



    for ($day = 0;$day < 7;++$day) {

        if ($days & pow(2, $day)) {

            $sum += $x + ($w[0] > $w[1]?$w[0] <= $day || $day <= $w[1] : $w[0] <= $day && $day <= $w[1]);

        }

    }



     //$sum;

	 

$date1 = new DateTime($sdate);

$date2 = new DateTime($tdate);

$total_days  = $date2->diff($date1)->format('%a'); 

	 

return $working_days=($total_days-$sum);

	 

} // end 

$sdate=date('Y-m-d');

$wday = get_working_day($sdate);

 

?> 

Contribution:<?=$contribution?>%,Working Day:  <?=$wday?>. RD Target: <?=(int)($due_amount/$wday);?>

 

 

 

 

 

 



 

            

<!-- Party List  -->

<!-- <div class="row mb-4">

	<div class="col-12">

		<div class="card">

			<div class="card-body p-0">

				<ul class="list-group list-group-flush bg-none">                               

<li class="list-group-item">

	<div class="row">

		<div class="col-auto">

			<div class="avatar avatar-50 border rounded-15">

				<img src="assets/img/user1.jpg" alt="" />

			</div>

		</div>

		<div class="col align-self-center ps-0">

			<p class="mb-0"><?=$dinfo->dealer_name_e?> (<?=$dinfo->dealer_code?>)</p>

			<p class="text-info size-10 mb-0"><?=$dinfo->address_e?></p>

			<p class="text-secondary size-10 mb-0"><?=$dinfo->mobile_no?></p>

		</div>

	</div>

</li>



</ul>

</div>

</div>

</div>

</div>-->

<!--end party -->









            

<!-- Order list  -->

          

                        



<!-- Chalan list  -->

  









</div>

<!-- main page content ends -->





    </main>

    <!-- Page ends-->



<?php include "inc/footer.php"; ?>