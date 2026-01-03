<?
 $_SESSION['notify'][229]=find_a_field('secondary_journal s,accounts_ledger a,user_activity_management u','count(s.tr_no)','s.ledger_id=a.ledger_id and s.entry_by=u.user_id and s.dr_amt<1 and s.ca_checked<1 and s.tr_from in ("Payment")');

$_SESSION['notify'][230]=find_a_field('secondary_journal s,accounts_ledger a,user_activity_management u','count(s.tr_no)','s.ledger_id=a.ledger_id and s.entry_by=u.user_id and s.dr_amt<1 and s.ca_checked>0 and s.fc_checked<1 and s.om_checked<1 and s.ceo_checked<1 and s.tr_from in ("Payment")');

$_SESSION['notify'][231]=find_a_field('secondary_journal s,accounts_ledger a,user_activity_management u','count(s.tr_no)','s.ledger_id=a.ledger_id and s.entry_by=u.user_id and s.dr_amt<1 and s.ca_checked>0 and s.fc_checked>0 and s.om_checked<1 and s.ceo_checked<1 and s.tr_from in ("Payment")');

$_SESSION['notify'][232]=find_a_field('secondary_journal s,accounts_ledger a,user_activity_management u','count(s.tr_no)','s.ledger_id=a.ledger_id and s.entry_by=u.user_id and s.dr_amt<1 and s.ca_checked>0 and s.fc_checked>0 and s.om_checked>0 and s.ceo_checked<1 and s.tr_from in ("Payment")');

$_SESSION['notify'][233]=find_a_field('secondary_journal s,accounts_ledger a,user_activity_management u','count(s.tr_no)','s.ledger_id=a.ledger_id and s.entry_by=u.user_id and s.dr_amt<1 and s.tr_from in ("Payment")');

$_SESSION['notify'][234]=find_a_field('secondary_journal s,accounts_ledger a,user_activity_management u','count(s.tr_no)','s.ledger_id=a.ledger_id and s.checked_by=u.user_id and s.dr_amt<1 and s.checked="YES" and s.tr_from in ("Payment")');

$_SESSION['notify'][238]=find_a_field('secondary_journal','count(jv_no)','tr_from="Bill"');


?>