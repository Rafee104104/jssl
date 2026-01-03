<?php
if(!isset($_SESSION))
session_start();
$level=$_SESSION['user']['level'];
$module_name = 'CRM Module';

require_once "../../../assets/template/inc.main_layout.php";
?>


<script>
$(document).ready(function() {
    $('#example').DataTable( {
      "iDisplayLength": 100,
		"order": [[ 0, "desc" ]]  
    } );
} );

</script>

<script>
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
		
		
		{
                extend: 'csvHtml5',
                exportOptions: {
                    columns: [ 'pdf', ':visible' ]
                }
            },
			
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 5 ]
                }
            },
            'colvis'
        ]
    } );
} );
</script>

<script>

$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#example thead tr').clone(true).appendTo( '#example thead' );
    $('#example thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );
 
    var table = $('#example').DataTable( {
        orderCellsTop: true,
        fixedHeader: true
    } );
} );
</script>


<script>
window.alert = function() {};
</script>



