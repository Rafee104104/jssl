<?php
require_once "../../../assets/template/layout.top.php";

$title='Notes to the Financial Statements';

do_calander('#fdate');
do_calander('#tdate');
do_calander('#cfdate');
do_calander('#ctdate');

$fdate   = $_REQUEST["fdate"];
$tdate   = $_REQUEST['tdate'];
$cfdate  = $_REQUEST["cfdate"];
$ctdate  = $_REQUEST['ctdate'];

if(isset($_REQUEST['tdate']) && $_REQUEST['tdate']!='')
$report_detail .= '<br>For the Month ended: '. date("d M' y", strtotime($tdate))." to ". date("d M' y", strtotime($ctdate));  

?>

<style>
a:hover { color: #FF0000; }
</style>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
      <div class="left_report">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>
              <div class="box_report">
                <form id="form1" name="form1" method="post" action="">
                  <table width="100%" border="0" cellspacing="2" cellpadding="0">
                    <tr>
                      <td width="22%" align="right">From Date :</td>
                      <td width="23%" align="left">
                        <input name="fdate" type="text" id="fdate" size="12" maxlength="12" 
                          value="<?php echo $_REQUEST['fdate'];?>" autocomplete="off"/>
                      </td>
                      <td width="8%" align="left"><div align="center">To Date:</div></td>
                      <td width="50%" align="left">
                        <input name="tdate" type="text" id="tdate" size="12" style="max-width:250px;"
                          value="<?php echo $_REQUEST['tdate'];?>" autocomplete="off"/>
                      </td>
                    </tr>

                    <tr>
                      <td align="right">Comparative Date :</td>
                      <td align="left">
                        <input name="cfdate" type="text" id="cfdate" size="12" maxlength="12"
                          value="<?php echo $_REQUEST['cfdate'];?>" autocomplete="off"/>
                      </td>
                      <td align="left"><div align="center">To Date:</div></td>
                      <td align="left">
                        <input name="ctdate" type="text" id="ctdate" size="12" style="max-width:250px;"
                          value="<?php echo $_REQUEST['ctdate'];?>" autocomplete="off"/>
                      </td>
                    </tr>

                    <tr><td align="right"></td><td colspan="3" align="left"><br/></td></tr>

                    <tr>
                      <td align="center">&nbsp;</td>
                      <td align="center">&nbsp;</td>
                      <td align="center"><input class="btn" name="show" type="submit" id="show" value="Show" /></td>
                    </tr>
                  </table>
                </form>
              </div>
            </td>
          </tr>

          <tr>
            <td align="right"><? include('PrintFormat.php');?></td>
          </tr>

          <tr>
            <td>
              <div id="reporting" style="overflow:hidden">
<?php
if(isset($_REQUEST['show'])) {

    if($_REQUEST['cfdate']==''){
        $show_compa='style="display:none;"';
    }

    // ====== DATA COLLECTION ======
    // Current Period
    $asset_amt = [];
    $sql = "SELECT a.ledger_id, SUM(j.dr_amt-j.cr_amt) AS asset_amt
            FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
            WHERE s.id=l.acc_sub_sub_class 
              AND l.group_id=a.ledger_group_id 
              AND a.ledger_id=j.ledger_id 
              AND j.jv_date <= '".$tdate."'
			  and s.acc_class!=4
            GROUP BY a.ledger_id";
    $query = mysql_query($sql);
    while($data = mysql_fetch_object($query)){
        $asset_amt[$data->ledger_id] = $data->asset_amt;
    }

    // Comparative Period
    $asset_amt2 = [];
    if($cfdate!='' && $ctdate!=''){
        $sql = "SELECT a.ledger_id, SUM(j.dr_amt-j.cr_amt) AS asset_amt
                FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
                WHERE s.id=l.acc_sub_sub_class 
                  AND l.group_id=a.ledger_group_id 
                  AND a.ledger_id=j.ledger_id 
				   and s.acc_class!=4
                  AND j.jv_date  <= '".$ctdate."'
                GROUP BY a.ledger_id";
        $query = mysql_query($sql);
        while($data = mysql_fetch_object($query)){
            $asset_amt2[$data->ledger_id] = $data->asset_amt;
        }
    }


 // ====== DATA COLLECTION ======
    // Current Period 10
    $asset_amt10 = [];
    $sql = "SELECT a.ledger_id, SUM(j.dr_amt-j.cr_amt) AS asset_amt
            FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
            WHERE s.id=l.acc_sub_sub_class 
              AND l.group_id=a.ledger_group_id 
              AND a.ledger_id=j.ledger_id 
              AND j.jv_date < '".$fdate."'
			  and s.acc_class!=4
            GROUP BY a.ledger_id";
    $query = mysql_query($sql);
    while($data = mysql_fetch_object($query)){
        $asset_amt10[$data->ledger_id] = $data->asset_amt;
    }

    // Comparative Period
    $asset_amt210 = [];
    if($cfdate!='' && $ctdate!=''){
        $sql = "SELECT a.ledger_id, SUM(j.dr_amt-j.cr_amt) AS asset_amt
                FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
                WHERE s.id=l.acc_sub_sub_class 
                  AND l.group_id=a.ledger_group_id 
                  AND a.ledger_id=j.ledger_id 
				   and s.acc_class!=4
                  AND j.jv_date  < '".$cfdate."'
                GROUP BY a.ledger_id";
        $query = mysql_query($sql);
        while($data = mysql_fetch_object($query)){
            $asset_amt210[$data->ledger_id] = $data->asset_amt;
        }
    }



 // ====== DATA COLLECTION ======
    // Current Period note 3
    $asset_amtnote3 = [];
    $sql = "SELECT s.id, SUM(j.dr_amt-j.cr_amt) AS asset_amt
            FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
            WHERE s.id=l.acc_sub_sub_class 
              AND l.group_id=a.ledger_group_id 
              AND a.ledger_id=j.ledger_id 
              AND j.jv_date <= '".$fdate."'
			  and s.acc_class!=4 and s.id=119
            GROUP BY s.id";
    $query = mysql_query($sql);
    while($data = mysql_fetch_object($query)){
        $asset_amtnote3[$data->id] = $data->asset_amt;
    }

    // Comparative Period
    $asset_amtnote32 = [];
    if($cfdate!='' && $ctdate!=''){
        $sql = "SELECT s.id, SUM(j.dr_amt-j.cr_amt) AS asset_amt
            FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
            WHERE s.id=l.acc_sub_sub_class 
              AND l.group_id=a.ledger_group_id 
              AND a.ledger_id=j.ledger_id 
              AND j.jv_date <= '".$cfdate."'
			  and s.acc_class!=4 and s.id=119
            GROUP BY s.id";
        $query = mysql_query($sql);
        while($data = mysql_fetch_object($query)){
            $asset_amtnote32[$data->id] = $data->asset_amt;
        }
    }
	
	 // ====== DATA COLLECTION ======
    // Current Period note 3
    $asset_amtperiodnote3 = [];
    $sql = "SELECT s.id, SUM(j.dr_amt-j.cr_amt) AS asset_amt
            FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
            WHERE s.id=l.acc_sub_sub_class 
              AND l.group_id=a.ledger_group_id 
              AND a.ledger_id=j.ledger_id 
              AND j.jv_date between '".$fdate."' and '".$tdate."'
			  and s.acc_class!=4 and s.id=119
            GROUP BY s.id";
    $query = mysql_query($sql);
    while($data = mysql_fetch_object($query)){
        $asset_amtperiodnote3[$data->id] = $data->asset_amt;
    }

    // Comparative Period
    $asset_amtperiodnote32 = [];
    if($cfdate!='' && $ctdate!=''){
        $sql = "SELECT s.id, SUM(j.dr_amt-j.cr_amt) AS asset_amt
            FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
            WHERE s.id=l.acc_sub_sub_class 
              AND l.group_id=a.ledger_group_id 
              AND a.ledger_id=j.ledger_id 
              AND j.jv_date between '".$cfdate."' and '".$ctdate."'
			  and s.acc_class!=4 and s.id=119
            GROUP BY s.id";
        $query = mysql_query($sql);
        while($data = mysql_fetch_object($query)){
            $asset_amtperiodnote32[$data->id] = $data->asset_amt;
        }
    }

// ====== DATA COLLECTION ======
    // Current Period
    $expense_amt = [];
    $sql = "SELECT a.ledger_id, SUM(j.dr_amt-j.cr_amt) AS asset_amt
            FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
            WHERE s.id=l.acc_sub_sub_class 
              AND l.group_id=a.ledger_group_id 
              AND a.ledger_id=j.ledger_id 
              AND j.jv_date between  '".$fdate."' and '".$tdate."'
			  and s.acc_class=4
            GROUP BY a.ledger_id";
    $query = mysql_query($sql);
    while($data = mysql_fetch_object($query)){
        $expense_amt[$data->ledger_id] = $data->asset_amt;
    }

    // Comparative Period
    $expense_amt2 = [];
    if($cfdate!='' && $ctdate!=''){
        $sql = "SELECT a.ledger_id, SUM(j.dr_amt-j.cr_amt) AS asset_amt
                FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
                WHERE s.id=l.acc_sub_sub_class 
                  AND l.group_id=a.ledger_group_id 
                  AND a.ledger_id=j.ledger_id 
				   and s.acc_class=4
                  AND j.jv_date between '".$cfdate."' and   '".$ctdate."'
                GROUP BY a.ledger_id";
        $query = mysql_query($sql);
        while($data = mysql_fetch_object($query)){
            $expense_amt2[$data->ledger_id] = $data->asset_amt;
        }
    }
    // ====== TABLE START ======
	
	
	 // Accomulated Ammotization
    $amotization = [];
    $sql = "SELECT a.ledger_id, SUM(j.dr_amt-j.cr_amt) AS asset_amt
            FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
            WHERE s.id=l.acc_sub_sub_class 
              AND l.group_id=a.ledger_group_id 
              AND a.ledger_id=j.ledger_id 
              AND j.jv_date <= '".$tdate."'
			  and s.acc_class!=4
            GROUP BY l.group_id";
    $query = mysql_query($sql);
    while($data = mysql_fetch_object($query)){
        $amotization = $data->asset_amt;
    }

    // Accomulated Ammotization
    $amotization2 = [];
    if($cfdate!='' && $ctdate!=''){
        $sql = "SELECT a.ledger_id, SUM(j.dr_amt-j.cr_amt) AS asset_amt
                FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
                WHERE s.id=l.acc_sub_sub_class 
                  AND l.group_id=a.ledger_group_id 
                  AND a.ledger_id=j.ledger_id 
				   and s.acc_class!=4
                  AND j.jv_date <='".$ctdate."'
                GROUP BY l.group_id";
        $query = mysql_query($sql);
        while($data = mysql_fetch_object($query)){
            $amotization2 = $data->asset_amt;
        }
    }
	
	
	// Accomulated Depreciation
    $depreciation = [];
    $sql = "SELECT a.ledger_id, SUM(j.dr_amt-j.cr_amt) AS asset_amt
            FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
            WHERE s.id=l.acc_sub_sub_class 
              AND l.group_id=a.ledger_group_id 
              AND a.ledger_id=j.ledger_id 
              AND j.jv_date <= '".$tdate."'
			  and s.acc_class!=4 and s.id=228
            ";
    $query = mysql_query($sql);
    while($data = mysql_fetch_object($query)){
        $depreciation = $data->asset_amt;
    }

    // Accomulated Depreciation
    $depreciation2 = [];
    if($cfdate!='' && $ctdate!=''){
        $sql = "SELECT a.ledger_id, SUM(j.dr_amt-j.cr_amt) AS asset_amt
                FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
                WHERE s.id=l.acc_sub_sub_class 
                  AND l.group_id=a.ledger_group_id 
                  AND a.ledger_id=j.ledger_id 
				   and s.acc_class!=4 
                  AND j.jv_date <='".$ctdate."' and s.id=228
                ";
        $query = mysql_query($sql);
        while($data = mysql_fetch_object($query)){
            $depreciation2 = $data->asset_amt;
        }
    }
	
	
	// Accomulated Depreciation addition
    $addition_depreciation = [];
    $sql = "SELECT a.ledger_id, SUM(j.dr_amt-j.cr_amt) AS asset_amt
            FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
            WHERE s.id=l.acc_sub_sub_class 
              AND l.group_id=a.ledger_group_id 
              AND a.ledger_id=j.ledger_id 
              AND j.jv_date between '".$fdate."' and '".$tdate."'
			  and s.acc_class!=4 and s.id=1119
            ";
    $query = mysql_query($sql);
    while($data = mysql_fetch_object($query)){
        $addition_depreciation = $data->asset_amt;
    }

    // Accomulated Depreciation addition
    $addition_depreciation2 = [];
    if($cfdate!='' && $ctdate!=''){
        $sql = "SELECT a.ledger_id, SUM(j.dr_amt-j.cr_amt) AS asset_amt
                FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
                WHERE s.id=l.acc_sub_sub_class 
                  AND l.group_id=a.ledger_group_id 
                  AND a.ledger_id=j.ledger_id 
				   and s.acc_class!=4 
                  AND j.jv_date between '".$cfdate."' and  '".$ctdate."' and s.id=1119
                ";
        $query = mysql_query($sql);
        while($data = mysql_fetch_object($query)){
            $addition_depreciation2 = $data->asset_amt;
        }
    }
	
	
	
	// sum of note 4
    $note4 = [];
    $sql = "SELECT s.id, SUM(j.dr_amt-j.cr_amt) AS asset_amt
            FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
            WHERE s.id=l.acc_sub_sub_class 
              AND l.group_id=a.ledger_group_id 
              AND a.ledger_id=j.ledger_id 
              AND j.jv_date <= '".$fdate."'
			  and s.acc_class!=4
            GROUP BY s.id";
    $query = mysql_query($sql);
    while($data = mysql_fetch_object($query)){
        $note4[$data->id] = $data->asset_amt;
    }

    // sum of note 4
    $note24 = [];
    if($cfdate!='' && $ctdate!=''){
        $sql = "SELECT s.id, SUM(j.dr_amt-j.cr_amt) AS asset_amt
                FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
                WHERE s.id=l.acc_sub_sub_class 
                  AND l.group_id=a.ledger_group_id 
                  AND a.ledger_id=j.ledger_id 
				   and s.acc_class!=4
                  AND j.jv_date <='".$cfdate."'
                GROUP BY s.id";
        $query = mysql_query($sql);
        while($data = mysql_fetch_object($query)){
            $note24[$data->id] = $data->asset_amt;
        }
    }
	
	
	// sum of note 8
    $note8 = [];
    $sql = "SELECT a.ledger_id, SUM(j.dr_amt-j.cr_amt) AS asset_amt
            FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
            WHERE s.id=l.acc_sub_sub_class 
              AND l.group_id=a.ledger_group_id 
              AND a.ledger_id=j.ledger_id 
              AND j.jv_date <= '".$tdate."'
			  and s.acc_class!=4 and s.notes=8
            GROUP BY a.ledger_id";
    $query = mysql_query($sql);
    while($data = mysql_fetch_object($query)){
        $note8[$data->ledger_id] = $data->asset_amt;
    }

    // sum of note 8
    $note28 = [];
    if($cfdate!='' && $ctdate!=''){
        $sql = "SELECT a.ledger_id, SUM(j.dr_amt-j.cr_amt) AS asset_amt
                FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
                WHERE s.id=l.acc_sub_sub_class 
                  AND l.group_id=a.ledger_group_id 
                  AND a.ledger_id=j.ledger_id 
				   and s.acc_class!=4 and s.notes=8
                  AND j.jv_date <='".$ctdate."'
                GROUP BY a.ledger_id";
        $query = mysql_query($sql);
        while($data = mysql_fetch_object($query)){
            $note28[$data->ledger_id] = $data->asset_amt;
        }
    }
	
	
	
	// sum of note 12
    $note12 = [];
    $sql = "SELECT a.ledger_id, SUM(j.dr_amt-j.cr_amt) AS asset_amt
            FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
            WHERE s.id=l.acc_sub_sub_class 
              AND l.group_id=a.ledger_group_id 
              AND a.ledger_id=j.ledger_id 
              AND j.jv_date <= '".$tdate."'
			  and s.acc_class!=4 and s.notes=12
            GROUP BY a.ledger_id";
    $query = mysql_query($sql);
    while($data = mysql_fetch_object($query)){
        $note12[$data->ledger_id] = $data->asset_amt;
    }

    // sum of note 12
    $note122 = [];
    if($cfdate!='' && $ctdate!=''){
        $sql = "SELECT a.ledger_id, SUM(j.dr_amt-j.cr_amt) AS asset_amt
                FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
                WHERE s.id=l.acc_sub_sub_class 
                  AND l.group_id=a.ledger_group_id 
                  AND a.ledger_id=j.ledger_id 
				   and s.acc_class!=4 and s.notes=12
                  AND j.jv_date <='".$ctdate."'
                GROUP BY a.ledger_id";
        $query = mysql_query($sql);
        while($data = mysql_fetch_object($query)){
            $note122[$data->ledger_id] = $data->asset_amt;
        }
    }
	
	
	
	
	// sum of note 7.1 details
    $note71details = [];
    $sql = "SELECT a.ledger_id, SUM(j.dr_amt-j.cr_amt) AS asset_amt
            FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
            WHERE s.id=l.acc_sub_sub_class 
              AND l.group_id=a.ledger_group_id 
              AND a.ledger_id=j.ledger_id 
              AND j.jv_date <= '".$tdate."'
			  and s.acc_class!=4 and a.ledger_group_id=121008
            GROUP BY a.ledger_id";
    $query = mysql_query($sql);
    while($data = mysql_fetch_object($query)){
        $note71details[$data->ledger_id] = $data->asset_amt;
    }

    // sum of note 7.1 details
    $note712details = [];
    if($cfdate!='' && $ctdate!=''){
        $sql = "SELECT a.ledger_id, SUM(j.dr_amt-j.cr_amt) AS asset_amt
                FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
                WHERE s.id=l.acc_sub_sub_class 
                  AND l.group_id=a.ledger_group_id 
                  AND a.ledger_id=j.ledger_id 
				   and s.acc_class!=4 and a.ledger_group_id=121008
                  AND j.jv_date <='".$ctdate."'
                GROUP BY a.ledger_id";
        $query = mysql_query($sql);
        while($data = mysql_fetch_object($query)){
            $note712details[$data->ledger_id] = $data->asset_amt;
        }
    }
	
	
	// sum of note 7.2 details
    $note72details = [];
    $sql = "SELECT a.ledger_id, SUM(j.dr_amt-j.cr_amt) AS asset_amt
            FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
            WHERE s.id=l.acc_sub_sub_class 
              AND l.group_id=a.ledger_group_id 
              AND a.ledger_id=j.ledger_id 
              AND j.jv_date <= '".$tdate."'
			  and s.acc_class!=4 and a.ledger_group_id=1220001
            GROUP BY a.ledger_id";
    $query = mysql_query($sql);
    while($data = mysql_fetch_object($query)){
        $note72details[$data->ledger_id] = $data->asset_amt;
    }

    // sum of note 7.2 details
    $note722details = [];
    if($cfdate!='' && $ctdate!=''){
        $sql = "SELECT a.ledger_id, SUM(j.dr_amt-j.cr_amt) AS asset_amt
                FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
                WHERE s.id=l.acc_sub_sub_class 
                  AND l.group_id=a.ledger_group_id 
                  AND a.ledger_id=j.ledger_id 
				   and s.acc_class!=4 and a.ledger_group_id=1220001
                  AND j.jv_date <='".$ctdate."'
                GROUP BY a.ledger_id";
        $query = mysql_query($sql);
        while($data = mysql_fetch_object($query)){
            $note722details[$data->ledger_id] = $data->asset_amt;
        }
    }
	
	
	
	
	// sum of note 8.1 details
    $note81details = [];
    $sql = "SELECT a.ledger_id, SUM(j.dr_amt-j.cr_amt) AS asset_amt
            FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
            WHERE s.id=l.acc_sub_sub_class 
              AND l.group_id=a.ledger_group_id 
              AND a.ledger_id=j.ledger_id 
              AND j.jv_date <= '".$tdate."'
			  and s.acc_class!=4 and a.ledger_group_id=1224001
            GROUP BY a.ledger_id";
    $query = mysql_query($sql);
    while($data = mysql_fetch_object($query)){
        $note81details[$data->ledger_id] = $data->asset_amt;
    }

    // sum of note 8.1 details
    $note812details = [];
    if($cfdate!='' && $ctdate!=''){
        $sql = "SELECT a.ledger_id, SUM(j.dr_amt-j.cr_amt) AS asset_amt
                FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
                WHERE s.id=l.acc_sub_sub_class 
                  AND l.group_id=a.ledger_group_id 
                  AND a.ledger_id=j.ledger_id 
				   and s.acc_class!=4 and a.ledger_group_id=1224001
                  AND j.jv_date <='".$ctdate."'
                GROUP BY a.ledger_id";
        $query = mysql_query($sql);
        while($data = mysql_fetch_object($query)){
            $note812details[$data->ledger_id] = $data->asset_amt;
        }
    }
	
	
	
	
	// sum of note 6.1 details
    $note61details = [];
    $sql = "SELECT a.ledger_id, SUM(j.dr_amt-j.cr_amt) AS asset_amt
            FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
            WHERE s.id=l.acc_sub_sub_class 
              AND l.group_id=a.ledger_group_id 
              AND a.ledger_id=j.ledger_id 
              AND j.jv_date <= '".$tdate."'
			  and s.acc_class!=4 and s.notes=29
            GROUP BY a.ledger_id";
    $query = mysql_query($sql);
    while($data = mysql_fetch_object($query)){
        $note61details[$data->ledger_id] = $data->asset_amt;
    }

    // sum of note 6.1 details
    $note612details = [];
    if($cfdate!='' && $ctdate!=''){
        $sql = "SELECT a.ledger_id, SUM(j.dr_amt-j.cr_amt) AS asset_amt
                FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
                WHERE s.id=l.acc_sub_sub_class 
                  AND l.group_id=a.ledger_group_id 
                  AND a.ledger_id=j.ledger_id 
				   and s.acc_class!=4 and s.notes=29
                  AND j.jv_date <='".$ctdate."'
                GROUP BY a.ledger_id";
        $query = mysql_query($sql);
        while($data = mysql_fetch_object($query)){
            $note612details[$data->ledger_id] = $data->asset_amt;
        }
    }
	
	
	
	// sum of note 8.1
    $cash_at_bank = [];
    $sql = "SELECT s.id, SUM(j.dr_amt-j.cr_amt) AS asset_amt
            FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
            WHERE s.id=l.acc_sub_sub_class 
              AND l.group_id=a.ledger_group_id 
              AND a.ledger_id=j.ledger_id 
              AND j.jv_date <= '".$tdate."'
			  and s.acc_class!=4
			  and l.group_id=1224001
            GROUP BY l.group_id";
    $query = mysql_query($sql);
    while($data = mysql_fetch_object($query)){
        $cash_at_bank = $data->asset_amt;
    }

    // sum of note 8.1
    $cash_at_bank2 = [];
    if($cfdate!='' && $ctdate!=''){
        $sql = "SELECT s.id, SUM(j.dr_amt-j.cr_amt) AS asset_amt
                FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
                WHERE s.id=l.acc_sub_sub_class 
                  AND l.group_id=a.ledger_group_id 
                  AND a.ledger_id=j.ledger_id 
				   and s.acc_class!=4
                  AND j.jv_date <='".$ctdate."'
				  and l.group_id=1224001
                GROUP BY l.group_id";
        $query = mysql_query($sql);
        while($data = mysql_fetch_object($query)){
            $cash_at_bank2 = $data->asset_amt;
        }
    }
	
	
	
	// sum of note 7.1
    $note7 = [];
    $sql = "SELECT s.id, SUM(j.dr_amt-j.cr_amt) AS asset_amt
            FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
            WHERE s.id=l.acc_sub_sub_class 
              AND l.group_id=a.ledger_group_id 
              AND a.ledger_id=j.ledger_id 
              AND j.jv_date <= '".$tdate."'
			  and s.acc_class!=4
			  and l.group_id=121008
            GROUP BY l.group_id";
    $query = mysql_query($sql);
    while($data = mysql_fetch_object($query)){
        $note7 = $data->asset_amt;
    }

    // sum of note 7.1
    $note27 = [];
    if($cfdate!='' && $ctdate!=''){
        $sql = "SELECT s.id, SUM(j.dr_amt-j.cr_amt) AS asset_amt
                FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
                WHERE s.id=l.acc_sub_sub_class 
                  AND l.group_id=a.ledger_group_id 
                  AND a.ledger_id=j.ledger_id 
				   and s.acc_class!=4
                  AND j.jv_date <='".$ctdate."'
				  and l.group_id=121008
                GROUP BY l.group_id";
        $query = mysql_query($sql);
        while($data = mysql_fetch_object($query)){
            $note27 = $data->asset_amt;
        }
    }
	
	
	// sum of note 7.2
    $note72 = [];
    $sql = "SELECT s.id, SUM(j.dr_amt-j.cr_amt) AS asset_amt
            FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
            WHERE s.id=l.acc_sub_sub_class 
              AND l.group_id=a.ledger_group_id 
              AND a.ledger_id=j.ledger_id 
              AND j.jv_date <= '".$tdate."'
			  and s.acc_class!=4
			  and l.group_id=1220001
            GROUP BY l.group_id";
    $query = mysql_query($sql);
    while($data = mysql_fetch_object($query)){
        $note72 = $data->asset_amt;
    }

    // sum of note 7.2
    $note272 = [];
    if($cfdate!='' && $ctdate!=''){
        $sql = "SELECT s.id, SUM(j.dr_amt-j.cr_amt) AS asset_amt
                FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
                WHERE s.id=l.acc_sub_sub_class 
                  AND l.group_id=a.ledger_group_id 
                  AND a.ledger_id=j.ledger_id 
				   and s.acc_class!=4
                  AND j.jv_date <='".$ctdate."'
				  and l.group_id=1220001
                GROUP BY l.group_id";
        $query = mysql_query($sql);
        while($data = mysql_fetch_object($query)){
            $note272 = $data->asset_amt;
        }
    }
?>
<div id="grp">
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <thead>
    <tr>
      <th width="10%" rowspan="2" bgcolor="#82D8CF" style="color:#000000; text-align:center;">Notes</th>
      <th width="40%" rowspan="2" bgcolor="#82D8CF" style="color:#000000;">&nbsp; Particular</th>
      <th width="25%" bgcolor="#82D8CF" style="color:#000000;"><div align="center">Amount In Taka</div></th>
      <th width="25%" bgcolor="#82D8CF" <?php echo $show_compa;?> style="color:#000000;"><div align="center">Amount In Taka</div></th>
    </tr>
    <tr>
      <th bgcolor="#82D8CF" style="color:#000000;"><div align="center"><?=date("d M' y",strtotime($_REQUEST['tdate']))?></div></th>
      <th width="22%" bgcolor="#82D8CF" <?php echo $show_compa;?> style="color:#000000;"><div align="center"><?=date("d M' y",strtotime($_REQUEST['ctdate']))?></div></th>
    </tr>
  </thead>

<?php


$sql_sub1 = "SELECT s.id, s.sub_sub_class_name, s.notes FROM acc_sub_sub_class s,accounts_notes n where s.notes=n.id and 1 and  s.notes=3 ORDER BY n.order_no asc";
$query_sub1 = mysql_query($sql_sub1);

while($info_sub1 = mysql_fetch_object($query_sub1)) { 

    

    
    $ledger_rows = ''; 

    
        $cost = isset($asset_amtnote3[$info_sub1->id]) ? $asset_amtnote3[$info_sub1->id] : 0;
        $cost2 = isset($asset_amtnote32[$info_sub1->id]) ? $asset_amtnote32[$info_sub1->id] : 0;

		$addition = isset($asset_amtperiodnote3[$info_sub1->id]) ? $asset_amtperiodnote3[$info_sub1->id] : 0;
        $addition2 = isset($asset_amtperiodnote32[$info_sub1->id]) ? $asset_amtperiodnote32[$info_sub1->id] : 0;
       
            $ledger_rows .= '
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cost: </td>
                <td align="right">'.number_format(round(abs($cost))).'</td>
                <td align="right" '.$show_compa.'>'.number_format(round(abs($cost2))).'</td>
              </tr>';

	   	 $ledger_rows .= '
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Addition: </td>
                <td align="right">'.number_format(round(abs($addition))).'</td>
                <td align="right" '.$show_compa.'>'.number_format(round(abs($addition2))).'</td>
              </tr>';
  
        echo '
        <tr>
          <td bgcolor="#E0FFFF" align="center">'.find_a_field('accounts_notes','name','id='.$info_sub1->notes).'</td>
          <td bgcolor="#E0FFFF">&nbsp; <strong>'.$info_sub1->sub_sub_class_name.'</strong></td>
          <td bgcolor="#E0FFFF" align="right"></td>
          <td bgcolor="#E0FFFF" align="right" '.$show_compa.'></td>
        </tr>';

        echo $ledger_rows;

        echo '
        <tr>
          <td>&nbsp;</td>
          <td align="left"><strong>Less: Accumulated Amortization
</strong></td>
          <td align="right"><strong>'.number_format(round(abs($amotization))).'</strong></td>
          <td align="right" '.$show_compa.'><strong>'.number_format(round(abs($amotization2))).'</strong></td>
        </tr>';
        
  
}
?>

  <!-- ===== GRAND TOTAL ===== -->
  <tr style="background:#d9f9d9;">
    <td colspan="2" align="right"><strong>Sub Total :</strong></td>
    <td align="right"><strong><?=number_format(round(abs($t_amotization = $cost + $addition + $amotization)))?></strong></td>
    <td align="right" <?php echo $show_compa;?>><strong><?=number_format(round($t_amotization2=$cost2+$addition2+$amotization2))?></strong></td>
  </tr>
  
  
<?php
$property=0;
$property2=0;
$sql_sub1 = "SELECT s.id, s.sub_sub_class_name, s.notes FROM acc_sub_sub_class s,accounts_notes n where s.notes=n.id and 1 and  s.notes=4 ORDER BY n.order_no asc";
$query_sub1 = mysql_query($sql_sub1);

while($info_sub1 = mysql_fetch_object($query_sub1)) { 

    
		echo '
        <tr>
          <td bgcolor="#E0FFFF" align="center">'.find_a_field('accounts_notes','name','id='.$info_sub1->notes).'</td>
          <td bgcolor="#E0FFFF">&nbsp; <strong>'.$info_sub1->sub_sub_class_name.'</strong></td>
          <td bgcolor="#E0FFFF" align="right"></td>
          <td bgcolor="#E0FFFF" align="right" '.$show_compa.'></td>
        </tr>';

        
		

		echo '
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cost:</td>
                <td align="right">'.number_format(round(abs($note4[$info_sub1->id]))).'</td>
                <td align="right" '.$show_compa.'>'.number_format(round(abs($note24[$info_sub1->id]))).'</td>
              </tr>';
			 
            echo '  <tr>
                <td>&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Addition:</td>
                <td align="right">'.number_format(round(abs($addition_depreciation))).'</td>
                <td align="right" '.$show_compa.'>'.number_format(round(abs($addition_depreciation2))).'</td>
              </tr>';
			  
			echo ' 
			  <tr>
				<td>&nbsp;</td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Less: Accumulated Depreciation</td>
				<td align="right">'.
				  ($depreciation < 0 ? '(' .number_format(round(abs($depreciation))). ')' : number_format(round(abs($depreciation))))
				.'</td>
				<td align="right" '.$show_compa.'>'.
				  ($depreciation2 < 0 ? '(' .number_format(round(abs($depreciation2))). ')' : number_format(round(abs($depreciation2))))
				.'</td>
			  </tr>';

			  $note=$note4[$info_sub1->id];
			   $note2=$note24[$info_sub1->id];
   
}

$property = floatval($note) + floatval($addition_depreciation) - floatval($depreciation*(-1));
$property2 = floatval($note2) + floatval($addition_depreciation2) - floatval($depreciation2*(-1));



?>

  <!-- ===== GRAND TOTAL ===== -->
  <tr style="background:#d9f9d9;">
    <td colspan="2" align="right"><strong>Sub Total :</strong></td>
    <td align="right"><strong><? //$property=$note+$addition_depreciation+$depreciation;
echo number_format(round(abs($property))); ?></strong></td>
    <td align="right" <?php echo $show_compa; ?>><strong><? 
	  echo number_format(round(abs($property2))); ?></strong></td>
  </tr>



<?php
$grand_total  = 0;
$grand_total2 = 0;

$sql_sub1 = "SELECT s.id, s.sub_sub_class_name, s.notes FROM acc_sub_sub_class s,accounts_notes n where s.notes=n.id and 1 and  s.acc_class!=4 and s.notes  in (5,6) ORDER BY n.order_no asc";
$query_sub1 = mysql_query($sql_sub1);

while($info_sub1 = mysql_fetch_object($query_sub1)) { 

    $sql1 = "SELECT ledger_id, ledger_name 
             FROM accounts_ledger 
             WHERE acc_sub_sub_class='".$info_sub1->id."' 
             ORDER BY ledger_id";
    $query1 = mysql_query($sql1);

    $tot_asset_amt  = 0;
    $tot_asset_amt2 = 0;
    $ledger_rows = ''; // collect only nonzero ledgers

    while($data1 = mysql_fetch_object($query1)) { 
        $val1 = isset($asset_amt[$data1->ledger_id]) ? $asset_amt[$data1->ledger_id] : 0;
        $val2 = isset($asset_amt2[$data1->ledger_id]) ? $asset_amt2[$data1->ledger_id] : 0;

        if($val1 != 0 || $val2 != 0) {
            $ledger_rows .= '
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$data1->ledger_name.'</td>
                <td align="right">' .number_format(round(abs($val1))).'</td>
                <td align="right" '.$show_compa.'>'.number_format(round(abs($val2))).'</td>
              </tr>';

            $tot_asset_amt  += $val1;
            $tot_asset_amt2 += $val2;
        }
    }

    // Show only if subtotal not zero
    if($tot_asset_amt != 0 || $tot_asset_amt2 != 0) {
        echo '
        <tr>
          <td bgcolor="#E0FFFF" align="center">'.find_a_field('accounts_notes','name','id='.$info_sub1->notes).'</td>
          <td bgcolor="#E0FFFF">&nbsp; <strong>'.$info_sub1->sub_sub_class_name.'</strong></td>
          <td bgcolor="#E0FFFF" align="right"></td>
          <td bgcolor="#E0FFFF" align="right" '.$show_compa.'></td>
        </tr>';

        echo $ledger_rows;

        echo '
        <tr>
          <td>&nbsp;</td>
          <td align="right"><strong>Subtotal:</strong></td>
          <td align="right"><strong>'. number_format(round(abs($tot_asset_amt))).'</strong></td>
          <td align="right" '.$show_compa.'><strong>'.number_format(round(abs($tot_asset_amt2))).'</strong></td>
        </tr>';
        
        $grand_total  += $tot_asset_amt;
        $grand_total2 += $tot_asset_amt2;
    }
}
?>


<?
 $sql_sub12 = "SELECT s.id, s.sub_sub_class_name, s.notes FROM acc_sub_sub_class s,accounts_notes n where s.notes=n.id and 1 and  s.notes=29 ORDER BY n.order_no asc";
$query_sub12 = mysql_query($sql_sub12);

while($info_sub12 = mysql_fetch_object($query_sub12)) { 

    echo '
    <tr>
      <td bgcolor="#E0FFFF" align="center">'.find_a_field('accounts_notes','name','id='.$info_sub12->notes).'</td>
      <td bgcolor="#E0FFFF">&nbsp; <strong>'.$info_sub12->sub_sub_class_name.' Receivable</strong></td>
      <td bgcolor="#E0FFFF" align="right"></td>
      <td bgcolor="#E0FFFF" align="right" '.$show_compa.'></td>
    </tr>';

    $sql122 = "SELECT ledger_id, ledger_name 
               FROM accounts_ledger 
               WHERE acc_sub_sub_class='".$info_sub12->id."' 
               ORDER BY ledger_id";
    $query122 = mysql_query($sql122);

    $ledger_rows = '';
	$tot_asset_amt12  = 0;
    $tot_asset_amt122 = 0;
    while($data122 = mysql_fetch_object($query122)) { 
	 $val1 = isset($note61details[$data122->ledger_id]) ? $note61details[$data122->ledger_id] : 0;
	  $val2 = isset($note612details[$data122->ledger_id]) ? $note612details[$data122->ledger_id] : 0;
	  
	   if($val1> 0 || $val2 > 0) {
        $ledger_rows .= '
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$data122->ledger_name.'</td>
            <td align="right">' .number_format(round(abs($val1))).'</td>
            <td align="right" '.$show_compa.'>'.number_format(round(abs($val2))).'</td>
          </tr>';
		  
		   $tot_asset_amt12  += $val1;
            $tot_asset_amt122 += $val2;
		  }
    }

    echo $ledger_rows; 
}





?>

  <!-- ===== GRAND TOTAL ===== -->
  <tr style="background:#d9f9d9;">
    <td colspan="2" align="right"><strong>Sub Total :</strong></td>
    <td align="right"><strong><?
echo number_format(round(abs($tot_note71details+$tot_asset_amt12))); ?></strong></td>
    <td align="right" <?php echo $show_compa;?>><strong><? 
	  echo number_format(round(abs($tot_note712details+$tot_asset_amt122)));  ?></strong></td>
  </tr>

  
  
  <?php
  
  // note 7
$property=0;
$property2=0;
$sql_sub1 = "SELECT s.id, s.sub_sub_class_name, s.notes FROM acc_sub_sub_class s,accounts_notes n where s.notes=n.id and 1 and  s.notes=7 ORDER BY n.order_no asc";
$query_sub1 = mysql_query($sql_sub1);

while($info_sub1 = mysql_fetch_object($query_sub1)) { 

    
		echo '
        <tr>
          <td bgcolor="#E0FFFF" align="center">'.find_a_field('accounts_notes','name','id='.$info_sub1->notes).'</td>
          <td bgcolor="#E0FFFF">&nbsp; <strong>'.$info_sub1->sub_sub_class_name.'</strong></td>
          <td bgcolor="#E0FFFF" align="right"></td>
          <td bgcolor="#E0FFFF" align="right" '.$show_compa.'></td>
        </tr>';

      }  
		

		echo '
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Advance Paid to Party  Note-7.01</td>
                <td align="right">'. number_format(round(abs($note7))).'</td>
                <td align="right" '.$show_compa.'>'. number_format(round(abs($note27))).'</td>
              </tr>';
			 
            echo '  <tr>
                <td>&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Advance Paid  to Staff
 Note-7.02</td>
                <td align="right">'. number_format(round(abs($note72))).'</td>
                <td align="right" '.$show_compa.'>'  . number_format(round(abs($note272))).'</td>
              </tr>';
			  
			echo '  <tr>
                <td>&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Advance Income Tax Note-7.03</td>
                <td align="right"></td>
                <td align="right" '.$show_compa.'></td>
              </tr>';
			  
   


$advanc_party = floatval($note7) + floatval($note72);
$advanc_party2 = floatval($note27) + floatval($note272);



?>

  <!-- ===== GRAND TOTAL ===== -->
  <tr style="background:#d9f9d9;">
    <td colspan="2" align="right"><strong>Sub Total :</strong></td>
    <td align="right"><strong><?
echo number_format(round(abs($advanc_party))); ?></strong></td>
    <td align="right" <?php echo $show_compa;?>><strong><? 
	  echo number_format(round(abs($advanc_party2))) ?></strong></td>
  </tr>

   <?php
  
  
    echo '
    <tr>
      <td bgcolor="#E0FFFF" align="center">Note-7.01</td>
      <td bgcolor="#E0FFFF">&nbsp; <strong>Advance Paid to Party</strong></td>
      <td bgcolor="#E0FFFF" align="right"></td>
      <td bgcolor="#E0FFFF" align="right" '.$show_compa.'></td>
    </tr>';

  $sql122 = "SELECT ledger_id, ledger_name 
           FROM accounts_ledger 
           WHERE ledger_group_id = 121008 
           ORDER BY ledger_id";

$query122 = mysql_query($sql122);

$ledger_rows = '';
$tot_note71details  = 0;
$tot_note712details = 0;

while ($data122 = mysql_fetch_object($query122)) { 
    $val1 = isset($note71details[$data122->ledger_id]) ? $note71details[$data122->ledger_id] : 0;
    $val2 = isset($note712details[$data122->ledger_id]) ? $note712details[$data122->ledger_id] : 0;
  
    if ($val1 != 0 || $val2 != 0) {
        $ledger_rows .= '
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $data122->ledger_name . '</td>
            <td align="right">' . number_format(round(abs($val1))).'</td>
            <td align="right" ' . $show_compa . '>' . number_format(round(abs($val2))) . '</td>
          </tr>';
      
        $tot_note71details  += $val1;
        $tot_note712details += $val2;
    }
}

echo $ledger_rows;






$sql_sub12 = "SELECT s.id, s.sub_sub_class_name, s.notes FROM acc_sub_sub_class s,accounts_notes n where s.notes=n.id and 1 and  s.notes=12 ORDER BY n.order_no asc";
$query_sub12 = mysql_query($sql_sub12);

while($info_sub12 = mysql_fetch_object($query_sub12)) { 

   

    $sql122 = "SELECT ledger_id, ledger_name 
               FROM accounts_ledger 
               WHERE acc_sub_sub_class='".$info_sub12->id."' 
               ORDER BY ledger_id";
    $query122 = mysql_query($sql122);

    $ledger_rows = '';
	$tot_asset_amt12  = 0;
    $tot_asset_amt122 = 0;
    while($data122 = mysql_fetch_object($query122)) { 
	 $val1 = isset($note12[$data122->ledger_id]) ? $note12[$data122->ledger_id] : 0;
	  $val2 = isset($note122[$data122->ledger_id]) ? $note122[$data122->ledger_id] : 0;
	  
	   if($val1 > 0 || $val2 > 0) {
        $ledger_rows .= '
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Advance Paid to '.$data122->ledger_name.'</td>
            <td align="right">'. number_format(round(abs($val1))).'</td>
            <td align="right" '.number_format(round(abs($val2))).'</td>
          </tr>';
		  
		   $tot_asset_amt12  += $val1;
            $tot_asset_amt122 += $val2;
		  }
    }

    echo $ledger_rows; 
}





?>

  <!-- ===== GRAND TOTAL ===== -->
  <tr style="background:#d9f9d9;">
    <td colspan="2" align="right"><strong>Sub Total :</strong></td>
    <td align="right"><strong><?
echo number_format(round(abs($tot_note71details+$tot_asset_amt12)));  ?></strong></td>
    <td align="right" <?php echo $show_compa;?>><strong><? 
	  echo  number_format(round(abs($tot_note712details+$tot_asset_amt122))); ?></strong></td>
  </tr>
  
  
  



 
  
  
  
  
   <?php
  
  
    echo '
    <tr>
      <td bgcolor="#E0FFFF" align="center">Note-7.02</td>
      <td bgcolor="#E0FFFF">&nbsp; <strong>Advance Paid to Staff </strong></td>
      <td bgcolor="#E0FFFF" align="right"></td>
      <td bgcolor="#E0FFFF" align="right" '.$show_compa.'></td>
    </tr>';

  $sql122 = "SELECT ledger_id, ledger_name 
           FROM accounts_ledger 
           WHERE ledger_group_id = 1220001 
           ORDER BY ledger_id";

$query122 = mysql_query($sql122);

$ledger_rows = '';
$tot_note72details  = 0;
$tot_note722details = 0;

while ($data122 = mysql_fetch_object($query122)) { 
    $val1 = isset($note72details[$data122->ledger_id]) ? $note72details[$data122->ledger_id] : 0;
    $val2 = isset($note722details[$data122->ledger_id]) ? $note722details[$data122->ledger_id] : 0;
  
    if ($val1 != 0 || $val2 != 0) {
        $ledger_rows .= '
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $data122->ledger_name . '</td>
            <td align="right">' .  number_format(round(abs($val1))) . '</td>
            <td align="right" ' . $show_compa . '>' . number_format(round(abs($val2))). '</td>
          </tr>';
      
        $tot_note72details  += $val1;
        $tot_note722details += $val2;
    }
}

echo $ledger_rows;

?>

  <!-- ===== GRAND TOTAL ===== -->
  <tr style="background:#d9f9d9;">
    <td colspan="2" align="right"><strong>Sub Total :</strong></td>
    <td align="right"><strong><?
echo number_format(round(abs($tot_note72details))) ?></strong></td>
    <td align="right" <?php echo $show_compa;?>><strong><? 
	  echo number_format(round(abs($tot_note722details)))?></strong></td>
  </tr>
  

  
  
   <?php
  
  // note 8
//$property=0;
//$property2=0;
$sql_sub12 = "SELECT s.id, s.sub_sub_class_name, s.notes FROM acc_sub_sub_class s,accounts_notes n where s.notes=n.id and 1 and  s.notes=8 ORDER BY n.order_no asc";
$query_sub12 = mysql_query($sql_sub12);

while($info_sub12 = mysql_fetch_object($query_sub12)) { 

    echo '
    <tr>
      <td bgcolor="#E0FFFF" align="center">'.find_a_field('accounts_notes','name','id='.$info_sub12->notes).'</td>
      <td bgcolor="#E0FFFF">&nbsp; <strong>'.$info_sub12->sub_sub_class_name.'</strong></td>
      <td bgcolor="#E0FFFF" align="right"></td>
      <td bgcolor="#E0FFFF" align="right" '.$show_compa.'></td>
    </tr>';

    $sql122 = "SELECT ledger_id, ledger_name 
               FROM accounts_ledger 
               WHERE acc_sub_sub_class='".$info_sub12->id."' 
               ORDER BY ledger_id";
    $query122 = mysql_query($sql122);

    $ledger_rows = '';
	$tot_asset_amt  = 0;
    $tot_asset_amt2 = 0;
    while($data122 = mysql_fetch_object($query122)) { 
	 $val1 = isset($note8[$data122->ledger_id]) ? $note8[$data122->ledger_id] : 0;
	  $val2 = isset($note28[$data122->ledger_id]) ? $note28[$data122->ledger_id] : 0;
	  
	   if($val1 != 0 || $val2 != 0) {
        $ledger_rows .= '
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$data122->ledger_name.'</td>
            <td align="right">' .number_format(round(abs($val1))).'</td>
            <td align="right" '.$show_compa.'>'.number_format(round(abs($val2))).'</td>
          </tr>';
		  
		   $tot_asset_amt8  += $val1;
            $tot_asset_amt28 += $val2;
		  }
    }

    echo $ledger_rows; 
}

			  
			echo '  <tr>
                <td>&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cash At Bank  Note-8.01</td>
                <td align="right">' .number_format(round(abs($cash_at_bank))).'</td>
                <td align="right" '.$show_compa.'>'.number_format(round(abs($cash_at_bank2))).'</td>
              </tr>';
			  
   


$casn_bank = floatval($tot_asset_amt8) + floatval($cash_at_bank);
$casn_bank2 = floatval($tot_asset_amt28) + floatval($cash_at_bank2);



?>

  <!-- ===== GRAND TOTAL ===== -->
  <tr style="background:#d9f9d9;">
    <td colspan="2" align="right"><strong>Sub Total :</strong></td>
    <td align="right"><strong><?
echo number_format(round(abs($casn_bank))); ?></strong></td>
    <td align="right" <?php echo $show_compa;?>><strong><? 
	  echo number_format(round(abs($casn_bank2))); ?></strong></td>
  </tr>
  
  
    <?php
  
  
    echo '
    <tr>
      <td bgcolor="#E0FFFF" align="center">Note-8.01</td>
      <td bgcolor="#E0FFFF">&nbsp; <strong>Cash At Bank</strong></td>
      <td bgcolor="#E0FFFF" align="right"></td>
      <td bgcolor="#E0FFFF" align="right" '.$show_compa.'></td>
    </tr>';

  $sql122 = "SELECT ledger_id, ledger_name 
           FROM accounts_ledger 
           WHERE ledger_group_id = 1224001 
           ORDER BY ledger_id";

$query122 = mysql_query($sql122);

$ledger_rows = '';
$tot_note81details  = 0;
$tot_note812details = 0;

while ($data122 = mysql_fetch_object($query122)) { 
    $val1 = isset($note81details[$data122->ledger_id]) ? $note81details[$data122->ledger_id] : 0;
    $val2 = isset($note812details[$data122->ledger_id]) ? $note812details[$data122->ledger_id] : 0;
  
    if ($val1 != 0 || $val2 != 0) {
        $ledger_rows .= '
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $data122->ledger_name . '</td>
            <td align="right">' . number_format(round(abs($val1))) . '</td>
            <td align="right" ' . $show_compa . '>' . number_format(round(abs($val2))) . '</td>
          </tr>';
      
        $tot_note81details  += $val1;
        $tot_note812details += $val2;
    }
}

echo $ledger_rows;



?>

  <!-- ===== GRAND TOTAL ===== -->
  <tr style="background:#d9f9d9;">
    <td colspan="2" align="right"><strong>Sub Total :</strong></td>
    <td align="right"><strong><?
echo   number_format(round(abs($tot_note81details))); ?></strong></td>
    <td align="right" <?php echo $show_compa;?>><strong><? 
	  echo number_format(round(abs($tot_note812details))); ?></strong></td>
  </tr>
  
  
  <?php
$grand_total  = 0;
$grand_total2 = 0;

$sql_sub1 = "SELECT s.id, s.sub_sub_class_name, s.notes FROM acc_sub_sub_class s,accounts_notes n where s.notes=n.id and 1 and  s.acc_class!=4 and s.notes  in (9) ORDER BY n.order_no asc";
$query_sub1 = mysql_query($sql_sub1);

while($info_sub1 = mysql_fetch_object($query_sub1)) { 

    $sql1 = "SELECT ledger_id, ledger_name 
             FROM accounts_ledger 
             WHERE acc_sub_sub_class='".$info_sub1->id."' 
             ORDER BY ledger_id";
    $query1 = mysql_query($sql1);

    $tot_asset_amt123  = 0;
    $tot_asset_amt1232 = 0;
    $ledger_rows = ''; // collect only nonzero ledgers

    while($data1 = mysql_fetch_object($query1)) { 
        $val1 = isset($asset_amt[$data1->ledger_id]) ? $asset_amt[$data1->ledger_id] : 0;
        $val2 = isset($asset_amt2[$data1->ledger_id]) ? $asset_amt2[$data1->ledger_id] : 0;

        if($val1 != 0 || $val2 != 0) {
            $ledger_rows .= '
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$data1->ledger_name.'</td>
                <td align="right">'. number_format(round(abs($val1))).'</td>
                <td align="right" '.$show_compa.'>'. number_format(round(abs($val2))).'</td>
              </tr>';

            $tot_asset_amt123  += $val1;
            $tot_asset_amt1232 += $val2;
			
			
			
        }
    }
	
    // Show only if subtotal not zero
    if($tot_asset_amt123 != 0 || $tot_asset_amt1232 != 0) {
        echo '
        <tr>
          <td bgcolor="#E0FFFF" align="center">'.find_a_field('accounts_notes','name','id='.$info_sub1->notes).'</td>
          <td bgcolor="#E0FFFF">&nbsp; <strong>'.$info_sub1->sub_sub_class_name.'</strong></td>
          <td bgcolor="#E0FFFF" align="right"></td>
          <td bgcolor="#E0FFFF" align="right" '.$show_compa.'></td>
        </tr>';

        echo $ledger_rows;
		

        echo '
        <tr>
          <td>&nbsp;</td>
          <td align="right"><strong>Subtotal:</strong></td>
          <td align="right"><strong>'.  number_format(round(abs($tot_asset_amt123))).'</strong></td>
          <td align="right" '.$show_compa.'><strong>'. number_format(round(abs($tot_asset_amt1232))).'</strong></td>
        </tr>';
        
        $grand_total123  += $tot_asset_amt123;
        $grand_total1232 += $tot_asset_amt1232;
    }
}
?>


<?php

$sql = "SELECT l.acc_sub_sub_class, SUM(j.cr_amt - j.dr_amt) AS sales_amt 
        FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
        WHERE s.id = l.acc_sub_sub_class 
          AND l.group_id = a.ledger_group_id 
          AND a.ledger_id = j.ledger_id 
          AND j.jv_date BETWEEN '".$fdate."' AND '".$tdate."' 
          AND a.acc_class = 3 
          AND s.id = 311  
        GROUP BY l.acc_sub_sub_class";
$query = mysql_query($sql);
while ($data = mysql_fetch_object($query)) {
    $sales_amt[$data->acc_sub_sub_class] = $data->sales_amt;
}

$sql = "SELECT l.acc_sub_sub_class, SUM(j.cr_amt - j.dr_amt) AS sales_amt 
        FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
        WHERE s.id = l.acc_sub_sub_class 
          AND l.group_id = a.ledger_group_id 
          AND a.ledger_id = j.ledger_id 
          AND j.jv_date BETWEEN '".$cfdate."' AND '".$ctdate."' 
          AND a.acc_class = 3 
          AND s.id = 311  
        GROUP BY l.acc_sub_sub_class";
$query = mysql_query($sql);
while ($data = mysql_fetch_object($query)) {
    $sales_amt2[$data->acc_sub_sub_class] = $data->sales_amt;
}

$sql = "SELECT l.acc_sub_sub_class, SUM(j.dr_amt - j.cr_amt) AS expenses_amt 
        FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
        WHERE s.id = l.acc_sub_sub_class 
          AND l.group_id = a.ledger_group_id 
          AND a.ledger_id = j.ledger_id 
          AND j.jv_date BETWEEN '".$fdate."' AND '".$tdate."' 
          AND a.acc_class = 4 
          AND s.id IN (417,418) 
        GROUP BY l.acc_sub_sub_class";
$query = mysql_query($sql);
while ($data = mysql_fetch_object($query)) {
    $expenses_amt[$data->acc_sub_sub_class] = $data->expenses_amt;
}

$sql = "SELECT l.acc_sub_sub_class, SUM(j.dr_amt - j.cr_amt) AS expenses_amt 
        FROM acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
        WHERE s.id = l.acc_sub_sub_class 
          AND l.group_id = a.ledger_group_id 
          AND a.ledger_id = j.ledger_id 
          AND j.jv_date BETWEEN '".$cfdate."' AND '".$ctdate."' 
          AND a.acc_class = 4 
          AND s.id IN (417,418) 
        GROUP BY l.acc_sub_sub_class";
$query = mysql_query($sql);
while ($data = mysql_fetch_object($query)) {
    $expenses_amt2[$data->acc_sub_sub_class] = $data->expenses_amt;
}

$sql_sub1 = "SELECT s.id, s.sub_class_name 
             FROM acc_sub_class s 
             WHERE s.acc_class = 3 
             GROUP BY s.id";
$query_sub1 = mysql_query($sql_sub1);

while ($info_sub1 = mysql_fetch_object($query_sub1)) {

    $sql1 = "SELECT ss.id, ss.sub_sub_class_name 
             FROM acc_sub_sub_class ss 
             WHERE ss.acc_sub_class = '".$info_sub1->id."' 
               AND ss.id NOT IN (312,313) 
             ORDER BY ss.id";
    $query1 = mysql_query($sql1);

    while ($data1 = mysql_fetch_object($query1)) {
        $pi++;
        $sl = $pi;

        $tot_sales_amt += $sales_amt[$data1->id];
        $tot_sales_amt2 += $sales_amt2[$data1->id];

        $cost_service = find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j',
            'SUM(j.dr_amt - j.cr_amt)',
            's.id = l.acc_sub_sub_class AND l.group_id = a.ledger_group_id AND a.ledger_id = j.ledger_id AND j.jv_date BETWEEN "'.$fdate.'" AND "'.$tdate.'" AND a.acc_class = 4 AND s.id = 4113 GROUP BY l.acc_sub_sub_class');
        $tot_exp_amt += $cost_service;

        $cost_service2 = find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j',
            'SUM(j.dr_amt - j.cr_amt)',
            's.id = l.acc_sub_sub_class AND l.group_id = a.ledger_group_id AND a.ledger_id = j.ledger_id AND j.jv_date BETWEEN "'.$cfdate.'" AND "'.$ctdate.'" AND a.acc_class = 4 AND s.id = 4113 GROUP BY l.acc_sub_sub_class');
        $tot_exp_amt2 += $cost_service2;
    }

    $gross_p_l = $tot_sales_amt - $cost_service;
    $gross_p_l2 = $tot_sales_amt2 - $cost_service2;
}

$sql_sub2 = "SELECT s.id, s.sub_class_name 
             FROM acc_sub_class s 
             WHERE s.acc_class = 4 
             GROUP BY s.id";
$query_sub2 = mysql_query($sql_sub2);

while ($info_sub2 = mysql_fetch_object($query_sub2)) {

    $sql2 = "SELECT ss.id, ss.sub_sub_class_name 
             FROM acc_sub_sub_class ss 
             WHERE ss.id IN (417,418)  
             ORDER BY ss.id";
    $query2 = mysql_query($sql2);

    while ($data2 = mysql_fetch_object($query2)) {
        $pi++;
        $sl = $pi;
        $tot_expenses_amt += $expenses_amt[$data2->id];
        $tot_expenses_amt2 += $expenses_amt2[$data2->id];
    }

    $operating_p_l = $gross_p_l - $tot_expenses_amt;
    $operating_p_l2 = $gross_p_l2 - $tot_expenses_amt2;
}

$non_op_income = find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j',
    'SUM(j.cr_amt - j.dr_amt)',
    's.id = l.acc_sub_sub_class AND l.group_id = a.ledger_group_id AND a.ledger_id = j.ledger_id AND j.jv_date BETWEEN "'.$fdate.'" AND "'.$tdate.'" AND a.acc_class = 3 AND s.id = 312 GROUP BY l.acc_sub_sub_class');
$non_op_income2 = find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j',
    'SUM(j.cr_amt - j.dr_amt)',
    's.id = l.acc_sub_sub_class AND l.group_id = a.ledger_group_id AND a.ledger_id = j.ledger_id AND j.jv_date BETWEEN "'.$cfdate.'" AND "'.$ctdate.'" AND a.acc_class = 3 AND s.id = 312 GROUP BY l.acc_sub_sub_class');

$non_op_expense = find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j',
    'SUM(j.dr_amt - j.cr_amt)',
    's.id = l.acc_sub_sub_class AND l.group_id = a.ledger_group_id AND a.ledger_id = j.ledger_id AND j.jv_date BETWEEN "'.$fdate.'" AND "'.$tdate.'" AND a.acc_class = 4 AND s.id = 412 GROUP BY l.acc_sub_sub_class');
$non_op_expense2 = find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j',
    'SUM(j.dr_amt - j.cr_amt)',
    's.id = l.acc_sub_sub_class AND l.group_id = a.ledger_group_id AND a.ledger_id = j.ledger_id AND j.jv_date BETWEEN "'.$cfdate.'" AND "'.$ctdate.'" AND a.acc_class = 4 AND s.id = 412 GROUP BY l.acc_sub_sub_class');

$ebit = $operating_p_l + $non_op_income - $non_op_expense;
$ebit2 = $operating_p_l2 + $non_op_income2 - $non_op_expense2;

$fin_expense = find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j',
    'SUM(j.dr_amt - j.cr_amt)',
    's.id = l.acc_sub_sub_class AND l.group_id = a.ledger_group_id AND a.ledger_id = j.ledger_id AND j.jv_date BETWEEN "'.$fdate.'" AND "'.$tdate.'" AND a.acc_class = 4 AND s.id = 4111 GROUP BY l.acc_sub_sub_class');
$fin_expense2 = find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j',
    'SUM(j.dr_amt - j.cr_amt)',
    's.id = l.acc_sub_sub_class AND l.group_id = a.ledger_group_id AND a.ledger_id = j.ledger_id AND j.jv_date BETWEEN "'.$cfdate.'" AND "'.$ctdate.'" AND a.acc_class = 4 AND s.id = 4111 GROUP BY l.acc_sub_sub_class');

$ebt = $ebit - $fin_expense;
$ebt2 = $ebit2 - $fin_expense2;

$def_tax_expense = find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j',
    'SUM(j.dr_amt - j.cr_amt)',
    's.id = l.acc_sub_sub_class AND l.group_id = a.ledger_group_id AND a.ledger_id = j.ledger_id AND j.jv_date BETWEEN "'.$fdate.'" AND "'.$tdate.'" AND a.acc_class = 4 AND s.id = 4117 GROUP BY l.acc_sub_sub_class');
$def_tax_expense2 = find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j',
    'SUM(j.dr_amt - j.cr_amt)',
    's.id = l.acc_sub_sub_class AND l.group_id = a.ledger_group_id AND a.ledger_id = j.ledger_id AND j.jv_date BETWEEN "'.$cfdate.'" AND "'.$ctdate.'" AND a.acc_class = 4 AND s.id = 4117 GROUP BY l.acc_sub_sub_class');

$current_tax_expense = find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j',
    'SUM(j.dr_amt - j.cr_amt)',
    's.id = l.acc_sub_sub_class AND l.group_id = a.ledger_group_id AND a.ledger_id = j.ledger_id AND j.jv_date BETWEEN "'.$fdate.'" AND "'.$tdate.'" AND a.acc_class = 4 AND s.id = 4116 GROUP BY l.acc_sub_sub_class');
$current_tax_expense2 = find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j',
    'SUM(j.dr_amt - j.cr_amt)',
    's.id = l.acc_sub_sub_class AND l.group_id = a.ledger_group_id AND a.ledger_id = j.ledger_id AND j.jv_date BETWEEN "'.$cfdate.'" AND "'.$ctdate.'" AND a.acc_class = 4 AND s.id = 4116 GROUP BY l.acc_sub_sub_class');

$def_tax_income = find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j',
    'SUM(j.dr_amt - j.cr_amt)',
    's.id = l.acc_sub_sub_class AND l.group_id = a.ledger_group_id AND a.ledger_id = j.ledger_id AND j.jv_date BETWEEN "'.$fdate.'" AND "'.$tdate.'" AND a.acc_class = 3 AND s.id = 313 GROUP BY l.acc_sub_sub_class');
$def_tax_income2 = find_a_field('acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j',
    'SUM(j.dr_amt - j.cr_amt)',
    's.id = l.acc_sub_sub_class AND l.group_id = a.ledger_group_id AND a.ledger_id = j.ledger_id AND j.jv_date BETWEEN "'.$cfdate.'" AND "'.$ctdate.'" AND a.acc_class = 3 AND s.id = 313 GROUP BY l.acc_sub_sub_class');

$def_expense_income = $def_tax_expense + $current_tax_expense - $def_tax_income;
$def_expense_income2 = $def_tax_expense2 + $current_tax_expense2 - $def_tax_income2;

$p_l_after_tax = $ebt - $def_expense_income;
$p_l_after_tax2 = $ebt2 - $def_expense_income2;

$yearly_income = $p_l_after_tax;
$yearly_income2 = $p_l_after_tax2;

?>


<?

//Return Earning 
		
		$sql = "select a.acc_class, sum(j.cr_amt-j.dr_amt) as sales_amt 
 from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j 
 where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date<'".$fdate."' and a.acc_class=3 group by a.acc_class";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
 $sales_amt[$data->acc_class]=$data->sales_amt;
}

 $sql = "select a.acc_class, sum(j.dr_amt-j.cr_amt) as exp_amt 
from acc_sub_sub_class s, ledger_group l, accounts_ledger a, journal j
 where s.id=l.acc_sub_sub_class and l.group_id=a.ledger_group_id and a.ledger_id=j.ledger_id and  j.jv_date<'".$fdate."' and a.acc_class=4 group by a.acc_class";
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
 $exp_amt[$data->acc_class]=$data->exp_amt;
}


$retained_earnings=$sales_amt[3]-$exp_amt[4];
 $net_retained_earnings=$retained_earnings;
 
 
  $tot_cr_balance = 0;
    $tot_dr_balance = 0;
    $tot_cr_opening = 0;
    $tot_dr_opening = 0;
    $tot_dr_closing = 0;
    $tot_cr_closing = 0;

    $sub_tot_opeing_dr = $sub_tot_opeing_cr = $sub_tot_dr_balance = $sub_tot_cr_balance = $sub_tot_closing_dr = $sub_tot_closing_cr = 0;

    // Fetching opening balances
    $gg = "SELECT SUM(b.dr_amt - b.cr_amt) AS opening, b.ledger_id FROM accounts_ledger a, journal b,ledger_group g WHERE a.ledger_group_id = g.group_id AND g.group_class NOT IN (3000, 4000) and a.ledger_id = b.ledger_id AND b.jv_date < '$fdate' GROUP BY a.ledger_id";
    $ggs = mysql_query($gg);
    while ($gs = mysql_fetch_object($ggs)) {
        $opening_balnace[$gs->ledger_id] = $gs->opening;
    }

    // Fetching debit and credit balances
    $balnce = "SELECT SUM(b.dr_amt) AS debit, SUM(b.cr_amt) AS credit, b.ledger_id FROM accounts_ledger a, journal b WHERE a.ledger_id = b.ledger_id AND b.jv_date BETWEEN '$fdate' AND '$tdate' GROUP BY a.ledger_id";
    $bal_query = mysql_query($balnce);
    while ($bal = mysql_fetch_object($bal_query)) {
        $dr_balnace[$bal->ledger_id] = $bal->debit;
        $cr_balnace[$bal->ledger_id] = $bal->credit;
    }

    
?>

<?php


        $p2 = "SELECT DISTINCT a.ledger_name, a.ledger_id FROM accounts_ledger a, ledger_group g WHERE a.ledger_group_id = g.group_id  AND a.ledger_group_id = 216001 ".$group_con.$sub_con." GROUP BY a.ledger_id ORDER BY a.ledger_name";
        $sql = mysql_query($p2);
        $pi = 1;

        while ($p = mysql_fetch_object($sql)) {
            $dr_opening = $cr_opening = $dr_closing = $cr_closing = 0;

            $closing = ($opening_balnace[$p->ledger_id] + $dr_balnace[$p->ledger_id]) - $cr_balnace[$p->ledger_id];
			
			if($cr_balnace[$p->ledger_id]!=0 || $dr_balnace[$p->ledger_id]!=0 || $closing!=0 )
			{
			
			

?>
			
				
            
                <?php  $opening_balnace[$p->ledger_id] > 0 ? number_format($dr_opening = $opening_balnace[$p->ledger_id], 2) : ''; ?>
                <?php  $opening_balnace[$p->ledger_id] < 0 ? number_format($cr_opening = $opening_balnace[$p->ledger_id] * -1, 2) : ''; ?>
             
                <?php  $closing > 0 ? number_format($dr_closing = $closing, 2) : ''; ?>
                <?php  $closing < 0 ? number_format($cr_closing = $closing * -1, 2) : ''; ?>
            
			<?
			if($p->ledger_id==2160010001){
			
			?>
			 
               <? if($net_retained_earnings<0) { echo $return_opening=$net_retained_earnings+$closing*(-1);} ?>
                <? if($net_retained_earnings>0) { echo $return_opening=$net_retained_earnings+$closing;} ?>
                
                <? if($net_retained_earnings<0) { echo $return_opening=$net_retained_earnings+$closing*(-1);} ?>
                <? if($net_retained_earnings>0) { echo $return_opening=$net_retained_earnings+$closing;} ?>
           
			
			
			<?
			}

           // Subtotals for each group
		   
		   	if($p->ledger_id==2160010001 && $net_retained_earnings<0)
			{
            $tot_dr_opening += $dr_opening-$net_retained_earnings;
			}
			else
			{
			$tot_dr_opening += $dr_opening;
			}
			
			if($p->ledger_id==2160010001 && $net_retained_earnings>0)
			{
			
            $tot_cr_opening += $cr_opening-$net_retained_earnings;
			
			}
			else
			{
			
			$tot_cr_opening += $cr_opening;
			}
            $tot_dr_balance += $dr_balnace[$p->ledger_id];
            $tot_cr_balance += $cr_balnace[$p->ledger_id];
			
			if($p->ledger_id==2160010001 && $net_retained_earnings<0)
			{
			
            $tot_dr_closing += $dr_closing-$net_retained_earnings;
			}
			else
			{
			$tot_dr_closing += $dr_closing;
			
			}
			
			if($p->ledger_id==2160010001 && $net_retained_earnings>0)
			{
            $tot_cr_closing += $cr_closing-$net_retained_earnings;
			}
			else
			{
			
			$tot_cr_closing += $cr_closing;
			}
			
			}
        }
		
		
?>


<?

								  

$sql_sub1 = "SELECT s.id, s.sub_sub_class_name, s.notes FROM acc_sub_sub_class s,accounts_notes n where s.notes=n.id and 1 and  s.acc_class!=4 and s.notes  in (10) ORDER BY n.order_no asc";
$query_sub1 = mysql_query($sql_sub1);

while($info_sub1 = mysql_fetch_object($query_sub1)) { 

    $sql1 = "SELECT ledger_id, ledger_name 
             FROM accounts_ledger 
             WHERE acc_sub_sub_class='".$info_sub1->id."' 
             ORDER BY ledger_id";
    $query1 = mysql_query($sql1);

    $tot_asset_amt123  = 0;
    $tot_asset_amt1232 = 0;
    $ledger_rows = ''; // collect only nonzero ledgers
		
			  
    while($data1 = mysql_fetch_object($query1)) { 
        $val1 = isset($asset_amt10[$data1->ledger_id]) ? $asset_amt10[$data1->ledger_id] : 0;
        $val2 = isset($asset_amt210[$data1->ledger_id]) ? $asset_amt210[$data1->ledger_id] : 0;

        if($return_opening != 0 ) {
            $ledger_rows .= '
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp Opening Balance
</td>
                <td align="right">'. "(" . number_format(round(abs($return_opening))) . ")" .'</td>
                <td align="right" '.$show_compa.'>'. "(" . number_format(round(abs($return_opening))) . ")" .'</td>
              </tr>';
			
            $tot_asset_amt123  += $return_opening;
            $tot_asset_amt1232 += $return_opening;
			
			
			
        }
    }
	
	$ledger_rows .= '
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp Profit or Loss during the period
</td>
                <td align="right">'. number_format(round(abs($yearly_income))).'</td>
                <td align="right" '.$show_compa.'>'.number_format(round(abs($yearly_income2))).'</td>
              </tr>';
	 
    // Show only if subtotal not zero
    if($tot_asset_amt123 != 0 || $tot_asset_amt1232 != 0) {
        echo '
        <tr>
          <td bgcolor="#E0FFFF" align="center">'.find_a_field('accounts_notes','name','id='.$info_sub1->notes).'</td>
          <td bgcolor="#E0FFFF">&nbsp; <strong>'.$info_sub1->sub_sub_class_name.'</strong></td>
          <td bgcolor="#E0FFFF" align="right"></td>
          <td bgcolor="#E0FFFF" align="right" '.$show_compa.'></td>
        </tr>';

        echo $ledger_rows;
		

        echo '
        <tr>
          <td>&nbsp;</td>
          <td align="right"><strong>Subtotal:</strong></td>
          <td align="right"><strong>'.  "(" . number_format(round(abs($tot_asset_amt1231=$tot_asset_amt123+$yearly_income))) . ")" .'</strong></td>
          <td align="right" '.$show_compa.'><strong>'.  "(" . number_format(round(abs($tot_asset_amt12322=$tot_asset_amt1232+$yearly_income2))) . ")" .'</strong></td>
        </tr>';
        
        $grand_total123  += $tot_asset_amt123;
        $grand_total1232 += $tot_asset_amt1232;
    }
}
?>
 
 
 
  <?php
$grand_total  = 0;
$grand_total2 = 0;

$sql_sub1 = "SELECT s.id, s.sub_sub_class_name, s.notes FROM acc_sub_sub_class s,accounts_notes n where s.notes=n.id and 1 and  s.acc_class!=4 and s.notes  in (11) ORDER BY n.order_no asc";
$query_sub1 = mysql_query($sql_sub1);

while($info_sub1 = mysql_fetch_object($query_sub1)) { 

    $sql1 = "SELECT ledger_id, ledger_name 
             FROM accounts_ledger 
             WHERE acc_sub_sub_class='".$info_sub1->id."' 
             ORDER BY ledger_id";
    $query1 = mysql_query($sql1);

    $tot_asset_amt123  = 0;
    $tot_asset_amt1232 = 0;
    $ledger_rows = ''; // collect only nonzero ledgers

    while($data1 = mysql_fetch_object($query1)) { 
        $val1 = isset($asset_amt[$data1->ledger_id]) ? $asset_amt[$data1->ledger_id] : 0;
        $val2 = isset($asset_amt2[$data1->ledger_id]) ? $asset_amt2[$data1->ledger_id] : 0;

        if($val1 != 0 || $val2 != 0) {
            $ledger_rows .= '
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$data1->ledger_name.'</td>
                <td align="right">'. number_format(round(abs($val1))).'</td>
                <td align="right" '.$show_compa.'>'. number_format(round(abs($val2))).'</td>
              </tr>';

            $tot_asset_amt123  += $val1;
            $tot_asset_amt1232 += $val2;
			
			
			
        }
    }
	
    // Show only if subtotal not zero
    if($tot_asset_amt123 != 0 || $tot_asset_amt1232 != 0) {
        echo '
        <tr>
          <td bgcolor="#E0FFFF" align="center">'.find_a_field('accounts_notes','name','id='.$info_sub1->notes).'</td>
          <td bgcolor="#E0FFFF">&nbsp; <strong>'.$info_sub1->sub_sub_class_name.'</strong></td>
          <td bgcolor="#E0FFFF" align="right"></td>
          <td bgcolor="#E0FFFF" align="right" '.$show_compa.'></td>
        </tr>';

        echo $ledger_rows;
		

        echo '
        <tr>
          <td>&nbsp;</td>
          <td align="right"><strong>Subtotal:</strong></td>
          <td align="right"><strong>'. number_format(round(abs($tot_asset_amt123))).'</strong></td>
          <td align="right" '.$show_compa.'><strong>'. number_format(round(abs($tot_asset_amt1232))). '</strong></td>
        </tr>';
        
        $grand_total123  += $tot_asset_amt123;
        $grand_total1232 += $tot_asset_amt1232;
    }
}
?>

 
 

    <?php
$grand_total  = 0;
$grand_total2 = 0;

$sql_sub1 = "SELECT s.id, s.sub_sub_class_name, s.notes FROM acc_sub_sub_class s,accounts_notes n where s.notes=n.id and 1 and  s.acc_class!=4 and s.notes  in (12) ORDER BY n.order_no asc";
$query_sub1 = mysql_query($sql_sub1);

while($info_sub1 = mysql_fetch_object($query_sub1)) { 

    $sql1 = "SELECT ledger_id, ledger_name 
             FROM accounts_ledger 
             WHERE acc_sub_sub_class='".$info_sub1->id."' 
             ORDER BY ledger_id";
    $query1 = mysql_query($sql1);

    $tot_asset_amt123  = 0;
    $tot_asset_amt1232 = 0;
    $ledger_rows = ''; // collect only nonzero ledgers

    while($data1 = mysql_fetch_object($query1)) { 
        $val1 = isset($asset_amt[$data1->ledger_id]) ? $asset_amt[$data1->ledger_id] : 0;
        $val2 = isset($asset_amt2[$data1->ledger_id]) ? $asset_amt2[$data1->ledger_id] : 0;

        if($val1 < 0 || $val2 < 0) {
            $ledger_rows .= '
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$data1->ledger_name.'</td>
                <td align="right">'. number_format(round(abs($val1))).'</td>
                <td align="right" '.$show_compa.'>'.number_format(round(abs($val2))).'</td>
              </tr>';

            $tot_asset_amt123  += $val1;
            $tot_asset_amt1232 += $val2;
        }
    }

    // Show only if subtotal not zero
    if($tot_asset_amt123 != 0 || $tot_asset_amt1232 != 0) {
        echo '
        <tr>
          <td bgcolor="#E0FFFF" align="center">'.find_a_field('accounts_notes','name','id='.$info_sub1->notes).'</td>
          <td bgcolor="#E0FFFF">&nbsp; <strong>'.$info_sub1->sub_sub_class_name.'</strong></td>
          <td bgcolor="#E0FFFF" align="right"></td>
          <td bgcolor="#E0FFFF" align="right" '.$show_compa.'></td>
        </tr>';

        echo $ledger_rows;

        echo '
        <tr>
          <td>&nbsp;</td>
          <td align="right"><strong>Subtotal:</strong></td>
          <td align="right"><strong>'. number_format(round(abs($tot_asset_amt123))).'</strong></td>
          <td align="right" '.$show_compa.'><strong>'. number_format(round(abs($tot_asset_amt1232))) .'</strong></td>
        </tr>';
        
        $grand_total123  += $tot_asset_amt123;
        $grand_total1232 += $tot_asset_amt1232;
    }
}
?>

 <?php
$grand_total  = 0;
$grand_total2 = 0;

$sql_sub1 = "SELECT s.id, s.sub_sub_class_name, s.notes FROM acc_sub_sub_class s,accounts_notes n where s.notes=n.id and 1 and  s.acc_class!=4 and s.notes  in (33) ORDER BY n.order_no asc";
$query_sub1 = mysql_query($sql_sub1);

while($info_sub1 = mysql_fetch_object($query_sub1)) { 

    $sql1 = "SELECT ledger_id, ledger_name 
             FROM accounts_ledger 
             WHERE acc_sub_sub_class='".$info_sub1->id."' 
             ORDER BY ledger_id";
    $query1 = mysql_query($sql1);

    $tot_asset_amt123  = 0;
    $tot_asset_amt1232 = 0;
    $ledger_rows = ''; // collect only nonzero ledgers

    while($data1 = mysql_fetch_object($query1)) { 
        $val1 = isset($asset_amt[$data1->ledger_id]) ? $asset_amt[$data1->ledger_id] : 0;
        $val2 = isset($asset_amt2[$data1->ledger_id]) ? $asset_amt2[$data1->ledger_id] : 0;

        if($val1 < 0 || $val2 < 0) {
            $ledger_rows .= '
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$data1->ledger_name.'</td>
                <td align="right">'. number_format(round(abs($val1))).'</td>
                <td align="right" '.$show_compa.'>'.number_format(round(abs($val2))).'</td>
              </tr>';

            $tot_asset_amt123  += $val1;
            $tot_asset_amt1232 += $val2;
        }
    }

    // Show only if subtotal not zero
    if($tot_asset_amt123 != 0 || $tot_asset_amt1232 != 0) {
        echo '
        <tr>
          <td bgcolor="#E0FFFF" align="center">'.find_a_field('accounts_notes','name','id='.$info_sub1->notes).'</td>
          <td bgcolor="#E0FFFF">&nbsp; <strong>'.$info_sub1->sub_sub_class_name.'</strong></td>
          <td bgcolor="#E0FFFF" align="right"></td>
          <td bgcolor="#E0FFFF" align="right" '.$show_compa.'></td>
        </tr>';

        echo $ledger_rows;

        echo '
        <tr>
          <td>&nbsp;</td>
          <td align="right"><strong>Subtotal:</strong></td>
          <td align="right"><strong>'. number_format(round(abs($tot_asset_amt123))).'</strong></td>
          <td align="right" '.$show_compa.'><strong>'.number_format(round(abs($tot_asset_amt1232))).'</strong></td>
        </tr>';
        
        $grand_total123  += $tot_asset_amt123;
        $grand_total1232 += $tot_asset_amt1232;
    }
}
?>
 
 <?
 $sql_sub12 = "SELECT s.id, s.sub_sub_class_name, s.notes FROM acc_sub_sub_class s,accounts_notes n where s.notes=n.id and 1 and  s.notes=29 ORDER BY n.order_no asc";
$query_sub12 = mysql_query($sql_sub12);

while($info_sub12 = mysql_fetch_object($query_sub12)) { 

    echo '
    <tr>
      <td bgcolor="#E0FFFF" align="center">NOTE-13.00</td>
      <td bgcolor="#E0FFFF">&nbsp; <strong>'.$info_sub12->sub_sub_class_name.' Payable</strong></td>
      <td bgcolor="#E0FFFF" align="right"></td>
      <td bgcolor="#E0FFFF" align="right" '.$show_compa.'></td>
    </tr>';

    $sql122 = "SELECT ledger_id, ledger_name 
               FROM accounts_ledger 
               WHERE acc_sub_sub_class='".$info_sub12->id."' 
               ORDER BY ledger_id";
    $query122 = mysql_query($sql122);

    $ledger_rows = '';
	$tot_asset_amt12  = 0;
    $tot_asset_amt122 = 0;
    while($data122 = mysql_fetch_object($query122)) { 
	 $val1 = isset($note61details[$data122->ledger_id]) ? $note61details[$data122->ledger_id] : 0;
	  $val2 = isset($note612details[$data122->ledger_id]) ? $note612details[$data122->ledger_id] : 0;
	  
	   if($val1< 0 || $val2 < 0) {
        $ledger_rows .= '
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$data122->ledger_name.'</td>
            <td align="right">'. number_format(round(abs($val1))).'</td>
            <td align="right" '.$show_compa.'>'. number_format(round(abs($val2))).'</td>
          </tr>';
		  
		   $tot_asset_amt12  += $val1;
            $tot_asset_amt122 += $val2;
		  }
    }

    echo $ledger_rows; 
}





?>

  <!-- ===== GRAND TOTAL ===== -->
  <tr style="background:#d9f9d9;">
    <td colspan="2" align="right"><strong>Sub Total :</strong></td>
    <td align="right"><strong><?
echo  number_format(round(abs($tot_asset_amt12))); ?></strong></td>
    <td align="right" <?php echo $show_compa;?>><strong><? 
	  echo number_format(round(abs($tot_asset_amt122))); ?></strong></td>
  </tr>

 
 
  <?php
$grand_total  = 0;
$grand_total2 = 0;

$sql_sub1 = "SELECT s.id, s.sub_sub_class_name, s.notes FROM acc_sub_sub_class s,accounts_notes n where s.notes=n.id and 1 and  s.acc_class!=4 and s.notes  in (26,27,14,15) ORDER BY n.order_no asc";
$query_sub1 = mysql_query($sql_sub1);

while($info_sub1 = mysql_fetch_object($query_sub1)) { 

    $sql1 = "SELECT ledger_id, ledger_name 
             FROM accounts_ledger 
             WHERE acc_sub_sub_class='".$info_sub1->id."' 
             ORDER BY ledger_id";
    $query1 = mysql_query($sql1);

    $tot_asset_amt123  = 0;
    $tot_asset_amt1232 = 0;
    $ledger_rows = ''; // collect only nonzero ledgers

    while($data1 = mysql_fetch_object($query1)) { 
        $val1 = isset($asset_amt[$data1->ledger_id]) ? $asset_amt[$data1->ledger_id] : 0;
        $val2 = isset($asset_amt2[$data1->ledger_id]) ? $asset_amt2[$data1->ledger_id] : 0;

        if($val1 != 0 || $val2 != 0) {
            $ledger_rows .= '
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$data1->ledger_name.'</td>
                <td align="right">'.number_format(round(abs($val1))) .'</td>
                <td align="right" '.$show_compa.'>'.number_format(round(abs($val2))).'</td>
              </tr>';

            $tot_asset_amt123  += $val1;
            $tot_asset_amt1232 += $val2;
        }
    }

    // Show only if subtotal not zero
    if($tot_asset_amt123 != 0 || $tot_asset_amt1232 != 0) {
        echo '
        <tr>
          <td bgcolor="#E0FFFF" align="center">'.find_a_field('accounts_notes','name','id='.$info_sub1->notes).'</td>
          <td bgcolor="#E0FFFF">&nbsp; <strong>'.$info_sub1->sub_sub_class_name.'</strong></td>
          <td bgcolor="#E0FFFF" align="right"></td>
          <td bgcolor="#E0FFFF" align="right" '.$show_compa.'></td>
        </tr>';

        echo $ledger_rows;

        echo '
        <tr>
          <td>&nbsp;</td>
          <td align="right"><strong>Subtotal:</strong></td>
          <td align="right"><strong>'. number_format(round(abs($tot_asset_amt123))).'</strong></td>
          <td align="right" '.$show_compa.'><strong>'. number_format(round(abs($tot_asset_amt1232))).'</strong></td>
        </tr>';
        
        $grand_total123  += $tot_asset_amt123;
        $grand_total1232 += $tot_asset_amt1232;
    }
}
?>

 
<?php
$grand_total  = 0;
$grand_total2 = 0;

$sql_sub2 = "SELECT s.id, s.sub_sub_class_name, s.notes FROM acc_sub_sub_class s,accounts_notes n where s.notes=n.id and 1 and s.acc_class=4 and s.notes in (16,17,18) ORDER BY n.order_no asc";
$query_sub2 = mysql_query($sql_sub2);

while($info_sub2 = mysql_fetch_object($query_sub2)) { 

    $sql12 = "SELECT ledger_id, ledger_name 
             FROM accounts_ledger 
             WHERE acc_sub_sub_class='".$info_sub2->id."' 
             ORDER BY ledger_id";
    $query12 = mysql_query($sql12);

    $tot_expense_amt  = 0;
    $tot_expense_amt2 = 0;
    $ledger_rowss = ''; // collect only nonzero ledgers

    while($data2 = mysql_fetch_object($query12)) { 
        $val12 = isset($expense_amt[$data2->ledger_id]) ? $expense_amt[$data2->ledger_id] : 0;
         $val2222 = isset($expense_amt2[$data2->ledger_id]) ? $expense_amt2[$data2->ledger_id] : 0;

       if($val12 != 0 || $val2222 != 0) {
            $ledger_rowss .= '
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$data2->ledger_name.'</td>
                <td align="right">'. number_format(round(abs($val12))).'</td>
                <td align="right" '.$show_compa.'>'. number_format(round(abs($val2222))).'</td>
              </tr>';

            $tot_expense_amt  += $val12;
            $tot_expense_amt2 += $val2222;
        }
    }

    // Show only if subtotal not zero
  //if($tot_expense_amt != 0 || $tot_expense_amt2 != 0) {
        echo '
        <tr>
          <td bgcolor="#E0FFFF" align="center">'.find_a_field('accounts_notes','name','id='.$info_sub2->notes).'</td>
          <td bgcolor="#E0FFFF">&nbsp; <strong>'.$info_sub2->sub_sub_class_name.'</strong></td>
          <td bgcolor="#E0FFFF" align="right"></td>
          <td bgcolor="#E0FFFF" align="right" '.$show_compa.'></td>
        </tr>';

        echo $ledger_rowss;

        echo '
        <tr>
          <td>&nbsp;</td>
          <td align="right"><strong>Subtotal:</strong></td>
          <td align="right"><strong>'.number_format(round(abs($tot_expense_amt))) .'</strong></td>
          <td align="right" '.$show_compa.'><strong>'.number_format(round(abs($tot_expense_amt2))).'</strong></td>
        </tr>';
        
        $grand_total2  += $tot_expense_amt;
        $grand_total22 += $tot_expense_amt2;
    //}
}
?>

  <!-- ===== GRAND TOTAL ===== -->
  <tr style="background:#d9f9d9;">
    <td colspan="2" align="right"><strong>Sub  Total :</strong></td>
    <td align="right"><strong><?= number_format(round(abs($grand_total2)));?></strong></td>
    <td align="right" <?php echo $show_compa;?>><strong><?=number_format(round(abs($grand_total22)));?></strong></td>
  </tr>



 <?php
$grand_total  = 0;
$grand_total2 = 0;

$sql_sub1 = "SELECT s.id, s.sub_sub_class_name, s.notes FROM acc_sub_sub_class s,accounts_notes n where s.notes=n.id and 1 and  s.acc_class!=4 and s.notes  in (19) ORDER BY n.order_no asc";
$query_sub1 = mysql_query($sql_sub1);

while($info_sub1 = mysql_fetch_object($query_sub1)) { 

    $sql1 = "SELECT ledger_id, ledger_name 
             FROM accounts_ledger 
             WHERE acc_sub_sub_class='".$info_sub1->id."' 
             ORDER BY ledger_id";
    $query1 = mysql_query($sql1);

    $tot_asset_amt123  = 0;
    $tot_asset_amt1232 = 0;
    $ledger_rows = ''; // collect only nonzero ledgers

    while($data1 = mysql_fetch_object($query1)) { 
        $val1 = isset($asset_amt[$data1->ledger_id]) ? $asset_amt[$data1->ledger_id] : 0;
        $val2 = isset($asset_amt2[$data1->ledger_id]) ? $asset_amt2[$data1->ledger_id] : 0;

        if($val1 != 0 || $val2 != 0) {
            $ledger_rows .= '
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$data1->ledger_name.'</td>
                <td align="right">'. number_format(round(abs($val1))).'</td>
                <td align="right" '.$show_compa.'>'.number_format(round(abs($val2))).'</td>
              </tr>';

            $tot_asset_amt123  += $val1;
            $tot_asset_amt1232 += $val2;
        }
    }

    // Show only if subtotal not zero
    if($tot_asset_amt123 != 0 || $tot_asset_amt1232 != 0) {
        echo '
        <tr>
          <td bgcolor="#E0FFFF" align="center">'.find_a_field('accounts_notes','name','id='.$info_sub1->notes).'</td>
          <td bgcolor="#E0FFFF">&nbsp; <strong>'.$info_sub1->sub_sub_class_name.'</strong></td>
          <td bgcolor="#E0FFFF" align="right"></td>
          <td bgcolor="#E0FFFF" align="right" '.$show_compa.'></td>
        </tr>';

        echo $ledger_rows;

        echo '
        <tr>
          <td>&nbsp;</td>
          <td align="right"><strong>Subtotal:</strong></td>
          <td align="right"><strong>'. number_format(round(abs($tot_asset_amt123))).'</strong></td>
          <td align="right" '.$show_compa.'><strong>'. number_format(round(abs($tot_asset_amt1232))).'</strong></td>
        </tr>';
        
        $grand_total123  += $tot_asset_amt123;
        $grand_total1232 += $tot_asset_amt1232;
    }
}
?>
<?php
$grand_total  = 0;
$grand_total2 = 0;

$sql_sub2 = "SELECT s.id, s.sub_sub_class_name, s.notes FROM acc_sub_sub_class s,accounts_notes n where s.notes=n.id and 1 and s.acc_class=4 and s.notes not in (16,17,18) ORDER BY n.order_no asc";
$query_sub2 = mysql_query($sql_sub2);

while($info_sub2 = mysql_fetch_object($query_sub2)) { 

    $sql12 = "SELECT ledger_id, ledger_name 
             FROM accounts_ledger 
             WHERE acc_sub_sub_class='".$info_sub2->id."' 
             ORDER BY ledger_id";
    $query12 = mysql_query($sql12);

    $tot_expense_amt  = 0;
    $tot_expense_amt2 = 0;
    $ledger_rowss = ''; // collect only nonzero ledgers

    while($data2 = mysql_fetch_object($query12)) { 
        $val12 = isset($expense_amt[$data2->ledger_id]) ? $expense_amt[$data2->ledger_id] : 0;
        $val22x = isset($expense_amt2[$data2->ledger_id]) ? $expense_amt2[$data2->ledger_id] : 0;

        if($val12 != 0 || $val22x != 0) {
            $ledger_rowss .= '
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$data2->ledger_name.'</td>
                <td align="right">'.number_format(round(abs($val12))).'</td>
                <td align="right" '.$show_compa.'>'. number_format(round(abs($val22x))).'</td>
              </tr>';

            $tot_expense_amt  += $val12;
            $tot_expense_amt2 += $val22x;
        }
    }

    // Show only if subtotal not zero
  //if($tot_expense_amt != 0 || $tot_expense_amt2 != 0) {
        echo '
        <tr>
          <td bgcolor="#E0FFFF" align="center">'.find_a_field('accounts_notes','name','id='.$info_sub2->notes).'</td>
          <td bgcolor="#E0FFFF">&nbsp; <strong>'.$info_sub2->sub_sub_class_name.'</strong></td>
          <td bgcolor="#E0FFFF" align="right"></td>
          <td bgcolor="#E0FFFF" align="right" '.$show_compa.'></td>
        </tr>';

        echo $ledger_rowss;

        echo '
        <tr>
          <td>&nbsp;</td>
          <td align="right"><strong>Subtotal:</strong></td>
          <td align="right"><strong>'.  number_format(round(abs($tot_expense_amt))).'</strong></td>
          <td align="right" '.$show_compa.'><strong>'. number_format(round(abs($tot_expense_amt2))).'</strong></td>
        </tr>';
        
        $grand_total2  += $tot_expense_amt;
        $grand_total22 += $tot_expense_amt2;
    //}
}
?>

  <!-- ===== GRAND TOTAL ===== -->
  <tr style="background:#d9f9d9;">
    <td colspan="2" align="right"><strong>Sub  Total :</strong></td>
    <td align="right"><strong><?= number_format(round(abs($grand_total2)))?></strong></td>
    <td align="right" <?php echo $show_compa;?>><strong><?= number_format(round(abs($grand_total22)))?></strong></td>
  </tr>


</table>

<table style="width:100%; border:none; border-collapse:collapse; margin-top:100px; background-color:transparent;">
  <tr>
    <td style="text-align:left; text-decoration:overline; background-color:transparent; border:none;"  >Prepared By</td>
    <td style="text-align:center; text-decoration:overline; background-color:transparent; border:none;">Checked By</td>
    <td style="text-align:right; text-decoration:overline; background-color:transparent; border:none;">CFO</td>
    <td style="text-align:center; text-decoration:overline; background-color:transparent; border:none;">DMD-Operation</td>
    <td style="text-align:center; text-decoration:overline; background-color:transparent; border:none;">DMD-Admin</td>
    <td style="text-align:right; text-decoration:overline; background-color:transparent; border:none;">MD/Chairman</td>
  </tr>
</table>

</div>

<?php
} // end if show
?>
            </div>
          </td>
        </tr>
      </table>
    </div>
  </td>
</tr>







</table>

<?php require_once "../../../assets/template/layout.bottom.php"; ?>
