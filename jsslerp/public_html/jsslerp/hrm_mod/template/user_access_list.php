<? session_start();
$user_level='level'.$_SESSION['user']['level'];
if($_SESSION['user']['group']>0){
if(
$_SESSION['user']['id']==10004|| // MIS Team
$_SESSION['user']['id']==10321|| // jakaria
$_SESSION['user']['id']==10149|| // Razzak
$_SESSION['user']['id']==10059|| // MIS Faysal HFL

$_SESSION['user']['id']==10345|| // AUDIT
$_SESSION['user']['id']==11460|| // hrml.acc

// FLOUR
$_SESSION['user']['id']==10742|| // Flour kawser

// Rice Mill
$_SESSION['user']['id']==10771|| // Rice Mondol

// HFL
$_SESSION['user']['id']==10761|| // HFL Anik
$_SESSION['user']['id']==10787|| // HFL mezan
$_SESSION['user']['id']==10785|| // HFL Mohsin
$_SESSION['user']['id']==10789|| // HFL azad
$_SESSION['user']['id']==10790|| // HFL hannan
$_SESSION['user']['id']==10824|| // HFL hannan od2
$_SESSION['user']['id']==10791|| // HFL shahajahan
$_SESSION['user']['id']==10792|| // HFL hasebul
$_SESSION['user']['id']==10793|| // HFL mahabur
$_SESSION['user']['id']==10794|| // HFL ajoy
$_SESSION['user']['id']==10795|| // HFL harunar
$_SESSION['user']['id']==10796|| // HFL nazmul
$_SESSION['user']['id']==10797|| // HFL monowar
$_SESSION['user']['id']==10800|| // HFL monowar2
$_SESSION['user']['id']==10799|| // HFL ranabir
$_SESSION['user']['id']==10798|| // HFL noor

$_SESSION['user']['id']==10817|| // HFL rana
$_SESSION['user']['id']==10818|| // HFL moktar
$_SESSION['user']['id']==10819|| // HFL shahinur
$_SESSION['user']['id']==10820|| // HFL kamruzzaman
$_SESSION['user']['id']==10821|| // HFL mohosin ali

$_SESSION['user']['id']==11516|| // HFL mohosin ali

$_SESSION['user']['id']==11534|| // HFL distribution


$_SESSION['user']['id']==10633|| // Savvy Fahim
$_SESSION['user']['id']==10634|| // Savvy konika

$_SESSION['user']['id']==10656|| // SUVRO ADMIN


$_SESSION['user']['id']==10537|| // faysal rice
$_SESSION['user']['id']==10184|| // faysal 10184
$_SESSION['user']['id']==1065611|| // 


// FOR RSM Attendance
$_SESSION['user']['id']==10678|| //barisal-a
$_SESSION['user']['id']==10687|| //barisal-b
$_SESSION['user']['id']==10696|| //barisal-c
$_SESSION['user']['id']==10704|| //barisal-d
$_SESSION['user']['id']==10712|| //barisal-e

$_SESSION['user']['id']==10680|| //bogra-a
$_SESSION['user']['id']==10689|| //bogra-b
$_SESSION['user']['id']==10698|| //bogra-c
$_SESSION['user']['id']==10706|| //bogra-d
$_SESSION['user']['id']==10714|| //bogra-e

$_SESSION['user']['id']==10682|| //comilla-a
$_SESSION['user']['id']==10691|| //comilla-b
$_SESSION['user']['id']==10700|| //comilla-c
$_SESSION['user']['id']==10708|| //comilla-d
$_SESSION['user']['id']==10716|| //comilla-e

$_SESSION['user']['id']==10683|| //ctg-a
$_SESSION['user']['id']==10692|| //ctg-b
$_SESSION['user']['id']==10701|| //ctg-c
$_SESSION['user']['id']==10709|| //ctg-d
$_SESSION['user']['id']==10717|| //ctg-e

$_SESSION['user']['id']==10684|| //de-a
$_SESSION['user']['id']==10693|| //de-b
$_SESSION['user']['id']==10702|| //de-c
$_SESSION['user']['id']==10661|| // Dhaka East E
$_SESSION['user']['id']==10663|| // Dhaka East D

$_SESSION['user']['id']==10677|| //dw-a
$_SESSION['user']['id']==10686|| //dw-b
$_SESSION['user']['id']==10695|| //dw-c
$_SESSION['user']['id']==10662|| // Dhaka West D
$_SESSION['user']['id']==10711|| //dw-e

$_SESSION['user']['id']==10679|| //jessore-a
$_SESSION['user']['id']==10688|| //jessore-b
$_SESSION['user']['id']==10697|| //jessore-c
$_SESSION['user']['id']==10705|| //jessore-d
$_SESSION['user']['id']==10713|| //jessore-e

$_SESSION['user']['id']==10685|| //mym-a
$_SESSION['user']['id']==10694|| //mym-b
$_SESSION['user']['id']==10703|| //mym-c
$_SESSION['user']['id']==10710|| //mym-d
$_SESSION['user']['id']==10718|| //mym-e

$_SESSION['user']['id']==10681|| //sylhet-a
$_SESSION['user']['id']==10690|| //sylhet-b
$_SESSION['user']['id']==10699|| //sylhet-c
$_SESSION['user']['id']==10707|| //sylhet-d
$_SESSION['user']['id']==10715|| //sylhet-e


// sales manager
$_SESSION['user']['id']==10730|| // group a
$_SESSION['user']['id']==10731|| // group a
$_SESSION['user']['id']==10732|| // group a
$_SESSION['user']['id']==10733|| // group a
$_SESSION['user']['id']==10734|| // group a
$_SESSION['user']['id']==10735|| // group a
$_SESSION['user']['id']==10736|| // group a
$_SESSION['user']['id']==10737|| // group a
$_SESSION['user']['id']==10738|| // group a
$_SESSION['user']['id']==10739|| // group a



// all store manager
$_SESSION['user']['id']==11517|| // bogura
$_SESSION['user']['id']==11518|| // bogura
$_SESSION['user']['id']==11519|| // bogura
$_SESSION['user']['id']==11520|| // bogura
$_SESSION['user']['id']==11521|| // bogura
$_SESSION['user']['id']==11522|| // bogura
$_SESSION['user']['id']==11523|| // bogura
$_SESSION['user']['id']==11524|| // bogura
$_SESSION['user']['id']==11525|| // bogura




// modern trade
$_SESSION['user']['id']==10671|| // biddhut

// market audit
$_SESSION['user']['id']==10670|| // komol


$_SESSION['user']['id']==10534|| // Firoz 
$_SESSION['user']['id']==10468|| // Imran Hossain
$_SESSION['user']['id']==10450|| // Preeti
$_SESSION['user']['id']==10575|| // shoaib
$_SESSION['user']['id']==10745|| // view Recruitment



$_SESSION['user']['id']==10451|| // Samsul Alam GM
$_SESSION['user']['id']==10467) // HRM Sazzadur Rahman




{echo ' ';}
else
{
	echo $_SESSION['user']['group']; 
	echo $_SESSION['user']['id'];
	session_destroy();
	die('Access Limited');
}
}
?>