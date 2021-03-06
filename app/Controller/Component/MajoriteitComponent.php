<?php
class MajoriteitComponent extends Component {
	public function getMajoriteit($contestants, $users) {

		// sorteer juryleden op order
		usort($users, function($a, $b){
			return $a["RoundsUser"]["order"] - $b["RoundsUser"]["order"];
		});

		// bepaal juryplaatsen
		foreach($users as $user) {
			$scores = array();
			foreach ($contestants as $contestant){
				array_push($scores, $contestant['scores']['scores'][$user['id']]['total']);
			}
			sort($scores);
			$scores = array_reverse($scores);
			foreach ($contestants as &$contestant) {
				$contestant['places'][] = array_search($contestant['scores']['scores'][$user['id']]['total'], $scores) + 1;
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
		$recalculate_maj = true;

$debug = isset($GET['yt']);

		do {
			$column = 1;
			while ($column <= count($contestants)) {

if($debug) echo "<pre>";
				// wie heeft majoriteit ?
				if($recalculate_maj) {
					$thisplace = array();
					foreach ($contestants as $i => $contestant) {
						if($contestant['plaatsing'][$column]['cumulative'] >= $maj  &&  $contestant['place'] === false){
							array_push($thisplace, $i);
if($debug) echo $contestant['startnr'].", ";
						}
					}
				}
				$recalculate_maj = true;
if($debug) echo "</pre>";

				if( count($thisplace)==0 ) { // er is geen majoriteit -> kijk naar volgende kolom
					$column++;
				} elseif( count($thisplace)==1 ) { // er is majoriteit -> ken plaats toe
					$i = array_shift($thisplace);
					$contestants[$i]['place'] = $assignplace;
if($debug) echo "rule1: place $assignplace goes to ".$contestants[$i]['startnr']."<br/>";
					$assignplace++; $column = 1;
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
if($debug) echo "rule2: place $assignplace goes to ".$contestants[$i]['startnr']."<br/>";
						$assignplace++; $column = 1;
					} else { // er is geen grootste cumulative -> laagste sum
						$min = 99999999999999;
						foreach($thisplace as $i) $min = min($min, $contestants[$i]['plaatsing'][$column]['sum']);
						$thisplace = array_filter($thisplace, function($i) use ($contestants, $column, $min){
							return $contestants[$i]['plaatsing'][$column]['sum'] <= $min;
						});
						if( count($thisplace)==1 ) { // er is kleinste sum -> ken plaats toe
							$i = array_shift($thisplace);
							$contestants[$i]['place'] = $assignplace;
if($debug) echo "rule3: place $assignplace goes to ".$contestants[$i]['startnr']."<br/>";
							$assignplace++; $column = 1;
						} else { // nog steeds gelijk -> kijk naar volgende kolom
							$column++;
							$recalculate_maj = false;
							// alle kolommen gelijk -> deel plaats
							//  * neem gemiddelde plaats van alle gelijke deelnemers
							//  * rond af naar boven
							//  * niet toegekende plaatsen vervallen
						}
					}
				}
			}
			$recalculate_maj = true;

			// zoek de kandidaten met de laagste sum, die nog geen plaats hebben
			$sharedplace = array();
			$min = 99999999999999;
			foreach ($contestants as $i => $contestant) {
				if(!$contestant['place']) {
					$sum = end($contestant['plaatsing']);
					$sum = $sum['sum'];
					if($sum == $min) {
						$sharedplace[] = $i;
					} elseif($sum < $min) {
						$min = $sum;
						$sharedplace = array($i);
					}
				}
			}

			// er zijn kandidaten met voledig gelijke cumulative en sum in elke kolom
			// -> ken gedeelde plaats toe aan deze kandidaten
			$gedeeldeplaats = $assignplace-1 + ceil(count($sharedplace) / 2);
			foreach($sharedplace as $i) {
				$contestants[$i]['place'] = $gedeeldeplaats;
if($debug) echo "rule4: place $gedeeldeplaats goes to ".$contestants[$i]['startnr']."<br/>";
			}
			$assignplace += count($sharedplace);

		} while(count($sharedplace) > 0);
		// als er een dubbele plaats is toegekend, begin dan opnieuw vanvoorafaan
		// om eventuele overgebleven plaatsen toe te kennen

		return $contestants;
	}
}
