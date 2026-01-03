<?
 $_SESSION['notify'][119]=find_a_field('requisition_master','count(req_no)','status="CHECKED"');
  $_SESSION['notify'][125]=find_a_field('purchase_master p,vendor v','count(p.po_no)','p.status="MANUAL" and p.vendor_id=v.vendor_id and v.vendor_category=1');
  $_SESSION['notify'][127]=find_a_field('purchase_master p,vendor v','count(p.po_no)','p.status="UNCHECKED" and p.vendor_id=v.vendor_id and v.vendor_category=1');

?>