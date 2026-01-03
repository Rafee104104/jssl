 <?
	session_start();
	require_once "../../../assets/support/inc.all.php";
	require_once('../../common/class.numbertoword.php');
	date_default_timezone_set('Asia/Dhaka');







	date_default_timezone_set('Asia/Dhaka');

	$emp_id = $_POST['employe_id'];

	$_POST['effect_date'];

	$effect_date = date("jS F \,  Y  ", strtotime($_POST['effect_date']));

	$query1 = 'select * from personnel_basic_info where PBI_ID="' . $emp_id . '" ';

	$sql1 = mysql_query($query1);

	$data1 = mysql_fetch_object($sql1);

	$query2 = 'select g.id,g.grade,g.zero_increment,g.each_increment,g.upto_ten_incre,g.DA,g.TA,g.Night,g.total_night,g.each_increment_two,g.up_to_twenty_incre,p.grade,p.PBI_ID from payscale g,personnel_basic_info p where p.PBI_ID="' . $emp_id . '" and g.id=p.grade ';

	$sql2 = mysql_query($query2);

	$data2 = mysql_fetch_object($sql2);



	$designation = find_a_field('designation', 'DESG_DESC', 'DESG_ID=' . $data1->PBI_DESIGNATION);

	$market = find_a_field('area', 'AREA_NAME', 'AREA_CODE=' . $data1->PBI_AREA);

	$appointment_letterno = find_a_field('personnel_basic_info', 'PBI_APPOINTMENT_LETTER_NO', 'PBI_ID=' . $emp_id);

	$father_name = find_a_field('personnel_basic_info', 'PBI_FATHER_NAME', 'PBI_ID=' . $emp_id);

	$home_dist = find_a_field('personnel_basic_info', 'PBI_POB', 'PBI_ID=' . $emp_id);

	$basic_salary = find_a_field('salary_info', 'basic_salary', 'PBI_ID=' . $emp_id);

	$basic_salary_inword = find_a_field('salary_info', 'basic_salary_inword', 'PBI_ID=' . $emp_id);

	$da_basemarket = find_a_field('salary_info', 'da_basemarket', 'PBI_ID=' . $emp_id);

	$da_thertykm = find_a_field('salary_info', 'da_thertykm', 'PBI_ID=' . $emp_id);

	$da_nighthaul = find_a_field('salary_info', 'da_nighthaul', 'PBI_ID=' . $emp_id);

	$grade_name = find_a_field('payscale', 'grade', 'id=' . $data1->grade);

	$incre = find_a_field('personnel_basic_info', 'increment', 'PBI_ID=' . $emp_id);

	$salary_info = find_all_field('salary_info', '', 'PBI_ID=' . $emp_id);









	if ($incre < 11) {

		$salary = ($data2->zero_increment + ($data2->each_increment * $incre));
	} else if ($incre > 10) {

		$salary = ($data2->upto_ten_incre + ($data2->each_increment_two * $incre));
	} else {

		$salary = $data2->zero_increment;
	}







	if (isset($_POST['submit']) && isset($_POST['report']) && $_POST['report'] > 0) {

		if ($_POST['name'] != '')

			$con .= ' and a.PBI_NAME like "%' . $_POST['name'] . '%"';

		if ($_POST['PBI_ORG'] != '')

			$con .= ' and a.PBI_ORG = "' . $_POST['PBI_ORG'] . '"';

		if ($_POST['department'] != '')

			$con .= ' and a.PBI_DEPARTMENT = "' . $_POST['department'] . '"';

		if ($_POST['project'] != '')

			$con .= ' and a.PBI_PROJECT = "' . $_POST['project'] . '"';

		if ($_POST['designation'] != '')

			$con .= ' and a.PBI_DESIGNATION = "' . $_POST['designation'] . '"';

		if ($_POST['zone'] != '')

			$con .= ' and a.PBI_ZONE = "' . $_POST['zone'] . '"';



		if ($_POST['JOB_LOCATION'] != '')

			$con .= ' and a.JOB_LOCATION = "' . $_POST['JOB_LOCATION'] . '"';



		if ($_POST['PBI_GARDEN'] != '')

			$con .= ' and a.PBI_GARDEN = "' . $_POST['PBI_GARDEN'] . '"';



		if ($_POST['PBI_GROUP'] != '')

			$con .= ' and a.PBI_GROUP = "' . $_POST['PBI_GROUP'] . '"';



		if ($_POST['area'] != '')

			$con .= ' and a.PBI_AREA = "' . $_POST['area'] . '"';



		if ($_POST['branch'] != '')

			$con .= ' and a.PBI_BRANCH = "' . $_POST['branch'] . '"';





		if ($_POST['job_status'] != '')

			$con .= ' and a.PBI_JOB_STATUS = "' . $_POST['job_status'] . '"';

		if ($_POST['gender'] != '')

			$con .= ' and a.PBI_SEX = "' . $_POST['gender'] . '"';



		if ($_POST['ijdb'] != '')

			$con .= ' and a.PBI_DOJ < "' . $_POST['ijdb'] . '"';

		if ($_POST['ppjdb'] != '')

			$con .= ' and a.PBI_DOJ_PP < "' . $_POST['ppjdb'] . '"';



		if ($_POST['ijda'] != '')

			$con .= ' and a.PBI_DOJ > "' . $_POST['ijda'] . '"';

		if ($_POST['ppjda'] != '')

			$con .= ' and a.PBI_DOJ_PP > "' . $_POST['ppjda'] . '"';



		switch ($_POST['report']) {

			case 1:

				$report = "Employee Basic Information";



				$sql = "select a.PBI_ID as CODE,a.PBI_NAME as Name,(select DESG_SHORT_NAME from designation where DESG_ID=a.PBI_DESIGNATION) as designation,(select DEPT_DESC from department where DEPT_ID=a.PBI_DEPARTMENT) as department,a.PBI_GROUP as `Group`,a.PBI_DOJ as joining_date,(select AREA_NAME from area where AREA_CODE=a.PBI_AREA) as area,(select ZONE_NAME from zon where ZONE_CODE=a.PBI_ZONE) as zone, (select SUB_REGION_NAME from sub_region where SUB_REGION_CODE=a.PBI_SUB_REGION) as sub_region,(select BRANCH_NAME from branch where BRANCH_ID=a.PBI_BRANCH) as Region,a.PBI_MOBILE as mobile  from personnel_basic_info a where	1 " . $con;

				break;

			case 10001:

				$report = "Eployee Basic Information";





				$sql = "select a.PBI_ID as CODE,a.PBI_NAME as Name,(select DESG_SHORT_NAME from designation where DESG_ID=a.PBI_DESIGNATION) as designation,(select DEPT_DESC from department where DEPT_ID=a.PBI_DEPARTMENT) as department,a.PBI_DOJ as joining_date,a.PBI_DOC2 as confirmation_date, a.PBI_EDU_QUALIFICATION as qualification, a.PBI_MOBILE as mobile,PBI_JOB_STATUS as job_status,(select AREA_NAME from area

		  where AREA_CODE=a.PBI_AREA) as Market, a.PBI_POB as Home_District, (select group_name from product_group where group_name=a.PBI_GROUP) as Team  from personnel_basic_info a where	1 " . $con . " order by  a.PBI_ID asc ";

				break;

			case 22:

				$report = "Employee Salary Information";



				$sql = "select a.PBI_ID as CODE,a.PBI_NAME as Name,(select DESG_SHORT_NAME from designation where DESG_ID=a.PBI_DESIGNATION) as designation, 

		(select DEPT_DESC from department where DEPT_ID=a.PBI_DEPARTMENT) as department,b.consolidated_salary,b.special_allowance,b.fixed_tada as TADA,b.basic_salary,b.house_rent,

		b.medical_allowance,motorcycle_install,security_amount,(b.consolidated_salary+b.special_allowance-motorcycle_install-security_amount) as total_salary from personnel_basic_info a,salary_info b where	a.PBI_ID=b.PBI_ID " . $con;

				break;











			case 2:

				$report = "Employee Salary Information(details)";



				$sql = "select a.PBI_ID as CODE,a.PBI_NAME as Name,a.PBI_DESIGNATION as designation,

		a.PBI_DEPARTMENT as department, b.consolidated_salary , b.basic_salary, b.dearness_allowance as dearness_all, b.house_rent + b.convenience + b.entertainment + b.medical_allowance + b.pf + b.utility_allowance + b.children_edu_allowance + b.other_allowance + b.responsibility_allowance + 

		b.transport_allowance + b.fuel_allowance + b.superintendent_allowance + b.servant_allowance + b.comstry_allowance + b.marketing_allowance + b.realestate_allowance + b.car_driver_allowance + b.special_allowance as other_all , (b.consolidated_salary+b.basic_salary+ b.dearness_allowance+b.house_rent+b.convenience+b.entertainment+b.medical_allowance+b.pf+ b.utility_allowance + b.children_edu_allowance + b.other_allowance + b.responsibility_allowance+ b.transport_allowance+ b.fuel_allowance+ b.superintendent_allowance + b.servant_allowance + b.comstry_allowance + b.marketing_allowance + b.realestate_allowance + b.car_driver_allowance + b.special_allowance ) as gross_salary , b.mobile_allowance as mobile_all, b.income_tax, (select warehouse_name from warehouse where warehouse_id=a.JOB_LOCATION) as total_salary from personnel_basic_info a,salary_info b where	a.PBI_ID=b.PBI_ID " . $con;



				break;





			case 3:

				$report = "Monthly Attendence Report";

				if ($_POST['mon'] > 0 && $_POST['year'] > 0) {

					$mon = $_POST['mon'];

					$year = $_POST['year'];

					$sql = "SELECT a.PBI_ID as CODE,a.PBI_NAME as Name,(select DESG_SHORT_NAME from designation where DESG_ID=a.PBI_DESIGNATION) as designation,

		(select DEPT_DESC from department where DEPT_ID=a.PBI_DEPARTMENT) as department, b.td as total_day,b.od as off_day,b.hd as holy_day, 	b.lt as late_days, 	b.ab as absent_days,b.lv as leave_days,b.pre as present_days, 	b.pay as payable_days,b.ot as over_time_hour FROM personnel_basic_info a,salary_attendence b where	a.PBI_ID=b.PBI_ID and b.mon='" . $mon . "' and b.year='" . $year . "'" . $con;
				}

				break;

			case 4:

				$report = "Over Time Report";

				if ($_POST['mon'] > 0 && $_POST['year'] > 0) {

					$mon = $_POST['mon'];

					$year = $_POST['year'];

					$sql = "SELECT a.PBI_ID as CODE,a.PBI_NAME as Name,(select DESG_SHORT_NAME from designation where DESG_ID=a.PBI_DESIGNATION) as designation ,(select DEPT_DESC from department where DEPT_ID=a.PBI_DEPARTMENT) as department, b.ot as over_time_hour,(b.total_salary/208) as rate,b.over_time_amount FROM personnel_basic_info a,salary_attendence b where	a.PBI_ID=b.PBI_ID and b.mon='" . $mon . "' and b.year='" . $year . "'" . $con;
				}

				break;

			case 5:

				$report = "Salary Payroll Report (Detail)";

				if ($_POST['mon'] > 0 && $_POST['year'] > 0) {

					$mon = $_POST['mon'];

					$year = $_POST['year'];

					$sql = "SELECT a.PBI_ID as CODE,a.PBI_NAME as Name,a.PBI_DESIGNATION as designation ,a.PBI_DEPARTMENT as department,

	b.od,b.hd,b.lt,b.ab,b.lv,b.pre,b.pay,

	b.over_time_amount,

	b.basic_salary,b.total_salary as consolidated_salary,b.house_rent,b.medical_allowance,b.other_allowance,b.special_allowance,b.ta_da as TA_DA, b.food_allowance as food, b.mobile_allowance,b.over_time_amount,b.absent_deduction,b.advance_install,b.other_install,b.bonus_amt,b.deduction,b.benefits,b.total_salary,b.total_deduction,b.food_allowance,b.total_benefits,b.total_payable*(1.00) as total_payable FROM personnel_basic_info a,salary_attendence b where	a.PBI_ID=b.PBI_ID and b.mon='" . $mon . "' and b.year='" . $year . "'" . $con;
				}

				break;







			case 6:

				$report = "Salary Payroll Report (Summary)";

				if ($_POST['mon'] > 0 && $_POST['year'] > 0) {

					$mon = $_POST['mon'];

					$year = $_POST['year'];

					$sql = "SELECT a.PBI_ID as CODE,a.PBI_NAME as Name,a.PBI_DESIGNATION as designation ,a.PBI_DEPARTMENT as department,

	b.over_time_amount,b.absent_deduction,b.advance_install,b.other_install,b.bonus_amt, b.food_allowance,b.deduction,b.benefits,b.total_salary,b.total_deduction,b.total_benefits,b.total_payable FROM personnel_basic_info a,salary_attendence b where	a.PBI_ID=b.PBI_ID and b.mon='" . $mon . "' and b.year='" . $year . "'" . $con;
				}







				break;





			case 7:

				$report = "Salary Payroll Report";

				break;



			case 8:

				$report = "Staff Mobile Information(Changable)";

				break;









			case 9:

				$report = "Salary Pay Slip";

				if ($_POST['mon'] > 0 && $_POST['year'] > 0) {

					$mon = $_POST['mon'];

					$year = $_POST['year'];
				}

				break;











			case 66:

				$report = "Salary Payroll Report (Final)";

				if ($_POST['mon'] > 0 && $_POST['year'] > 0) {

					$mon = $_POST['mon'];

					$year = $_POST['year'];

					$sql = "SELECT a.PBI_ID as CODE,a.PBI_NAME as Name,a.PBI_DESIGNATION as designation ,a.PBI_DEPARTMENT as department,b.od,b.hd,b.lt,b.ab,b.lv,b.pre,b.pay,

	b.over_time_amount,b.absent_deduction,b.advance_install,b.other_install,b.bonus_amt,b.deduction,b.benefits,b.total_salary,b.total_deduction, (b.total_salary-b.total_deduction) as actual_salary, b.total_benefits,b.total_payable FROM personnel_basic_info a,salary_attendence b where	a.PBI_ID=b.PBI_ID and b.mon='" . $mon . "' and b.year='" . $year . "'" . $con;
				}

				break;

			case 11:

				$report = "OutStanding Dues";

				if (isset($party_code)) {
					$client_name = find_a_field('tbl_party_info', 'party_name', 'party_code=' . $party_code);
					$party_con = ' and d.party_code=' . $party_code;
				}

				if (isset($proj_code))

					if (!isset($flat_no)) {
						$project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);
						$proj_con = ' and a.proj_code=' . $proj_code;
					} else {
						$project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);

						$allotment_no = $flat_no;
						$flat_show = ',a.flat_no as allot_no';
						$flat_con = ' and a.proj_code=' . $proj_code . ' and a.flat_no=\'' . $flat_no . '\' ';
					}



				if (isset($t_date)) {
					$to_date = $t_date;
					$fr_date = $f_date;
					$date_con = ' and a.inst_date between \'' . $fr_date . '\' and \'' . $to_date . '\'';
				}

				$sql = "select c.proj_name as project_name,a.flat_no as allot_no,b.party_name as client_name,a.inst_date,a.inst_amount as payable_amt,a.rcv_amount as received_amt from tbl_flat_cost_installment a, tbl_party_info b, tbl_project_info c,tbl_flat_info d where a.proj_code=c.proj_code and d.party_code=b.party_code and a.proj_code=d.proj_code and a.build_code=d.build_code and a.flat_no=d.flat_no and rcv_status=0 " . $proj_con . $date_con . $flat_con . $party_con . " order by a.inst_date";

				break;

			case 12:

				$report = "Expected Collection";

				if (isset($party_code)) {
					$client_name = find_a_field('tbl_party_info', 'party_name', 'party_code=' . $party_code);
					$party_con = ' and d.party_code=' . $party_code;
				}

				if (isset($proj_code))

					if (!isset($flat_no)) {
						$project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);
						$proj_con = ' and a.proj_code=' . $proj_code;
					} else {
						$project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);

						$allotment_no = $flat_no;
						$flat_show = ',a.flat_no as allot_no';
						$flat_con = ' and a.proj_code=' . $proj_code . ' and a.flat_no=\'' . $flat_no . '\' ';
					}



				if (isset($t_date)) {
					$to_date = $t_date;
					$fr_date = $f_date;
					$date_con = ' and a.inst_date between \'' . $fr_date . '\' and \'' . $to_date . '\'';
				}

				$sql = "select c.proj_name as project_name,a.flat_no as allot_no,b.party_name as client_name,a.inst_date,a.inst_amount as payable_amt,a.rcv_amount as received_amt from tbl_flat_cost_installment a, tbl_party_info b, tbl_project_info c,tbl_flat_info d where a.proj_code=c.proj_code and d.party_code=b.party_code and a.proj_code=d.proj_code and a.build_code=d.build_code and a.flat_no=d.flat_no " . $proj_con . $date_con . $flat_con . $party_con . " order by a.inst_date";

				break;

			case 13:

				$report = "Payment Schedule";

				if (isset($party_code)) {
					$client_name = find_a_field('tbl_party_info', 'party_name', 'party_code=' . $party_code);
					$party_con = ' and d.party_code=' . $party_code;
				}

				if (isset($proj_code))

					if (!isset($flat_no)) {
						$project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);
						$proj_con = ' and a.proj_code=' . $proj_code;
					} else {
						$project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);

						$allotment_no = $flat_no;
						$flat_show = ',a.flat_no as allot_no';
						$flat_con = ' and a.proj_code=' . $proj_code . ' and a.flat_no=\'' . $flat_no . '\' ';
					}



				if (isset($t_date)) {
					$to_date = $t_date;
					$fr_date = $f_date;
					$date_con = ' and a.inst_date between \'' . $fr_date . '\' and \'' . $to_date . '\'';
				}

				$sql = "SELECT e.pay_desc,a.inst_no, c.proj_name AS project_name,a.flat_no AS allot_no,  a.inst_date, a.inst_amount AS payable_amt, a.rcv_date AS receive_date, a.rcv_amount AS receive_amt

FROM 

tbl_flat_cost_installment a, 

tbl_party_info b, 

tbl_project_info c, 

tbl_flat_info d,

tbl_payment_head e

WHERE a.proj_code = c.proj_code

AND d.party_code = b.party_code

AND a.proj_code = d.proj_code

AND a.build_code = d.build_code

AND a.flat_no = d.flat_no

AND a.pay_code = e.pay_code" . $proj_con . $date_con . $flat_con . $party_con . " order by a.inst_date";

				break;

			case 14:

				$report = "Party Rent Agreement Terms";

				if (isset($party_code)) {
					$client_name = find_a_field('tbl_party_info', 'party_name', 'party_code=' . $party_code);
					$party_con = ' and a.party_code=' . $party_code;
				}

				if (isset($proj_code))

					if (!isset($flat_no)) {
						$project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);
						$proj_con = ' and a.proj_code=' . $proj_code;
					} else {
						$project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);

						$allotment_no = $flat_no;
						$flat_show = ',a.flat_no as allot_no';
						$flat_con = ' and a.proj_code=' . $proj_code . ' and a.flat_no=\'' . $flat_no . '\' ';
					}



				$sql = "SELECT b.`proj_name`,a.`flat_no`,c.`party_name`,a.`monthly_rent`,a.`effective_date`,a.`expire_date`,a.`notice_period`,a.discontinue_term,a.`witness1`,a.`witness1_address` FROM `tbl_rent_info` a,tbl_party_info c,tbl_project_info b WHERE a.party_code=c.party_code and a.proj_code=b.proj_code " . $proj_con . $flat_con . $party_con;

				break;

			case 15:

				$report = "Party Rent Payment Terms";

				if (isset($party_code)) {
					$client_name = find_a_field('tbl_party_info', 'party_name', 'party_code=' . $party_code);
					$party_con = ' and a.party_code=' . $party_code;
				}

				if (isset($proj_code))

					if (!isset($flat_no)) {
						$project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);
						$proj_con = ' and a.proj_code=' . $proj_code;
					} else {
						$project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);

						$allotment_no = $flat_no;
						$flat_show = ',a.flat_no as allot_no';
						$flat_con = ' and a.proj_code=' . $proj_code . ' and a.flat_no=\'' . $flat_no . '\' ';
					}



				$sql = "SELECT b.`proj_name`,a.`flat_no`,c.`party_name`,a.`security_money`,a.`monthly_rent`,a.`electricity_bill`,a.`other_bill`,a.`wasa_bill`,a.`gas_bill`,(a.`monthly_rent`++a.`electricity_bill`+a.`other_bill`+a.`wasa_bill`+a.`gas_bill`) as total_payable FROM `tbl_rent_info` a,tbl_party_info c,tbl_project_info b WHERE a.party_code=c.party_code and a.proj_code=b.proj_code " . $proj_con . $flat_con . $party_con;

				break;

			case 16:

				$report = "Party Rent Payment Terms";

				if (isset($party_code)) {
					$client_name = find_a_field('tbl_party_info', 'party_name', 'party_code=' . $party_code);
					$party_con = ' and a.party_code=' . $party_code;
				}

				if (isset($proj_code))

					if (!isset($flat_no)) {
						$project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);
						$proj_con = ' and a.proj_code=' . $proj_code;
					} else {
						$project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);

						$allotment_no = $flat_no;
						$flat_show = ',a.flat_no as allot_no';
						$flat_con = ' and a.proj_code=' . $proj_code . ' and a.flat_no=\'' . $flat_no . '\' ';
					}



				$sql = "SELECT a.jv_no as Invoice_no,a.mon as period,b.`proj_name`,a.`flat_no`,c.`party_name`,a.`rent_amt`,a.`electricity_bill`,a.`other_bill`,a.`wasa_bill`,a.`gas_bill`,total_amt as total_amt FROM `tbl_rent_receive` a,tbl_party_info c,tbl_project_info b WHERE a.party_code=c.party_code and a.proj_code=b.proj_code " . $proj_con . $flat_con . $party_con;

				break;



			case 24:

				$report = "Collection Statement(Cash)";

				if (isset($proj_code))

					if (!isset($flat_no)) {
						$project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);
						$proj_con = ' and a.proj_code=' . $proj_code;
					} else {
						$project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);

						$allotment_no = $flat_no;
						$flat_show = ',a.flat_no as allot_no';
						$flat_con = ' and a.proj_code=' . $proj_code . ' and a.flat_no=\'' . $flat_no . '\' ';
					}

				if (isset($t_date)) {
					$to_date = $t_date;
					$fr_date = $f_date;
					$date_con = ' and a.rec_date between \'' . $fr_date . '\' and \'' . $to_date . '\'';
				}

				$sql = "select a.rec_date as tr_date,b.proj_name" . $flat_show . ",a.rec_amount as total_amt from tbl_receipt a,tbl_project_info b where a.pay_mode=0 and a.proj_code=b.proj_code " . $proj_con . $date_con . $flat_con . " order by a.rec_date";

				break;

			case 25:

				$report = "Collection Statement(Chaque)";

				if (isset($proj_code))

					if (!isset($flat_no)) {
						$project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);
						$proj_con = ' and a.proj_code=' . $proj_code;
					} else {
						$project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);

						$allotment_no = $flat_no;
						$flat_show = ',a.flat_no as allot_no';
						$flat_con = ' and a.proj_code=' . $proj_code . ' and a.flat_no=\'' . $flat_no . '\' ';
					}

				if (isset($t_date)) {
					$to_date = $t_date;
					$fr_date = $f_date;
					$date_con = ' and a.rec_date between \'' . $fr_date . '\' and \'' . $to_date . '\'';
				}

				$sql = "select a.rec_date as tr_date,a.cheq_no,b.proj_name" . $flat_show . ",a.rec_amount as total_amt from tbl_receipt a,tbl_project_info b where a.pay_mode=1 and a.proj_code=b.proj_code " . $proj_con . $date_con . $flat_con . " order by a.rec_date";

				break;





				// COMMISION REPORTS

			case 31:

				$report = "Share Holder Investment Amount";

				if (isset($proj_code)) {
					$project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);
					$proj_con = ' and a.proj_code=' . $proj_code;
				}



				if (isset($t_date)) {
					$to_date = $t_date;
					$fr_date = $f_date;
					$date_con = ' and a.opening_date between \'' . $fr_date . '\' and \'' . $to_date . '\'';
				}



				$sql = "SELECT a.`member_no`,a.`party_name` as share_holder,b.proj_name,a.`status`,a.`agent_code`,c.`emp_name` as agent_name,a.`opening_date` as invest_date,a.`invested`,a.`withdraw` FROM `tbl_director_info` AS a,tbl_project_info as b,tbl_employee_info as c WHERE a.proj_code=b.proj_code and c.emp_id=a.`agent_code`" . $date_con . $proj_con . " order by a.proj_code,a.agent_code";

				break;



			case 33:

				$report = "Running Share Holder Information";

				if (isset($proj_code)) {
					$project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);
					$proj_con = ' and a.proj_code=' . $proj_code;
				}



				if (isset($t_date)) {
					$to_date = $t_date;
					$fr_date = $f_date;
					$date_con = ' and a.opening_date between \'' . $fr_date . '\' and \'' . $to_date . '\'';
				}



				$sql = "SELECT a.`member_no`,a.`party_name` as share_holder,b.proj_name,a.`agent_code`,c.`emp_name` as agent_name,a.`opening_date` as invest_date,a.`invested`,a.`withdraw` FROM `tbl_director_info` AS a,tbl_project_info as b,tbl_employee_info as c WHERE a.proj_code=b.proj_code and c.emp_id=a.`agent_code` and a.status='Running' " . $date_con . $proj_con . " order by a.proj_code,a.agent_code";

				break;



			case 34:

				$report = "Withdrawn Share Holder Information";

				if (isset($proj_code)) {
					$project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);
					$proj_con = ' and a.proj_code=' . $proj_code;
				}



				if (isset($t_date)) {
					$to_date = $t_date;
					$fr_date = $f_date;
					$date_con = ' and a.opening_date between \'' . $fr_date . '\' and \'' . $to_date . '\'';
				}



				$sql = "SELECT a.`member_no`,a.`party_name` as share_holder,b.proj_name,a.`agent_code`,c.`emp_name` as agent_name,a.`opening_date` as invest_date,a.`invested`,a.`status_date` as withdrawn_date,a.`withdraw` FROM `tbl_director_info` AS a,tbl_project_info as b,tbl_employee_info as c WHERE a.proj_code=b.proj_code and c.emp_id=a.`agent_code` and a.status='Withdrawn' " . $date_con . $proj_con . " order by a.proj_code,a.agent_code";

				break;



			case 35:

				$report = "Agent Information";



				$sql = "SELECT `emp_id`,`emp_name`,`emp_designation`,`emp_joining_date`,`emp_contact_no`, (select count(1) from tbl_director_info where agent_code=a.emp_id) as total_member, (select sum(invested) from tbl_director_info where agent_code=a.emp_id) as total_invested, (select sum(withdraw) from tbl_director_info where agent_code=a.emp_id)  as total_withdrawn FROM `tbl_employee_info` as a WHERE 1";

				break;



			case 101:

				$report = "APR Information";

				if ($_POST['markb'] != '')

					$con .= ' and b.APR_MARKS < "' . $_POST['markb'] . '"';



				if ($_POST['marka'] != '')

					$con .= ' and b.APR_MARKS > "' . $_POST['marka'] . '"';

				$year = $_POST['year'];

				$con .= ' and b.APR_YEAR = "' . $year . '"';

				$sql = "select a.PBI_ID as ID,a.PBI_NAME as Name,a.PBI_SEX as Gender,a.PBI_DOMAIN as Domain,a.PBI_DEPARTMENT as department,a.PBI_PROJECT as project	,a.PBI_DESIGNATION as designation ,a.PBI_DESG_GRADE as grade,a.PBI_ZONE as zone,a.PBI_AREA as area,a.PBI_BRANCH as branch,a.PBI_DOJ as joining_date,a.PBI_DOJ_PP as PP_joining_date,b.APR_YEAR,b.APR_MARKS,(select avg(APR_MARKS) from apr_detail where APR_YEAR in (" . $year . "," . ($year - 1) . "," . ($year - 2) . ") and PBI_ID=a.PBI_ID) as avg_marks,b.APR_STATUS,b.APR_RESULT  from personnel_basic_info a,apr_detail b where a.PBI_ID=b.PBI_ID " . $con;

				break;





			case 1001:

				$report = "Distributor Dealer Information";

				if ($_POST['dealer_name_e'] != '')

					$con .= ' and a.dealer_name_e like "%' . $_POST['dealer_name_e'] . '%"';

				if ($_POST['dealer_code'] != '')

					$con .= ' and a.dealer_code = "' . $_POST['dealer_code'] . '"';



				if ($_POST['division_code'] != '')

					$con .= ' and a.division_code = "' . $_POST['division_code'] . '"';

				elseif ($_POST['district_code'] != '')

					$con .= ' and a.district_code = "' . $_POST['district_code'] . '"';

				elseif ($_POST['thana_code'] != '')

					$con .= ' and a.thana_code = "' . $_POST['thana_code'] . '"';





				if ($_POST['region_code'] != '')

					$con .= ' and a.area_code in (select p.AREA_CODE from area p,zon z where p.ZONE_ID=z.ZONE_CODE and z.REGION_ID="' . $_POST['region_code'] . '") ';

				elseif ($_POST['zone_code'] != '')

					$con .= ' and a.area_code in (select AREA_CODE from area where ZONE_ID="' . $_POST['zone_code'] . '") ';

				elseif ($_POST['area_code'] != '')

					$con .= ' and a.area_code = "' . $_POST['area_code'] . '"';



				if ($_POST['team_name'] != '')

					$con .= ' and a.team_name = "' . $_POST['team_name'] . '"';





				if ($_POST['canceled'] != '')

					$con .= ' and a.canceled = "' . $_POST['canceled'] . '"';

				if ($_POST['depot'] != '')

					$con .= ' and a.depot = "' . $_POST['depot'] . '"';



				if ($_POST['product_group'] != '')

					$con .= ' and a.product_group = "' . $_POST['product_group'] . '"';

				if ($_POST['mobile_no'] != '')

					$con .= ' and a.mobile_no = "' . $_POST['mobile_no'] . '"';









				$sql = "select a.dealer_code as code,a.account_code as ledger_code,a.dealer_name_e as dealer_name ,(select ledger_name from accounts_ledger where ledger_id=a.account_code) as ledger_name,a.mobile_no as mobile_no,a.propritor_name_e as proprietor_name, ar.AREA_NAME as area, z.ZONE_NAME as zone, s.SUB_REGION_NAME,r.BRANCH_NAME as region,w.warehouse_name as depot , a.canceled as active

	 

	 from dealer_info a, area ar, zon z,sub_region s, branch r, warehouse w

		 

		 where s.REGION_ID=r.BRANCH_ID and a.area_code=ar.AREA_CODE and ar.ZONE_ID=z.ZONE_CODE and 



z.REGION_ID=s.SUB_REGION_CODE and a.depot=w.warehouse_id and a.dealer_type='Distributor' 



 " . $con . " order by a.dealer_code asc";







				break;





			case 1005:

				$report = "Dealer Information (Base Market &amp; Area Information)";

				if ($_POST['dealer_name_e'] != '')

					$con .= ' and a.dealer_name_e like "%' . $_POST['dealer_name_e'] . '%"';

				if ($_POST['dealer_code'] != '')

					$con .= ' and a.dealer_code = "' . $_POST['dealer_code'] . '"';



				if ($_POST['division_code'] != '')

					$con .= ' and a.division_code = "' . $_POST['division_code'] . '"';

				elseif ($_POST['district_code'] != '')

					$con .= ' and a.district_code = "' . $_POST['district_code'] . '"';

				elseif ($_POST['thana_code'] != '')

					$con .= ' and a.thana_code = "' . $_POST['thana_code'] . '"';





				if ($_POST['region_code'] != '')

					$con .= ' and a.area_code in (select p.AREA_CODE from area p,zon z where p.ZONE_ID=z.ZONE_CODE and z.REGION_ID="' . $_POST['region_code'] . '") ';

				elseif ($_POST['zone_code'] != '')

					$con .= ' and a.area_code in (select AREA_CODE from area where ZONE_ID="' . $_POST['zone_code'] . '") ';

				elseif ($_POST['area_code'] != '')

					$con .= ' and a.area_code = "' . $_POST['area_code'] . '"';





				if ($_POST['canceled'] != '')

					$con .= ' and a.canceled = "' . $_POST['canceled'] . '"';

				if ($_POST['depot'] != '')

					$con .= ' and a.depot = "' . $_POST['depot'] . '"';



				if ($_POST['product_group'] != '')

					$con .= ' and a.product_group = "' . $_POST['product_group'] . '"';

				if ($_POST['mobile_no'] != '')

					$con .= ' and a.mobile_no = "' . $_POST['mobile_no'] . '"';





				if ($_POST['team_name'] != '')

					$con .= ' and a.team_name = "' . $_POST['team_name'] . '"';



				$sql = "select a.dealer_code as code,a.account_code as ledger_code,a.dealer_name_e as dealer_name , c.ca_name, b.BASE_MARKET_NAME as Base_market, ar.AREA_NAME as area, z.ZONE_NAME as zone, r.BRANCH_NAME as region,w.warehouse_name as depot , a.canceled as active

	 

	 from dealer_info a, base_market b, commission_agent c,  area ar, zon z, branch r, warehouse w

		 

		 where a.area_code=ar.AREA_CODE and a.basemarket_code=b.BASE_MARKET_CODE and b.CA_ID=c.ca_id and ar.ZONE_ID=z.ZONE_CODE and 



z.REGION_ID=r.BRANCH_ID and a.depot=w.warehouse_id and a.dealer_type='Distributor' 



 " . $con . "  order by ar.AREA_CODE asc";







				break;





			case 1002:



				$report = "Super Shop Dealer Information";

				if ($_POST['dealer_name_e'] != '')

					$con .= ' and a.dealer_name_e like "%' . $_POST['dealer_name_e'] . '%"';

				if ($_POST['dealer_code'] != '')

					$con .= ' and a.dealer_code = "' . $_POST['dealer_code'] . '"';



				if ($_POST['division_code'] != '')

					$con .= ' and a.division_code = "' . $_POST['division_code'] . '"';

				elseif ($_POST['district_code'] != '')

					$con .= ' and a.district_code = "' . $_POST['district_code'] . '"';

				elseif ($_POST['thana_code'] != '')

					$con .= ' and a.thana_code = "' . $_POST['thana_code'] . '"';





				if ($_POST['region_code'] != '')

					$con .= ' and a.area_code in (select p.AREA_CODE from area p,zon z where p.ZONE_ID=z.ZONE_CODE and z.REGION_ID="' . $_POST['zone_code'] . '") ';

				elseif ($_POST['zone_code'] != '')

					$con .= ' and a.area_code in (select AREA_CODE from area where ZONE_ID="' . $_POST['zone_code'] . '") ';

				elseif ($_POST['area_code'] != '')

					$con .= ' and a.area_code = "' . $_POST['area_code'] . '"';





				if ($_POST['canceled'] != '')

					$con .= ' and a.canceled = "' . $_POST['canceled'] . '"';

				if ($_POST['depot'] != '')

					$con .= ' and a.depot = "' . $_POST['depot'] . '"';



				if ($_POST['product_group'] != '')

					$con .= ' and a.product_group = "' . $_POST['product_group'] . '"';

				if ($_POST['depot'] != '')

					$con .= ' and a.mobile_no = "' . $_POST['mobile_no'] . '"';





				if ($_POST['team_name'] != '')

					$con .= ' and a.team_name = "' . $_POST['team_name'] . '"';





				$sql = "select a.dealer_code as code,a.account_code as ledger_code,a.dealer_name_e as dealer_name ,(select ledger_name from accounts_ledger where ledger_id=a.account_code) as ledger_name,a.mobile_no as mobile_no,a.propritor_name_e as propritor_name ,a.team_name as team, ar.AREA_NAME as area, z.ZONE_NAME as zone, r.BRANCH_NAME as region, a.canceled as active, a.commission from dealer_info a, area ar, zon z, branch r

		 where ar.AREA_CODE=a.area_code and z.ZONE_CODE=ar.ZONE_ID and r.BRANCH_ID=z.REGION_ID and a.dealer_type='SuperShop'  " . $con . " order by a.dealer_code desc";



				break;





			case 1003:

				$report = "Corporate Dealer Information";

				if ($_POST['dealer_name_e'] != '')

					$con .= ' and a.dealer_name_e like "%' . $_POST['dealer_name_e'] . '%"';

				if ($_POST['dealer_code'] != '')

					$con .= ' and a.dealer_code = "' . $_POST['dealer_code'] . '"';



				if ($_POST['division_code'] != '')

					$con .= ' and a.division_code = "' . $_POST['division_code'] . '"';

				elseif ($_POST['district_code'] != '')

					$con .= ' and a.district_code = "' . $_POST['district_code'] . '"';

				elseif ($_POST['thana_code'] != '')

					$con .= ' and a.thana_code = "' . $_POST['thana_code'] . '"';





				if ($_POST['region_code'] != '')

					$con .= ' and a.area_code in (select p.AREA_CODE from area p,zon z where p.ZONE_ID=z.ZONE_CODE and z.REGION_ID="' . $_POST['zone_code'] . '") ';

				elseif ($_POST['zone_code'] != '')

					$con .= ' and a.area_code in (select AREA_CODE from area where ZONE_ID="' . $_POST['zone_code'] . '") ';

				elseif ($_POST['area_code'] != '')

					$con .= ' and a.area_code = "' . $_POST['area_code'] . '"';





				if ($_POST['canceled'] != '')

					$con .= ' and a.canceled = "' . $_POST['canceled'] . '"';

				if ($_POST['depot'] != '')

					$con .= ' and a.depot = "' . $_POST['depot'] . '"';



				if ($_POST['product_group'] != '')

					$con .= ' and a.product_group = "' . $_POST['product_group'] . '"';

				if ($_POST['depot'] != '')

					$con .= ' and a.mobile_no = "' . $_POST['mobile_no'] . '"';





				if ($_POST['team_name'] != '')

					$con .= ' and a.team_name = "' . $_POST['team_name'] . '"';



				$sql = "select a.dealer_code as code,a.account_code as ledger_code,a.dealer_name_e as dealer_name ,(select ledger_name from accounts_ledger where ledger_id=a.account_code) as ledger_name,a.mobile_no as mobile_no,a.propritor_name_e as propritor_name ,a.team_name as team, ar.AREA_NAME as area, z.ZONE_NAME as zone, r.BRANCH_NAME as region, a.canceled as active, a.commission from dealer_info a, area ar, zon z, branch r

		 where ar.AREA_CODE=a.area_code and z.ZONE_CODE=ar.ZONE_ID and r.BRANCH_ID=z.REGION_ID and a.dealer_type='Corporate'  " . $con . " order by a.dealer_code desc";

				break;



			case 1004:

				$report = "Personal Sales Information";

				if ($_POST['dealer_name_e'] != '')

					$con .= ' and a.dealer_name_e like "%' . $_POST['dealer_name_e'] . '%"';

				if ($_POST['dealer_code'] != '')

					$con .= ' and a.dealer_code = "' . $_POST['dealer_code'] . '"';



				if ($_POST['division_code'] != '')

					$con .= ' and a.division_code = "' . $_POST['division_code'] . '"';

				elseif ($_POST['district_code'] != '')

					$con .= ' and a.district_code = "' . $_POST['district_code'] . '"';

				elseif ($_POST['thana_code'] != '')

					$con .= ' and a.thana_code = "' . $_POST['thana_code'] . '"';





				if ($_POST['region_code'] != '')

					$con .= ' and a.area_code in (select p.AREA_CODE from area p,zon z where p.ZONE_ID=z.ZONE_CODE and z.REGION_ID="' . $_POST['zone_code'] . '") ';

				elseif ($_POST['zone_code'] != '')

					$con .= ' and a.area_code in (select AREA_CODE from area where ZONE_ID="' . $_POST['zone_code'] . '") ';

				elseif ($_POST['area_code'] != '')

					$con .= ' and a.area_code = "' . $_POST['area_code'] . '"';





				if ($_POST['canceled'] != '')

					$con .= ' and a.canceled = "' . $_POST['canceled'] . '"';

				if ($_POST['depot'] != '')

					$con .= ' and a.depot = "' . $_POST['depot'] . '"';



				if ($_POST['product_group'] != '')

					$con .= ' and a.product_group = "' . $_POST['product_group'] . '"';

				if ($_POST['depot'] != '')

					$con .= ' and a.mobile_no = "' . $_POST['mobile_no'] . '"';





				if ($_POST['team_name'] != '')

					$con .= ' and a.team_name = "' . $_POST['team_name'] . '"';



				$sql = "select a.dealer_code as code,a.account_code as ledger_code,a.dealer_name_e as dealer_name ,(select ledger_name from accounts_ledger where ledger_id=a.account_code) as ledger_name,a.mobile_no as mobile_no,a.propritor_name_e as propritor_name ,a.team_name as team, ar.AREA_NAME as area, z.ZONE_NAME as zone, r.BRANCH_NAME as region, a.canceled as active, a.commission from dealer_info a, area ar, zon z, branch r

		 where ar.AREA_CODE=a.area_code and z.ZONE_CODE=ar.ZONE_ID and r.BRANCH_ID=z.REGION_ID and a.dealer_type='Personal'  " . $con . " order by a.dealer_code desc";

				break;
		}
	}



	?>

 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

 <html xmlns="http://www.w3.org/1999/xhtml">

 <head>

 	<meta http-equiv="content-type" content="text/html; charset=utf-8" />

 	<title><?= $report ?></title>

 	<link href="../../css/report.css" type="text/css" rel="stylesheet" />

 	<script language="javascript">
 		function hide()

 		{

 			document.getElementById('pr').style.display = 'none';

 		}

 		function Pager(tableName, itemsPerPage) {

 			this.tableName = tableName;

 			this.itemsPerPage = itemsPerPage;

 			this.currentPage = 1;

 			this.pages = 0;

 			this.inited = false;



 			this.showRecords = function(from, to) {

 				var rows = document.getElementById(tableName).rows;

 				// i starts from 1 to skip table header row

 				for (var i = 1; i < rows.length; i++) {

 					if (i < from || i > to) rows[i].style.display = 'none';

 					else rows[i].style.display = '';

 				}

 			}



 			this.showPage = function(pageNumber) {

 				if (!this.inited) {

 					alert("not inited");

 					return;

 				}



 				var oldPageAnchor = document.getElementById('pg' + this.currentPage);

 				oldPageAnchor.className = 'pg-normal';



 				this.currentPage = pageNumber;

 				var newPageAnchor = document.getElementById('pg' + this.currentPage);

 				newPageAnchor.className = 'pg-selected';



 				var from = (pageNumber - 1) * itemsPerPage + 1;

 				var to = from + itemsPerPage - 1;

 				this.showRecords(from, to);

 			}



 			this.prev = function() {

 				if (this.currentPage > 1)

 					this.showPage(this.currentPage - 1);

 			}



 			this.next = function() {

 				if (this.currentPage < this.pages) {

 					this.showPage(this.currentPage + 1);

 				}

 			}



 			this.init = function() {

 				var rows = document.getElementById(tableName).rows;

 				var records = (rows.length - 1);

 				this.pages = Math.ceil(records / itemsPerPage);

 				this.inited = true;

 			}



 			this.showPageNav = function(pagerName, positionId) {

 				if (!this.inited) {

 					alert("not inited");

 					return;

 				}

 				var element = document.getElementById(positionId);



 				var pagerHtml = '<span onclick="' + pagerName + '.prev();" class="pg-normal">Prev</span>';

 				for (var page = 1; page <= this.pages; page++)

 					pagerHtml += '<span id="pg' + page + '" class="pg-normal" onclick="' + pagerName + '.showPage(' + page + ');">' + page + '</span>';

 				pagerHtml += '<span onclick="' + pagerName + '.next();" class="pg-normal">Next</span>';



 				element.innerHTML = pagerHtml;

 			}

 		}

 		var XMLHttpRequestObject = false;



 		if (window.XMLHttpRequest)

 			XMLHttpRequestObject = new XMLHttpRequest();

 		else if (window.ActiveXObject)

 		{

 			XMLHttpRequestObject = new

 			ActiveXObject("Microsoft.XMLHTTP");

 		}

 		function getData(dataSource, divID, data)

 		{

 			if (XMLHttpRequestObject)

 			{

 				var obj = document.getElementById(divID);

 				XMLHttpRequestObject.open("POST", dataSource);

 				XMLHttpRequestObject.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');



 				XMLHttpRequestObject.onreadystatechange = function()

 				{

 					if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)

 						obj.innerHTML = XMLHttpRequestObject.responseText;

 				}

 				XMLHttpRequestObject.send("ledger=" + data);

 			}

 		}

 		function getData2(dataSource, divID, data1, data2)

 		{

 			if (XMLHttpRequestObject)

 			{

 				var obj = document.getElementById(divID);

 				XMLHttpRequestObject.open("POST", dataSource);

 				XMLHttpRequestObject.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');



 				XMLHttpRequestObject.onreadystatechange = function()

 				{

 					if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)

 						obj.innerHTML = XMLHttpRequestObject.responseText;

 				}

 				XMLHttpRequestObject.send("data=" + data1 + "##" + data2);



 			}

 		}

 		function getflatData3()

 		{

 			var b = document.getElementById('category_to').value;

 			var a = document.getElementById('proj_code_to').value;

 			$.ajax({

 				url: '../../common/flat_option_new3.php',

 				data: "a=" + a + "&b=" + b,

 				success: function(data) {

 					$('#fid3').html(data);

 				}

 			});

 		}

 		function getflatData2()

 		{

 			var b = document.getElementById('category_from').value;

 			var a = document.getElementById('proj_code_from').value;

 			$.ajax({

 				url: '../../common/flat_option_new2.php',

 				data: "a=" + a + "&b=" + b,

 				success: function(data) {

 					$('#fid2').html(data);

 				}

 			});

 		}
 	</script>

 </head>

 <body>

 	<form action="" method="post">

 		<div align="center" id="pr">

 			<input type="button" value="Print" onclick="hide();window.print();" />

 		</div>

 		<div class="main">

 			<?

				//echo $sql;

				$str 	.= '<div class="header">';

				if (isset($_SESSION['company_name']))

					$str 	.= '<h2 style="font-size:24px;">' . $_SESSION['company_name'] . '</h2>';

				if (isset($report))

					$str 	.= '<h2>' . $report . '</h2>';

				if (isset($to_date))

					$str 	.= '<h2>' . $fr_date . ' To ' . $to_date . '</h2>';

				$str 	.= '</div>';

				if (isset($_SESSION['company_logo']))

					//$str 	.= '<div class="logo"><img height="60" src="'.$_SESSION['company_logo'].'"</div>';

					$str 	.= '<div class="left">';



				if (($_POST['area_code'] > 0))

					$str 	.= '<p>Area Name: ' . find_a_field('area', 'AREA_NAME', 'AREA_CODE="' . $_POST['area_code'] . '"') . '</p>';

				if (($_POST['zone_code'] > 0))

					$str 	.= '<p>Zone Name: ' . find_a_field('zon', 'ZONE_NAME', 'ZONE_CODE="' . $_POST['zone_code'] . '"') . '</p>';

				if (($_POST['region_code'] > 0))

					$str 	.= '<p>Region Name: ' . find_a_field('branch', 'BRANCH_NAME', 'BRANCH_ID="' . $_POST['region_code'] . '"') . '</p>';

				if (isset($project_name))

					$str 	.= '<p>Project Name: ' . $project_name . '</p>';

				if (isset($allotment_no))

					$str 	.= '<p>Allotment No.: ' . $allotment_no . '</p>';

				$str 	.= '</div><div class="right">';

				if (isset($client_name))

					$str 	.= '<p>Client Name: ' . $client_name . '</p>';

				$str 	.= '</div><div class="date">Reporting Time: ' . date("h:i A d-m-Y") . '</div>';



				if ($_POST['report'] == 7) {

					$sql = "select a.PBI_ID as CODE,a.PBI_NAME as Name,a.PBI_DESIGNATION as designation ,a.PBI_DEPARTMENT as department from 

personnel_basic_info a where 1 " . $con;

					$query = mysql_query($sql);

				?><table width="100%" cellspacing="0" cellpadding="2" border="0">

 					<thead>
 						<tr>
 							<td style="border:0px;" colspan="11"><?= $str ?></td>
 						</tr>

 						<tr>
 							<th>S/L</th>

 							<th>CODE</th>

 							<th>Name</th>

 							<th>Desg</th>

 							<th>Dept</th>

 							<th>Salary Type</th>

 							<th>Basic</th>

 							<th>C.Salary</th>

 							<th>SL</th>

 							<th>HR</th>

 							<th>TA/DA</th>

 							<th>FA</th>

 							<th>MA</th>

 							<th>Sal By </th>

 							<th>A/C#</th>

 							<th>Branch</th>

 							<th>SM</th>

 						</tr>
 					</thead>

 					<tbody>

 						<?

							while ($datas = mysql_fetch_row($query)) {
								$s++;

								$sqld = 'select * from salary_info where PBI_ID=' . $datas[0];

								$data = mysql_fetch_object(mysql_query($sqld));

							?>

 							<tr>
 								<td><?= $s ?></td>
 								<td><?= $datas[0] ?></td>
 								<td><?= $datas[1] ?></td>

 								<td><?= $datas[2] ?></td>

 								<td><?= $datas[3] ?></td>
 								<td><?= $data->salary_type ?></td>
 								<td><?= $data->basic_salary ?></td>
 								<td><?= $data->consolidated_salary ?></td>

 								<td style="text-align:right"><?= $data->special_allowance ?></td>

 								<td style="text-align:right"><?= $data->house_rent ?></td>
 								<td><?= $data->ta ?></td>

 								<td><?= $data->food_allowance ?></td>

 								<td><?= $data->medical_allowance ?>&nbsp;</td>

 								<td><?= $data->cash_bank ?>&nbsp;</td>

 								<td><?= $data->cash ?></td>

 								<td><?= $data->branch_info ?></td>
 								<td><?= $data->security_amount ?></td>
 							</tr>

 						<?

							}

							?>
 					</tbody>
 				</table>

 			<?

				}



				//Market & dealer report



				elseif ($_POST['report'] == 125) {



				?><table width="100%" cellspacing="0" cellpadding="1" border="0">

 					<thead>
 						<tr>
 							<td style="border:0px;" colspan="11"><?= $str ?></td>
 						</tr>

 						<tr>

 							<th>S/L</th>

 							<th>CODE</th>

 							<th>Name</th>

 							<th>Designation</th>



 							<th>Job Status</th>

 						</tr>



 					</thead>



 					<?

						$s = 1;

						$sql = "select a.PBI_ID as CODE,a.PBI_NAME as Name,b.DESG_DESC as designation ,a.PBI_JOB_STATUS from 

personnel_basic_info a,designation b where a.PBI_DESIGNATION=b.DESG_ID and a.PBI_DESIGNATION='2' and a.PBI_JOB_STATUS='In Service'  " . $con;

						$query = mysql_query($sql);

						while ($data = mysql_fetch_object($query)) {





						?>

 						<tbody>
 							<tr>
 								<td><?= $s++; ?></td>
 								<td><?= $data->CODE ?></td>
 								<td><?= $data->Name ?></td>
 								<td><?= $data->designation ?></td>
 								<td><?= $data->PBI_JOB_STATUS ?></td>
 							<tr>
 						</tbody>

 					<? } ?>
 				</table>
 			<?

				}





				if ($_POST['report'] == 8) {





					$sql = "select a.PBI_ID as CODE,a.PBI_NAME as Name,(select DESG_SHORT_NAME from designation where DESG_ID=a.PBI_DESIGNATION) as designation,(select DEPT_DESC from department where DEPT_ID=a.PBI_DEPARTMENT) as department,a.PBI_GROUP as `Group`,a.PBI_DOJ as joining_date,a.PBI_DOJ_PP as PP_joining_date,(select AREA_NAME from area where AREA_CODE=a.PBI_AREA) as area,(select ZONE_NAME from zon where ZONE_CODE=a.PBI_ZONE) as zone,(select BRANCH_NAME from branch where BRANCH_ID=a.PBI_BRANCH) as Region,a.PBI_EDU_QUALIFICATION as qualification,a.PBI_MOBILE as mobile  from personnel_basic_info a where	1 " . $con;

					$query = mysql_query($sql);

				?><table width="100%" cellspacing="0" cellpadding="2" border="0">

 					<thead>
 						<tr>
 							<td style="border:0px;" colspan="11"><?= $str ?></td>
 						</tr>

 						<tr>
 							<th>S/L</th>

 							<th>CODE</th>

 							<th>Name</th>

 							<th>Desg</th>

 							<th>Dept</th>

 							<th>Group</th>

 							<th>Join_date</th>

 							<th>PP_join_date</th>

 							<th>Area</th>

 							<th>Zone</th>

 							<th>Region</th>

 							<th>Qualification</th>

 							<th>Mobile No </th>

 							<th>Submit</th>

 						</tr>
 					</thead>

 					<tbody>

 						<?

							$ajax_page = "rd_issue_ajax.php";

							while ($datas = mysql_fetch_row($query)) {
								$s++;

							?>

 							<tr>
 								<td><?= $s ?></td>

 								<td><?= $datas[0] ?></td>

 								<td><?= $datas[1] ?></td>

 								<td><?= $datas[2] ?></td>

 								<td><?= $datas[3] ?></td>

 								<td><?= $datas[4] ?></td>

 								<td><?= $datas[5] ?></td>

 								<td><?= $datas[6] ?></td>

 								<td style="text-align:right"><?= $datas[7] ?></td>

 								<td style="text-align:right"><?= $datas[8] ?></td>

 								<td><?= $datas[9] ?></td>

 								<td><?= $datas[10] ?></td>

 								<td><input type="hidden" name="PBI_ID#<?= $datas[0] ?>" id="PBI_ID#<?= $datas[0] ?>" value="<?= $datas[0] ?>" />

 									<input name="mobile#<?= $datas[0] ?>" type="text" id="mobile#<?= $datas[0] ?>" value="<?= $datas[11] ?>" />
 								</td>

 								<td>
 									<div id="po<?= $datas[0] ?>"><input type="button" name="Change" value="Change" onclick="getData2('<?= $ajax_page ?>', 'po<?= $datas[0] ?>',document.getElementById('PBI_ID#<?= $datas[0] ?>').value,document.getElementById('mobile#<?= $datas[0] ?>').value);" /></div>
 								</td>

 							</tr>

 						<?

							}

							?>
 					</tbody>
 				</table>

 			<?

				} elseif ($_POST['report'] == 9) {

				?>

 				<div class="header">
 					<h1><?= $_SESSION['company_name'] ?></h1>

 					<h2 style="margin:0; padding:0; font-weight:700;">Salary Pay Slip :

 						<?= date('F', mktime(0, 0, 0, $mon, 15, 2000)) ?>, <?= $year ?></h2>
 				</div>





 				<h3 style="margin:0; padding:0; font-weight:400;">



 					<?php if ($_POST['department'] != '') { ?>Department: <?= find_a_field('department', 'DEPT_DESC', 'DEPT_ID=' . $_POST['department']);
																		} ?>



 				<?php if ($_POST['PBI_GARDEN'] != '' && $_POST['department'] != '') { ?> , Garden: <?= find_a_field('tea_estate', 'ESTATE_NAME', 'ESTATE_ID=' . $_POST['PBI_GARDEN']);
																								} elseif ($_POST['PBI_GARDEN'] != '') {

																									?>Garden: <?= find_a_field('tea_estate', 'ESTATE_NAME', 'ESTATE_ID=' . $_POST['PBI_GARDEN']);
																											} ?>



 				<?php if ($_POST['JOB_LOCATION'] != '' && ($_POST['PBI_GARDEN'] != '' || $_POST['department'] != '')) { ?> , Job Location: <?= find_a_field('warehouse', 'warehouse_name', 'warehouse_id=' . $_POST['JOB_LOCATION']);
																																		} elseif ($_POST['JOB_LOCATION'] != '') { ?>Job Location: <?= find_a_field('warehouse', 'warehouse_name', 'warehouse_id=' . $_POST['JOB_LOCATION']);
																																																} ?>



 				</h3>





 				<?



					$sql = "SELECT a.*,b.*, d.DESG_SHORT_NAME, p.DEPT_DESC FROM personnel_basic_info a,salary_attendence b, designation d, department p where	a.PBI_ID=b.PBI_ID and a.PBI_DESIGNATION=d.DESG_ID and a.PBI_DEPARTMENT=p.DEPT_ID and b.mon='" . $mon . "' and b.year='" . $year . "'" . $con . " order by a.PBI_ID asc";

					$res = mysql_query($sql);

					$ig = -1;
					while ($data = mysql_fetch_object($res)) {

					?>

 					<div <? if (($ig % 3) == 0 && ($ig > 2)) echo 'style="position:relative;display:block; width:100%; float: none; page-break-after:always; page-break-inside:avoid"'; ?>>

 						<? $ig++; ?>

 						<table width="100%" cellspacing="0" cellpadding="2" border="0">

 							<thead>

 								<tr>

 									<td style="border:0px;" colspan="12"></td>

 								</tr>

 								<tr>

 									<th width="8%">Staff Picture</th>

 									<th width="13%">Employee Information</th>

 									<th width="8%">Attendence Info</th>

 									<th width="15%">Salary Information</th>



 									<th width="4%">Ta Da </th>

 									<th width="4%">Commi</th>

 									<th width="4%">Mob All </th>

 									<th width="4%">Other</th>



 									<th width="11%">Advance if Any </th>

 									<th width="10%">Deduction if Any </th>

 									<th width="9%">Payable Salary</th>

 									<th width="10%">Signature</th>

 								</tr>

 							</thead>

 							<tbody>

 								<tr>

 									<td rowspan="2" align="center" style="text-align:center">
 										<p><img src="../../pic/staff/<?= $data->PBI_ID ?>.jpg" alt="" width="78" height="89" border="1" /></p>
 									</td>

 									<td rowspan="2" align="center">



 										<?php if ($data->PBI_DOJ > 0) { ?>



 											Joining Date:<strong> <?= date("jS F, Y", strtotime($data->PBI_DOJ)) ?>



 											</strong><br />



 										<?php } ?>



 										ID: <strong>

 											<?= $data->PBI_ID ?>

 										</strong><br />

 										Name: <strong>

 											<?= $data->PBI_NAME ?>

 										</strong><br />

 										Designation: <strong>

 											<?= $data->DESG_SHORT_NAME ?>

 										</strong><br />

 										Department: <strong>

 											<?= $data->DEPT_DESC ?>

 										</strong></td>

 									<td rowspan="2" align="right">

 										<?php if ($data->pre > 0) { ?>

 											Present Days:<strong>

 												<?= $data->pre ?>

 											</strong><br />

 										<?php } ?>





 										<?php if ($data->od > 0) { ?>

 											Off Days:<strong>

 												<?= $data->od ?>

 											</strong><br />

 										<?php } ?>



 										<?php if ($data->hd > 0) { ?>

 											Holy Days:<strong>

 												<?= $data->hd ?>

 											</strong><br />

 										<?php } ?>



 										<?php if ($data->lv > 0) { ?>

 											Leave Days:<strong>

 												<?= $data->lv ?>

 											</strong><br />

 										<?php } ?>



 										<?php if ($data->lt > 0) { ?>

 											Late Days:<strong>

 												<?= $data->lt ?>

 											</strong><br />

 										<?php } ?>



 										<?php if ($data->ab > 0) { ?>

 											Absent Days:<strong>

 												<?= $data->ab ?>

 											</strong><br />

 										<?php } ?>

 										<?php if ($data->td > 0) { ?>

 											Total Days:<strong>

 												<?= $data->td ?>

 											</strong><br />

 										<?php } ?>



 										<?php if ($data->pay > 0) { ?>

 											Payable Days:<strong>

 												<?= $data->pay ?>

 											</strong>

 										<?php } ?> </td>

 									<td align="center" style="text-align:right">

 										<?php if ($data->consolidated_salary > 0) { ?>

 											Consolidated Salary:<strong>

 												<?= $data->consolidated_salary ?>

 											</strong><br />

 										<?php } ?>

 										<?php if ($data->basic_salary > 0) { ?>

 											Basic Salary:<strong>

 												<?= $data->basic_salary ?>

 											</strong><br />

 										<?php } ?>



 										<?php if ($data->dearness_allowance > 0) { ?>

 											Dearness All:<strong>

 												<?= $data->dearness_allowance ?>

 											</strong><br />

 										<?php } ?>



 										<?php if ($data->house_rent > 0) { ?>

 											House Rent:<strong>

 												<?= $data->house_rent ?>

 											</strong><br />

 										<?php } ?>







 										<?php if ($data->entertainment > 0) { ?>

 											Ent. All:<strong>

 												<?= $data->entertainment ?>

 											</strong><br />

 										<?php } ?>



 										<?php if ($data->medical_allowance > 0) { ?>

 											Medical All:<strong>

 												<?= $data->medical_allowance ?>

 											</strong><br />

 										<?php } ?>



 										<?php if ($data->convenience > 0) { ?>

 											Convenience :<strong>

 												<?= $data->convenience ?>

 											</strong><br />

 										<?php } ?>









 										<?php if ($data->utility_allowance > 0) { ?>

 											Utility All :<strong>

 												<?= $data->utility_allowance ?>

 											</strong><br />

 										<?php } ?>



 										<?php if ($data->children_edu_allowance > 0) { ?>

 											CEA All :<strong>

 												<?= $data->children_edu_allowance ?>

 											</strong><br />

 										<?php } ?>



 										<?php if ($data->responsibility_allowance > 0) { ?>

 											Respty. All :<strong>

 												<?= $data->responsibility_allowance ?>

 											</strong><br />

 										<?php } ?>





 										<?php if ($data->transport_allowance > 0) { ?>

 											Trans. All :<strong>

 												<?= $data->transport_allowance ?>

 											</strong><br />

 										<?php } ?>



 										<?php if ($data->fuel_allowance > 0) { ?>

 											Fuel All :<strong>

 												<?= $data->fuel_allowance ?>

 											</strong><br />

 										<?php } ?>



 										<?php if ($data->superintendent_allowance > 0) { ?>

 											Supdt. All :<strong>

 												<?= $data->superintendent_allowance ?>

 											</strong><br />

 										<?php } ?>



 										<?php if ($data->servant_allowance > 0) { ?>

 											Servent All :<strong>

 												<?= $data->servant_allowance ?>

 											</strong><br />

 										<?php } ?>



 										<?php if ($data->special_allowance > 0) { ?>

 											Special All :<strong>

 												<?= $data->special_allowance ?>

 											</strong><br />

 										<?php } ?>



 										<?php if ($data->comstry_allowance > 0) { ?>

 											Comstry. All :<strong>

 												<?= $data->comstry_allowance ?>

 											</strong><br />

 										<?php } ?>



 										<?php if ($data->marketing_allowance > 0) { ?>

 											Marketing All :<strong>

 												<?= $data->marketing_allowance ?>

 											</strong><br />

 										<?php } ?>



 										<?php if ($data->realestate_allowance > 0) { ?>

 											Real Estate :<strong>

 												<?= $data->realestate_allowance ?>

 											</strong><br />

 										<?php } ?>



 										<?php if ($data->car_driver_allowance > 0) { ?>

 											Car &amp; Driver :<strong>

 												<?= $data->car_driver_allowance ?>

 											</strong><br />

 										<?php } ?>



 										<?php if ($data->other_allowance > 0) { ?>

 											Other All :<strong>

 												<?= $data->other_allowance ?>

 											</strong><br />

 										<?php } ?>





 										<?php if ($data->pf > 0) { ?>

 											PF :<strong>

 												<?= $data->pf ?>

 											</strong><br />

 										<?php } ?> </td>



 									<td align="center" style="text-align:right"><strong>

 											<?php if ($data->ta_da > 0) { ?>

 												<?= $data->ta_da;
													$tada_total += $data->ta_da; ?>

 											<?php } ?>



 											<?php if ($data->fixed_tada > 0) { ?>

 												<?= $data->fixed_tada;
													$fixed_tada_total += $data->fixed_tada; ?>

 											<?php } ?>

 										</strong> <br /><br /> <br /><br /></td>

 									<td align="center" style="text-align:right"><strong>

 											<?= $data->commission;
												$comm_total += $data->commission; ?>

 										</strong> <br /><br /> <br /><br /></td>

 									<td align="center" style="text-align:right"><strong>

 											<?= $data->mobile_allowance;
												$mob_total += $data->mobile_allowance; ?>

 										</strong> <br /><br /> <br /><br /></td>

 									<td align="center" style="text-align:right"><strong>

 											<?= $data->benefits;
												$benefits_total += $data->benefits; ?>

 										</strong><br /><br /> <br /><br /></td>

 									<td rowspan="2" align="center" style="text-align:right">



 										<?php

											$z = 0;
											$ad_sql = 'SELECT advance_amt, sum(payable_amt) as total_pay, payable_amt  FROM salary_advance WHERE PBI_ID=' . $data->PBI_ID . ' and (( current_mon>=' . $mon . ' and current_year>=' . $year . ' ) or current_year>' . $year . ') and (( start_mon<=' . $mon . ' and start_year<=' . $year . ' ) or start_year<' . $year . ')  group By start_year,start_mon,advance_amt';



											$ad_query = mysql_query($ad_sql);

											while ($ad_data = mysql_fetch_object($ad_query)) {

											?>



 											Loan <?php echo ++$z ?>: <strong><?php echo $ad_data->total_pay ?></strong> <br />

 											Install: <strong><?php echo $ad_data->payable_amt ?> </strong><br />

 											Bala:<strong> <?php echo number_format(($ad_data->total_pay - $ad_data->payable_amt), 2) ?></strong> <br />

 											<br />





 										<?php } ?>
 									</td>

 									<td align="center" style="text-align:right">

 										<?php if ($data->deduction > 0) { ?>

 											Other Ded:<strong>

 												<?= number_format($data->deduction, 2) ?>

 											</strong><br />

 										<?php } ?>



 										<?php if ($data->food_allowance > 0) { ?>

 											Food Ded:<strong>

 												<?= number_format($data->food_allowance, 2) ?>

 											</strong><br />

 										<?php } ?>



 										<?php if ($data->advance_install > 0) { ?>

 											Adv Install:<strong>

 												<?= number_format($data->advance_install, 2) ?>

 											</strong><br />

 										<?php } ?>



 										<?php if ($data->pf > 0) { ?>

 											PF :<strong>

 												<?= number_format(($data->pf + $data->pf), 2) ?>

 											</strong><br />

 										<?php } ?>



 										<?php if ($data->income_tax > 0) { ?>

 											Income Tax :<strong>

 												<?= number_format($data->income_tax, 2) ?>

 											</strong><br />

 										<?php } ?> </td>

 									<td align="center" style="text-align:right">

 										<?php if ($data->total_salary > 0) { ?>

 											Gross:<strong> <?= number_format($data->total_salary, 2) ?></strong><br />

 										<?php } ?>



 										<?php if ($data->total_benefits > 0) { ?>

 											Totl Benf:<strong>

 												<?= number_format($data->total_benefits, 2) ?>

 											</strong><br />

 										<?php } ?>



 										<?php if ($data->total_deduction > 0) { ?>

 											Totl Ded:<strong>

 												<?

													$tot_d = ($data->food_allowance + $data->total_deduction);

													echo number_format($tot_d, 2)

													?>

 											</strong><br />

 										<?php } ?> </td>

 									<td rowspan="2" align="center" style="text-align:center">...........................<br />

 										(<strong>

 											<?= $data->PBI_NAME ?>



 										</strong>) <br />

 									</td>

 								</tr>



 								<tr>

 									<td align="center" style="text-align:right"> Gross Salary:<strong>

 											<?= number_format($data->total_salary, 2);
												$g_total += $data->total_salary; ?>

 										</strong></td>



 									<td colspan="4" align="center" style="text-align:right">Total Bene: <strong>

 											<?= number_format($data->total_benefits, 2);
												$b_gtotal += $data->total_benefits; ?>

 										</strong></td>

 									<td align="center" style="text-align:right">Total Ded:<strong>

 											<?= number_format($total_dud = $data->total_deduction + $data->food_allowance, 2);
												$d_gtotal += $data->total_deduction; ?>

 										</strong></td>

 									<td align="center" style="text-align:right">Net Pay:<strong>

 											<?

												$tot_k = ($data->total_salary - $tot_d);





												echo number_format($tot_k, 2); ?>

 										</strong></td>

 								</tr>

 								<br />

 							<? } ?>

 							<tr>

 								<td align="center" style="text-align:center">&nbsp;</td>

 								<td align="center">&nbsp;</td>

 								<td align="right">&nbsp;</td>

 								<td align="center" style="text-align:right">&nbsp;</td>



 								<td colspan="4" align="center" style="text-align:right">&nbsp;</td>

 								<td align="center" style="text-align:right">&nbsp;</td>

 								<td align="center" style="text-align:right">&nbsp;</td>

 								<td align="center" style="text-align:right">&nbsp;</td>

 								<td align="center" style="text-align:center">&nbsp;</td>

 							</tr>







 							<tr>

 								<td align="center" style="text-align:center">&nbsp;</td>

 								<td align="center">&nbsp;</td>

 								<td align="right"><strong>Grand Total:</strong></td>

 								<td align="center" style="text-align:right"> <strong><?= number_format($g_total, 2); ?></strong></td>



 								<td align="center" style="text-align:right"><strong><?= number_format($tada_total + $fixed_tada_total, 2); ?></strong></td>

 								<td align="center" style="text-align:right"><strong>

 										<?= number_format($comm_total, 2); ?>

 									</strong></td>

 								<td align="center" style="text-align:right"><strong>

 										<?= number_format($mob_total, 2); ?>

 									</strong></td>

 								<td align="center" style="text-align:right"><strong>

 										<?= number_format($benefits_total, 2); ?>

 									</strong></td>

 								<td align="center" style="text-align:right">&nbsp;</td>

 								<td align="center" style="text-align:right"><strong><?= number_format($d_gtotal, 2); ?></strong></td>

 								<td align="center" style="text-align:right"><strong><?= number_format($n_p_total, 2); ?></strong></td>

 								<td align="center" style="text-align:center">&nbsp;</td>

 							</tr>

 							</tbody>

 						</table>

 					</div>

 					<br />


 					<!-- Letters Start From Here -->

 				<? } elseif ($_POST['report'] == 22) { ?>

 					<?
						$info = find_all_field('personnel_basic_info', '', 'PBI_CODE="' . $_POST['emp_id'] . '"');
						$salary_info = find_all_field('salary_info', '', 'PBI_ID="' . $info->PBI_ID . '"');
						?>

 					<form action="" method="post">

 						<table>
 							<tr>
 								<h2 align="center"><b>ERP.COM.BD LTD</b></h2>
 								<p style="text-align:center;">
 									<u>985 , Street -16,Avenue-02,</u>
 								</p>
 								<p style="text-align:center;">
 									<u>Mirpur DOHS, Mirpur,</u>
 								</p>
 								<p style="text-align:center;">
 									<u>Dhaka-1216, Bangladesh</u>
 								</p>
 							<tr>

 								<p style="text-align:right;margin-top:-24px;padding-right:50px;">Date: &nbsp;<?= $_POST['effect_date']; ?></p>
 							</tr>
 							</tr>

 							<h3 align="center"><b><u>APPOINTMENT LETTER</u></b></h3>

 							<p>To,</p>
 							<p><?= $info->PBI_NAME ?>,<br>
 							<p><?= $info->pre_road_no ?>, Flat No: <?= $info->pre_flat ?>, House No:<?= $info->pre_house_no; ?></p>
 							<p><?= $info->pre_ps ?>, <?= $info->pre_district ?></p>

 							<p>Subject: Letter of Appointment as ‘<?= $info->PBI_DESIGNATION ?>’ under <?= $_SESSION['company_name'] ?></p>

 							<p>Dear <?= $info->PBI_NAME ?>,</p>

 							<a style="text-align: justify;">
 								In pursuance of your interest and subsequent interview with our selection panel,
 								the management of <?= $_SESSION['company_name'] ?> is pleased to inform you that you have been
 								selected to fill up the position of <?= $info->PBI_DESIGNATION ?> of <?= $info->PBI_DEPARTMENT ?> department
 								of <?= $_SESSION['company_name'] ?> under the following terms and conditions.
 							</a>


 							<ol>
 								<li>Appointment Letter: You will be on probation for a period of 6 (Six) months from the date of joining. After the expiry probation period your appointment will be confirmed as regular employee, if found satisfactory.</li>
 								<li>Nature of Job and place of posting: You will be presently posted at <?= $info->PBI_DEPARTMENT ?> Department at Banani office of <?= $_SESSION['company_name'] ?> </li>
 								<li>Date of Joining: You are expected to furnish your joining report to Head of Human Resources Department of <?= $_SESSION['company_name'] ?>  on <?= $info->PBI_DOJ ?> AT the time of joining you shall have to provide below mentioned documents:
 									<ol type="a">
 										<li>Updated CV with recent passport size one copies of photograph with soft copy.</li>
 										<li>All academic certificates photocopy with attested or showing original.</li>
 										<li>Photocopy of NID/Passport</li>
 										<li>All experience certificate which has been mentioned in the CV</li>
 										<li>TIN Certificate. (If Any)</li>
 										<li>Photocopy of relieving letter from previous employee (Show Original)</li>
 										<li>Electricity Bill of your present residence or any other utility bill. (Updated one)</li>
 										<li>Previous company vising card.</li>
 									</ol>
 								</li>
 								<li>Reporting Authority: You have to report the <?= find_a_field('personnel_basic_info', 'PBI_NAME', 'PBI_ID="' . $info->incharge_id . '"'); ?> of <?= $_SESSION['company_name'] ?> .</li>
 								<li>Working Days: 06 (Six) day within a week (Saturday- Thursday)</li>
 								<li>Office Time: From 10.00 AM to 6.00 PM (Additional time may have to be spend on exceptional circumstances)</li>
 								<li>Leave Facilities: You may avail different kind of leave facilities- Casual Leaves, Sick leave & Annual Leave but these leaves will be applicable after successfully completing the probationary period.
 									<a> During your leave you must stay connected over mobile, Whatsapp or any other means whenever the company needs.</a>
 								</li>
 								<li>Commitments: You will have to abide by the company’s HR Policy Manual, Sales Procedure and other manuals as existed and as may be changed from time to time.</li>
 								<li>Off-the-Job Engagement: During your employment with <?= $_SESSION['company_name'] ?> or with any sister concern of the Group, you shall not engage in any other job, business or earning activities.</li>
 								<li>Ethics and Code of Conduct: You will have to maintain high level of Ethics and Code of Conduct in and outside the office for the growth of yours and the company.</li>
 								<li>Secrecy and Confidentiality: During your employment you shall not share any information either verbally or written with any individual or organization outside of <?= $_SESSION['company_name'] ?> and its affiliates or subsidiaries. The policies, procedures, data or any sort of information/ document relating to the company shall be considered as the exclusive property of <?= $_SESSION['company_name'] ?> . Any violation of secrecy and confidentiality shall be regarded as major offence and is subject to punitive disciplinary measure.</li>
 							</ol>

 							<h2>Employment Benefits</h2>

 							<ol>
 								<li>Salary: Your Consolidate Salary has been fixed at <?= number_format($salary_info->gross_salary) ?>/- (<? echo convertNumberMhafuz($salary_info->gross_salary); ?>) per Month.</li>
 								<li>Eid Bonus: You are admissible for two Eid Bonus as full Basic Pay each time as per company policy or Management decision from time to time. One another thing is that you are not eligible for Bonus in Probation Period.</li>
 								<li>Increment: You will be paid increment on your Basic Salary as per Management decision and company policy.</li>
 								<li>Other Benefit and Perks: You will be entitled to other benefit and perks as decided by the company as and when applicable.</li>
 							</ol>

 							<a>If the above terms and conditions are acceptable to you, please sign the duplicate copy of this appointment letter and furnish your joining report to Head of HR as on the date mentioned here above. We appreciate your interest to serve for <?= $_SESSION['company_name'] ?> . We are hopeful that our employment relationship will be mutually beneficial, and you will perform your duties skillfully and sincerely.</a>
 							<p>Sincerely,</p>

 							<div style="position: relative; margin-top: 150px;">
 								<div style="width: 50%; float: left; text-align: left; margin-left: 0%;">
 									<p style=" margin-left: 35px;">-------------------------</p>
 									<p style=" margin-left: 35px;"> Chief Executive Officer</p>

 									<p style=" margin-left: 35px;"><?= $_SESSION['company_name'] ?> </p>

 								</div>
 								<div style="width: 25%; float: right; text-align: right; margin-right: 20px; ">
 									<p style=" margin-left: 35px;">-----------------------</p>
 									<p style="margin-left: 35px;"><?= $info->PBI_NAME ?></p>
 									<p style=" margin-left: 35px;">Applicant</p>
 								</div>
 							</div>
 							</tr>
 						</table>
 					</form>




 				<? } elseif ($_POST['report'] == 23) { ?>

 					<?
						$info = find_all_field('personnel_basic_info', '', 'PBI_CODE="' . $_POST['emp_id'] . '"');

						$salary_info = find_all_field('salary_info', '', 'PBI_ID="' . $info->PBI_ID . '"');

						$promotion_info = find_all_field('promotion_detail', '', 'PBI_ID="' . $info->PBI_ID . '"');
						?>

 					<form action="" method="post">
 						<table>
 							<tr>
 								<h2 align="center"><b>ERP.COM.BD LTD</b></h2>
 								<p style="text-align:center;">
 									<u>985 , Street -16,Avenue-02,</u>
 								</p>
 								<p style="text-align:center;">
 									<u>Mirpur DOHS, Mirpur,</u>
 								</p>
 								<p style="text-align:center;">
 									<u>Dhaka-1216, Bangladesh</u>
 								</p>
 							<tr>

 								<p style="text-align:right;margin-top:-24px;padding-right:50px;">Dated:&nbsp;<?= $_POST['effect_date']; ?></p>
 							</tr>
 							</tr>

 							<h3 align="center"><b><u>OFFER LETTER</u></b></h3>

 							<p><?= $info->PBI_NAME ?></p>
 							<p><?= $info->pre_road_no ?>, Flat No: <?= $info->pre_flat ?>, House No:<?= $info->pre_house_no; ?></p>
 							<p><?= $info->pre_ps ?>, <?= $info->pre_district ?></p>

 							<p>Dear <?= $info->PBI_NAME ?>,</p>

 							<a>In response to your application and the subsequent interview you have had with us. We are pleased to make you an offer for the position of ‘<?= $promotion_info->PROMOTION_PRESENT_DESG ?> (<?= $info->PBI_DEPARTMENT ?>)’ in the department of Sales & Marketing at <?= $_SESSION['company_name'] ?> Limited. You will be given a letter of appointment on joining. Details of your salary package is attached as Annex-A.</a>

 							<p>Your appointment is subject to:</p>
 							<ol>
 								<li>You’re joining the services of the company on <?= $info->PBI_DOJ ?>.</li>
 								<li>Your written acceptance of the offer letter.</li>
 								<li>Please bring the following documents during the time of joining:</li>
 								<ol type="a">
 									<li>Updated CV with recent passport size one copies of Photograph with soft copy.</li>
 									<li>All academic certificates Photocopy with - attested or Showing Original.</li>
 									<li>Photocopy of NID/Passport.</li>
 									<li>All Experience Certificates which is mention in your CV.</li>
 									<li>TIN Certificate. (If Any)</li>
 									<li>Photocopy of reliving letter from previous employer (Show Original).</li>
 									<li>Electricity Bill of your present residence or TNT bill (Update Bill).</li>
 									<li>Previous company Visiting Card.</li>
 								</ol>
 								<li>Your probation period will be Six (6) months from the date of joining. This can be extended for further period up to one year to the Company’s discretion. According to the company policies, during probation period you will not get any facilities. Your service can be terminated by the company within 15 (Fifteen) days notice during this period and if you want to resign from this service you have to inform by notice at least one (1) month during the probation period. After Successful completion of probationary period, you will be confirmed as a permanent employee and eligible to get all facilities existing in the company.</li>
 							</ol>

 							<a>Please return the duplicate copy of this letter to the undersigned signifying of your acceptance of the above terms and conditions.</a>

 							<p>We look forward to you joining our team and hope it is the beginning of a mutually fulfilling association.</p>

 							<p>I have read and accept the terms and conditions stated above without persuasion of others.</p>


 							<div style="position: relative; margin-top: 150px;">

 								<div style="width: 50%; float: left; text-align: left; margin-left: 0%;">
 									<p style=" margin-left: 35px;">-------------------------</p>
 									<p style=" margin-left: 35px;"> Applicant Signature</p>
 								</div>

 								<div style="width: 25%; float: right; text-align: right; margin-right: 20px; ">
 									<p style=" margin-left: 35px;">-----------------------</p>
 									<p style="margin-left: 35px;">HR & Admin</p>
 								</div>
 							</div>

 							<div style="padding-top: 100px;">
 								<h3 align="center"><strong>Annex-A</strong></h3>

 								<p><strong>Name:</strong> <?= $info->PBI_NAME ?></p>

 								<p><strong>Designation:</strong> <?= $info->PBI_DESIGNATION ?></p>

 								<p><strong>Department:</strong> <?= $info->PBI_DEPARTMENT ?></p>

 							</div>


 							<h3 style="padding-top: 50px;"><strong>Compensation Package:</strong></h3>

 							<div style="border: 1px solid black; padding: 10px;">
 								<p>Your monthly consolidate salary is <?= number_format($salary_info->gross_salary) ?>/- (<? echo convertNumberMhafuz($salary_info->gross_salary); ?>) .</p>
 							</div>



 							<div style="padding-top: 100px;">


 								<div style="width: 100%; float: left; text-align: left; margin-left: 0%;">
 									<p style=" margin-left: 35px;">-------------------------</p>
 									<p style=" margin-left: 35px;">HR & Admin</p>
 								</div>

 								<div style="padding-top: 50px;">
 									<p style="padding-top: 50px;">Date of Joining: <?= $info->PBI_DOJ ?></p>

 									<p style="padding-top: 50px;">Signature: ____________________________</p>

 									<p style="padding-top: 50px;">Date: ____________________________</p>
 								</div>

 						</table>
 					</form>





 				<? } elseif ($_POST['report'] == 24) { ?>


 					<?
						$info = find_all_field('personnel_basic_info', '', 'PBI_CODE="' . $_POST['emp_id'] . '"');

						$salary_info = find_all_field('salary_info', '', 'PBI_ID="' . $info->PBI_ID . '"');

						$promotion_info = find_all_field('promotion_detail', '', 'PBI_ID="' . $info->PBI_ID . '"');
						?>

 					<form action="" method="post">

 						<table>
 							<tr>
 								<h2 align="center"><b>ERP.COM.BD LTD</b></h2>
 								<p style="text-align:center;">
 									<u>985 , Street -16,Avenue-02,</u>
 								</p>
 								<p style="text-align:center;">
 									<u>Mirpur DOHS, Mirpur,</u>
 								</p>
 								<p style="text-align:center;">
 									<u>Dhaka-1216, Bangladesh</u>
 								</p>
 							<tr>

 								<p style="text-align:right;margin-top:-24px;padding-right:50px;">Dated:&nbsp;<?= $_POST['effect_date']; ?></p>
 							</tr>
 							</tr>

 							<h3 align="center"><b><u>PROMOTION LETTER</u></b></h3>


 							<div>
 								<p>To,</p>
 								<p>Mr. <?= $info->PBI_NAME ?></p>
 								<p> <?= $promotion_info->PROMOTION_PAST_DESG ?> (<?= $info->PBI_DEPARTMENT ?>)</p>
 								<br>
 								<p><strong>Subject:</strong> Awarding of Promotion as <?= $promotion_info->PROMOTION_PRESENT_DESG ?> (<?= $info->PBI_DEPARTMENT ?>).</p>
 								<br>
 								<p>Dear Mr. <?= $info->PBI_NAME ?>,</p>
 								<br>
 								<a>Congratulations! We are highly pleased to inform you that you have been promoted to <?= $promotion_info->PROMOTION_PRESENT_DESG ?> with same duty and responsibility effect from <?= $promotion_info->PROMOTION_DATE ?>.</a>
 								<br>
 								<a>It is also informed you that your salary is raised to next higher scale according to company pay distribution policy and it has been revised to Tk <?= number_format($salary_info->gross_salary) ?>/- (<? echo convertNumberMhafuz($salary_info->gross_salary); ?>) as monthly gross salary as a part of the Performance Appraisal and Commitment towards the Company. The detailed Salary Structure are as follows:</a>
 								<br>
 								<br>
 								<table>
 									<tr>
 										<th>Particulars</th>
 										<th>Monthly Payable</th>
 									</tr>
 									<tr>
 										<td>Basic Pay</td>
 										<td><?= number_format($salary_info->basic_salary) ?></td>
 									</tr>
 									<tr>
 										<td>House Rent Allowances</td>
 										<td><?= number_format($salary_info->house_rent) ?></td>
 									</tr>
 									<tr>
 										<td>Conveyance Allowances</td>
 										<td><?= number_format($salary_info->ta) ?></td>
 									</tr>
 									<tr>
 										<td>Medical Allowances</td>
 										<td><?= number_format($salary_info->medical_allowance) ?></td>
 									</tr>
 									<tr>
 										<td><strong>Total</strong></td>
 										<td><strong><?= number_format($salary_info->gross_salary) ?></strong></td>
 									</tr>
 								</table>
 								<br>
 								<p>In word: <? echo convertNumberMhafuz($salary_info->gross_salary); ?>.</p>
 								<br>
 								<a>Please accept our personal congratulations on this well-deserved recognition for your continuing excellent contributions and commitment to our organization.</a>
 								<br>
 								<a>We appreciate the efforts put in by you and expect that you would continue to do so in the future. Again, congratulations and best wishes!</a>
 								<br>
 								<a>Your job description is not change. You must be maintaining your previous duties and responsibilities as like same.</a>
 								<br>
 								<p>Thank You,</p>
 								<br>
 								<p>Laboni Yesmin</p>
 								<p> Head of HR &amp; Admin</p>
 								<p> <?= $_SESSION['company_name'] ?></p>
 							</div>
 						</table>
 					</form>


 					<!-- <p style="line-height: 1.8; font-size:13px; padding-left:20px;">
					With reference to your application, we are pleased to offer you an appointment as <b><?= $designation; ?></b>
					at <b><?= $market; ?></b> market on probation with effect from  your date of joining on the following terms and conditions:<br />
					1. Your appointment is subject to satisfactory completion of probation period of six months from
						the date of &nbsp;joining and may be  extended for another period of six months. <br />
					2. During the probation period you will be entitled to a consolidated salary of Tk.<?= $basic_salary; ?> (<?= $basic_salary_inword; ?>)per month. You will also be entitled for daily   allowance, traveling allowance at the rate which company time to time. <br/>                                                                               
					3. You will also be entitled to get travelling expenses as follows:
						Actual  fare only by the cheapest and shortest routes &nbsp;by train, by water transport or by public
						service  road transport.<br />
					4. You will  be entitled for D.A. at the rate of Tk. <?= $da_basemarket; ?> for working at base market or Tk.<?= $da_thertykm; ?>
					for working&nbsp; at EX HQ (30 km away from base market) or Tk.<?= $da_nighthaul; ?> for working&nbsp;and&nbsp; night halting  
						at EX HQ.<br />                
					5. You are forbidden to associate yourself directly or  indirectly with any  other commercial or 
						industrial enterprises.<br />                    	
					6.  Your  job is totally field based hand your service is transferable to any place within  Bangladesh
						at  the discretion of &nbsp;the management.<br />
					7.  Your appointment is subject to agreeing to abide by the Company’s rules and regulations as in force from time to time.<br />
					8.  Your appointment can be terminated at 30 days notice either given or received.</br></br>
						Your above mentioned salary & TD.DA is payable in full subject to your achivement of monthly sales target given from </br> sales department, otherwise payment of your salary     & TA.DA is negotiable.</br>
					Although we &nbsp;understand &nbsp;this offer is acceptable to you, we would appreciate if you please sign the
					duplicate copy &nbsp;of this letter &nbsp;as a token of your having accepted  the appointment on the terms and 
						conditions contained &nbsp;herein.</br>
					</p> -->






 				<? } elseif ($_POST['report'] == 25) { ?>

 					<?
						$info = find_all_field('personnel_basic_info', '', 'PBI_CODE="' . $_POST['emp_id'] . '"'); ?>

 					<form action="" method="post">
 						<table>
 							<tr>
 								<h2 align="center"><b>ERP.COM.BD LTD</b></h2>
 								<p style="text-align:center;">
 									<u>985 , Street -16,Avenue-02,</u>
 								</p>
 								<p style="text-align:center;">
 									<u>Mirpur DOHS, Mirpur,</u>
 								</p>
 								<p style="text-align:center;">
 									<u>Dhaka-1216, Bangladesh</u>
 								</p>
 							<tr>

 								<p style="text-align:right;margin-top:-24px;padding-right:50px;">Dated:&nbsp;<?= $_POST['effect_date']; ?></p>
 							</tr>
 							</tr>

 							<h3 align="center"><b><u>TERMINATION REQUEST LETTER</u></b></h3>


 							<p>To,</p>
 							<p>Mr. <?= $info->PBI_NAME ?></p>
 							<p><?= $info->PBI_DESIGNATION ?></p>
 							<p>Employee ID: <?= $info->PBI_CODE ?>.</p>
 							<h3>Sub: Termination of your services from our organization.</h3>
 							<p>Dear Mr. <?= $info->PBI_NAME ?>,</p>
 							<a>We regret to inform you that your employment with <?= $_SESSION['company_name'] ?> Limited is being terminated with immediate effective from <?= $info->resign_date ?>.</a>
 							<a>On the basis of the above you are hereby terminated & relieved from your services. You will handover the Company property to the HR Department within <?= $info->resign_date ?>.</a>
 							<a>We take this opportunity to thank you for your contribution to the company during the tenure here with us & wish you luck on your future endeavors.</a>
 							<p>Kindly acknowledge the same.</p>
 							<h4>Regards,</h4>
 							<p>For <?= $_SESSION['company_name'] ?> Limited</p>
 							<p>Laboni Yesmin</p>
 							<p>Head of HR & Admin</p>
 							<p><?= $_SESSION['company_name'] ?> </p>

 						</table>
 					</form>



 				<? } elseif ($_POST['report'] == 26) { ?>

 					<?
						$info = find_all_field('personnel_basic_info', '', 'PBI_CODE="' . $_POST['emp_id'] . '"');
						$salary_info = find_all_field('salary_info', '', 'PBI_ID="' . $info->PBI_ID . '"');
						?>

 					<form action="" method="post">
 						<table>
 							<tr>
 								<h2 align="center"><b>ERP.COM.BD LTD</b></h2>
 								<p style="text-align:center;">
 									<u>985 , Street -16,Avenue-02,</u>
 								</p>
 								<p style="text-align:center;">
 									<u>Mirpur DOHS, Mirpur,</u>
 								</p>
 								<p style="text-align:center;">
 									<u>Dhaka-1216, Bangladesh</u>
 								</p>
 							<tr>

 								<p style="text-align:right;margin-top:-24px;padding-right:50px;">Dated:&nbsp;<?= $_POST['effect_date']; ?></p>
 							</tr>
 							</tr>

 							<h3 align="center"><b><u>SALARY CERTIFICATE LETTER</u></b></h3>


 							<h3>TO WHOM SO EVER IT MAY CONCERN</h3>
 							<p>This is to certify that</p>
 							<p>Name: Md. <?= $info->PBI_NAME ?></p>
 							<p>Designation: <?= $info->PBI_DESIGNATION ?> (<?= $info->PBI_DEPARTMENT ?>)</p>
 							<p>Employee ID: <?= $info->PBI_CODE ?></p>
 							<p>is the employee of <?= $_SESSION['company_name'] ?> Limited from <?= $info->PBI_DOJ ?> to <?= $info->resign_date ?>.</p>
 							<p>His compensation is Tk.<?= number_format($salary_info->gross_salary) ?> per month; the detailed salary structure is as follows:</p>
 							<table>
 								<tr>
 									<th>Details</th>
 									<th>Per Month</th>
 								</tr>
 								<tr>
 									<td>Basic Salary</td>
 									<td><?= number_format($salary_info->basic_salary) ?></td>
 								</tr>
 								<tr>
 									<td>House Rent Allowance</td>
 									<td><?= number_format($salary_info->house_rent) ?></td>
 								</tr>
 								<tr>
 									<td>Conveyance Allowance</td>
 									<td><?= number_format($salary_info->ta) ?></td>
 								</tr>
 								<tr>
 									<td>Medical Allowance</td>
 									<td><?= number_format($salary_info->medical_allowance) ?></td>
 								</tr>
 								<tr>
 									<td>Gross Salary Per Month</td>
 									<td><?= number_format($salary_info->gross_salary) ?></td>
 								</tr>
 							</table>
 							<p>In Word: <? echo convertNumberMhafuz($salary_info->gross_salary); ?>.</p>
 							<p>This letter is issued against individual’s request for using as future reference if required.</p>

 						</table>
 					</form>


 				<? } elseif ($_POST['report'] == 27) { ?>

 					<?
						$info = find_all_field('personnel_basic_info', '', 'PBI_CODE="' . $_POST['emp_id'] . '"');
						$salary_increment = find_all_field('increment_detail', '', 'PBI_ID="' . $info->PBI_ID . '"');

						?>

 					<form action="" method="post">
 						<table>
 							<tr>
 								<h2 align="center"><b>ERP.COM.BD LTD</b></h2>
 								<p style="text-align:center;">
 									<u>985 , Street -16,Avenue-02,</u>
 								</p>
 								<p style="text-align:center;">
 									<u>Mirpur DOHS, Mirpur,</u>
 								</p>
 								<p style="text-align:center;">
 									<u>Dhaka-1216, Bangladesh</u>
 								</p>
 							<tr>

 								<p style="text-align:right;margin-top:-24px;padding-right:50px;">Dated:&nbsp;<?= $_POST['effect_date']; ?></p>
 							</tr>
 							</tr>

 							<h3 align="center"><b><u>INCREMENT LETTER</u></b></h3>


 							<p>To,</p>
 							<p>Mr. <?= $info->PBI_NAME ?></p>
 							<p><?= $info->PBI_DESIGNATION ?></p>
 							<p>Employee ID: <?= $info->PBI_CODE ?>.</p>

 							<h3>Dear Mr. <?= $info->PBI_NAME ?></h3>
 							<a>We have the pleasure to inform you that management has decided to increase your salary by awarding a salary increment with effect from <?= $salary_increment->INCREMENT_EFFECT_DATE ?> evaluating your professional dedication, good effort & loyalty to the job.</a>
 							<a>We take this opportunity to congratulate you and express our deepest appreciation for your valuable contribution in achieving the company’s objectives. We are confident that you will continue your best in the same spirit of commitment and sincerity for the development of the organization in future.</a>
 							<a>Your revised salary breakdown is as follows:</a>
 							<table>
 								<tr>
 									<th>S. No</th>
 									<th>Particulars</th>
 									<th>Monthly Payable</th>
 								</tr>
 								<tr>
 									<td>1.</td>
 									<td>Basic Pay</td>
 									<td><?= number_format($new_basic_salary->basic_salary) ?></td>
 								</tr>
 								<tr>
 									<td>2.</td>
 									<td>House Rent Allowances</td>
 									<td><?= number_format($new_house_rent->house_rent) ?></td>
 								</tr>
 								<tr>
 									<td>3.</td>
 									<td>Conveyance Allowances</td>
 									<td><?= number_format($salary_increment->ta) ?></td>
 								</tr>
 								<tr>
 									<td>4.</td>
 									<td>Medical Allowances</td>
 									<td><?= number_format($salary_increment->medical_allowance) ?></td>
 								</tr>
 								<tr>
 									<td></td>
 									<td><strong>Total</strong></td>
 									<td><strong><?= number_format($salary_increment->new_consolidated_salary) ?></strong></td>
 								</tr>
 							</table>
 							<p>In word: <? echo convertNumberMhafuz($salary_increment->new_consolidated_salary); ?>.</p>
 							<p>All other terms and conditions of your employment will remain unchanged.</p>
 							<p>Best regards,</p>
 							<p>Laboni Yesmin</p>
 							<p>Head of HR & Admin</p>
 							<p><?= $_SESSION['company_name'] ?></p>

 						</table>
 					</form>




 				<? } elseif ($_POST['report'] == 28) { ?>


 					<?
						$info = find_all_field('salary_holy_day', '', '1');
						?>

 					<form action="" method="post">
 						<table>
 							<tr>
 								<h2 align="center"><b><?= $_SESSION['company_name'] ?></b></h2>
 								<p style="text-align:center;">

 									<u align="center">House # 158/E, Kamal Ataturk Avenue, Banani, Dhaka-1213.</u>
 								</p>
 							<tr>
 								<p style="text-align:right;margin-top:-24px;padding-right:50px;">Dated:&nbsp;<?= $_POST['effect_date']; ?></p>
 							</tr>
 							</tr>
 							<br>
 							<h3 align="center"><b><u>HOLIDAY NOTICE LETTER</u></b></h3>



 							<br>
 							<div>
 								<a>All employees serving in <?= $_SESSION['company_name'] ?>, we do hereby inform you that the office will remain closed on <?= $info->holy_day ?> due to celebrating ‘<?= $info->reason ?>’. It’s our pride to have the global recognition of that day.</a>
 								<p>We wish you all to uphold the significance of that day & convey to the tenders for inspiration.</p>
 								<p>See you after holiday.</p>
 							</div>
 							<div>
 								<br>
 								<p><strong>HR & Admin Department</strong></p>
 								<p><?= $_SESSION['company_name'] ?></p>
 							</div>

 						</table>
 					</form>

 					<!--You will also be entitled for D.A. at the rate of Tk. <?= $data2->DA; ?> for working at base market or Tk. <?= $data2->TA; ?> for  working at<br />
					EX HQ ( 30 km away from base market ) or Tk.  <?= $data2->total_night; ?> ( <?= $data2->Night; ?>) for working & night halting at EX HQ.<br /></br>
					You above mentioned salary & TD.DA is payable in full subject to your achivement of </br>monthly sales terget given from sales department.  otherwise payment of your salary & TA.DA is negotiable.</br></br>
					Although we understand this offer is acceptable to you, we would appreciate if you please sign the duplicate<br /> 
					copy of this letter as a token of your acceptance of the appointment on the terms and conditions contained<br />
					herein.</br></br>
					-->




 					<!--
 									
 							<tr>
 								<h2 align="center"><b></b></h2>
 								<p style="text-align:center;">
 									<br /><br />
 									<br /><br />
 									<br /><br />
 									<u>Mirpur,Dhaka-1216</u>
 								</p>
 							<tr>
 								<p style="padding-left:100px;">NO:<?= $appointment_letterno . "/" . $emp_id; ?></p>
 								<p style="text-align:right;margin-top:-24px;padding-right:50px;">Date:<?= date('d:m:Y'); ?></p>
 							</tr>
 							</tr>
 							<tr>
 							</tr>
 							<tr>
 								<h3 align="center"><b><u>MEMORANDUM</u></b></h3>
 								<p style="line-height: 1.8; font-size:14px; padding-left:80px;">
 									The management is pleased to promote you as <b><?= $designation; ?></b> with effect from <?= $effect_date; ?>in grade <b><?= $grade_name; ?></b> in the pay scale-2019 of Tk.<b><?= $data2->zero_increment . " -" . $data2->each_increment . "- " . $data2->upto_ten_incre . " -" . $data2->each_increment_two . "- " . $data2->up_to_twenty_incre; ?>/-</b> and your basic salary has been fixed at Tk <b><?= $salary . ".00"; ?></b> per month. <br />
 									You will be entitled to the following allowances in addition to your basic salary:<?= $emp_id; ?>
 								</p>
 								<p style="line-height: 1.8; font-size:12px; padding-left:80px;">
 								<p style="line-height: 1.8;text-align:center; font-size:12px; ">
 								<table style=" margin:0 auto;border:none; font-size:13px;">
 									<tr>
 										<td style="border:none;">(a) House Rent Allowance ( 50% on basic)</td>
 										<td style="border:none;"><?= $houserent = ($salary * 50) / 100; ?></td>
 									</tr>
 									<tr>
 										<td style="border:none;">(b) Medical Allowance ( 40% on basic)</td>
 										<td style="border:none;"><?= $medical = ($salary * 40) / 100; ?></td>
 									</tr>
 									<tr>
 										<td style="border:none;">(c) Conveyance Allowance ( 70% on basic)</td>
 										<td style="border:none;"><?= $convence = ($salary * 70) / 100; ?></td>
 									</tr>
 									<tr>
 										<td style="border:none;">(d) Standard of Living Allowance ( 80% on basic)</td>
 										<td style="border:none;"> <?= $standardliving = ($salary * 80) / 100; ?></td>
 									</tr>
 									<tr>
 										<td style="border:none;">(e) Supplementary Allowance</td>
 										<td style="border:none;"> <?= $constry_allowance = find_a_field('salary_info', 'comstry_allowance', 'PBI_ID=' . $emp_id); ?></td>
 									</tr>
 									<tr>
 										<th style="text-align:right;border:none;" colspan="2">-------------------<br />Total TK = <?php echo $salary + $houserent + $medical + $convence + $standardliving + $constry_allowance; ?></th>
 									</tr>
 								</table>
 								<br /><br />
 								</p>
 								<p style="line-height: 1.8; font-size:12px; padding-left:80px;">
 									The management expects that you will contribute to the growth of the company by integrity and faithful discharge of your responsibilities.<br />
 									<br />
 								</p>
 							</tr>
 							<tr>
 								<p style="text-align:right;padding-right:50px;">
 									<br />
 								</p>
 								<p style="text-align:right;padding-right:59px;">
 									Managing Director <br />
 								</p>
 								<p style="line-height: 1.8; font-size:12px; padding-left:80px;">
 									To<br />
 									<?= $data1->PBI_NAME; ?><br />
									<?= $designation; ?><br />
 									<br />
 									<br /><br />
 									<u>Copy forwarded for necessary action to :</u><br />
 								</p>
 							</tr>
							-->







 				<? } elseif ($_POST['report'] == 25) { ?>





 					echo "good JOb3";







 				<? } elseif ($_POST['report'] == 100) {



					?>

 					<form action="" method="post">

 						<table>

 							<tr>

 								<h2 align="center"><b>ERP COM BD</b></h2>

 								<p style="text-align:center;">

 									<br /><br />

 									<br /><br />

 									<br /><br />

 									<u>Mirpur,Dhaka-1216</u>
 								</p>

 							<tr>

 								<p style="padding-left:100px;">NO:<?= $appointment_letterno . "/" . $emp_id; ?></p>

 								<p style="text-align:right;margin-top:-24px;padding-right:50px;">Date:<?= date('d:m:Y'); ?></p>

 							</tr>

 							</tr>

 							<tr>



 							</tr>



 							<tr>

 								<h3 align="center"><b><u>MEMORANDUM</u></b></h3>

 								<p style="line-height: 1.8; font-size:14px; padding-left:80px;">

 									The management is pleased to confirm your job promote you as <b><?= $designation; ?></b> with effect from <?= $effect_date; ?> in grade <b><?= $grade_name; ?></b> in the pay scale-2019 of Tk.<b><?= $data2->zero_increment . " -" . $data2->each_increment . "- " . $data2->upto_ten_incre . " -" . $data2->each_increment_two . "- " . $data2->up_to_twenty_incre; ?>/-</b> and your basic salary has been fixed at Tk <b><?= $salary . ".00"; ?></b> per month. <br />

 									You will be entitled to the following allowances in addition to your basic salary:

 								</p>

 								<p style="line-height: 1.8; font-size:12px; padding-left:80px;">





 								<p style="line-height: 1.8;text-align:center; font-size:12px; ">

 								<table style=" margin:0 auto;border:none; font-size:13px;">

 									<tr>

 										<td style="border:none;">(a) House Rent Allowance ( 50% on basic)</td>

 										<td style="border:none;"><?= $houserent = ($salary * 50) / 100; ?></td>

 									</tr>

 									<tr>

 										<td style="border:none;">(b) Medical Allowance ( 40% on basic)</td>

 										<td style="border:none;"><?= $medical = ($salary * 40) / 100; ?></td>

 									</tr>

 									<tr>

 										<td style="border:none;">(c) Conveyance Allowance ( 70% on basic)</td>

 										<td style="border:none;"><?= $convence = ($salary * 70) / 100; ?></td>

 									</tr>

 									<tr>

 										<td style="border:none;">(d) Standard of Living Allowance ( 80% on basic)</td>

 										<td style="border:none;"> <?= $standardliving = ($salary * 80) / 100; ?></td>

 									</tr>

 									<tr>

 										<td style="border:none;">(e) Supplimentary Allowance</td>

 										<td style="border:none;"> <?= $constry_allowance = find_a_field('salary_info', 'comstry_allowance', 'PBI_ID=' . $emp_id); ?></td>

 									</tr>

 									<tr>

 										<th style="text-align:right;border:none;" colspan="2">-------------------<br />Total TK = <?php echo $salary + $houserent + $medical + $convence + $standardliving + $constry_allowance; ?></th>



 									</tr>



 								</table>



 								<br /><br />



 								</p>



 								<p style="line-height: 1.8; font-size:12px; padding-left:80px;">

 									You will also be entitled for D.A. at the rate of Tk. <?= $data2->TA; ?> for working at base market or Tk. <?= $data2->DA; ?> for working at<br />

 									EX HQ ( 30 km away from base market ) or Tk. <?= $data2->total_night; ?> ( <?= $data2->Night; ?>) for working & night halting at EX HQ.<br /><br />



 									Your above mentioned salary & TD.DA is payable in full subject to your achivement of monthly sales target<br> given from sales department; otherwise payment of your salary & TA.DA is negotiable.</br></br>



 									The management expects that you will contribute to the growth of the company by integrity and faithful discharge of your responsibilities.<br />

 									<br />





 								</p>

 							</tr>

 							<tr>

 								<p style="text-align:right;padding-right:50px;">

 									<br />



 								</p>

 								<p style="text-align:right;padding-right:59px;">

 									Managing Director <br />



 								</p>

 								<p style="line-height: 1.8; font-size:12px; padding-left:80px;">

 									To<br />

 									<?= $data1->PBI_NAME; ?><br />

 									<?= $designation; ?><br />

 									<br />

 									<?= $market; ?> Market<br /><br />

 									<u>Copy forwarded for necessary action to :</u><br />



 								</p>

 							</tr>





 						</table>



 					</form>

 				<?
				} elseif ($_POST['report'] == 26) {

					?>





 					<table width="20%" cellpadding="0" cellspacing="0" border="0">





 						<tr>

 							<th>Market</th>

 							<th>Potential Factor</th>



 						</tr>

 						<?php

							$sql = 'select AREA_NAME,POTEN_FACT from area where 1';

							$query = mysql_query($sql);



							while ($data = mysql_fetch_object($query)) {

							?>

 							<tr>



 								<td><?= $data->AREA_NAME ?></td>



 								<td><?= $data->POTEN_FACT ?></td>



 							</tr>

 						<?php } ?>





 					</table>





 				<?

				} elseif ($_POST['report'] == 10) {

					?>

 					<table width="100%" cellpadding="0" cellspacing="0" border="0">

 						<tr>

 							<th>ASM/RSM/AM</th>

 							<th>ASS/SS</th>

 							<th colspan="8" style="text-align: center;">SR/SSR</th>

 						<tr>



 						<tr>

 							<th></th>

 							<th></th>

 							<th>SL</th>

 							<th>Name</th>

 							<th> Designation</th>

 							<th>Market</th>

 							<th>Joining Date</th>

 							<th> New Salary</th>

 							<th>Home District</th>

 							<th>Mobile Number</th>

 						</tr>

 						<?php

							$sql = 'select p.PBI_NAME,p.PBI_DESIGNATION,p.PBI_DOJ,p.PBI_POB,p.PBI_MOBILE,p.PBI_ZONE,p.PBI_AREA,s.consolidated_salary,r.AREA_CODE,r.AREA_NAME from personnel_basic_info p,salary_info s,area r where p.PBI_ID=s.PBI_ID AND p.PBI_AREA=r.AREA_CODE';

							$query = mysql_query($sql);



							while ($data = mysql_fetch_object($query)) {

							?>

 							<tr>

 								<td></td>

 								<td><?= find_a_field('zon', 'ZONE_NAME', 'ZONE_CODE=' . $data->PBI_ZONE) ?></td>

 								<td><?= ++$i ?></td>

 								<td><?= $data->PBI_NAME ?></td>

 								<td><?= find_a_field('designation', 'DESG_DESC', 'DESG_ID=' . $data->PBI_DESIGNATION) ?></td>

 								<td><?= $data->AREA_NAME ?></td>

 								<td><?= $data->PBI_DOJ ?></td>

 								<td><?= $data->consolidated_salary ?></td>

 								<td><?= $data->PBI_POB ?></td>

 								<td><?= $data->PBI_MOBILE ?></td>

 							</tr>

 						<?php } ?>





 					</table>



 				<? } elseif ($_POST['report'] == 101) { ?>

 					<?
						$info = find_all_field('personnel_basic_info', '', 'PBI_CODE="' . $_POST['emp_id'] . '"');
						$salary_info = find_all_field('salary_info', '', 'PBI_ID="' . $info->PBI_ID . '"');
						$promotion_info = find_all_field('promotion_detail', '', 'PBI_ID="' . $info->PBI_ID . '"');
						?>


<style>
table tr td, table tr th{
border: none !important;
text-align:justify;
}

</style>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
  <tr>
    <td>তারিখ :</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>প্রতি,</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>নাম : মোঃ আবু তাহের</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>আইডি নং : ২৮৪	</td>
    <td>পদবী : </td>
  </tr>
  <tr>
    <td>ফ্যাক্টরী : </td>
    <td>বিভাগ  : </td>
  </tr>
</table>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
  <tr>
    <td>বিষয়ঃ বদলী প্রসঙ্গে</td>
  </tr>
</table><br>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
  <tr>
    <td>জনাব,</td>
  </tr>
  <tr>
    <td>আপনার সদয় অবগতির জন্য জানানো যাইতেছে যে, কোম্পানীর প্রয়োজনে কর্তৃপক্ষ আপনাকে .......... বিভাগ এর .......... সেকশন হইতে প্রডাকশন বিভাগ এর ঝবরিহম সেকশনে বদলি করার সিদ্ধান্ত গ্রহন করেছে যাহা আগামী ১ লা জুন ২০১৬ ইং তারিখ হইতে কার্যকর হইবে ।</td>
  </tr>
  <tr>
    <td>আপনার বর্তমান দায়িত্ব আপনার সুপারভাইজারকে বুিঝয়ে দিয়ো আগামী ১ লা জুন ২০১৬ ইং তারিখে ............ এর সুপারভাইজারকে রিপোট পূর্বক নতুন দায়িত্ব বুঝে নেওয়ার জন্য অনুরোধ করা যাইতেছে ।</td>
  </tr>
  <tr>
    <td><ul type="square">
	
		<li>আপনার মাসিক বেতন এবং অন্যান্য সুবিধাদি নিমোক্ত হারে পুন:নির্ধারণ করা হইল।</li>
		<li>আপনার মাসিক বেতন এবং অন্যান্য সুবিধাদি নিয়োগের শর্তানুযায়ী অপরিবর্তিত থাকবে।</li>
	</ul></td>
  </tr>
</table><br><br>
<table width="100%" border="1"  cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
  <tr>
    <td>আপনার  বিশ্বস্ত,</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="text-decoration:overline;">এইচ আর এন্ড কম্প্লায়েন্স</td>
  </tr>
</table> <br>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
  <tr>
    <td>&nbsp;</td>
    <td>গ্রহন করিলাম</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>অনুলিপি:</td>
    <td>স্বাক্ষরঃ</td>
  </tr>
  <tr>
    <td>ব্যক্তিগত নথি</td>
    <td>তারিখঃ</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>




 				<? } elseif ($_POST['report'] == 102) { ?>

 					<?
						$info = find_all_field('personnel_basic_info', '', 'PBI_CODE="' . $_POST['emp_id'] . '"');
						$salary_info = find_all_field('salary_info', '', 'PBI_ID="' . $info->PBI_ID . '"');
						$promotion_info = find_all_field('promotion_detail', '', 'PBI_ID="' . $info->PBI_ID . '"');
						?>


<style>
table tr td, table tr th{
border: none !important;
text-align:justify;
line-height:25px;
}
</style>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
  <tr>
    <td>তারিখঃ</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>প্রতি,</td>
  </tr>
  <tr>
    <td width="20%">নাম</td>
	<td width="5%">&#10245;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td>আইডি নং</td>
	<td>&#10245;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td>পদবী </td>
	<td>&#10245;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td>ফ্যাক্টরী </td>
	<td>&#10245;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td>বিভাগ</td>
	<td>&#10245;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  </table>
  
  <table width="100%" border="0" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
  <tr>
    <td>বিষয়ঃ ইনক্রিমেন্ট</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>জনাব/বেগম,</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>এই মর্মে আপনাকে জানানো যাইতেছে যে, আপনার বিগত দিনের কর্ম মূল্যায়ন করে কর্তৃপক্ষের নিকট সন্তোসজনক পরিলক্ষিত হওয়াতে আপনার বেতন বৃদ্ধি করার সিদ্ধান্ত গ্রহন
	 করেছে যাহা ..................ইং তারিখ  হইতে কার্যকর হইবে। 
</td>
  </tr>
  <tr>
    <td>আপনার মাসিক বেতন এবং  অন্যান্য সুবিধাদি নিম্নোক্ত হারে পুনঃনির্ধারন  করা হইলঃ</td>
  </tr>
  
  
</table>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
  <tr>
    <td width="20%">মূল বেতন</td>
    <td width="5%">&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>বাড়ী ভাড়া ভাতা</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>চিকিৎসা ভাতা</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td>যাতায়াত ভাতা</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>খাদ্য ভাতা</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>অন্যান্য ভাতা</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><hr></td>
    
  </tr>
  <tr>
    <td>সর্বসাকুল্যে</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  
</table>

<br><br><br><br><br><br>

<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
  <tr>
    <td width="50%">আপনার বিশ্বস্থ, </td>
    <td width="50%">&nbsp;</td>
  </tr>
  
  <tr>
    <td width="50%">&nbsp;</td>
    <td width="50%">গ্রহন করিলাম-</td>
  </tr>
  <tr>
    <td width="50%">&nbsp;</td>
    <td width="50%">&nbsp;</td>
  </tr>
  <tr>
    <td width="50%">&nbsp;</td>
    <td width="50%">&nbsp;</td>
  </tr>
  <tr>
    <td width="50%" style="text-decoration:overline;">এইচ আর এন্ড কমপ্লায়েন্স</td>
    <td width="50%">স্বাক্ষরঃ ..................................................</td>
  </tr>
  <tr>
    <td width="50%">অনুলিপিঃ</td>
    <td width="50%">তারিখঃ ..................................................</td>
  </tr>
  <tr>
    <td width="50%">ব্যক্তিগত নথি</td>
    <td width="50%">&nbsp;</td>
  </tr>
</table>


 				<? } elseif ($_POST['report'] == 103) { ?>

 					<?
						$info = find_all_field('personnel_basic_info', '', 'PBI_CODE="' . $_POST['emp_id'] . '"');
						$salary_info = find_all_field('salary_info', '', 'PBI_ID="' . $info->PBI_ID . '"');
						$promotion_info = find_all_field('promotion_detail', '', 'PBI_ID="' . $info->PBI_ID . '"');
						?>


<style>
table tr td, table tr th{
border: none !important;
text-align:justify;
line-height:25px;
}
</style>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
  <tr>
    <td>তারিখঃ</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>প্রতি,</td>
  </tr>
  <tr>
    <td width="20%">নাম</td>
	<td width="5%">&#10245;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td>আইডি নং</td>
	<td>&#10245;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td>পদবী </td>
	<td>&#10245;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td>ফ্যাক্টরী </td>
	<td>&#10245;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td>বিভাগ</td>
	<td>&#10245;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  </table>
  
  <table width="100%" border="0" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
  <tr>
    <td>বিষয়ঃ ইনক্রিমেন্ট</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>জনাব/বেগম,</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>এই মর্মে আপনাকে জানানো যাইতেছে যে, আপনার বিগত দিনের কর্ম মূল্যায়ন করে কর্তৃপক্ষের নিকট সন্তোসজনক পরিলক্ষিত হওয়াতে আপনার বেতন বৃদ্ধি করার সিদ্ধান্ত গ্রহন
	 করেছে যাহা ..................ইং তারিখ  হইতে কার্যকর হইবে। 
</td>
  </tr>
  <tr>
    <td>আপনার মাসিক বেতন এবং  অন্যান্য সুবিধাদি নিম্নোক্ত হারে পুনঃনির্ধারন  করা হইলঃ</td>
  </tr>
  
  
</table>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
  <tr>
    <td width="20%">মূল বেতন</td>
    <td width="5%">&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>বাড়ী ভাড়া ভাতা</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>চিকিৎসা ভাতা</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td>যাতায়াত ভাতা</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>খাদ্য ভাতা</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>অন্যান্য ভাতা</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><hr></td>
    
  </tr>
  <tr>
    <td>সর্বসাকুল্যে</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  
</table>

<br><br><br><br><br><br>

<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
  <tr>
    <td width="50%">আপনার বিশ্বস্থ, </td>
    <td width="50%">&nbsp;</td>
  </tr>
  
  <tr>
    <td width="50%">&nbsp;</td>
    <td width="50%">গ্রহন করিলাম-</td>
  </tr>
  <tr>
    <td width="50%">&nbsp;</td>
    <td width="50%">&nbsp;</td>
  </tr>
  <tr>
    <td width="50%">&nbsp;</td>
    <td width="50%">&nbsp;</td>
  </tr>
  <tr>
    <td width="50%" style="text-decoration:overline;">এইচ আর এন্ড কমপ্লায়েন্স</td>
    <td width="50%">স্বাক্ষরঃ ..................................................</td>
  </tr>
  <tr>
    <td width="50%">অনুলিপিঃ</td>
    <td width="50%">তারিখঃ ..................................................</td>
  </tr>
  <tr>
    <td width="50%">ব্যক্তিগত নথি</td>
    <td width="50%">&nbsp;</td>
  </tr>
</table>


 				<? } elseif ($_POST['report'] == 104) { ?>

 					<?
						$info = find_all_field('personnel_basic_info', '', 'PBI_CODE="' . $_POST['emp_id'] . '"');
						$salary_info = find_all_field('salary_info', '', 'PBI_ID="' . $info->PBI_ID . '"');
						$promotion_info = find_all_field('promotion_detail', '', 'PBI_ID="' . $info->PBI_ID . '"');
						?>

<style>
table tr td, table tr th{
border:none !important;
text-align:justify;

}

</style>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
  <tr>
    <td>তারিখঃ </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>প্রতি,</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="15%">নাম</td>
	<td width="5%">&#10245;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td>আইডি নং</td>
	<td>&#10245;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td> পদবী</td>
	<td>&#10245;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td>ফ্যাক্টরী</td>
	<td>&#10245;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td>বিভাগ</td>
	<td>&#10245;</td>
	<td>&nbsp;</td>
  </tr>
  </table>
  
  <table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>বিষয়ঃ পদন্নোতি পত্র</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>জনাব/বেগম,</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>এই মর্মে আপনাকে অত্যন্ত আনন্দের সাথে জানানো যাইতেছে যে, আপনার বিগত বছরের কর্ম মূল্যায়ন এবং পর্যালোচনা করে কর্তৃপক্ষের নিকট সন্তোসজনক বিবেচিত হওয়ায় আপনাকে
	 পদন্নোতি প্রদানের সিদ্ধান্ত নেওয়া হয়েছে। আপনার পদবী পূনঃনির্ধারন পূর্বক পদবী ........., গ্রেড Grade –  এ নির্ধারন করা হইল যাহা ..................ইং  তারিখ  হইতে কার্যকর হইবে।</td>
  </tr>
  <tr>
    <td>আপনার মাসিক বেতন এবং  অন্যান্য সুবিধাদি নিম্নোক্ত হারে পুনঃনির্ধারন  করা হইলঃ / আপনার মাসিক বেতন ও অন্যান্য সুবিধাদি অপরিবর্তিত থাকবে।</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  
</table>

<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
  <tr>
    <td width="20%">মূল বেতন</td>
    <td width="5%">&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>বাড়ী ভাড়া ভাতা</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>চিকিৎসা ভাতা</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>যাতায়াত ভাতা</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>খাদ্য ভাতা</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>অন্যান্য ভাতা</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><hr></td>
   
  </tr>
  <tr>
    <td>মোট</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>আপনার বিশ্বস্থ,</td>
    <td>গ্রহন করিলাম-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td width="50%" style="text-decoration:overline;">এইচ আর এন্ড কমপ্লায়েন্স</td>
    <td width="50%">স্বাক্ষরঃ ..................................................</td>
  </tr>
  <tr>
    <td width="50%">অনুলিপিঃ</td>
    <td width="50%">তারিখঃ ..................................................</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>





 				<? } elseif ($_POST['report'] == 105) { ?>

 					<?
						$info = find_all_field('personnel_basic_info', '', 'PBI_CODE="' . $_POST['emp_id'] . '"');
						$salary_info = find_all_field('salary_info', '', 'PBI_ID="' . $info->PBI_ID . '"');
						$promotion_info = find_all_field('promotion_detail', '', 'PBI_ID="' . $info->PBI_ID . '"');
						?>

<style>
.bor-none{

border:none!important;
line-height:35px;
}

</style>


<table width="100%" border="0" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px; border:none!important;">
  <tr style="border:none!important;" class="bor-none">
    <td colspan="2" class="bor-none" >তারিখঃ</td>
    <td rowspan="3" class="bor-none" align="right"><div style="padding: 4px;
    border: 1px solid black;
    
    text-align: center;
    height: 138px;
    width: 133px;" > রঙ্গীন ছবি</div></td>
  </tr>
  <tr>
    <td colspan="2" class="bor-none">এইচ আর, এডমিন এন্ড কমপ্লায়েন্স বিভাগ</td>
    
  </tr>
  <tr>
    <td colspan="2" class="bor-none">মাহির গ্রুপ</td>
    
  </tr>
  <tr>
    <td colspan="3" class="bor-none">বিষয়ঃ অত্র ------------------------------------------------------------------------------- কারখানায় ------------------------------------------------- পদে চাকুরী প্রাপ্তির আবেদন।</td>
    
  </tr>
</table><br><br><br>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;" class="bor-none">
  <tr>
    <td colspan="3" style="text-align:center; font-weight:bold;" class="bor-none">জীবন বৃত্তান্ত</td>
    
  </tr>
  <tr>
    <td colspan="3" class="bor-none">০১। পূর্ন নাম (ডাক নাম সহ) ----------------------------------------------- ফোন নং ----------------------------------------</td>
    
  </tr>
  <tr>
    <td colspan="3" class="bor-none">০২। পিতার নামঃ ------------------------------পেশাঃ --------------</td>
    
  </tr>
  <tr>
    <td colspan="3" class="bor-none">০৩। মাতার নামঃ ------------------------০৪। স্বামী/স্ত্রীর নামঃ ------------------------পেশাঃ -----------------</td>
    
  </tr>
  <tr>
    <td colspan="3" class="bor-none">০৫। স্থানীয় অভিবাবকের নামঃ ----------------------- সম্পর্কঃ -------------------ফোন নং --------------</td>
   
  </tr>
  <tr>
    <td  colspan="3" class="bor-none">০৬। বর্তমান ঠিকানা- বাসা নং --------------------- বাড়ীর মালিকের নামঃ -------------------</td>
    
  </tr>
  <tr>
    <td colspan="3" class="bor-none">পাড়া/মহল্লাঃ -------------  ডাকঘরঃ --------------------  থানাঃ -----------------জেলাঃ ----------------</td>
    
  </tr>
  <tr>
    <td colspan="3" class="bor-none">০৭। স্থায়ী ঠিকানা- গ্রামঃ -------------  ডাকঘরঃ ----------------  থানাঃ ----------------জেলাঃ -------------</td>
    
  </tr>
  <tr>
    <td colspan="2" class="bor-none">০৮। জাতীয় পরিচয় পত্র নংঃ</td>
    <td class="bor-none">০৯। জন্ম নিবন্ধন নংঃ</td>
    
  </tr>
  <tr>
    <td colspan="3" class="bor-none">১০। জন্ম তারিখঃ ......... /........ /........    ১১।  জাতীয়তাঃ ----------------------- ১২। ধর্মঃ-----------------</td>

  </tr>
</table><br>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
  <tr>
    <td colspan="4" class="bor-none">১৩। বৈবাহিক অবস্থাঃ বিবাহিত/ অবিবাহিত, বিবাহিত হলে সন্তান সম্পর্কিত তথ্য ( যদি থাকে ) </td>
   
  </tr>
  <tr>
    <td>ক্রম</td>
    <td>সন্তানের নাম	বয়স</td>
    <td>জন্ম তারিখ </td>
    <td>শিশু হলে তত্বাবধায়কের নাম, সম্পর্ক ও ঠিকানা</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table><br>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
  <tr>
    <td colspan="6" class="bor-none">১৪। শিক্ষাগত যোগ্যতার বিবরনীঃ  </td>
   
  </tr>
  <tr>
    <td>পরীক্ষার নাম</td>
    <td>প্রতিষ্ঠানের নাম</td>
    <td>শাখা/ বিভাগ</td>
    <td>পাশের সন</td>
    <td>ফলাফল</td>
    <td>বোর্ড</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<br>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
  <tr>
    <td colspan="5" class="bor-none">১৫। সা¤প্রতিক/ বিগত তিন কর্মস্থলের বিবরনী (যদি থাকে )</td>
    
  </tr>
  <tr>
    <td>নিয়োগকারী প্রতিষ্ঠানের নাম	</td>
    <td>চাকুরীর মেয়াদকাল</td>
    <td>পদবী (সর্বশেষ)</td>
    <td>বেতন/মজুরী</td>
    <td>কর্মত্যাগের কারন</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table><br>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
  <tr>
    <td colspan="4" class="bor-none">১৬। চাকুরী সম্পর্কিত প্রশিক্ষন, দক্ষতা এবং অন্যান্য যোগ্যতার সংক্ষিপ্ত বিবরনীঃ</td>
    
  </tr>
  <tr>
    <td>প্রশিক্ষনের বিষয়</td>
    <td>প্রশিক্ষন প্রদানকারী প্রতিষ্ঠানের নাম ও ঠিকানা</td>
    <td>দক্ষতা</td>
    <td>প্রশিক্ষনকাল/ তারিখ </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table><br><br>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
  <tr>
    <td colspan="3" class="bor-none">১৭। রেফারেন্স/পরিচিত ব্যক্তিঃ ক) নামঃ ------------------------- ঠিকানাঃ-------------------------
ফোন নং-------------------------</td>
    
  </tr>
  <tr>
    <td colspan="3" class="bor-none">খ) অত্র প্রতিষ্ঠানে- নামঃ -------------------------------------------------- আইডি নং -------------------------------------------</td>
    
  </tr>
  <tr>
    <td colspan="3" class="bor-none">সম্পর্কঃ ---------------------------------- ফোন নং---------------------	স্বাক্ষরঃ----------</td>
   
  </tr>
  <tr>
    <td colspan="3" class="bor-none">&nbsp;</td>
   
  </tr>
  <tr>
    <td colspan="3" class="bor-none">পরিশেষে আমি এই মর্মে সত্য শপথ করিয়া প্রত্যয়ন করিতেছি যে, উপরে বর্ণিত সকল তথ্য সত্য এবং আমি কোন মিথ্যা তথ্য প্রদান করিনাই। আমি আরো প্রত্যয়ন করিতেছি যে, ইতিপূর্বে আমি কোন রাষ্ট্রবিরোধী বা আইন শৃঙ্খলা পরিপন্থি কোন কাজে জড়িত ছিলাম না। আমার বিরুদ্ধে কোথাও কোন মামলা মোকদ্দমা নাই। যদি ভবিষ্যতে উপরে প্রদত্ত কোন তথ্য মিথ্যা প্রমাণিত হয় তবে স্বেচ্ছায় চাকুরী ত্যাগ করিব এই মর্মে এতদ্বারা অঙ্গীকার করিতেছি। উল্লেখ থাকে যে, আমার বর্তমান ঠিকানা ভবিষ্যতে কোন পরিবর্তন হইলে লিখিতভাবে তাহা আমি কর্তৃপক্ষকে জানাইব। </td>
    
  </tr>
  <tr>
    <td colspan="3" class="bor-none">&nbsp;</td>
   
  </tr>
  <tr>
    <td colspan="3" class="bor-none">আবেদনকারীর নাম (স্ব-হস্তে) --------------------------------------</td>
   
  </tr>
  <tr>
    <td colspan="3" class="bor-none">স্বাক্ষরঃ................................................</td>
   
  </tr>
  <tr>
    <td colspan="3" class="bor-none">&nbsp;</td>
   
  </tr>
  <tr>
    <td colspan="3" class="bor-none">সংযুক্তিঃ</td>
   
  </tr>
  <tr>
    <td colspan="3" class="bor-none">১) রঙ্গীন ছবি-পিপি সাইজ ৪ কপি, স্ট্যাম্প সাইজ ১ কপি; 	   ২) জন্ম নিবন্ধন /জাতীয় পরিচয় পত্রের সত্যায়িত অনুলিপি;</td>
   
  </tr>
  <tr>
    <td colspan="3" class="bor-none"> ৩) নিজ এলাকার চেয়ারম্যান/কমিশনারের সা¤প্রতিক সার্টিফিকেট;  ৪) শিক্ষাগত ও অভিজ্ঞতার সনদ, ড্রাউভিং লাইসেন্স এর ফটো কপি (যদি থাকে)।</td>
   
  </tr>
  <tr>
    <td colspan="3" class="bor-none">&nbsp;</td>
   
  </tr>
  <tr>
    <td colspan="3" class="bor-none">অফিস কর্তৃক পূরনীয়-    </td>
 
  </tr>
  <tr>
    <td colspan="3" class="bor-none">&nbsp;</td>
   
  </tr>
  <tr>
    <td colspan="3" class="bor-none">&nbsp;    </td>
 
  </tr>
  
  
</table>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
  <tr>
    <td style="width:275px !important;"> যোগদানের তারিখঃ   </td>
	<td class="bor-none">&nbsp;</td>
	 <td style="width:200px !important;"> আই ডি নংঃ  </td>
	  <td class="bor-none" style="text-align:right">  এইচ আর, এডমিন  এন্ড কমপ্লায়েন্স  </td>
  
  </tr>
</table>

 				<? } elseif ($_POST['report'] == 106) { ?>

 					<?
						$info = find_all_field('personnel_basic_info', '', 'PBI_CODE="' . $_POST['emp_id'] . '"');
						$salary_info = find_all_field('salary_info', '', 'PBI_ID="' . $info->PBI_ID . '"');
						$promotion_info = find_all_field('promotion_detail', '', 'PBI_ID="' . $info->PBI_ID . '"');
						?>

<style>
table tr td, table tr th {
border:none;
text-align:justify;

}

</style>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
  <tr>
    <td width="50%">তারিখঃ .......................................</td>
    <td width="50%">&nbsp;</td>
  </tr>
    <tr>
    <td width="50%">প্রতি,</td>
    <td width="50%">&nbsp;</td>
  </tr>
  <tr>
    <td>নামঃ ........................................</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>আইডি নংঃ ...................................</td>
    <td>পদবীঃ .......................................</td>
  </tr>
  <tr>
    <td>ফ্যাক্টরীঃ .....................................</td>
    <td>বিভাগঃ .................................
</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>বিষয়ঃ চাকুরী স্থায়ীকরণ পত্র</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
</table>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
  <tr>
    <td>জনাব/বেগম,</td>
  </tr>
  <tr>
    <td>এই মর্মে আপনাকে জানানো যাইতেছে যে, আপনার শিক্ষানবীশকাল সাফল্যজনকভাবে অতিক্রান্তের ফলে এবং কর্তৃপক্ষের সন্তুষ্টির পরিপ্রেক্ষিতে আপনার চাকুরী অত্র কোম্পানীতে .............(পদবী)................. হিসেবে.............(গ্রেড)..........-এ স্থায়ীকরন করা হইল যাহা .......................................... ইং তারিখ হইতে কার্যকর হইবে।</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>আপনার মাসিক বেতন এবং  অন্যান্য সুবিধাদি নিম্নোক্ত হারে ধার্য্য করা হইল/ আপনার মাসিক বেতন এবং  অন্যান্য সুবিধাদি নিয়োগের শর্তানুযায়ী অপরিবর্তিত থাকবে।</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  
</table>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:600px; margin:0px auto; font-size:18px;">
  <tr>
    <td width="30%">মূল বেতন</td>
    <td width="5%">&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>বাড়ী ভাড়া ভাতা</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>চিকিৎসা ভাতা</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>যাতায়াত ভাতা</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>খাদ্য ভাতা</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>অন্যান্য ভাতা</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>সর্বসাকুল্যে</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
</table><br><br>

<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
	<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>আপনার বিশ্বস্থ,</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="50%" style="text-decoration:overline;">এইচ আর এন্ড কমপ্লায়েন্স</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="50%">গ্রহন করিলাম-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="50%">অনুলিপিঃ</td>
    <td width="50%">স্বাক্ষরঃ ..................................................</td>
  </tr>
  <tr>
    <td width="50%">ব্যক্তিগত নথিঃ</td>
    <td width="50%">তারিখঃ ..................................................
</td>
  </tr>
</table>


 				<? } elseif ($_POST['report'] == 107) { ?>

 					<?
						$info = find_all_field('personnel_basic_info', '', 'PBI_CODE="' . $_POST['emp_id'] . '"');
						$salary_info = find_all_field('salary_info', '', 'PBI_ID="' . $info->PBI_ID . '"');
						$promotion_info = find_all_field('promotion_detail', '', 'PBI_ID="' . $info->PBI_ID . '"');
						?>

<style>
	table tr td, table tr th{
	border:none;
	text-align:justify;
	}
</style>

<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
  <tr>
    <td>তারিখঃ</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="25%">নাম</td>
	<td width="5%">&#10245;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td>আইডি নং</td>
	<td>&#10245;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td>পদবী</td>
	<td>&#10245;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td>বিভাগ</td>
	<td>&#10245;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td>ফ্যাক্টরী</td>
	<td>&#10245;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td>যোগদানের তারিখ</td>
	<td>&#10245;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  </table>
  <table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
  <tr>
    <td>বিষয়ঃ শিক্ষানবীশকাল বর্ধিতকরন পত্র।</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>জনাব,</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>আপনার শিক্ষানবীশ কালের কার্যক্রম পর্যালোচনা করে সন্তোষজনক উন্নতি পরিলক্ষিত হয়নি। তাই কর্তৃপক্ষ আগামী ...........................তারিখ হতে আপনার শিক্ষানবীশকাল আরো ০৩ মাস বর্ধিত করনের সিদ্ধান্ত গ্রহন করছেন।</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>আপনার সুযোগ সুবিধা এবং সর্বসাকুল্যে বেতন-ভাতা নিয়োগ পত্র অনুসারে বহাল রইল।</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>কর্তৃপক্ষ আশাপ্রকাশ করছেন উলে­খিত মেয়াদকালের মধ্যে আপনি আপনার দায়িত্ব যথাযথভাবে পালনের মাধ্যমে স্বীয় যোগ্যতার প্রমান দিবেন।</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>ধন্যবাদান্তে,</td>
  </tr>
</table> <br><br><br><br>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
  <tr>
    <td style="text-decoration:overline;" width="50%">
এইচ আর এন্ড কমপ্লায়েন্স</td>
    <td width="50%">&nbsp;</td>
  </tr>
  <tr>
    <td width="50%">&nbsp;</td>
    <td width="50%">&nbsp;</td>
  </tr>
  <tr>
    <td width="50%">&nbsp;</td>
    <td width="50%">গ্রহন করলাম-</td>
  </tr>
  <tr>
    <td width="50%">&nbsp;</td>
    <td width="50%">স্বাক্ষরঃ .............................</td>
  </tr>
  <tr>
    <td width="50%">&nbsp;</td>
    <td width="50%">তারিখঃ .............................</td>
  </tr>
  <tr>
    <td width="50%">অনুলিপিঃ</td>
    <td width="50%">&nbsp;</td>
  </tr>
  <tr>
    <td width="50%">ফ্যাক্টরী ইনচার্জ</td>
    <td width="50%">&nbsp;</td>
  </tr>
  <tr>
    <td width="50%">ব্যক্তিগত নথি</td>
    <td width="50%">&nbsp;</td>
  </tr>
</table>


 				<? } elseif ($_POST['report'] == 108) { ?>

 					<?
						$info = find_all_field('personnel_basic_info', '', 'PBI_CODE="' . $_POST['emp_id'] . '"');
						$salary_info = find_all_field('salary_info', '', 'PBI_ID="' . $info->PBI_ID . '"');
						$promotion_info = find_all_field('promotion_detail', '', 'PBI_ID="' . $info->PBI_ID . '"');
						?>

<style>
tr td, tr th{
border:none !important;
}
</style>

<table width="100%" border="0" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto" class="bord-none">
  <tr>
    <td  colspan="2">প্রতি,</td>
    
  </tr>
  <tr>
    <td colspan="2" style="text-align:center">কারখানাঃ SIMPTEX Appreal</td>
    
  </tr>
  <tr>
    <td>
	
		<table width="100%" border="1">
		  <tr>
			<td width="25%">সূত্র</td>
			<td width="25%">&#10245;</td>
			<td>&nbsp;</td>
		  </tr>
		</table>

	
	 </td>
    <td width="50%" style="text-align:center">তারিখঃ ---------------</td>
  </tr>
  <tr>
    <td>
		<table width="100%" border="1">
		  <tr>
			<td width="25%">নাম</td>
			<td width="25%">&#10245;</td>
			<td>&nbsp;</td>
		  </tr>
		</table>
	
	</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
		<table width="100%" border="1">
		  <tr>
			<td width="25%">পিতা </td>
			<td width="25%">&#10245;</td>
			<td>&nbsp;</td>
		  </tr>
		</table>
	
	</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	
		<table width="100%" border="1">
		  <tr>
			<td width="25%">মাতা</td>
			<td width="25%">&#10245;</td>
			<td>&nbsp;</td>
		  </tr>
		</table>
	
	</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	
	<table width="100%" border="1">
		  <tr>
			<td width="25%">স্বামী</td>
			<td width="25%">&#10245;</td>
			<td>&nbsp;</td>
		  </tr>
		</table>
	
	</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="50%">
	
	<table width="100%" border="1">
		  <tr>
			<td width="25%">গ্রাম</td>
			<td width="25%">&#10245;</td>
			<td>&nbsp;</td>
		  </tr>
		</table>
	
	</td>
    <td width="50%">
	<table width="100%" border="1">
		  <tr>
			<td width="25%">ডাকঘর</td>
			<td width="25%">&#10245;</td>
			<td>&nbsp;</td>
		  </tr>
		</table>
	
	</td>
  </tr>
  
  <tr>
    <td width="50%">
		<table width="100%" border="1">
		  <tr>
			<td width="25%">থানা</td>
			<td width="25%">&#10245;</td>
			<td>&nbsp;</td>
		  </tr>
		</table>
	
	</td>
    <td width="50%">
	<table width="100%" border="1">
		  <tr>
			<td width="25%">জেলা</td>
			<td width="25%">&#10245;</td>
			<td>&nbsp;</td>
		  </tr>
		</table>
	
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>বিষয়ঃ নিয়োগ প্রসঙ্গে।</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td> </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>জনাব/বেগম,</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">আপনার আবেদন এবং মৌখিক/ব্যবহারিক পরীক্ষার ফলাফলের ভিত্তিতে আপনাকে নিম্নোক্ত লিখিত শর্তসাপেক্ষে কর্তৃপক্ষ নিয়োগ প্রদানে সম্মত হয়েছেনঃ</td>
   
  </tr>
  <tr>
    <td colspan="2">
	<table width="100%" border="1">
	  <tr>
		<td width="25%">১. পদবী</td>
		<td>&#10245;</td>
		<td>অত্র প্রতিষ্ঠানে আপনার পদবী হবে General M/C Operator গ্রেড G-06</td>
	  </tr>
	</table>
	
	
	</td>
    
  </tr>
  <tr>
    <td colspan="2">
	<table width="100%" border="1">
	  <tr>
		<td width="25%">২. যোগদানের তারিখ</td>
		<td width="2%">&#10245;</td>
		<td width="73%">আপনার চাকরী 01-July 2023 ইং তারিখ থেকে কার্যকর হবে। </td>
	  </tr>
	</table>
	
	
	</td>
    
  </tr>
  <tr>
    <td colspan="2">
		<table width="100%" border="1">
	  <tr>
		<td width="25%">৩. বেতন/মজুরী</td>
		<td width="2%">&#10245;</td>
		<td width="73%"> আপনার মাসিক বেতন হিসাব হবে নিম্নোরুপঃ </td>
	  </tr>
	</table>
	
	</td>
    
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  </table>
  <div class="" style="width:500px; margin:0px auto">
  		<table width="80%" border="1"  ‍>
		  <tr>
			<td>মূল বেতন</td>
			<td>&#10245;</td>
			<td>4522</td>
		  </tr>
		  <tr>
			<td>বাড়ী ভাড়া ভাতা</td>
			<td>&#10245;</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td>চিকিৎসা ভাতা</td>
			<td>&#10245;</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td>যাতায়াত ভাতা</td>
			<td>&#10245;</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td>খাদ্য ভাতা</td>
			<td>&#10245;</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td colspan="3"><hr></td>
			
		  </tr>
		  
		  <tr>
			<td>মোট</td>
			<td>&#10245;</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td>অন্যান্য ভাতাদি</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td>বিশেষ ভাতা</td>
			<td>&#10245;</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td colspan="3"><hr></td>
			
		  </tr>
		  <tr>
			<td> সর্বসাকল্যে</td>
			<td>&#10245;</td>
			<td>&nbsp;</td>
		  </tr>
		</table>

  </div>
  
  <br><br>

<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; line-height:25px">
  <tr>
    <td colspan="2">৪. প্রবেশনারী পিরিয়ড/শিক্ষানবিসিকাল ঃ আপনার চাকরীর প্রথম ৩(তিন) / ৬ (ছয়) মাস প্রবেশনারী/ শিক্ষানবিসিকাল হিসাবে গণ্য হবে। এই সময়ে অপনার কর্ম সে
ন্তাষজনক না হলে কর্তৃপক্ষ শিক্ষানবিসিকাল আরও তিন মাস বৃদ্ধি করতে পারবেন কিংবা উক্ত পদে নিয়োগ করতে বাধ্য থাকবেন না। </td>
  </tr>
  <tr>
    <td colspan="2">৫. চাকরী স্থায়ী হবার পর ৬০ (ষাট) দিনের লিখিত নোটিশ অথবা নোটিশের পরিবর্তে ৬০ (ষাট) দিনের মূল মজুরী কোম্পানীকে প্রদান সাপেক্ষে আপনি স্বেচ্ছায় চাকরী হতে 
ইস্তফা দিতে পারবেন। </td>
  </tr>
  <tr>
    <td colspan="2">৬. চাকরী স্থায়ী হবার পর কর্তৃপক্ষ কোন প্রকার কারণ দর্শানো ব্যতিত ১২০ (একশত বিশ) দিনের লিখিত নোটিশ অথবা নোটিশের পরিবর্তে ১২০ (একশত বিশ) দিনের মূল 
মজুরী প্রদান করে আপনার চাকরীর অবসান করতে পারবে।</td>
  </tr>
  <tr>
    <td colspan="2">৭. আইন মোতাবেক যে কোন ধরনের অসদাচরনের জন্য দোষী প্রমাণিত হলে আপনাকে চাকরী থেকে বরখাস্ত করা যাবে।</td>
  </tr>
  <tr>
    <td colspan="2">৮. সাধারণতঃ দৈনিক কর্মকাল হবে ০৮ (আট) ঘন্টা। প্রয়োজন অনুয়ায়ী আপনি কারখানায় অতিরিক্ত সময় কাজ করতে পারেন। সে ক্ষেত্রে অতিরিক্ত কাজের জন্য মূল 
মজুরীর দ্বিগুন হারে ওভার টাইম ভাতা পাবেন।</td>
  </tr>
  <tr>
    <td colspan="2">৯. ছুটি: ক) নৈমিত্তিক ছুটিঃ বছরে ১০ (দশ) দিন (পূর্ণ বেতনে)। খ) অসুস্থতা জনিত ছুটিঃ বছরে ১৪ (চৌদ্দ) দিন (পূর্ণ বেতনে)। গ) বাৎসরিক ছুটিঃ ০১ (এক) বৎসর 
এই ফ্যাক্টরীতে কাজ করার পর পূর্ববর্তী প্রতি ১৮ (আঠার) দিন কাজের জন্য ০১ (এক) দিন। ঘ) উৎসব ছুটিঃ বৎসরে ন্যূনতম ১১ (এগার) দিন (পূর্ণ বেতনে)। ঙ) মাতৃত্বকালীন 
ছুটিঃ কোন মহিলা শ্রমিকের চাকরীর মেয়াদ ৬ (ছয়) মাস হলে তিনি মোট ১৬ সপ্তাহ (১১২দিন) আর্থিক সুবিধাসহ মাতৃকল্যাণ সুবিধা পাবেন (দুই বা ততোধিক সন্তান জীবিত 
থাকলে তিনি কোন আর্থিক সুবিধা পাবেন না)। </td>
  </tr>
  <tr>
    <td colspan="2">১০. কর্তৃপক্ষ প্রতিষ্ঠানের বৃহত্তর স্বার্থে আপনাকে অত্র প্রতিষ্ঠানের যে কোন বিভাগে অথবা যে কোন ইউনিটে অথবা যে কোন অঙ্গ প্রতিষ্ঠানে বদলী করার অধিকার রাখে। </td>
  </tr>
  <tr>
    <td colspan="2">১১. আপনি অত্র প্রতিষ্ঠানে কর্মরত অবস্থায় কোন ভাবেই প্রতিষ্ঠানের গোপন এবং প্রয়োজনীয় তথ্য অপব্যবহার এবং অপপ্রচার করতে পারবেন না। </td>
  </tr>
  <tr>
    <td colspan="2">১২. আপনি আইন অনুযায়ী নিষিদ্ধ দ্রব্যসমূহ যেমন নেশা জাতীয় দ্রব্য, বিষ্ফোরক দ্রব্যসমূহ পাচার, ব্যবহার বা বিতরণ প্রভৃতি কাজে জড়িত হতে পারবেন না। </td>
  </tr>
  <tr>
    <td colspan="2">১৩. অত্র প্রতিষ্ঠানে আপনার প্রদত্ত তথ্যাবলীর কোন প্রকার পরিবর্ধন, সংশোধন, পরিমার্জন কিংবা অন্য যে কোন প্রকার পরিবর্তন হলে বা করলে তা অবশ্যই কর্তৃপক্ষকে 
অবহিত করতে হবে। </td>
  </tr>
  <tr>
  	<td colspan="2"> ১৪. আপনার চাকরী স্থানীয় শ্রম আইন অনুযায়ী পরিচালিত হবে। </td>
  </tr>
  <tr>
  	<td width="50%">১৫. চাকরীর অন্যান্য শর্তাবলী প্রতিষ্ঠানের নীতিমালা অনুযায়ী সমভাবে প্রযোজ্য হবে।</td>
	<td width="50%">আমি অত্র নিয়োগপত্র পাঠ করে এবং এতে বর্ণিত শর্তাদি সম্পূর্ণরূপে অবগত হয়ে স্বেচ্ছায়, সজ্ঞানে এই নিয়োগ পত্র গ্রহন করে স্বাক্ষর করলাম।</td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
	<td>স্বাক্ষরঃ ................................</td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
	<td>নামঃ ...............................</td>
  </tr>
</table><br><br><br><br>
<table width="100%" border="1" style="width:800px; margin:0px auto;" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" style="text-decoration:overline;"> প্রডাকশন সুপারেনট্যান্টেড/ইঞ্জিনিয়ার</td>
    <td align="center" style="text-decoration:overline;">ফাংশানাল হেড</td>
    <td align="center" style="text-decoration:overline;">এইচ আর, এডমিন এন্ড কমপ্লায়েন্স</td>
  </tr>
</table>





 				<? } elseif ($_POST['report'] == 109) { ?>

 					<?
						$info = find_all_field('personnel_basic_info', '', 'PBI_CODE="' . $_POST['emp_id'] . '"');
						$salary_info = find_all_field('salary_info', '', 'PBI_ID="' . $info->PBI_ID . '"');
						$promotion_info = find_all_field('promotion_detail', '', 'PBI_ID="' . $info->PBI_ID . '"');
						?>

<style>
table tr td, table tr th {
border:none;
text-align:justify;

}

</style>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
  <tr>
    <td width="50%">তারিখঃ .......................................</td>
    <td width="50%">&nbsp;</td>
  </tr>
    <tr>
    <td width="50%">প্রতি,</td>
    <td width="50%">&nbsp;</td>
  </tr>
  <tr>
    <td>নামঃ ........................................</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>আইডি নংঃ ...................................</td>
    <td>পদবীঃ .......................................</td>
  </tr>
  <tr>
    <td>ফ্যাক্টরীঃ .....................................</td>
    <td>বিভাগঃ .................................
</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>বিষয়ঃ চাকুরী স্থায়ীকরণ পত্র</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
</table>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
  <tr>
    <td>জনাব/বেগম,</td>
  </tr>
  <tr>
    <td>এই মর্মে আপনাকে জানানো যাইতেছে যে, আপনার শিক্ষানবীশকাল সাফল্যজনকভাবে অতিক্রান্তের ফলে এবং কর্তৃপক্ষের সন্তুষ্টির পরিপ্রেক্ষিতে আপনার চাকুরী অত্র কোম্পানীতে .............(পদবী)................. হিসেবে.............(গ্রেড)..........-এ স্থায়ীকরন করা হইল যাহা .......................................... ইং তারিখ হইতে কার্যকর হইবে।</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>আপনার মাসিক বেতন এবং  অন্যান্য সুবিধাদি নিম্নোক্ত হারে ধার্য্য করা হইল/ আপনার মাসিক বেতন এবং  অন্যান্য সুবিধাদি নিয়োগের শর্তানুযায়ী অপরিবর্তিত থাকবে।</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  
</table>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:600px; margin:0px auto; font-size:18px;">
  <tr>
    <td width="30%">মূল বেতন</td>
    <td width="5%">&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>বাড়ী ভাড়া ভাতা</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>চিকিৎসা ভাতা</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>যাতায়াত ভাতা</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>খাদ্য ভাতা</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>অন্যান্য ভাতা</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>সর্বসাকুল্যে</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
</table><br><br>

<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
	<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>আপনার বিশ্বস্থ,</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="50%" style="text-decoration:overline;">এইচ আর এন্ড কমপ্লায়েন্স</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="50%">গ্রহন করিলাম-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="50%">অনুলিপিঃ</td>
    <td width="50%">স্বাক্ষরঃ ..................................................</td>
  </tr>
  <tr>
    <td width="50%">ব্যক্তিগত নথিঃ</td>
    <td width="50%">তারিখঃ ..................................................
</td>
  </tr>
</table>




 				<? } elseif ($_POST['report'] == 110) { ?>

 					<?
						$info = find_all_field('personnel_basic_info', '', 'PBI_CODE="' . $_POST['emp_id'] . '"');
						$salary_info = find_all_field('salary_info', '', 'PBI_ID="' . $info->PBI_ID . '"');
						$promotion_info = find_all_field('promotion_detail', '', 'PBI_ID="' . $info->PBI_ID . '"');
						?>


<style>
table tr td,table tr th{
border:none !important;
line-height:25px;

}

</style>
<table width="100%" border="1" style="width:800px; margin:0px auto;" cellpadding="0" cellspacing="0">
  <tr>
    <td>তারিখঃ</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td> প্রতি,</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td> নামঃ</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td> আইডি নংঃ</td>
    <td> পদবীঃ</td>
  </tr>
  <tr>
    <td> ফ্যাক্টরীঃ</td>
    <td> বিভাগঃ</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>বিষয়ঃ চাকুরী স্থায়ীকরণ পত্র</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td> জনাব/বেগম,</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">এই মর্মে আপনাকে জানানো যাইতেছে যে, আপনার শিক্ষানবীশকাল  সাফল্যজনকভাবে অতিক্রান্তের ফলে এবং কর্তৃপক্ষের সন্তুষ্টির 
পরিপ্রেক্ষিতে আপনার চাকুরী অত্র কোম্পানীতে Q1 হিসেবে G-4 -এ স্থায়ীকরন করা হইল যাহা 02-01-2023 ইং তারিখ হইতে 
কার্যকর হইবে।</td>
    
  </tr>
  <tr>
    <td colspan="2">আপনার মাসিক বেতন এবং  অন্যান্য সুবিধাদি নিয়োগের শর্তানুযায়ী অপরিবর্তিত থাকবেঃ</td>
    
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td> আপনার বিশ্বস্ত,</td>
    <td> গ্রহন করিলাম</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td> স্বাক্ষর:</td>
  </tr>
  <tr>
    <td>এইচ আর এন্ড কমপ্লায়েন্স</td>
    <td> তারিখ:</td>
  </tr>
  <tr>
    <td> অনুলিপিঃ</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>ব্যক্তিগত নথি</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>



 				<? } elseif ($_POST['report'] == 111) { ?>

 					<?
						$info = find_all_field('personnel_basic_info', '', 'PBI_CODE="' . $_POST['emp_id'] . '"');
						$salary_info = find_all_field('salary_info', '', 'PBI_ID="' . $info->PBI_ID . '"');
						$promotion_info = find_all_field('promotion_detail', '', 'PBI_ID="' . $info->PBI_ID . '"');
						?>


<style>
table tr th, table tr td{

border:none !important;
font-size:12px;

}
</style>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto;">
  <tr>
    <td>Date: 01-July-2015</td>
  </tr>
  <tr>
    <td>To</td>
  </tr>
  <tr>
    <td>Jashim Mahmud</td>
  </tr>
  <tr>
    <td>Management Trainee</td>
  </tr>
  <tr>
    <td>Production</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="font-weight:bold;"> Confirmation of Employment</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td> Dear Jashim Mahmud,</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>We are pleased to inform that you have successfully completed the probationary period of your employment with 
our Company as Management Trainee effective from 01-July-2015.</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Your revised Salary and other benefits associated per month are stated below.</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto;">
  <tr>
    <td width="20%"> Basic </td>
    <td width="5%">:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>House Rent</td>
    <td>:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td> Medical Allowance</td>
    <td>:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Transport Allowance</td>
    <td>:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Food Allowance</td>
    <td>:</td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td colspan="3"><hr></td>
  
  </tr>
  <tr>
    <td style="font-weight:bold;">Gross Salary (BDT)</td>
    <td>:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="font-weight:bold;">Others Benifit</td>
    <td></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Special Allowance</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Mobile Allowance</td>
    <td>:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp; </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Increment increase on Net </td>
    <td>:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp; </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto;">
  <tr>
    <td> Your personal income tax liability (if any) on above salary income will be borne by yourself.</td>
  </tr>
  <tr>
    <td style="font-weight:bold;"> N.B. Above salary information is strictly confidential and you will be responsible to maintain that.</td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
  </tr>
  <tr>
    <td> We trust that your success will continue throughout your career with our Company.</td>
  </tr>
  <tr>
    <td>Congratulations and thank you for your contribution</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Yours Sincerely</td>
  </tr>
  <tr>
    <td> For and On-behalf of SIMFTEX Apparel & Washing Ltd</td>
  </tr>
  <tr>
    <td> Ahmed Morshed</td>
  </tr>
  <tr>
    <td>Head of HR, IT & Compliance</td>
  </tr>
 
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>CC. Personal File</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td> I have read the above Letter and the terms and conditions set out there in which I have fully understood and I 
hereby accept the same.</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto;">
<tr>
    <td>&nbsp; </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp; </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Signature: ------------------------</td>
    <td> Date Signed:</td>
  </tr>
  <tr>
    <td> Name: --------------------------</td>
    <td>&nbsp;</td>
  </tr>
  
</table>


 				<? } elseif ($_POST['report'] == 112) { ?>

 					<?
						$info = find_all_field('personnel_basic_info', '', 'PBI_CODE="' . $_POST['emp_id'] . '"');
						$salary_info = find_all_field('salary_info', '', 'PBI_ID="' . $info->PBI_ID . '"');
						$promotion_info = find_all_field('promotion_detail', '', 'PBI_ID="' . $info->PBI_ID . '"');
						?>


<style>
table tr td, table tr th {
border:none;
text-align:justify;

}

</style>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
  <tr>
    <td width="50%">তারিখঃ .......................................</td>
    <td width="50%">&nbsp;</td>
  </tr>
    <tr>
    <td width="50%">প্রতি,</td>
    <td width="50%">&nbsp;</td>
  </tr>
  <tr>
    <td>নামঃ ........................................</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>আইডি নংঃ ...................................</td>
    <td>পদবীঃ .......................................</td>
  </tr>
  <tr>
    <td>ফ্যাক্টরীঃ .....................................</td>
    <td>বিভাগঃ .................................
</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>বিষয়ঃ চাকুরী স্থায়ীকরণ পত্র</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
</table>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
  <tr>
    <td>জনাব/বেগম,</td>
  </tr>
  <tr>
    <td>এই মর্মে আপনাকে জানানো যাইতেছে যে, আপনার শিক্ষানবীশকাল সাফল্যজনকভাবে অতিক্রান্তের ফলে এবং কর্তৃপক্ষের সন্তুষ্টির পরিপ্রেক্ষিতে আপনার চাকুরী অত্র কোম্পানীতে .............(পদবী)................. হিসেবে.............(গ্রেড)..........-এ স্থায়ীকরন করা হইল যাহা .......................................... ইং তারিখ হইতে কার্যকর হইবে।</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>আপনার মাসিক বেতন এবং  অন্যান্য সুবিধাদি নিম্নোক্ত হারে ধার্য্য করা হইল/ আপনার মাসিক বেতন এবং  অন্যান্য সুবিধাদি নিয়োগের শর্তানুযায়ী অপরিবর্তিত থাকবে।</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  
</table>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:600px; margin:0px auto; font-size:18px;">
  <tr>
    <td width="30%">মূল বেতন</td>
    <td width="5%">&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>বাড়ী ভাড়া ভাতা</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>চিকিৎসা ভাতা</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>যাতায়াত ভাতা</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>খাদ্য ভাতা</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>অন্যান্য ভাতা</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>সর্বসাকুল্যে</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
</table><br><br>

<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
	<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>আপনার বিশ্বস্থ,</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="50%" style="text-decoration:overline;">এইচ আর এন্ড কমপ্লায়েন্স</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="50%">গ্রহন করিলাম-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="50%">অনুলিপিঃ</td>
    <td width="50%">স্বাক্ষরঃ ..................................................</td>
  </tr>
  <tr>
    <td width="50%">ব্যক্তিগত নথিঃ</td>
    <td width="50%">তারিখঃ ..................................................
</td>
  </tr>
</table>


 				<? } elseif ($_POST['report'] == 113) { ?>

 					<?
						$info = find_all_field('personnel_basic_info', '', 'PBI_CODE="' . $_POST['emp_id'] . '"');
						$salary_info = find_all_field('salary_info', '', 'PBI_ID="' . $info->PBI_ID . '"');
						$promotion_info = find_all_field('promotion_detail', '', 'PBI_ID="' . $info->PBI_ID . '"');
						?>



<style>
table tr td,table tr th{
border:none !important;
line-height:25px;

}

</style>
<table width="100%" border="1" style="width:800px; margin:0px auto;" cellpadding="0" cellspacing="0">
  <tr>
    <td>তারিখঃ</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td> প্রতি,</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td> নামঃ</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td> আইডি নংঃ</td>
    <td> পদবীঃ</td>
  </tr>
  <tr>
    <td> ফ্যাক্টরীঃ</td>
    <td> বিভাগঃ</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>বিষয়ঃ চাকুরী স্থায়ীকরণ পত্র</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td> জনাব/বেগম,</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">এই মর্মে আপনাকে জানানো যাইতেছে যে, আপনার শিক্ষানবীশকাল  সাফল্যজনকভাবে অতিক্রান্তের ফলে এবং কর্তৃপক্ষের সন্তুষ্টির 
পরিপ্রেক্ষিতে আপনার চাকুরী অত্র কোম্পানীতে Q1 হিসেবে G-4 -এ স্থায়ীকরন করা হইল যাহা 02-01-2023 ইং তারিখ হইতে 
কার্যকর হইবে।</td>
    
  </tr>
  <tr>
    <td colspan="2">আপনার মাসিক বেতন এবং  অন্যান্য সুবিধাদি নিয়োগের শর্তানুযায়ী অপরিবর্তিত থাকবেঃ</td>
    
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td> আপনার বিশ্বস্ত,</td>
    <td> গ্রহন করিলাম</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td> স্বাক্ষর:</td>
  </tr>
  <tr>
    <td>এইচ আর এন্ড কমপ্লায়েন্স</td>
    <td> তারিখ:</td>
  </tr>
  <tr>
    <td> অনুলিপিঃ</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>ব্যক্তিগত নথি</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>


 				<? } elseif ($_POST['report'] == 114) { ?>

 					<?
						$info = find_all_field('personnel_basic_info', '', 'PBI_CODE="' . $_POST['emp_id'] . '"');
						$salary_info = find_all_field('salary_info', '', 'PBI_ID="' . $info->PBI_ID . '"');
						$promotion_info = find_all_field('promotion_detail', '', 'PBI_ID="' . $info->PBI_ID . '"');
						?>


<style>
table tr td, table tr th {
border:none;
text-align:justify;

}

</style>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
  <tr>
    <td width="50%">তারিখঃ .......................................</td>
    <td width="50%">&nbsp;</td>
  </tr>
    <tr>
    <td width="50%">প্রতি,</td>
    <td width="50%">&nbsp;</td>
  </tr>
  <tr>
    <td>নামঃ ........................................</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>আইডি নংঃ ...................................</td>
    <td>পদবীঃ .......................................</td>
  </tr>
  <tr>
    <td>ফ্যাক্টরীঃ .....................................</td>
    <td>বিভাগঃ .................................
</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>বিষয়ঃ চাকুরী স্থায়ীকরণ পত্র</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
</table>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
  <tr>
    <td>জনাব/বেগম,</td>
  </tr>
  <tr>
    <td>এই মর্মে আপনাকে জানানো যাইতেছে যে, আপনার শিক্ষানবীশকাল সাফল্যজনকভাবে অতিক্রান্তের ফলে এবং কর্তৃপক্ষের সন্তুষ্টির পরিপ্রেক্ষিতে আপনার চাকুরী অত্র কোম্পানীতে .............(পদবী)................. হিসেবে.............(গ্রেড)..........-এ স্থায়ীকরন করা হইল যাহা .......................................... ইং তারিখ হইতে কার্যকর হইবে।</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>আপনার মাসিক বেতন এবং  অন্যান্য সুবিধাদি নিম্নোক্ত হারে ধার্য্য করা হইল/ আপনার মাসিক বেতন এবং  অন্যান্য সুবিধাদি নিয়োগের শর্তানুযায়ী অপরিবর্তিত থাকবে।</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  
</table>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:600px; margin:0px auto; font-size:18px;">
  <tr>
    <td width="30%">মূল বেতন</td>
    <td width="5%">&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>বাড়ী ভাড়া ভাতা</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>চিকিৎসা ভাতা</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>যাতায়াত ভাতা</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>খাদ্য ভাতা</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>অন্যান্য ভাতা</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>সর্বসাকুল্যে</td>
    <td>&#10245;</td>
    <td>&nbsp;</td>
  </tr>
</table><br><br>

<table width="100%" border="1" cellpadding="0" cellspacing="0" style="width:800px; margin:0px auto; font-size:18px;">
	<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>আপনার বিশ্বস্থ,</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="50%" style="text-decoration:overline;">এইচ আর এন্ড কমপ্লায়েন্স</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="50%">গ্রহন করিলাম-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="50%">অনুলিপিঃ</td>
    <td width="50%">স্বাক্ষরঃ ..................................................</td>
  </tr>
  <tr>
    <td width="50%">ব্যক্তিগত নথিঃ</td>
    <td width="50%">তারিখঃ ..................................................
</td>
  </tr>
</table>


 				<? } elseif ($_POST['report'] == 115) { ?>

 					<?
						$info = find_all_field('personnel_basic_info', '', 'PBI_CODE="' . $_POST['emp_id'] . '"');
						$salary_info = find_all_field('salary_info', '', 'PBI_ID="' . $info->PBI_ID . '"');
						$promotion_info = find_all_field('promotion_detail', '', 'PBI_ID="' . $info->PBI_ID . '"');
						?>
<style>
.header{
width:100%;

}

.mid{
	padding-top:100px;
}

.id_font{
	background-color: whitesmoke;
    padding: 5px;
    border: 1px solid;
    border-radius: 10px;
    width: 400px;
    margin: 0 auto;
	height: 225px;
}

.id_back{
	margin-top:50px;
	margion-bottom:50px;
	background-color: whitesmoke;
    padding: 5px;
    border: 1px solid;
    border-radius: 10px;
    width: 400px;
    margin: 0 auto;
	height: 225px;
}
tr td{
	text-align:left;
	border: 1px solid #f5f5f5;
}
.p{
    margin: 3px;
    font-size: 11px;
    line-height: 15px;
}
.center{
text-align:center;
}
</style>


<div class="header">
	<div class="mid">
	<div class="id_font">
	<table width="100%" border="1">
		<tr>
			<td width="63%" colspan="2">আইডি কার্ড নংঃ</td>
			<td width="37%">ইস্যুয় তাংঃ ১০-১০-২০২৩ ইং</td>
		</tr>
		
		<tr>
			<td colspan="2">&nbsp;</td>
			<td rowspan="5"> <img src="user.jpeg" width="100%" height="100%" style="border: 1px solid;width: 100%;height: 125px;"></td>
		</tr>
				
		<tr>
			<td colspan="2">নামঃ............................................................</td>
			
		</tr>
				
		<tr>
			<td colspan="2">পদবীঃ...........................................................</td>
			
		</tr>
				
		<tr>
			<td colspan="2">কাজের ধরণঃ...................................................</td>
			
		</tr>
				
		<tr>
			<td>বিভাগঃ.......................</td>
			<td>শাখাঃ..............</td>
			
		</tr>
				
		<tr>
			<td colspan="2">যোগাযোগ তারিখঃ ...........................</td>
			<td>কার্ডে নংঃ..................... </td>
			
		</tr>
				
								
		<tr>
			<td colspan="3"> &nbsp;</td>
			
		</tr>
										
		
						
		<tr>
			<td >শমিকের স্বাক্ষর</td>
			<td colspan="2" style="text-align: right;">মালিক/ ব্যাবস্থাপকের স্বাক্ষর</td>
			
		</tr>
		
	</table>
	
	
	</div>
		<br />
	<div class="id_back">
		<table width="100%" border="1">
		<tr>
			<td width="50%">মেয়াদঃ.........................</td>
			<td width="50%">রক্তের গ্রুপঃ.........................</td>
		</tr>
		
		<tr>
			<td width="50%" rowspan="6">
			<p class="p"> হেড অফিসঃ</p>
			<p class="p">২৭৯/৬, কুলরত-ই-খোলা রোড কাটাবণ, এলিফ্যান্ট রোড ঢাকা। </p>
			<p class="p">ফোনঃ ৮৮ ২ ৯৬৬৯৫১০</p>
			</td>
			<td width="50%">স্থায়ী ঠিকানাঃ.........................</td>
		</tr>
		
		<tr>
			
			<td width="50%">গ্রামঃ....................................</td>
		</tr>
		
		<tr>
			
			<td width="50%">থানাঃ...................................</td>
		</tr>		
		
		<tr>
			
			<td width="50%">জেলাঃ................................</td>
		</tr>
		
		<tr>
			<td width="50%">ফোনঃ................................</td>
		</tr>
		
				
		<tr>
			<td width="50%"><p class="p">জাতীয় পরিচয়পত্রের নং- </p>
			<br />
			<p class="p"> ........................................... </p></td>
		</tr>
		
		<tr>
			<td colspan="2" class="center"> <strong>উক্ত পরিচয়পত্র হারাইয়া গোলে তাৎক্ষণিক কর্তৃপক্ষকে জানাইতে হবে।</strong></td>
		</tr>
				
		
	</table>
	</div>
	
	</div>
</div>








 				<?

				} elseif (isset($sql) && $sql != '') {
					echo report_create($sql, 1, $str);
				}

					?>
 		</div>

 	</form>

 </body>

 </html>