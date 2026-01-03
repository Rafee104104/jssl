<?php



require_once "../../../assets/template/layout.top.php";



$title = 'Single User Issue';



$table_master='fixed_asset_issue_master';



$table_details='fixed_asset_issue_details';



$crud = new crud($table_master);

$dcrud= new crud($table_details);



$unique = 'id';



if(isset($_POST['submit'])){



$journalAll=find_all_field('asset_register','','sl_no="'.$_POST['sl_no'].'" and item_status="inStock"');

if ($_POST['sl_no'] == $journalAll->sl_no) {

$_POST['entry_by']=$_SESSION['user']['id'];

$_POST['type']='Single';

$_POST['status']='COMPLETED';



$ids=$crud->insert();



$sql='insert into fixed_asset_issue_details(m_id,PBI_ID,item_id,serial_no,date,quality,note,entry_by,department_id) values ("'.$ids.'","'.$_POST['PBI_ID'].'","'.$journalAll->item_id.'","'.$_POST['sl_no'].'","'.$_POST['date'].'","'.$_POST['quality'].'","'.$_POST['note'].'","'.$_POST['entry_by'].'","'.$_POST['department_id'].'")';

$query=mysql_query($sql);

$lastDetailsId=mysql_insert_id(); 



$upAsset='update asset_register set item_status="inService" where sl_no="'.$_POST['sl_no'].'"';

mysql_query($upAsset);



journal_asset_item_control($journalAll->item_id ,$_SESSION['user']['depot'],date('Y-m-d'),0,1,'Issue',$lastDetailsId,$journalAll->price,0,$ids,$journalAll->price,0,0,$_POST['sl_no']);



}else{



echo 'Item Not Avilable';

}

}



?>





<div class="row">

	<div class="col-5">



		<form action="" method="post" style="text-align:left" autocomplete="off">







			<div class="form-group">



				<label for="recipient-name" class="col-form-label">Person Name:</label>



				<input list="names" type="text" class="form-control" name="PBI_ID" id="PBI_ID" required>

				

				<datalist id="names">

				<? foreign_relation('personnel_basic_info','concat(PBI_ID,"#",PBI_NAME)','PBI_NAME',$userName,'1')?>

				</datalist>



			</div>

			<div class="form-group">



				<label for="recipient-name" class="col-form-label">Person Mobile:</label>



				<input type="text" class="form-control" name="mobile" id="mobile" required>



			</div>
			
			<div class="form-group">



				<label for="recipient-name" class="col-form-label">Department:</label>



				<select type="text" class="form-control" name="department_id" id="department_id" required>
				
				<option></option>
				
				<? foreign_relation('asset_department','id','department_name',$department,'1');?>
				
				</select>



			</div>

			

			<div class="form-group">



				<label for="recipient-name" class="col-form-label">Product Name:</label>



				<input list="itms" type="text" class="form-control" name="sl_no" id="sl_no" required>



				<datalist id="itms">

<? foreign_relation('item_info i,asset_register r','r.sl_no','i.item_name',$pName,'r.item_id=i.item_id and r.item_status="inStock" group by sl_no')?>

				</datalist>



			</div>



			<div class="form-group">



				<label for="recipient-name" class="col-form-label">Product Quality:</label>



				<select name="quality" id="quality" class="custom-select custom-select-sm">

									<option value="Good">Good</option>

									<option value="Moderate">Moderate</option>

									<option value="Serviceable">Serviceable</option>

									<option value="Unserviceable">Unserviceable</option>

									<option value="Obsolete">Obsolete</option>



				</select>



			</div>



			<div class="form-group">



				<label for="message-text" class="col-form-label"> Note:</label>



				<textarea class="form-control" name="note"></textarea>



			</div>



			<div class="form-group">



				<label for="recipient-name" class="col-form-label"> Date:</label>



				<input type="date" class="form-control" name="date" value="date(" Y-m-d")" id="date-name" required>



			</div>

 

			<div class="form-group">

				<input type="submit" class="form-control btn btn-success" name="submit" value="Confirm">

			</div>



</form>



	</div>

	<div class="col-7">

		<center>

			<h4>Issue List</h4>

		</center>

		<table class="table table-bordered">

			<thead>

				<tr>

					

					<th>Id</th>

					<th>Name</th>

					<th>P Name</th>

					<th>Serial No</th>

					<th>Date</th>

				</tr>

			</thead>

			<tbody>

				<?php

				$i=1;

				 $sql = 'select a.*,p.PBI_NAME,i.item_name from '.$table_details.' a,personnel_basic_info p,item_info i where a.PBI_ID=p.PBI_ID and a.item_id=i.item_id and a.type="Single"';

				$query = mysql_query($sql);

				while ($data = mysql_fetch_object($query)) {

				?>

					<tr>

							<td><?=$i++?></td>

							<td><?= $data->PBI_NAME ?></td>

							<td><?= $data->item_name ?></td>

							<td><?= $data->serial_no ?></td>

							<td><?= $data->date;?></td>

			

					</tr>



				<? } ?>

			</tbody>

		</table>

	</div>

</div>







<?







require_once "../../../assets/template/layout.bottom.php";









?>