<?
// FOR DATABASE
	define('DB_SERVER','localhost');
	define('DB_USER','root');
	define('DB_PASS','');
	define('DB_NAME','db_mhafuz');

// PAGE INFO
	$server="http://".$_SERVER['HTTP_HOST']."/money/";
	define('SERVER_ROOT',$server);
	define('SERVER_FROM','From:ceo@CloudCodz.com');
	define('POWERED_BY','Powered By ICLBD Ltd.');
	define('WEBSITE_LINK','http://www.iclbd.com/');
	define('COMPANY_LOGO_LINK','../images/company_logo.jpg');
	define('SOFTWARE_LOGO_LINK','../images/software_logo.jpg');
	define('PAGE_TITLE','Hotel Management Software');
	
	if(isset($banner_title))
	define('BANNER_TITLE',$banner_title);
	else
	define('BANNER_TITLE','Hotel Management Software');
?>