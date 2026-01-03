<?php

require_once "../../../assets/template/layout.top.php";

$title='FG Receive Status ';



do_calander('#fdate');

do_calander('#tdate');



$table = 'fg_production';

$unique = 'po_no';

$status = 'CHECKED';

$target_url = '../production_dailyrice/chalan_view2.php';



if($_REQUEST[$unique]>0)

{

$_SESSION[$unique] = $_REQUEST[$unique];

header('location:'.$target_url);

}



?>

<script language="javascript">

function custom(theUrl)

{

	window.open('<?=$target_url?>?v_no='+theUrl);

}

</script>







<div class="form-container_large">
   
    <form action="" method="post" name="codz" id="codz">
            
        <div class="container-fluid bg-form-titel">
            <div class="row">
				<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group row m-0">
                        <label class="col-sm-5 col-md-5 col-lg-5 col-xl-5 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Batch No:</label>
                        <div class="col-sm-7 col-md-7 col-lg-7 col-xl-7 p-0">
                            <select name="batch_no" id="batch_no">
		 						 <option></option>
        						 <? foreign_relation('rm_consumption','batch_no','batch_no',$_POST['batch_no'],'1 group by batch_no');?>
          					</select>

                        </div>
                    </div>
                </div>
				
 <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 row">
             <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 p-0">
               <div class="form-group row m-0">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">From  Date:</label>
                 <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
                   <input type="text" name="fdate" id="fdate" value="<?=($_POST['fdate']!='')?$_POST['fdate']:date('Y-m-01');?>" />
                                </div>
                            </div>


                        </div>


                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 p-0">
                            <div class="form-group row m-0">
                     <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> To Date:</label>
                                <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0">
                                    <input type="text" name="tdate" id="tdate"  value="<?=($_POST['tdate']!='')?$_POST['tdate']:date('Y-m-d');?>" /> 

                                </div>
                            </div>

                        </div>




                </div>
				

                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 d-flex justify-content-center align-items-center">
                    <input type="submit" name="submitit" id="submitit" value="VIEW DETAIL" class="btn1 btn1-submit-input"/ >
                </div>

            </div>
        </div>






        <div class="container-fluid pt-5 p-0 ">


                <table class="table1  table-striped table-bordered table-hover table-sm">
                    <thead class="thead1">
                    <tr class="bgc-info">
                        <th>SL</th>
                        <th>Batch NO</th>

                        <th>Received By</th>
                        <th>Received At</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody class="tbody1">

                    <?

                    if(isset($_POST['submitit'])){





                        if($_POST['fdate']!=''&&$_POST['tdate']!='')

                            $con .= 'and pr.receive_date between "'.$_POST['fdate'].'" and "'.$_POST['tdate'].'"';

                        if($_POST['batch_no']!='')

                            $con .= 'and pr.batch_no="'.$_POST['batch_no'].'"';
                        $si=0;

                         $sql = 'select pr.batch_no,pr.entry_at,u.fname 
						
						from fg_production pr left join user_activity_management u on u.user_id=pr.entry_by where 1 '.$con.' group by pr.batch_no  DESC';

                        $sqlq = mysql_query($sql);

                        while($info=mysql_fetch_object($sqlq)){

                            ?>

                            <tr>

                                <td><?=++$si;?></td>

                                <td><?=$info->batch_no?></td>

                                <td><?=$info->fname?></td>

                                <td><?=$info->entry_at?></td>
                                <td><?=find_a_field('rm_consumption','status','batch_no="'.$info->batch_no.'"');?></td>
                                <td >
						
								
		<a target="_blank" href="chalan_view2.php?v_no=<?=$info->batch_no?>"><div class="btn2 btn1-bg-submit"><i class="fa-solid fa-eye"></i></div></a>
								</td>
                            </tr>


                        <? }}?>



                    </tbody>
                </table>





        </div>
    </form>
</div>






<?

require_once "../../../assets/template/layout.bottom.php";

?>