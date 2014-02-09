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
		}


		return $contestants;
	}
}
