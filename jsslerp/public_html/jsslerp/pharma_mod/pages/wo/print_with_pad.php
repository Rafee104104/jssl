<?php

require_once('../../../../TCPDF/tcpdf.php');


require_once "../../../assets/template/layout.top.php";
//require_once ('../../../common/class.numbertoword.php');


$chalan_no 		= $_REQUEST['v_no'];
$ch_all=find_all_field('sale_do_chalan','','chalan_no='.$chalan_no);
$entry_by = find_a_field('user_activity_management','fname','user_id="'.$ch_all->entry_by.'"');
$depot_name = find_a_field('warehouse','warehouse_name','warehouse_id="'.$ch_all->depot_id.'"');

$do_all=find_all_field('sale_do_master','','do_no='.$ch_all->do_no);
$dealer=find_all_field('dealer_info','','dealer_code='.$do_all->dealer_code);
$dealer_type = find_a_field('dealer_type','dealer_type','id="'.$dealer->dealer_type.'"');
$item_all=find_all_field('item_info','','item_id="'.$row->item_id.'"');

$req_no 		= $_REQUEST['do_no'];

$sql="select * from sale_requisition_master where  do_no='$req_no'";
$data=mysql_query($sql);
$all=mysql_fetch_object($data);



class MYPDF extends TCPDF {

 public function Header() {
        // get the current page break margin
        $bMargin = $this->getBreakMargin();
        // get current auto-page-break mode
        $auto_page_break = $this->AutoPageBreak;
        // disable auto-page-break
        $this->SetAutoPageBreak(false, 0);
        // set bacground image
       $img_file = 'bsc.jpeg';
        $this->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
        // restore auto-page-break status
        $this->SetAutoPageBreak($auto_page_break, $bMargin);
        // set the starting point for the page content
        $this->setPageMark();
    }

}

$pdf = new MYPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('');
$pdf->SetTitle('Challan-'.$req_no);

// set default header data

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT,25, PDF_MARGIN_RIGHT);
//$pdf->setHeaderMargin(20);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// remove default footer
$pdf->setPrintFooter(false);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE,42);

// set image scale factor
//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('courier','R',10);

// add a page
$pdf->AddPage();

// set some text to print

$html .='

<!DOCTYPE html>
<html>


<table width="100%"  cellspacing="0" cellpadding="1">
    <thead>
           <tr>
                <td colspan="12" style="text-align: center; font-size:15px;"><strong>Delivery Challan</strong></td>
            </tr>

            <tr style="border: none">
                <td colspan="7" style="text-align: left; border: none;"><strong>Challan No:</strong><?php echo $ch_all->chalan_no;?></td>
                <td colspan="5" style="text-align: right; border: none;"><strong>Reporting Time:</strong>'.date("h:i A d-m-Y").'</td>
            </tr>



            <tr style="border: none">
                <td colspan="7" style="text-align: left; border-right:none;">

                <tr>
               	 	<td><p style="margin:0px"><span style="font-weight:bold;">DO ID :</span>'.$ch_all->do_no.'</p></td>
                </tr>

                 <tr>
                	<td><p style="margin:0px"><span style="font-weight:bold;">Distributor Name :</span>'.$dealer->dealer_name_e.'</p></td>
                </tr>


                 <tr>
                	<td><p style="margin:0px"><span style="font-weight:bold;">Distributor Address :</span>'.$dealer->address_e.'</p></td>
                </tr>

                 <tr>
                	<td><p style="margin:0px"><span style="font-weight:bold;">Product receiver name :</span>'.$ch_all->rec_name.'</p></td>
                </tr>

                </td>




                <td colspan="6" style="text-align: left; border-left:none;">

                <tr>
               	 	<td><p style="margin:0px"><span style="font-weight:bold;">DO Date :</span>'.$ch_all->do_date.'</p></td>
                </tr>

                 <tr>
                	<td><p style="margin:0px"><span style="font-weight:bold;">Distributor ID:</span>';
					if($dealer->customer_code !='') $html.= $dealer->customer_code; else $html.= $dealer->dealer_code;
					$html.='</p></td>
                </tr>


                 <tr>
                	<td><p style="margin:0px"><span style="font-weight:bold;">Distributor Phone no:</span>'.$dealer->contact_no.'</p></td>
                </tr>

                 <tr>
                	<td><p style="margin:0px"><span style="font-weight:bold;">Product receiver Phone no:</span>'.$ch_all->rec_mob.'</p></td>
                </tr>


                </td>

            </tr>



            <tr style="border: none">
                <td colspan="7" style="text-align: left; border-right:none;">

                <tr>
               	 	<td><p style="margin:0px"><span style="font-weight:bold;">Depot ID :</span>'.$ch_all->depot_id.'</p></td>
                </tr>

                 <tr>
                	<td><p style="margin:0px"><span style="font-weight:bold;">In Charge Name :</span> '.find_a_field('warehouse','contact_persone','warehouse_id='.$ch_all->depot_id).' </p></td>
                </tr>


                 <tr>
                	<td><p style="margin:0px"><span style="font-weight:bold;">Address :</span>'.find_a_field('warehouse','address','warehouse_id='.$ch_all->depot_id).'</p></td>
                </tr>

                 <tr>
                	<td><p style="margin:0px"><span style="font-weight:bold;">Deliveryman Name :</span>'.$ch_all->delivery_man.'</p></td>
                </tr>

                 <tr>
                	<td><p style="margin:0px"><span style="font-weight:bold;">Driver Name :</span>'.$ch_all->driver_name.'</p></td>
                </tr>

                </td>




                <td colspan="6" style="text-align: left; border-left:none;">

                <tr>
               	 	<td><p style="margin:0px"><span style="font-weight:bold;">Delivery Challan No :</span>'.$ch_all->chalan_no.'</p></td>
                </tr>

                 <tr>
                	<td><p style="margin:0px"><span style="font-weight:bold;">In Charge ID No :</span>'.find_a_field('warehouse','in_charge_id','warehouse_id='.$ch_all->depot_id).'</p></td>
                </tr>


                 <tr>
                	<td><p style="margin:0px"><span style="font-weight:bold;">Depot Phone No :</span>'.find_a_field('warehouse','mobile_no','warehouse_id='.$ch_all->depot_id).'</p></td>
                </tr>

                 <tr>
                	<td><p style="margin:0px"><span style="font-weight:bold;">Deliveryman Phone No :</span>'.$ch_all->delivery_man_mobile.'</p></td>
                </tr>

                 <tr>
                	<td><p style="margin:0px"><span style="font-weight:bold;">Vehicle No :</span>'.find_a_field('vehicle_info','concat(vehicle_name,"#",vech_reg_no)','vehicle_id="'.$ch_all->vehicle_no.'"').'</p></td>
                </tr>

                 <tr>
                	<td><p style="margin:0px"><span style="font-weight:bold;">Driver Phone No :</span>'.$ch_all->driver_mobile.'</p></td>
                </tr>


                </td>

            </tr>';






      $html .=' <tr style="font-weight: bold;">
        <th border="1px" align="center">SL </th>
        <th border="1px" align="center"> DO ID</th>
        <th border="1px" align="center"> DO Date</th>
        <th border="1px" align="center"> S Product</th>
        <th border="1px" align="center"> S Company</th>
        <th border="1px" align="center"> Product Name</th>
        <th border="1px" align="center"> Product ID</th>
        <th border="1px" align="center"> Order Quantity</th>
        <th border="1px" align="center"> Delivered</th>
        <th border="1px" align="center"> Sample Product Name</th>
        <th border="1px" align="center"> Sample Product ID</th>
        <th border="1px" align="center"> Sample Quantity</th>
        <th border="1px" align="center"> Undelivered Sample Quantity</th>
       </tr>
       </thead>

       <tbody>

$sql='select c.*,sum(c.total_unit) as chalan_qty,o.item_name as c_item,o.company,offer.gift_id as gift_item_id,offer.id as gift_id from sale_do_chalan c,sale_do_details s left join item_info_other o on o.item_id=s.c_item_id left join sale_gift_offer offer on offer.item_id=s.item_id and offer.start_date<="'.$do_all->do_date.'" and offer.end_date>="'.$do_all->do_date.'" and offer.dealer_type="'.$dealer_type.'" where s.do_no=c.do_no and s.id=c.order_no and s.item_id=c.item_id and c.chalan_no="'.$chalan_no.'" and s.gift_id=0 group by c.item_id';

$query=mysql_query($sql);
while($row=mysql_fetch_object($query)){
$item_all=find_all_field('item_info','','item_id="'.$row->item_id.'"');
$details=find_all_field('sale_do_details','','item_id="'.$row->item_id.'" and do_no="'.$row->do_no.'"');
$entry_by=find_a_field('user_activity_management','fname','user_id="'.$row->entry_by.'"'); 
$approve_by=find_a_field('user_activity_management','fname','user_id="'.$row->approve_by.'"'); 
$gift_sql = 'select s.*,i.item_name,i.finish_goods_code from sale_do_details s, item_info i where s.item_id=i.item_id and s.do_no="'.$row->do_no.'" and s.item_id="'.$row->gift_item_id.'" and s.gift_id>0';
$gift_qry = mysql_query($gift_sql);
$gift_info = mysql_fetch_object($gift_qry);
$gift_delivered = find_a_field('sale_do_chalan','sum(total_unit)','do_no="'.$row->do_no.'" and item_id="'.$row->gift_item_id.'" and gift_id="'.$row->gift_id.'"');


       <tr>
       <td border="1px">test 1</td>
       <td border="1px">test 2</td>
       <td border="1px">test 3</td>
       <td border="1px">test 4</td>
       <td border="1px">test 5</td>
       <td border="1px">test 6</td>
       <td border="1px">test 7</td>
       <td border="1px">test 8</td>
       <td border="1px">test 9</td>
       <td border="1px">test 10</td>
       <td border="1px">test 11</td>
       <td border="1px">test 12</td>
       <td border="1px">test 13</td>
       </tr>

     

       <tr>
                <td border="1px" colspan="9" rowspan="2" style="text-align:left ;font-weight:bold;">Receiver Sign and Date </td>
                <td border="1px" colspan="4" style="text-align:left ;font-weight:bold;">
                        Remarks
                </td>
       </tr>

       <tr>
       		<td border="1px" colspan="4">If any mismatch, Please inform your SR/ASM/DSM.</td>
       </tr>
       </tbody>
</table>


<table width="100%"  cellspacing="0" cellpadding="1">
    <thead>
       <tr>
           <td colspan="11"><h5 style="text-align: center; font-weight: bold;">Undelivered Information</h5></td>
       </tr>
       <tr style="font-weight: bold;">
       		<th border="1px" align="center">SI</th>
            <th border="1px" align="center">DO ID</th>
            <th border="1px" align="center">DO Date </th>
			<th border="1px" align="center">S Product Name</th>
			<th border="1px" align="center">S Company</th>
            <th border="1px" align="center">Product Name </th>
            <th border="1px" align="center">Product ID </th>
            <th border="1px" align="center">Undelivered Product quantity </th>
            <th border="1px" align="center">Sample product Name </th>
            <th border="1px" align="center">Sample Product ID </th>
            <th border="1px" align="center">Undelivered Sample quantity </th>
       </tr>
    </thead>
    <tbody class=" text-center table-striped">
       <tr>
			<td border="1px">test 1</td>
			<td border="1px">test 2</td>
			<td border="1px">test 3</td>
			<td border="1px">test 4</td>
			<td border="1px">test 5</td>
			<td border="1px">test 6</td>
			<td border="1px">test 7</td>
			<td border="1px">test 8</td>
			<td border="1px">test 9</td>
			<td border="1px">test 10</td>
			<td border="1px">test 11</td>
       </tr>

      


		<tr><td>&nbsp;</td></tr>
       <tr>
           <td align="center" colspan="11"><p class="m-0 p-0"><b>This is automated Generated Challan of RCL ERP System.</b></p></td>
       </tr>
       <tr>
           <td colspan="11"><p class="m-0 p-0"> This Challan Generated by <strong>text</strong> date is <strong>
           '.date('M-d-Y',strtotime($ch_all->entry_at)).'</strong> and time <strong>
           '.date('H:i:s',strtotime($ch_all->entry_at)).'</strong> at place is <strong>
           <?=$depot_name?></strong>.

           </p>

           </td>
       </tr>


    </tbody>
</table>


</html>';

// print a block of text using Write()
// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
ob_end_clean();
//Close and output PDF document
$pdf->Output('Challan-'.$req_no.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+