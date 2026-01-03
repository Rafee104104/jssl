<? session_start();
$user_level='level'.$_SESSION['user']['level'];
?>
<table class="menu" border="0" cellspacing="0" cellpadding="0">
								  <tr><td><div class="smartmenu">
<?
$sql="select * from user_activity_control where parent=0  and ".$user_level."!=0 order by `order`,id";
$query=mysql_query($sql);
while($menu=mysql_fetch_object($query))
{
	echo '	<div class="silverheader"><a href="'.$menu->page_link.'">'.$menu->page_name.'</a>
			</div>';
	$subsql="select * from user_activity_control where parent='$menu->id' and ".$user_level."!=0 order by `order`,id";
	$subquery=mysql_query($subsql);
	if(mysql_num_rows($subquery)>0)
	{
	echo '<div class="submenu">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">';
		while($submenu=mysql_fetch_object($subquery))
		{
			echo '<tr><td><a href="'.$submenu->page_link.'">'.$submenu->page_name.'</a></td></tr>';
		}
	echo '
	</table>
	</div>';
	}
}
?>
								  
								
								
								</table>