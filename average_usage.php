<?php

class average_usage{

    public static function getAverageUsage($player_id) {
		require_once('total_usage.php');

		$myPlayerStats = new total_usage($player_id);
		$stats = $myPlayerStats->getTotalUsageStats();

		$usageStats = array();

		$usageStats[0] =  array_sum($stats[0])/sizeOf($stats[0]);
		$usageStats[1] =  array_sum($stats[1])/sizeOf($stats[1]);
		$usageStats[2] =  array_sum($stats[2])/sizeOf($stats[2]);
		$usageStats[3] =  array_sum($stats[3])/sizeOf($stats[3]);

		return $usageStats;
	}

	public static function getAverageOppUsage($player_id, $opponent) {
		require_once('total_usage.php');

		$myPlayerStats = new total_usage($player_id);
		$stats = $myPlayerStats->getOpponentUsageStats($opponent);

		$usageStats = array();

		if(sizeOf($stats[0]) > 0){
			$usageStats[0] =  array_sum($stats[0])/sizeOf($stats[0]);
		}
		if(sizeOf($stats[1]) > 0){
			$usageStats[1] =  array_sum($stats[1])/sizeOf($stats[1]);
		}
		if(sizeOf($stats[2]) > 0){
			$usageStats[2] =  array_sum($stats[2])/sizeOf($stats[2]);
		}
		if(sizeOf($stats[3]) > 0){
			$usageStats[3] =  array_sum($stats[3])/sizeOf($stats[3]);
		}

		return $usageStats;
	}
}

?>