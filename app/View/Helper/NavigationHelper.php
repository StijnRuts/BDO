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
							'name' => 'Ledenbeheer',
							'location' => array( 'controller'=>'admin', 'action'=>'ledenbeheer' ),
							'subitems' => array(
								array(
									'name' => 'Leden',
									'location' => array( 'controller'=>'contestants' ),
									'subitems' => array()
								),
								array(
									'name' => 'Clubs',
									'location' => array( 'controller'=>'clubs' ),
									'subitems' => array()
								),
								array(
									'name' => 'Categoriëen',
									'location' => array( 'controller'=>'categories' ),
									'subitems' => array()
								),
								array(
									'name' => 'Disciplines',
									'location' => array( 'controller'=>'disciplines' ),
									'subitems' => array()
								),
								array(
									'name' => 'Divisies',
									'location' => array( 'controller'=>'divisions' ),
									'subitems' => array()
								),
							)
						),
					)
				),
				array(
					'name' => 'Jury',
					'location' => array( 'controller'=>'jury', 'action'=>'index' ),
					'subitems' => array()
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
			$result = $this->find($location, $item['subitems']);
			if($result!=null){
				array_push($result, $item);
				return $result;
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
		$subitems = count($navigation)>1 ? $navigation[1]['subitems'] : $navigation[0]['subitems'];
		foreach($subitems as $subitem){
			if(!isset($subitem['location']['action'])) $subitem['location']['action']='index';
			$returnObj['menu'] .= $this->Html->tag('li',
				$this->Html->Link($subitem['name'], $subitem['location']),
				($subitem['name']==$returnObj['title']) ? array('class'=>'active') : null
			);
		}
		$returnObj['menu'] = $this->Html->tag('ul', $returnObj['menu'], array('class'=>'nav-bar'));

		// BREADCRUMBS
		$crumbs = count($navigation)>1 ? array_reverse(array_slice($navigation,1)) : $navigation;
		foreach($crumbs as $crumb){
			$this->Html->addCrumb($crumb['name'], $crumb['location']);
		}
		$returnObj['breadcrumbs'] = $this->Html->getCrumbList(array('class'=>'breadcrumbs'), false);

	 	return $returnObj;
	}
}
?>