<?php
class MajoriteitComponent extends Component {
	public function getMajoriteit($contestants, $users) {

		// bepaal plaats
		foreach($users as $user) {
			$scores = array();
			foreach ($contestants as &$contestant){
				array_push($scores, $contestant['scores']['scores'][$user['id']]['total']);
			}
			sort($scores);
			$scores = array_reverse($scores);
			foreach ($contestants as &$contestant) {
				$contestant['places'][$user['id']] = array_search($contestant['scores']['scores'][$user['id']]['total'], $scores) + 1;
			}
		}

		// tel plaatsen
		foreach ($contestants as &$contestant) {
			$placecount = array_count_values($contestant['places']);
			$cumulative = 0;
			$sum = 0;
			for ($i=1; $i<=count($contestants); $i++) {
				$plaatsing = isset($placecount[$i]) ? $placecount[$i] : 0;
				$contestant['plaatsing'][$i]['absolute'] = $plaatsing;
				$cumulative += $plaatsing;
				$contestant['plaatsing'][$i]['cumulative'] = $cumulative;
				$sum += $i * $plaatsing;
				$contestant['plaatsing'][$i]['sum'] = $sum;
			}
			$contestant['assigned'] = false;
		}

		// ken plaatsen toe
		$maj = ceil(count($users) / 2); // aantal stemmen nodig voor majoriteit
		$assignplace = 1; // toe te kennen plaats
		$maxplace = count($contestants); // maximum toe te kennen plaats
		$placement = array(); // toegekende plaatsen
		for ($i=1; $i<=count($contestants); $i++) {
			$thisplace = array();
			foreach ($contestants as &$contestant) {
				if($contestant['plaatsing'][$i]['cumulative'] >= $maj){ // heeft majoriteit ?
					if(!$contestant['assigned']){
						array_push($thisplace, $contestant);
					}
				}
				if( count($thisplace)==0 ) { // er is geen majoriteit -> kijk naar volgende kolom
					// ???
				} elseif( count($thisplace)==1 ) { // er is majoriteit -> ken plaats toe
					$placement[$assignplace] = $contestant['id'];
					$contestant['assigned'] = true;
					$assignplace++;
				} elseif( count($thisplace)>1 ) { // er is dubbele majoriteit
					// grootste cumulative							$contestant['plaatsing'][$i]['cumulative']
					// bij gelijk -> laagste sum					$contestant['plaatsing'][$i]['sum']
					// nog steeds gelijk -> kijk naar cummulative/sum van volgende plaats
					// nog steeds gelijk -> deel plaats
					//  * neem gemiddelde plaats van alle gelijke deelnemers
					//  * rond af naar boven
					//  * niet toegekende plaatsen vervallen
				}
			}
		}
		foreach ($contestants as &$contestant) {
			foreach ($placement as $p=>$c) {
				if($contestant['id'] == $c) $contestant['place'] = $p;
			}
		}

		// foreach ($placement as $p=>$c) echo $p . " -> " . $c['name'] . "<br />";

		return $contestants;
	}
}
