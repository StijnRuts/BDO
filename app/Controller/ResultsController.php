<?php
class ResultsController extends AppController {

	public $components = array('RequestHandler');

	function beforeFilter(){
		//$this->Auth->allow('index', 'results'); //uncomment to make result page world accessible
		$this->inifile =  TMP."scorebord.ini";
	}

    public function index() {
        $this->write_ini(array(
            'type' => "welcome",
        ));
        $this->layout = 'results';
    }


	public function results() {
		$this->request->onlyAllow('ajax');
		$ini = parse_ini_file($this->inifile);
		switch($ini['type']){
			case 'contest': $this->contest_results($ini['id']); break;
			case 'round': $this->round_results($ini['id']); break;
			case 'contestant': $this->contestant_results($ini['id'], $ini['round_id']); break;
			case 'contestname': $this->contest_name($ini['id']); break;
			case 'roundname': $this->round_name($ini['id']); break;
			case 'contestantname': $this->contestant_name($ini['id'], $ini['round_id']); break;
			case 'place': $this->place($ini['round_id'], $ini['minplace']); break;
			case 'startnr': $this->startnr($ini['round_id'], $ini['startnr']); break;
			case 'welcome': $this->welcome(); break;
			default: echo "Error"; exit;
		}
	}

	private function welcome() {
		$this->layout = 'ajax';
		$this->render('welcome');
	}

	private function contest_results($id = null) {
		$this->loadModel('Contest');
		$this->loadModel('Contestant');
		if (!$this->Contest->exists($id)) throw new NotFoundException();
		$contest = $this->Contest->find('first', array(
			'conditions' => array('Contest.id'=>$id),
			'contain' => array(
				'Round'=>array('order'=>'order'),
				'Round.Contestant' => array('order'=>'Contestant.startnrorder', 'Club'),
				'Round.Category',
				'Round.Discipline',
				'Round.Division'
			)
		));
		foreach($contest['Round'] as &$round){
			foreach($round['Contestant'] as &$contestant){
				$this->Contestant->id = $contestant['id'];
				$contestant['scores'] = $this->Contestant->getScores($round['id']);
			}
		}
		$this->set('contest', $contest);

		$this->layout = 'ajax';
		$this->render('contest_results');
	}

	private function round_results($id = null) {
		$this->loadModel('Round');
		$this->loadModel('Contestant');
		if (!$this->Round->exists($id)) throw new NotFoundException();
		$round = $this->Round->find('first', array(
			'conditions' => array('Round.id'=>$id),
			'contain' => array('Contestant'=>array('order'=>'startnrorder'), 'Contestant.Club', 'Category', 'Discipline', 'Division', 'Contest')
		));
		foreach($round['Contestant'] as &$contestant){
			$this->Contestant->id = $contestant['id'];
			$contestant['scores'] = $this->Contestant->getScores($id);
		}
		$this->set('round', $round);

		$this->layout = 'ajax';
		$this->render('round_results');
	}

	private function contestant_results($contestant_id = null, $round_id = null) {
		$this->loadModel('Contestant');
		$this->loadModel('Round');
		if (!$this->Contestant->exists($contestant_id)) throw new NotFoundException();
		if (!$this->Round->exists($round_id)) throw new NotFoundException();
		$this->Contestant->id = $contestant_id;
		$this->set('contestant', $this->Contestant->read());
		$this->set('scores', $this->Contestant->getScores($round_id));

		$this->layout = 'ajax';
		$this->render('contestant_results');
	}

	private function contest_name($id = null) {
		$this->loadModel('Contest');
		if (!$this->Contest->exists($id)) throw new NotFoundException();
		$contest = $this->Contest->find('first', array(	'conditions' => array('Contest.id'=>$id) ));
		$this->set('contest', $contest);

		$this->layout = 'ajax';
		$this->render('contest_name');
	}

	private function round_name($id = null) {
		$this->loadModel('Round');
		if (!$this->Round->exists($id)) throw new NotFoundException();
		$round = $this->Round->find('first', array(
			'conditions' => array('Round.id'=>$id),
			'contain' => array('Category', 'Discipline', 'Division', 'Contest')
		));
		$this->set('round', $round);

		$this->layout = 'ajax';
		$this->render('round_name');
	}

	private function contestant_name($contestant_id = null, $round_id = null) {
		$this->loadModel('Contestant');
		$this->loadModel('Round');
		if (!$this->Contestant->exists($contestant_id)) throw new NotFoundException();
		if (!$this->Round->exists($round_id)) throw new NotFoundException();
		$this->Contestant->id = $contestant_id;
		$this->set('contestant', $this->Contestant->read());

		$this->layout = 'ajax';
		$this->render('contestant_name');
	}

    private function place($round_id, $minplace) {
        $this->loadModel('Round');
        $this->loadModel('Contestant');
        if (!$this->Round->exists($round_id)) throw new NotFoundException();
        $round = $this->Round->find('first', array(
            'conditions' => array('Round.id'=>$round_id),
            'contain' => array('Contestant'=>array('order'=>'startnrorder'), 'Contestant.Club', 'Category', 'Discipline', 'Division', 'Contest')
        ));
        foreach($round['Contestant'] as &$contestant){
            $this->Contestant->id = $contestant['id'];
            $contestant['scores'] = $this->Contestant->getScores($round_id);
            $places[] = $contestant['scores']['total'];
        }

        usort($round['Contestant'], function ($a, $b) {
            $aTotal = $a['scores']['total'];
            $bTotal = $b['scores']['total'];
            if ($aTotal != $bTotal) {
                return $bTotal - $aTotal;
            }

            $aOrder = $a['startnrorder'];
            $bOrder = $b['startnrorder'];
            return $aOrder - $bOrder;
        });

        $this->set('round', $round);

        $places = array_unique($places);
        rsort($places);
        $keys = array_map(
            function($a){ return $a+1; },
            array_keys($places)
        );
        $places = array_combine($places, $keys);
        $this->set('places', $places);
        $this->set('minplace', $minplace);

        $this->layout = 'ajax';
        $this->render('place');
    }

    private function startnr($round_id, $startnr) {
        $this->loadModel('Round');
        $this->loadModel('Contestant');
        if (!$this->Round->exists($round_id)) throw new NotFoundException();
        $round = $this->Round->find('first', array(
            'conditions' => array('Round.id'=>$round_id),
            'contain' => array('Contestant'=>array('order'=>'startnrorder'), 'Contestant.Club', 'Category', 'Discipline', 'Division', 'Contest')
        ));
        foreach($round['Contestant'] as &$contestant){
            $this->Contestant->id = $contestant['id'];
            $contestant['scores'] = $this->Contestant->getScores($round_id);
        }
        $this->set('round', $round);
        $this->set('startnr', $startnr);

        $this->layout = 'ajax';
        $this->render('startnr');
    }

	public function contest_print($id = null) {
		$this->loadModel('Contest');
		$this->loadModel('Contestant');
		if (!$this->Contest->exists($id)) throw new NotFoundException();
		$contest = $this->Contest->find('first', array(
			'conditions' => array('Contest.id'=>$id),
			'contain' => array(
				'Round'=>array('order'=>'order'), 'Round.Contestant', 'Round.Contestant.Club',
				'Round.Category', 'Round.Discipline','Round.Division'
			)
		));
		foreach($contest['Round'] as &$round){
			foreach($round['Contestant'] as &$contestant){
				$this->Contestant->id = $contestant['id'];
				$contestant['scores'] = $this->Contestant->getScores($round['id']);
			}
			$round['Contestant'] = $this->computeRanks($round['Contestant']);
		}
		$this->set('contest', $contest);
	}

	public function round_print($id = null) {
		$this->loadModel('Round');
		$this->loadModel('Contestant');
		if (!$this->Round->exists($id)) throw new NotFoundException();
		$round = $this->Round->find('first', array(
			'conditions' => array('Round.id'=>$id),
			'contain' => array('Contestant', 'Contestant.Club', 'Category', 'Discipline', 'Division', 'Contest')
		));
		foreach($round['Contestant'] as &$contestant){
			$this->Contestant->id = $contestant['id'];
			$contestant['scores'] = $this->Contestant->getScores($id);
		}
		$round['Contestant'] = $this->computeRanks($round['Contestant']);
		$this->set('round', $round);
	}

    public function contestant_print($contestant_id = null, $round_id = null) {
        $this->loadModel('Contestant');
        $this->loadModel('Round');
        $this->loadModel('Comment');

        if (!$this->Contestant->exists($contestant_id)) throw new NotFoundException();
        if (!$this->Round->exists($round_id)) throw new NotFoundException();

        $this->Contestant->id = $contestant_id;
        $this->Round->id = $round_id;
        $this->set('contestant', $this->Contestant->read());
        $this->set('round', $this->Round->read());

        $scores = $this->Contestant->getScores($round_id);
        $scores = $this->Contestant->sortScores($scores);
        $this->set('scores', $scores);

        $comments = $this->Comment->find('all', array(
            'conditions' => array(
                'Comment.round_id' => $round_id,
                'Comment.contestant_id' => $contestant_id,
            ),
        ));
        $comments = Set::combine($comments, '{n}.Comment.user_id', '{n}.Comment');
        $this->set('comments', $comments);
    }


    public function showcontest($id = null){
        $this->write_ini(array(
            'type' => "contest",
            'id' => $id,
        ));
        if(!$this->request->isAjax()) $this->redirect($this->referer()); else exit();
    }

    public function showround($id = null){
        $this->write_ini(array(
            'type' => "round",
            'id' => $id,
        ));
        if(!$this->request->isAjax()) $this->redirect($this->referer()); else exit();
    }

    public function showcontestant($id = null, $round_id = null){
        $this->write_ini(array(
            'type' => "contestant",
            'id' => $id,
            'round_id' => $round_id,
        ));
        if(!$this->request->isAjax()) $this->redirect($this->referer()); else exit();
    }

    public function showcontestname($id = null){
        $this->write_ini(array(
            'type' => "contestname",
            'id' => $id,
        ));
        if(!$this->request->isAjax()) $this->redirect($this->referer()); else exit();
    }

    public function showroundname($id = null){
        $this->write_ini(array(
            'type' => "roundname",
            'id' => $id,
        ));
        if(!$this->request->isAjax()) $this->redirect($this->referer()); else exit();
    }

    public function showcontestantname($id = null, $round_id = null){
        $this->write_ini(array(
            'type' => "contestantname",
            'id' => $id,
            'round_id' => $round_id,
        ));
        if(!$this->request->isAjax()) $this->redirect($this->referer()); else exit();
    }

    public function showplace($round_id = null, $minplace = null){
        $this->write_ini(array(
            'type' => "place",
            'round_id' => $round_id,
            'minplace' => $minplace,
        ));
        if(!$this->request->isAjax()) $this->redirect($this->referer()); else exit();
    }

    public function showstartnr($round_id = null, $startnr = null){
        $this->write_ini(array(
            'type' => "startnr",
            'round_id' => $round_id,
            'startnr' => $startnr,
        ));
        if(!$this->request->isAjax()) $this->redirect($this->referer()); else exit();
    }

    private function write_ini($data) {
        $fh = fopen($this->inifile, 'w');
        foreach($data as $key => $value) {
            fwrite($fh, $key."=".$value."\r\n");
        }
        fclose($fh);
    }


	private function computeRanks($contestants){
		if( count($contestants)==0 ) return;

		uasort($contestants, 'cmpTotal');

		$rank = 0;
		$first = reset($contestants);
		$score = $first['scores']['total'] + 1;
		foreach($contestants as &$contestant){
			if( $contestant['scores']['total']<$score ){
				$score = $contestant['scores']['total'];
				$rank++;
				$contestant['scores']['rank'] = $rank;
			} else {
				//$contestant['scores']['rank'] = $rank;
				$contestant['scores']['rank'] = 'ex-aequo';
			}
		}
		return $contestants;
	}

}


function cmpTotal($contestant_a, $contestant_b) {
	$a = $contestant_a['scores']['total'];
	$b = $contestant_b['scores']['total'];
	if ($a == $b) return 0;
	return ($a < $b) ? 1 : -1;
}
