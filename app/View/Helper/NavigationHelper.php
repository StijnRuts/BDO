<?php
class NavigationHelper extends AppHelper
{
	private $structure = array(
		array(
			'name' => 'Home',
			'location' => array( 'controller'=>'home' ),
			'subitems' => array(
				array(
					'name' => 'Admin',
					'location' => array( 'controller'=>'admin', 'action'=>'index' ),
					'subitems' => array(
						array(
							'name' => 'Wedstrijdbeheer',
							'location' => array( 'controller'=>'admin', 'action'=>'wedstrijdbeheer' ),
							'subitems' => array(
								array(
									'name' => 'Wedstrijden',
									'location' => array( 'controller'=>'contests' )
								),
								array(
									'name' => 'Rondes',
									'location' => array( 'controller'=>'rounds' )
								),
								array(
									'name' => 'Beoordelingpunten',
									'location' => array( 'controller'=>'points' )
								),
								array(
									'name' => 'Jurysamenstelling',
									'location' => array( 'controller'=>'contestusers' )
								),
								array(
									'name' => 'Wedstrijdverloop',
									'location' => array( 'controller'=>'contestmanagement' ),
									'show' => false
								),
							)
						),
						array(
							'name' => 'Ledenbeheer',
							'location' => array( 'controller'=>'admin', 'action'=>'ledenbeheer' ),
							'subitems' => array(
								array(
									'name' => 'Leden',
									'location' => array( 'controller'=>'contestants' )
								),
								array(
									'name' => 'Clubs',
									'location' => array( 'controller'=>'clubs' )
								),
							)
						),
						array(
							'name' => 'Gebruikersbeheer',
							'location' => array( 'controller'=>'users' )
						),
						array(
							'name' => 'Instellingen',
							'location' => array( 'controller'=>'admin', 'action'=>'instellingen' ),
							'subitems' => array(
								array(
									'name' => 'Categoriëen',
									'location' => array( 'controller'=>'categories' )
								),
								array(
									'name' => 'Disciplines',
									'location' => array( 'controller'=>'disciplines' )
								),
								array(
									'name' => 'Divisies',
									'location' => array( 'controller'=>'divisions' )
								),
								array(
									'name' => 'Standaard beoordeling',
									'location' => array( 'controller'=>'defaultpoints' )
								),
							)
						),
					)
				),
				array(
					'name' => 'Jury',
					'location' => array( 'controller'=>'jury', 'action'=>'index' )
				),
				array(
					'name' => 'Scorebord',
					'location' => array( 'controller'=>'results' )
				),
			)
		)
	);

	var $helpers = array('Html');

	private function getNavigationObject(){
		$currentLocation = array(
			'controller' => $this->params['controller'],
			'action' => $this->params['action']
		);
		return $this->find( $currentLocation, $this->structure );
	}
	private function find($location, $items){
		foreach($items as $item){
			if( $item['location']['controller']==$location['controller'] ){
				if( !isset($item['location']['action']) || $item['location']['action']==$location['action'] ){
					return array($item);
				}
			}
		}
		foreach($items as $item){
			if( isset($item['subitems']) ){
				$result = $this->find($location, $item['subitems']);
				if($result!=null){
					array_push($result, $item);
					return $result;
				}
			}
		}
		return null;
	}

	public function get(){
		$navigation = $this->getNavigationObject();
		if($navigation==null) return null;
		$returnObj = array();

		// TITLE
		$returnObj['title'] = $navigation[0]['name'];

		// MENU
		$returnObj['menu'] = "";
		$subitems = isset($navigation[0]['subitems']) ? $navigation[0]['subitems'] : $navigation[1]['subitems'];
		foreach($subitems as $subitem){
			if( isset($subitem['show']) && $subitem['show']==false ) continue;
			if(!isset($subitem['location']['action'])) $subitem['location']['action']='index';
			$returnObj['menu'] .= $this->Html->tag('li',
				$this->Html->Link($subitem['name'], $subitem['location']),
				($subitem['name']==$returnObj['title']) ? array('class'=>'active') : null
			);
		}
		$returnObj['menu'] = $this->Html->tag('ul', $returnObj['menu'], array('class'=>'nav-bar'));

		// BREADCRUMBS
		foreach(array_reverse($navigation) as $crumb){
			if($crumb['name']==$returnObj['title']){
				$this->Html->addCrumb( $this->Html->tag('span', $crumb['name'], array('class'=>'current')) , null );
			} else {
				$this->Html->addCrumb( $crumb['name'],	$crumb['location'] );
			}
		}
		$returnObj['breadcrumbs'] = $this->Html->getCrumbList(array('class'=>'breadcrumbs'), false);

	 	return $returnObj;
	}
}
?>