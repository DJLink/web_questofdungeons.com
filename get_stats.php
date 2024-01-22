<?php


$jsonurl = "https://api.steampowered.com/ISteamUserStats/GetGlobalStatsForGame/V0001/?format=json";

$jsonurl.='&appid=270050';
$jsonurl.='&count=15';

$jsonurl.='&name[0]=LostGames';
$jsonurl.='&name[1]=SoldItems';
$jsonurl.='&name[2]=PurchasedItems';
$jsonurl.='&name[3]=GoldCollected';
$jsonurl.='&name[4]=MonstersKilled';
$jsonurl.='&name[5]=FoodConsumed';
$jsonurl.='&name[6]=BrokenStuff';
$jsonurl.='&name[7]=CompletedQuests';
$jsonurl.='&name[8]=StepsTaken';
$jsonurl.='&name[9]=TrapsTriggered';
$jsonurl.='&name[10]=BossKills';
$jsonurl.='&name[11]=ChestsUnlocked';
$jsonurl.='&name[12]=ChestsOpened';
$jsonurl.='&name[13]=DoorsUnlocked';
$jsonurl.='&name[14]=PlayedTime';

//$jsonurl.='&name[15]=FinishEasy';
//$jsonurl.='&name[16]=FinishNormal';
//$jsonurl.='&name[17]=FinishHard';

$json = file_get_contents($jsonurl);

$json = json_decode($json);

$stats = array(
          array('name' => 'Deaths'),
		  array('name' => 'Items Sold'),
          array('name' => 'Items Purchased'),
          array('name' => 'Gold Collected'),
          array('name' => 'Monsters Killed'),
          array('name' => 'Food Consumed'),
          array('name' => 'Stuff Broken'),
          array('name' => 'Quests Completed'),
          array('name' => 'Steps Taken'),
          array('name' => 'Traps Triggered'),
          array('name' => 'Boss Kills'),
          array('name' => 'Chests Unlocked'),
          array('name' => 'Chests Open'),
          array('name' => 'Doors Unlocked'),
          array('name' => 'Total Played Time'),
          
		  /*
          array('name' => 'Won game in Easy'),
          array('name' => 'Won game in Normal'),
          array('name' => 'Won game in Hard')*/
);

function secondsToTime($seconds) {
    $dtF = new DateTime("@0");
    $dtT = new DateTime("@$seconds");
    return $dtF->diff($dtT)->format('%a days, %hH, %iM');
}

$idx = 0;

foreach($json->response->globalstats as $stat)
{
  if(isset($stat->total))
     $stats[$idx]['total'] = number_format($stat->total);
  else $stats[$idx]['total'] = 0;

  if($idx==14){

    $stats[$idx]['total'] = secondsToTime((int)$stat->total);
  }

  ++$idx;
}

print_r(json_encode($stats));

?>
