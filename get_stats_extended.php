<?php


$jsonurl = "http://api.steampowered.com/ISteamUserStats/GetGlobalStatsForGame/V0001/?format=json";

$jsonurl.='&appid=270050';
$jsonurl.='&count=32';

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


$jsonurl.='&name[15]=FinishEasy';
$jsonurl.='&name[16]=FinishNormal';
$jsonurl.='&name[17]=FinishHard';
$jsonurl.='&name[18]=FinishHell';

$jsonurl.='&name[19]=DeathsEasy';
$jsonurl.='&name[20]=DeathsNormal';
$jsonurl.='&name[21]=DeathsHard';
$jsonurl.='&name[22]=DeathsHell';

$jsonurl.='&name[23]=FinishAssassin';
$jsonurl.='&name[24]=FinishWizard';
$jsonurl.='&name[25]=FinishWarrior';
$jsonurl.='&name[26]=FinishShaman';
$jsonurl.='&name[27]=FinishNecrodancer';

$jsonurl.='&name[28]=LostAssassin';
$jsonurl.='&name[29]=LostWizard';
$jsonurl.='&name[30]=LostWarrior';
$jsonurl.='&name[31]=LostShaman';
$jsonurl.='&name[32]=LostNecroDancer';

$jsonurl.='&name[33]=NumGames';

$jsonurl.='&name[34]=ChooseMansion';
$jsonurl.='&name[35]=ChooseRackan';
$jsonurl.='&name[36]=PressedDeathSign';

$jsonurl.='&name[37]=ChooseWarrior';
$jsonurl.='&name[38]=ChooseWizard';
$jsonurl.='&name[39]=ChooseAssassin';
$jsonurl.='&name[40]=ChooseShaman';
$jsonurl.='&name[41]=ChooseNecrodancer';
$jsonurl.='&name[42]=GhostKills';
$jsonurl.='&name[43]=ChooseCustom';
$jsonurl.='&name[44]=ChooseNecrodancer';


$json = file_get_contents($jsonurl);

$json = json_decode($json);

print_r($json);

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
		  array('name' => 'Won game in Easy'),
          array('name' => 'Won game in Normal'),
          array('name' => 'Won game in Hard'),
		  array('name' => 'Won game in Hell'),
		  array('name' => 'Lost game in Easy'),
          array('name' => 'Lost game in Normal'),
          array('name' => 'Lost game in Hard'),
		  array('name' => 'Lost game in Hell'),
		  array('name' => 'Won game with Assassin'),
          array('name' => 'Won game with Wizard'),
          array('name' => 'Won game with Warrior'),
		  array('name' => 'Won game with Shaman'),
		  array('name' => 'Won game with Necrodancer'),
		  array('name' => 'Lost game with Assassin'),
          array('name' => 'Lost game with Wizard'),
          array('name' => 'Lost game with Warrior'),
		  array('name' => 'Lost game with Shaman'),
		  array('name' => 'Lost game with Necrodancer'),
		  array('name' => 'Games Started'),
		  
		  array('name' => 'Choose Omphar Mansion'),
		  array('name' => 'Choose Rackan Mansion'),
		  array('name' => 'Pressed Death Sign'),
		  array('name' => 'Choose Warrior'),
		  array('name' => 'Choose Wizard'),
		  array('name' => 'Choose Assassin'),
		  array('name' => 'Choose Shaman'),
		  array('name' => 'Choose Necrodancer'),
		  array('name' => 'Ghost Kills'),
		  array('name' => 'Choose Custom Game')
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
