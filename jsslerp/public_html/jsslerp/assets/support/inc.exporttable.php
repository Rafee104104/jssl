
<div align="center" id="pr">

    <button id="btnExport" type="button" onclick="fnExcelReport();" style=" width: 55px; cursor: pointer;"><img src="../../../assets/images/xls_hover.png" width="40" height="40"></button>
    <button name="button" type="button" onclick="hide(); window.print();" value="Print" style=" width: 55px; cursor: pointer;"><img src="../../../assets/images/print.png" width="40" height="40"></button>
<!--    <button  name="button" type="button" onclick="generate()" value="PDF" style=" width: 55px; cursor: pointer;"><img src="../../../assets/images/pdf.png" width="40" height="40"></button>-->




    <iframe id="txtArea1" style="display:none"></iframe>
	<?php /*?><script type="text/javascript" src="../../../assets/js/table2excel.js"></script><?php */?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js" ></script>
<?php /*?>    <script type="text/javascript" src="../../../assets/js/jspdf.min.js"></script>
    <script type="text/javascript" src="../../../assets/js/jspdf.plugin.autotable.min.js"></script><?php */?>
	
	
	
<script>

    function html_table_to_excel(type)
    {
        var data = document.getElementById('ExportTable');

        var file = XLSX.utils.table_to_book(data, {sheet: "sheet1"});

        XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });

        XLSX.writeFile(file, 'file.' + type);
    }

    const export_button = document.getElementById('btnExport');

    export_button.addEventListener('click', () =>  {
        html_table_to_excel('xlsx');
    });

</script>
	
	
	
<?php /*?><script>
	document.getElementById('btnExport').addEventListener('click', function(){
		var table2excel = new Table2Excel();
  		table2excel.export(document.querySelectorAll("#ExportTable"));
	});
	
</script><?php */?>
	
	
	
	
	
	
<?php /*?><script>
    function fnExcelReport()
{
    var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
    var textRange; var j=0;
    tab = document.getElementById('ExportTable'); // id of table

    for(j = 0 ; j < tab.rows.length ; j++) 
    {     
        tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
        //tab_text=tab_text+"</tr>";
    }

    tab_text=tab_text+"</table>";
    tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
    tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
    tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE "); 

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
    {
        txtArea1.document.open("txt/html","replace");
        txtArea1.document.write(tab_text);
        txtArea1.document.close();
        txtArea1.focus(); 
        sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
    }  
    else                 //other browser not tested on IE 11
        sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  

    return (sa);
}
</script><?php */?>


    <script>
        function generate() {
            var doc = new jsPDF('p', 'pt', 'letter');
            var htmlstring = '';
            var tempVarToCheckPageHeight = 0;
            var pageHeight = 0;
            pageHeight = doc.internal.pageSize.height;
            specialElementHandlers = {
                // element with id of "bypass" - jQuery style selector
                '#bypassme': function (element, renderer) {
                    // true = "handled elsewhere, bypass text extraction"
                    return true
                }
            };
            margins = {
                top: 150,
                bottom: 60,
                left: 40,
                right: 40,
                width: 600
            };
            var y = 20;
            doc.setLineWidth(2);
//            doc.text(200, y = y + 30, "TOTAL MARKS OF STUDENTS");
            doc.autoTable({
                html: '#ExportTable',
                startY: 70,
                theme: 'grid',
                columnStyles: {
                    0: {
                        cellWidth: 180,
                    },
                    1: {
                        cellWidth: 180,
                    },
                    2: {
                        cellWidth: 180,
                    },
                    3: {
                        cellWidth: 180,
                    },
                    4: {
                        cellWidth: 180,
                    },
                    5: {
                        cellWidth: 180,
                    },
                    6: {
                        cellWidth: 180,
                    },
                    7: {
                        cellWidth: 180,
                    },
                    8: {
                        cellWidth: 180,
                    },
                    9: {
                        cellWidth: 180,
                    },
                    10: {
                        cellWidth: 180,
                    }
                },
                styles: {
                    minCellHeight: 40
                }
            })
            doc.save('ownload.pdf');
        }
    </script>

</div>