



          













  <!-- footer content -->

        <footer>

          <div class="pull-right">Alright design and developed by <a href="http://erp.com.bd/web/">ERP.com.Bd </a> Copyright © 2019</div>

          <div class="clearfix"></div>

        </footer>

        <!-- /footer content -->

      </div>

    </div>


	  <!-- jQuery -->

    <script src="../../vendors/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap -->

<script src="../../build/select/bootstraps.min.js"></script>
<script src="../../build/select/bootstrap-select.min.js"></script>

    <!-- FastClick -->

    <script src="../../vendors/fastclick/lib/fastclick.js"></script>

    <!-- NProgress -->

    <script src="../../vendors/nprogress/nprogress.js"></script>

    <!-- ECharts -->

    <!--<script src="../../vendors/echarts/dist/echarts.min.js"></script>-->

    <script src="../../vendors/echarts/map/js/world.js"></script>

	

	    <!-- Chart.js -->

    <script src="../../vendors/Chart.js/dist/Chart.js"></script>



    <!-- Custom Theme Scripts -->

    <script src="../../build/js/custom.min.js"></script>
<script type="text/javascript" src="../../vendors/customjs/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../../vendors/customjs/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="../../vendors/customjs/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="../../vendors/customjs/buttons.bootstrap.min.js"></script>
<script type="text/javascript" src="../../vendors/customjs/jszip.min.js"></script>
<script type="text/javascript" src="../../vendors/customjs/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="../../vendors/customjs/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="../../vendors/customjs/buttons.html5.min.js"></script>
<script type="text/javascript" src="../../vendors/customjs/buttons.print.min.js"></script>
<script type="text/javascript" src="../../vendors/customjs/buttons.colVis.min.js"></script>


<script>
$(document).ready(function() {
    $('#example').DataTable( {
      "iDisplayLength": 100,
		"order": [[ 0, "desc" ]]  
    } );
} );

</script>

<script>
//$(document).ready(function() {
//    $('#example').DataTable( {
//        dom: 'Bfrtip',
//        buttons: [
//            'copy', 'csv', 'excel', 'pdf', 'print'
//        ]
//    } );
//} );


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





  </body>

</html>

