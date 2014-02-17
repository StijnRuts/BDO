<?php
class MajoriteitComponent extends Component {
	public function getMajoriteit($contestants, $users) {

		// bepaal juryplaatsen
		foreach($users as $user) {
			$scores = array();
			foreach ($contestants as $contestant){
				array_push($scores, $contestant['scores']['scores'][$user['id']]['total']);
			}
			sort($scores);
			$scores = array_reverse($scores);
			foreach ($contestants as &$contestant) {
				$contestant['places'][$user['id']] = array_search($contestant['scores']['scores'][$user['id']]['total'], $scores) + 1;
			} unset($contestant);
		}

		// tel juryplaatsen
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
			$contestant['place'] = false;
		}  unset($contestant);

		// ken plaatsen toe
		$maj = ceil(count($users) / 2); // aantal stemmen nodig voor majoriteit
		$assignplace = 1; // toe te kennen plaats
		$maxplace = count($contestants); // maximum toe te kennen plaats
		$column = 1;
		while ($column <= count($contestants)) {
			$thisplace = array();
			// wie heeft majoriteit ?
			foreach ($contestants as $i => $contestant) {
				if($contestant['plaatsing'][$column]['cumulative'] >= $maj  &&  !$contestant['place']){
					array_push($thisplace, $i);
				}
			}
			if( count($thisplace)==0 ) { // er is geen majoriteit -> kijk naar volgende kolom
				$column++;
			} elseif( count($thisplace)==1 ) { // er is majoriteit -> ken plaats toe
				$i = array_shift($thisplace);
				$contestants[$i]['place'] = $assignplace;
echo "rule1: place $assignplace goes to ".$contestants[$i]['startnr']."<br/>";
				$assignplace++;
				$column++;
			} else { // er is dubbele majoriteit -> grootste cumulative
				$max = 0;
				foreach($thisplace as $i) $max = max($max, $contestants[$i]['plaatsing'][$column]['cumulative']);
				$thisplace = array_filter($thisplace, function($i) use ($contestants, $column, $max){
					return $contestants[$i]['plaatsing'][$column]['cumulative'] >= $max;
				});
				if( count($thisplace)==1 ) { // er is grootste cumulative -> ken plaats toe
					$i = array_shift($thisplace);
					$contestants[$i]['place'] = $assignplace;
echo "rule2: place $assignplace goes to ".$contestants[$i]['startnr']."<br/>";
					$assignplace++;
				} else { // er is geen grootste cumulative -> laagste sum
					$min = 99999999999999;
					foreach($thisplace as $i) $min = min($min, $contestants[$i]['plaatsing'][$column]['sum']);
					$thisplace = array_filter($thisplace, function($i) use ($contestants, $column, $min){
						return $contestants[$i]['plaatsing'][$column]['sum'] <= $min;
					});
					if( count($thisplace)==1 ) { // er is kleinste sum -> ken plaats toe
						$i = array_shift($thisplace);
						$contestants[$i]['place'] = $assignplace;
echo "rule3: place $assignplace goes to ".$contestants[$i]['startnr']."<br/>";
						$assignplace++;
					} else {
						// nog steeds gelijk -> kijk naar cummulative/sum van volgende plaats
						// nog steeds gelijk -> deel plaats
						//  * neem gemiddelde plaats van alle gelijke deelnemers
						//  * rond af naar boven
						//  * niet toegekende plaatsen vervallen
						throw new Exception("Error", 1);
					}
				}
			}
		}

		return $contestants;
	}
}
