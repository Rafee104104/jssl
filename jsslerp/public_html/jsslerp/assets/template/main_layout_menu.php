<?

$mod_id = $_SESSION['mod'];
$mod_name = find_a_field('user_module_manage','module_name','id='.$_SESSION['mod']);
$user_level =  $_SESSION['user']['level'];
$user_id    =  $_SESSION['user']['id'];

load_menu($mod_id,$mod_name,$user_id);

?>











