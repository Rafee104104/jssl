<?php

require_once "../../../assets/template/layout.top.php";

$title='Assign Person in Task';


do_calander('#fdate');

do_calander('#tdate');

?>


<table width="100%" class="table table-bordered">
<thead>
<tr>
<td>Id</td>
<td>Task Name</td>
<td>Status</td>
<td>Assign</td>
</tr>
</thead>
<tbody>
<? 

$query=mysql_query('select * from task_manage where assign_person=0');
while($data=mysql_fetch_object($query)){
?>
<tr>
<td><?=$data->id?></td>
<td><?=$data->task_name?></td>
<td><?=$data->status?></td>
<td><a href="task_assign.php?id=<?=$data->id?>">Aassign</a></td>

<? }?>
</tr>
</tbody>
</table>



<?



require_once "../../../assets/template/layout.bottom.php";




?>