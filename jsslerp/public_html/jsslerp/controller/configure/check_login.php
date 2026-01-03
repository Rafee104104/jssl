<?	

	define('SERVER_ENGINE','../../../../../controller/jssl/controller/');
function check_for_login($cid,$uid,$passward,$type){

require_once(SERVER_ENGINE.'configure/db_connect_acc_main.php');

require_once(SERVER_ENGINE.'tools/inc.log.php');

require_once(SERVER_ENGINE.'tools/inc.database.php');



$l_cid = strlen($cid);

$l_uid = strlen($uid);

$l_passward = strlen($passward);




$sql="SELECT b.db_user,b.db_pass,b.db_name,a.cid,a.id,a.company_name,a.address FROM 

company_info a,database_info b WHERE a.cid='$cid' and a.id=b.company_id and a.status='ON' and register_date>'".date('Y-m-d')."' limit 1";



	$sql=@mysql_query($sql);

	if($proj=@mysql_fetch_object($sql))

	{

					$_SESSION['proj_id']	= $proj->cid;

					$_SESSION['db_name']	= $proj->db_name;

					$_SESSION['db_user']	= $proj->db_user;

					$_SESSION['db_pass']	= $proj->db_pass;
					
					



require_once(SERVER_ENGINE.'configure/db_connect.php');

$today = date('Y-m-d');

$user_sql="select * from user_activity_management where  username='".$uid."' and expire_date>= '".$today."'";

$info = find_all_field_sql($user_sql);



				if($info->password==$passward)

				{

					

					$_SESSION['user']['level']		= $info->level;

					$_SESSION['user']['id']			= $info->user_id;

					$_SESSION['user']['fname']		= $info->fname;

					$_SESSION['user']['designation']= $info->designation;

					$_SESSION['user']['depot']		= $info->warehouse_id;

					$_SESSION['user']['group']		= $info->group_for;

					$_SESSION['user']['username']	= $uid;
					
					

					

					$_SESSION['mhafuz']    ='Active';



				//	$_SESSION['mhafuz']    ='Inactive';

				//	$_SESSION['authorize'] ='No';



					$_SESSION['company_name']=$_SESSION['proj_name']=find_a_field('user_group','group_name','id='.$info->group_for);

					$_SESSION['company_address']=$proj->address;

					$_SESSION['user']['access_id']	= activity_log($module_id,$page_id,$page_name,$tr_from,$tr_no,$tr_id,$tr_type,$execution_time);



					return true;

				}

		}else return false;



}

?>