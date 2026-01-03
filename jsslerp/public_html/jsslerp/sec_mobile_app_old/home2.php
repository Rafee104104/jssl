<?php
session_start();
include 'config/db.php';
include 'config/function.php';
include 'config/access.php';
$user_id	=$_SESSION['user_id'];
$emp_code	=$_SESSION['username'];

$page="home";

$fdate = date('Y-m-01'); $tdate = date('Y-m-d'); 

$year = date("Y",strtotime($tdate));
$mon = date("m",strtotime($tdate));

include "inc/header.php";

?>
<!-- main page content -->
<div class="main-container container">

<?
// today
$visit			=find1("select sum(visit) from ss_do_master where do_date='".date('Y-m-d')."' and status in('CHECKED','COMPLETED') and entry_by='".$emp_code."'");
$memo			=find1("select sum(memo) from ss_do_master where do_date='".date('Y-m-d')."' and status in('CHECKED','COMPLETED') and entry_by='".$emp_code."'");
$total_order 	=find1("select sum(total_amt) from ss_do_details d, ss_do_master m where m.do_no=d.do_no and m.do_date='".date('Y-m-d')."' 
and m.status in('CHECKED','COMPLETED') and entry_by='".$emp_code."'");
$total_delivery	=find1("select sum((item_ex-item_in)*item_price) as sales from ss_journal_item 
where ji_date='".date('Y-m-d')."' and entry_by='".$emp_code."' and tr_from in('Sales','Sales Return')");

// yesterday
$vsql="select sum(visit) from ss_do_master where do_date='".date('Y-m-d',strtotime("-1 days"))."' and status in('CHECKED','COMPLETED') and entry_by='".$emp_code."'";
$visit2			=find1($vsql);
$memo2			=find1("select sum(memo) from ss_do_master where do_date='".date('Y-m-d',strtotime("-1 days"))."' and status in('CHECKED','COMPLETED') and entry_by='".$emp_code."'");
$total_order2 	=find1("select sum(total_amt) from ss_do_details d, ss_do_master m where m.do_no=d.do_no and m.do_date='".date('Y-m-d',strtotime("-1 days"))."' and m.status in('CHECKED','COMPLETED') and entry_by='".$emp_code."'");

$total_delivery2	=find1("select sum((item_ex-item_in)*item_price) as sales from ss_journal_item 
where ji_date='".date('Y-m-d',strtotime("-1 days"))."' and entry_by='".$emp_code."' and tr_from in('Sales','Sales Return')");
?>


<!-- Top Baner info -->
<div class="row mb-3 gap-0 text-center">
<div class="col-12"><h6 class="title"><?=$emp_code?> <?=$name?> (<?=$product_group?>)</h6></div>
<?
$region_name = find1("select BRANCH_NAME from branch where BRANCH_ID='".$user_region_id."'");
$zone_name = find1("select ZONE_NAME from zon where ZONE_CODE='".$user_zone_id."'");
$area_name = find1("select AREA_NAME from area where AREA_CODE='".$user_area_id."'");
?>
<div class="col-12"><h6 class="title"><?=$region_name?>-<?=$zone_name?>-<?=$area_name?></h6></div>		
        <!--<div class="col-4"><h6 class="title"><a href="setup_shop.php"><button type="button" class="btn btn-success">New Shop</button></a></h6></div>-->
    
    </div>
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
$dealer_code = find1("select master_dealer_code from ss_shop where emp_code='".$emp_code."'");


$tc = "select target_con from ss_target_ratio where emp_code='".$emp_code."' and target_year='".$year."' and target_month='".$mon."' ";
$target_con = find1($tc);
if($target_con<1){ $target_con=100;}

$tt="select sum(target_amount) from sale_target_upload where target_year='".$year."' and target_month='".$mon."' 
and dealer_code='".$dealer_code."' ";
$dealer_target = find1($tt);
$sales_target = ($dealer_target*$target_con)/100;

/*$sales=find1("select sum(c.total_amt) from ss_do_chalan c,ss_shop s where c.dealer_code=s.dealer_code and s.emp_code='".$emp_code."'
and chalan_date between '".$fdate."' and '".$tdate."'
");*/

$sales	=find1("select sum((item_ex-item_in)*item_price) as sales from ss_journal_item 
where ji_date between '".$fdate."' and '".$tdate."' and entry_by='".$emp_code."' and tr_from in('Sales','Sales Return')");


$target_ratio = number_format((($sales/$sales_target)*100),2);

$due_amount = (int)($sales_target-$sales);
?>

<div class="row mb-3"><center><h5>Target/Sales (<?=(int)$sales_target?>/<?=(int)$sales?>)</h5></center>
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
Working Day:  <?=$wday?>. Per day Target: <?=(int)($due_amount/$wday);?>
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
            
 <!-- Party List  -->

            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush bg-none">
<?php 
$sql_t = "select s.dealer_code as shop_code, s.*,d.* 
from ss_shop s, dealer_info d 
where d.dealer_code=s.master_dealer_code and s.emp_code='".$emp_code."' 
and s.status=1
order by s.market_id";
$query2=mysqli_query($conn, $sql_t);
while($data2=mysqli_fetch_object($query2)){
?>                                
                                <a href="do.php?ss=<?=$data2->shop_code?>">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="avatar avatar-50 border rounded-15">
                                                <img src="assets/img/user1.jpg" alt="" />
                                            </div>
                                        </div>
                                        <div class="col align-self-center ps-0">
                                            <p class="mb-0"><?=$data2->dealer_name_e?> (<?=$data2->master_dealer_code?>)</p>
                                            <p class="text-info size-10 mb-0"><?=$data2->address_e?></p>
                                            <p class="text-secondary size-10 mb-0"><?=$data2->mobile_no?></p>
                                        </div>
                                    </div>
                                </li></a>
<?php } ?>                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            
<!-- Order list  -->
<div class="row mt-1">
<div class="row text-center mb-2"><h4>Todays Order</h4></div>    
    

                        
                            
<? 
$sql = "select m.do_no,s.*,sum(d.total_amt) as total_amt 
from ss_shop s,ss_do_master m,ss_do_details d 
where s.dealer_code=m.dealer_code and m.do_no=d.do_no 
and m.status='CHECKED' and m.do_date='".date('Y-m-d')."'
and m.entry_by='".$emp_code."'
group by m.do_no order by m.do_no";

$query=mysqli_query($conn, $sql);
while($data=mysqli_fetch_object($query)){
?>                            
<div class="col-12">
    <div class="card shadow-sm mb-2">        
            <ul class="list-group list-group-flush bg-none">
            <li class="list-group-item border-0">
                <div class="row">
                    <div class="col-auto">
                        <div class="card">
                            <div class="card-body p-0">
                                <figure class="avatar avatar-50 rounded-15">
                                    <img src="assets/img/do.png" alt="">
                                </figure>
                            </div>
                        </div>
                    </div>
                    <div class="col px-0">
                        <a href="do_view.php?do=<?=$data->do_no?>"><p class="mb-0">Order No: <?=$data->do_no?>  <?=$data->shop_name?>
						<!--<br><small class="text-secondary"><?=$data->shop_owner_name?> ,<?=$data->mobile?></small>-->
						</p></a>
                    </div>
                    <div class="col-auto text-end">
                        <p class="text-secondary text-muted size-10 mb-0">Order</p>
                        <p class="text-info">
                            <strong><?=$data->total_amt;?></strong>
                        </p>
                    </div>
                </div>
            </li>
    
        </ul>
         
    </div>
</div>
           <? } ?> 
           </div>          
                        

<!-- Chalan list  -->
<div class="row mt-1">
<div class="row text-center mb-2"><h4>Todays Delivery</h4></div>    
    

                        
                            
<? 
$sql2 = "select c.chalan_no,c.*,sum(c.total_amt) as total_amt 

from ss_do_chalan c 
where c.chalan_date='".date('Y-m-d')."'
and c.entry_by='".$emp_code."'
group by c.chalan_no order by c.chalan_no";

$query2=mysqli_query($conn, $sql2);
while($chalan=mysqli_fetch_object($query2)){
?>                            
<div class="col-12">
    <div class="card shadow-sm mb-2">        
            <ul class="list-group list-group-flush bg-none">
            <li class="list-group-item border-0">
                <div class="row">
                    <div class="col-auto">
                        <div class="card">
                            <div class="card-body p-0">
                                <figure class="avatar avatar-50 rounded-15">
                                    <img src="assets/img/chalan.png" alt="">
                                </figure>
                            </div>
                        </div>
                    </div>
                    <div class="col px-0">
                        <a href="chalan_view.php?v=<?=$chalan->chalan_no?>"><p class="mb-0">Chalan No: <?=$chalan->chalan_no?>
						<br><small class="text-secondary">DO NO: <?=$chalan->do_no?></small>
						</p></a>
                    </div>
                    <div class="col-auto text-end">
                        <p class="text-secondary text-muted size-10 mb-0">Delivery</p>
                        <p class="text-info">
                            <strong><?=$chalan->total_amt;?></strong>
                        </p>
                    </div>
                </div>
            </li>
    
        </ul>
         
    </div>
</div>
           <? } ?> 
           </div>  




        </div>
        <!-- main page content ends -->


    </main>
    <!-- Page ends-->

<?php include "inc/footer.php"; ?>