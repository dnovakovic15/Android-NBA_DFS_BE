<?php

    ini_set('max_execution_time', 120000);
    
    function getDKPoints($player, $opponent) {

		$url = 'http://api.probasketballapi.com/boxscore/player';

		$api_key = '';

		$query_string = 'api_key='.$api_key.'&player_id='.$player.'&opponent_id='.$opponent;

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$result = curl_exec($ch);
		$json_obj = json_decode($result);
		$pts = array();
		$ast = array();
		$dReb = array();
		$oReb = array();
		$blk = array();
		$stl = array();
		$to = array();
		$fg3m = array();

		curl_close($ch);

		for($i = 0; $i < sizeof($json_obj); $i++){
			if($json_obj[$i]->season == "2016" || $json_obj[$i] == "2017"){
				$pts[$i] = $json_obj[$i]->pts;
				$ast[$i] = $json_obj[$i]->ast;
				$oReb[$i] = $json_obj[$i]->oreb;
				$dReb[$i] = $json_obj[$i]->dreb;
				$blk[$i] = $json_obj[$i]->blk;
				$stl[$i] = $json_obj[$i]->stl;
				$to[$i] = $json_obj[$i]->to;
				$fg3m[$i] = $json_obj[$i]->fg3m;

			}
		}

		$stats = array($pts, $ast, $oReb, $dReb, $blk, $stl, $to, $fg3m);
		$dk_pts = array_sum($pts) + (array_sum($ast) * 1.5) + (array_sum($oReb) * 1.25) + (array_sum($dReb) * 1.25) + (array_sum($blk) * 2) + (array_sum($stl) * 2) + (array_sum($fg3m) * 0.5) - (array_sum($to) * 0.5);

		return $dk_pts;
	}

	function getSpecificDayDKPoints($player) {

		$url = 'http://api.probasketballapi.com/boxscore/player';

		$api_key = '';

		$query_string = 'api_key='.$api_key.'&player_id='.$player;

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$result = curl_exec($ch);
		$json_obj = json_decode($result);

		curl_close($ch);

		$ast = $json_obj[sizeof($json_obj) - 1]->ast;
		$oReb = $json_obj[sizeof($json_obj) - 1]->oreb;
		$dReb = $json_obj[sizeof($json_obj) - 1]->dreb;
		$blk = $json_obj[sizeof($json_obj) - 1]->blk;
		$stl = $json_obj[sizeof($json_obj) - 1]->stl;
		$to = $json_obj[sizeof($json_obj) - 1]->to;
		$fg3m = $json_obj[sizeof($json_obj) - 1]->fg3m;
		$pts = $json_obj[sizeof($json_obj) - 1]->pts;

		$stats = array($pts, $ast, $oReb, $dReb, $blk, $stl, $to, $fg3m);
		echo "Points: ".$pts."<br>";
		$dk_pts = $pts + ($ast * 1.5) + ($oReb * 1.25) + ($dReb * 1.25) + ($blk * 2) + ($stl * 2) + ($fg3m * 0.5) - ($to * 0.5);

		return $dk_pts;
	}

?>

