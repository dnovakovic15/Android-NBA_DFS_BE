<?php

	ini_set('max_execution_time', 120000);

	function getDVP($opponent){

		$dvp = array();

		array_push($dvp, getIndividualDVP($opponent, "PG"));
		array_push($dvp, getIndividualDVP($opponent, "SG"));
		array_push($dvp, getIndividualDVP($opponent, "SF"));
		array_push($dvp, getIndividualDVP($opponent, "PF"));
		array_push($dvp, getIndividualDVP($opponent, "C"));


		foreach ($dvp as $element) {
    		echo $element."<br>";
		}

		return $dvp;
	}

    function getIndividualDVP($opponent, $position) {
		require_once('teams.php');
		require_once('players.php');
		require_once('dk_points.php');

		$pg = array();

		$team = new teams();

		array_push($pg, getTeamPgPoints($team->getTeamID($opponent), $position, $team->getTeamID("Atl")));
		array_push($pg, getTeamPgPoints($team->getTeamID($opponent), $position, $team->getTeamID("Bkn")));
		array_push($pg, getTeamPgPoints($team->getTeamID($opponent), $position, $team->getTeamID("Bos")));
		array_push($pg, getTeamPgPoints($team->getTeamID($opponent), $position, $team->getTeamID("Chi")));
		array_push($pg, getTeamPgPoints($team->getTeamID($opponent), $position, $team->getTeamID("Cha")));
		array_push($pg, getTeamPgPoints($team->getTeamID($opponent), $position, $team->getTeamID("Den")));
		array_push($pg, getTeamPgPoints($team->getTeamID($opponent), $position, $team->getTeamID("Cle")));
		array_push($pg, getTeamPgPoints($team->getTeamID($opponent), $position, $team->getTeamID("Dal")));
		array_push($pg, getTeamPgPoints($team->getTeamID($opponent), $position, $team->getTeamID("Det")));
		array_push($pg, getTeamPgPoints($team->getTeamID($opponent), $position, $team->getTeamID("GSW")));
		array_push($pg, getTeamPgPoints($team->getTeamID($opponent), $position, $team->getTeamID("Hou")));
		array_push($pg, getTeamPgPoints($team->getTeamID($opponent), $position, $team->getTeamID("Ind")));
		array_push($pg, getTeamPgPoints($team->getTeamID($opponent), $position, $team->getTeamID("LAC")));
		array_push($pg, getTeamPgPoints($team->getTeamID($opponent), $position, $team->getTeamID("LAL")));
		array_push($pg, getTeamPgPoints($team->getTeamID($opponent), $position, $team->getTeamID("Mem")));
		array_push($pg, getTeamPgPoints($team->getTeamID($opponent), $position, $team->getTeamID("Mia")));
		array_push($pg, getTeamPgPoints($team->getTeamID($opponent), $position, $team->getTeamID("Mil")));
		array_push($pg, getTeamPgPoints($team->getTeamID($opponent), $position, $team->getTeamID("Min")));
		array_push($pg, getTeamPgPoints($team->getTeamID($opponent), $position, $team->getTeamID("Nop")));
		array_push($pg, getTeamPgPoints($team->getTeamID($opponent), $position, $team->getTeamID("Nyk")));
		array_push($pg, getTeamPgPoints($team->getTeamID($opponent), $position, $team->getTeamID("Okc")));
		array_push($pg, getTeamPgPoints($team->getTeamID($opponent), $position, $team->getTeamID("Orl")));
		array_push($pg, getTeamPgPoints($team->getTeamID($opponent), $position, $team->getTeamID("Phi")));
		array_push($pg, getTeamPgPoints($team->getTeamID($opponent), $position, $team->getTeamID("Phx")));
		array_push($pg, getTeamPgPoints($team->getTeamID($opponent), $position, $team->getTeamID("Por")));
		array_push($pg, getTeamPgPoints($team->getTeamID($opponent), $position, $team->getTeamID("Sac")));
		array_push($pg, getTeamPgPoints($team->getTeamID($opponent), $position, $team->getTeamID("Sas")));
		array_push($pg, getTeamPgPoints($team->getTeamID($opponent), $position, $team->getTeamID("Tor")));
		array_push($pg, getTeamPgPoints($team->getTeamID($opponent), $position, $team->getTeamID("Uta")));
		array_push($pg, getTeamPgPoints($team->getTeamID($opponent), $position, $team->getTeamID("Was")));



		return array_sum($pg)/sizeof($pg);
				
	}

	function getTeamPgPoints($opponent_id, $position, $team_id) {
		require_once('players.php');
		require_once('dk_points.php');

		$players = array();
		$players =  getTeamPlayers($team_id);

		$dk_points = array();
		
		for($i = 0; $i < max(array_map('count', $players)); $i++){
			if(strpos($players[1][$i], $position) > -1){
				array_push($dk_points, getDKPoints($players[0][$i], $opponent_id));
			}
		}

		$pgPointAvg = array_sum($dk_points)/sizeof($dk_points);

		return $pgPointAvg;
	}


?>