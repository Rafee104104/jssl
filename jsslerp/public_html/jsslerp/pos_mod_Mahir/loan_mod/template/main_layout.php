<script type="text/javascript">
	function printDiv(pr) {
		document.getElementById('hide').style.display = 'none';
		var printContents = document.getElementById("pr").innerHTML;
		var originalContents = document.body.innerHTML;


		document.body.innerHTML = "<html><head><title>Sales Return Report</title><style>table, th, td {border: 1px solid black;}</style></head><body>" + printContents + "</body>";
		window.print();
		document.body.innerHTML = originalContents;
	}
</script>

<?php

if(!isset($_SESSION))

session_start();

$level=$_SESSION['user']['level'];

$module_name = 'User Module';

$concern=find_a_field('project_info','company_name','1');



require_once "../../../assets/template/inc.main_layout.php";

?>





