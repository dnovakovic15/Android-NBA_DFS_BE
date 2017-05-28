<?php

require_once('average_usage.php');
require_once('playerID.php');

$first = $_POST['first'];
$last = $_POST['last'];
$opponent = $_POST['opponent'];

$stats = array();

$playerID = playerID::getPlayerID($first, $last);
$yearStats = new average_usage();
$stats = $yearStats->getAverageUsage($playerID);
$stats1 = $yearStats->getAverageOppUsage($playerID, $opponent);

for($i = 0; $i < sizeof($stats); $i++){
	echo $stats[$i], "<br>";
}

for($i = 0; $i < sizeof($stats1); $i++){
	echo $stats1[$i], "<br>";
}


?>